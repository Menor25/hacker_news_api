<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ask extends Model
{
    use HasFactory;

    protected $table = 'asks';
    protected $guarded = [];
    // protected $cast = [
    //     'kids' => 'array'
    // ];

    protected $fillable = [
        'by',
        'descendants',
        'ask_id',
        'kids',
        'score',
        'text',
        'time',
        'title',
        'type'
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
