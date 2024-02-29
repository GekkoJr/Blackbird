<?php

namespace App\Console\Commands;

use App\Models\HelpIndex;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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

        DB::table('help')->delete();

        // this should have been a recursive function to support more than a dual layer folder structure.
        // the point of this thing is to update the index of help articles, and store it in the help table
        foreach ($dir as $file) {
            $fileInfo = pathinfo(resource_path() . "/help/article/" . $file);

            if (str_contains($file, ".md")) {
                $this->line("Top level found: " . $fileInfo["filename"]);
                $element = new HelpIndex;
                $element->name = $fileInfo["filename"];
                $element->isDirectory = false;
                $element->save();
            } elseif (($file != ".") && ($file != "..")) { //scandir return ".." and . and we don't want them
                $this->line("Dir found: further search commencing");
                $newDir = scandir(resource_path() . "/help/article/" . $file . "/");
                $this->line($newDir);

                $element = new HelpIndex;
                $element->name = $file;
                $element->isDirectory = true;
                $element->save();

                foreach ($newDir as $dirFile) {
                    if (($dirFile != ".") && ($dirFile != "..") && str_contains($dirFile, ".md")) {
                        $dirFileInfo = pathinfo(resource_path() . "/help/article/" . $file . "/" . $dirFile);
                        $this->line("Dir file found: " . $dirFileInfo["filename"]);

                        $el = new HelpIndex;
                        $el->name = $file;
                        $el->isDirectory = false;
                        $el->parent = $element->id;
                        $el->save();
                    }

                }
            }
        }
    }
}
