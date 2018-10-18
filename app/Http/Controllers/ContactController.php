<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\File;
use App\User;
use App\Contact;
use App\ContactProcess;

class ContactController extends Controller
{
    //

    public function download(Request $request)
    {

        if ($request->account2=="undefined"){
            $account=$request->account1;
        }else{
            $account=$request->account1.'@'.$request->account2;
        }
        $filepath="./uploads/".$account.'/ison/'.$request->filename;
        header("Content-type: octet/stream");
        header("Content-disposition:attachment;filename=" . $request->filename . ";");
        header("Content-Length:" . filesize($filepath));
        readfile($filepath);
        return back();
    }




    public function addafriend(Request $request)
    {

        $contact = Contact::where(['user_account' => $request->faccount, 'friend_account' => $request->faccount])->first();

        if ($contact == null) {
            Contact::create([
                'user_account' => $request->faccount,
                'friend_account' => $request->faccount
            ]);
        }


        $contact = Contact::where(['user_account' => $request->maccount, 'friend_account' => $request->faccount])->first();

        if ($contact != null) {
            return response()->json(array(
                'code' => -1,
                'msg' => 'exist'
            ));
        }

        Contact::create(['user_account' => $request->maccount, 'friend_account' => $request->faccount]);

        Contact::create(['friend_account' => $request->maccount, 'user_account' => $request->faccount]);

        return response()->json(array(
            'code' => 1,
            'msg' => 'success'
        ));

    }

    public function findfriends(Request $request)
    {

        $users = User::where('email', 'like', '%' . $request->info . '%')->get();
        return view('smart.findresult', compact('users'));


    }




    public function startserver(Request $request)
    {
require_once 'server.php';
$ws = new \WebSocket("0.0.0.0", "8989");


}
    public function show(Request $request)
    {

        if (isset ($_COOKIE ['fullname'])) {

            if ($_COOKIE ['fullname'] != null) {
                $account = $_COOKIE['account'];

                $files = File::where(['status' => 'ison', 'user_account' => $account])->orderBy('updated_at', 'desc')->get();
                $sendfiles = array();
                $sendfolders = array();

                foreach ($files as $file) {
                    if ($file->filetype == 'folder') {
                        $sendfolders[] = $file;
                    } else {
                        $sendfiles[] = $file;
                    }
                }

                $contact = Contact::where(['user_account' => $_COOKIE['account'], 'friend_account' => $_COOKIE['account']])->first();


                if ($contact == null) {
                    $faces = array('images/avatar1.jpg', 'images/avatar2.jpg', 'images/avatar3.jpg', 'images/avatar4.jpg', 'images/avatar5.jpg'
                    , 'images/avatar6.jpg', 'images/avatar7.jpg', 'images/avatar8.jpg', 'images/avatar9.jpg', 'images/avatar10.jpg', 'images/avatar11.jpg'
                    , 'images/avatar12.jpg', 'images/avatar13.jpg');

                    $face = $faces[rand(0, 12)];
                    
                    Contact::create([
                        'user_account' => $_COOKIE['account'],
                        'friend_account' => $_COOKIE['account'],
                        'face' => $face
                    ]);
                }


                $contacts = Contact::where("user_account", $_COOKIE['account'])->get();

                $resultdir = array();

                $mine = array();

                $friends = array();

                $catalog = array();

                $group = array();

                $catalog['groupname'] = "My Friends";
                $catalog['id'] = 1;
                $catalog['online'] = 2;

                $list = array();

                foreach ($contacts as $contact) {
                    if ($contact->friend_account == $_COOKIE['account']) {
                        $mine['username'] = $contact->friend_account;
                        $mine['id'] = $contact->contact_id;
                        $mine['status'] = "online";
                        $mine['remark'] = $contact->signature;
                        $mine['avatar'] = $contact->face;
                    } else {
                        $tempone = array();
                        $tempone['username'] = $contact->friend_account;
                        $basic = getFriendBasic($contact->friend_account);
                        $tempone['id'] = $basic['id'];
                        $tempone['avatar'] = $basic['face'];
                        $tempone['sign'] = $contact->signature;
                        $list[] = $tempone;
                    }
                }
                $catalog['list'] = $list;

                $friends[] = $catalog;

                $resultdir['mine'] = $mine;

                $resultdir['friend'] = $friends;

                $resultdir['group'] = $group;

                $data = json_encode(array(
                    "code" => 0,
                    'msg' => "",
                    'data' => $resultdir
                ));


                return view('smart.contact', compact('sendfiles', 'sendfolders', 'data'));
            }


        }
        return redirect()->route('index');

    }

    public function addfriend(Request $request)
    {

        $contact = Contact::create([
            'user_account' => $request->friendname,
            'friend_account' => $request->accountforlogin
        ]);

$contact = Contact::create([
            'friend_account' => $request->friendname,
            'user_account' => $request->accountforlogin
        ]);



        if ($contact != null) {
            return response()->json(array(
                'status' => 1,
                'msg' => "success"
            ));
        }

        return response()->json(array(
            'status' => -1,
            'msg' => "error"
        ));


    }


    public function refreshfriend(Request $request)
    {

        $contacts = Contact::where('user_account', $request->accountforlogin)->orderBy('updated_at', 'desc')->get();

        $contactarr = array();

        foreach ($contacts as $contact) {
            $contactarr[] = $contact->friend_account;
        }

        return response()->json(array(
            "friendarray" => $contactarr
        ));

    }


    public function handlemessage(Request $request)
    {


        $sender = $request->sender;
        $receiver = $request->receiver;
        $pushmessage = $request->message;

        $contact = Contact::where(['user_account' => $receiver, 'friend_account' => $receiver])->first();
        $channelId = $contact->channel;
        $messageset = array();
        $messageset[0] = "thisismessage";
        $messageset[1] = $pushmessage;

        require_once 'sdk.php';
        $sdk = new \PushSDK();

        // 设置消息类型为 通知类型.
        $opts = array(
            'msg_type' => 0
        );

        // 向目标设备发送一条消息
        $rs = $sdk->pushMsgToSingleDevice($channelId, $messageset, $opts);

        // 判断返回值,当发送失败时, $rs的结果为false, 可以通过getError来获得错误信息.
        if ($rs === false) {
            print_r($sdk->getLastErrorCode());
            print_r($sdk->getLastErrorMsg());
        } else {
            // 将打印出消息的id,发送时间等相关信息.
            print_r($rs);
        }

        $sdk = new \PushSDK();

        $message = array(
            // 消息的标题.
            'title' => $sender,
            // 消息内容
            'description' => $pushmessage
        );
        // 设置消息类型为 通知类型.
        $opts = array(
            'msg_type' => 1
        );

        // 向目标设备发送一条消息
        $rs = $sdk->pushMsgToSingleDevice($channelId, $message, $opts);

        // 判断返回值,当发送失败时, $rs的结果为false, 可以通过getError来获得错误信息.
        if ($rs === false) {
            print_r($sdk->getLastErrorCode());
            print_r($sdk->getLastErrorMsg());
        } else {
            // 将打印出消息的id,发送时间等相关信息.
            print_r($rs);
        }

        echo "done";

    }


    public function handlefile(Request $request)
    {
        $sender = $request->sender;
        $receiver = $request->receiver;
        $filename = $request->filename;

        $contact = Contact::where(['user_account' => $receiver, 'friend_account' => $receiver])->first();
        $channelId = $contact->channel;

        require_once 'sdk.php';
        $sdk = new \PushSDK();

        $messageset = array();
        $messageset[0] = $sender;
        $messageset[1] = $filename;

        $opts = array(
            'msg_type' => 0
        );

        // 向目标设备发送一条消息
        $rs = $sdk->pushMsgToSingleDevice($channelId, $messageset, $opts);

        // 判断返回值,当发送失败时, $rs的结果为false, 可以通过getError来获得错误信息.
        if ($rs === false) {
            print_r($sdk->getLastErrorCode());
            print_r($sdk->getLastErrorMsg());
        } else {
            //将打印出消息的id,发送时间等相关信息.
            print_r($rs);
        }

        echo "done";
    }


    public function deletefriend(Request $request)
    {


        Contact::where(['user_account' => $request->accountforlogin, 'friend_account' => $request->deletename])->delete();

        Contact::where(['user_account' => $request->deletename, 'friend_account' => $request->accountforlogin])->delete();

        return response()->json(array(
            'status' => 1,
            'state' => "success"
        ));


    }


    public function searchfriend(Request $request)
    {


        $user = User::where('email', $request->searchcontent)->first();


        if ($user != null) {

            return response()->json(array(
                'status' => 1,
                'state' => $user->email
            ));

        }

        return response()->json(array(
            'status' => -1,
            'state' => ""
        ));
    }


    public function getprocess(Request $request)

    {
        $processes = ContactProcess::where(['receiver' => $request->username])->get();

        $processarr = array();

        foreach ($processes as $process) {
            $processarr[] = $process->sender;
        }


        return response()->json(array(
            'requestlist' => $processarr
        ));

    }


    public function getBaseInfo(Request $request)
    {


        $contacts = Contact::where("user_account", $request->mine)->get();

        $resultdir = array();

        $mine = array();

        $friends = array();

        $catalog = array();

        $group = array();

        $catalog['groupname'] = "My Friends";
        $catalog['id'] = 1;
        $catalog['online'] = 2;

        $list = array();

        foreach ($contacts as $contact) {
            if ($contact->friend_account == $request->mine) {
                $mine['username'] = $contact->friend_account;
                $mine['id'] = $contact->contact_id;
                $mine['status'] = "online";
                $mine['remark'] = $contact->signature;
                $mine['avatar'] = $contact->face;
            } else {
                $tempone = array();
                $tempone['username'] = $contact->friend_account;
                $tempone['id'] = getFriendBasic($contact->friend_account)['id'];
                $tempone['avatar'] = getFriendBasic($contact->friend_account)['face'];
                $tempone['sign'] = $contact->signature;
                $list[] = $tempone;
            }
        }
        $catalog['list'] = $list;

        $friends[] = $catalog;

        $resultdir['mine'] = $mine;

        $resultdir['friend'] = $friends;

        $resultdir['group'] = $group;

        echo json_encode(array(
            "code" => 0,
            'msg' => "",
            'data' => $resultdir
        ));
        return;


    }


    public function addfriendprocess(Request $request)
    {

        $contactprocess = ContactProcess::where(['sender' => $request->sender, 'receiver' => $request->receiver])->first();

        if ($contactprocess == null) {

            ContactProcess::create([
                'sender' => $request->sender,
                'receiver' => $request->receiver
            ]);

            $contact = Contact::where(['user_account' => $request->receiver, 'friend_account' => $request->receiver])->first();

            if ($contact == null) {
                return;
            }

            $channelId = $contact->channel;


            require_once('sdk.php');

            $sdk = new \PushSDK();

            $message = array(
                'title' => 'New Friend!',
                'description' => $request->sender
            );

            $opts = array(
                'msg_type' => 1
            );

            $rs = $sdk->pushMsgToSingleDevice($channelId, $message, $opts);

            if ($rs === false) {
                print_r($sdk->getLastErrorCode());
                print_r($sdk->getLastErrorMsg());
            } else {
                print_r($rs);
            }
            echo 'success';
            return;


        }
    }

}


function getFriendBasic($faccount)
{
    $basic = array();
    $contact = Contact::where(['user_account' => $faccount, 'friend_account' => $faccount])->first();
    $basic['id'] = $contact->contact_id;
    $basic['face'] = $contact->face;

    return $basic;
}



