<?php

include __DIR__ . "/../vendor/autoload.php";
include __DIR__ . "/comment.php";

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorBuilder;

$comments = [];

// Создание пользователей
$user1 = new User(1, "User-1", "mail-1@email.com", "password-1", new DateTime('01-01-2021 14:50:02'));
$user2 = new User(2, "User-2", "mail-2@email.com", "password-2", new DateTime('16-07-2021 18:47:19'));
$user3 = new User(3, "User-3", "mail-3@email.com", "password-3", new DateTime('05-01-2022 01:35:48'));
$user4 = new User(4, "User-4", "mail-4@email.com", "password-4", new DateTime('14-03-2021 05:47:12'));
$user5 = new User(5, "User-5", "mail-5@email.com", "password-5", new DateTime('28-09-2021 09:04:01'));

// Создание комментариев
$comments[0] = new Comment($user1, "Comment #1");
$comments[1] = new Comment($user2, "Comment #2");
$comments[2] = new Comment($user3, "Comment #3");
$comments[3] = new Comment($user4, "Comment #4");
$comments[4] = new Comment($user5, "Comment #5");

// Дата и время, которые будут использоваться для отбора сообщений
$controlDateTime = new DateTime('01-06-2021 00:00:00');
echo 'Control date and time: ' . $controlDateTime->format('d-m-Y H:i:s') . '<br><br>';

// Вывод только тех сообщений, создатели которых были зарегистрированы после controlDateTime
foreach ($comments as $comment) {
    
    if ($comment->getAuthor()->getCreationDateTime() > $controlDateTime) {

        echo 'Comment\'s author\'s creation date and time: ' . $comment->getAuthor()->getCreationDateTime()->format('d-m-Y H:i:s') . '<br>';
        echo 'Comment: ' . '<br>'; 
        echo $comment->getContent() . '<br><br>';
    }
}