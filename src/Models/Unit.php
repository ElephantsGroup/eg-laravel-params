<?php

namespace ElephantsGroup\Params\Models;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Unit extends Model
{
    protected $table = 'unit';
    protected $attributes = [
        'order' => 0,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->user_id = Auth::user()->id;
    }

    public function parameters()
    {
        return $this->hasMany('ElephantsGroup\Params\Models\Parameter');
    }
}