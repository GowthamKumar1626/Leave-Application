<?php include "configure.php"; ?>
<?php

function getData(){

    global $connection;
    $password = dashInsert($_POST["password"], "-", 2);
    $password = dashInsert($password, "-", 5);
    $userData = array(
                        "sID" => mysqli_real_escape_string($connection, $_POST["sID"]), 
                        "password" => mysqli_real_escape_string($connection, $password)
    );
    return $userData;
}

function dashInsert($str,$insertstr,$pos)
{
    $str = substr($str, 0, $pos) . $insertstr . substr($str, $pos);
    return $str;
}

function checkData($sID, $password){
    if(!$sID || !$password){
?>
        <script> 
        <?php
            echo "alert('Username and password is required')";
        ?>
        </script>
        <?php
        return false;
    }else{
        return true;
    }
}

function makeLogin($sID, $password){
    global $connection;

    $selectQuery = "SELECT * FROM `staff_login` WHERE `sid` = '$sID' AND `dob` = '$password'";
    $selectQueryResult = mysqli_query($connection, $selectQuery);
    $rowCounter = mysqli_num_rows($selectQueryResult);
    if($rowCounter != 0 && $rowCounter == 1){
        return true;
    } 
    return false; 
}

function makeAlert($subject, $location){
    ?>
    <script>
        var message = "<?php echo $subject ?>";
        if(!alert(message)){
            window.location.replace($location);
        };
    </script>
    <?php
    
}

function calculateDays(){
    $date1=date_create($_POST["fromDate"]);
    $date2=date_create($_POST["toDate"]);
    $diff=date_diff($date1,$date2)->format("%a");

    $fromDateLengthOfDay = $_POST["fromDateLengthOfDay"];
    $toDateLengthOfDay = $_POST["toDateLengthOfDay"];
    if($diff == 0){
        if($fromDateLengthOfDay == "Full day" && $toDateLengthOfDay == "Full day"){
            return 1;
        }elseif($fromDateLengthOfDay == "Morning" && $toDateLengthOfDay == "Morning"){
            return 0.5;
        }elseif($fromDateLengthOfDay == "Afternoon" && $toDateLengthOfDay == "Afternoon"){
            return 0.5;
        }else{
            ?>
                <script>
                    if(!alert("Wrong date creditionals of Length of day! Please fil again.")){
                        window.location.replace("http://localhost:8080/leaveapp/leaveportal.php");
                    };
                </script>
        <?php
        }
    }elseif($diff == 1){
        if($fromDateLengthOfDay == "Full day" && $toDateLengthOfDay == "Morning"){
            return 1.5;
        }elseif($fromDateLengthOfDay == "Afternoon" && $toDateLengthOfDay == "Morning"){
            return 1;
        }elseif($fromDateLengthOfDay == "Afternoon" && $toDateLengthOfDay == "Full day"){
            return 1.5;
        }else{
            ?>
                <script>
                    if(!alert("Wrong date creditionals of Length of day! Please fil again.")){
                        window.location.replace("http://localhost:8080/leaveapp/leaveportal.php");
                    };
                </script>
            <?php
        }
    }else{
        ?>
        <script>
            if(!alert("More than 1.5 day leaves are not provided. Please contact DEAN!")){
                window.location.replace("http://localhost:8080/leaveapp/leaveportal.php");
            };
        </script>
        <?php
    }
}


?>

