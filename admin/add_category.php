<?php 
include('include/header.php');
include('include/sidebar.php');
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="category.php">Category</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Category</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2"></div>
        </div>
    </div>
    <div style="width: 60%; margin-left: 20%; background-color: #CCD1D1; padding: 3%; border-radius: 5px;">
        <div id="msg"></div>
        <form action="" method="post" name="customer_form" id="Company_form">
            <div class="form-group">
                <label for="category">Category Name</label>
                <input type="text" name="category" id="category" class="form-control" placeholder="Enter Category">
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="Description" id="Description" class="form-control" placeholder="Enter Description" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-block btn-success" value="Save" name="submit" id="submit">
            </div>
        </form>
    </div>
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

<!-- datatables plugin -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script>
    new DataTable('#example');
</script>

<script>
    $(document).ready(function(){
        $("#submit").click(function(event){
            event.preventDefault();
            
            var category = $("#category").val().trim();
            var description = $("#Description").val().trim();
            
            if (category === '') {
                alert("Category Name is required");
                return false;
            }
            
            if (description === '') {
                alert("Description is required");
                return false;
            }
            
            var data = $("#Company_form").serialize();
            
            $.ajax({
                type: "post",
                url: "category_add.php",
                data: data,
                success: function(response){
                    $("#msg").html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>
</body>
</html>
