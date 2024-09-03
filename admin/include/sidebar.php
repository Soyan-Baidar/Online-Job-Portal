<?php
include('connection/db.php');

$query=mysqli_query($conn,"SELECT * FROM admin_login WHERE admin_email='{$_SESSION['email']}' AND admin_type='1'");
if(mysqli_num_rows($query)>0){
  echo '<div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
             
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="Customers.php">
                  <span data-feather="users"></span>
                  Customers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="job_create.php">
                  <span data-feather="bar-chart-2"></span>
                  Job Create
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="create_company.php">
                  <span data-feather="layers"></span>
                  Company
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="category.php">
                  <span data-feather="file-text"></span>
                  Category
                </a>
              </li>
              
            </ul>
          </div>
        </nav>';
}else{
  echo '<div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
             
              </li>
              
                
              </li>
              <li class="nav-item">
                <a class="nav-link" href="job_create.php">
                  <span data-feather="bar-chart-2"></span>
                  Job Create
                </a>
              </li>
            
            <li class="nav-item">
                <a class="nav-link" href="apply_jobs.php">
                  <span data-feather="layers"></span>
                  Apply Jobs
                </a>
              </li>

           
              </li>
            </ul>
          </div>
        </nav>';
}
?>
