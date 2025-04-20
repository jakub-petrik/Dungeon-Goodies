<?php

namespace App\Http\Controllers;

class MainPageController extends Controller
{
    public function showMainPage()
    {
        return view('layouts.Main_Page');
    }
}

