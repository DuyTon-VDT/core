<?php

use LaraIO\Core\Http\Action\LoadPermission;
use LaraIO\Core\Livewire\Modal;

return [
    'model' => \LaraIO\Core\Models\Permission::class,
   // 'DisableModule' => true,
    'title' => 'Quyền',
    'emptyData' => 'Không có dữ liệu',
    'enableAction' => true,

    'action' => [
        'title' => '#',
        'add' => true,
        'edit' => true,
        'delete' => true,
        'export' => true,
        'inport' => true,
        'append' => [
            [
                'title' => 'Cập nhật quyền',
                'icon' => '<i class="bi bi-magic"></i>',
                'type' => 'new',
                'permission' => 'core.module.permission.load-permission',
                'action' => function () {
                    return get_do_action_hook(LoadPermission::class, '{}');
                }
            ]
        ]
    ],
    'modal_size' => Modal::Small,
    'fields' => [
        [
            'field' => 'group',
            'title' => 'Nhóm'
        ],
        [
            'field' => 'slug',
            'title' => 'slug'
        ],
        [
            'field' => 'name',
            'title' => 'Tên Quyền'
        ],
    ]
];
