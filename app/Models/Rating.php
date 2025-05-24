<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    // app/Models/Rating.php

protected $fillable = [
    'rating',
    'user_id',  // Thêm dòng này
    'document_id',
];

}
