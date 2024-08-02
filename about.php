<?php include "reusable/nav.php"; ?>

<?php include 'reusable/hero.php'; ?>

<div class="container custom-container">
    <section id="studio" class="my-5">
        <div class="row d-flex align-items-center"> <!-- Add d-flex and align-items-center classes here -->
            <div class="col-lg-6 d-flex flex-column justify-content-center"> <!-- Add d-flex, flex-column, and justify-content-center classes here -->
                <h2>Our Studio</h2>
                <p class="lead">Welcome to our serene and welcoming yoga studio, where we strive to create a peaceful environment for all our students.</p>
            </div>
            <div class="col-lg-6">
                <img src="images/studio.jpg" class="img-fluid rounded" alt="Yoga Studio">
            </div>
        </div>
    </section>

    <section id="philosophy" class="my-5">
        <div class="row d-flex align-items-center"> <!-- Add d-flex and align-items-center classes here -->
            <div class="col-lg-6 order-lg-2 d-flex flex-column justify-content-center"> <!-- Add d-flex, flex-column, and justify-content-center classes here -->
                <h2>Our Philosophy</h2>
                <p class="lead">At our yoga studio, we believe in the power of yoga to transform lives. We focus on combining physical practice with mindfulness and spiritual growth.</p>
            </div>
            <div class="col-lg-6 order-lg-1">
                <img src="images/philosophy.jpg" class="img-fluid rounded" alt="Yoga Philosophy">
            </div>
        </div>
    </section>

    <section id="instructors" class="my-5">
        <h2>Our Instructors</h2>
        <div class="mb-4">
            <a href="add_instructor.php" class="btn btn-success <?php if(empty($_SESSION['email'])) { echo 'disabled'; } else { echo ''; } ?>">Add Instructor</a>
        </div>
        <div class="row">
            <?php
            // Include database connection and functions
            include('./reusable/con.php');
            include('inc/functions.php');

            // Query to retrieve all instructors
            $query = 'SELECT * FROM instructors';
            $instructors = mysqli_query($connect, $query);

            // Check if there are instructors
            if (mysqli_num_rows($instructors) > 0) {
                // Loop through each instructor
                while ($instructor = mysqli_fetch_assoc($instructors)) {
                    echo '<div class="col-md-4 p-3">
                            <div class="card mb-4 card-custom">
                                <img class="card-img-top img-fluid" src="' . $instructor['photoUrl'] . '" alt="' . htmlspecialchars($instructor['name']) . '">
                                <div class="card-body">
                                    <h3 class="card-title">' . htmlspecialchars($instructor['name']) . '</h3>
                                    <p class="card-text">' . htmlspecialchars($instructor['bio']) . '</p>
                                    <a href="instructor_classes.php?id=' . $instructor['id'] . '" class="btn btn-primary">View Classes</a>
                                    <a href="edit_instructor.php?id=' . $instructor['id'] . '" class="btn btn-warning ' . (empty($_SESSION['email']) ? 'disabled' : '') . '">Edit</a>
                                    <a href="delete_instructor.php?id=' . $instructor['id'] . '" class="btn btn-danger ' . (empty($_SESSION['email']) ? 'disabled' : '') . '" onclick="return confirm(\'Are you sure you want to delete this instructor?\');">Delete</a>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo '<p>No instructors found.</p>';
            }
            ?>
        </div>
    </section>
</div>

<?php include "./reusable/footer.php"; ?>
