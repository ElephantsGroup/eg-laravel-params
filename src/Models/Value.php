<?php

namespace ElephantsGroup\Params\Models;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Value extends Model
{
    public const STATUS_DISABLED = 0;
    public const STATUS_ENABLED = 1;

    protected $table = 'value';

    public function __construct()
    {
        parent::__construct();
        $this->user_id = Auth::user()->id;
    }
}
