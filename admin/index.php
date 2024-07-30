<?php
session_start(); // Start the session

include('../reusable/con.php');
include('./includes/admin_functions.php');

// Handle class addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['className'])) {
    $className = mysqli_real_escape_string($connect, $_POST['className']);
    $classType = mysqli_real_escape_string($connect, $_POST['classType']);
    $instructorId = (int)$_POST['instructorId'];
    
    // Validate input
    if (!empty($className) && !empty($classType) && $instructorId > 0) {
        $addClassQuery = "INSERT INTO classes (`Class Name`, `Class Type`, `Instructor ID`) VALUES ('$className', '$classType', $instructorId)";
        if (mysqli_query($connect, $addClassQuery)) {
            set_message('Class added successfully');
        } else {
            set_message('Error adding class: ' . mysqli_error($connect));
        }
    } else {
        set_message('Please fill all fields correctly');
    }
}

// Handle login
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = md5($_POST['password']);
    
    // Check if the connection was successful
    if ($connect) {
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND active = 'Yes' LIMIT 1";
        $result = mysqli_query($connect, $query);
        
        if (mysqli_num_rows($result)) {
            $record = mysqli_fetch_assoc($result);
            
            $_SESSION['id'] = $record['id'];
            $_SESSION['email'] = $record['email'];
            
            header('Location: ./index.php');
            exit(); // Use exit() after header redirection
        } else {
            set_message('Incorrect email and/or password');
            header('Location: ./index.php');
            exit(); // Use exit() after header redirection
        }
    } else {
        // Handle database connection error
        set_message('Database connection failed');
        header('Location: ./index.php');
        exit(); // Use exit() after header redirection
    }
}

include('./includes/header.php');
?>

<?php if (isset($_SESSION['id'])): ?>

<?php
  include('./includes/nav.php');
?>

<div class="container mt-5 mb-5">
    <div class="alert alert-success text-center" role="alert">
        <?php echo "Welcome, " . $_SESSION['email']; ?>
    </div>

    <?php include('./manage_users.php'); ?>
<!--     
    <div class="mt-5 " id="addClassForm">
        <h2 class="text-center">Add Yoga Class</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php echo get_message(); ?>
                <form action="index.php" method="POST">
                    <div class="mb-3">
                        <label for="ClassName" class="form-label">Class Name</label>
                        <input type="text" class="form-control" id="ClassName" name="className" placeholder="Class Name Here" required>
                    </div>
                    <div class="mb-3">
                        <label for="ClassType" class="form-label">Class Level</label>
                        <input type="text" class="form-control" id="ClassType" name="classType" placeholder="Class Type Here (Primary, Middle, High)" required>
                    </div>
                    <div class="mb-3">
                        <label for="Instructor" class="form-label">Instructor</label>
                        <select class="form-select" id="Instructor" name="instructorId" required>
                            <option selected disabled>Select Instructor</option>
                            <?php
                            // Query to fetch all instructors
                            $instructors_query = 'SELECT id, name FROM instructors ORDER BY name';
                            $instructors = mysqli_query($connect, $instructors_query);
                            while ($row = mysqli_fetch_assoc($instructors)) : ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Class</button>
                </form>
            </div>
        </div>
    </div> -->

</div>

<?php else: ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="card-title text-center">Login</h3>
                    <?php echo get_message(); ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="text-center d-flex justify-content-start mt-3">
                            <input type="submit" value="Login" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
include('../reusable/footer.php');
?>
