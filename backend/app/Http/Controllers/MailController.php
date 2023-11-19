<?php

namespace App\Http\Controllers;

use App\Service\MoneyConverter;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;

class MailController extends Controller
{
    public function mail(Request $request)
    {
        $to_name = 'RECEIVER_NAME';
        $to_email = 'RECEIVER_EMAIL_ADDRESS';
        $data = array('name'=>'Ogbonna Vitalis(sender_name)', 'body' => 'A test mail');
        \Mail::send('emails.mail', $data, function(Message $message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Laravel Test Mail')
                ->from('SENDER_EMAIL_ADDRESS', 'Test Mail');
        });

        return response();
    }
}
