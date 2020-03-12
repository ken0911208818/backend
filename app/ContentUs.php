<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentUs extends Model
{
    protected $table ='contentus';
    protected $fillable = [
        'name','email', 'phone', 'message'
    ];
}
