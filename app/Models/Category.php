<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public static function new(string $name): self
    {
        return static::create([
            'name' => $name
        ]);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
