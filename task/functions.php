<?php

function check_login($con)
{

	if(isset($_SESSION['UserId']))
	{

		$id = $_SESSION['UserId'];
		$query = "select * from users where UserId = '$id'";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

}

function viewreview($con)
{
    
    $reviews = array(); // Initialize an empty array to store all reviews

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $rt = $_POST['rt'];

    $query = "SELECT r.*, u.FirstName, u.LastName FROM review r LEFT JOIN users u ON r.UserId = u.UserId WHERE StarRating = " . $rt;
    $result = mysqli_query($con, $query); 

    $reviews = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($review = mysqli_fetch_assoc($result)) {
            $reviews[] = $review;
        }
    }
    }

    return $reviews;
}


