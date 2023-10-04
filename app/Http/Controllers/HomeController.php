<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }


    public function contact(Request $request){

        //  return [$data=$request->all()];

        return view('contact');

   }

    public function contactUs(Request $request){

         //  return [$data=$request->all()];

           $data=['result'=>$request->all()];
           return $data;

    }
}
