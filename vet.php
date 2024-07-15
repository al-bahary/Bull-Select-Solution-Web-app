<?php
include("adheader.php");
include("dbconnection.php");

if (isset($_POST['submit'])) {
    if (isset($_GET['editid'])) {
        $sql = "UPDATE doctor SET doctorname='$_POST[doctorname]', mobileno='$_POST[mobilenumber]', loginid='$_POST[loginid]', password='$_POST[password]', status='$_POST[select]', education='$_POST[education]', experience='$_POST[experience]', consultancy_charge='$_POST[consultancy_charge]', city='$_POST[city]' WHERE doctorid='$_GET[editid]'";
        if ($qsql = mysqli_query($con, $sql)) {
            echo "<script>alert('Doctor record updated successfully...');</script>";
        } else {
            echo mysqli_error($con);
        }
    } else {
        $sql = "INSERT INTO doctor(doctorname, mobileno, loginid, password, status, education, experience, consultancy_charge, city) VALUES ('$_POST[doctorname]', '$_POST[mobilenumber]', '$_POST[loginid]', '$_POST[password]', 'Active', '$_POST[education]', '$_POST[experience]', '$_POST[consultancy_charge]', '$_POST[city]')";
        if ($qsql = mysqli_query($con, $sql)) {
            echo "<script>alert('Doctor record inserted successfully...');</script>";
        } else {
            echo mysqli_error($con);
        }
    }
}

if (isset($_GET['editid'])) {
    $sql = "SELECT * FROM doctor WHERE doctorid='$_GET[editid]'";
    $qsql = mysqli_query($con, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Add New Vet</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <form method="post" action="" name="frmdoct" onSubmit="return validateform()" style="padding: 10px">
                    <div class="form-group">
                        <label>Vet Name</label>
                        <div class="form-line">
                            <input class="form-control" type="text" name="doctorname" id="doctorname" value="<?php echo $rsedit['doctorname']; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <div class="form-line">
                            <input class="form-control" type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit['mobileno']; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <div class="form-line">
                            <input class="form-control" type="text" name="city" id="city" value="<?php echo $rsedit['city']; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Login ID</label>
                        <div class="form-line">
                            <input class="form-control" type="text" name="loginid" id="loginid" value="<?php echo $rsedit['loginid']; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="form-line">
                            <input class="form-control" type="password" name="password" id="password" value="<?php echo $rsedit['password']; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="form-line">
                            <input class="form-control" type="password" name="cnfirmpassword" id="cnfirmpassword" value="<?php echo $rsedit['password']; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Education</label>
                        <div class="form-line">
                            <input class="form-control" type="text" name="education" id="education" value="<?php echo $rsedit['education']; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Experience</label>
                        <div class="form-line">
                            <input class="form-control" type="text" name="experience" id="experience" value="<?php echo $rsedit['experience']; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Consultancy Charge</label>
                        <div class="form-line">
                            <input class="form-control" type="text" name="consultancy_charge" id="consultancy_charge" value="<?php echo $rsedit['consultancy_charge']; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-line">
                            <select class="form-control show-tick" name="select" id="select">
                                <option value="" selected="" hidden>Select</option>
                                <?php
                                $arr = array("Active", "Inactive");
                                foreach ($arr as $val) {
                                    if ($val == $rsedit['status']) {
                                        echo "<option value='$val' selected>$val</option>";
                                    } else {
                                        echo "<option value='$val'>$val</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <input class="btn btn-default" type="submit" name="submit" id="submit" value="Submit" />
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include("adfooter.php");
?>

<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
    if(document.frmdoct.doctorname.value == "")
    {
        alert("Doctor name should not be empty..");
        document.frmdoct.doctorname.focus();
        return false;
    }
    else if(!document.frmdoct.doctorname.value.match(alphaspaceExp))
    {
        alert("Doctor name not valid..");
        document.frmdoct.doctorname.focus();
        return false;
    }
    else if(document.frmdoct.mobilenumber.value == "")
    {
        alert("Mobile number should not be empty..");
        document.frmdoct.mobilenumber.focus();
        return false;
    }
    else if(!document.frmdoct.mobilenumber.value.match(numericExpression))
    {
        alert("Mobile number not valid..");
        document.frmdoct.mobilenumber.focus();
        return false;
    }
    else if(document.frmdoct.city.value == "")
    {
        alert("City should not be empty..");
        document.frmdoct.city.focus();
        return false;
    }
    else if(!document.frmdoct.city.value.match(alphaspaceExp))
    {
        alert("City not valid..");
        document.frmdoct.city.focus();
        return false;
    }
    else if(document.frmdoct.loginid.value == "")
    {
        alert("Login ID should not be empty..");
        document.frmdoct.loginid.focus();
        return false;
    }
    else if(!document.frmdoct.loginid.value.match(alphanumericExp))
    {
        alert("Login ID not valid..");
        document.frmdoct.loginid.focus();
        return false;
    }
    else if(document.frmdoct.password.value == "")
    {
        alert("Password should not be empty..");
        document.frmdoct.password.focus();
        return false;
    }
    else if(document.frmdoct.password.value.length < 8)
    {
        alert("Password length should be more than 8 characters...");
        document.frmdoct.password.focus();
        return false;
    }
    else if(document.frmdoct.password.value != document.frmdoct.cnfirmpassword.value )
    {
        alert("Password and confirm password should be equal..");
        document.frmdoct.password.focus();
        return false;
    }
    else if(document.frmdoct.education.value == "")
    {
        alert("Education should not be empty..");
        document.frmdoct.education.focus();
        return false;
    }
    else if(!document.frmdoct.education.value.match(alphaspaceExp))
    {
        alert("Education not valid..");
        document.frmdoct.education.focus();
        return false;
    }
    else if(document.frmdoct.experience.value == "")
    {
        alert("Experience should not be empty..");
        document.frmdoct.experience.focus();
        return false;
    }
    else if(!document.frmdoct.experience.value.match(numericExpression))
    {
        alert("Experience not valid..");
        document.frmdoct.experience.focus();
        return false;
    }
    else if(document.frmdoct.consultancy_charge.value == "")
    {
        alert("Consultancy charge should not be empty..");
        document.frmdoct.consultancy_charge.focus();
        return false;
    }
    else if(!document.frmdoct.consultancy_charge.value.match(numericExpression))
    {
        alert("Consultancy charge not valid..");
        document.frmdoct.consultancy_charge.focus();
        return false;
    }
    else if(document.frmdoct.select.value == "" )
    {
        alert("Kindly select the status..");
        document.frmdoct.select.focus();
        return false;
    }
    else
    {
        return true;
    }
}
</script>
