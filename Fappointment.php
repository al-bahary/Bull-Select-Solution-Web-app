<?php
include("farmerheader.php");
include("dbconnection.php");

if(isset($_POST['submit'])) {
    if(isset($_GET['editid'])) {
        // Update existing appointment
        $sql ="UPDATE appointment SET patientid='{$_POST['select4']}', departmentid='{$_POST['select5']}', appointmentdate='{$_POST['appointmentdate']}', appointmenttime='{$_POST['time']}', doctorid='{$_POST['select6']}', status='{$_POST['select']}' WHERE appointmentid='{$_GET['editid']}'";
        if($qsql = mysqli_query($con,$sql)) {
            echo "<script>alert('Appointment record updated successfully...');</script>";
        } else {
            echo mysqli_error($con);
        }
    } else {
        // Insert new appointment and update patient status
        $sql ="UPDATE patient SET status='Active' WHERE patientid='{$_POST['select4']}'";
        $qsql=mysqli_query($con,$sql);

        $sql ="INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason) values('{$_POST['select4']}','{$_POST['select5']}','{$_POST['appointmentdate']}','{$_POST['time']}','{$_POST['select6']}','{$_POST['select']}','{$_POST['appreason']}')";
        if($qsql = mysqli_query($con,$sql)) {
            include("insertbillingrecord.php");	
            echo "<script>alert('Appointment record inserted successfully...');</script>";
            echo "<script>window.location='farmerreport.php?patientid={$_POST['select4']}';</script>";
        } else {
            echo mysqli_error($con);
        }
    }
}

if(isset($_GET['editid'])) {
    $sql="SELECT * FROM appointment WHERE appointmentid='{$_GET['editid']}'";
    $qsql = mysqli_query($con,$sql);
    $rsedit = mysqli_fetch_array($qsql);
}
?>
  <!-- Content -->
           <!-- Content -->
<div id="content">
    <!-- Make an Appointment -->
    <section class="main-appointment">
        <div class="container bg-gray">
            <div class="row justify-content-center">
                <!-- Make an Appointment -->
                <div class="col-lg-7">
                    <div class="appointment">
                        <!-- Heading -->
                        <div class="heading-block head-left margin-bottom-50">
                            <h4>Make an Appointment</h4>
                        </div>
                        <form method="post" action="" name="frmappnt" onSubmit="return validateform()" class="appointment-form">
                            <ul class="row">
                                <li class="col-sm-6">
                                    <label>
                                        <input placeholder="Farmer's Name" type="text" class="form-control" name="patiente" id="patiente" value="<?php echo isset($rspatient['patientname']) ? $rspatient['patientname'] : ''; ?>">
                                        <i class="icon-user"></i>
                                    </label>
                                </li>
                                <li class="col-sm-6">
                                    <label>
                                        <input placeholder="Address" type="text" class="form-control" name="textarea" id="textarea" value="<?php echo isset($rspatient['address']) ? $rspatient['address'] : ''; ?>">
                                        <i class="icon-compass"></i>
                                    </label>
                                </li>
                                <li class="col-sm-6">
                                    <label>
                                        <input placeholder="City" type="text" class="form-control" name="city" id="city" value="<?php echo isset($rspatient['city']) ? $rspatient['city'] : ''; ?>">
                                        <i class="icon-pin"></i>
                                    </label>
                                </li>
                                <li class="col-sm-6">
                                    <label>
                                        <input placeholder="Contact Number" type="text" class="form-control" name="mobileno" id="mobileno" value="<?php echo isset($rspatient['mobileno']) ? $rspatient['mobileno'] : ''; ?>">
                                        <i class="icon-phone"></i>
                                    </label>
                                </li>
                                <?php if(!isset($_SESSION['patientid'])) { ?>
                                    <li class="col-sm-6">
                                        <label>
                                            <input placeholder="Login ID" type="text" class="form-control" name="loginid" id="loginid" value="<?php echo isset($rspatient['loginid']) ? $rspatient['loginid'] : ''; ?>">
                                            <i class="icon-login"></i>
                                        </label>
                                    </li>
                                    <li class="col-sm-6">
                                        <label>
                                            <input placeholder="Password" type="password" class="form-control" name="password" id="password" value="<?php echo isset($rspatient['password']) ? $rspatient['password'] : ''; ?>">
                                            <i class="icon-lock"></i>
                                        </label>
                                    </li>
                                <?php } ?>
                                <li class="col-sm-6">
                                    <label>
                                        <select name="select5" id="select5">
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
                                        <select name="select6" id="select6">
                                            <option value="" selected hidden>Select Bull Traits</option>
                                            <?php
                                            $genders = array("Milk Production", "Meat Quality", "Adaptability", "Disease Resistance");
                                            foreach ($genders as $gender) {
                                                $selected = (isset($_POST['select6']) && $_POST['select6'] == $gender) ? 'selected' : '';
                                                echo "<option value='$gender' $selected>$gender</option>";
                                            }
                                            ?>
                                        </select>
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

<?php include 'adfooter.php'; ?>

<script type="application/javascript">
function validateform() {
    if (document.frmappnt.select4.value == "") {
        alert("farmer name should not be empty..");
        document.frmappnt.select4.focus();
        return false;
    } else if (document.frmappnt.select5.value == "") {
        alert("Breed should not be empty..");
        document.frmappnt.select5.focus();
        return false;
    } else if (document.frmappnt.appointmentdate.value == "") {
        alert("Appointment date should not be empty..");
        document.frmappnt.appointmentdate.focus();
        return false;
    } else if (document.frmappnt.time.value == "") {
        alert("Appointment time should not be empty..");
        document.frmappnt.time.focus();
        return false;
    } else if (document.frmappnt.select6.value == "") {
        alert("Service should not be empty..");
        document.frmappnt.select6.focus();
        return false;
    } else if (document.frmappnt.select.value == "") {
        alert("Kindly select the status..");
        document.frmappnt.select.focus();
        return false;
    } else {
        return true;
    }
}
</script>
