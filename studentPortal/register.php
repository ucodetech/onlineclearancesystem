<?php
    require_once '../core/init.php';
    require_once APPROOT . '/includes/authhead.php';
   
   
?>
 
   	 <div class="container-fluid regcontainer p-5">
   	 	
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-6">
           <div id="showError" class="px-3">
           
          </div>
         
        </div>
        <div class="col-lg-6">
          <div class="card border-info shadow-lg">
            <div class="card-header ug-primary">
              <h3 class="m-0 text-white">
                <i class="fas fa-user-plus"></i>&nbsp;Registeration
              </h3>
            </div>
            <div class="card-body text-dark">
             <form action="" method="post" id="studentFormRegister" class="px-3 my-auto">
   			      <div class="row">
             <div class="form-group col-lg-6">
              <label for="fullName">Full Name<sup class="text-danger">*</sup></label>
              <input type="text" name="fullName" id="fullName" class="form-control form-control-lg">
            </div>
             <div class="form-group col-lg-6">
              <label for="email">Email Address<sup class="text-danger">*</sup></label>
              <input type="email" name="email" id="email" class="form-control form-control-lg" > 
            </div>
            <div class="form-group col-lg-6">
              <label for="phoneNo">Phone Number<sup class="text-danger">*</sup></label>
              <input type="tel" name="phoneNo" id="phoneNo" class="form-control form-control-lg" >
            </div>
         
            <div class="form-group col-lg-6">
              <label for="gender">Gender<sup class="text-danger">*</sup></label>
             <select name="gender" id="gender" class="form-control form-control-lg">
             	<option value="">Select Gender</option>
             	<option value="male">Male</option>
             	<option value="female">Female</option>
             </select>
            </div>
            <div class="form-group col-lg-6">
              <label for="matricNo">Matric No:<sup class="text-danger">*</sup></label>
              <input type="text" name="matricNo" id="matricNo" class="form-control form-control-lg" >
            </div>
             <div class="form-group col-lg-6">
              <label for="department">Department<sup class="text-danger">*</sup></label>
              <select name="department" id="department" class="form-control form-control-lg">
                <?php
                $general = new General();
                  $department = $general->getDepartment();
                 ?>
                  <option value="" <?= (($department == ''))? ' selected' : '' ;?>>Select department</option>
                 <?php foreach ($department as $dpt): ?>

                      <option value="<?=$dpt->department_name;?>" <?= (($department == $dpt->department_name))? ' selected' : '' ;?>><?=$dpt->department_name ?></option>
                 <?php endforeach; ?>



              </select>
            </div>
            <div class="form-group col-lg-6">
              <label for="typeReg">Register As<sup class="text-danger">*</sup></label>
              <select name="typeReg" id="typeReg" class="form-control form-control-lg">
              	<option value="">Select Type</option>
             	<option value="student_nd">Student ND</option>
             	<option value="student_hnd">Student HND</option>
             </select>
            </div>
            <div class="form-group col-lg-6">
              <label for="password">Password<sup class="text-danger">*</sup></label>
              <input type="password" name="password" id="password" class="form-control form-control-lg">
            </div>
            <div class="form-group col-lg-6">
              <label for="confirmPassword">Confirm Password<sup class="text-danger">*</sup></label>
              <input type="password" name="confirmPassword" id="confirmPassword" class="form-control form-control-lg">
            </div>
       		<div class="form-group col-lg-6">
       		
              <button type="submit" name="registerBtn" id="registerBtn" class="btn  btn-success">Register</button>
              <input type="reset" name="reset" id="reset" class="btn  btn-danger" value="Reset">
            </div><hr>
            <div class="form-group col-lg-12">
             Already have an account?<a href="login" id="login-link">&nbsp;Login</a>
            </div>
            <small class="text-success">After successfully registration you will recevice an e-mail with ur login details</small>
          </div>
        </form>
            </div>
          </div>
        </div>
      </div>

    </div>
   <!-- Content Wrapper. Contains page content -->
 <style>
 	#regErrors{
 	width:80%;
	margin:15px auto;
	height: auto; 
	border-radius: 20px;
	
}
	.regcontainer{
	background-image: url('../images/banner2.jpg');
     background-repeat: no-repeat;
     background-size: cover;
    /*background: radial-gradient(circle at 30% 107%, #d225a1 0%, #564cd7 5%, #b82392 45%,#d225a1 60%,#285AEB 90%);*/
     height: auto;
   
	}
/*@media {
#regErrors{
 	width:60%;
	margin:15px auto;
	height: auto; 
	border-radius: 20px;
	position: fixed;
	top: 0;
	left: 20%;
	right: 50%;
	z-index: 10;
	
}	
}*/
 </style>

           
<?php
    require_once APPROOT . '/includes/footer1.php';

?>


<script type="text/javascript">


 function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#passportShow').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#passport").change(function() {
  readURL(this);
});

  $(document).ready(function(){
    	var gifPath = '../images/gif/tra.gif';
		//register process
		
		$('#registerBtn').click(function(e){
			e.preventDefault();

			$.ajax({
				url:'scripts/register-process.php',
				method:'post',
				data:$('#studentFormRegister').serialize()+'&action=register',
				beforeSend:function(){
					$('#registerBtn').html('<img src="'+gifPath+'" alt="gif">a moment...');
				},
				success:function(response){
					console.log(response);
					if ($.trim(response)==='success') {
						$('#showError').html('<div id="regErrors" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fas fa-check"></i>&nbsp;<span>Redirecting...</span></div>');

						setTimeout(function(){
							window.location = 'login';
						}, 3000);
						
					}else{
						$('#showError').html('<div id="regErrors" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
					
					}
				},
        complete:function(){
          $('#registerBtn').html('Register');
        }
			});
		});

});
</script>