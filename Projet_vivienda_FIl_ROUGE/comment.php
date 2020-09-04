<?php
// connect to datebase
include 'config/connect.php';
// array to stock the exepting error


if (isset($_POST['update'])) {
     $status = $_POST['status'];
     $id = $_POST['hiden'];
     $sql = "UPDATE comment SET status = $status  WHERE IdComment = $id ";
	$stmt = $conn->prepare($sql);
    $stmt->execute();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>backoffice</title>
  </head>
  <body>
<div class="container-xl">
	<div class="table-responsive" id= "fit-content">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
					<a href="back.php" class="btn btn-primary">Back</a>
						<h2>Manage <b>comment</b></h2>
					</div>
					
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>date </th>
						<th>Status</th>
						<th>Text</th>
						<th>USEName</th>
						<th> Property ID</th>
						<th> Action </th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql = 'SELECT comment.* ,user.UserName as name FROM comment JOIN user ON user.IdUser = comment.IDuser' ;
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$comments = $stmt->fetchAll(PDO::FETCH_OBJ);
				foreach ($comments as $comment)
				{?>

					<tr>
					  
						<td> <?php echo $comment->dateCom ?> </td>
						<td> <?php echo $comment->status ?></td>
						<td> <?php echo $comment->CmtText ?></td>
						<td> <?php echo $comment->name ?></td>
						<td> <?php echo $comment->IdProperty ?></td>
						<input type="hidden" id="custId" name="custId" value="<?php echo  $id = $comment->IdComment  ?>">
						<td>
						<button style="margin-bottom: 4px;" type="button"   onClick="test('<?php echo $comment->dateCom ?>','<?php echo $comment->status ?>', '<?php echo $comment->CmtText ?>', '<?php echo $comment->name ?>', '<?php echo $comment->IdProperty ?>', '<?php echo $id ?>')"  class="btn btn-outline-primary btn-rounded waves-effect" data-backdrop="static" data-toggle="modal" data-target="#editEmployeeModal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></button>
						<a href="../deleteUser.php?id=<?php echo $id ?>" class="btn btn-outline-danger btn-rounded waves-effect"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
						</td>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form  action="comment.php" method="POST" enctype="multipart/form-data" >
				<div class="modal-header">
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
				<div class="modal-body">
				<div class="form-group">
						<label>date</label>
						<input type="text" name="date" id="date" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label> Status</label>
						<br>
						<select class="form-control"  name="status" id="status">
							<option> 0 </option>
							<option> 1 </option>
						</select>
						
					</div>
					<div class="form-group">
						<label> Text </label>
						<textarea name="text" id="text1" class="form-control"  disabled></textarea>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" id="username1" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label>PropertyID</label>
						<input type="text" name="propertyid" id="preprtyid1" class="form-control" disabled>
					</div>
					<div class="form-group">
						<input type="hidden" id="hiden" name="hiden" value="<?php echo  $comment->IdComment ?>">
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" name="update"  value="save">

				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Delete Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
<script>
function test(date, status, text, Username, preprtyId, id){
    console.log(date, status, text, Username, preprtyId, id );
    document.getElementById("date").value =  date;
    document.getElementById("status").value =  status;
    document.getElementById("text1").value =  text;
	document.getElementById("preprtyid1").value =  preprtyId;
	document.getElementById("username1").value =  Username;
	document.getElementById("hiden").value =  id;

    
	}
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
  </body>
</html>