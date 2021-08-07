<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialUser;
use App\Models\User;
use App\Notifications\ForgetPasswordEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        $validateData = Validator::make($data, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);
        if ($validateData->fails()) {
            return responseFail($validateData->errors()->first());
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $user = User::create($data);
        return responseSuccess($user, 'user create successfully');
    }

    public function login(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'email' => 'required_without:phone|email',
            'password' => 'required|string|min:6', //|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/
        ]);

        if ($validateData->fails()) {
            return responseFail($validateData->errors()->first());
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $data = new \stdClass();
            $data->user = $user;
            $data->token = $user->createToken('MyApp')->accessToken;
            return responseSuccess($data, 'logged in successfully');
        }

        return responseFail('Unauthorized', 401);
    }

    public function social_login(Request $request)
    {
        $inputs['social'] = $request->social;
        $inputs['social_id'] = $request->social_id;
        $name = $request->name;
        $social = SocialUser::where('social_id', 'like', '%' . $request->social_id . '%')->where('social', $request->social)->first();

        if ($social) {
            $user = User::where('id', $social->user_id)->first();
        } else {

            $user = User::where(['email' => $request->email])->first();

            if ($user) {
                $inputs['user_id'] = $user->id;
                $social = SocialUser::create($inputs);
            } else {
                $input['name'] = $name;
                $input['email'] = $request->email;
                $input['email_verified_at'] = Carbon::now();
                $input['password'] = Hash::make(Str::random(10));
                $user = User::create($input);

                if (!$user) {
                    return responseFail('something wrong', 406);
                }

                $inputs['user_id'] = $user->id;
                $social = SocialUser::create($inputs);
            }
        }
        if (!$user->email_verified_at) {
            $user->update(['email_verified_at' => Carbon::now()]);
        }
        try {
            Auth::login($user);

            $data = new \stdClass();
            $data->token = $user->createToken('MyApp')->accessToken;
            $data->user = Auth::user();

            return responseSuccess($data);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function forget_password(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validateData->fails()) {
            return responseFail($validateData->errors()->first());
        }

        $user = User::where('email', $request->email)->first();
        $user->update(['code' => rand(1000, 9999)]);

        // try {
            $user->notify(new ForgetPasswordEmail($user->code));
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }

        return responseSuccess([], 'Check Your Email Address.');
    }

    public function new_password(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'code' => 'required|exists:users,code',
            'password' => 'required|min:6',
        ]);

        if ($validateData->fails()) {
            return responseFail($validateData->errors()->first());
        }

        $user = User::where('code', $request->code)->first();
        $user->update(['password' => Hash::make($request->password), 'code' => null]);

        return responseSuccess([], 'password changed successfully');
    }
}
