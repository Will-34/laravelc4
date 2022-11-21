<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $parControl=[
        'modulo'=>'home',
        'funcionalidad'=>'',
        'titulo' =>'Home',
    ];
    
    public function __invoke() {

        return view('home',['parControl'=>$this->parControl]);
    }
}
