<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCQuestion extends Model
{
    use HasFactory;
    protected $table = 'mcquestion';
    protected $fillable = [
        'QImage',
        'Option1',
        'Option2',
        'Option3',
        'Option4',
        'Answer',
        'chapter_id'
    ];
    public function chapter()
{
    return $this->belongsTo(Chapter::class);
}


}