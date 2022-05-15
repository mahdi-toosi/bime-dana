<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function showResetForm()
    {
        return view("auth.forgetPassword");
    }

    public function showPasswordSetForm()
    {
        $registerRecently = request("registerRecently") ?? 0;
        return view("auth.setPassword", compact("registerRecently"));
    }

    public function setAndReset()
    {
        request()->validate([
            "password" => "required|min:8|confirmed",
        ]);
        if (session("registerRecently")) {
            //set
            $data = [
                "name" => session("name"),
                "phone" => session("phone"),
                "password" => request("password"),
                "exam_left" => 3
            ];
            $controller = new RegisterController;
            $user = $controller->create($data);
            Auth::guard()->login($user);
            session()->forget(["phone", "code", "name"]);
            return redirect()->route("login");
        } else {
            //reset
            $user = User::where("phone", session("phone"))->first();
            $user->password = Hash::make(request("password"));
            $user->save();
            return redirect()->route("login")->with("forgetPassword", "رمز عبور شما با موفقیت تغییر یافت.");
        }
    }

    public function resetPasswordSendCode()
    {
        request()->validate([
            "phone" => "required|numeric|digits:11"
        ]);
        $code = rand(1111, 9999);
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, 'https://api.kavenegar.com/v1/7150787475456A5371544D6D5978637553634351424A39626F356F4C584D6A7A366C4876695055465662383D/verify/lookup.json?receptor=' . request("phone") . '&token=' . $code . '&template=verification');
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($handle);
        $json_response = json_decode($response);
        $result = $json_response->entries;
        if ($result[0]->status) {
            session(["phone" => request("phone"), "code" => $code, "registerRecently" => "0"]);
            return redirect()->route("get.code");
        } else {
            return redirect()->back()->with("status", "در عملیات ارسال پیامک مشکل به وجود آمده است. Error Code : 500");
        }
    }
}
