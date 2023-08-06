<?php 

session_start();

	include("connect_db.php");
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$Email = $_POST["Email"];
        $Password = $_POST["Password"];

		if(!empty($Email) && !empty($Password) )
		{

			//read from database
			$query = "select * from users where Email = '$Email' ";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['Password'] === $Password)
					{

						$_SESSION['Email'] = $user_data['Email'];
                        $_SESSION['UserId'] = $user_data['UserId'];
                        $_SESSION['FirstName'] = $user_data['FirstName'];

						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>

<?php include('nav.php') ?>

    <div class="container">
        <h2>User Login</h2>
        <form action="#" method="post">

            <label for="email">Email:</label>
            <input type="email" id="email" name="Email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="Password" required>

            <input type="submit" value="Login">
        </form>
    </div>

<style> 
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
}

h2 {
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-top: 10px;
}

input {
    padding: 5px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="submit"] {
    margin-top: 20px;
    cursor: pointer;
    background-color: green;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #555;
}

</style>
</html>
