<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
// use App\Http\Controllers\Auth;
use App\Mail\EmailVerification;
use App\Mail\RegEmail;
use Carbon\Carbon;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

     // Mail::to('email')->send(new Reg($data));

    protected $redirectTo = '/';

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

     //仮会員登録 確認画面
     public function pre_check(Request $request){
         $request->flashOnly( 'email');
         // dd($request->all());
         $bridge_request = $request->all();

         return view('auth.register_check')->with($bridge_request);
     }

     //仮会員登録 メール送信
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            // 'password' => Hash::make($data['password']),
            'email_verify_token' => base64_encode($data['email']),
        ]);

        $email = new EmailVerification($user);
        Mail::to($user->email)->send($email);

        return $user;

    }

    //仮会員登録完了画面
    public function register(Request $request){
        event(new Registered($user = $this->create( $request->all() )));

        return view('auth.registered');
    }

    //本会員登録 入力画面
    public function showForm($email_token)
    {
        // 使用可能なトークンか
        if ( !User::where('email_verify_token',$email_token)->exists() )
        {
            return view('auth.main.register')->with('message', '無効なトークンです。');
        } else {
            $user = User::where('email_verify_token', $email_token)->first();
            // 本登録済みユーザーか
            if ($user->status == config('const.USER_STATUS.REGISTER')) //REGISTER=1
            // if ($user->status == 1) //REGISTER=1
            {
                logger("status". $user->status );
                return view('auth.main.register')->with('message', 'すでに本登録されています。ログインして利用してください。');
            }
            // ユーザーステータス更新
            $user->status = config('const.USER_STATUS.MAIL_AUTHED');
            $user->created_at = Carbon::now();
            if($user->save()) {
                return view('auth.main.register', compact('email_token'));
            } else{
                return view('auth.main.register')->with('message', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
            }
        }
      }

    //本会員登録 登録確認画面
    public function mainCheck(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'password' => 'required|string|min:6|confirmed',
    ]);
    // データ保持用
    $email_token = $request->email_token;
    $user = new User();
    $user->name = $request->name;

    $user->password = $request->password;

    return view('auth.main.register_check', compact('user','email_token'));
  }

  //本会員登録 登録画面
  public function mainRegister(Request $request)
  {
    $user = User::where('email_verify_token',$request->email_token)->first();
    // dd($request->name);
    $user->status = config('const.USER_STATUS.REGISTER');
    $user->name = $request->name;
    $user->password = Hash::make($request->password);
    $user->save();

    $email = new RegEmail($user);
    Mail::to($user->email)->send($email);

    return view('auth.main.registered');
  }

}
