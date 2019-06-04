<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attandance;
use App\User;

class AdminController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(request $request)
    {
        
        $start = (!empty($request->start_date)) ? ($request->start_date) : ('');
        $end = (!empty($request->end_date)) ? ($request->end_date) : ('');

        if(!empty($start) && !empty($end)){
    
            $start_date = date('Y-m-d ', strtotime($start));
            $end_date = date('Y-m-d', strtotime($end));
            $start_date .= ' 00:00:00';
            $end_date .= ' 23:59:59';
            $attandance_dates = Attandance::selectRaw('distinct(date(created_at)) as date')->whereBetween('created_at', [$start_date, $end_date])->get()->toArray();
            $user_attandances = User::with(['attandance'=>function($query) use ($start_date ,  $end_date){
                $query->whereBetween('created_at', [$start_date, $end_date]);
                    } ])->where('user_type','User')->get()->toArray();
        }else{
            $attandance_dates = Attandance::selectRaw('distinct(date(created_at)) as date')->get()->toArray();
            $user_attandances = User::with(['attandance'])->where('user_type','User') ->get()->toArray();
        }
//        echo "<pre>";
//        print_r($attandance_dates);
//        print_r($user_attandances);
//        echo "</pre>";
//        die();
        
        return view('report',compact('attandance_dates', 'user_attandances', 'start', 'end'));
        
    }
    
}
