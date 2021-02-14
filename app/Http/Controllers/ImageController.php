<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Repositories\ImageRepository;

class ImageController extends Controller
{
    public function index(Request $request, ImageRepository $images)
    {
        $number = $request->number < 1 ? 1 : $request->number;

        return $images->getFiltered(
            [
                'category' => $request->category,
                'tag' => $request->tag,
            ],
            $number
        );
    }
}
