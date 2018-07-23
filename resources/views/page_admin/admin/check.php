<?php

	$action = $_POST['action']; // Lấy giá trị action
	if(!empty($_POST['username']) && $action == 'check_user')
	{
		// Lấy giá trị user_name
		$user = $_POST['username']; 
		
		// Chuyển giá trị user_name thành chữ thường & gọi hàm kiểm tra
		username_exist(strtolower($user)); 
	}
	
	function username_exist($user)
	{
		
		$conn = mysqli_connect('localhost', 'root', '','bkcs');
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	 	$sql = "SELECT * FROM sysadmin WHERE adminId='$user'";
	 	$result = mysqli_query($conn, $sql);
		// Kiểm tra user_name mình nhập vào có nằm trong mảng đó hay không?
		// User_name thuộc 1 giá trị trong mảng => user_name tồn tại
		if($result){
			if (mysqli_num_rows($result)>0)
		{
			echo "<span class='error'>Username: <strong>{$user}</strong> đã tồn tại, sorry.!!</span>";
		}
		else // Ngược lại user_name Ko tồn tại
		{
			echo "<span class='success'>Username: <strong>{$user}</strong> Ko tồn tại, oh yeh..</span>";	
		}
	}else{
		echo "error";
		mysqli_close($conn);
	}
	}

?>