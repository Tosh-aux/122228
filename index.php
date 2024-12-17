<?php
require_once 'db.php';
$page = $_GET['page'] ?? 'read';
$flash_msg = [];
if (isset($_SESSION['flash_msg'])) {
    $flash_msg = $_SESSION['flash_msg'];
    unset($_SESSION['flash_msg']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University</title>
    <!-- Bootstrap 5.3 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark py-3">
        <div class="container-fluid">
            <!-- Линкове в навигацията -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?page=create">Добави студент</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=read">Списък със студенти</a>
                </li>
            </ul>
        </div>
    </nav>
    <main class="container py-4" style="min-height:85vh;">
        <!-- Съдържание -->
        <?php
        if (!empty($flash_msg)) {
            echo '<div class="alert alert-' . $flash_msg['type'] . '">' . $flash_msg['text'] . '</div>';
        }

        if (file_exists('./pages/' . $page . '.php')) {
            require_once('./pages/' . $page . '.php');
        }
        ?>
    </main>
    <footer class="bg-dark text-center py-5 mt-auto">
        <div class="container">
            <span class="text-light">© 2024 University | All rights reserved</span>
        </div>
    </footer>
</body>

</html>