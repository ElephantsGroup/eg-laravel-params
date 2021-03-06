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
    protected $signature = 'params:init {userId}';

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
        $admin_role = Role::where(['name' => 'params-admin'])->first();
        if (!$admin_role)
            $admin_role = Role::create(['name' => 'params-admin']);

        $reporter_role = Role::where(['name' => 'params-reporter'])->first();
        if (!$reporter_role)
            $reporter_role = Role::create(['name' => 'params-reporter']);

        $user = \App\User::findOrFail($this->argument('userId'));
        $user->assignRole($admin_role);
    }
}