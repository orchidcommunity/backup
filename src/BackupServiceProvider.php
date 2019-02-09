<?php

declare(strict_types=1);

namespace Orchid\Backup;

use Orchid\Platform\Dashboard;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Backup\BackupServiceProvider as SpatieBackupServiceProvider;

/**
 * Class BackupServiceProvider.
 */
class BackupServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard)
    {
        $this->loadJsonTranslationsFrom(realpath(__DIR__.'/../lang/'));

        $dashboard
            ->registerPermissions($this->registerPermissions());

        View::composer('platform::container.systems.index', SystemMenuComposer::class);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerProviders();
    }

    /**
     * Register provider.
     */
    public function registerProviders()
    {
        foreach ($this->provides() as $provide) {
            $this->app->register($provide);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            SpatieBackupServiceProvider::class,
            RouteBuilderServiceProvider::class,
        ];
    }

    /**
     * @return array
     */
    protected function registerPermissions(): array
    {
        return [
            __('Systems') => [
                [
                    'slug'        => 'platform.systems.backups',
                    'description' => __('Backups'),
                ],
            ],
        ];
    }
}
