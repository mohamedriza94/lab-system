<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function passwordChangeVerify(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:patients,email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('patient.passwordChange')->with([
                'failure' => 'Could not verify account',
                'verified' => false
            ]);
        }

        $exists = Patient::where('email',$request->input('email'))->exists();

        if($exists){
            $token = rand(100000, 999999);

            $passwordToken = New PasswordResetToken;
            $passwordToken->email = $request->input('email');
            $passwordToken->token = $token;
            $passwordToken->created_at = NOW();
            $passwordToken->save();

            //Mailing Credentials
            $data["email"] = $request->input('email');
            $data["title"] = "Password Reset ".$token;
            $data["token"] = $token;

            Mail::send('mail.passwordReset', $data, function($message)use($data) {
                $message->to($data["email"], $data["email"])
                ->subject($data["title"]);
            });

            return redirect()->route('patient.passwordChange')->with([
                'success' => 'Reset token was sent to your email.',
                'verified' => true,
                'email' => $request->input('email')
            ]);
        }
        return redirect()->route('patient.passwordChange')->with([
            'failure' => 'Could not verify account',
            'verified' => false
        ]);
    }

    public function verifyOTP(Request $request)
{
    // Validate request data including token, new password, and password confirmation
    $validator = Validator::make($request->all(), [
        'email' => 'required|exists:patients,email',
        'token' => 'required',
        'password' => 'required|min:6|confirmed', // Ensure the password is confirmed and meets any specific requirements
    ]);

    if ($validator->fails()) {
        return redirect()->route('patient.passwordChange')->with('failure', 'Validation failed')->withErrors($validator);
    }

    $tokenRecord = PasswordResetToken::where('email', $request->email)
                                      ->where('token', $request->token)
                                      ->where('created_at', '>=', Carbon::now()->subMinutes(10))
                                      ->first();

    if (!$tokenRecord) {
        return redirect()->route('patient.passwordChange')->with('failure', 'Token is invalid or expired');
    }

    // Token valid, proceed with updating the patient's password
    $patient = Patient::where('email', $request->email)->first();
    $patient->password = Hash::make($request->password);
    $patient->save();

    // Optionally, delete the token record to prevent reuse
    $tokenRecord->delete();

    return redirect()->route('patient.login')->with('success', 'Your password has been reset successfully');
}
}
