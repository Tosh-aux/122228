<?php
require_once 'db.php';

$query = "SELECT * FROM students";
$stmt = $pdo->query($query);
$students = [];
while ($row = $stmt->fetch()) {
    $students[] = $row;
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.delete-form').submit(function (e) {
            e.preventDefault();

            const form = $(this);
            const id = form.find('input[name="id"]').val();

            $.ajax({
                url: './ajax/handle_delete.php',
                type: 'POST',
                data: { id: id },
                success: function (response) {
                    const result = JSON.parse(response);
                    if (result.success) {
                        alert(result.message);
                        // Force the browser to bypass cache during reload
                        location.reload(true);
                    } else {
                        alert(result.message);
                    }
                },
                error: function () {
                    alert('Възникна грешка при изтриването.');
                }
            });
        });
    });
</script>



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
                            <form class="delete-form d-inline">
                                <input type="hidden" name="id" value="' . $student['id'] . '">
                                <button type="submit" class="btn btn-sm btn-danger">Изтрий</button>
                            </form>
                    </tr>
                ';
        }
        ?>
    </tbody>
</table>