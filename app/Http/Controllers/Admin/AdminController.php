<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     // Middleware hasn't run yet during construct, need to call it explicitly
    //     $this->middleware(function ($request, $next) {

    //         // compare if user is admin
    //         $this->user = Auth::user();
    //         if ($this->user->privilige != 1){
    //             return redirect('home');
    //         }
    //         // else continue
    //         return $next($request);
    //     });
    // }

    /**
     * Show the application home screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminPanelView()
    {
        return view('admin.admin');
    }


}
