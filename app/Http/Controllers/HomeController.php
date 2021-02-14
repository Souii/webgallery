<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $images = (Image::with('tags')->get());

        return view('index', compact('categories', 'images'));
    }
}
