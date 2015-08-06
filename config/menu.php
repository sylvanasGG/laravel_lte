<?php

return [
        'article' => [
            'treeView' => ['name' => '文章', 'icon' => 'fa-pagelines', 'url' => '#', 'actionName' => 'App\Http\Controllers\ArticleController'],
            'treeViewMenu' => [
                ['name' => '文章列表', 'icon' => 'fa-circle-o', 'url' => "/article/index", 'actionName' => 'App\Http\Controllers\ArticleController@getIndex','auth' =>[]
                ],
                ['name' => '新增文章', 'icon' => 'fa-circle-o', 'url' => "/article/create", 'actionName' => 'App\Http\Controllers\ArticleController@getCreate','auth' =>[
                    ''
                ]]
                ]
        ],
        'comment' => [
            'treeView' => ['name' => '评论', 'icon' => 'fa-pencil', 'url' => '#', 'actionName' => 'App\Http\Controllers\CommentController'],
            'treeViewMenu' => [
                ['name' => '评论列表', 'icon' => 'fa-circle-o', 'url' => "/comment/index", 'actionName' => 'App\Http\Controllers\CommentController@getIndex','auth' =>[
                    ''
                ]]
            ]
        ],
        'user' => [
            'treeView' => ['name' => '用户', 'icon' => 'fa-user', 'url' => '#', 'actionName' => 'App\Http\Controllers\UserController'],
            'treeViewMenu' => [
                ['name' => '用户列表', 'icon' => 'fa-circle-o', 'url' => "/user/index", 'actionName' => 'App\Http\Controllers\UserController@getIndex','auth' =>[
                    ''
                ]],
                ['name' => '增加用户', 'icon' => 'fa-circle-o', 'url' => "/user/add", 'actionName' => 'App\Http\Controllers\UserController@getAdd','auth' =>[
                    ''
                ]],
//                ['name' => '管理组权限', 'icon' => 'fa-circle-o', 'url' => "/perm/groupList", 'actionName' => 'Perm/showGroupsList','auth' =>[
//                    ''
//                ]],
            ]
        ],
    ];