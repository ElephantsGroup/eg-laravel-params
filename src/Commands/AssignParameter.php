<?php

namespace ElephantsGroup\Params\Commands;

use Illuminate\Console\Command;
use ElephantsGroup\Params\Models\Parameter;
use ElephantsGroup\Params\Models\Unit;
use Spatie\Permission\Models\Role;

class AssignParameter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'params:assign {--userId=} {--roleName=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign role to user';

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
        $roleName = $this->option('roleName');
        $userId = $this->option('userId');

        $role = Role::where(['name' => $roleName])->firstOrFail();
        $user = \App\User::findOrFail($userId);

        $user->assignRole($role);
    }
}