<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'user_id',
        'subject_id',
        'major_id',
    ];
   

    public function downloads()
    {
        return $this->hasMany(\App\Models\Download::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}
public function major()
{
    return $this->belongsTo(Major::class, 'major_id');
}




}
