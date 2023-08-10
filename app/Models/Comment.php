<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user', 
        'id_commentaire', 
        'comment', 
        'like'
    ];

    // Define relationships here if applicable
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function commentaires()
    {
        return $this->belongsTo(Commentaire::class, 'id_commentaire');
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'id_comment');
    }
}
