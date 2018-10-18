<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App;

class LocalizationController extends Controller {
	public function index(Request $request, $locale) {
		// set¡¯s application¡¯s locale
     	App::setLocale ( $locale );
		// Gets the translated message and displays it
		// echo trans ( 'lang.msg' );
		// $msg=trans ( 'lang.msg' );
		$string= file_get_contents('../config/app.php');
		if ($locale=="en"){
			$update_str = str_replace("'locale' => 'zh_cn'", "'locale' => '$locale'", $string);
		}else if($locale=="zh_cn"){
			$update_str = str_replace("'locale' => 'en'", "'locale' => '$locale'", $string);
		}
		file_put_contents('../config/app.php', $update_str);
		 return redirect()->route('localtest');
	}
}
