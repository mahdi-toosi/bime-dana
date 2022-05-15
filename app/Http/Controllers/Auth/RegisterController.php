<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'digits:11', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    public function create(array $data)
    {
        $u = new User();
        $u->name = $data['name'];
        $u->phone = $data['phone'];
        $u->password = Hash::make($data['password']);
        $u->exam_left = $data['exam_left'];
        $u->save();
        return $u;
    }

    public function sendCode()
    {
        request()->validate([
            "name" => "required|string|max:30",
            "phone" => "required|numeric|digits:11|unique:users"
        ]);
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'charset: utf-8'
        );
        $code = rand(1111, 9999);
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, 'https://api.kavenegar.com/v1/7150787475456A5371544D6D5978637553634351424A39626F356F4C584D6A7A366C4876695055465662383D/verify/lookup.json?receptor=' . request("phone") . '&token=' . $code . '&template=verification');
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($handle);
        $json_response = json_decode($response);
        $result = $json_response->entries;
        if ($result[0]->status) {
            session(["phone" => request("phone"), "code" => $code, "name" => request("name"), "registerRecently" => "1"]);
            return redirect()->route("get.code");
        } else {
            return redirect()->back()->with("status", "در عملیات ارسال پیامک مشکل به وجود آمده است. Error Code : 500");
        }
    }

    public function showGetCodeForm()
    {
        if (session()->has("code"))
            return view("auth.getCode");
        else
            return abort(403, "شما به این صفحه دسترسی ندارید، به صفحه ثبت نام مراجعه کنید");
    }

    public function getCode()
    {
        request()->validate([
            "code" => "required|numeric|digits:4"
        ]);
        if (request("code") == session("code")) {
            return redirect()->route("set.password");
        } else {
            return redirect()->back()->with("failure", "کد وارد شده صحیح نمی‌باشد.");
        }
    }

    public function clearCode()
    {
        if (session("registerRecently"))
            $url = route("register");
        else
            $url = route("reset.password");
        session()->forget(["phone", "name", "code", "registerRecently"]);
        return response()->json(["whereToGo" => $url]);
    }
}
