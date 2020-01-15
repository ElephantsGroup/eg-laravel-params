<?php

namespace ElephantsGroup\Params\Commands;

use Illuminate\Console\Command;
use ElephantsGroup\Params\Parameter;
use ElephantsGroup\Params\Unit;

class CreateParameter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'params:create {name} {description?} {--unit=} {--enable}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a parameter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $parameter = new Parameter;
        $parameter->name = $this->argument('name');
        $parameter->description = $this->argument('description') ?? "";
        $parameter->status = Parameter::_STATUS_DISABLED;
        if ($this->option('enable'))
            $parameter->satus = Parameter::_STATUS_ENABLES;
        $unit = Unit::where('name', $this->option('unit'))->get();
        if (!$unit)
        {
            echo 'Failed!';
            return;
        }
        $parameter->unit = $unit;
        $parameter->save();
    }
}