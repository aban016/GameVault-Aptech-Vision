<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gameplay extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'video',
        'thumbnail',
        'uploaded_by',
    ];

    /**
     * Get the user who uploaded the gameplay video.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
