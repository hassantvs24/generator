<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommonController extends Controller
{
    public function index()
    {
        return view('main');
    }


    //Toggle Sidebar
    public function saveState()
    {
        if (Session::has('sidebarState')) {
            Session::remove('sidebarState');
        } else {
            Session::put('sidebarState', 'sidebar-xs');
        }
    }
    //Toggle Sidebar
}
