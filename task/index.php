<?php 
session_start();

	include("connect_db.php");
	include("functions.php");

	$user_data = check_login($con);

    if (isset($_SESSION['UserId'])) {
        $isLoggedIn = true;
    } else {
        $isLoggedIn = false;
    }

?>

    <title>Task</title>
    <link rel="stylesheet" href="css/index.css">
    <?php include('nav.php') ?>

            <?php
            if (isset($user_data['FirstName']) && $user_data['FirstName'] !== null) {
                echo " <h3> Hello, " . $user_data['FirstName']. "</h3>" ;
            } else {
                echo "  <h3> Hello Guest </h3>";
            }
            ?>

    <div class="product-grid">
        <div class="product-item">
            <h3>Product 1</h3>
            <p>Price: $19.99</p>
            <?php
            if ($isLoggedIn){
                    echo '<button class="add-review-btn" id="addReviewButton">Add Review</button>';
                } else {
                    echo '<button class="add-review-btn"  onclick="alert(\'Please login first to add a review.\')">Add Review</button>';
                }
            ?>

            <button class="add-review-btn" id="viewReviewButton">View Review</button>
          
            <div class="review-description">
                <p>Product 1 Review:</p>
            </div>
        </div>
        <div class="product-item">
            <h3>Product 2</h3>
            <p>Price: $29.99</p>
            <?php
            if ($isLoggedIn){
                    echo '<button class="add-review-btn" id="addReviewButton">Add Review</button>';
                } else {
                    echo '<button class="add-review-btn"  onclick="alert(\'Please login first to add a review.\')">Add Review</button>';
                }
            ?>

            <div class="review-description">
                <p>Product 2 Review:</p>
            </div>
        </div>
        <!-- Add more product items here -->
    </div>

<script>
    // Add event listener to the "Add Review" button
    document.getElementById("addReviewButton").addEventListener("click", function() {
        // Redirect to the addreview.php page
        window.location.href = "addreview.php";
    });
</script>

<script>
     // Add event listener to the "View Review" button
     document.getElementById("viewReviewButton").addEventListener("click", function() {
        // Redirect to the addreview.php page
        window.location.href = "viewreview.php";
    });
</script>


</html>
