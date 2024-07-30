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

// Query to fetch all instructors
$instructors_query = 'SELECT id, name FROM instructors ORDER BY name';
$instructors = mysqli_query($connect, $instructors_query);

// Query to fetch all classes
$query = 'SELECT * FROM classess ORDER BY `Class Name`';
$classess = mysqli_query($connect, $query);
?>

<div class="container my-5">
  <div class="row">
    <div class="col">
      <?php get_messages(); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <form action="inc/addYogaClass.php" method="POST">
        <div class="mb-3">
          <label for="ClassName" class="form-label">Class Name</label>
          <input type="text" class="form-control" id="ClassName" aria-describedby="ClassName" placeholder="Class Name Here" name="className">
        </div>
        <div class="mb-3">
          <label for="ClassType" class="form-label">Class Level</label>
          <input type="text" class="form-control" id="ClassType" placeholder="Class Type Here (Primary, Middle, High)" name="classType">
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
        <button type="submit" class="btn btn-primary">Add Class</button>
      </form>
    </div>
  </div>
</div>

<?php include './reusable/footer.php'; ?>
