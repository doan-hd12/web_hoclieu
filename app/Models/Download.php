<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Download;

class Download extends Model
{
    use HasFactory;
   
protected $fillable = [
    'user_id',
    'document_id',
];

public function document()
{
    return $this->belongsTo(Document::class);
}

}
