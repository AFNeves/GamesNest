<?php
namespace App\Http\Controllers;

class ProductController extends Controller{
    public function show(){

        return view('pages.products');
    }
    
}