<?php

namespace ElephantsGroup\Params\Models;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TemplateSnapshot extends Model
{
    protected $table = 'template_snapshot';

    public function __construct()
    {
        parent::__construct();
        $this->user_id = Auth::user()->id;
    }
}
