<?php

namespace ElephantsGroup\Params\Commands;

use Illuminate\Console\Command;
use ElephantsGroup\Params\Models\Parameter;
use ElephantsGroup\Params\Models\Unit;
use Spatie\Permission\Models\Role;

class InitParameter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'params:init {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize package data';

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
        $role = Role::create(['name' => 'params-admin']);
        $user = \App\User::findOrFail($this->argument('user'));
        $user->assignRole('params-admin');
    }
}