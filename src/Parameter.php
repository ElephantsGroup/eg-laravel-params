<?php

namespace ElephantsGroup\Params;

use Closure;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    public const _STATUS_DISABLED = 0;
    public const _STATUS_ENABLED = 1;

    protected $table = 'parameter';

    public function enabled() : bool
    {
        return $this->status === self::_STATUS_ENABLED;
    }

    public function disabled() : bool
    {
        return $this->status === self::_STATUS_DISABLED;
    }

    public function enable() : void
    {
        $this->status = self::_STATUS_ENABLED;
    }

    public function disable() : void
    {
        $this->status = self::_STATUS_DISABLED;
    }
}
