<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use App\Models\Comment;

class UserController extends Controller
{
    public function register(RegistrationRequest $req) {
        $user = User::create(['name' => $req->name, 'email' => $req->email, 'password' => Hash::make($req->password), 'district' => $req->district, 'status' => 'user']);

        if ($user) {
            Auth::login($user);
            $user_id = User::where("email", $user['email'])->get();
            return redirect('userpage/'.Auth::user()->id);
        }
        
        return response()->json(['status' => 422, 'message' => 'user is failed to be registreted!']);
    }

    public function login(LoginRequest $req){
        $formFields = $req->only(['email', 'password']);

        if(Auth::attempt($formFields)){
            $user = User::where("email", $formFields['email'])->get();
            return redirect('userpage/'.Auth::user()->id);
        }

        return redirect(route('login'))->withErrors([
            'formError' => 'Неверный email или пароль'
        ]);
    }

    public function update(UpdateUserRequest $req) {
        $count = User::where('name', '=', $req->name)->where('email', '=', $req->email)->count();
        if($count > 0) {
            return redirect(route('update'))->withErrors([
                'dataError' => 'Изменения отсутствуют'
            ]);            
        } else {
        User::where('id', '=', Auth::user()->id)->update(['name' => $req->name, 'email' => $req->email]);
        Comment::where('user_id', '=', Auth::user()->id)->update(['user_name' => $req->name]);
        $success_message = $req->session()->put('success_message', 'Изменения внесены в профиль');
        return redirect()->back()->with($success_message);
        }
    }

    public function password_change(PasswordRequest $req){
        $check = Hash::check($req->password, User::find(Auth::user()->id)->password);
        if(!$check){
            return redirect(route('update'))->withErrors([
                'passwordError' => 'Неверный пароль'
            ]);
        } else {
        User::where('id', Auth::user()->id)->update(['password' => Hash::make($req->new_password)]);
        $success_password_message = $req->session()->put('success_password_message', 'Пароль изменён');
        return redirect()->back()->with($success_password_message);
        }
    }
}
