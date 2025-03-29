<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();


if(isset($_POST[submit])){
        $roomno = $_POST['roomno'];
	$seater = $_POST['seater'];
	$duration = $_POST['duration'];
	$course = $_POST['course'];
	$firstName = $_POST['firstName'];
	$middleName = $_POST['middleName'];
	$lastName = $_POST['lastName'];
	$gender = $_POST['gender'];
	$contactno = $_POST['contactno'];
	$emailid = $_POST['emailid'];
	$egycontactno = $_POST['egycontactno'];
	$guardianName = $_POST['guardianName'];
	$guardianRelation = $_POST['guardianRelation'];
	$guardianContactno = $_POST['guardianContactno'];
	$corresAddress = $_POST['corresAddress'];
	$corresCIty = $_POST['corresCIty'];
	$corresState = $_POST['corresState'];
	$corresPincode = $_POST['corresPincode'];
	$pmntAddress = $_POST['pmntAddress'];
	$pmntCity = $_POST['pmntCity'];
	$pmnatetState = $_POST['pmnatetState'];
	$pmntPincode = $_POST['pmntPincode'];
        $regno=$_GET['regno'];
        
        $query = "UPDATE rooms SET 
                roomno = ?, 
                seater = ?, 
                duration = ?, 
                course = ?, 
                regno = ?, 
                firstName = ?, 
                middleName = ?, 
                lastName = ?, 
                gender = ?, 
                contactno = ?, 
                emailid = ?, 
                egycontactno = ?, 
                guardianName = ?, 
                guardianRelation = ?, 
                guardianContactno = ?, 
                corresAddress = ?, 
                corresCIty = ?, 
                corresState = ?, 
                corresPincode = ?, 
                pmntAddress = ?, 
                pmntCity = ?, 
                pmnatetState = ?, 
                pmntPincode = ?, 
                
              WHERE regno = ?";

    $stmt = $mysqli->prepare($query);

    // Bind parameters (order must match the query)
    $stmt->bind_param(
        'siissssssisississsisssi',
        $roomno, $seater, $duration, $course,
        $regno, $firstName, $middleName, $lastName, $gender,
        $contactno, $emailid, $egycontactno, $guardianName, $guardianRelation,
        $guardianContactno, $corresAddress, $corresCIty, $corresState, $corresPincode,
        $pmntAddress, $pmntCity, $pmnatetState,$pmntPincode
    );

    // Execute the query
    $stmt->execute();

    // Provide feedback to the user
    echo "<script>
            alert('Students details have been updated');
            window.location.href='manage-students.php';
          </script>";


}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Vinodini Hostel Management System</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes/navigation.php'?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php'?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Student Details</h4>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->

            <div class="container-fluid">

                <form method="POST">

                    <div class="row">


                    <?php	
                        $regno=$_GET['regno'];
						$ret="SELECT * from registration where regno=?";
                        $stmt= $mysqli->prepare($ret) ;
                     $stmt->bind_param('s',$regno);
                     $stmt->execute() ;//ok
                     $res=$stmt->get_result();
                     //$cnt=1;
                       while($row=$res->fetch_object())
                      {
                          ?>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">roomno</h4>
                                        <div class="form-group">
                                            <input type="text" name="roomno" value="<?php echo $row->roomno;?>" id="roomno" class="form-control" disabled>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Seater</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="seater" name="seater" required="required">
                                                <option value="<?php echo $row->seater;?>"><?php echo $row->seater;?></option>
                                                <option value="1">NA</option>
                                                <option value="1">Single Seater</option>
                                                <option value="2">Two Seater</option>
                                                <option value="3">Three Seater</option>
                                                <option value="4">Four Seater</option>
                                                <option value="5">Five Seater</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>

                       
                      <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">duration</h4>
                                        <div class="form-group">
                                            <input type="text" name="duration" value="<?php echo $row->duration;?>" id="duration" class="form-control" disabled>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">course</h4>
                                        <div class="form-group">
                                            <input type="text" name="course" value="<?php echo $row->course;?>" id="course" class="form-control" disabled>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">regno</h4>
                                        <div class="form-group">
                                            <input type="text" name="regno" value="<?php echo $row->regno;?>" id="regno" class="form-control" disabled>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="col-sm-12 col-md-6 col-lg-4">
			   <div class="card">
				<div class="card-body">
				    <!-- First Name -->
				    <h4 class="card-title">First Name</h4>
				    <div class="form-group">
					<input type="text" name="firstName" value="<?php echo $row->firstName; ?>" id="firstName" class="form-control" disabled>
				    </div>

				    <!-- Middle Name -->
				    <h4 class="card-title">Middle Name</h4>
				    <div class="form-group">
					<input type="text" name="middleName" value="<?php echo $row->middleName; ?>" id="middleName" class="form-control" disabled>
				    </div>

				    <!-- Last Name -->
				    <h4 class="card-title">Last Name</h4>
				    <div class="form-group">
					<input type="text" name="lastName" value="<?php echo $row->lastName; ?>" id="lastName" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>
                        
                        
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">gender</h4>
                                        <div class="form-group">
                                            <input type="text" name="gender" value="<?php echo $row->gender;?>" id="gender" class="form-control" disabled>
                                        </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">contactno</h4>
                                        <div class="form-group">
                                            <input type="number" name="gender" value="<?php echo $row->gender;?>" id="gender" class="form-control" disabled>
                                        </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">emailid</h4>
                                        <div class="form-group">
                                            <input type="text" name="emailid" value="<?php echo $row->emailid;?>" id="emailid" class="form-control" disabled>
                                        </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        <div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Emergency Contact No</h4>
				    <div class="form-group">
					<input type="number" name="egycontactno" value="<?php echo $row->egycontactno;?>" id="egycontactno" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>
			
			

			<div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Guardian Name</h4>
				    <div class="form-group">
					<input type="text" name="guardianName" value="<?php echo $row->guardianName;?>" id="guardianName" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Guardian Relation</h4>
				    <div class="form-group">
					<input type="text" name="guardianRelation" value="<?php echo $row->guardianRelation;?>" id="guardianRelation" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Guardian Contact No</h4>
				    <div class="form-group">
					<input type="number" name="guardianContactno" value="<?php echo $row->guardianContactno;?>" id="guardianContactno" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Correspondence Address</h4>
				    <div class="form-group">
					<input type="text" name="corresAddress" value="<?php echo $row->corresAddress;?>" id="corresAddress" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Correspondence City</h4>
				    <div class="form-group">
					<input type="text" name="corresCIty" value="<?php echo $row->corresCIty;?>" id="corresCIty" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Correspondence State</h4>
				    <div class="form-group">
					<input type="text" name="corresState" value="<?php echo $row->corresState;?>" id="corresState" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Correspondence Pincode</h4>
				    <div class="form-group">
					<input type="number" name="corresPincode" value="<?php echo $row->corresPincode;?>" id="corresPincode" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Permanent Address</h4>
				    <div class="form-group">
					<input type="text" name="pmntAddress" value="<?php echo $row->pmntAddress;?>" id="pmntAddress" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Permanent City</h4>
				    <div class="form-group">
					<input type="text" name="pmntCity" value="<?php echo $row->pmntCity;?>" id="pmntCity" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Permanent State</h4>
				    <div class="form-group">
					<input type="text" name="pmnatetState" value="<?php echo $row->pmnatetState;?>" id="pmnatetState" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-4">
			    <div class="card">
				<div class="card-body">
				    <h4 class="card-title">Permanent Pincode</h4>
				    <div class="form-group">
					<input type="number" name="pmntPincode" value="<?php echo $row->pmntPincode;?>" id="pmntPincode" class="form-control" disabled>
				    </div>
				</div>
			    </div>
			</div>

                        
                        
                        
                        
                        

                      -->

                        <?php } ?>

                    </div>
                

                        <div class="form-actions">
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-success">Update</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                
                </form>


            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include '../includes/footer.php' ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->



	<!-- Scripts and dependencies -->
	<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
	<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="../dist/js/app-style-switcher.js"></script>
	<script src="../dist/js/feather.min.js"></script>
	<script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
	<script src="../dist/js/sidebarmenu.js"></script>
	<script src="../dist/js/custom.min.js"></script>
	<script src="../assets/extra-libs/c3/d3.min.js"></script>
	<script src="../assets/extra-libs/c3/c3.min.js"></script>
	<script src="../assets/libs/chartist/dist/chartist.min.js"></script>
	<script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
	<script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>

	


</body>
</html>
