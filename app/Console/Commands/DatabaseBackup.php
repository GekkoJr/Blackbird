<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automated Database backups';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // checks if the backup folder exists
        if (!Storage::exists('DB_backup')) {
            Storage::makeDirectory('DB_backup');
        }

        $filename = "db-backup-" . Carbon::now()->format("Y-m-d-H") . ".gz";

        $command = "mariadb-dump --user=" . env('DB_USERNAME') . " --password='" . env('DB_PASSWORD') . "' --host="
            . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . storage_path() . "/app/DB_backup/" . $filename;

        echo $command;

        exec($command);
    }
}
