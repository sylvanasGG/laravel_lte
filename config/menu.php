<?php

return [
        'article' => [
            'treeView' => ['name' => '文章', 'icon' => 'fa-pagelines', 'url' => '#', 'actionName' => 'Article'],
            'treeViewMenu' => [
                ['name' => '文章列表', 'icon' => 'fa-circle-o', 'url' => "article/index", 'actionName' => "Article/index",'auth' =>[]
                ],
                ['name' => '新增文章', 'icon' => 'fa-circle-o', 'url' => "article/create", 'actionName' => 'Article/create','auth' =>[
                    ''
                ]]
                ]
        ],
        'comment' => [
            'treeView' => ['name' => '评论', 'icon' => 'fa-pencil', 'url' => '#', 'actionName' => 'Comment'],
            'treeViewMenu' => [
                ['name' => '评论列表', 'icon' => 'fa-circle-o', 'url' => "comment/index", 'actionName' => 'Comment/index','auth' =>[
                    ''
                ]]
            ]
        ],
        'user' => [
            'treeView' => ['name' => '用户', 'icon' => 'fa-user', 'url' => '#', 'actionName' => 'User'],
            'treeViewMenu' => [
                ['name' => '用户列表', 'icon' => 'fa-circle-o', 'url' => "user/index", 'actionName' => 'User/index','auth' =>[
                    ''
                ]],
                ['name' => '增加用户', 'icon' => 'fa-circle-o', 'url' => "user/showAdd", 'actionName' => 'User/showAdd','auth' =>[
                    ''
                ]],
                ['name' => '管理组权限', 'icon' => 'fa-circle-o', 'url' => "perm/showGroupsList", 'actionName' => 'Perm/showGroupsList','auth' =>[
                    ''
                ]],
            ]
        ],
    ];