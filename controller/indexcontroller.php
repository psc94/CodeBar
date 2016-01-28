<?php
session_start();

/*
 *
 *
 */
 
 if(@$_SESSION['username']!=NULL)
 {
 	header('location:user.php');
 }
 
 
require_once 'model/indexmodel.php';
require_once 'model/userfunctions.php';
class indexcontroller {
	function __construct() {
		$this -> conn = new indexmodel();
		$this -> usf=new userfunctions();
	}

	public function redirect($location) {
		header('location: ' . $location);
	}

	public function handlerequest($err) {
		$msg = $this -> conn -> Check();
		$upComingTime = $this -> conn -> getTimeForUpComing();
		$presentcontest = $this -> conn -> fetch_present_contest();
		$futurecontest = $this -> conn -> fetch_future_contest();
		$pastcontest = $this -> conn -> fetch_past_contest();
		/*if ($msg) {
			echo 'Connection Established ';
		} else {
			echo 'Connection could not established';
		}*/
		if (isset($_POST['login'])) {
			$this -> validateuser();
		}
		if (isset($_POST['signup'])) {//header("location:index.php?error=1");
			$this -> adduser();
		}
		include 'view/viewindex.php';
	}

	public function validateuser() {
		$username = mysql_real_escape_string($_POST['username']);
		$_SESSION['username']=$username;
		if (trim($username) == "" or trim($_POST['password'] == "")) {
			$this -> redirect('index.php?error=1');
			//$this -> invalidate();
		} else {
			$password = $_POST['password'];
			$result = $this -> conn -> loginfetch($username, $password);

			$pass = md5($password);
			$currhash = crypt($pass, $result['salt']);
			if ($currhash == $result['hash']) {
				$values = $this -> usf -> messages("login");

				$_SESSION['username'] = $username;
				$_SESSION['messages'] = $values[0];
				$_SESSION['class'] = $values[1];
				//$_SESSION['flag'] = TRUE;
				$this -> redirect('user.php');

			} else {
				$this -> redirect('index.php?error=1');
				//echo 'wrong';
				//echo "error=1";
				//include 'view/viewindex.php?';
			//	$this -> invalidate();
			}
		}
	}

	public function adduser() {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$_SESSION['username'] = $username;
		$password = $_POST['password'];
		$msg = $this -> conn -> Add($name, $username, $email, $password);
		if ($msg) {
			$usf = new userfunctions();
			$values = $this -> usf -> messages("signup");

			$_SESSION['messages'] = $values[0];
			$_SESSION['class'] = $values[1];
			header("location:user.php");
		} else {
			echo 'Error';
		}
	}
	public function invalidate()
	{
		/*echo"<div class="modal fade bs-example-modal-sm " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" name="messages" id="invalidate">
			  <div class="modal-dialog modal-sm alert alert-danger">

				Wrong username or password
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="modal" data-target="#invalidate">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>";*/
		echo"<script>
				$('#invalidate').modal('show');
			</script>";
	}
	

}

?>