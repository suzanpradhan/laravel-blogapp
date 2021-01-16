<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "This is index Page.";
        // return view("pages.index", compact("title"));
        return view("pages.index")->with("title", $title);
    }

    public function about(){
        return view("pages.about");
    }
    
    public function services(){
        $data = array(
            "title"=> "This is Service Page.",
            "services"=> ["Service1", "Service2", "Service3"]
        );
        return view("pages.services")->with($data);
    }
}
