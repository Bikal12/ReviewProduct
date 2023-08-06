<?php 
session_start();
?>
<?php 
    include("connect_db.php");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $FirstName = $_POST["FirstName"];
        $LastName = $_POST["LastName"];
        $Email = $_POST["Email"];
        $Password = $_POST["Password"];

        if(!empty($Email) && !empty($Password) && !is_numeric($FirstName) && !is_numeric($LastName))
        {
        //     $to = $Email;
        //     $subject = "Registration Successful";
        //     $message = "Hello $FirstName $LastName,\n\nYou have successfully registered on our page. Thank you for joining!\n\nBest regards,\nYour Team";
        //     $headers = "From: bkalkonda12@gmail.com"; // Set the email address from which you want to send the email

        //     // Attempt to send the email
        //     $email_sent = mail($to, $subject, $message, $headers);

        //     if ($email_sent) {
        //         // Email sent successfully, now insert user data into the database
                $query = "INSERT INTO users VALUES ('', '$FirstName', '$LastName', '$Email' , '$Password')";
                mysqli_query($con, $query);
                header("Location: index.php");
                die;
            // } else {
            //     echo "Failed to send email. Please check your email configuration.";
            // }
        } else {
            echo "Please enter some valid information!";
        }
    }
?>



    <title>User Registration</title>
    <?php include('nav.php') ?>

    
    <div class="container">
        <h2>User Registration</h2>
        <form action="" method="post">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="FirstName" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="LastName" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="Email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="Password" required>

            <input type="submit" value="Register">
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
    background-color: #333;
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
