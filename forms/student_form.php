<?php
function renderStudentForm($student = [], $action = '', $buttonLabel = '')
{
?>
    <form class="border rounded p-4 w-50 mx-auto" method="POST" action="<?php echo htmlspecialchars($action); ?>">
        <div class="mb-3">
            <label for="names" class="form-label">Имена</label>
            <input type="text" minlength="6" class="form-control" id="names" name="names"
                value="<?php echo htmlspecialchars($student['names'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Имейл</label>
            <input type="email" minlength="5" class="form-control" id="email" name="email"
                value="<?php echo htmlspecialchars($student['email'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="specialty" class="form-label">Специалност</label>
            <input type="text" minlength="4" class="form-control" id="specialty" name="specialty"
                value="<?php echo htmlspecialchars($student['specialty'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="course" class="form-label">Курс</label>
            <input type="number" class="form-control" id="course" name="course" min="1" max="6"
                value="<?php echo htmlspecialchars($student['course'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="grade" class="form-label">Успех</label>
            <input type="number" step="0.01" class="form-control" id="grade" name="grade" min="2.00" max="6.00"
                value="<?php echo htmlspecialchars($student['grade'] ?? ''); ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($student['id'] ?? 0); ?>">
        <button type="submit" class="btn btn-success"><?php echo htmlspecialchars($buttonLabel); ?></button>
    </form>
<?php
}
