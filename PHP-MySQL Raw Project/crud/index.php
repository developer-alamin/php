<?php require_once 'inc/functions.php'; ?>
<?php 
	$msg = "";
 	$taks = $_GET['task'] ?? 'report';
 	
 	if ('seed' == $taks) {
 		seed();
 		$msg = "Seeding is Complate";
 	}



 	if (isset($_POST['submit'])) {
 		$name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
 		$work = filter_input(INPUT_POST,'work',FILTER_SANITIZE_STRING);
 		$age = filter_input(INPUT_POST,'age',FILTER_SANITIZE_STRING);
 		$phone = filter_input(INPUT_POST,'phone',FILTER_SANITIZE_STRING);

 		$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
 		if ($id) {
 			$update = userUpdate($id,$name,$work,$age,$phone);
 			if ($update) {
 				header("location: index.php?task=report");
 			}else{
 				$msg = "Phone Alrady Extis";
 			}
 		}else{
 			$result = addUsers($name,$work,$age,$phone);
	 		if ($result) {
	 			header("location: index.php?task=report");
	 		}else {
	 			$msg = "Phone Alrady Extis";
	 		}
 		}	
 	}
 	if ("del" == $_GET["task"]) {
 		 $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
 		 $delete = userDelete($id);
 		 if ($delete) {
 		 	$msg = "User Delete Suceess";
 		 }else{
 		 	$msg = "User Delete Faild";
 		 }
 		 header("location: index.php?task=report");
 	}



  ?>
<?php include_once 'inc/template/header.php'; ?>
<div class="row">
	<div class="col-6 m-auto">
		<?php include_once 'inc/template/nav.php'; ?>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<?php if ($msg): echo "<h6> {$msg} </h6>"; endif;?> 

						<?php if ("report" == $_GET['task'] ): ?>
							<h4>Users All Data</h4>
						<?php reGenarate(); ?>
						<?php endif; ?>


						<?php if ("add" == $_GET['task']): ?>
							<form action="index.php?task=add" method="POST">
								<div class="row">
									<div class="col-12">
										<label for="name">Name:</label>
										<input type="text" id="name" name="name" class="form-control" placeholder="Enter Name..">
									</div>
									<div class="col-12">
										<label for="work">Work:</label>
										<input type="text" id="work" name="work" class="form-control" placeholder="Enter Work..">
									</div>
									<div class="col-12">
										<label for="age">age:</label>
										<input type="text" id="age" name="age" class="form-control" placeholder="Enter Age..">
									</div>
									<div class="col-12">
										<label for="phone">Phone:</label>
										<input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Phone..">
									</div>
									<div class="col-12 mt-2">
										<button type="submit" name="submit" class="form-control">Submit</button>
									</div>
								</div>	
							</form>
						
						<?php endif; ?>


						<?php if("edit" == $_GET['task']): ?>
						<?php 
							$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
							$user = getUser($id);
						?>
						<?php if($user): ?>
							<form method="POST">
								<div class="row">
									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<div class="col-12">
										<label for="name">Name:</label>
										<input type="text" id="name" name="name" class="form-control" value="<?php echo $user["name"]; ?>">
									</div>
									<div class="col-12">
										<label for="work">Work:</label>
										<input type="text" id="work" name="work" class="form-control" value="<?php echo $user["work"]; ?>">
									</div>
									<div class="col-12">
										<label for="age">age:</label>
										<input type="text" id="age" name="age" class="form-control"  value="<?php echo $user["age"]; ?>">
									</div>
									<div class="col-12">
										<label for="phone">Phone:</label>
										<input type="text" id="phone" name="phone" class="form-control"  value="<?php echo $user["phone"]; ?>">
									</div>
									<div class="col-12 mt-2">
										<button type="submit" name="submit" class="form-control">Update</button>
									</div>
								</div>	
							</form>
						<?php else: $msg = "User Not Found"; endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>	

<?php include_once 'inc/template/footer.php'; ?>
