<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Photo;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
  
    public function index()
    {
        $photos=Photo::orderBy('updated_at','desc')->take(12)->get();
        return view('web.main')->with('photos', $photos);
    }
  
    public function showLogin()
    {
       return view('web.login');
    }
  
  
    public function showRegister()
    {
        return view('web.register');
    }
    
  
}