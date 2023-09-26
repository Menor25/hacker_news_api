<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $table = 'stories';
    protected $guarded = [];
    protected $cast = [
        'kids' => 'array'
    ];

    protected $fillable = [
                    'by',
                    'id',
                    'descendants',
                    'kids',
                    'score',
                    'time',
                    'title',
                    'type',
                    'url'
    ];

    /**

     *

     * @return \Illuminate\Database\Eloquent\Casts\Attribute

     */

     protected function kids(): Attribute

     {

         return Attribute::make(

             get: fn ($value) => json_decode($value, true),

             set: fn ($value) => json_encode($value),

         );

     }
}
