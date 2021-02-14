<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $with = ['tags'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'original',
        'thumbnail',
        'category_id',
        'title',
        'description'
    ];

    public static function new(
        $original,
        $thumbnail,
        $category,
        $title,
        $description
    ): self
    {
        return static::create([
            'original' => $original,
            'thumbnail' => $thumbnail,
            'category_id' => $category,
            'title' => $title,
            'description' => $description
        ]);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
