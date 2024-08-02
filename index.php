<?php 
include 'reusable/nav.php';
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
<div class="banner-image">
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center pt-5">
        <h1 class="banner-text">Yoga for your restless mind</h1>
        <p class="banner-paragh">Experience our programs,practices,books and mentorship to calm your mind  and fortify your resilency</p>
    </div>
</div>
<div class="text-center mt-4 mb-4">
        <h2 class="display-4 best-yoga-classes">Yoga Classes</h2>
        <p class="lead text-muted">Find the most popular and highly recommended yoga classes available.</p>
</div>

<div class="container mt-5 mb-5 py-3">
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
                    <div class="card shadow-sm card-custom">
                        <div class="card-body">
                            <img src="<?php echo htmlspecialchars($class['imagePath']); ?>" class="card-img-top" alt="Class cover picture">
                            <h5 class="card-title card-title-custom"><?php echo $class['name']; ?></h5>
                            <p class="card-text"><?php echo $class['level']; ?></p>
                            <p class="card-text"><strong>Instructor:</strong> <?php echo htmlspecialchars($instructor['name']); ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <form action="./updateYogaClass.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $class['id']; ?>">
                                        <input type="hidden" name="className" value="<?php echo $class['name']; ?>">
                                        <input type="hidden" name="classType" value="<?php echo $class['level']; ?>">
                                        <input type="hidden" name="imagePath" value="<?php echo $class['imagePath']; ?>">
                                        <input type="hidden" name="instructorId" value="<?php echo $instructor['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-primary <?php if(empty($_SESSION['email'])) { echo 'disabled'; } else { echo ''; } ?>">Update</button>
                                    </form>
                                    <form action="./inc/deleteYogaClass.php" class="mx-2" method="get" name="deleteClassForm" onsubmit="return confirm(`Are you sure, you want to delete?`);">
                                        <input type="hidden" name="id" value="<?php echo $class['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger ml-2  <?php if(empty($_SESSION['email'])) { echo 'disabled'; } else { echo ''; } ?>">Delete</button>
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