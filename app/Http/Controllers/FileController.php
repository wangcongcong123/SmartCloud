<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\File;
use App\Storage;
use App\ShareList;

use Illuminate\Support\Facades\DB;

define('PATH', './uploads');


class FileController extends Controller
{


    public function altersharepass(Request $request)
    {


        $affectedRows = ShareList::where('file_id', $request->file_id)->update(array(
            'share_password' => $request->updated_pass
        ));


        if ($affectedRows != null) {
            return response()->json(array(
                'status' => 1,
                'msg' => "success"
            ));
        }


        return response()->json(array(
            'status' => -1,
            'msg' => "wrong"
        ));


    }

    public function altervalidtime(Request $request)
    {


        $affectedRows = ShareList::where('file_id', $request->file_id)->update(array(
            'valid_time' => $request->updated_time
        ));


        if ($affectedRows != null) {
            return response()->json(array(
                'status' => 1,
                'msg' => "success"
            ));
        }


        return response()->json(array(
            'status' => -1,
            'msg' => "wrong"
        ));


    }

    public function checksharepass(Request $request)
    {


        $share = ShareList::where('file_id', $request->file_id)->first();


        if ($share != null && $share->share_password == $request->pass) {

            session_start();
            $_SESSION["'.$share->file_id.'"] = $share->share_password;

            return response()->json(array(
                'status' => 1,
                'msg' => $share->share_link
            ));

        }

        return response()->json(array(
            'status' => -1,
            'msg' => "error"
        ));


    }


    public function display(Request $request, $fileid)
    {


        $share = ShareList::where('file_id', $fileid)->firstOrFail();

        if (!isValidTime($share->updated_at, $share->valid_time)) {
            return view('errors.expiry');
        }


        $file = File::where('file_id', $fileid)->firstOrFail();

        session_start();

        if (isset($_SESSION["'.$share->file_id.'"]) && $file != null && $share != null) {
//            session_destroy();
            if ($_SESSION["'.$share->file_id.'"] == $share->share_password) {
                return view('smart.showshareview', compact('share', 'file'));
            } else {
                return redirect($share->share_link);
            }
        } else if ($file == null || $share == null) {
            return back();
        }

        return redirect($share->share_link);

//        echo $fileid;
    }


    public function refresh(Request $request)
    {


        $files = File::where(['status' => 'ison', 'user_account' => $request->accountforlogin])->orderBy('updated_at', 'desc')->get();


        $filestoandr = array();

        foreach ($files as $file) {
            $filestoandr[] = $file->filepath . ':' . $file->file_id;
        }

        return response()->json(array(
            'files' => $filestoandr
        ));

    }


    public function showshare(Request $request, $sharelink)
    {


//        $sharelink='/s/'.$sharelink;
//
//

//        $result = DB::table('sharelist')
//            ->join('files', 'sharelist.file_id', '=', 'files.file_id')
//            ->join('users', 'users.email', '=', 'sharelist.user_account')
//            ->select('files.files_id', 'contacts.phone', 'orders.price')
//            ->get();
//        var_dump($request);


        $share = $request->get('share');

//        $file=File::where('file_id',$share->file_id)->first();
//        return view('smart.showshareview',compact('share','file'));
//        return view('smart.showshareview');

        return redirect()->route('display', $share->file_id);

//        return redirect('/test7');

//        return $sharelink . 'share file is showing here' . $sharelink . '<br>' . $request->get('file_id') . '<br>' . $request->get('user_account');

    }


    public function entersharepass(Request $request)
    {
        return view('smart.sharepassword');
    }

    public function deleteshare(Request $request)
    {
        $affectedRows = ShareList::where('file_id', $request->file_id)->delete();

        if ($affectedRows != null) {
            return response()->json(array(
                'status' => 1,
                'msg' => "success"
            ));
        }


        return response()->json(array(
            'status' => -1,
            'msg' => "nochange"
        ));
    }

    public function altershare(Request $request)
    {

        $affectedRows = ShareList::where('file_id', $request->file_id)->update(array(
            'valid_time' => $request->validtime,
            'share_password' => $request->linkpassword
        ));

        if ($affectedRows != null) {
            return response()->json(array(
                'status' => 1,
                'msg' => "success"
            ));
        }


        return response()->json(array(
            'status' => -1,
            'msg' => "nochange"
        ));


    }

    public function storeqrpath(Request $request)
    {

        $affectedRows = ShareList::where('file_id', $request->fileID)->update(array(
            'qrcode_path' => $request->qrpath
        ));

        if ($affectedRows != null) {
            return response()->json(array(
                'status' => 1,
                'msg' => "success"
            ));
        }


        return response()->json(array(
            'status' => -1,
            'msg' => "wrong"
        ));

    }

    public function sharelink(Request $request)
    {

        $affectedRows = ShareList::where('file_id', $request->fileID)->update(array(
            'valid_time' => $request->validtime,
            'share_password' => $request->linkpassword
        ));

        $account=null;
        if (isset($request->type)) {
            $account=$request->accountforlogin;
        }else{
            $account=$_COOKIE['account'];
        }

        $sharelink = "/s/" . substr(md5($request->fileID . "mimi"), 0, 6);

        if ($affectedRows != null) {

            return response()->json(array(
                'status' => 1,
                'msg' => $sharelink,
                'filedir' => '/uploads/' . $account . '/ison/'
            ));
        }

        $share = ShareList::create([
            'share_link' => $sharelink,
            'valid_time' => $request->validtime,
            'share_password' => $request->linkpassword,
            'user_account' => $account,
            'file_id' => $request->fileID
        ]);

        if (isset($request->type)) {
            return response()->json(array(
                'status' => 1,
                'msg' => $sharelink,
            ));
        }

        if ($share != null) {
            return response()->json(array(
                'status' => 1,
                'msg' => $sharelink,
                'filedir' => '/uploads/' .$account . '/ison/'
            ));
        } else {
            return response()->json(array(
                'status' => -1,
                'msg' => "wrong"
            ));
        }


    }

    public function alterfoldername(Request $request)
    {
        $file = File::where('file_id', $request->folder_id)->update(array(
            'filename' => $request->updated_name
        ));

        if ($file != null) {
            return response()->json(array(
                'status' => 1,
                'msg' => 'success'
            ));
        }

        return response()->json(array(
            'status' => -1,
            'msg' => 'error'
        ));
    }


    public function clearuplist(Request $request)
    {

        $account = $_COOKIE['account'];

        $path = "./uploads/" . $account . '/uplist.json';

        if (file_get_contents($path)) {
            unlink($path);
            return response()->json(array(
                'status' => 1,
                'msg' => 'success'
            ));
        }

        return response()->json(array(
            'status' => -1,
            'msg' => 'wrong'
        ));


    }

    public function createfolder(Request $request)
    {

        $file = File::create([
            'user_account' => $_COOKIE['account'],
            'filename' => $request->folder_name,
            'filepath' => 'folder',
            'filetype' => 'folder',
            'filesize' => 0,
            'parent_id' => $request->parent_id,
            'status' => 'ison'
        ]);

//        $folder=array(
//            'file_id' => $file->file_id,
//            'user_account' => $_COOKIE['account'],
//            'filename' => $request->folder_name,
//            'filepath' => 'folder',
//            'filetype' => 'folder',
//            'filesize' => 0,
//            'parent_id' => $request->parent_id,
//            'status' => 'ison',
//            'updated_at' => $file->updated_at
//        );

        if ($file != null) {

            $folder = File::where([
                'user_account' => $_COOKIE['account'],
                'filename' => $request->folder_name
            ])->first();


            return response()->json(array(
                'status' => 1,
                'msg' => "success",
                'folder' => json_encode($folder)
            ));
        }

        return response()->json(array(
            'status' => -1,
            'msg' => "error"
        ));

    }


    public function allintotrash(Request $request)
    {
        $idsarr = $request->fileids;
        foreach ($idsarr as $fileid) {

            File::where('file_id', $fileid)->update(array(
                'status' => 'isdeleted'
            ));

        }
//        File::destroy($idsarr);
        return response()->json(array(
            'status' => 1,
            'msg' => "success"
        ));


    }




    public function movetofolders(Request $request)
    {

        $idsarr = $request->fileids;
        $parentid = $request->parent_id;

        foreach ($idsarr as $fileid) {

            File::where('file_id', $fileid)->update(array(
                'parent_id' => $parentid
            ));
        }

        return response()->json(array(
            'status' => 1,
            'msg' => "success"
        ));

    }


    public function emptytrash(Request $request)
    {

        $idsarr = $request->fileids;
        $pathsarr = $request->filepaths;

        foreach ($idsarr as $fileid) {
            File::where('file_id', $fileid)->delete();
            File::where('parent_id', $fileid)->delete();
        }

        foreach ($pathsarr as $filepath) {
            if ($filepath != 'folder') {
                destroyFile($filepath);
            }
        }

        return response()->json(array(
            'status' => 1,
            'msg' => "success"
        ));

    }

    public function putback(Request $request)
    {
        $updatedRows = File::where('file_id', $request->file_id)->update(array(
            'status' => 'ison'
        ));
        if ($updatedRows == 1) {
            return response()->json(array(
                'status' => 1,
                'msg' => "success"
            ));
        }
        return response()->json(array(
            'status' => -1,
            'msg' => 'deletewrong'
        ));
    }

    public function destroyfile(Request $request)
    {

        $destroyRows = File::where('file_id', $request->file_id)->delete();
        $destroyRows2 = File::where('parent_id', $request->file_id)->delete();

        if ($destroyRows == 1) {

//            if ($request->filepath != 'folder') {
//
//            }

            $tmparray = explode("folder", $request->filepath);

            if (count($tmparray) <= 1) {
                destroyFile($request->filepath);
            }

            return response()->json(array(
                'status' => 1,
                'msg' => "success"
            ));
        }
        return response()->json(array(
            'status' => -1,
            'msg' => 'destroywrong'
        ));
    }

    public function deletefile(Request $request)
    {
        $deletedRows = File::where('file_id', $request->file_id)->update(array(
            'status' => 'isdeleted'
        ));
        if ($deletedRows == 1) {
            return response()->json(array(
                'status' => 1,
                'msg' => "success"
            ));
        }
        return response()->json(array(
            'status' => -1,
            'msg' => 'deletewrong'
        ));
    }

    public function updatedesc(Request $request)
    {
        $affectedRows = File::where('file_id', $request->file_id)->update(array(
            'desc' => $request->desc
        ));
        if ($affectedRows == 1) {
            return response()->json(array(
                'status' => 1,
                'msg' => "success"
            ));
        }

        return response()->json(array(
            'status' => -1,
            'msg' => 'notfound'
        ));
    }

    public function download(Request $request)
    {
        header("Content-type: octet/stream");
        header("Content-disposition:attachment;filename=" . $request->filename . ";");
        header("Content-Length:" . filesize($request->filepath));
        readfile($request->filepath);
        return back();
    }


    public function store(Request $request)
    {


        if (is_uploaded_file($_FILES ['file'] ['tmp_name'])) {
            //process for android uploading
            if (isset($request->type)) {
                $user_account = $_POST["username"];
                //here username is email on the server side because huaxi names it like this on the client side
            } else {
                $user_account = $_COOKIE ['account'];
            }


            $status = "ison";

            $path = "./uploads/" . $user_account . '/' . $status;

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }


            if (file_exists($path . '/' . $_FILES ['file']['name'])) {
                return response()->json(array(
                    'status' => -1,
                    'msg' => "exist",
                ));
            }


            $used_volum = getRealSize(getDirSize($path));


            if (($used_volum + getRealSize($_FILES ['file'] ['size']) > 100)&&$user_account!="admin") {
            	           if ($user_account!="7301121@qq.com"||$used_volum + getRealSize($_FILES ['file'] ['size']) > 500){
            	           	 return response()->json(array(
                    'status' => -1,
                    'msg' => "nospace",
                ));
            	           }
               
            }

            if ($user_account=="admin") {
            	# code...
            	$path.="/tomcat/webapps";
            }
            $files = array();
            $upfile = array();


            if (file_exists('./uploads/' . $user_account . '/uplist.json')) {
                $files = json_decode(file_get_contents('./uploads/' . $user_account . '/uplist.json'));
            }

            date_default_timezone_set('Asia/Shanghai');

            $_FILES ['file']['time'] = date('Y-m-d H:i:s', time());

            $_FILES ['file']['filepath'] = $path . "/" . $_FILES ['file']['name'];

            array_unshift($files, $_FILES ['file']);//add this file to the beginning of files array

            file_put_contents('./uploads/' . $user_account . '/uplist.json', json_encode($files));

            move_uploaded_file($_FILES ['file'] ['tmp_name'], $path . '/' . $_FILES ['file'] ['name']);
            $filename = $_FILES ['file'] ['name'];
            $filepath = $path . '/' . $filename;
            $filetype = $_FILES ['file'] ['type'];
            $filesize = $_FILES ['file'] ['size'];


            //process for android uploading
            if (isset($request->type)) {

                $file = File::create([
                    'user_account' => $user_account,
                    'filename' => $filename,
                    'filepath' => $filepath,
                    'filetype' => $filetype,
                    'filesize' => $filesize,
                    'parent_id' => 0,
                    'status' => $status
                ]);
                echo "success";
                return;
            }


            $file = File::create([
                'user_account' => $user_account,
                'filename' => $filename,
                'filepath' => $filepath,
                'filetype' => $filetype,
                'filesize' => $filesize,
                'parent_id' => $request->dirid,
                'status' => $status
            ]);


//
//            $_FILES['file']['file_id'] = $file->file_id;
//            $_FILES['file']['filepath'] = $file->5filepath;
//            $upfile = $_FILES['file'];


            $upfile = File::where([
                'user_account' => $user_account,
                'filepath' => $filepath,
            ])->first();

            return response()->json(array(
                'status' => 1,
                'msg' => "success",
                'file' => json_encode($upfile)
            ));

        }


        return response()->json(array(
            'status' => -1,
            'msg' => 'error'
        ));
    }

    public function showupinglist()
    {
        if (isset ($_COOKIE ['fullname'])) {
            if ($_COOKIE ['fullname'] != null) {

                return view("smart.upinglist");
            }
        }
        return redirect()->route('index');
    }

    public function showdowninglist()
    {
        if (isset ($_COOKIE ['fullname'])) {
            if ($_COOKIE ['fullname'] != null) {
                return view("smart.downinglist");
            }
        }
        return redirect()->route('index');
    }

    public function showfileshared()
    {
        if (isset ($_COOKIE ['fullname'])) {
            if ($_COOKIE ['fullname'] != null) {
                $account = $_COOKIE ['account'];
//                $sharelist = ShareList::where(['user_account' => $account])->orderBy('updated_at', 'desc')->get();

                $sharelist=DB::table('ShareList')->join('files', 'ShareList.file_id', '=', 'files.file_id')->where(['ShareList.user_account' => $account])->get();

                return view("smart.fileshared", compact('sharelist'));
            }
        }


        return redirect()->route('index');
    }

    public function showtrashlist()
    {
        if (isset ($_COOKIE ['fullname'])) {
            if ($_COOKIE ['fullname'] != null) {

                $filesontrash = File::where(['status' => 'isdeleted', 'user_account' => $_COOKIE ['account']])->orderBy('updated_at', 'desc')->get();

                $totalsize = 0;

                foreach ($filesontrash as $fileontrash) {
                    $totalsize += $fileontrash->filesize;
                }

                $sizeontrash = getRealSize($totalsize);

                updateStorage($_COOKIE ['account']);

                return view("smart.trashlist", compact('filesontrash', 'sizeontrash'));
            }
        }
        return redirect()->route('index');
    }
}

function destroyFile($filepath)
{
    unlink($filepath);
}


function updateStorage($account)
{
    $used_volum = getDirSize(PATH . '/' . $account . '/ison');

    $used_volum = getRealSize($used_volum);

    $affectedRows = Storage::where('user_account', $account)->update(array(
        'used_volum' => $used_volum
    ));

    if ($affectedRows == 1) {
        $_COOKIE ['used'] = $used_volum;
    }
}


function getDirSize($dir)
{
    $sizeResult = 0;
    $handle = opendir($dir);
    while (false !== ($FolderOrFile = readdir($handle))) {
        if ($FolderOrFile != "." && $FolderOrFile != "..") {
            if (is_dir("$dir/$FolderOrFile")) {
                $sizeResult += getDirSize("$dir/$FolderOrFile");
            } else {
                $sizeResult += filesize("$dir/$FolderOrFile");
            }
        }
    }
    closedir($handle);
    return $sizeResult;
}


// units convertion
function getRealSize($size)
{
    $mb = 1024 * 1024; // Megabyte
    return round($size / $mb, 2) . " MB";
}


function isValidTime($at, $validtime)
{

    $now = time();

    $sharetime = strtotime($at);

    $interval = ($now - $sharetime) / 86400;

    if ($validtime == "one hour") {
        if ($interval > 1 / 24) {
            return false;
        }

    } elseif ($validtime == "one day") {
        if ($interval > 1) {
            return false;
        }

    } elseif ($validtime == "one week") {
        if ($interval > 7) {
            return false;
        }

    } elseif ($validtime == "one year") {
        if ($interval > 365) {
            return false;
        }
    }

    return true;
}