<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;
use App\Http\Requests\ContactFormRequest;

class ContactFormController extends Controller
{
    //
    private $formItems = ['name', 'email', 'contact'];

    public function index()
    {
        //
        return view('contact.index');
    }

    public function post(ContactFormRequest $request)
    {
        //
        $input =$request->only($this->formItems);
        $request->session()->put('form_input', $input);
        return redirect()->action('ContactFormController@confirm');
    }

    public function confirm(Request $request)
    {
        //
        $input = $request->session()->get('form_input');

        if(!$input) {
            return redirect('contact/index');
        }
        return view('contact.confirm', [
            'input' => $input,
        ]);
    
    }
    public function send(Request $request)
    {
        //
        $input = $request->session()->get('form_input');

        //戻るボタンが押された時
        if($request->has('back')) {
            return redirect('contact/index')->withInput($input);
        }

        //中身がからの時
        if(!$input) {
            return redirect('contact/index');
        }

        //入力されたメールアドレスにメールを送信
        //Mail::to($input['email'])->send(newContactFormmail($input));

        //再送信を防ぐためにトークンを再発行
        //$request->session()->regenerateToken();

        //DB登録
        ContactForm::create($input);

        $request->session()->forget('form_input');
        return redirect('contact/thanks');
        
    }

    public function thanks()
    {
        return view('contact.thanks');
    }


}
