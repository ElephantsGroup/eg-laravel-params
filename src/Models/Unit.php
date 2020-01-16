<?php

namespace ElephantsGroup\Params\Models;

use Closure;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    protected $attributes = [
        'order' => 0,
    ];
}
