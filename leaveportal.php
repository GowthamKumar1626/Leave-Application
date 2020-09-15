<?php require("configure.php"); ?>
<?php include "functions.php";?>
<?php include "includes/header.php"?>

<style>
.content{
    overflow-y: scroll;
}
th{
    text-align: center;
}
.left td{
    border: none;
    padding-right: 2rem;
}
.right td{
    padding-left: 1rem;
}
.centered {
  position: absolute;
  top: 8%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}
.centered img {
  width: 50%;
}
.split {
  height: 100%;
  width: 50%;
  position: fixed;
  z-index: 1;
  top: 16%;
  overflow-x: hidden;
  padding-top: 5rem;
}
.left {
  left: 2rem;
}
.right {
  right: 2rem;
}

tr:nth-child(even) {background-color: rgb(233, 245, 247);}
tr:nth-child(odd)  {background-color: rgb(177, 231, 242);}
</style>

<?php

if(isset($_SESSION["sID"])){
$sID = $_SESSION["sID"];
$month = date("m");
$i = 0; 
?>
<?php include "includes/leaveApplication.php"?>

<div class="split right">
    <label style="z-index: 1; float: right; color: blue;" for="previousLeaves">Previous 5 applied laeves application details</label>
    <table id="previousLeaves" border="2" style="float: right; width: 90%;">
        <tr>
            <th>From Date</th>
            <th>To Date</th>
            <th>Type</th>
            <th>No.of Days</th>
            <th>Status</th>
            <th>Withdraw</th>
        </tr>
            <?php
            $previousLeavesQuery = "SELECT `fromdate`, `todate`, `Type`, `leave_applied_in_days`, `status` FROM leave_status WHERE sid = '$sID' ORDER BY `fromdate` DESC;";
            $previousLeavesQueryResult = mysqli_query($connection, $previousLeavesQuery);
            if(mysqli_num_rows($previousLeavesQueryResult) == 0){
                ?>
                <td colspan="5"><center>No Records found</center></td>
                <td>No Action</td>
                <?php
            }
            $counter = 0;
            while($row = mysqli_fetch_row($previousLeavesQueryResult)){
                if($counter < 5){
                    ?>
                    <tr>
                        <td><?php print_r($row[0]); ?></td>
                        <td><?php print_r($row[1]); ?></td>
                        <td><?php print_r($row[2]); ?></td>
                        <td><?php print_r($row[3]); ?></td>
                        <?php
                            if($row[4] == 'Approved'){
                                ?>
                                <td style="color: green;"><?php print_r($row[4]); ?></td>
                                <?php
                            }elseif($row[4] == 'Pending'){
                                ?>
                                <td style="color: blue;"><?php print_r($row[4]); ?></td>
                                <?php
                            }else{
                                ?>
                                <td style="color: red;"><?php print_r($row[4]); ?></td>
                                <?php
                            }
                        
                         
                            if($row[4] == 'Pending'){
                                ?>
                                <td><a href="includes/deleteLeaveRequest.php?fromdate=<?php echo $row[0];?>" class="btn btn-danger">Delete</a></td>
                                <?php
                            }else{
                                ?>
                                <td>No action</td>
                                <?php
                            } 
                            ?>   
                    </tr>
                    <?php
                    $counter++;
                }else{
                break;
                }
            }
            ?>
    </table>

    <label style="float: right; color: blue; z-index: 1;" for="leaveAvailability">Leave Availability</label>
    <table id="leaveAvailability" border="2" style="float: right; width: 90%;">
        <tr>
            <th>Leave Type</th>
            <th>Eligibility</th>
            <th>Availability</th>
        </tr>
        <?php
            $leaveAvailabilityQuery = "SELECT `Type`, `leave_applied_in_days` FROM leave_status WHERE `sid`='$sID' AND `status`='Approved'";
            $leaveAvailabilityQueryResult = mysqli_query($connection, $leaveAvailabilityQuery);
            $available = 12;
            if(mysqli_num_rows($leaveAvailabilityQueryResult) == 0){
                ?>
                <tr>
                    <!-- <td colspan="3"><center>No Records found</center></td>
                 -->
                    <td>None</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <?php
            }
            while($row = mysqli_fetch_row($leaveAvailabilityQueryResult)){
                ?>
                <tr>
                    <td><?php print_r($row[0]); ?></td>
                    <td><?php echo $available; ?></td>
                    <?php $available -= $row[1]; ?>
                    <td><?php echo $available; ?></td>
                </tr>
                <?php
            }
            ?>
    </table>
</div>

<div style="position: fixed; right:50%; bottom: 20%; z-index: 1;">
    <a href="includes/logout.php" class="btn btn-primary">Logout</a>
</div>

    <?php
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










