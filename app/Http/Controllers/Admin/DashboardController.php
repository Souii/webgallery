<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.images.index', compact('categories'));
    }
}
