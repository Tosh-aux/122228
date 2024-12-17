<?php

require_once '../db.php';
$flashMessages = include '../constants/flash_messages.php';

// прихващаме id от POST заявката
$id = intval($_POST['id'] ?? 0);

// валидация на id
if ($id <= 0) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] = 'Невалиден идентификатор';
    header('Location: ../index.php?page=read');
    exit;
}

// изтриване от базата данни
$query = "DELETE FROM students WHERE id = :id";
$stmt = $pdo->prepare($query);
if ($stmt->execute([':id' => $id])) {
    $_SESSION['flash_msg']['type'] = 'success';
    $_SESSION['flash_msg']['text'] =  $flashMessages['delete_success'];
} else {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] =  $flashMessages['delete_failure'];
}
header('Location: ../index.php?page=read');
exit;
