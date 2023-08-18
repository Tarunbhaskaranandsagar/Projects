<?php
session_reset();
session_start();
include("connection.php");
include("functions.php");

$dup = 0;
if(isset($_SESSION['user_id']))
{
    header('Location: index.php');
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $dup = 0;
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    
    $que = "select * from users where user_name = '$user_name' limit 1";
    $res = mysqli_query($con,$que);
    
    if(!empty($user_name) && !empty($password) && !is_numeric($user_name) && mysqli_num_rows($res)==0)
    {
        //save to database
        $user_id = random_num(8);

        $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
        mysqli_query($con,$query);
        header("Location: login.php");
        die;
    }else if(mysqli_num_rows($res) != 0) 
    {
        $dup=1;
    }
    else
    {
        echo "<script>alert('Please Enter Valid Information')</script>";
    }

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/sign.css">
    <title>Sign Up</title>
</head>
<body>
    <div>
        <form method="post">
            <div class="content">
                <h1 style="text-align: center;">Sign Up</h1><br><br>
                Username : <input type="text" name="user_name">
                <?php
                    if($dup==1)
                    {
                        ?>
                        <div style="display:block;color:red;font-size:10px;text-align:center;padding-left:
                        10px;">Username Already Exist</div>
                        <?php
                        $dup=0;
                    }
                ?>
                <div class="pass">
                    Password  : &nbsp;<input type="password" name="password"><br><br>
                </div>
                <!-- Name: <input type="text" name="user_name"><br><br> -->
                <div class="but">
                    <input type="submit" name="submit" value="Submit" class="btn">
                </div>
                <div style="padding-top:30px;">
                    Already Signed Up? <a href="login.php" style="text-decoration: none;">Login</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>