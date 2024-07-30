<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yoga Studio Class</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <?php include './reusable/nav.php';
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
          <form action="./update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
            <div class="mb-3">
              <label for="className" class="form-label">Class Name</label>
              <input type="text" class="form-control" id="className" aria-describedby="className" placeholder="Class Name Here" name="className" value="<?php echo $_POST['className'] ?>">
            </div>
            <div class="mb-3">
              <label for="classType" class="form-label">Class Type</label>
              <input type="text" class="form-control" id="classType" placeholder="Class Type Here (Primary, Middle, High)" name="classType" value="<?php echo $_POST['classType'] ?>">
            </div>
            <div class="mb-3">
              <label for="instructor" class="form-label">Instructor</label>
              <select class="form-control" id="instructor" name="instructorId">
                <?php
                while ($instructor = mysqli_fetch_assoc($instructors_result)) {
                    $selected = ($instructor['id'] == $_POST['instructorId']) ? 'selected' : '';
                    echo "<option value='{$instructor['id']}' $selected>{$instructor['name']}</option>";
                }
                ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Class</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
