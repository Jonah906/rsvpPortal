<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function venue()
    {
        return view('frontend.venue');

    }

    public function committee()
    {
        return view('frontend.committee');

    }

    public function vehicle()
    {
        return view('frontend.vehicle');

    }

    public function cloth()
    {
        return view('frontend.cloth');

    }

    

    
}
