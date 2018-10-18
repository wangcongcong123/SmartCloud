<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class GlobalController extends Controller
{
    //
    public function index(Request $request)
    {

        if (isset ($_COOKIE ['fullname'])) {

            if ($_COOKIE ['fullname'] != null) {
                    return redirect()->route("main");
            }
        }
        return view('smart.index');
    }
}
