<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StaticController extends Controller
{
    public function contact() {
        $name = "Eric";
        $email = "tawe141@gmail.com";
        $phone = "4089660800";
        return view('contact')->with([
            'name' => $name,
            'email' => $email,
            'phone' => $phone
            ]);
    }
    public function search () {
        return view('search');
    }
}
