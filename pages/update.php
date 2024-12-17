<?php
require_once 'db.php';
include './forms/student_form.php';
$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] = 'Невалиден идентификатор';
    header('Location: ../index.php?page=read');
    exit;
}

$query = "SELECT * FROM students WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $id]);
$student = $stmt->fetch();

renderStudentForm($student, './handlers/handle_update.php', 'Редактирай');
