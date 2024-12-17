<?php

require_once '../db.php';
$flashMessages = include '../constants/flash_messages.php';


// прихващаме данните от POST заявката
$names = $_POST['names'] ?? '';
$email = $_POST['email'] ?? '';
$specialty = $_POST['specialty'] ?? '';
$course = intval($_POST['course'] ?? 0);
$grade = floatval($_POST['grade'] ?? 0);

// валидация на данните
if (mb_strlen($names) < 6) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] = $flashMessages['name_not_valid'];
    header('Location: ../index.php?page=create');
    exit;
}
if (mb_strlen($email) < 5) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] = $flashMessages['email_not_valid'];
    header('Location: ../index.php?page=create');
    exit;
}
if (mb_strlen($specialty) < 4) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] = $flashMessages['specialty_not_valid'];
    header('Location: ../index.php?page=create');
    exit;
}
if ($course > 6 || $course < 1) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] =  $flashMessages['course_not_valid'];
    header('Location: ../index.php?page=create');
    exit;
}
if ($grade > 6 || $grade < 2) {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] = $flashMessages['grade_not_valid'];
    header('Location: ../index.php?page=create');
    exit;
}

// запис в базата данни
$query = "INSERT INTO students (names, email, specialty, course, grade) VALUES (:names, :email, :specialty, :course, :grade)";
$stmt = $pdo->prepare($query);
$params = [
    ':names' => $names,
    ':email' => $email,
    ':specialty' => $specialty,
    ':course' => $course,
    ':grade' => $grade,
];
if ($stmt->execute($params)) {
    $_SESSION['flash_msg']['type'] = 'success';
    $_SESSION['flash_msg']['text'] = $flashMessages['create_success'];
    header('Location: ../index.php?page=read');
    exit;
} else {
    $_SESSION['flash_msg']['type'] = 'danger';
    $_SESSION['flash_msg']['text'] =  $flashMessages['error_occurred'];
    header('Location: ../index.php?page=create');
    exit;
}
