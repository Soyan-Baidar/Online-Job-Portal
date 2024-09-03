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
        <h1 class="h2">Applied Jobs</h1>
        <nav aria-label="breadcrumb">
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                </div>
            </div>
        </nav>
    </div>
    
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-6">
                <form action="" class="border p-4 rounded" style="background-color: #f8f9fa;">
                    <?php
                    $id = mysqli_real_escape_string($conn, $_GET['id']);

                    // Fetch data based on job_apply ID
                    $sql = "SELECT * FROM job_apply 
                            LEFT JOIN all_jobs ON job_apply.id_job = all_jobs.job_id 
                            WHERE job_apply.id = '$id'";
                    $query = mysqli_query($conn, $sql);

                    if ($query && $row = mysqli_fetch_array($query)) {
                    ?>
                        <h2 class="mb-4">Job Application Details</h2>
                        <table class="table table-striped">
                            <tr>
                                <td><strong>Job Title:</strong></td>
                                <td><?php echo htmlspecialchars($row['job_title']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Description:</strong></td>
                                <td><?php echo nl2br(htmlspecialchars($row['description'])); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Job Seeker:</strong></td>
                                <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Job Seeker Email:</strong></td>
                                <td><?php echo htmlspecialchars($row['job_seeker']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Job Seeker Mobile Number:</strong></td>
                                <td><?php echo htmlspecialchars($row['mobile_number']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Job Seeker File:</strong></td>
                                <td><a href="http://localhost/Summer%20Project/files/<?php echo htmlspecialchars($row['file']); ?>" class="btn btn-primary btn-sm">View File</a></td>
                            </tr>
                            <tr>
                                <td><strong>Cover Letter:</strong></td>
                                <td><?php echo nl2br(htmlspecialchars($row['cover_letter'])); ?></td>
                            </tr>
                        </table>
                        <div class="row mt-4">
                            <div class="col-6">
                                <a href="accept_mail.php?email=<?php echo htmlspecialchars($row['job_seeker']); ?>" class="btn btn-success btn-block">Accept</a>
                            </div>
                            <div class="col-6">
                                <a href="reject_job.php?id=<?php echo htmlspecialchars($id); ?>&email=<?php echo htmlspecialchars($row['job_seeker']); ?>" class="btn btn-danger btn-block">Reject</a>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "No job found with the specified ID.";
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
</main>
</div>
</div>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
<!--datatables plugin -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script>
    new DataTable('#example');
</script>

</body>
</html>
