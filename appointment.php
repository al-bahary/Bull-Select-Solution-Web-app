<?php

include("adheader.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
  if(isset($_GET[editid]))
  {
   $sql ="UPDATE appointment SET patientid='$_POST[select4]',departmentid='$_POST[select5]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]',doctorid='$_POST[select6]',status='$_POST[select]' WHERE appointmentid='$_GET[editid]'";
   if($qsql = mysqli_query($con,$sql))
   {
    echo "<script>alert('appointment record updated successfully...');</script>";
}
else
{
    echo mysqli_error($con);
}	
}
else
{
   $sql ="UPDATE patient SET status='Active' WHERE patientid='$_POST[select4]'";
   $qsql=mysqli_query($con,$sql);

   $sql ="INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason) values('$_POST[select4]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]','$_POST[appreason]')";
   if($qsql = mysqli_query($con,$sql))
   {

    include("insertbillingrecord.php");	
    echo "<script>alert('Appointment record inserted successfully...');</script>";
    echo "<script>window.location='farmerreport.php?patientid=$_POST[select4]';</script>";
}
else
{
    echo mysqli_error($con);
}
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>


<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Book Appointment</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Appointment Information </h2>

                </div>
                <form method="post" action="" name="frmappnt" onSubmit="return validateform()">
                    <input type="hidden" name="select2" value="Offline">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        if(isset($_GET[patid]))
                                        {
                                          $sqlpatient= "SELECT * FROM patient WHERE patientid='$_GET[patid]'";
                                          $qsqlpatient = mysqli_query($con,$sqlpatient);
                                          $rspatient=mysqli_fetch_array($qsqlpatient);
                                          echo $rspatient[patientname] . " (Patient ID - $rspatient[patientid])";
                                          echo "<input type='hidden' name='select4' value='$rspatient[patientid]'>";
                                      }
                                      else
                                      {
                                          ?>
                                        <select name="select4" id="select4" class=" form-control show-tick">
                                            <option value="">Select Farmer</option>
                                            <?php
                                            $sqlpatient= "SELECT * FROM patient WHERE status='Active'";
                                            $qsqlpatient = mysqli_query($con,$sqlpatient);
                                            while($rspatient=mysqli_fetch_array($qsqlpatient))
                                            {
                                                if($rspatient[patientid] == $rsedit[patientid])
                                                {
                                                 echo "<option value='$rspatient[patientid]' selected>$rspatient[patientid] - $rspatient[patientname]</option>";
                                             }
                                             else
                                             {
                                                 echo "<option value='$rspatient[patientid]'>$rspatient[patientid] - $rspatient[patientname]</option>";
                                             }

                                         }
                                         ?>
                                        </select>
                                        <?php
                                 }
                                 ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select5" id="select5" class=" form-control show-tick">
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

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="date" name="appointmentdate"
                                            id="appointmentdate" value="<?php echo $rsedit[appointmentdate]; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="time" name="time" id="time"
                                            value="<?php echo $rsedit[appointmenttime]; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select6" id="select6" class=" form-control show-tick">
                                            <option value="">Select Vet</option>
                                            <?php
                                                        $sqldept = "SELECT * FROM doctor WHERE status='Active'";
                                                        $qsqldept = mysqli_query($con, $sqldept);
                                                        while($rsdept = mysqli_fetch_array($qsqldept)) {
                                                            echo "<option value='$rsdept[doctorid]'>$rsdept[doctorname] ($rsdept[city])</option>";
                                                        }
                                                        ?>
                                                    </select>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" class="form-control no-resize" name="appreason"
                                            id="appreason" s><?php echo $rsedit[app_reason]; ?></textarea>


                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                                <div class="form-group drop-custum">
                                    <select name="select" id="select" class=" form-control show-tick">

                                        <option value="">Select Status</option>
                                        <?php
                        $arr = array("Active","Inactive");
                        foreach($arr as $val)
                        {
                           if($val == $rsedit[status])
                           {
                            echo "<option value='$val' selected>$val</option>";
                        }
                        else
                        {
                            echo "<option value='$val'>$val</option>";			  
                        }
                    }
                    ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-12">

                                <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit"
                                    value="Submit" />

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
















<?php include 'adfooter.php'; ?>
<script type="application/javascript">
function validateform() {
    if (document.frmappnt.select4.value == "") {
        alert("Patient name should not be empty..");
        document.frmappnt.select4.focus();
        return false;
    } else if (document.frmappnt.select3.value == "") {
        alert("Room type should not be empty..");
        document.frmappnt.select3.focus();
        return false;
    } else if (document.frmappnt.select5.value == "") {
        alert("Department name should not be empty..");
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
        alert("Doctor name should not be empty..");
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