<?php 
include('include/header.php');
include('include/sidebar.php');

include('connection/db.php'); // Include the database connection file

// Execute all queries at once
$sql1 = mysqli_query($conn, "SELECT COUNT(*) AS job_count FROM all_jobs");
$sql2 = mysqli_query($conn, "SELECT COUNT(*) AS id FROM jobsekeer");
$sql3 = mysqli_query($conn, "SELECT COUNT(*) AS file FROM job_apply");
$sql4 = mysqli_query($conn, "SELECT COUNT(*) AS company_id FROM company");

// Fetch the results
$row1 = mysqli_fetch_assoc($sql1);
$row2 = mysqli_fetch_assoc($sql2);
$row3 = mysqli_fetch_assoc($sql3);
$row4 = mysqli_fetch_assoc($sql4);

// Extract the counts
$jobCount = $row1['job_count'];
$memberCount = $row2['id']; // Assuming 'id' represents the count of members
$resumeCount = $row3['file']; // Assuming 'file' represents the count of resumes
$companyCount = $row4['company_id']; // Assuming 'company_id' represents the count of companies
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" style="padding-top: 50px;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom" style="border-bottom: 2px solid #ccc; padding-bottom: 20px;">
        <h1 class="h2" style="margin-bottom: 20px;">Dashboard</h1>
    </div>

    <canvas class="my-4" id="myChart" width="900" height="380" style="border-radius: 10px; overflow: hidden; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); margin-bottom: 20px;"></canvas>

</main>

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

<!-- New Graph -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jobs", "Members", "Resumes", "Companies"],
            datasets: [{
                label: 'Count',
                data: [<?php echo $jobCount; ?>, <?php echo $memberCount; ?>, <?php echo $resumeCount; ?>, <?php echo $companyCount; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)', // Jobs
                    'rgba(54, 162, 235, 0.5)', // Members
                    'rgba(255, 206, 86, 0.5)', // Resumes
                    'rgba(75, 192, 192, 0.5)'  // Companies
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
</body>
</html>
