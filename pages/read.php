<?php
require_once 'db.php';

$query = "SELECT * FROM students";
$stmt = $pdo->query($query);
$students = [];
while ($row = $stmt->fetch()) {
    $students[] = $row;
}
?>

<!-- таблица със студенти -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Имена</th>
            <th>Имейл</th>
            <th>Специалност</th>
            <th>Курс</th>
            <th>Успех</th>
        </tr>
    </thead>
    <tbody>
        <!-- Редове със студенти -->
        <?php
        foreach ($students as $student) {
            echo '
                    <tr>
                        <td>' . $student['id'] . '</td>
                        <td>' . htmlspecialchars($student['names']) . '</td>>
                        <td>' . htmlspecialchars($student['email']) . '</td>>
                        <td>' . htmlspecialchars($student['specialty']) . '</td>>
                        <td>' . htmlspecialchars($student['course']) . '</td>>
                        <td>' . htmlspecialchars($student['grade']) . '</td>>
                        <td>
                            <a href="?page=update&id=' . $student['id'] . '" class="btn btn-sm btn-warning">Редактирай</a>
                            <form class="d-inline" method="POST" action="./handlers/handle_delete.php">
                                <input type="hidden" name="id" value="' . $student['id'] . '">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Изтрий
                                </button>
                            </form>
                    </tr>
                ';
        }
        ?>
    </tbody>
</table>