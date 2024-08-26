<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MyService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Services/{$name}.php");

        if(File::exists($path)){
            $this->error("Service {$name} already exists!");

            return;
        }
        File::ensureDirectoryExists(app_path('Services'));
        $stub = $this->getStub();

        $stub = str_replace('{{serviceName}}', $name, $stub);

        File::put($path, $stub);
        $this->info("Service {$name} created successfully.");
    }
    protected function getStub()

    {

        return <<<EOD

<?php



namespace App\Services;



class {{serviceName}}

{

    public function __construct()

    {

        // Initialization code

    }



    public function performAction(\$param)

    {

        // Business logic here

        return "Action performed with parameter: " . \$param;

    }

}

EOD;

    }
}
