<?php
require_once '../db.php';
header('Content-Type: application/json');

$id = intval($_POST['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Невалиден идентификатор.']);
    exit;
}

$query = "DELETE FROM students WHERE id = :id";
$stmt = $pdo->prepare($query);
if ($stmt->execute([':id' => $id])) {
    echo json_encode(['success' => true, 'message' => 'Успешно изтрит.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Неуспешно изтриване.']);
}
exit;
