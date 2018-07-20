<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Mail;
// use App\Http\Controllers\Reminder;
use App\Mail\Reminder;
use Illuminate\Mail\Mailable;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('contacts.index');
    }


    public function confirm(Request $request){

      $token = md5(uniqid(rand(), true));
      // $_SESSION['token'] = $token;

      $request->session()->put('name', $request->input('name'));
      $request->session()->put('email', $request->input('email'));
      $request->session()->put('message', $request->input('message'));
      $request->session()->put('token', $token);
      //dd($request->session());

      $name = $request->session()->get('name');
      $email = $request->session()->get('email');
      $message = $request->session()->get('message');

      $this->validate($request, [
        'name' => 'required',
        'email'=>'required',
        'message'=>'required',
      ]);

      // dd($name);
      return view('contacts.confirm')
        ->with(['name'=> $name,'email'=>$email,'message'=>$message,'token'=>$token]);
      // dd($request->all());

    }

    public function complete(Request $request){

      // return view('contacts.complete');

      $action=$request->get('action','back');
      $post_token=$request->get('token');
      // $input=session()->get('name');
      // $input=session()->get('email');
      // $input=session()->get('message');
      // dd($input);
      if($action === '送信'){
        if($request->session()->get('token') !== $post_token){
          return redirect('/');
        }

        $contact = new Contact();
        $contact->name = session()->get('name');
        // dd($contact->name);

        $contact->email = session()->get('email');
        $contact->message = session()->get('message');
        $contact->save();
        // $request->session()->flush();
        $request->session()->forget('name');
        $request->session()->forget('message');
        $request->session()->forget('token');

        $data = [$contact];
        // dd($contact->email);
        Mail::to($contact->email)->send(new Reminder($contact));

        return view('contacts.complete');

      }else{
// dd(session()->get('email'));
        return redirect()->action('ContactController@index')
        ->withInput([
          'name'=>session()->get('name'),
          'email'=>session()->get('email'),
          'message'=>session()->get('message'),
        ]);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($contact);
        $contact=new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->contact = $request->contact;
        $contact->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
