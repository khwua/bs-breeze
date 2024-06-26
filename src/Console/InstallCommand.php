<?php

namespace Khwua\BreezeBootstrap\Console;

use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\select;

#[AsCommand(name: 'bs-breeze:install')]
class InstallCommand extends \Laravel\Breeze\Console\InstallCommand
{
    use InstallBootstrapStacks;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bs-breeze:install {stack : The development stack that should be installed (blade,livewire,livewire-functional,react,vue,api)}
                            {--dark : Indicate that dark mode support should be installed}
                            {--pest : Indicate that Pest should be installed}
                            {--ssr : Indicates if Inertia SSR support should be installed}
                            {--typescript : Indicates if TypeScript is preferred for the Inertia stack}
                            {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Bootstrap Breeze controllers and resources';

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        if ($this->argument('stack') === 'blade-bootstrap') {
            return $this->installBootstrapStacks();
        }

        return parent::handle();
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array
     */
    protected function promptForMissingArgumentsUsing()
    {
        return [
            'stack' => fn () => select(
                label: 'Which Breeze stack would you like to install?',
                options: [
                'blade' => 'Blade with Alpine',
                'blade-bootstrap' => 'Blade with Bootstrap framework',
                'livewire' => 'Livewire (Volt Class API) with Alpine',
                'livewire-functional' => 'Livewire (Volt Functional API) with Alpine',
                'react' => 'React with Inertia',
                'vue' => 'Vue with Inertia',
                'api' => 'API only',
            ],
                scroll: 7,
            ),
        ];
    }
}
