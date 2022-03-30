
<?php
require_once '../../core/init.php';
if (!hasPermissionSuper()) {
    Redirect::to('../../admin-dashboard');
}
require_once APPROOT . '/includes/headportal.php';
require_once APPROOT . '/includes/navportal.php';

$msg = '';
$general = new General();
$student = new Student();

if (isset($_GET['detail']) && !empty($_GET['detail'])) {
  $detail = (int)$_GET['detail'];
    	$studentDetail = $student->getStudentDetail($detail);
			if ($studentDetail) {
				?>

				   <style>

#updateError{
    font-size: 1.0rem;
	text-align: left;
	border-radius: 20px;

}
#showError{
	position: fixed;
	z-index: 1;
	top:10%;
	right: 2%;
	width: 100%;
	height: auto;

}
				   </style> <!-- Content Wrapper. Contains page content -->

           <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <div class="content-header">
               <div class="container-fluid myPage">
                 <?php echo $title;?> <br>
                 <?=$msg ?>
               </div>
               <div id="showError">

               </div><!-- /.container-fluid -->
             </div>
             <!-- /.content-header -->
				    <!-- Main content -->
				    <div class="content">
				      <div class="container-fluid">
				   		<?php
				   	$imgPath = '../../../studentPortal/avaters/';

      		  $passport = '<img src="'.$imgPath.$studentDetail->passport.'"  alt="Student Passport" width="150px" height="150px" style="border-radius:50px;">';

		      if($studentDetail->verified == 0){
		          $Verifiedmsg ='No &nbsp;(Email not verified)';
		      }else{

		        $Verifiedmsg ='Yes &nbsp;(Email  verified)';

		      }

              //check age
			       $age = date('Y') - pretty_year($studentDetail->dob);
			       $age = 'Age&nbsp; '.'('.$age.')';
			        	?>

						<div class="card">
				        <h4 class="text-dark m-3 p-3"><?=strtok($studentDetail->full_name, ' ');?>'s Detail</h4>

				          <div class="card-body text-dark">
				          <h3 class="text-center">Full Name: &nbsp; <?=$studentDetail->full_name;?></h3><hr>
				          <center><?=$passport;?></center><br><br>
				          <div class="row">
				          	<div class="form-group col-md-6 shadow-lg">
				          		<input type="text" class="form-control form-control-lg" name="fullName"  value="<?=$studentDetail->full_name;?>">

				            </div>
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="email" class="form-control form-control-lg" name="email" value="<?=$studentDetail->email;?>">
				            </div>
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="tel" class="form-control form-control-lg" name="phoneNo" value="<?=$studentDetail->phone_number;?>">

				            </div>
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="text" class="form-control form-control-lg" name="matricNo"  value="<?= $studentDetail->matric_no;?>">

				            </div>

				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="text" class="form-control form-control-lg" name="department" value="<?=$studentDetail->department;?>">

				            </div>

				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="text" class="form-control form-control-lg" name="gender" value="<?=$studentDetail->gender;?>">

				            </div>
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="date" class="form-control form-control-lg" name="dob" id="" value="<?=$studentDetail->dob;?>">

				            </div>
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="disabled" class="form-control form-control-lg"  value="<?=$age;?>" readonly>
				            </div>
				              <div class="form-group col-md-6 shadow-lg">
				            	<input type="disabled" class="form-control form-control-lg"  value="<?=$Verifiedmsg;?>" readonly>
				            </div>
				             <div class="form-group col-md-6 shadow-lg">
				             <input type="disabled" class="form-control form-control-lg" value="joined on: <?=pretty_dates($studentDetail->dateJoined);?>" readonly>

				            </div>
				          </div>
				          </div>
				          </div>
				          <!-- end of card -->


				    </div><!-- /.container-fluid -->
				    <!-- /.content -->
				  </div>
				  <!-- /.content-wrapper -->


				</div>

				<?
			}

    }


?>

<?php require_once APPROOT . '/includes/footerportal.php';?>

<script>
  $(document).ready(function(){

  	$('input[name="fullName"]').change(function(e){
  		studentId = '<?=$detail;?>'
  		fullName = $('input[name="fullName"]').val();

      	$.ajax({
      		url: '../../script/student-process.php',
      		method: 'post',
      		data: {studentId: studentId, fullName:fullName},
      		success:function(response){
  			if ($.trim(response)==='success') {
  				$('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+fullName+' Updated Successfully.. Page about to reload!</span></div>');
					setTimeout(function(){
						location.reload();
					}, 5000);
				}else{
					$('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

					setTimeout(function(){
						$('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
					}, 10000);

				}
      		}
      	});

    });

    $('input[name="email"]').change(function(e){
  		studentId = '<?=$detail;?>'
  		email = $('input[name="email"]').val();

      	$.ajax({
      		url: '../../script/student-process.php',
      		method: 'post',
      		data: {studentId: studentId, email:email},
      		success:function(response){
  			if ($.trim(response)==='success') {
  				$('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+email+ ' Updated Successfully.. Page about to reload!</span></div>');
					setTimeout(function(){
						location.reload();
					}, 5000);
				}else{
					$('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

					setTimeout(function(){
						$('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
					}, 10000);

				}
      		}
      	});

    });

    $('input[name="phoneNo"]').change(function(e){
      studentId = '<?=$detail;?>'
      phoneNo = $('input[name="phoneNo"]').val();

        $.ajax({
          url: '../../script/student-process.php',
          method: 'post',
          data: {studentId: studentId, phoneNo:phoneNo},
          success:function(response){
        if ($.trim(response)==='success') {
          $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+phoneNo+ ' Updated Successfully.. Page about to reload!</span></div>');
          setTimeout(function(){
            location.reload();
          }, 5000);
        }else{
          $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

          setTimeout(function(){
            $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
          }, 10000);

        }
          }
        });

    });


    $('input[name="matricNo"]').change(function(e){
          studentId = '<?=$detail;?>'
          matricNo = $('input[name="matricNo"]').val();

            $.ajax({
              url: '../../script/student-process.php',
              method: 'post',
              data: {studentId: studentId, matricNo:matricNo},
              success:function(response){
            if ($.trim(response)==='success') {
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+matricNo+ ' Updated Successfully.. Page about to reload!</span></div>');
              setTimeout(function(){
                location.reload();
              }, 5000);
            }else{
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

              setTimeout(function(){
                $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
              }, 10000);

            }
              }
            });

});


  $('input[name="school"]').change(function(e){
          studentId = '<?=$detail;?>'
          school = $('input[name="school"]').val();

            $.ajax({
              url: '../../script/student-process.php',
              method: 'post',
              data: {studentId: studentId, school:school},
              success:function(response){
            if ($.trim(response)==='success') {
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+school+ ' Updated Successfully.. Page about to reload!</span></div>');
              setTimeout(function(){
                location.reload();
              }, 5000);
            }else{
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

              setTimeout(function(){
                $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
              }, 10000);

            }
              }
            });

});


$('input[name="department"]').change(function(e){
          studentId = '<?=$detail;?>'
          department = $('input[name="department"]').val();

            $.ajax({
              url: '../../script/student-process.php',
              method: 'post',
              data: {studentId: studentId, department:department},
              success:function(response){
            if ($.trim(response)==='success') {
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+department+ ' Updated Successfully.. Page about to reload!</span></div>');
              setTimeout(function(){
                location.reload();
              }, 5000);
            }else{
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

              setTimeout(function(){
                $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
              }, 10000);

            }
              }
            });

});

$('input[name="level"]').change(function(e){
          studentId = '<?=$detail;?>'
          level = $('input[name="level"]').val();

            $.ajax({
              url: '../../script/student-process.php',
              method: 'post',
              data: {studentId: studentId, level:level},
              success:function(response){
            if ($.trim(response)==='success') {
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+level+ ' Updated Successfully.. Page about to reload!</span></div>');
              setTimeout(function(){
                location.reload();
              }, 5000);
            }else{
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

              setTimeout(function(){
                $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
              }, 10000);

            }
              }
            });
  });

$('input[name="gender"]').change(function(e){
              studentId = '<?=$detail;?>'
              gender = $('input[name="gender"]').val();

                $.ajax({
                  url: '../../script/student-process.php',
                  method: 'post',
                  data: {studentId: studentId, gender:gender},
                  success:function(response){
                if ($.trim(response)==='success') {
                  $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+gender+ ' Updated Successfully.. Page about to reload!</span></div>');
                  setTimeout(function(){
                    location.reload();
                  }, 5000);
                }else{
                  $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

                  setTimeout(function(){
                    $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
                  }, 10000);

                }
                  }
                });

        });

        $('input[name="dob"]').change(function(e){
                  studentId = '<?=$detail;?>'
                  dob = $('input[name="dob"]').val();

                    $.ajax({
                      url: '../../script/student-process.php',
                      method: 'post',
                      data: {studentId: studentId, dob:dob},
                      success:function(response){
                    if ($.trim(response)==='success') {
                      $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+dob+ ' Updated Successfully.. Page about to reload!</span></div>');
                      setTimeout(function(){
                        location.reload();
                      }, 5000);
                    }else{
                      $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

                      setTimeout(function(){
                        $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
                      }, 10000);

                    }
                      }
                    });

            });


});
</script>
