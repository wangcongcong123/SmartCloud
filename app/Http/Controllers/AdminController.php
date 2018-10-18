<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\File;

use App\User;

//
//use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Eloquent\Model;

class AdminController extends Controller
{


    public function admin(Request $request)
    {

        if (isset ($_COOKIE ['account'])) {

            if ($_COOKIE ['account'] == 'admin') {
                $results = File::orderBy('updated_at', 'desc')->get();
                return view('smart.admin', compact('results'));
            }
        }

//        $results = File::where(['status' => 'ison', 'user_account' => 'admin'])->orderBy('updated_at', 'desc')->get();

//        $result=File::where('file_id','>','0')->first();

//        return view('smart.admin', compact('results'));
        return back();

    }


    public function deletefilebyadmin(Request $request)
    {

        $destroyRows = File::where('file_id', $request->file_id)->delete();

        $destroyRows2 = File::where('parent_id', $request->file_id)->delete();

        if ($destroyRows == 1) {

            if ($request->filepath != 'folder') {
                unlink($request->filepath);
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


    public function deleteuserbyadmin(Request $request)
    {

        $destroyRows = User::where('email', $request->user_account)->delete();

        deldir('./uploads/'.$request->user_account);

        if ($destroyRows == 1) {

            return response()->json(array(
                'status' => 1,
                'msg' => "success"
            ));
        }

        return response()->json(array(
            'status' => -1,
            'msg' => 'wrong'
        ));

    }

}


function deldir($dir)
{
    $dh = opendir($dir);
    while ($file = readdir($dh))
    {
        if ($file != "." && $file != "..")
        {
            $fullpath = $dir . "/" . $file;
            if (!is_dir($fullpath))
            {
                unlink($fullpath);
            } else
            {
                deldir($fullpath);
            }
        }
    }
    closedir($dh);
    if (rmdir($dir))
    {
        return true;
    } else
    {
        return false;
    }
}
