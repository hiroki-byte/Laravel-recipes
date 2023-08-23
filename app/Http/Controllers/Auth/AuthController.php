<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
    * @return View
    */
    public function showLogin()
    {
        return view('login.login_form');
    }

    /**
    * @param App\Http\Requests\LoginFormRequest
    * $request
    */
    public function Login(LoginFormRequest $request)
    {
        $credentials = $request->only('email','password');
        $user = $this->user->getUserByEmail($credentials['email']);
        if(!is_null($user)){
            if($this->user->isAccountLocked($user)){
                return back()->withErrors([
                    'login_error' => 'アカウントがロックされています。',
                ]);
            }
            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
                $this->user->resetErrorCount($user);
                return redirect()->route('home')->with('login_success','ログイン成功しました！');
            }
            $user->error_count = $this->user->addErrorCount($user->error_count);
            if($this->user->lockAccount($user)){
                return back()->withErrors([
                    'login_error' => 'アカウントがロックされました。',
                ]);
            }
            $user->save();
        }

        return back()->withErrors([
            'login_error' => 'メールアドレスかパスワードが間違っています。',
        ]);
    }
     /**
     * ユーザーをアプリケーションからログアウトさせる
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.show')->with
        ('logout','ログアウトしました！');
    }
}
