<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SetupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new database for the application';


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
     * @return int
     */
    public function handle()
    {
        $dbName = env('DB_DATABASE', 'assessment');

        if (!$dbName) {
            $this->error('No database name provided!');
            return;
        }

        $charset   = config('database.connections.mysql.charset','utf8mb4');
        $collation = config('database.connections.mysql.collation','utf8mb4_unicode_ci');
        config(['database.connections.mysql.database' => null]);

        try {
            DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET $charset COLLATE $collation;");
            $this->info("Database '$dbName' created successfully.");
        } catch (\Exception $e) {
            $this->error("Error creating database: " . $e->getMessage());
        }

        return 0;
    }
}
