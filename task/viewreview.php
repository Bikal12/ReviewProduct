<?php
session_start();
require_once("functions.php");
require_once("connect_db.php");
$user_data =  check_login($con);
// Function to sanitize user inputs
function sanitize_input($input)
{
    return htmlspecialchars(trim($input));
}

$num_per_page = 5;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

// Sanitize and process the user input for rating filter
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $rt = isset($_POST['rt']) ? sanitize_input($_POST['rt']) : "";
    $rt = (int)$rt;

    $sql = "SELECT r.*, u.FirstName, u.LastName 
            FROM review r 
            LEFT JOIN users u ON r.UserId = u.UserId 
            WHERE StarRating = $rt 
            ORDER BY r.EnterDate DESC
            LIMIT " . ($page - 1) * $num_per_page . ", $num_per_page";
} else {
    // Construct the SQL query without rating filter
    $sql = "SELECT r.*, u.FirstName, u.LastName 
            FROM review r 
            LEFT JOIN users u ON r.UserId = u.UserId 
            ORDER BY r.EnterDate DESC
            LIMIT " . ($page - 1) * $num_per_page . ", $num_per_page";
}


$rs_result = mysqli_query($con, $sql);

?>


<html>
<head>
    <link rel="stylesheet" href="css/viewreview.css">

</head>
<body>
    <?php include('nav.php'); ?>
    <h1>View Reviews</h1>
    <form method="post">
        <label for="rt">By Rating:</label>
        <select name="rt">
            <option value="">--Select--</option>
            <option value="1">1 Star</option>
            <option value="2">2 Stars</option>
            <option value="3">3 Stars</option>
            <option value="4">4 Stars</option>
            <option value="5">5 Stars</option>
        </select>
        <button type="submit">Search</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Enter Date</th>
                <th> Action </th>
            </tr>
        </thead>
        <?php while ($rows = mysqli_fetch_assoc($rs_result)) : ?>
            <tr>
                <td><?= $rows['FirstName'] . ' ' . $rows['LastName'] ?></td>
                <td><?= $rows['StarRating'] ?></td>
                <td><?= $rows['Description'] ?></td>
                <td><?= $rows['EnterDate'] ?></td>
                <?php if (isset($user_data['UserId']) && $user_data['UserId'] == $rows['UserId']) : ?>
                    <th><a href="editreview.php?id=<?= $rows['ReviewId'] ?>" class="edit-link">Edit</a></th>
                <?php endif; ?>
            </tr>
        <?php endwhile; ?>
    </table>
    <?php


    $sql = "SELECT COUNT(*) as count FROM review";
    $rs_result = mysqli_query($con, $sql);
    $total_records = $rs_result ? mysqli_fetch_assoc($rs_result)['count'] : 0;


    $total_pages = ceil($total_records / $num_per_page);

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<span class='pagination-link'><a href='viewreview.php?page=" . $i . "'>" . $i . "</a></span>";
    }

    for ($i = 1; $i <= 5; $i++) {
        $sqlcount = "SELECT COUNT(*) as count FROM review WHERE StarRating = " . $i;
        $result = mysqli_query($con, $sqlcount);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
    
            if ($count === "0") {
                echo "<p class='no-rating-msg'>No users have given $i star.</p><br>";
            } 
        }
    }  
    
    ?>

</body>



</html>
