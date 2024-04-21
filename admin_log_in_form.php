<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Define your credentials (you can replace these with credentials from a database)
        $valid_username = "admin";
        $valid_password = "password";
    
        // Retrieve the submitted username and password
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        // Check if the submitted credentials match the valid ones
        if ($username === $valid_username && $password === $valid_password) {
            // Authentication successful, redirect to a secure page
            $_SESSION['username'] = $username; // Store username in session variable
            header("Location: ./admin_home_page.php");
            exit();
        } else {
            // Authentication failed, redirect back to login page with error message
            header("Location: login.html?error=1");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="design.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-image: url("./pictures/savanaPic.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .wrapper{
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 8;
        }

        .login_box{
            width: 30%;
            height: 65%;
            border: 2px solid rgba(0, 0, 0, 0.5);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            backdrop-filter: blur(5px);

        }

        .login_header{
            font-weight: bold;
            font-size: 40px;
            margin: 10px;
        }

        form{
            width: 90%;
        }

        form div{
            margin: 20px;
        }

        div input{
            width: 100%;
            height: 50px;
            font-size: 15px;
            background: transparent;
            color: white;
            padding: 0 20px;
            border: 2px solid rgba(0, 0, 0, 0.7);
            border-radius: 25px;
            outline: none;
        }

        div input:focus{
            background-color: rgba(0, 0, 0, 0.5);
            box-shadow: 0 5px 10px rgba(255, 255, 255, 1),
                0 5px 8px rgba(255, 255, 255, 1),
                0 5px 5px rgba(255, 255, 255, 1);
        }

        div label{
            margin: 10px 0;
            display: block;
            font-size: 17px;
            color: white;
        }

        .submit_button{
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 55px;
        }

        .submit_button input{
            width: 60%;
            height: auto;
            padding: 10px;
        }

        .submit_button a{
            color: white;
            text-decoration: none;
            margin: 5px;
        }

        .submit_button a:hover{
            font-weight: bolder;
        }

    </style>
</head>
<body>
    
    <div class="wrapper">
        <div class="login_box">
            <div class="login_header">
                <span>Login</span>
            </div>

            <form action="./admin_log_in_form.php" method="post">
                <div class="username">
                    <label for="userame">Enter a Username:</label>
                    <input type="text" name="username" placeholder="Enter your Username" required>
                </div>

                <div class="password">
                    <label for="password">Enter a Password:</label>
                    <input type="password" name="password" placeholder="Enter your Password" require>
                </div>

                <div class="submit_button">
                    <input type="submit" name="submit" value="Log In">
                    <a href="#">forget password?</a>
                </div>

            </form>
        </div>
    </div>
    
</body>
</html>