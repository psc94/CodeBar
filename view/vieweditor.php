
<!DOCTYPE HTML>
<html>
	<head>
	
		<title>CodeBar</title>
		<?php
		include 'depend.php';
		?>
		
	</head>
	<body>
		<!-- <?php echo $_SESSION['problem'];?> -->
		<div class="container-fluid">
			<div class="row">
				<?php include 'header.php'
				?>
			</div>
		</div>
		
					<!-- Status Modal-->
			<div class="modal fade bs-example-modal-sm " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" name="messages" id="loginsuccessmsg">
				<div class="modal-dialog modal-sm alert <?php echo @$_SESSION['class']; ?>">

					<?php echo @$_SESSION['message']; ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="modal" data-target="#loginsuccessmsg">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
			<!-- Status Modal Ends -->
             
			<?php 
			$status=@$_SESSION['status'];
			if(@$_SESSION['status']>0){
				
			?>
			<script>
				$('#loginsuccessmsg').modal('show');
			</script>
			<?php $_SESSION['status'] = -1;

				}
 ?>
 
		<div class="container-fluid">
			<!--navigation map -->
			<div class="row">
            	<div class="container-fluid" style="padding-bottom:10px; margin-left: 10px;">
            	<a href="user.php">User Dashboard</a>&nbsp;>>&nbsp;<a href="contest.php"><?php echo $_SESSION['contest'];?></a>
            	</div>
            </div>

			<!--second div-->
			<div class="row">
				<div class="col-sm-2">

				</div>
				<div class="col-sm-8">
					<div class="container-fluid">
						<form class="form-horizontal" name="form1" method="post" action="">
							<div class="form-group">
								<label for="inputDifficulty" class=" control-label">Select Language</label>
								<div class="col-sm-3">
									<select class="form-control" id="mode" name="lang" >
										<option value="c" id="c">C</option>
										<option value="cpp" id="cpp">C++</option>
										<option value="java" id="Java">Java</option>
										<!--<option value="py" id="Java">Python</option>-->
									</select>
								</div>
							</div>
							<div class="form-group">
								<textarea name="code" id="code" hidden></textarea>
							</div>
							<div class="form-group">
								<div class="panell panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Write your code here for <?php echo $_SESSION['problem']; ?></h3>
									</div>
									<div class="panel-body">

										<div id="editor" name="editor" style="height: 300px"><?php echo htmlspecialchars(@$_SESSION[$_SESSION['problem'].'code']); ?></div>

									</div>
								</div>
							</div>
							<div class="col-sm-offset-4">
								<button type="submit" class="btn btn-info"  id="compilecode" name="ctsubmit">
								Compile and test
							</button>
														
								<button  type="submit" class="btn btn-info"  id="submitcode" name="csubmit">
									Submit your code here
								</button>
							
								
								
                            </div>
                        </form>    					         			
					</div>		
							<!-- html code for wrong answer START-->
							</br>
							<?php
							if(@$_SESSION['message'] == "Compile Time Error"){ 

							?>
					<div class="form-group">
						<textarea class="form-control" rows="5" readonly>
							<?php echo "\r\n";
							echo $_SESSION['contents'];
							$_SESSION['message'] = "error";
						    
							?>
							
						</textarea>
						
					</div>
							<?php } ?>
							<!-- html code for wrong answer END -->
 
					<!--yaha pe ths-->
					<div class="col-sm-2">

					</div>
					
				</div>
			<div class="col-sm-2">
				<div>
						<div align="center">
							<p>
								<strong>Contest Ends In:</strong>
							</p>
							<div id="timer" style="height: 50px;background-color: white;border: 0px"></div>
						</div>
					</div>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="container-fluid">
				<?php include 'footer.php'
				?>
			</div>
		</div>
				<!--script for count down-->	
	<script>
	    var sec = '<?php echo ( $getTime[0]['stampend'] - time()-16200 );?>';
		$('#timer').countdown({until: +sec,padZeroes: true,format: 'dHMS'});
	</script>
	</body>
</html>