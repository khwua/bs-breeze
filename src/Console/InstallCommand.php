<?php

namespace Khwua\BreezeBootstrap\Console;

use Illuminate\Filesystem\Filesystem;

use function Laravel\Prompts\select;

class InstallCommand extends \Laravel\Breeze\Console\InstallCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bs-breeze:install {stack : The development stack that should be installed (blade-bootstrap,blade,livewire,livewire-functional,react,vue,api)}
                            {--dark : Indicate that dark mode support should be installed}
                            {--pest : Indicate that Pest should be installed}
                            {--ssr : Indicates if Inertia SSR support should be installed}
                            {--typescript : Indicates if TypeScript is preferred for the Inertia stack (Experimental)}
                            {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Breeze controllers and resources';

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        if ($this->argument('stack') === 'blade-bootstrap') {
            return $this->installBootstrapStack();
        }

        return parent::handle();
    }

    /**
     * Install the Blade Breeze stack.
     *
     * @return int|null
     */
    protected function installBootstrapStack()
    {
        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return [
                    '@popperjs/core' => '^2.11.8',
                    'bootstrap' => '^5.3.2',
                    'autoprefixer' => '^10.4.2',
                    'postcss' => '^8.4.6',
                    'sass' => '^1.69.5',
                    'lodash' => '^4.17.21',
                ] + $packages;
        });

        $breezeStubPath = base_path('vendor/laravel/breeze/stubs/default');

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        (new Filesystem)->copyDirectory(
            "{$breezeStubPath}/app/Http/Controllers",
            app_path('Http/Controllers')
        );

        // Requests...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests'));
        (new Filesystem)->copyDirectory(
            "{$breezeStubPath}/app/Http/Requests",
            app_path('Http/Requests')
        );

        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views'));
        (new Filesystem)->copyDirectory(
            __DIR__.'/../../stubs/resources/views',
            resource_path('views')
        );

        // Components...
        (new Filesystem)->ensureDirectoryExists(app_path('View/Components'));
        (new Filesystem)->copyDirectory(
            __DIR__.'/../../stubs/app/View/Components',
            app_path('View/Components')
        );

        // Tests...
        if (! $this->installTests()) {
            return 1;
        }

        // Routes...
        copy("{$breezeStubPath}/routes/web.php", base_path('routes/web.php'));
        copy("{$breezeStubPath}/routes/auth.php", base_path('routes/auth.php'));

        // "Dashboard" Route...
        $this->replaceInFile('/home', '/dashboard', resource_path('views/welcome.blade.php'));
        $this->replaceInFile('Home', 'Dashboard', resource_path('views/welcome.blade.php'));
        $this->replaceInFile('/home', '/dashboard', app_path('Providers/RouteServiceProvider.php'));

        // Bootstrap / Vite...
        copy(__DIR__.'/../../stubs/vite.config.js', base_path('vite.config.js'));
        (new Filesystem)->ensureDirectoryExists(resource_path('scss'));
        copy(__DIR__.'/../../stubs/resources/scss/style.scss', resource_path('scss/style.scss'));
        copy(__DIR__.'/../../stubs/resources/scss/_variables.scss', resource_path('scss/_variables.scss'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js'));
        copy(__DIR__.'/../../stubs/resources/js/scripts.js', resource_path('js/scripts.js'));

        $this->components->info('Installing and building Node dependencies.');

        if (file_exists(base_path('pnpm-lock.yaml'))) {
            $this->runCommands(['pnpm install', 'pnpm run build']);
        } elseif (file_exists(base_path('yarn.lock'))) {
            $this->runCommands(['yarn install', 'yarn run build']);
        } else {
            $this->runCommands(['npm install', 'npm run build']);
        }

        $this->line('');
        $this->components->info('Bootstrap Breeze scaffolding installed successfully.');
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
                'blade-bootstrap' => 'Blade with Bootstrap',
                'blade' => 'Blade with Alpine',
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
