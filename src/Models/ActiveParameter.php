<?php

namespace ElephantsGroup\Params\Models;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActiveParameter extends Model
{
    protected $table = 'active_parameter';

    public function __construct()
    {
        parent::__construct();
        $this->user_id = Auth::user()->id;
    }

    public function template()
    {
        return $this->belongsTo('ElephantsGroup\Params\Models\Template');
    }

    public function parameter()
    {
        return $this->belongsTo('ElephantsGroup\Params\Models\Parameter');
    }
}
