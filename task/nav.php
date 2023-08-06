
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="userregister.php">User Register</a></li>
            <?php if (isset($_SESSION['UserId'])) {
                        echo'<li><a href="userlogout.php">Logout</a></li>';
                    } else {
                        // The session is not set, so the user is not logged in. Show the link.
                        echo '<li><a href="userlogin.php">User Login</a></li>';
                    }
            ?>

        </ul>
        </nav>
    </div>
</body>
</html>
