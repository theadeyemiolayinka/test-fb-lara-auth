<?php

namespace TheAdeyemiOlayinka\FbLaraAuth\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb-lara-auth:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Started with Firebase-Laravel Authentication.';

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
        $this->line("<info>FbLaraAuth by TheAdeyemiOlayinka https://github.com/theadeyemiolayinka</info>");
        $this->line("<info>Setting up FbLaraAuth...</info>");
        $this->line("");
        sleep(2);

        $this->line("<info>Installing kreatit/laravel-firebase ...</info>");
        $this->line("");
        sleep(2);

        $this->call('vendor:publish', [
            '--provider' => 'Kreait\Laravel\Firebase\ServiceProvider',
            '--tag' => 'config'
        ]);

        $this->line("<info>Cooking Greatness! ...</info>");
        $this->line("");
        sleep(2);

        $this->call('vendor:publish', [
            '--tag' => 'fb-lara-auth.config'
        ]);

        $this->line("");
        sleep(2);
        $this->line("<info>FbLaraAuth installed sucessfully!!</info>");
    }
}
