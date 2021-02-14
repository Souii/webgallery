<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = $this->repository->getAll();

        return view('admin.category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->repository->save(['name' => $request->name]);

        return redirect()->route('category.index');
    }
}
