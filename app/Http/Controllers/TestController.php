<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index()
    {
        $book=["name"=>"book","price"=>"100"];
        return response()->json($book);
    }
}
