<?php
    require_once '../core/init.php';
    require_once APPROOT . '/includes/headportal.php';
    require_once APPROOT . '/includes/navportal.php';

?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid myPage">
       <?php echo $title ;?>

      </div>
       <div id="showError">

       </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

   		<div class="container myForm">
   			<form action="" method="post" id="adminFormRegister" class="px-3 my-auto">
   				<div class="row">
   					<div class="form-group col-lg-4">
   						<label for="fullName">Full Name<sup class="text-danger">*</sup></label>
   						<input type="text" name="fullName" id="fullName" class="form-control form-control-lg" placeholder="Enter Full Name">
   					</div>
   					<div class="form-group col-lg-4">
   						<label for="fileNo">File No<sup class="text-danger">*</sup></label>
   						<input type="text" name="sudo_fileNo" id="fileNo" class="form-control form-control-lg" placeholder="Enter File No">
   					</div>
   					<div class="form-group col-lg-4">
   						<label for="email">Enter Address<sup class="text-danger">*</sup></label>
   						<input type="email" name="sudo_email" id="email" class="form-control form-control-lg" placeholder="Enter Enter Address">
   					</div>
   					<div class="form-group col-lg-4">
   						<label for="phoneNo">Phone No.<sup class="text-danger">*</sup></label>
   						<input type="tel" name="sudo_phoneNo" id="phoneNo" class="form-control form-control-lg" placeholder="Enter Phone No.">
   					</div>

   					<div class="form-group col-lg-4">
   						<label for="password">Password<sup class="text-danger">*</sup></label>
   						<input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Enter Password">
   					</div>
   					<div class="form-group col-lg-4">
   						<label for="confirm_password">Retype Password<sup class="text-danger">*</sup></label>
   						<input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-lg" placeholder="Retype Password">
   					</div>
   					<div class="form-group col-lg-4">
   						<label for="fullName">Admin Permission<sup class="text-danger">*</sup></label>
   						<select name="permission" id="permission" class="form-control form-control-lg">
   							<?php
                            $db = Database::getInstance();
   								$sql = "SELECT * FROM permissions WHERE deleted = 0";
   								$query = $db->query($sql);
   								$row = $query->results();
                                  $permission = '';
   							 ?>
                            <option value="" <?= (($permission == ''))? ' selected' : '' ;?>>Select Permission</option>

                            <?php foreach($row as $permissions):?>
                                <option value="<?=$permissions->permission;?>" <?= (($permission == $permissions->permission))? ' selected' : '' ;?>><?=$permissions->permission;?></option>

                            <?php  endforeach; ?>

   						</select>
   					</div>
            <div class="form-group col-lg-4">
   						<label for="sudo_department">Department<sup class="text-danger">*</sup></label>
   						<select name="sudo_department" id="sudo_department" class="form-control form-control-lg">
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
   				</div>
   				<div class="row">

   					<div class="col-lg-6">
   						<button type="submit" name="addAdmin" id="addAdminBtn" class="btn  btn-success">Add Admin</button>
   						<input type="reset" class="btn btn-danger" value="Reset">
   					</div>
   				</div>
   			</form>
   		</div>

    </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



</div>

<?php require_once APPROOT . '/includes/footerportal.php';?>

<script>
	$(document).ready(function(){
		var gifPath = '../images/gif/tra.gif';
		//register process
		$('#addAdminBtn').click(function(e){
			e.preventDefault();

			$.ajax({
				url:'script/register-process.php',
				method:'post',
				data: $('#adminFormRegister').serialize()+'&action=add_admin',
				beforeSend:function(){
					$('#addAdminBtn').html('<img src="'+gifPath+'" alt="loader">&nbsp;a moment');
				},
				success:function(response){
					if ($.trim(response)==='success') {
						$('#adminFormRegister')[0].reset();
						$('#addAdminBtn').html('<img src="'+gifPath+'" alt="loader">&nbsp;Redirecting...');
            setTimeout(function(){
              window.location = 'admin-admins';
            }, 3000);
					}else{
						$('#showError').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

					}
				},
                complete:function(){
                    $('#addAdminBtn').html('Add Admin');
                }

			});
		});

	});

</script>
