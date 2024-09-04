<?php

function search_bfs(string $user_name, $users_graph): ?string
{
    $checked_list = [];
    $search_queue = new SplQueue();
    $add_to_queue = function (string $name) use (&$search_queue, &$checked_list) {
        if (isset($checked_list[$name])) {
            return;
        }
        $checked_list[$name] = true;
        $search_queue->enqueue($name);
    };

    $add_to_queue($user_name);
    foreach ($search_queue as $f_name) {

        $friend = $users_graph[$f_name];
        if ($friend['job'] == 'seller') {
            return $f_name;
        }

        foreach ($friend['friends'] as $name) {
            $add_to_queue($name);
        }
    }

    return null;
}

$users_graph = [
    'Met' => [
        'friends' => ['Jon', 'Bob'],
        'job' => 'developer'
    ],
    'Jon' => [
        'friends' => ['Met'],
        'job' => 'developer'
    ],
    'Ben' => [
        'friends' => ['Jon', 'Ben', 'Bob'],
        'job' => 'seller'
    ],
    'Jaya' => [
        'friends' => ['Jon', 'Jaya', 'Ben', 'Bob'],
        'job' => 'developer'
    ],
    'Bob' => [
        'friends' => ['Met', 'Jaya'],
        'job' => 'developer'
    ],
];

$user = 'Met';

var_dump(
    search_bfs($user, $users_graph)
);