<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;


class HomeController extends Controller
{
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->getAll();

        return view('index', compact('categories'));
    }
}
