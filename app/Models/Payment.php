<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'classroom_id',
        'status'
    ];

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class,'classroom_id');
    }


    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

}
