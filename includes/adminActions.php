<?php require("./../configure.php"); ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "./../functions.php";?>


<?php

$sID = $_GET["sid"];
$fromDate = $_GET["fromdate"];
$toDate = $_GET["todate"];
$status = $_GET["status"];

$updateQuery = "UPDATE `leave_status` SET `status`='$status' WHERE `sid`='$sID' AND `fromdate`='$fromDate' AND `todate`='$toDate';";
$updateQueryResult = mysqli_query($connection, $updateQuery);
    if(!$updateQueryResult){
        ?>
            <script>
            if(!alert("There is an error")){
                <?php
                die("Error".mysqli_error($connection));
                ?>
            };
            </script>
        <?php
    }else{
        header("Location: http://localhost:8080/leaveapp/admin.php");
    }

?>