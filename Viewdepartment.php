<?php
include("adformheader.php");
include("dbconnection.php");

if (isset($_GET['delid'])) {
    $sql = "DELETE FROM bullcatalog WHERE id='$_GET[delid]'";
    $qsql = mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
        echo "<script>
        Swal.fire({
            title: 'Done!',
            text: 'Bull Catalog deleted successfully',
            type: 'success',
        })</script>";
    }
}
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">View Bull Catalog Record</h2>
    </div>
    <div class="card">
        <section class="container">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><strong>Bull Catalog Description</strong></td>
                        <td><strong>Status</strong></td>
                        <?php
                        if (isset($_SESSION['adminid'])) {
                            ?>
                            <td><strong>Action</strong></td>
                            <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM bullcatalog";
                    $qsql = mysqli_query($con, $sql);
                    while ($rs = mysqli_fetch_array($qsql)) {
                        echo "<tr>
                        <td>$rs[Name]</td>
                        <td>$rs[Description]</td>
                        <td>$rs[Status]</td>";
                        if (isset($_SESSION['adminid'])) {
                            echo "<td>
                            <a href='department.php?editid=$rs[id]'>Edit</a> | 
                            <a href='viewdepartment.php?delid=$rs[id]'>Delete</a>
                            </td>";
                        }
                        echo "</tr>";
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
