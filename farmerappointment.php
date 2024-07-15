<?php
include("header.php");
include("dbconnection.php");

if(isset($_POST['submit'])) {
    // Check if patient session exists or insert new patient record
    if(isset($_SESSION['patientid'])) {
        $lastinsid = $_SESSION['patientid'];
    } else {
        $dt = date("Y-m-d");
        $tim = date("H:i:s");
        $sql = "INSERT INTO patient(patientname, admissiondate, admissiontime, address, city, mobileno, loginid, password, gender, dob, status) 
                VALUES ('$_POST[patiente]', '$dt', '$tim', '$_POST[textarea]', '$_POST[city]', '$_POST[mobileno]', '$_POST[loginid]', '$_POST[password]', '$_POST[select6]', '$_POST[dob]', 'Active')";
        if($qsql = mysqli_query($con, $sql)) {
            $lastinsid = mysqli_insert_id($con);
        } else {
            echo mysqli_error($con);
            exit; // Exit if patient insert fails
        }
    }
    
    // Check if appointment already exists for the selected date and time
    $sqlappointment = "SELECT * FROM appointment WHERE appointmentdate='$_POST[appointmentdate]' AND appointmenttime='$_POST[appointmenttime]' AND doctorid='$_POST[doct]' AND status='Approved'";
    $qsqlappointment = mysqli_query($con, $sqlappointment);
    if(mysqli_num_rows($qsqlappointment) >= 1) {
        echo "<script>alert('Appointment already scheduled for this time..');</script>";
    } else {
        // Insert new appointment record
        $sql = "INSERT INTO appointment(appointmenttype, patientid, appointmentdate, appointmenttime, app_reason, status, departmentid, doctorid) 
                VALUES ('ONLINE', '$lastinsid', '$_POST[appointmentdate]', '$_POST[appointmenttime]', '$_POST[app_reason]', 'Pending', '$_POST[department]', '$_POST[doct]')";
        if($qsql = mysqli_query($con, $sql)) {
            echo "<script>alert('Appointment record inserted successfully...');</script>";
        } else {
            echo mysqli_error($con);
            exit; // Exit if appointment insert fails
        }
    }
}

// Fetch patient details if session exists
if(isset($_SESSION['patientid'])) {
    $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]'";
    $qsqlpatient = mysqli_query($con, $sqlpatient);
    $rspatient = mysqli_fetch_array($qsqlpatient);
    $readonly = " readonly";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="wrapper col4">
    <div id="container">

        <?php
        // Display message based on form submission
        if(isset($_POST['submit'])) {
            if(mysqli_num_rows($qsqlappointment) >= 1) {
                echo "<h2>Appointment already scheduled for ". date("d-M-Y", strtotime($_POST['appointmentdate'])) . " " . date("H:i A", strtotime($_POST['appointmenttime'])) . " .. </h2>";
            } else {
                if(isset($_SESSION['patientid'])) {
                    echo "<h2 class='text-center'>Appointment taken successfully.. </h2>";
                    echo "<p class='text-center'>Appointment record is in pending process. Kindly check the appointment status. </p>";
                    echo "<p class='text-center'> <a href='viewappointment.php'>View Appointment record</a>. </p>";			
                } else {
                    echo "<h2 class='text-center'>Appointment taken successfully.. </h2>";
                    echo "<p class='text-center'>Appointment record is in pending process. Please wait for confirmation message.. </p>";
                    echo "<p class='text-center'> <a href='farmerlogin.php'>Click here to Login</a>. </p>";	
                }
            }
        } else {
        ?>
            <!-- Content -->
            <div id="content">
                <!-- Make an Appointment -->
                <section class="main-oppoiment">
                    <div class="container bg-gray">
                        <div class="row justify-content-center">
                            <!-- Make an Appointment -->
                            <div class="col-lg-7">
                                <div class="appointment">
                                    <!-- Heading -->
                                    <div class="heading-block head-left margin-bottom-50">
                                        <h4>Make an Appointment</h4>
                                    </div>
                                    <form method="post" action="" name="frmpatapp" onSubmit="return validateform()" class="appointment-form">
                                        <ul class="row">
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="Farmer's Name" type="text" class="form-control" name="patiente" id="patiente" value="<?php echo isset($rspatient['patientname']) ? $rspatient['patientname'] : ''; ?>" <?php echo isset($readonly) ? $readonly : ''; ?>>
                                                    <i class="icon-user"></i>
                                                </label>
                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="Address" type="text" class="form-control" name="textarea" id="textarea" value="<?php echo isset($rspatient['address']) ? $rspatient['address'] : ''; ?>" <?php echo isset($readonly) ? $readonly : ''; ?>>
                                                    <i class="icon-compass"></i>
                                                </label>
                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="City" type="text" class="form-control" name="city" id="city" value="<?php echo isset($rspatient['city']) ? $rspatient['city'] : ''; ?>" <?php echo isset($readonly) ? $readonly : ''; ?>>
                                                    <i class="icon-pin"></i>
                                                </label>
                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="Contact Number" type="text" class="form-control" name="mobileno" id="mobileno" value="<?php echo isset($rspatient['mobileno']) ? $rspatient['mobileno'] : ''; ?>" <?php echo isset($readonly) ? $readonly : ''; ?>>
                                                    <i class="icon-phone"></i>
                                                </label>
                                            </li>
                                            <?php if(!isset($_SESSION['patientid'])) { ?>
                                                <li class="col-sm-6">
                                                    <label>
                                                        <input placeholder="Login ID" type="text" class="form-control" name="loginid" id="loginid" value="<?php echo isset($rspatient['loginid']) ? $rspatient['loginid'] : ''; ?>" <?php echo isset($readonly) ? $readonly : ''; ?>>
                                                        <i class="icon-login"></i>
                                                    </label>
                                                </li>
                                                <li class="col-sm-6">
                                                    <label>
                                                        <input placeholder="Password" type="password" class="form-control" name="password" id="password" value="<?php echo isset($rspatient['password']) ? $rspatient['password'] : ''; ?>" <?php echo isset($readonly) ? $readonly : ''; ?>>
                                                        <i class="icon-lock"></i>
                                                    </label>
                                                </li>
                                            <?php } ?>
                                            <li class="col-sm-6">
                                                <label>
                                                    <select name="department" id="department">
                                                        <option value="">Select Bull Catalog</option>
                                                        <?php
                                                        $sql = "SELECT Name FROM BullCatalog WHERE Status='Active'";
                                                        $result = mysqli_query($con, $sql);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option value='" . htmlspecialchars($row['Name']) . "'>" . htmlspecialchars($row['Name']) . "</option>";
                                                            }
                                                        } else {
                                                            echo "<option value=''>No active bull catalogs found</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <i class="ion-university"></i>
                                                </label>
                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <?php if(isset($_SESSION['patientid'])) {
                                                        echo $rspatient['gender'];
                                                    } else { ?>
                                                        <select name="select6" id="select6">
                                                            <option value="" selected hidden>Select Bull Traits</option>
                                                            <?php
                                                            $genders = array("Milk Production", "Meat Quality", "Adaptability", "Disease Resistance");
                                                            foreach ($genders as $gender) {
                                                                $selected = ($_POST['select6'] == $gender) ? 'selected' : '';
                                                                echo "<option value='$gender' $selected>$gender</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php } ?>
                                                    <i class="ion-transgender"></i>
                                                </label>
                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="Appointment Date" type="date" class="form-control" min="<?php echo date("Y-m-d"); ?>" name="appointmentdate" id="appointmentdate">
                                                    <i class="ion-calendar"></i>
                                                </label>
                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <input placeholder="Appointment Time" type="time" class="form-control" name="appointmenttime" id="appointmenttime">
                                                    <i class="ion-ios-clock"></i>
                                                </label>
                                            </li>
                                            <li class="col-sm-6">
                                                <label>
                                                    <select name="doct" id="doct">
                                                        <option value="">Select Vet</option>
                                                        <?php
                                                        $sqldept = "SELECT * FROM doctor WHERE status='Active'";
                                                        $qsqldept = mysqli_query($con, $sqldept);
                                                        while($rsdept = mysqli_fetch_array($qsqldept)) {
                                                            echo "<option value='$rsdept[doctorid]'>$rsdept[doctorname] ($rsdept[city])</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <i class="ion-medkit"></i>
                                                </label>
                                            </li>
                                            <li class="col-sm-12">
                                                <label>
                                                    <textarea class="form-control" name="app_reason" placeholder="Appointment reason"></textarea>
                                                </label>
                                            </li>
                                            <li class="col-sm-12">
                                                <center><button type="submit" class="btn" name="submit" id="submit">Book an Appointment</button></center>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        <?php } ?>

    </div>
</div>

<?php include("footer.php"); ?>

<script type="application/javascript">
    var alphaExp = /^[a-zA-Z]+$/;
    var alphaspaceExp = /^[a-zA-Z\s]+$/;
    var numericExpression = /^[0-9]+$/;
    var alphanumericExp = /^[0-9a-zA-Z]+$/;

    function validateform() {
        if (document.frmpatapp.patiente.value == "") {
            alert("Patient name should not be empty..");
            document.frmpatapp.patiente.focus();
            return false;
        } else if (!document.frmpatapp.patiente.value.match(alphaspaceExp)) {
            alert("Patient name not valid..");
            document.frmpatapp.patiente.focus();
            return false;
        } else if (document.frmpatapp.textarea.value == "") {
            alert("Address should not be empty..");
            document.frmpatapp.textarea.focus();
            return false;
        } else if (document.frmpatapp.city.value == "") {
            alert("City should not be empty..");
            document.frmpatapp.city.focus();
            return false;
        } else if (!document.frmpatapp.city.value.match(alphaspaceExp)) {
            alert("City name not valid..");
            document.frmpatapp.city.focus();
            return false;
        } else if (document.frmpatapp.mobileno.value == "") {
            alert("Mobile number should not be empty..");
            document.frmpatapp.mobileno.focus();
            return false;
        } else if (!document.frmpatapp.mobileno.value.match(numericExpression)) {
            alert("Mobile number not valid..");
            document.frmpatapp.mobileno.focus();
            return false;
        } else if (document.frmpatapp.loginid.value == "") {
            alert("Login ID should not be empty..");
            document.frmpatapp.loginid.focus();
            return false;
        } else if (!document.frmpatapp.loginid.value.match(alphanumericExp)) {
            alert("Login ID not valid..");
            document.frmpatapp.loginid.focus();
            return false;
        } else if (document.frmpatapp.password.value == "") {
            alert("Password should not be empty..");
            document.frmpatapp.password.focus();
            return false;
        } else if (document.frmpatapp.password.value.length < 8) {
            alert("Password length should be more than 8 characters...");
            document.frmpatapp.password.focus();
            return false;
        } else if (document.frmpatapp.select6.value == "") {
            alert("Gender should not be empty..");
            document.frmpatapp.select6.focus();
            return false;
        } else if (document.frmpatapp.dob.value == "") {
            alert("Date Of Birth should not be empty..");
            document.frmpatapp.dob.focus();
            return false;
        } else if (document.frmpatapp.appointmentdate.value == "") {
            alert("Appointment date should not be empty..");
            document.frmpatapp.appointmentdate.focus();
            return false;
        } else if (document.frmpatapp.appointmenttime.value == "") {
            alert("Appointment time should not be empty..");
            document.frmpatapp.appointmenttime.focus();
            return false;
        } else {
            return true;
        }
    }
</script>
