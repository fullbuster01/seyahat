<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserActivationEmail;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ActivationResendController extends Controller
{
    public function showResendForm()
    {
        return view('email.auth.activate.resend');
    }

    public function resend(Request $request)
    {
        $this->validateResendRequest($request);
        
        $user = User::where('email', $request->email)->first();

        // memanggil event
        event(new UserActivationEmail($user));

        return redirect()->back();
    }

    protected function validateResendRequest(Request $reques)
    {
        $this->validate($reques, [
            'email' => 'required|email|exists:users,email',

        ],[
            'email.exists' => 'This email is not exists. Please check your email'
        ]);
    }
}
