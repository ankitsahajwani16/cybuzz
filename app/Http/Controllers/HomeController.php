<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attandance;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $attandance = Attandance::where('user_id', auth()->id())
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->first();
        if(empty($attandance)){
        return view('home');
        }else{
            return view('marked');
        }
    }
    
    public function markAttandance(){
       
        $user_id = auth()->id();
        $attandance = Attandance::where('user_id', $user_id)
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->first();
        if(empty($attandance)){
            $attandance = new Attandance;
            $attandance->user_id = $user_id;
            $attandance->save();
        }
        
        return view('marked');
    }
    
    public function error(){
       
               $error ="You don't have access to this page";
        return view('error', compact('error'));
    }
}
