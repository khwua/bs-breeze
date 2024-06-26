<?php

namespace Khwua\BreezeBootstrap\Console;

use Illuminate\Filesystem\Filesystem;

trait InstallBootstrapStacks
{
    public function installBootstrapStacks(): ?int
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
        return 1;
    }
}
