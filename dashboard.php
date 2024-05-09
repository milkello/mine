<?php
include "config/db.php";
include "header.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'delete' && isset($_POST['id'])) {
        $id = $_POST['id'];

        // Delete the data from the database
        $deleteQuery = "DELETE FROM marks WHERE id = $id";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "success";
            exit; // Stop further execution
        } else {
            echo "error";
            exit; // Stop further execution
        }
    } elseif ($_POST['action'] === 'update' && isset($_POST['id']) && isset($_POST['value'])) {
        $id = $_POST['id'];
        $value = $_POST['value'];

        // Update the value in the database
        $updateQuery = "UPDATE marks SET value = '$value' WHERE id = $id";
        if (mysqli_query($conn, $updateQuery)) {
            echo "success";
            exit; // Stop further execution
        } else {
            echo "error";
            exit; // Stop further execution
        }
    }
}
?>
<style>
hr{
	width:90%;

	.btn-update {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .btn-update:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-update:focus,
    .btn-update.focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
    }

    .btn-update:active,
    .btn-update.active,
    .show > .btn-update.dropdown-toggle {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-update.disabled,
    .btn-update:disabled {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-update:not(:disabled):not(.disabled):active:focus,
    .btn-update:not(:disabled):not(.disabled).active:focus,
    .show > .btn-update:not(:disabled):not(.disabled).dropdown-toggle:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
    }
}
</style>
</head>
<body>
<?php include 'nav.php' ?>
<div class="table table table-hover text-center" style="margin-left:5%;width:90%;padding:10px;border-radius:10px;">
<form action="dashboard.php" method="POST" enctype="multipart/form-data">
<div class="row mb-2">
		<div class="col">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="typofass" name="typofass" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">Typofass</option>
			<?php
			$sql ="SELECT * FROM assessments";
			$result = $conn->query($sql);
			if( mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
		?>
			<option value="<?php echo $row["typofass"]; ?>"> <?php echo $row["typofass"]; ?> </option>
		<?php }} ?>
			</select>
		</div>
		<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="date" name="date" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">date</option>
			<?php
			$sql ="SELECT * FROM assessments";
			$result = $conn->query($sql);
			if( mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
		?>
			<option value="<?php echo $row["date"]; ?>"> <?php echo $row["date"]; ?> </option>
		<?php }} ?>
			</select>
		</div>
		<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="class" name="class" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">class</option>
			<?php
			$sql ="SELECT * FROM class";
			$result = $conn->query($sql);
			if( mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
		?>
			<option value="<?php echo $row["class"]; ?>"> <?php echo $row["class"]; ?> </option>
		<?php }} ?>
			</select>
		</div>
		<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="level" name="level" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">level</option>
			<?php
			   $sql ="SELECT * FROM level";
			   $result = $conn->query($sql);
			   if( mysqli_num_rows($result)>0){
			   while($row = mysqli_fetch_assoc($result)){
		   ?>
			   <option value="<?php echo $row["level"]; ?>"> <?php echo $row["level"]; ?> </option>
		   <?php }} ?>
			</select>
		</div>	
		<div class="col-sm">
		    <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background:blue;">Filter</button>
	   </div>	
</div>
</form>
<table id="pager" class="table table-hover text-center" cellspacing="0" style="align:center;border-radius:10px;">
  <thead class="table-dark">
    <tr>
	<th scope="col">Number</th>
                    <th scope="col">Student's name</th>
                    <th scope="col">Marks</th>
                    <th scope="col">Actions</th>
	  </tr>
  </thead>
  <tbody style="background-color:lightgray;">

<?php
$limit = 5;
include ('config/db.php');





$getQuery = " SELECT * from marks ";
$result = mysqli_query ( $conn, $getQuery);
$total_rows =  mysqli_num_rows($result);
$total_pages = ceil($total_rows / $limit);
if(!isset($_GET['page'])){
	$page_number = 1; 
}
else{
	$page_number = $_GET['page'];
}
$initial_page = ( $page_number - 1 ) * $limit ;
if (isset($_POST['submit']) && isset($_POST['typofass']) && isset($_POST['date']) && isset($_POST['class']) && isset($_POST['level']) ){
	$typofass = $_POST['typofass'];
	$date = $_POST['date'];  
	$class = $_POST['class'];
	$level = $_POST['level'];

	$getQuery = "  SELECT marks.id, marks.fname, marks.lname, marks.year, marks.typofass, marks.date , marks.assname, marks.outof, marks.value, marks.class, marks.level , marks.term, marks.subject from marks JOIN assessments ON assessments.typofass = marks.typofass AND assessments.date = marks.date JOIN class ON class.class = marks.class  JOIN level ON level.level = marks.level 
                   WHERE  
				   assessments.typofass = '$typofass'
				   AND assessments.date = '$date' 
				   AND class.class = '$class'
				   AND level.level = '$level' LIMIT " .$initial_page.' ,' .$limit ;
getData($getQuery);				   
}
?>
<?php

function getData($getQuery){
	include ('config/db.php');
	$result = mysqli_query($conn , $getQuery);
	

	if( mysqli_num_rows($result) >0){
		while($row = mysqli_fetch_assoc($result)){
			echo '<tr class = "td-sm" >
            <td class = "td-sm" >'.$row['id'].'</td>
            <td class = "td-sm" >'.$row['fname'].' '.$row['lname'].'</td>
            <td class = "td-sm" ><input type="text"  id="value_' . $row['id'] . '" value="'.$row['value'].'" style="border-top:none !important;border-left:none !important;border-right:none !important;border-bottom:1px solid blue;background:lightgray;text-align:center;background-color:white;width:50px;"></td>
			<td class = "td-sm" >
			<ul style="display:inline;">
			<button type="button" class="btn btn-success btn-sm" onclick="updateRow(' . $row['id'] . ')"><i class="fa fa-pencil"></i></button>
			<button class="btn btn-danger btn-sm" id="'.$row['id'].'" onclick="deleteRow(' . $row['id'] . ')" ><i class="fa fa-times"></i></button>
			</ul>
			</td>
			</tr> ';
		}
	}
}

if(isset($_SESSION['stid']))
 $id = $_GET['id'];
 // DELETE
function removeClass($id, $conn){
	$sql  = "DELETE FROM marks
			WHERE id=?";
	$stmt = $conn->prepare($sql);
	$re   = $stmt->execute([$id]);
	if ($re) {
	  return 1;
	}else {
	 return 0;
	}
 }


?>

</tbody>
</table>
</div>
</div>
</div>
</div>
<hr>
<div class="pagination" style="position:flex;margin-left:5%;float:left">
	<?php
	for($page_number = 1 ; $page_number<= $total_pages; $page_number ++){
		echo '<a class="page-link" href="dashboard.php?page = '.$page_number.'"> '.$page_number.'</a>' ;
	}
	?>
</div>

<!-- <div class="modal fade" id="Generate_Report_Cards" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning text-light">
        <h5 class="modal-title" id="exampleModalLabel">SEARCH MARK SHEET</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
	  <div class="modal-body">
        <form action="report_cards.php" method="POST" enctype="multipart/form-data">
		  <div class="row">
				<div class="col">
					<label for="recipient-name" class="col-form-label">Select Class:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="class" name="class" required>
					  <option selected value="">Select class</option>
					<?php 
						$sql ="SELECT * from class ORDER BY id DESC";
						$result = mysqli_query($conn , $sql);
						if( mysqli_num_rows($result) >0){
							while($row = mysqli_fetch_assoc($result)){
							$id = $row["class"];
					?>
						<option value="<?php echo $row["class"]; ?>"> <?php echo $row["class"]; ?> </option>
					<?php }} ?>
					</select>
				   </div>
				</div>
			  	
				<div class="col-sm">
				  <label for="recipient-name" class="col-form-label">Select Term:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="term" name="term" required>
					  <option selected value="">Select Term</option>
					<?php 
						$sql ="SELECT * from marks ORDER BY id DESC";
						$result = mysqli_query($conn , $sql);
						if( mysqli_num_rows($result) >0){
							while($row = mysqli_fetch_assoc($result)){
							$id = $row["typofass"];
					?>
						<option value="<?php echo $row["term"]; ?>"> <?php echo $row["term"]; ?> </option>
					<?php }} ?>
					</select>
				   </div>
			   </div>  
		  </div>
		<div class="modal-footer">
			<button type="submit" name="submit" value="search" class="btn btn-primary">Generate Report Cards</button>
		</div>
        </form>
      </div>
  </div></div>
</div>

 -->



<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float:right;margin-right:30px;border:none !important;border-radius:10px;">
  Open modal
</button>

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">SEARCH MARK SHEET</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
	  <!-- anoother div -->
	  <div class="modal-body">
        <form action="report_cards.php" method="POST" enctype="multipart/form-data">
		  <div class="row">
				<div class="col">
					<label for="recipient-name" class="col-form-label">Select Class:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="class" name="class" required>
					  <option selected value="">Select class</option>
					<?php 
						$sql ="SELECT * from class ORDER BY id DESC";
						$result = mysqli_query($conn , $sql);
						if( mysqli_num_rows($result) >0){
							while($row = mysqli_fetch_assoc($result)){
							$id = $row["class"];
					?>
						<option value="<?php echo $row["class"]; ?>"> <?php echo $row["class"]; ?> </option>
					<?php }} ?>
					</select>
				   </div>
				</div>
			  	
				<div class="col-sm">
				  <label for="recipient-name" class="col-form-label">Select Term:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="term" name="term" required>
					  <option selected value="">Select Term</option>
					<?php 
						$sql ="SELECT * from marks ORDER BY id DESC";
						$result = mysqli_query($conn , $sql);
						if( mysqli_num_rows($result) >0){
							while($row = mysqli_fetch_assoc($result)){
							$id = $row["typofass"];
					?>
						<option value="<?php echo $row["term"]; ?>"> <?php echo $row["term"]; ?> </option>
					<?php }} ?>
					</select>
				   </div>
			   </div>  
		  </div>
		<div class="modal-footer">
			<button type="submit" name="submit" value="search" class="btn btn-primary">Generate Report Cards</button>
		</div>
        </form>
      </div>
  </div></div>
</div>


<!-- end -->

      </div>

      <!-- Modal footer -->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>


  




<script>
        function deleteRow(id) {
            // Send an AJAX request to delete the row with the provided id
            // You'll need to implement this part using your backend code (PHP)
            // For demonstration purposes, I'm using a simple alert
            if (confirm('Are you sure you want to delete this record?')) {
        //         alert('Row with ID ' + id + ' will be deleted.'); // Replace this with your actual deletion logic
        //     }
        // }
		 // Send AJAX request to delete data
		 var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Success
                            alert("Data deleted successfully.");
                            // Refresh the page or update UI as needed
                            window.location.reload();
                        } else {
                            // Error
                            alert("Error deleting data.");
                        }
                    }
                };
                xhr.open("POST", "dashboard.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("delete=1&id=" + id);
            }
        }

		function updateRow(id) {
            // Get the value from the input field
            var value = document.getElementById('value_' + id).value;

            // Send AJAX request to update data
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Success
                        alert("Data updated successfully.");
                        // Refresh the page or update UI as needed
                        window.location.reload();
                    } else {
                        // Error
                        alert("Error updating data.");
                    }
                }
            };
            xhr.open("POST", "dashboard.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("action=update&id=" + id + "&value=" + value);
        }

    </script>



</body>
</html>
</body>
</html>
