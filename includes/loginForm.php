<body>
    <div class="split left" style="width: 50%;">
        <div class="centered">
            <img src="images/logo.jpg" style="width: 100%; margin-top: 2rem; margin-left: 2rem;" alt="Avatar woman">
        </div>
    </div>
    <br><br>
    <div class="split left" style="width: 50%; font-size: x-large;">
        <center><strong>SASTRA UNIVERSITY</strong></center>
        <center>THIRUMALISAMUDRAM</center>
        <center>THANJAVUR - 613401</center>
        <center>TAMILNADU INDIA</center>
    </div>

    <div style="top: 2rem; right: 10%; position: fixed;">
        <div class="centered">
            <strong style="font-size:xxx-large; font-weight: 500;">eVarsity</strong>
        </div>
        <hr class="yellowLine">
        <div>
            <p>Enter your user id and password to login</p>
        </div>

        <div style="padding-top:2rem; right: 50%;">
            <form action="index.php" method="POST">
                <label for="sID">Your ID:</label>
                <input class="form-control" type="text" id="sID" name="sID" required>
                <label for="password">Password:</label>
                <input class="form-control" type="password" id="password" name="password" required>
                <br>
                <input class="btn btn-primary" type="submit" name="submit" value="Login">
            </form>
        </div>
    </div>
</body>