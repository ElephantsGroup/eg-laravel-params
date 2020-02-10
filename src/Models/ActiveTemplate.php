<?php

namespace ElephantsGroup\Params\Models;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActiveTemplate extends Model
{
    protected $table = 'active_template';

    public function __construct()
    {
        parent::__construct();
        $this->user_id = Auth::user()->id;
    }

    public function template()
    {
        return $this->belongsTo('ElephantsGroup\Params\Models\Template');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
