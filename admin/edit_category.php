<?php
include('connection/db.php');
include('include/header.php');
include('include/sidebar.php');

$id = $_GET['edit'];
$query = mysqli_query($conn, "SELECT * FROM job_category WHERE id = '$id'");
while ($row = mysqli_fetch_array($query)) {
    $category = $row['category'];
    $description = $row['description'];
}
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="category.php">Category</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Update Category</h1>
    </div>
    <div style="width: 60%; margin-left: 20%; background-color: #CCD1D1">
        <div id="msg"></div>
        <form action="" method="post" style="margin: 3%; padding: 3%" name="customer_form" id="customer_form">
            <div class="form-group">
                <label for="Customer Email">Category</label>
                <input type="text" name="category" id="category" value="<?php echo $category; ?>" class="form-control" placeholder="Enter Category">
            </div>
            <div class="form-group">
                <label for="Customer Username">Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10"><?php echo $description; ?></textarea>
            </div>
            <input type="hidden" name="id" id="id" value="<?php echo $_GET['edit']; ?>">
            <div class="form-group">
                <input type="submit" class="btn btn-block btn-success" value="Update" name="submit" id="submit">
            </div>
        </form>
    </div>
</main>
</div>
</div>
<!-- Bootstrap core JavaScript -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>feather.replace()</script>
<!--datatables plugin -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script>new DataTable('#example');</script>

<?php
include('connection/db.php');
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $query1 = mysqli_query($conn, "UPDATE job_category SET 
                    category='$category', 
                    description='$description'
                    WHERE id = '$id'");
    if ($query1) {
        echo "<script>alert('Record Updated Successfully!')</script>";
    } else {
        echo "<script>alert(Error)</script>";
    }
}
?>
