<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'url', 
        'id_user', 
        'commentaire', 
        'like',
    ];

    // Define relationships 
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function commentaires()
    {
        return $this->hasMany(Comment::class, 'id_commentaire');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_commentaire');
    }

    public function updateLikeCount()
    {
        $this->likes_count = $this->likes->count();
        $this->save();
    }
}
