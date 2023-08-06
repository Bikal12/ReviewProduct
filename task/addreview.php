<?php 
session_start();

include("connect_db.php");
include("functions.php");

$user_data = check_login($con);

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $StarRating = $_POST["StarRating"];
        $Description = $_POST["Description"];
        $UserId = $_POST["UserId"];
        $EnterDate = date('Y-m-d h:i:s a');

        if(!empty($StarRating) && !empty($Description) && is_numeric($StarRating) && !empty($UserId))
        {
      
                $query = "INSERT INTO review VALUES ('', '$StarRating', '$Description', '$UserId', '$EnterDate' )";
                mysqli_query($con, $query);
                header("Location: index.php");
                die;
        } else {
            echo "Please enter some valid information!";
        }
    }
?>


<link rel="stylesheet" href="css/addreview.css">
<?php include('nav.php') ?>
<title>Review Page</title>
<h1>Review Page</h1>

<h2>Add Review</h2>
<form action="" method="post">

        <input type="hidden" name="UserId" value="<?= $user_data['UserId'] ?>" > 

        <label for="reviewDescription">Review Description:</label><br>
        <textarea  name="Description" rows="4" cols="50" required></textarea><br>
       
        <label for="starRating">Star Rating (1 to 5):</label><br>
        <input type="number" id="starRating" name="StarRating" min="1" max="5" required><br>

        <input type="submit" value="Submit Review">
</form>
