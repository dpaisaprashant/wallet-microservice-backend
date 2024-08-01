<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog\Post;


class ApiController extends Controller
{
    function getData(){
        return Post::all();
    }
}

