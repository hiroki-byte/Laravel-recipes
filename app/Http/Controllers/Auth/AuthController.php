<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RecipesController;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\SignupFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function showSignup()
    {
        return view('login.signup_form');
    }



    /**
     * @param App\Http\Requests\SignupFormRequest;
     * $request
     */
    public function Signup(SignupFormRequest $request){
        $DefaultUsers = User::all();
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $password1 = $request->input('password1');
        $password2 = $request->input('password2');
        foreach($DefaultUsers as $DefaultUser){
            if($DefaultUser->email === $user->email){
                return back()->withErrors([
                    'signup_error' => '既にそのEメールアドレスは登録済みです。',
                ]);
            }
        }
        if($password1 === $password2){
            $user->password = Hash::make($password1);
            $user->save();
            return redirect()->route('login.show')->with([
                'signup' => 'アカウント作成完了しました！'
            ]);
        }else{
            return back()->withErrors([
                'signup_error' => 'パスワード(確認用)に正しいパスワードを入力してください。',
            ]);
        }
        
    }

    /**
    * @param App\Http\Requests\LoginFormRequest
    * $request
    */
    public function Login(LoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');   
        $user = $this->user->getUserByEmail($credentials['email']);
        if(!is_null($user)){
            if($this->user->isAccountLocked($user)){
                return back()->withErrors([
                    'login_error' => 'アカウントがロックされています。',
                ]);
            }
            if(Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                $this->user->resetErrorCount($user);
                $recipesController = new RecipesController();
                return redirect()->route('home')->with([
                    'login_success' => 'ログイン成功しました！',
                ]);
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


    public function guest(Request $request)
    {
      $guestUserId = 1; //ゲストユーザーのIDを１とする
      $user = User::find($guestUserId);
      Auth::login($user);
      $request->session()->regenerate();
      $this->user->resetErrorCount($user);
      $recipesController = new RecipesController();
      return redirect()->route('home')->with([
          'login_success' => 'ログイン成功しました！',
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
