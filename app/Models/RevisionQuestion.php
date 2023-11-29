<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionQuestion extends Model
{
    protected $table = '_q_r_question';
    use HasFactory;

    protected $fillable = ['QImage', 'AImage', 'chapter_id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    

}