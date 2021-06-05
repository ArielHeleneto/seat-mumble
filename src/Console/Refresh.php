<?php

namespace ArielHeleneto\Seat\Mumble\Console;

use ArielHeleneto\Seat\Mumble\Models\mumble_server_data;
use ArielHeleneto\Seat\Mumble\Models\mumble_user_setting;
use Illuminate\Console\Command;
use Seat\Web\Models\User;

class Refresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mumble:refresh {--U|user=0 : User that you want to update.Input 0 or keep it blank means update all server_datas}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Mumble User';

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
        $count = 0;
        $userId = $this->option('user');
        if ($userId == 0) {
            $server_datas = mumble_server_data::all();
        } else {
            $server_datas = mumble_server_data::where('user_id', $userId);
        }
        $bar = $this->output->createProgressBar($server_datas->count());
        foreach ($server_datas as $server_data) {
            $user = User::find($server_data->user_id);
            if ($user->can('mumble.view')) {
                $mumble_user = mumble_user_setting::find($server_data->user_id);
                $mumble_user->refresh();
            } else {
                $server_data->delete();
            }
            $bar->advance();
            $count++;
        }
        $bar->finish();
        $this->info("\nSuccessfully refreshed!");
    }
}
