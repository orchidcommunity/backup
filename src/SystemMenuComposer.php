<?php

declare(strict_types=1);

namespace Orchid\Backup;

use Orchid\Platform\ItemMenu;
use Orchid\Platform\Dashboard;

/**
 * Class SystemMenuComposer.
 */
class SystemMenuComposer
{
    /**
     * @var Dashboard
     */
    private $dashboard;

    /**
     * MenuComposer constructor.
     *
     * @param Dashboard $dashboard
     */
    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    /**
     * Registering the main menu items.
     */
    public function compose()
    {
        $this->dashboard->menu
            ->add('Tools',
                ItemMenu::setLabel(__('Backups'))
                    ->setIcon('icon-clock')
                    ->setGroupName('Necessary for the ability to quickly recover information in case of loss of a working copy.')
                    ->setRoute(route('platform.systems.backups'))
                    ->setPermission('platform.systems.backups')
            );
    }
}
