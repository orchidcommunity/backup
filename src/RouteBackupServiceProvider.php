<?php

declare(strict_types=1);

namespace Orchid\Backup;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Orchid\Support\Facades\Dashboard;

/**
 * Class RouteBootServiceProvider.
 */
class RouteBuilderServiceProvider extends RouteServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Orchid\Builder';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::domain((string) config('platform.domain'))
            ->middleware(config('platform.middleware.private'))
            ->namespace($this->namespace)
            ->prefix(Dashboard::prefix('/systems'))
            ->group(function (){
                $this->screen('/backups', BackupScreen::class)
                    ->name('platform.systems.backups');
            });

        // Platform > System > Backup
        Breadcrumbs::for('platform.systems.backups', function ($trail) {
            $trail->parent('platform.systems.index');
            $trail->push(__('Backups'), route('platform.systems.backups'));
        });
    }
}
