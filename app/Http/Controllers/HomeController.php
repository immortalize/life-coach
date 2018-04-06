<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');        
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $returning_user = Cookie::get('visited');
        if (!$returning_user){
            Cookie::queue('visited', '1', 60*24*30);
        }

            return view('welcome1',[
                'returning_user' => $returning_user
            ]);
    }    
}
