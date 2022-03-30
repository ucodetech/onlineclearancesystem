<?php
    require_once '../core/init.php';
    $user = new User();
    $user_id = $user->data()->id;

    if (!isLoggedInStudent()) {
      Session::flash('denied', 'You need to login to access that page!');
      Redirect::to('login');

    }

    // if (isOTPset($userEmail)) {
    //   Redirect::to('otp-verify');
    // }


    require_once APPROOT . '/includes/headportal1.php';
    require_once APPROOT . '/includes/navportal1.php';


?>
<style>
	.adminImg{
		border: 4px double navy;
		border-radius: 60%;
		width: 250px;
		height: 250px;

	}
	.adminImgs{
		border: 4px double navy;
		border-radius: 60%;
		width: 150px;
		height: 150px;

	}
	label:hover{
		cursor: pointer;
	}

</style>
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        	<div class="col-lg-8 shadow-lg p-4">
        		<span class="text-center text-lg"><?=strtok($user->data()->full_name,'')?> Details</span><hr>
        		<div class="row">
        			<div class="form-group col-lg-6">
        				<label for="full_name">Full Name</label>
        				<input type="text" name="full_name" id="full_name" value="<?=$user->data()->full_name?>" class="form-control form-control-lg" >
        			</div>
        			<div class="form-group col-lg-6">
        				<label for="matric_no">File No</label>
        				<input type="text" name="matric_no" id="matric_no" value="<?=$user->data()->matric_no?>" class="form-control form-control-lg" >
        			</div>
        			<div class="form-group col-lg-6">
        				<label for="department">Department</label>
        				<input type="text" name="department" id="department" value="<?=$user->data()->department?>" class="form-control form-control-lg"  >
        			</div>

        			<div class="form-group col-lg-6">
        				<label for="email">Email</label>
        				<input type="email" name="email" id="email" value="<?=$user->data()->email?>" class="form-control form-control-lg">
        			</div>
        			<div class="form-group col-lg-6">
        				<label for="phone_number">Phone No</label>
        				<input type="tel" name="phone_number" id="phone_number" value="<?=$user->data()->phone_number?>" class="form-control form-control-lg">
        			</div>
        		
        			<div class="form-group col-lg-12">
						<span id="message2"></span>

        			</div>
        		</div>
        	</div>
        	<div class="col-lg-4 shadow-lg">
        		<span class="text-center">Profile Pic</span><hr>
        		<center>
        			<div id="profileShow">
        				<label for="profile_file">
        						<img src="<?=URLROOT?>studentPortal/avaters/<?=$user->data()->passport?>" alt="<?=$user->data()->full_name;?>" class="img-fluid adminImg">
        			</label>
        			</div>
        		 <br>
        			Fullname: <?=$user->data()->full_name;?>
        		<hr>
        		<form action="#" id="profileForm" enctype="multipart/form-data">
        			<div class="form-group">
        				<label for="profile_file"><i class="fas fa-cloud-upload-alt fa-lg text-info"></i>&nbsp; Update Profile</label>
        				<input type="file" name="profile_file" id="profile_file" class="form-control" style="display: none">
        			</div>
        			<input type="submit" class="btn btn-info btn-xs" value="update">
        		</form>
        		</center> <hr class="invisible">
        		<span id="message"></span>
        	</div>
        </div>
        <p class="text-center lead mt-5"><i class="fa fa-password fa-lg"></i>Change Password</p>
        <div class="row shadow-lg">
        	<div class="col-lg-4 shadow-lg">
        		<form action="#" id="changePasswordForm" method="post">
        			<div class="form-group col-lg-12">
        				<label for="currentPwd">Current password: <sup class="text-danger">*</sup> </label>
        				<input type="password" name="currentPwd" id="currentPwd" class="form-control" placeholder="Current Password">
        			</div>
        			<div class="form-group col-lg-12">
        				<label for="newPwd">New password: <sup class="text-danger">*</sup> </label>
        				<input type="password" name="newPwd" id="newPwd" class="form-control" placeholder="New Password">
        			</div>
        			<div class="form-group col-lg-12">
        				<label for="retypeNewPwd">Retype New password: <sup class="text-danger">*</sup> </label>
        				<input type="password" name="retypeNewPwd" id="retypeNewPwd" class="form-control" placeholder="Retype New Password">
        			</div>
        			<div class="form-group col-lg-12" id="errors"></div>
        			   <hr class="invisible">

        			<div class="form-col-lg-12">
        				<button type="submit" id="changeBtn" class="btn btn-info btn-block">Change Password</button>
        			</div>
        			<hr class="invisible">
        		</form>
        	</div>
        	<div class="col-lg-4 shadow-lg">
        		<span class="text-center">Signature</span><hr>
        		<center>
        			<div id="profileShow">
        				<label for="profile_file">

        						<img src="<?=URLROOT?>studentPortal/avaters/<?=$user->data()->signature?>" alt="<?=$user->data()->signature?>" class="img-fluid adminImg">

        			</label>
        			</div>

        		<hr>
        		<form action="#" id="signatureForm" enctype="multipart/form-data">
        			<div class="form-group">
        				<label for="signature_file"><i class="fas fa-cloud-upload-alt fa-lg text-info"></i>&nbsp; Update Signature</label>
        				<input type="file" name="signature_file" id="signature_file" class="form-control" style="display: none">
        			</div>
        			<input type="submit" class="btn btn-info btn-xs" value="update Signature">
        		</form>
        		</center> <hr class="invisible">
        		<span id="messageSignature"></span>
        	</div>
        	<div class="col-lg-4">
        		<div class="card shadow-lg border-primary">
        		<img src="../images/gif/cga.png" alt="change password" width="408">
        	</div>
        	</div>
        </div>
        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php  require_once APPROOT .'/includes/footerportal1.php';?>
<script>

  function readURL(input){

    if (input.files && input.files[0]) {
       var reader = new FileReader();
      reader.onload = function(e){
        $('#profileShow').html('<img src="'+e.target.result+'" alt="profile pic" class="img-fluid adminImg">');
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

	$(document).ready(function(){
		$('#profile_file').change(function(){
			readURL(this);
    });
	$('#signature_file').change(function(){
			readURL(this);
    });

    $('#profileForm').submit(function(e){
    	e.preventDefault();
		$.ajax({
	        url: "scripts/setting-process.php",
	        method: "post",
	        processData: false,
	        contentType: false,
	        cache: false,
	        // data: {file: $("#profile_file").val()},
	        data: new FormData(this),
	        success: function(response) {
	        	// console.log(response);
            if($.trim(response)==="success") {
                $('#message').html('<span class="text-success">You have updated your profile pic successfully!</span>');
            }else{
            	$('#message').html(response);
            }
	       }


		});

    })


    $('#signatureForm').submit(function(e){
    	e.preventDefault();
		$.ajax({
	        url: "scripts/setting-process.php",
	        method: "post",
	        processData:false,
	        contentType:false,
	        cache: false,
	        // data: {file: $("#profile_file").val()},
	        data: new FormData(this),
	        success: function(response) {
	        	// console.log(response);
            if($.trim(response)==="success") {
                $('#message').html('<span class="text-success">You have updated your signature successfully!</span>');
            }else{
            	$('#message').html(response);
            }
	       }


		});

    })

//update users

	$('#phone_number').change(function(e){
		e.preventDefault();
		phone_number = $('#phone_number').val();
		$.ajax({
			url:'scripts/setting-process2.php',
			method:'post',
			data:{phone_number:phone_number},
			success:function(response){
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+phone_number+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})


	$('#email').change(function(e){
		e.preventDefault();
		email = $('#email').val();
		$.ajax({
			url:'scripts/setting-process2.php',
			method:'post',
			data:{email:email},
			success:function(response){
				console.log(response);
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+email+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})


	$('#full_name').change(function(e){
		e.preventDefault();
		full_name = $('#full_name').val();
		$.ajax({
			url:'scripts/setting-process2.php',
			method:'post',
			data:{full_name:full_name},
			success:function(response){
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+full_name+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})


	$('#department').change(function(e){
		e.preventDefault();
		department = $('#department').val();
		$.ajax({
			url:'scripts/setting-process2.php',
			method:'post',
			data:{department:department},
			success:function(response){
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+department+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})

	$('#matric_no').change(function(e){
		e.preventDefault();
		matric_no = $('#matric_no').val();
		$.ajax({
			url:'scripts/setting-process2.php',
			method:'post',
			data:{matric_no:matric_no},
			success:function(response){
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+matric_no+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})

	$('#username').change(function(e){
		e.preventDefault();
		username = $('#username').val();
		$.ajax({
			url:'scripts/setting-process2.php',
			method:'post',
			data:{username:username},
			success:function(response){
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+username+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})

	$('#permission').change(function(e){
		e.preventDefault();
		permission = $('#permission').val();
		$.ajax({
			url:'scripts/setting-process2.php',
			method:'post',
			data:{permission:permission},
			success:function(response){
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+permission+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})

	$('#changeBtn').click(function(e){
		e.preventDefault();

		$.ajax({
			url:'scripts/setting-process2',
			method:'post',
			data:$('#changePasswordForm').serialize()+'&action=change_password',
			success:function(response){
				$('#changePasswordForm')[0].reset();
				$('#errors').html(response);
			}
		})

	})



	})
</script>

<scripts type="text/javascripts" src="notify.js"></scripts>
<!-- <scripts type="text/javascripts" src="update.js"></scripts>
 -->
