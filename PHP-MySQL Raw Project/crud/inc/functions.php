<?php 
	
	define("DB_NAME","inc/data/data.txt");
	function seed()
	{
		$data = array(
			array(
				"id"=> '1',
				"name" => 'Alamin',
				"work" => 'Developer',
				"age" => '12',
				"phone" => "017213"
			),
			array(
				"id"=> '2',
				"name" => 'jon do',
				"work" => 'software',
				"age" => '15',
				"phone" => "017879213"

			),array(
				"id"=> '3',
				"name" => 'rohim',
				"work" => 'designer',
				"age" => '17',
				"phone" => "017432213"
			),
			array(
				"id"=> '4',
				"name" => 'korim',
				"work" => 'student',
				"age" => '55',
				"phone" => "014547213"
			),
			array(
				"id"=> '5',
				"name" => 'jjj',
				"work" => 'sss',
				"age" => '78',
				"phone" => "01457213"
			)

		);
		$data = serialize($data);
	   file_put_contents(DB_NAME,$data,LOCK_EX);
	}
	function newId($users){
		
		$low = $users[0]["id"];
		foreach ($users as $value) {
		    if ($value["id"] > $low) {
		        $low = $value["id"];
		    }
		}
		return $low + 1;
	}
	function reGenarate(){
		$str = file_get_contents(DB_NAME);
		$values = unserialize($str);
		?>
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Work</th>
						<th>Age</th>
						<th>Phone</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					foreach ($values as $data) {
					?>
					<tr>
						<td><?php printf("%s",$data['id']); ?></td>
						<td><?php printf("%s",$data['name']); ?></td>
						<td><?php printf("%s",$data['work']); ?></td>
						<td><?php printf("%s",$data['age']); ?></td>
						<td><?php printf("%s",$data['phone']); ?></td>
						<td>
						<?php 
							printf('<a  href="index.php?task=edit&id=%s">Edit</a> | <a class="delete" href="index.php?task=del&id=%s">Delete</a>',$data['id'],$data['id']);
						 ?>
					</tr>
					<?php
					}
			    ?>
					
				</tbody>
			</table>
		<?php
		
	}

	function addUsers($name,$work,$age,$phone){
		$found = false;
		$serializeData = file_get_contents(DB_NAME);
		$users = unserialize($serializeData);
		$newId = newId($users);
		foreach ($users as $data) {
			if ($data['phone'] == $phone) {
				$found = true;
				break;
			}
		}
		if (!$found) {
			$user = array(
				"id" => $newId,
				"name" => $name,
				"work" => $work,
				"age" => $age,
				"phone" => $phone
			);

			array_push($users,$user);
		    $data = serialize($users);
		    file_put_contents(DB_NAME,$data,LOCK_EX);
		    return true;
		}
		return false;
		

	}
	
	 function getUser($id){
	 	$serializeData = file_get_contents(DB_NAME);
		$users = unserialize($serializeData);
		foreach($users as $user){
			if ($user["id"] == $id) {
				return $user;
			}
			
		}
		return false;
	 }
	 function userUpdate($id,$name,$work,$age,$phone)
	 {
	 	$found = false;
	 	$serializeData = file_get_contents(DB_NAME);
		$users = unserialize($serializeData);

		foreach($users as $user){
			if ($user["phone"] == $phone & $user["id"] !== $id) {
				$found = true;
				break;
			}
			
		}
		if (!$found) {
			$users[$id-1]["name"] = $name;
			$users[$id-1]["work"] = $work;
			$users[$id-1]["age"] = $age;
			$users[$id-1]["phone"] = $phone;

			$data = serialize($users);
		    file_put_contents(DB_NAME,$data,LOCK_EX);
		    return true;
		}
		return false;
		
	 }
	function userDelete($id)
	{
	 	$serializeData = file_get_contents(DB_NAME);
		$users = unserialize($serializeData);
		$found = false;
		foreach($users as $key => $value){
			if ($value["id"] == $id) {
				unset($users[$key]);
				$found = true;
			}else{
				$found = false;
			}
		}
		$data = serialize($users);
		file_put_contents(DB_NAME,$data,LOCK_EX);
		return $found;
	}
 ?>

 <?php  



