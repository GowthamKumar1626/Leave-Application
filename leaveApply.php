<?php require("configure.php"); ?>
<?php include "functions.php";?>
<?php include "includes/header.php"?>

<?php

if(isset($_POST["applyLeave"]) && $_SESSION["sID"]){
    $sID = $_SESSION['sID'];

    $fromDate = $_POST["fromDate"];
    $toDate = $_POST["toDate"];
    $type = $_POST["leaveType"];
    $status = "Pending";
    $reason = $_POST["reason"];
    $days = calculateDays();

    $leavesLeft = 0;
    $leavesLeftQuery = "SELECT `leave_applied_in_days` FROM leave_status WHERE `status`='Approved' AND `sid`='$sID'"; 
    $leavesLeftQueryResult = mysqli_query($connection, $leavesLeftQuery);
    while($row = mysqli_fetch_row($leavesLeftQueryResult)){
        $leavesLeft += $row[0];
    }

    if($fromDate < date("Y-m-d") || $fromDate > $toDate){
        ?>
            <script>
            if(!alert("Wrong date creditionals! Please fil again.")){
                window.location.replace("http://localhost:8080/leaveapp/leaveportal.php");
            };
            </script>
        <?php
    }elseif($leavesLeft == 12){
        ?>
        <script>
        if(!alert("You can't apply for leave. Your leaves are exceeded!")){
            window.location.replace("http://localhost:8080/leaveapp/leaveportal.php");
        };
        </script>
    <?php
    }else{
        $selectQuery = "SELECT `fromdate` FROM `leave_status` WHERE `sid`='$sID' AND `fromdate`='$fromDate'";
        $selectQueryResult = mysqli_query($connection, $selectQuery);
        if(mysqli_num_rows($selectQueryResult) == 0){
            $insertQuery = "INSERT INTO `leave_status` (`sid`, `fromdate`, `todate`, `Type`, `leave_applied_in_days`, `status`, `Reason`) VALUES ('$sID','$fromDate','$toDate','$type','$days','$status','$reason');";
            $insertQueryResult = mysqli_query($connection, $insertQuery);
            if(!$insertQueryResult){
                ?>  
                <script>
                    if(!alert("Please fill the form with correct details!")){
                    window.location.replace("http://localhost:8080/leaveapp/leaveportal.php");
                }
                </script>
            <?php
            }else{
                header("Location: http://localhost:8080/leaveapp/leaveportal.php");
            }
        }else{
            ?>  
                <script>
                    if(!alert("Leave Already applied on this date!")){
                    window.location.replace("http://localhost:8080/leaveapp/leaveportal.php");
                }
                </script>
            <?php
        }
    }
}
?>
