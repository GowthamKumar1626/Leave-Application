<?php require("configure.php");?>
<?php include "functions.php";?>
<?php include "includes/header.php"; ?>
<?php include "includes/loginForm.php"; ?>    
<?php include "includes/footer.php"; ?>

<?php

if(isset($_POST["submit"])){
    
    $sID = getData()["sID"];
    $password = getData()["password"];

    if($sID != 'admin'){
        if(makeLogin($sID, $password)){
            $_SESSION["sID"] = $sID;
            header("Location: http://localhost:8080/leaveapp/leaveportal.php");
        }else{
            ?>
            <script>
            if(!alert("Incorrect Username or Password :( Please Try again")){
                window.location.replace("http://localhost:8080/leaveapp/");
            };
            </script>
            <?php
        }
    }else{
        if($_POST["password"] == 'admin'){
            $_SESSION["sID"] = $sID;
            header("Location: http://localhost:8080/leaveapp/admin.php");
        }else{
            ?>
            <script>
            if(!alert("Incorrect Username or Password :( Please Try again")){
                window.location.replace("http://localhost:8080/leaveapp/");
            };
            </script>
            <?php
        }
        
    }
    
}
?>