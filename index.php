<?php
require_once __DIR__.'/vendor/autoload.php'; // Путь к библиотеке Discord PHP

use Discord\Discord;
use Discord\Parts\Channel\Message;

$discord = new Discord([
    'token' => getenv('DISCORD_BOT_TOKEN'), // Замените YOUR_BOT_TOKEN на свой токен авторизации бота
]);

$discord->on('ready', function (Discord $discord) {
    echo "Logged in as {$discord->user->username}#{$discord->user->discriminator}!\n";
});

$discord->on('message', function (Message $message, Discord $discord) {
    if ($message->author->bot) {
        return;
    }
    
    $command = '/talk'; // Команда для вызова бота
    $responses = [
        'Привет, как дела?',
        'Я тут, что нужно?',
        'Всё в порядке',
    ]; // Массив с вариантами ответов
    
    if (strpos($message->content, $command) === 0) {
        $response = $responses[array_rand($responses)];
        $message->channel->sendMessage($response);
    }
});

$discord->run();