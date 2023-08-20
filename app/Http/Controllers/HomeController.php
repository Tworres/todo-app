<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $todos = (new Todo())->all();
        return view('content/home', ['todos' => $todos]);
    }
}
