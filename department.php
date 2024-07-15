<?php
include("adheader.php");
include("dbconnection.php");

if (isset($_POST['submit'])) {
    if (isset($_GET['editid'])) {
        $sql = "UPDATE bullcatalog SET Name='$_POST[bullname]', Description='$_POST[textarea]', Status='$_POST[select]' WHERE id='$_GET[editid]'";
        if ($qsql = mysqli_query($con, $sql)) {
            echo "<script>alert('Bull Catalog record updated successfully...');</script>";
        } else {
            echo mysqli_error($con);
        }
    } else {
        $sql = "INSERT INTO bullcatalog(Name, Description, Status) VALUES ('$_POST[bullname]', '$_POST[textarea]', '$_POST[select]')";
        if ($qsql = mysqli_query($con, $sql)) {
            echo "<script>alert('Bull Catalog record inserted successfully...');</script>";
        } else {
            echo mysqli_error($con);
        }
    }
}

if (isset($_GET['editid'])) {
    $sql = "SELECT * FROM bullcatalog WHERE id='$_GET[editid]'";
    $qsql = mysqli_query($con, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Add New Bull Catalog</h2>
    </div>
    <div class="card">
        <form method="post" action="" name="frmdept" onSubmit="return validateform()">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td width="34%">Bull Catalog Name</td>
                        <td width="66%">
                            <input placeholder="Enter Here" class="form-control" type="text" name="bullname" id="bullname" value="<?php echo $rsedit['Name']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>
                            <textarea placeholder="Enter Here" class="form-control no-resize" name="textarea" id="textarea" cols="45" rows="5"><?php echo $rsedit['Description']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="select" id="select" class="form-control show-tick">
                                <option value="">Select</option>
                                <?php
                                $arr = array("Active", "Inactive");
                                foreach ($arr as $val) {
                                    if ($val == $rsedit['Status']) {
                                        echo "<option value='$val' selected>$val</option>";
                                    } else {
                                        echo "<option value='$val'>$val</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input class="btn btn-default" type="submit" name="submit" id="submit" value="Submit" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <p>&nbsp;</p>
    </div>
</div>
<?php
include("adfooter.php");
?>
<script type="application/javascript">
var alphaspaceExp = /^[a-zA-Z\s]+$/; // Variable to validate only alphabets and space

function validateform() {
    if (document.frmdept.bullname.value == "") {
        alert("Bull Catalog name should not be empty..");
        document.frmdept.bullname.focus();
        return false;
    } else if (!document.frmdept.bullname.value.match(alphaspaceExp)) {
        alert("Bull Catalog name not valid..");
        document.frmdept.bullname.focus();
        return false;
    } else if (document.frmdept.select.value == "") {
        alert("Kindly select the status..");
        document.frmdept.select.focus();
        return false;
    } else {
        return true;
    }
}
</script>
