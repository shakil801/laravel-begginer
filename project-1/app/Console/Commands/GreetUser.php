<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GreetUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:greet-user {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Greet User By Name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->info("Hello, ".$name ."!");
    }
}
