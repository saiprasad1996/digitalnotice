<?php
    include('dbcon.php');
    session_start();
        $uname=$_POST['username_login'];
        $password=$_POST['password_login'];
        
        $query_result =  mysqli_query($con, "SELECT * FROM logins  WHERE username='$uname' AND password='$password'") or die("Error executing login query");
        $row=  mysqli_fetch_array($query_result);
        if(mysqli_num_rows($query_result)==1)
        {
        echo "</br>Login Successful... Redirecting to the main post page..</br>";
            $_SESSION['username_current']=$row['username'];
            
            $_SESSION['fullname']=$row['fullname'];
                    
            echo "<script>window.location.href='studentwall.php';</script>";
        
        }
        else
        {
            echo "Login Failed";
            echo "<script>window.location.href='studentwall.php';</script>";;
        }
 
        
?>