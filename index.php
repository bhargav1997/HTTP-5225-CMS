<?php

include( 'admin/includes/database.php' );
include( 'admin/includes/config.php' );
include( 'admin/includes/functions.php' );

?>
<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  <title>Website Admin</title>
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  
</head>
<body>
<?php include 'reusable/nav.php'; ?>

<div class="container-fluid bg-light py-5">
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h1 class="display-3 text-dark">Yoga Classes</h1>
            </div>
        </div>
    </div>
</div>


<?php 
include('./reusable/con.php');
include('inc/functions.php');

// Query to retrieve all classes ordered by name 
$query = 'SELECT * FROM classes ORDER BY `name`';  
$classess = mysqli_query($connect, $query);

// Check for query errors
if (!$classess) {
    die('Query failed: ' . mysqli_error($connect));
}

?>

<div class="container mt-5">
    <div class="row">
        <?php
        // Check if there are classes to display
        if (mysqli_num_rows($classess) > 0) {
            // Loop through each class
            while ($class = mysqli_fetch_assoc($classess)) {
                // Fetch instructor details for each class
                $instructor_id = $class['instructor_id'];
                $instructor_query = "SELECT * FROM instructors WHERE id = $instructor_id";
                $instructor_result = mysqli_query($connect, $instructor_query);
                if (!$instructor_result) {
                    die('Instructor query failed: ' . mysqli_error($connect));
                }
                $instructor = mysqli_fetch_assoc($instructor_result);
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $class['name']; ?></h5>
                            <p class="card-text"><?php echo $class['level']; ?></p>
                            <p class="card-text"><strong>Instructor:</strong> <?php echo htmlspecialchars($instructor['name']); ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <form action="./updateYogaClass.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $class['id']; ?>">
                                        <input type="hidden" name="className" value="<?php echo $class['name']; ?>">
                                        <input type="hidden" name="classType" value="<?php echo $class['level']; ?>">
                                        <input type="hidden" name="instructorId" value="<?php echo $instructor['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                    </form>
                                    <form action="./inc/deleteYogaClass.php" class="mx-2" method="get" name="deleteClassForm" onsubmit="return confirm(`Are you sure, you want to delete?`);">
                                        <input type="hidden" name="id" value="<?php echo $class['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger ml-2">Delete</button>
                                    </form>
                                </div>
                                <small class="text-muted"><?php echo $instructor['phone']; ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            echo '<div class="col"><p>No classes found.</p></div>';
        }
        ?>
    </div>
</div>

<?php include './reusable/footer.php'; ?>