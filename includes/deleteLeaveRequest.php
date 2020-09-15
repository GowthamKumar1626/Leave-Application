<?php require("./../configure.php"); ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "./../functions.php";?>

<?php
if(isset($_SESSION["sID"])){
    $sID = $_SESSION["sID"];
    $fromDate = $_GET["fromdate"];

    $deleteQuery = "DELETE FROM `leave_status` WHERE `sid`='$sID' AND `status`='Pending' AND `fromdate`='$fromDate'";
    $deleteQueryResult = mysqli_query($connection, $deleteQuery);
    if(!$deleteQueryResult){
        ?>
            <script>
            if(!alert("There is an error")){
                <?php
                header("Location: http://localhost:8080/leaveapp/leaveportal.php");
                ?>
            };
            </script>
        <?php
    }else{
        header("Location: http://localhost:8080/leaveapp/leaveportal.php");
    }

}else{
    ?>
        <script>
        if(!alert("You are not authorised for this page! Please login.")){
            window.location.replace("http://localhost:8080/leaveapp/");
        };
        </script>
    <?php
}
?>