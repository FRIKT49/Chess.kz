<?php

header('Content-Type: application/json');
$dbConfig = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'root',
    'dbName' => 'diplom'
];
$db2 = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['dbName']);

if ($_GET['nick']) {
    $nick = $_GET['nick'];

    if (mysqli_query($db2, "SELECT `id` FROM `users` WHERE `name` = '{$nick}'")) {
        $resultName = mysqli_query($db2, "SELECT `id` FROM `users` WHERE `name` = '{$nick}'");
        $nameQuery = mysqli_fetch_assoc($resultName);

        $file = 'queue.json';
        $now = time();
        $id = $nameQuery['id'];

        if (file_exists($file)) {
            $queue = json_decode(file_get_contents($file), true);
            if (!is_array($queue)) $queue = [];
        } else {
            $queue = [];
        }

        // Удаляем пользователя из очереди, если он там есть
        $queue = array_filter($queue, function ($item) use ($id) {
            return isset($item['id']) && $item['id'] != $id;
        });

        // Добавляем/обновляем пользователя с last_ping
        $queue[] = ['id' => $id, 'last_ping' => $now];

        // Удаляем "мертвых" (не пинговали больше 10 секунд)
        $queue = array_filter($queue, function ($item) use ($now) {
            return isset($item['last_ping']) && ($now - $item['last_ping']) < 10;
        });

        // Переиндексация массива
        $queue = array_values($queue);

        // Сохраняем обратно
        file_put_contents($file, json_encode($queue, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        // Проверяем, есть ли 2 пользователя
        if (count($queue) >= 2) {
            // Можно начинать игру, возвращаем двух игроков
            echo json_encode([
                'success' => true,
                'start' => true,
                'players' => [$queue[0], $queue[1]],
                'queue' => $queue
            ]);
        } else {
            // Ждём второго игрока
            echo json_encode([
                'success' => true,
                'start' => false,
                'queue' => $queue
            ]);
        }
    }
}