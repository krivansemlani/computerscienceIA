<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subject'; // Make sure it matches your table name

    protected $fillable = ['SName', 'SDescription'];

    // Define the relationship: Subject has many chapters
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
