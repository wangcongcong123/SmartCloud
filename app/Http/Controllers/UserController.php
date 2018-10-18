<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Storage;
use Input;
use App\File;
use App\password_reset;


define('PATH', './uploads');

class UserController extends Controller
{

    public function signout()
    {
        setcookie("fullname", "", time() - 10);
        setcookie("account", "", time() - 10);
        setcookie("used", "", time() - 10);
        setcookie("total", "", time() - 10);
        return redirect()->route('index');
    }

    // print_r(Input::file('file'));
    // if ($request->hasFile('file')) {
    // exit("no such file");
    // }
    // $file=$request->hasFile('file');
    // if ($file->isValid()) {
    // exit('not valid file');
    // }
    // print_r($file);

    // if ($file->isValid()) {

    // $clientName=$file->getClientOriginalName();
    // $tmp_name=$file->getFileName();
    // $realPath=$file->getRealPath();
    // $extension=$file->getClientOriginalExtension();
    // $mimeType=$file->getMimeType();
    // $path=$file->move('storage/uploads');

    // }
    // print_r($clientName);

// 	function createLocalFolder($path) {
// 	if (!file_exists ( $path )) {
// 	mkdir ($path, 0777 );
// 	}
    // }
    public function ajax(Request $request)
    {
        return response()->json(array(
            'status' => 1,
            'msg' => $_POST ['account']
        ));

        // $patten = '/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/';
        // preg_match($patten,$eamil,$match);
        // if($match)
        // {
        // echo 1;
        // }else{
        // echo 2;
        // }

        if ($account == "admin") {
            return response()->json(array(
                'status' => 1,
                'msg' => 'ok'
            ));
        } else {
            return Redirect::back()->withInput()->withErrors('error');
        }
    }

    public function main()
    {

        if (isset ($_COOKIE ['fullname'])) {

            if ($_COOKIE ['fullname'] != null) {

                // getDirSize
                $account = $_COOKIE ['account'];

                $used_volum = getDirSize(PATH . '/' . $account.'/ison');

                $used_volum = getRealSize($used_volum);

                $affectedRows = Storage::where('user_account', $account)->update(array(
                    'used_volum' => $used_volum
                ));

                if ($affectedRows == 1) {
                    $_COOKIE ['used'] = $used_volum;
                }

                $files = File::where(['status' => 'ison', 'user_account' => $account])->orderBy('updated_at', 'desc')->get();

                $totalsizeonfilelist = 0;

                foreach ($files as $file) {
                    $totalsizeonfilelist += $file->filesize;
                }

                $sizeonfilelist = getRealSize($totalsizeonfilelist);

                $sendfiles = array();
                $sendfolders = array();

                foreach ($files as $file) {
                    if ($file->filetype == 'folder') {
                        $sendfolders[] = $file;
                    } else {
                        $sendfiles[] = $file;
                    }
                }

                $uplist=array();

                if (file_exists('./uploads/'.$account.'/uplist.json')) {
                    $uplist = json_decode(file_get_contents('./uploads/'.$account.'/uplist.json'));
                }

                return view('smart.main', compact('sendfiles', 'sendfolders', 'sizeonfilelist','uplist'));
            }
        }
        return redirect()->route('index');
    }




    public function login(Request $request)
    {
//

        // $request
        $user = User::where([
            'email' => $request->accountforlogin,
            'password' => $request->passwordforlogin
        ])->first();


        if ($user == null) {
            if (isset($request->type)) {
                echo json_encode(array(
                    'state' => 'fail',
                    'username' => "admin",
                    'files' => array()
                ));
                return;
            } else {

                return response()->json(array(
                    'status' => -1,
                    'msg' => 'wrong'
                ));
//                return back();
            }
        } else {
            $remember = $request->remember;

            $storage = Storage::where([
                'user_account' => $request->accountforlogin
            ])->first();

            if ($storage == null) {

                Storage::create([
                    'total_volum' => 100,
                    'used_volum' => 0,
                    'user_account' => $request->accountforlogin
                ]);
            }

            if (isset($request->type)) {


                $used_volum = getDirSize(PATH . '/' . $request->accountforlogin.'/ison');


                $files = File::where(['status' => 'ison', 'user_account' => $request->accountforlogin])->orderBy('updated_at', 'desc')->get();

                $totalsizeonfilelist = 0;

                foreach ($files as $file) {
                    $totalsizeonfilelist += $file->filesize;
                }


                $sizeonfilelist = getRealSize($totalsizeonfilelist);

                $filestoandr = array();

                foreach ($files as $file) {
                    $filestoandr[] = $file->filepath.':'.$file->file_id;
                }

                $contact = Contact::where(['user_account'=> $request->accountforlogin,'friend_account'=> $request->accountforlogin])->first();

                if ($contact==null){
 $faces = array('images/avatar1.jpg', 'images/avatar2.jpg', 'images/avatar3.jpg', 'images/avatar4.jpg', 'images/avatar5.jpg'
                    , 'images/avatar6.jpg', 'images/avatar7.jpg', 'images/avatar8.jpg', 'images/avatar9.jpg', 'images/avatar10.jpg', 'images/avatar11.jpg'
                    , 'images/avatar12.jpg', 'images/avatar13.jpg');

                    $face = $faces[rand(0, 12)];
                    Contact::create([
                        'user_account'=> $request->accountforlogin,
                        'friend_account'=> $request->accountforlogin,
                        'channel'=>$request->channel,
					'face'=>$face
                    ]);
                }else{

                    Contact::where(['user_account'=> $request->accountforlogin,'friend_account'=> $request->accountforlogin])->update(array(
                        'channel' =>$request->channel
                    ));
                }

                $friends = Contact::where('user_account', $request->accountforlogin)->orderBy('updated_at', 'desc')->get();

                $friendsarr=array();

                foreach ($friends as $friend) {
                    $friendsarr[] = $friend->friend_account;
                }


                return response()->json(array(
                    'state' => 'success',
                    'username' => $request->accountforlogin,
                    'files' => $filestoandr,
                    'usedsize' => $sizeonfilelist,
                    'friendarray'=>$friendsarr
                ));


            }

            if ($remember == 'on') {
                setcookie("fullname", $user->name, time() + 7 * 24 * 60 * 60);
                setcookie("account", $user->email, time() + 7 * 24 * 60 * 60);
                if ($storage == null) {
                    setcookie("total", 100.0, time() + 7 * 24 * 60 * 60);
                    setcookie("used", 0.0, time() + 7 * 24 * 60 * 60);
                } else {
                    setcookie("total", $storage->total_volum, time() + 7 * 24 * 60 * 60);
                    setcookie("used", $storage->used_volum, time() + 7 * 24 * 60 * 60);
                }
            } else {
                setcookie("fullname", $user->name, time() + 24 * 60 * 60);
                setcookie("account", $user->email, time() + 24 * 60 * 60);
                if ($storage == null) {
                    setcookie("total", 100.0, time() + 24 * 60 * 60);
                    setcookie("used", 0.0, time() + 24 * 60 * 60);
                } else {
                    setcookie("total", $storage->total_volum, time() + 24 * 60 * 60);
                    setcookie("used", $storage->used_volum, time() + 24 * 60 * 60);
                }
            }

            return response()->json(array(
                'status' => 1,
                'msg' => 'success'
            ));


//			return redirect ()->route ( 'main' );
        }
    }


    public function resetpassword(Request $request)
    {



        if (!isset($request->emailpre) || !isset($request->emailpost) || !isset($request->token)) {
            return back();
        }

        $email=$request->emailpre.'@'.$request->emailpost;
        $password_reset = password_reset::where([
            'email' => $email
        ])->orderBy ( 'created_at', 'desc' )->first();

        date_default_timezone_set('Asia/Shanghai');

        $now = date("Y-m-d H:i:s");

        $create_at = $password_reset->created_at;

        if ((strtotime($now) - strtotime($create_at)) > 5 * 60) {
            return view('errors.expiry');
        }

        if ($password_reset->token != $request->token) {
            return back();
        }

        return view('smart.resetpassword');
    }

    public function resetbyemail(Request $request)
    {

        if (!isset($request->email) || !isset($request->token) || !isset($request->newpass)) {
            return back();
        }

        $password_reset = password_reset::where([
            'email' => $request->email
        ])->orderBy ( 'created_at', 'desc' )->first();

        date_default_timezone_set('Asia/Shanghai');
        $now = date("Y-m-d H:i:s");

        $create_at = $password_reset->created_at;

        if ((strtotime($now) - strtotime($create_at)) > 5 * 60) {
            return view('errors.expiry');
        }

        if ($password_reset->token != $request->token) {
            return back();
        }


        $updatedRows = User::where('email', $request->email)->update(array(
            'password' => $request->newpass
        ));

        if ($updatedRows == 0) {
            return '<h1>password reset failed !</h1>';
        }

        return '<h1>password reset successfully ! <a href="/index">go to login</a></h1>';

    }

    public function findpassword(Request $request)
    {


        require_once('class.phpmailer.php');
        $email = $request->email;

        $user = User::where([
            'email' => $email
        ])->first();


        if ($user == null) {
            return response()->json(array(
                'status' => -1,
                'msg' => 'illegal'
            ));
        }
        date_default_timezone_set('Asia/Shanghai');
        $now = date("Y-m-d H:i:s");
        $token = md5($email . "mimi".$now);//here mimi is the private key for security


        $mail = new \PHPMailer();
        $mail->IsSMTP();

        $mail->Host = 'smtp.163.com';
        $mail->Port = 25;
        $mail->SMTPAuth = true;

        $mail->CharSet = "UTF-8";
        $mail->Encoding = "base64";
        $mail->Username = "18810815930@163.com";
        $mail->Password = "Wang38363163";
        $mail->Subject = "find back your password from SmartCloud";
        $mail->From = "18810815930@163.com";
        $mail->FromName = "SmartCloud";


        $mail->AddAddress($email, "dear user you");


        $mail->IsHTML(true);

        $emailpre = explode("@", $email)[0];

        $emailpost = explode("@", $email)[1];

        $mail->Body = 'hello, in order to find back your password, please <a href="http://congcongxyz.cn/resetpassword?emailpre=' . $emailpre . '&emailpost=' . $emailpost . '&token=' . $token . '">click here</a> to operate within 5 minutes';


        if (!$mail->Send()) {
            return response()->json(array(
                'status' => -2,
                'msg' => 'wrongemail'
            ));
        }

        $pass_reset = password_reset::create(['email' => $email, 'token' => $token]);

        return response()->json(array(
            'status' => 0,
            'msg' => 'success'
        ));
    }


    public function register(Request $request)
    {
//		$this->validate ( $request, [
//				'username' => 'required|max:50'
//		] );

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => $request->psw1
        ]);

        if ($user == null && isset($request->type)) {
            echo 'false';
            return;
        }

        if ($user != null) {

            if (isset($request->type)) {
                echo 'success';
                return;
            }

        }

        return response()->json(array(
            'status' => 1,
            'msg' => 'success'
        ));

//		return redirect ()->route ( 'index');

    }

    /**
     * this class is used to process ajax request when users register an account
     */
    public function emailexisthint(Request $request)


    {


        $user = User::where('email', $request->account)->first();
        if ($user != null) {
            return response()->json(array(
                'status' => 1,
                'msg' => 'exist'
            ));
        }

        return response()->json(array(
            'status' => 0,
            'msg' => 'noexist'
        ));
    }
}


function getDirSize($dir)
{
    $sizeResult = 0;
    if (!file_exists($dir)) {
        mkdir($dir, 0777,true);
    }

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
