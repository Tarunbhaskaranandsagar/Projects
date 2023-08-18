<?php
session_start();
include("connection.php");
include("functions.php");
if(isset($_SESSION['user_id']))
{
    header('Location: index.php');
}


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];


    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
        //read to database

        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con,$query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] == $password)
                {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header('Location: index.php');
                    die;
                }
                else
                {
                    echo "<script>alert('Wrong Password ! Most Probably !')</script>";
                }
                
                
            }
            else
            {
                echo "<script>alert('No Registered User ! Please Sign Up')</script>";
            }
        }
        else
        {
            echo "<script>alert('Wrong Username or Password')</script>";
        }

        
        
    }else
    {
        echo "<script>alert('Please Enter Valid Information')</script>";
    }

}

?>

<tml lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/sign.css">
    <title>Login</title>
</head>
<body>
    <style type = "text/css">
    </style>

    <div id="box">
        <form method="post">
        <div class="content">
                <h1 style="text-align: center;">LOGIN</h1><br><br>
                Username : <input type="text" name="user_name">
                <div class="pass">
                    Password :&nbsp; <input type="password" name="password"><br><br>
                </div>
                <!-- Name: <input type="text" name="user_name"><br><br> -->
                <div class="but">
                    <input type="submit" name="submit" value="Submit" class="btn">
                </div>
                <div style="padding-top:30px;">
                    New Here? <a href="signup.php" style="text-decoration: none;">Sign Up</a>
                </div>
            </div>
        </form>

    </div>
</body>
</tml>