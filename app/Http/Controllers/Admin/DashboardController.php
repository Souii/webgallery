<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;

class DashboardController extends Controller
{
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->getAll();

        return view('admin.images.index', compact('categories'));
    }
}
