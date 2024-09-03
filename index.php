
<?php
$page = 'home';
include('include/header.php');
?>    
    <div class="hero-wrap js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-xl-10 ftco-animate mb-5 pb-5" data-scrollax=" properties: { translateY: '70%' }">
          <p class="mb-4 mt-5 pt-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">We have <span class="number" data-number="<?php
include('connection/db.php'); 

$sql1 = mysqli_query($conn, "SELECT COUNT(*) AS job_count FROM all_jobs");
$row1 = mysqli_fetch_assoc($sql1);
$job_count = $row1['job_count'];

echo $job_count;
?>">0</span> great job offers you deserve!</p>

            <h1 class="mb-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Your Dream <br><span>Job is Waiting</span></h1>

						<div class="ftco-search">
							<div class="row">
		            <div class="col-md-12 nav-link-wrap">
			            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			              <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Find a Job</a>


			            </div>
			          </div>
			          <div class="col-md-12 tab-wrap">
			            
			            <div class="tab-content p-4" id="v-pills-tabContent">

			              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
			              	<form action="index.php" method="post"  class="search-job">
			              		<div class="row">
			              			<div class="col-md">
			              				<div class="form-group">
				              				<div class="form-field">
				              					<div class="icon"><span class="icon-briefcase"></span></div>
								                <input type="text" name="key" id="key" class="form-control" placeholder="eg. Garphic. Web Developer">
								              </div>
							              </div>
			              			</div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
				              					<div class="select-wrap">
						                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
						                      <select name="category" id="category" class="form-control">
                                  <option value="">Category</option>

<?php
include('connection/db.php');

$query = mysqli_query($conn,"SELECT * FROM job_category");

while ($row = mysqli_fetch_array($query)) {
    echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
}
?>

						                      	
						                      
						                      </select>
						                    </div>
								              </div>
							              </div>
			              			</div>
			              			
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
								                <input type="submit" value="Search" name="search" id="search" class="form-control btn btn-primary">
								              </div>
							              </div>
			              			</div>
			              		</div>
			              	</form>
			              </div>

			              <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
			              	<form action="#" class="search-job">
			              		<div class="row">
			              			<div class="col-md">
			              				<div class="form-group">
				              				<div class="form-field">
				              					<div class="icon"><span class="icon-user"></span></div>
								                <input type="text" class="form-control" placeholder="eg. Adam Scott">
								              </div>
							              </div>
			              			</div>
			              			
			              			
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
								                <input type="submit" value="Search" class="form-control btn btn-primary">
								              </div>
							              </div>
			              			</div>
			              		</div>
			              	</form>
			              </div>
			            </div>
			          </div>
			        </div>
		        </div>
          </div>
        </div>
      </div>
    </div>
    <?php
include('connection/db.php');
$sql = null; // Initialize $sql to null

// Check if the search form has been submitted
if (isset($_POST['search']) || isset($_GET['page'])) {
  $page = isset($_GET['page']) ? $_GET['page'] : "";
  if ($page == "") {
    $page1 = 0;
    $keyword = $_POST['key'];
    $category = $_POST['category'];
  } else {
    $keyword = $_GET['keyword'];
    $category = $_GET['category'];
    $page1 = ($page * 3) - 3;
  }

    // Construct the SQL query based on the search criteria
    $sql = mysqli_query($conn, "SELECT * FROM all_jobs LEFT JOIN company ON all_jobs.customer_email = company.admin WHERE keyword LIKE '%$keyword%' OR  category = '$category' LIMIT $page1,3");
} else {
    // If the search form has not been submitted, fetch recently added jobs
    $sql = mysqli_query($conn, "SELECT * FROM all_jobs LEFT JOIN company ON all_jobs.customer_email = company.admin ORDER BY job_id DESC LIMIT 5"); // Assuming you want to fetch the 10 most recently added jobs
}
$error = mysqli_num_rows($sql);
?>
<div id="id_all_jobs">
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
              <span class="subheading">Recently Added Jobs</span>
            <h2 class="mb-4"><span>Recent</span> Jobs</h2>
            <br>
            <h3>
            <?php
            if($error === false) {
                echo "No data found.";
            } elseif($error === 0) {
                echo "No results found.";
            } elseif($error === -1) {
                echo "Error: " . mysqli_error($conn);
            }
            ?>
            </h3>
          </div>
        </div>
 <div class="row">
        <?php
        // Check if $sql is not null and execute the loop
        if ($sql !== null) {
            while ($row = mysqli_fetch_array($sql)) { 
        ?>
            <div class="col-md-12 ftco-animate">
                <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
                    <div class="mb-4 mb-md-0 mr-5">
                        <div class="job-post-item-header d-flex align-items-center">
                            <h2 class="mr-3 text-black h3"><?php echo $row['job_title']; ?></h2>
                            <div class="badge-wrap">
                                <span class="bg-primary text-white badge py-2 px-3"><?php echo $row['city']; ?></span>
                            </div>
                        </div>
                        <div class="job-post-item-body d-block d-md-flex">
                            <div class="mr-3"><span class="icon-layers"></span> <a href="#"><?php echo $row['company']; ?></a></div>
                            <div><span class="icon-my_location"></span> <span><?php echo $row['country']; ?>,<?php echo $row['state']; ?>,<?php echo $row['city']; ?></span></div>
                        </div>
                    </div>
                    <div class="ml-auto d-flex">
                        <a href="job-single.php?id=<?php echo $row['job_id']; ?>" class="btn btn-primary py-2 mr-1">Apply Job</a>
                        
                    </div>
                </div>
            </div><!-- end -->
        <?php 
            } // end while loop
        } // end if $sql is not null
        ?>

        </div>
    </div>
</section>
</div>



				<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <?php
                $sql= mysqli_query($conn, "SELECT * FROM all_jobs LEFT JOIN company ON all_jobs.customer_email = company.admin WHERE keyword LIKE '%$keyword%' OR  category = '$category'");
                $count=mysqli_num_rows($sql);
                $a=$count/3;
                ceil($a);
                for($b=1; $b <=$a; $b++){
                  ?>
                
                <li><a href="index.php?page=<?php echo $b;?>&keyword=<?php echo $keyword;?>&category=<?php echo $category;?>"><?php echo $b;?></a></li>
                <?php } ?>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
			</div>
		</section>
                </div>

    <section class="ftco-section services-section bg-light">
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-resume"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Search Millions of Jobs</h3>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-collaboration"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Easy To Manage Jobs</h3>
              </div>
            </div>    
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-promotions"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Top Careers</h3>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-employee"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Search Expert Candidates</h3>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>

    

		
    <?php
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
$job_count = $row1['job_count'];
$id = $row2['id'];
$file = $row3['file'];
$company_id = $row4['company_id'];
?>

<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_1.jpg);" data-stellar-background-ratio="0.5">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?php echo $job_count; ?>"><?php echo $job_count; ?></strong>
                                <span>Jobs</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?php echo $id; ?>"><?php echo $id; ?></strong>
                                <span>Members</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?php echo $file; ?>"><?php echo $file; ?></strong>
                                <span>Resume</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?php echo $company_id; ?>"><?php echo $company_id; ?></strong>
                                <span>Company</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    <section class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Testimonial</span>
            <h2 class="mb-4"><span>Happy</span> Clients</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/a1.jpeg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-4">Joining [Job Bloom] has been a game-changer, with its user-friendly interface, personalized job recommendations, and supportive community, ultimately leading to landing the perfect job and kickstarting my career</p>
                    <p class="name">Arjun Lama</p>
                    <span class="position">Marketing Manager</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/a2.jpeg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-4">Discovering Job Bloom was a turning point in my job search journey, where its user-friendly interface became instrumental in securing my ideal position and jumpstarting my career."</p>
                    <p class="name">Sunil Thapa</p>
                    <span class="position">Interface Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/a3.jpeg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-4">Ever since I joined , my job search has been transformed, thanks to its seamless navigation, customized job suggestions,  ultimately leading me to land the perfect job and embark on a fulfilling career path</p>
                    <p class="name">Ashim Dangal</p>
                    <span class="position">UI Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/a4.jpeg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-4">Thanks to this online job portal, I found my dream job within weeks – it's truly a game-changer!</p>
                    <p class="name">Saroj Ghimire</p>
                    <span class="position">Web Developer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/a5.jpeg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-4">This online job portal made my job search effortless, connecting me with fantastic opportunities in no time!.</p>
                    <p class="name">Bijiean Tamrakar </p>
                    <span class="position">System Analyst</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  
    </section>
		
	

    <footer class="ftco-footer ftco-bg-dark ftco-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-12">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">About Us</h2>
          <p>Welcome to JobBloom, your premier destination for connecting talented individuals with rewarding career opportunities. At JobBloom, we recognize the challenges faced by job seekers and employers alike, and we've crafted a platform to streamline the job search process for both parties.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">Have a Question?</h2>
          <div class="block-23 mb-3">
            <ul>
              <li><a href="contact.php"><span class="icon icon-envelope"></span><span class="text">jobbloominfo@gmail.com</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <p>&copy; <span id="copyright-year"></span> JobBloom. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>
