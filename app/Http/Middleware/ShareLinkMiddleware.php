<?php

namespace App\Http\Middleware;

use Closure;

use App\ShareList;

class ShareLinkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $sharelink = '/s/' . $request->sharelink;

        $share = ShareList::where('share_link', $sharelink)->first();

        if ($share == null) {
            return view('errors.404');
        }


        $now = time();

        $sharetime = strtotime($share->updated_at);

        $interval = ($now - $sharetime) / 86400;


        if ($share->valid_time == "one hour") {
            if ($interval > 1 / 24) {
                return view('errors.expiry');
            }

        } elseif ($share->valid_time == "one day") {
            if ($interval > 1) {
                return view('errors.expiry');
            }

        } elseif ($share->valid_time == "one week") {
            if ($interval > 7) {
                return view('errors.expiry');
            }

        } elseif ($share->valid_time == "one year") {
            if ($interval > 365) {
                return view('errors.expiry');
            }
        }


        session_start();
        if ($share->share_password != null) {
            if (!isset($_SESSION["'.$share->file_id.'"])||$_SESSION["'.$share->file_id.'"]!=$share->share_password) {
                return redirect('/entersharepass?fileid=' . $share->file_id . '');
            }
        }else{
            $_SESSION["'.$share->file_id.'"]=$share->share_password;
        }

//        session_destroy();

//        $file_id=$share->file_id;
//        $user_account=$share->user_account;

        $request->attributes->add(compact('share'));

        return $next($request);
    }
}
