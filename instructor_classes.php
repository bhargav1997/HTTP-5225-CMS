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
                <?php while ($class = mysqli_fetch_assoc($classes)): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm card-custom">
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
                <?php endwhile; ?>
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
