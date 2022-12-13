<?php

return [

    /*[
        'color' => 'yellow',
        'icon' => 'envelope',
        'model' => \App\Models\Contact::class,
        'name' => 'admin.new-messages',
        'url' => 'contacts?new=on',
    ],*/
    [
        'color' => 'green',
        'icon' => 'user',
        'model' => \App\Models\User::class,
        'name' => 'admin.new-registers',
        'url' => 'users?new=on',
    ],
    [
        'color' => 'red',
        'icon' => 'pencil',
        'model' => \App\Models\Post::class,
        'name' => 'admin.new-posts',
        'url' => 'posts?new=on',
    ],
    [
        'color' => 'blue',
        'icon' => 'comment',
        'model' => \App\Models\Comment::class,
        'name' => 'admin.new-comments',
        'url' => 'comments?new=on',
    ],

];