<?php
include "header.php"
?>
<style>
    
</style>
</head>
<body>
<div class="container col-md-4 p-6" style=" margin-top:40px;background-color:darkgray;/*margin:20px;width:500px;margin-left:30%;*/">
<!--Items Display-->
<button class="btn btn-danger"  style= "float:left;margin-left:10px;margin-top:16px;">
    <a href="index.php?dashboard">Back</a>
</button>
<div class="container" style="padding:10px;border-radius:10px;">
<h2 class="mb-4 text-secondary" style="text-align:center;">
Student Registration Form
</h2>
<hr>
<div class="box" style="background-color:#9a9a9a;padding:20px;">
<form action="action.php" method="POST" enctype="multipart/form-data">
<input type="hidden" class="form-control" id="served_by" name="served_by" value="<?php echo $session_id; ?>" onkeydown="return false">
<div class="row mb-2">
	<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">First name</label>-->
		<input type="text" placeholder="Firstname" class="form-control" id="fname" name="fname" required style="width:100%;height:30px;border-radius:0%;background:lightgray;">
	</div>
</div>
<div class="row mb-2">
	<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Full name:</label>-->
		<input type="text" placeholder="Last name" class="form-control" id="lname" name="lname" required style="width:100%;height:30px;border-radius:0%;background:lightgray;">
	</div>
</div>
<div class="row mb-2">
     <div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="position" name="position" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">Select class</option>
			<?php
			include 'config/db.php';
            $getQuery = " SELECT * from class ";
			$result = mysqli_query ( $conn, $getQuery);
			$total_rows =  mysqli_num_rows($result);
			getData($getQuery);
			function getData($getQuery){
				include ('config/db.php');
				$result = mysqli_query($conn , $getQuery);
				if( mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){
						echo '<option value="'.$row['class'].'">'.$row['class'].'</option>';
					}
				}
			}
			
			?>
			</select>
		</div>
	</div>
<div class="row mb-2">
	<div class="col-sm">
		<!-- <label for="recipient-name" class="col-sm-form-label">Gender:</label>-->
			<select class="form-select form-select-sm" aria-label=".form-select-sm " id="gender" name="gender" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;">
			  <option selected value="">Select gender</option>
			  <option value="Male">Male</option>
			  <option value="Female">Female</option>
			  <option value="Others">Others</option>
			</select>
		</div>
     </div>
<div class="row mb-2">
	<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">passport:</label>-->
		<input type="file" class="form-control" id="photo" name="photo" accept="image/jpeg" style="width:100%;height:30px;border-radius:0%;background:lightgray;">
	</div>
</div>
</div>

<div class="row">
	<div class="col-md" style="align-items:center;justify-content:center;text-align:center;">
		<h2 class="mb-4">
			<button type="submit" name="submit" value="addemp" class="btn btn-primary" style="align-self:center;align-items:center;background:blue;">Register</button>
		</h2>
	</div>
</div>

</form>

</div>
</div>
