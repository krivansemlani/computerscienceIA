<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapter';
    protected $fillable = ['CName', 'CDescription', 'subject_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function mcquestions()
    {
        return $this->hasMany(MCQuestion::class);
    }
    public function qrqquestions()
{
    return $this->hasMany(RevisionQuestion::class);
}

    
    



}
