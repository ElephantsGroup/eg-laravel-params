<?php

namespace ElephantsGroup\Params\Models;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Template extends Model
{
    public const STATUS_DISABLED = 0;
    public const STATUS_ENABLED = 1;

    protected $table = 'template';

    protected $attributes = [
        'status' => self::STATUS_DISABLED,
        'order' => 0,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->user_id = Auth::user()->id;
    }

    public function enabled() : bool
    {
        return $this->status === self::STATUS_ENABLED;
    }

    public function disabled() : bool
    {
        return $this->status === self::STATUS_DISABLED;
    }

    public function enable() : void
    {
        $this->status = self::STATUS_ENABLED;
    }

    public function disable() : void
    {
        $this->status = self::STATUS_DISABLED;
    }
}
