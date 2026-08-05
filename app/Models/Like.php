<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_commentaire',
        'like',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function commentaire()
    {
        return $this->belongsTo(Commentaire::class, 'id_commentaire');
    }
}
