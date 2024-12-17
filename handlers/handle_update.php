<?php

require_once '../db.php';
$flashMessages = include '../constants/flash_messages.php';
// прихващаме данните от POST заявката
$id = intval($_POST['id'] ?? 0);
$names = $_POST['names'] ?? '';
$email = $_POST['email'] ?? '';
$specialty = $_POST['specialty'] ?? '';
$course = intval($_POST['course'] ?? 0);
$grade = floatval($_POST['grade'] ?? 0);

// валидация на данните
if ($id <= 0) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] = 'Невалиден идентификатор';
    header('Location: ../index.php?page=read');
    exit;
}
if (mb_strlen($names) < 6) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] = $flashMessages['name_not_valid'];
    header('Location: ../index.php?page=update&id=' . $id);
    exit;
}
if (mb_strlen($email) < 5) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] = $flashMessages['email_not_valid'];
    header('Location: ../index.php?page=update&id=' . $id);
    exit;
}
if (mb_strlen($specialty) < 4) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] = $flashMessages['specialty_not_valid'];
    header('Location: ../index.php?page=update&id=' . $id);
    exit;
}
if ($course > 6 || $course < 1) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] =  $flashMessages['course_not_valid'];
    header('Location: ../index.php?page=update&id=' . $id);
    exit;
}
if ($grade > 6 || $grade < 2) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] = $flashMessages['grade_not_valid'];
    header('Location: ../index.php?page=update&id=' . $id);
    exit;
}

// обновяваме данните в базата
$query = "UPDATE students SET names = :names, email = :email, specialty = :specialty, course = :course, grade = :grade WHERE id = :id";
$stmt = $pdo->prepare($query);
$params = [
    ':id' => $id,
    ':names' => $names,
    ':email' => $email,
    ':specialty' => $specialty,
    ':course' => $course,
    ':grade' => $grade,
];
if ($stmt->execute($params)) {
    $_SESSION['flash_msg']['type'] = 'success';
    $_SESSION['flash_msg']['text'] = $flashMessages['update_success'];
} else {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] =  $flashMessages['error_occurred'];
}
header('Location: ../index.php?page=update&id=' . $id);
exit;
