<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_comment', 'id_comment_user', 'like'
    ];

    // Define relationships here if applicable
    
    public function users()
    {
        return $this->belongsTo(Users::class, 'id_user');
    }

    public function commentaires()
    {
        return $this->belongsTo(commentaire::class, 'id_commentaire');
    }

    public function comments()
    {
        return $this->belongsTo(Comment::class, 'id_comment');
    }
    
}
