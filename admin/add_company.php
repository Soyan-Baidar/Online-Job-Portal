<?php 
include('include/header.php');
include('include/sidebar.php');
?>
<?php
include('connection/db.php');
$query = mysqli_query($conn, "SELECT * FROM admin_login WHERE admin_type ='1' OR admin_type='2'");
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="create_company.php">Company</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Company</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2"></div>
        </div>
    </div>
    <div style="width: 60%; margin-left: 20%; background-color: #CCD1D1">
        <div id="msg"></div>
        <form action="" method="post" style="margin: 3%; padding: 3%" name="Company_form" id="Company_form">
            <div class="form-group">
                <label for="Company">Company Name</label>
                <input type="text" name="Company" id="Company" class="form-control" placeholder="Enter Company Name">
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="Description" id="Description" class="form-control" placeholder="Enter Description" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="admin">Select Company Admin</label>
                <select name="admin" id="admin" class="form-control">
                    <?php while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['admin_email']; ?>"><?php echo $row['admin_email']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-block btn-success" placeholder="Save" name="submit" id="submit">
            </div>
        </form>
    </div>
    <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
</main>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>
<script>
  $(document).ready(function(){
    $("#submit").click(function(e){
      e.preventDefault(); // Prevent default form submission
      
      var Company = $("#Company").val();
      var Description = $("#Description").val();
      
      if(Company == ''){
        $("#msg").html("<div class='alert alert-danger'>Company Name Error</div>");
        return false;
      }
      if(Description == ''){
        $("#msg").html("<div class='alert alert-danger'>Description Error</div>");
        return false;
      }
      
      var data = $("#Company_form").serialize();
      
      $.ajax({
        type: "post",
        url: "Company_add.php",
        data: data,
        success: function(response){
          $("#msg").html(response); // Display response message in div
          if(response.includes("success")) {
            $("#msg").html("<div class='alert alert-success'>Form submitted successfully!</div>"); // Show success message
          } else {
            $("#msg").html("<div class='alert alert-success'>Form submitted successfully!</div>"); // Show success message
          }
        },
        error: function(){
          $("#msg").html("<div class='alert alert-danger'>An error occurred while submitting the form. Please try again.</div>");
        }
      });
    });
  });
</script>
</body>
</html>
