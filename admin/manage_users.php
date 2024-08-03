<?php

include('../reusable/con.php');

// Handle user deletion
if (isset($_GET['delete'])) {
    $userId = intval($_GET['delete']); // Sanitize input to prevent SQL injection
    $query = "DELETE FROM users WHERE id = $userId LIMIT 1";

    if (mysqli_query($connect, $query)) {
        set_message('User has been deleted');
    } else {
        set_message('Error deleting user: ' . mysqli_error($connect));
    }

    header('Location: index.php');
    exit();
}

// Query to fetch users
$query = 'SELECT * FROM users ORDER BY last, first';
$result = mysqli_query($connect, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($connect));
}
?>

<div class="container mt-5" id="users">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-bold">Manage Users</h2>
        <a href="./usersadd.php" class="btn btn-success">
            <i class="fas fa-plus-square"></i> Add User
        </a>
    </div>

    <?php if (get_message()): ?>
    <div class="alert alert-info alert-dismissible fade show shadow-sm rounded" role="alert">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-info-circle me-2"></i>
                <?php echo get_message(); ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>


    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php while ($record = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['id']); ?></td>
                        <td><?php echo htmlspecialchars($record['first']) . ' ' . htmlspecialchars($record['last']); ?></td>
                        <td><a href="mailto:<?php echo htmlspecialchars($record['email']); ?>"><?php echo htmlspecialchars($record['email']); ?></a></td>
                        <td>
                            <a href="./usersedit.php?id=<?php echo htmlspecialchars($record['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <?php if ($_SESSION['id'] != $record['id']): ?>
                                <a href="index.php?delete=<?php echo htmlspecialchars($record['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger btn-sm">Delete</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($record['active']); ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
