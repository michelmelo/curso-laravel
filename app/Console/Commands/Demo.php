<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class Demo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('Select User');
        $users = User::query()
                ->get();

        //$user = User::where('id', 2)->delete();
        

        // foreach($users as $user){
            // $this->line('Select User: '. $user->id);
        // }

        dd($users->toArray());

    }
}
