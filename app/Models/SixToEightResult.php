<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SixToEightResult extends Model
{
    protected $table = 'six_to_eight_results';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}
