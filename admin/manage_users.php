    <?php
    include('../reusable/con.php');

    // Ensure user is authenticated
    secure();

    // Handle user deletion
    if (isset($_GET['delete'])) {
        $userId = intval($_GET['delete']); // Sanitize input to prevent SQL injection
        $query = "DELETE FROM users WHERE id = $userId LIMIT 1";
        
        if (mysqli_query($connect, $query)) {
            set_message('User has been deleted');
        } else {
            set_message('Error deleting user: ' . mysqli_error($connect));
        }
        
        header('Location: users.php');
        exit();
    }

    // Query to fetch users
    $query = 'SELECT * FROM users ORDER BY last, first';
    $result = mysqli_query($connect, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($connect));
    }
    ?>

    <div class="container mt-4" id="users">
        <h2 class="mb-4">Manage Users</h2>

        <?php if (get_message()): ?>
            <div class="alert alert-info">
                <?php echo get_message(); ?>
            </div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-center">Actions</th>
                    <th scope="col" class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($record = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['id']); ?></td>
                        <td><?php echo htmlspecialchars($record['first']) . ' ' . htmlspecialchars($record['last']); ?></td>
                        <td><a href="mailto:<?php echo htmlspecialchars($record['email']); ?>"><?php echo htmlspecialchars($record['email']); ?></a></td>
                        <td class="text-center">
                            <a href="./users_edit.php?id=<?php echo htmlspecialchars($record['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <?php if ($_SESSION['id'] != $record['id']): ?>
                                <a href="manage_users.php?delete=<?php echo htmlspecialchars($record['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger btn-sm">Delete</a>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php echo htmlspecialchars($record['active']); ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <p>
            <a href="users_add.php" class="btn btn-success">
                <i class="fas fa-plus-square"></i> Add User
            </a>
        </p>
    </div>

    <?php include('../reusable/footer.php'); ?>
