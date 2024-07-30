<?php include "reusable/nav.php"; ?>

<div class="container-fluid bg-light py-5">
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h1 class="display-3 text-dark">About Yoga Classes</h1>
            </div>
        </div>
    </div>
</div>

<div class="container custom-container">
    <section id="studio">
        <h2>Our Studio</h2>
        <p class="lead">Welcome to our serene and welcoming yoga studio, where we strive to create a peaceful environment for all our students.</p>
    </section>

    <section id="philosophy">
        <h2>Our Philosophy</h2>
        <p class="lead">At our yoga studio, we believe in the power of yoga to transform lives. We focus on combining physical practice with mindfulness and spiritual growth.</p>
    </section>

    <section id="instructors">
        <h2>Our Instructors</h2>
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
                    echo '<div class="col-md-4">
                            <div class="card mb-3 card-custom">
                                <img class="card-img-top img-fluid" src="' . $instructor['photoUrl'] . '" alt="' . htmlspecialchars($instructor['name']) . '">
                                <div class="card-body">
                                    <h3 class="card-title">' . htmlspecialchars($instructor['name']) . '</h3>
                                    <p class="card-text">' . htmlspecialchars($instructor['bio']) . '</p>
                                    <a href="instructor_classes.php?id=' . $instructor['id'] . '" class="btn btn-primary">View Classes</a>
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
