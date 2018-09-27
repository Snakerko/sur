<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    public function execute(Request $request)
    {
        $this->user= User::where('id', Auth::user()->id)->first();
        if($request->isMethod('post')) 
        {
            $this->user->fill([
                    'username'=>$_POST['name'],
                    'gender'=>$_POST['sexfield']
                    ]);
            $this->user->save();
        }

        $title = 'Личный кабинет';
            
        return view('www.content', ['title'=>$title,'user'=>$this->user]);
    }
}
