<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $fillable = [
        'subject',
        'detail',
        'attach_file',
        'contact_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'contact_by');
    }
}
