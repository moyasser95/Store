<?php

namespace App\Http\Controllers\dashboard\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('dash.login');
    }
}
