<?php

declare(strict_types=1);

namespace Orchid\Backup;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class BackupLayout extends Table
{
    /**
     * @var string
     */
    public $data = 'backups';

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            TD::set('path', __('Path'))->setRender(function ($file) {
                return "<a href='{$file['url']}' target='_blank'>{$file['path']}</a>";
            }),
            TD::set('disk', __('Disk')),
            TD::set('size', __('Size')),
            TD::set('last_modified', __('Last change')),
        ];
    }
}
