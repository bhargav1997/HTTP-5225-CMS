


<?php 
    include './reusable/nav.php';
    include('./inc/functions.php');
    include('./reusable/con.php');

    // Fetch all instructors for the dropdown
    $instructors_query = "SELECT id, name FROM instructors";
    $instructors_result = mysqli_query($connect, $instructors_query);

    if (!$instructors_result) {
        die('Instructors query failed: ' . mysqli_error($connect));
    }
  ?>

  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="display-4 mt-5 mb-5">Update Class</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col">
          <?php get_messages(); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="custom-card">
            <form action="./inc/update.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
              <div class="mb-3">
                <label for="className" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="className" aria-describedby="className" placeholder="Class Name Here" name="className" value="<?php echo $_POST['className'] ?>" required>
              </div>
              <div class="mb-3">
                <label for="classType" class="form-label">Class Type</label>
                <input type="text" class="form-control" id="classType" placeholder="Class Type Here (Primary, Middle, High)" name="classType" value="<?php echo $_POST['classType'] ?>" required>
              </div>
              <div class="mb-3">
                <label for="ClassImg" class="form-label">Class Image</label>
                <input type="file" class="form-control" id="ClassImg" name="ClassImg" accept="image/*">
                <input type="hidden" name="currentImage" value="<?php echo $_POST['imagePath'] ?>">
                <img src="<?php echo $_POST['imagePath'] ?>" alt="Class cover picture" class="mt-2" style="max-width: 200px;">
              </div>
              <div class="mb-3">
                <label for="instructor" class="form-label">Instructor</label>
                <select class="form-select" id="instructor" name="instructorId" required>
                  <?php
                  while ($instructor = mysqli_fetch_assoc($instructors_result)) {
                      $selected = ($instructor['id'] == $_POST['instructorId']) ? 'selected' : '';
                      echo "<option value='{$instructor['id']}' $selected>{$instructor['name']}</option>";
                  }
                  ?>
                </select>
              </div>
              <button type="submit" class="btn btn-custom">Update Class</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include './reusable/footer.php'; ?>
