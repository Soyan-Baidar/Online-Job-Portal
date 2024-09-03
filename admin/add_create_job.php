<?php 
include('include/header.php');
include('include/sidebar.php');

// Fetch job categories
$query = mysqli_query($conn, "SELECT * FROM job_category");
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="job_create.php">All Jobs</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Job</h1>
        <nav aria-label="breadcrumb">
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                </div>
            </div>
        </nav>
    </div>
    <div style="width: 60%; margin-left: 20%; background-color: #CCD1D1">
        <div id="msg"></div>
        <form action="add_new_job.php" method="post" style="margin: 3%; padding: 3%" name="job_form" id="job_form">
            <div class="form-group">
                <label for="job_title">Job Title</label>
                <input type="text" name="job_title" id="job_title" class="form-control" placeholder="Enter Job Title">
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="Description" id="Description" class="form-control" placeholder="Enter Description" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="keyword">Enter Keyword</label>
                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Enter keyword">
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" id="countryID" class="form-control" placeholder="Enter Country">
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" name="state" id="stateID" class="form-control" placeholder="Enter State">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="cityID" class="form-control" placeholder="Enter City">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    <?php 
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['category']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-block btn-success" value="Save" name="submit" id="submit">
            </div>
        </form>
    </div>
    <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
</main>

<!-- Script dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="//geodata.solutions/includes/countrystatecity.js"></script>
<script>
   $(document).ready(function(){
    $("#job_form").submit(function(e){
        e.preventDefault(); // Prevent form submission
        
        var job_title = $("#job_title").val();
        var description = $("#Description").val();
        var countryID = $("#countryID").val();
        var stateID = $("#stateID").val();
        var cityID = $("#cityID").val();
        var keyword = $("#keyword").val();
        var category = $("#category").val(); // Get the value of the category field

        
        // Validate inputs
        if (job_title.trim() === '') {
            alert("Please enter Job Title");
            return false;
        }
        if (description.trim() === '') {
            alert("Please enter Description");
            return false;
        }
        
        
        if (countryID === '' || stateID === '' || cityID === '') {
            alert("Please enter Country, State, and City");
            return false;
        }
        if (keyword.trim() === '') { // Check if keyword is empty
            alert("Please enter Keyword");
            return false;
        }
        if (category.trim() === '') { // Check if category is empty
            alert("Please select Category");
            return false;
        }
        
        // Submit the form via AJAX
        $.ajax({
            type: "POST",
            url: "add_new_job.php",
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                $("#msg").html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log the error message to the console
                alert("An error occurred while processing your request. Please try again later.");
            }
        });
    });
});
</script>

</body>
</html>
