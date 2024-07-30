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
include('./inc/functions.php');

$instructor_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($instructor_id > 0) {
    $query = "SELECT * FROM classes WHERE instructor_id = $instructor_id ORDER BY name";
    $classes = mysqli_query($connect, $query);

    // Fetch instructor details
    $instructor_query = "SELECT * FROM instructors WHERE id = $instructor_id";
    $instructor_result = mysqli_query($connect, $instructor_query);
    $instructor = mysqli_fetch_assoc($instructor_result);
}
?>

<div class="container-fluid pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php get_messages(); ?>
            </div>
        </div>
        <?php if ($instructor): ?>
            <div class="row">
                <div class="col">
                    <h2>Classes by <?php echo htmlspecialchars($instructor['name']); ?></h2>
                </div>
            </div>
            <div class="row">
                <?php
                foreach ($classes as $class) {
                    echo '<div class="col-md-4 mt-2 mb-2">
                            <div class="card ' . $class['id'] . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($class['name']) . '</h5>
                                    <p class="card-text">' . htmlspecialchars($class['level']) . '</p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <form action="./updateYogaClass.php" method="post">
                                                <input type="hidden" name="id" value="' . $class['id'] . '">
                                                <input type="hidden" name="className" value="' . htmlspecialchars($class['name']) . '">
                                                <input type="hidden" name="classType" value="' . htmlspecialchars($class['level']) . '">
                                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                            </form>
                                        </div>
                                        <div class="col">
                                            <form action="./inc/deleteYogaClass.php" method="get" name="deleteClassForm" onsubmit="return confirm(`Are you sure, you want to delete?`);">
                                                <input type="hidden" name="id" value="' . $class['id'] . '">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';  
                }
                ?>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col">
                    <p>Instructor not found.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include './reusable/footer.php'; ?>
