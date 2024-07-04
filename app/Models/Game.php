<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'sale',
        'availability',
        'rating',
        'user_id',
        'release_year',
        'developer',
        'platform',
        'installation_file',
        'image1',
        'image2',
        'image3',
        'image4',
        'video'
    ];

    // Game belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
