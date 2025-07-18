<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HangController extends Controller
{
    public function hang()
    {
        return view('hangman');
    }
}

?>