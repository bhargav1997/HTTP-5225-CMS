<?php include 'reusable/nav.php'; ?>

<?php include 'reusable/hero.php'; ?>

<?php 
include('./reusable/con.php');
include('./inc/functions.php');

$instructor_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$classes = [];
$instructor = null;

if ($instructor_id > 0) {
    // Fetch instructor details
    $instructor_query = "SELECT * FROM instructors WHERE id = $instructor_id";
    $instructor_result = mysqli_query($connect, $instructor_query);
    if ($instructor_result) {
        $instructor = mysqli_fetch_assoc($instructor_result);
    }

    if ($instructor) {
        $query = "SELECT * FROM classes WHERE instructor_id = $instructor_id ORDER BY name";
        $classes = mysqli_query($connect, $query);
    }
}
?>

<div class="container custom-spacing">
    <div class="row">
        <div class="col">
            <?php get_messages(); ?>
        </div>
    </div>
    
    <?php if ($instructor): ?>
        <div class="row">
            <div class="col mt-4 mb-4">
                <h2 class="display-6">Classes by <?php echo htmlspecialchars($instructor['name']); ?></h2>
            </div>
        </div>
        <?php if (mysqli_num_rows($classes) > 0): ?>
        <div class="row">
            <?php while ($class = mysqli_fetch_assoc($classes)): ?>
                <div class="col-lg-4 col-md-6">
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
            <?php endwhile; ?>
        </div>
        <?php else: ?>
            <div class="row">
                <div class="col">
                    <p class="h4 text-muted">Sorry, No classes Alloted Yet.</p>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="row">
            <div class="col">
                <p class="h4 text-muted">Instructor not found.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include './reusable/footer.php'; ?>
