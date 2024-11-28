<?php

// Simulate a user type for demonstration purposes
// Set this based on actual login logic in your application
$_SESSION['user_type'] = $_SESSION['user_type'] ?? 'student'; // Change to 'admin', 'professor', or 'student' to test

$user_type = $_SESSION['user_type'] ?? null;

$menu_items = [];

// Define subnav items based on user type
switch ($user_type) {
    case 'admin':
        $menu_items = [
            ['label' => 'Admin Dashboard', 'link' => 'admin_dashboard.php'],
            ['label' => 'Manage Users', 'link' => 'manage_users.php'],
            ['label' => 'Add User', 'link' => '../Account/signup.php']
        ];
        break;
    case 'professor':
        $menu_items = [
            ['label' => 'Professor Dashboard', 'link' => 'professor_dashboard.php'],
            ['label' => 'Manage Classes', 'link' => 'manage_classes.php'],
            ['label' => 'View Reports', 'link' => 'view_reports.php']
        ];
        break;
    case 'student':
        $menu_items = [
            ['label' => 'Student Dashboard', 'link' => 'student_dashboard.php'],
            ['label' => 'View Assignments', 'link' => 'view_assignments.php'],
            ['label' => 'Submit Projects', 'link' => 'submit_projects.php']
        ];
        break;
    default:
        $menu_items = [
            ['label' => 'Home', 'link' => 'index.php'],
            ['label' => 'Contact Us', 'link' => 'contact.php'],
            ['label' => 'Help', 'link' => 'help.php']
        ];
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Subnav</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success mt-4 rounded" style="width: 65%; margin-left: auto; margin-right: auto;">
        <div class="container-fluid">
            <ul class="navbar-nav d-flex justify-content-between" style="width: 100%; border-radius: 10px;">
                <?php foreach ($menu_items as $item): ?>
                <li class="nav-item d-flex justify-content-center align-items-center" style="width: 33%;">
                    <a class="nav-link text-white d-flex justify-content-center" href="<?= htmlspecialchars($item['link']) ?>">
                        <?= htmlspecialchars($item['label']) ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
</body>
</html>
