<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;


    protected $table = 'new_jobs';
    protected $guarded = [];
    // protected $cast = [
    //     'kids' => 'array'
    // ];

    protected $fillable = [
        'by',
        'job_id',
        'score',
        'time',
        'title',
        'type',
        'url'
    ];
}
