<?php 
include('include/header.php');
include('include/sidebar.php');
?>
<?php
include('connection/db.php');

// Initialize variables
$job_title = '';
$description = '';
$country = '';
$state = '';
$city = '';
$keyword = '';
$category = '';

// Check if job_id is set in the URL
if(isset($_GET['edit'])) {
    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['edit']);
    
    // Fetch job data from the database based on job_id
    $query = mysqli_query($conn, "SELECT * FROM all_jobs WHERE job_id = '$id'");
    
    // Check if the query was successful
    if($query) {
        // Fetch data row by row
        while($row = mysqli_fetch_array($query)) {
            // Assign fetched data to variables
            $job_title = $row['job_title'];
            $description = $row['description'];
            $country = $row['country'];
            $state = $row['state'];
            $city = $row['city'];
            $keyword = $row['keyword'];
            $category = $row['category'];
        }
    } else {
        // Display an error message if the query fails
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="job_create.php">All Job</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Job</h1>
        <nav aria-label="breadcrumb">
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                </div>
            </div>
        </nav>
    </div>
    <div style="width: 60%; margin-left: 20%; background-color: #CCD1D1">
        <div id="msg"></div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="margin: 3%; padding: 3%" name="job_form" id="job_form">
            <div class="form-group">
                <label for="job_title">Job Title</label>
                <input type="text" value="<?php echo $job_title; ?>" name="job_title" id="job_title" class="form-control" placeholder="Enter Job Title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter Description" cols="30" rows="10"><?php  echo $description; ?></textarea>
            </div>
            <div class="form-group">
    <label for="keyword">Keyword</label>
    <input type="text" value="<?php echo $keyword; ?>" name="keyword" id="keyword" class="form-control" placeholder="Enter Keyword">
</div>

            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" id="countryID" class="form-control" value="<?php  echo $country;?>" placeholder="Enter Country">
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" name="state" id="stateID" class="form-control"  value="<?php  echo $state;?>" placeholder="Enter State">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="cityID" class="form-control" value="<?php echo $city; ?>" placeholder="Enter City">
            </div>
            <div class="form-group">
    <label for="category">Category</label>
    <select name="category" id="category" class="form-control">
        <?php 
        // Fetch job categories
        $category_query = mysqli_query($conn, "SELECT * FROM job_category");
        if ($category_query) {
            while ($row = mysqli_fetch_array($category_query)) {
        ?>
                <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $category) ? 'selected' : ''; ?>><?php echo $row['category']; ?></option>
        <?php
            }
        } else {
            echo "<option value=''>No categories found</option>";
        }
        ?>
    </select>
</div>

            <input type="hidden" name="id" id="id" value="<?php echo $_GET['edit'];?>"> 
            <div class="form-group">
                <input type="submit" class="btn btn-block btn-success" value="Save" name="submit" id="submit">
            </div>
        </form>
    </div>
    <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
</main>
</body>
</html>

<?php
include('connection/db.php');
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $job_title = $_POST['job_title'];
    $description = $_POST['description'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $keyword = $_POST['keyword'];
    $category = $_POST['category'];

    // Update query with proper concatenation and quoting
    $query1 = mysqli_query($conn, "UPDATE all_jobs SET 
                    job_title='$job_title', 
                    description='$description',
                    country='$country',
                    state='$state',
                    city='$city',
                    keyword='$keyword',
                    category='$category'
                    WHERE job_id = '$id'");
    if($query1){
        echo "<script>alert('Record Updated Successfully!')</script>";
    }else{
        echo "<script>alert('Error')</script>";
    }
}
?>
