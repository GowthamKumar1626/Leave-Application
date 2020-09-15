<div class="centered">
    <img src="./images/logo.jpg" alt="logo">
</div>

<div style="margin-left:2rem; margin-right:2rem; margin-top: 10%; background-color: rgb(82, 87, 84); color: white; z-index: 1;">
    <center style="padding: 1rem;">Leave Application</center>
</div>


<div class="split left">
    <form action="./leaveApply.php" method="POST">
        <table border="2"> 
            <tr>
                <td>Your application forwarded to: </td>
                <td style="color:Blue;">Rajan K S</td>
            </tr>
            <tr>
                <td>Your SID:</td>
                <td style="color:Blue;"><?php echo $_SESSION["sID"]?></td>
            </tr>
            <tr>
                <td>Leave Period <span style="color:red;">*</span> </td>
                <td>
                    <select name="leavePeriod" id="leavePeriod">
                        <?php
                        while($month <= 12){
                            $currentMonth = date('M Y',strtotime('first day of +'.$i.'month'));
                            $i++;
                            $nextMonth = date('M Y',strtotime('first day of +'.$i.'month'));
                            ?>
                            <option><?php echo "$currentMonth - $nextMonth"; ?></option>
                            <?php
                            echo "<br>";
                            $month++;
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Leave Type <span style="color:red;">*</span></td>
                <td>
                    <select name="leaveType" id="leaveType" required>
                        <option value="Casual Leave">Casual Leave</option>
                        <option value="Personal Leave">Personal Leave</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>From Date <span style="color:red;">*</span></td>
                <td>
                    <input type="date" name="fromDate" required>
                    <select name="fromDateLengthOfDay" id="lengthOfDay">
                        <option value="Full day">Full day</option>
                        <option value="Morning">Morning</option>
                        <option value="Afternoon">Afternoon</option>
                    </select>
                </td>
                
            </tr>
            <tr>
                <td>To Date <span style="color:red;">*</span></td>
                <td>
                    <input type="date" name="toDate" required>
                    <select name="toDateLengthOfDay" id="lengthOfDay">
                    <option value="Full day">Full day</option>
                        <option value="Morning">Morning</option>
                        <option value="Afternoon">Afternoon</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Leave Applied in days<span style="color:red;">*</span></td>
                <td><input type="text" name="leaveApplied" required></td>
            </tr>
            <tr>
                <td>Reason<span style="color:red;">*</span></td>
                <td>
                    <textarea name="reason" rows="4" cols="50" required></textarea>
                </td>
            </tr>
        </table>
        <br>
        <center>
            <input type="submit" class="btn btn-light" value="Apply Leave" name="applyLeave">
            </form>
            <button onclick="myFunction()" class="btn btn-light" name="refresh">Refresh</button>
        </center>
        <br>
   
</div>

<script>
    function myFunction(){
        location.reload();
    }
</script>