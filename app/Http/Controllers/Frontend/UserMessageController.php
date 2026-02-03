<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserMessageController extends Controller
{
    public function submit(Request $request)
    {
//        return $request;
        $request->validate([
            'email'     => ['required', 'email'],
            'subject'   => ['required'],
            'message'   => ['required'],
        ]);
        UserMessage::add($request);
        Session::flash('success','Message Has Been Sent Successfully.');
        return back();
    }

    public function list()
    {
        $data['items'] = UserMessage::latest()->get();
        return view('backend.message.list', $data);
    }
}
