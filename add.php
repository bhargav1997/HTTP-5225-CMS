<?php include 'reusable/nav.php'; ?>

<?php include 'reusable/hero.php'; ?>

<?php 
include('./reusable/con.php');
include('inc/functions.php');

// Query to fetch all instructors
$instructors_query = 'SELECT id, name FROM instructors ORDER BY name';
$instructors = mysqli_query($connect, $instructors_query);

// Query to fetch all classes
$query = 'SELECT * FROM classes ORDER BY `Class Name`';
$classess = mysqli_query($connect, $query);
?>

<div class="container custom-spacing">
  <div class="row">
    <div class="col">
      <?php get_messages(); ?>
    </div>
  </div>
  <div class="row d-flex justify-content-center">
    <div class="col-md-6">
      <div class="form-container">
        <form action="inc/addYogaClass.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="ClassName" class="form-label">Class Name</label>
            <input type="text" class="form-control" id="ClassName" aria-describedby="ClassName" placeholder="Class Name Here" name="className">
          </div>
          <div class="mb-3">
            <label for="ClassType" class="form-label">Class Level</label>
            <input type="text" class="form-control" id="ClassType" placeholder="Class Type Here (Primary, Middle, High)" name="classType">
          </div>
          <div class="mb-3">
            <label for="ClassImg" class="form-label">Class Image</label>
            <input type="file" class="form-control" id="ClassImg" placeholder="Upload Image" name="ClassImg" accept="image/*" required>
          </div>
          <div class="mb-3">
            <label for="Instructor" class="form-label">Instructor</label>
            <select class="form-select" id="Instructor" name="instructorId">
              <option selected disabled>Select Instructor</option>
              <?php while ($row = mysqli_fetch_assoc($instructors)) : ?>
                <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <button type="submit" class="btn btn-custom  <?php if(empty($_SESSION['email'])) { echo 'disabled'; } else { echo ''; } ?>">Add Class</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include './reusable/footer.php'; ?>

