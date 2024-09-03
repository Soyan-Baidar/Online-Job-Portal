<?php
include('connection/db.php');
include('include/header.php');
include('include/sidebar.php');
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">All Jobs</h1>
        <nav aria-label="breadcrumb">
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                </div>
                <a class="btn btn-primary" href="add_create_job.php">Create Job</a>
            </div>
        </nav>
    </div>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SN</th>
                <th>Admin</th>
                <th>Job Title</th>
                <th>Description</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Keyword</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to select all jobs
            $query = mysqli_query($conn, "SELECT * FROM all_jobs WHERE customer_email='{$_SESSION['email']}'");
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?php echo $row['job_id']; ?></td>
                    <td><?php echo $row['customer_email']; ?></td>
                    <td><?php echo $row['job_title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['country']; ?></td>
                    <td><?php echo $row['state']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['keyword']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td>
                        <div class="row">
                            <div class="btn-group">
                                <a href="job_edit.php?edit=<?php echo $row['job_id']; ?>" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="job_delete.php?del=<?php echo $row['job_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>SN</th>
                <th>Admin</th>
                <th>Job Title</th>
                <th>Description</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Keyword</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

    <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
</main>
</div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
<!-- DataTables plugin -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script>
    new DataTable('#example');
</script>
</body>
</html>
