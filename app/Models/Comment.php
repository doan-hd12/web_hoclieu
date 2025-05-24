<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function user()
{
    return $this->belongsTo(User::class);
}

public function document()
{
    return $this->belongsTo(Document::class);
}

protected $fillable = [
    'content',
    'rating',
    'parent_id',
    'user_id', // Thêm dòng này
    'document_id',
];

public function replies()
{
    return $this->hasMany(Comment::class, 'parent_id');
}

public function parent()
{
    return $this->belongsTo(Comment::class, 'parent_id');
}




    
}
