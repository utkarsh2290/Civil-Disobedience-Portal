<?php
error_reporting(E_ERROR | E_PARSE);
include_once('db.php');
?>
<?php
      $sql = "SELECT * FROM `statistics_`";
      $result=mysqli_query($con,$sql);
      $num=mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>

	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="icon" type="image/png" href="images/admin_logo.png"/>

	<!-- Import lib -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<!-- End import lib -->

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="overlay-scrollbar">
	<!-- navbar -->
	<div class="navbar">
		<!-- nav left -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link">
					<i class="fas fa-bars" onclick="collapseSidebar()"></i>
				</a>
			</li>
		</ul>
    <h2>OnDuty Admin</h2>
		<!-- end nav left -->
		<!-- form -->
		<!-- end form -->
		<!-- nav right -->
		<ul class="navbar-nav nav-right">
			<li class="nav-item mode">
				<a class="nav-link" href="#" onclick="switchTheme()">
					<i class="fas fa-moon dark-icon"></i>
					<i class="fas fa-sun light-icon"></i>
				</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link">
					<i class="fas fa-bell dropdown-toggle" data-toggle="notification-menu"></i>
					<span class="navbar-badge">5</span>
				</a>
				<ul id="notification-menu" class="dropdown-menu notification-menu">
					<div class="dropdown-menu-header">
						<span>
							Notifications
					<div class="dropdown-menu-footer">
						<span>
							View all notifications
						</span>
					</div>
				</ul>
			</li>
			<li class="nav-item avt-wrapper">
				<div class="avt dropdown">
					<img src="images/admin_logo.png" alt="User image" class="dropdown-toggle" data-toggle="user-menu">
					<ul id="user-menu" class="dropdown-menu">
						<li class="dropdown-menu-item">
							<a href="admin.php" class="dropdown-menu-link">
								<div>
									<i class="fas fa-cog"></i>
								</div>
								<span>Complaints</span>
							</a>
						</li>
						<li  class="dropdown-menu-item">
							<a href="Newsfeed.php" class="dropdown-menu-link">
								<div>
									<i class="far fa-credit-card"></i>
								</div>
								<span>Newsfeed</span>
							</a>
						</li>
						<li  class="dropdown-menu-item">
							<a href="hotspot.php" class="dropdown-menu-link">
								<div>
									<i class="fas fa-spinner"></i>
								</div>
								<span>Hotspots</span>
							</a>
						</li>
						<li  class="dropdown-menu-item">
							<a href="index.php" class="dropdown-menu-link">
								<div>
									<i class="fas fa-sign-out-alt"></i>
								</div>
								<span>Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
		<!-- end nav right -->
	</div>
	<!-- end navbar -->
	<!-- sidebar -->
	<!-- end sidebar -->
	<!-- main content -->
	<div class="wrapper">
		<div class="row">
			<div class="col-8 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3>
						Statistics info
						</h3>
						<i class="fas fa-ellipsis-h"></i>
					</div>
					<div class="card-content">
						<table>
							<thead>
								<tr>
									<th>Reference ID</th>
									<th>Crime Name</th>
									<th>Crime Stats</th>
								</tr>
							</thead>
							<?php
        while($row=mysqli_fetch_assoc($result)){
       ?>
							<tbody>
								<tr>
                <td><?php echo $row['Reference_ID'];?></td>
									<td><?php echo $row['Crime_Name'];?></td>
                  <td><?php echo $row['Crime_Num'];?></td>
                  <?php
              }
              ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
      <div class="col-3 col-m-6 col-sm-6">
      <div class="counter bg-danger" style="margin-left:10px">
        <p>
          <i class="fas fa-bug"></i>
        </p>
				<div class="card-header">
        <h3>New Crime Stats</h3>
				<br>
				</div>
        <br>
        <form action="stats.php" method="post">
        <div class="contact-form">
          <div class="input-fields">
            Reference Id:
            <input name="refid"type="text" class="input">
            <br>
            Crime Name:
            <input name="crimename"type="text" class="input" >
            <br>
            Crime Number:
            <input name="crimenum" type="text" class="input" >
            <br>
            <div style="margin-left:5px">
            <button href="stats.php">Submit</button>
            </div>
          </form>
          <?php
          error_reporting(E_ERROR | E_PARSE);
          $Crime_Name = $_POST['crimename'];
  $Crime_Num = $_POST['crimenum'];
  $Reference_id = $_POST['refid'];
  $insertNewComplaint = "INSERT IGNORE INTO Statistics_ (Crime_Name, Crime_Num , Reference_id) values
  ( '$Crime_Name', '$Crime_Num', '$Reference_id')";
    
    $run= mysqli_query($con, $insertNewComplaint);

    if(!$run)
    {
      die('Error: '.mysqli_error($con));
    }
    ?>
          </div>
        </div>
      </div>
      </div>
		</div>
			<!-- <div class="col-4 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3>
							Progress bar
						</h3>
						<i class="fas fa-ellipsis-h"></i>
					</div>
					<div class="card-content">
						<div class="progress-wrapper">
							<p>
								Less than 1 hour
								<span class="float-right">50%</span>
							</p>
							<div class="progress">
								<div class="bg-success" style="width: 50%"></div>
							</div>
						</div>
						<div class="progress-wrapper">
							<p>
								1 - 3 hours
								<span class="float-right">60%</span>
							</p>
							<div class="progress">
								<div class="bg-primary" style="width:60%"></div>
							</div>
						</div>
						<div class="progress-wrapper">
							<p>
								More than 3 hours
								<span class="float-right">40%</span>
							</p>
							<div class="progress">
								<div class="bg-warning" style="width:40%"></div>
							</div>
						</div>
						<div class="progress-wrapper">
							<p>
								More than 6 hours
								<span class="float-right">20%</span>
							</p>
							<div class="progress">
								<div class="bg-danger" style="width:20%"></div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
    </div>
    <!-- <div class="col-3 col-m-6 col-sm-6">
      <div class="counter bg-danger">
        <p>
          <i class="fas fa-bug"></i>
        </p>
        <h3>Project Status</h3>
        <form action="stats.php" method="post">
        <div class="contact-form">
          <div class="input-fields">
            Reference Id:
            <input name="refid"type="text" class="input">
            Crime Name:
            <input name="crimename"type="text" class="input" >
            Crime Number:
            <input name="crimenum" type="text" class="input" >
            <button href="stats.php">Submit</button>
          </form>
          </div>
        </div> -->
      </div>
      </div>
		</div>
	</div>
	<!-- end main content -->
	<!-- import script -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script src="index.js"></script>
	<!-- end import script -->
</body>
</html>