<?php
include("adformheader.php");
include("dbconnection.php");

if(isset($_GET['delid'])) {
    $delid = mysqli_real_escape_string($con, $_GET['delid']);
    $sql ="DELETE FROM appointment WHERE appointmentid='$delid'";
    $qsql = mysqli_query($con, $sql);
    if(mysqli_affected_rows($con) == 1) {
        echo "<script>alert('Appointment record deleted successfully.');</script>";
    }
} 

if(isset($_GET['approveid'])) {
    $approveid = mysqli_real_escape_string($con, $_GET['approveid']);
    $sql ="UPDATE appointment SET status='Approved' WHERE appointmentid='$approveid'";
    $qsql = mysqli_query($con, $sql);
    if(mysqli_affected_rows($con) == 1) {
        echo "<script>alert('Appointment record approved successfully.');</script>";
    }
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">View Appointment Records</h2>
    </div>
    <div class="card">
        <section class="container">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <th>Farmer Detail</th>
                        <th>Date & Time</th>
                        <th>Traits</th>
                        <th>Vet</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM appointment WHERE status != ''";
                    if(isset($_SESSION['patientid'])) {
                        $sql .= " AND patientid='{$_SESSION['patientid']}'";
                    }
                    $qsql = mysqli_query($con, $sql);
                    while($rs = mysqli_fetch_array($qsql)) {
                        $sqlpat = "SELECT * FROM patient WHERE patientid='{$rs['patientid']}'";
                        $qsqlpat = mysqli_query($con, $sqlpat);
                        $rspat = mysqli_fetch_array($qsqlpat);

                        // Fetch bull catalog name using its ID from appointment table
                        $sqldept = "SELECT Name FROM bullcatalog WHERE id='{$rs['departmentid']}'";
                        $qsqldept = mysqli_query($con, $sqldept);
                        $rsdept = mysqli_fetch_array($qsqldept);

                        $sqldoc = "SELECT * FROM doctor WHERE doctorid='{$rs['doctorid']}'";
                        $qsqldoc = mysqli_query($con, $sqldoc);
                        $rsdoc = mysqli_fetch_array($qsqldoc);

                        echo "<tr>
                                <td>{$rspat['patientname']}<br>{$rspat['mobileno']}</td>
                                <td>" . date("d-M-Y", strtotime($rs['appointmentdate'])) . " " . date("H:i A", strtotime($rs['appointmenttime'])) . "</td>
                                <td>{$rspat['gender']}</td>
                                <td>{$rsdoc['doctorname']}</td>
                                <td>{$rs['app_reason']}</td>
                                <td>{$rs['status']}</td>
                                <td>";

                        if($rs['status'] != "Approved") {
                            if(!isset($_SESSION['patientid'])) {
                                echo "<a href='appointmentapproval.php?editid={$rs['appointmentid']}'>Approve</a><br>";
                            }
                            echo "<a href='viewappointment.php?delid={$rs['appointmentid']}'>Delete</a>";
                        } else {
                            echo "<a href='farmerreport.php?patientid={$rs['patientid']}&appointmentid={$rs['appointmentid']}'>View Report</a>";
                        }

                        echo "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
<?php
include("adformfooter.php");
?>
