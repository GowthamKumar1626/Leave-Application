<?php require("configure.php");?>
<?php include "functions.php";?>
<?php include "includes/header.php"; ?>
<style>
.content{
    overflow-y: scroll;
}
th{
    text-align: center;
}
td{
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
if($_SESSION["sID"] == 'admin'){
?>
    <div class="centered">
        <img src="./images/logo.jpg" alt="logo">
    </div>

    <div style="margin-left:2rem; margin-right:2rem; margin-top: 10%; background-color: rgb(82, 87, 84); color: white; z-index: 1;">
        <center style="padding: 1rem;">Leave Application</center>
    </div>

    <br>

    <div style="margin-left: 2rem; margin-right: 2rem;">
    <table border="2" style="width: 100%;">
        <tr>
            <th>SID</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>No.of Days</th>
            <th>Reason</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        $selectQuery = "SELECT `sid`,`fromdate`,`todate`,`leave_applied_in_days`,`Reason` FROM `leave_status` WHERE `status`='Pending';";
        $selectQueryResult = mysqli_query($connection, $selectQuery);
        while($row = mysqli_fetch_row($selectQueryResult)){
            ?>
            <tr>
                <td><?php print_r($row[0]); ?></td>
                <td><?php print_r($row[1]); ?></td>
                <td><?php print_r($row[2]); ?></td>
                <td><?php print_r($row[3]); ?></td>
                <td><?php print_r($row[4]); ?></td>
                <td>
                    <center><a href="includes/adminActions.php?sid=<?php echo $row[0];?>&fromdate=<?php print_r($row[1]); ?>&todate=<?php print_r($row[2]); ?>&status=Approved" class="btn btn-success" style="margin-left: 1rem;">Permit</a></center>
                </td>
                <td>
                    <center><a href="includes/adminActions.php?sid=<?php echo $row[0];?>&fromdate=<?php print_r($row[1]); ?>&todate=<?php print_r($row[2]); ?>&status=Rejected"" class="btn btn-danger" style="margin-left: 1rem;">Not Permit</a></center>
                </td>
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
