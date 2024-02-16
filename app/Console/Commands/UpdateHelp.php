<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateHelp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-help';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates help article index';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // This updates the stored article links
        // these are stored in a DB instead of scanning the directory everytime
        $this->line("Starting dirscan");
        $helpDir = resource_path() . "/help/article";
        $dir = scandir($helpDir);


        var_dump($dir);

        foreach ($dir as $file) {
            $fileInfo = pathinfo(resource_path(). "/help/article/" . $file);

            if(str_contains($file, ".md")) {
                $this->line("Top level found");
            }
        }
    }
}
