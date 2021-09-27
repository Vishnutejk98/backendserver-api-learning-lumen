<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index(){
        $data = ["hello"=>"vishnu"];
        $user["to"] = "mailboxnumber04@gmail.com";
        Mail::send('mail',$data,function($message) use ($user){
            $message->to('mailboxnumber04@gmail.com');
            $message->subject("Hello Dev");
        });
    }
}
