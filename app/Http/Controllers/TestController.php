<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class TestController extends Controller {

	public function test4(Request $request) {

	
		
		if (is_uploaded_file ( $_FILES ['file'] ['tmp_name'] )) {
			$users = "admin";
			$path = "./ajax/" . $users;
			if (! is_dir ( $path )) {
				mkdir ( iconv ( "UTF-8", "GBK", $path ), 0777, true );
			}
			move_uploaded_file ( $_FILES ['file'] ['tmp_name'], $path . '/' . iconv ( "UTF-8", "GBK", $_FILES ['file'] ['name'] ) );
			
			
			return response ()->json ( array (
			'status' =>1,
			'error' =>'success'
			) );
		}

		return response ()->json ( array (
			'status' => -1,
			'msg' => 'error'
			) );
		
		
	}
	
	//


	public function test3() {
		// echo "<script>
		// alert('hello');
		// </script>";
		// echo view ('test');
		// echo   back();

		
// 		return response()->view("test");
// echo "<script>alert('success')</script>";
// return back();
		
	}
	

	public function test2(Request $request) {
		// $this->glo=21;
		// echo getRealSize(getDirSize(PATH));
	}





	public function test(Request $request) {
		// return Request::input('content');
		// return $_GET['content'];
		// return $_REQUEST['method'];
		// echo "string";
		// $arrayName = array('haha' => 123,'enene'=>222 );
		// print_r($arrayName);

		// if (Request::file('file')->isValid())
		// {
		// createLocalFolder('./uploads');
			// Request::file('file')->move("./uploads",$_FILES['file']['name']);
			// echo "success";
			// }else{
			// echo "fail";
			// }

			// print_r($_FILES['file']);
		if (is_uploaded_file ( $_FILES ['file'] ['tmp_name'] )) {
			$users = "admin";
			$path = "./uploads/" . $users;
			if (! is_dir ( $path )) {
				mkdir ( iconv ( "UTF-8", "GBK", $path ), 0777, true );
			}
			move_uploaded_file ( $_FILES ['file'] ['tmp_name'], $path . '/' . iconv ( "UTF-8", "GBK", $_FILES ['file'] ['name'] ) );
			echo "success";
		}
	}
}
