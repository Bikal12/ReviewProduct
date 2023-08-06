<?php
session_start();

include("connect_db.php");
include("functions.php");
$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if ReviewId is provided in the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $ReviewId = $_GET['id'];
        $StarRating = $_POST["StarRating"];
        $Description = $_POST["Description"];
        $UserId = $user_data['UserId'];
        $EnterDate = date('Y-m-d h:i:s a');

        if (!empty($StarRating) && !empty($Description) && is_numeric($StarRating)) {
            // Update existing review in the database
            $query = "UPDATE review SET StarRating='$StarRating', Description='$Description', EnterDate='$EnterDate' WHERE ReviewId='$ReviewId' AND UserId='$UserId'";
            mysqli_query($con, $query);
            header("Location: viewreview.php");
            die;
        } else {
            echo "Please enter some valid information!";
        }
    }
}

// Check if ReviewId is provided in the URL for editing an existing review
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $ReviewId = $_GET['id'];
    // Fetch the existing review from the database to populate the form
    $query = "SELECT * FROM review WHERE ReviewId='$ReviewId' AND UserId='{$user_data['UserId']}'";
    $result = mysqli_query($con, $query);
    $existingReview = mysqli_fetch_assoc($result);
}

if (!$existingReview) {
    // If the review doesn't exist or doesn't belong to the logged-in user, redirect to index.php
    header("Location: index.php");
    die;
}
?>

<link rel="stylesheet" href="css/addreview.css">
<?php include('nav.php') ?>
<title>Review Page</title>
<h1>Review Page</h1>

<h2>Edit Review</h2>

<form action="" method="post">
    <!-- For editing, include the ReviewId as a URL parameter -->
    <input type="hidden" name="UserId" value="<?= $user_data['UserId'] ?>">
    <input type="hidden" name="ReviewId" value="<?= $ReviewId ?>">

    <label for="reviewDescription">Review Description:</label><br>
    <textarea name="Description" rows="4" cols="50" required><?= $existingReview['Description'] ?></textarea><br>

    <label for="starRating">Star Rating (1 to 5):</label><br>
    <input type="number" id="starRating" name="StarRating" min="1" max="5" required value="<?= $existingReview['StarRating'] ?>"><br>

    <input type="submit" value="Update Review">
</form>
