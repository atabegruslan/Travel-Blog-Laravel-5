<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Mail;

class EmailController extends Controller
{
	public function send(Request $request)
	{
        $this->validate($request, [
            'name' => 'required|max:40',
            'email' => 'required|email|max:40',
            'subject' => 'required|max:40',
            'body' => 'required|max:200'
        ]); 

        $data = array(
			'name' => $request->name,
			'email' => $request->email,
			'subject' => $request->subject,
			'body' => $request->body
        );

		Mail::send(
			'email.admin',
			$data, 
			function($message) use ($data) {
				$message->from( $data['email'] );
				$message->to('ruslan_aliyev_@hotmail.com')->subject( $data['body'] );
			}
		);

		Mail::send(
			'email.enquirer',
			$data, 
			function($message) use ($data) {
				$message->from('ruslan_aliyev_@hotmail.com');
				$message->to( $data['email'] )->subject( $data['body'] );
			}
		);

        \Session::flash('success', 'Email Sent');

		return Redirect::to('/contact');
	}
}
