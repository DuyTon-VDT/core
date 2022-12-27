<?php

namespace GateGem\Core\Commands;

use GateGem\Core\Facades\Core;
use Illuminate\Console\Command;

class ModuleLinkCommand extends Command
{

    protected $signature = 'module:link
                {--relative : Create the symbolic link using relative paths}
                {--force : Recreate existing symbolic links}';
    protected static $defaultName = 'module:link';
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:link';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the symbolic links configured for the application';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Generating optimized symbolic links.');
        Core::checkFolder();
        foreach (Core::getLinks() as  [
            'target' => $target,
            'link' => $link,
            'relative' => $relative,
            'force' => $force
        ]) {
            //$link = realpath($link);
            $target = realpath($target);
            $this->components->info("The [$link] link has been connected to [$target].");
            if (file_exists($link) && !$this->isRemovableSymlink($link, $this->option('force') || $force)) {
                $this->components->error("The [$link] link already exists.");
                continue;
            }

            if (is_link($link)) {
                $this->laravel->make('files')->delete($link);
            }

            if ($relative || $this->option('relative')) {
                $this->laravel->make('files')->relativeLink($target, $link);
            } else {
                $this->laravel->make('files')->link($target, $link);
            }

            $this->components->info("The [$link] link has been connected to [$target].");
        }

        return 0;
    }
    /**
     * Determine if the provided path is a symlink that can be removed.
     *
     * @param  string  $link
     * @param  bool  $force
     * @return bool
     */
    protected function isRemovableSymlink(string $link, bool $force): bool
    {
        return is_link($link) && $force;
    }
}
