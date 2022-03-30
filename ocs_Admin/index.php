<?php
    require_once '../core/init.php';
    require_once APPROOT . '/includes/authhead.php';



?>
    <!-- Content Wrapper. Contains page content -->
 <style>
 	#loginError{
	margin-top: 15px;
	margin-bottom: 0px;
	height: auto;
	border-radius: 20px;
	position: fixed;
	z-index: 10;
}
 </style>
   	 <div class="container h-100">
   	 	 <div class="row align-items-center justify-content-center ">
        <div class="col-lg-5">
        	<?php
          		if(Session::exists('denied')){
          		echo '<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">
                            &times;
                            </button>
                            <strong class="text-center">'. Session::flash('denied') .'</strong>
                            </div>';
                        }
                    ?>
          <div id="showError" class="px-3">


          </div>
        </div>
      </div>
      <div class="row h-100 align-items-center justify-content-center">
        <div class="col-lg-5">
          <div class="card border-danger shadow-lg">
            <div class="card-header bg-danger">
              <h3 class="m-0 text-white">
                <i class="fas fa-user-cog"></i>&nbsp; WELCOME
              </h3>
            </div>
            <div class="card-body text-dark text-center">
                <a  href="admin-login" class="btn btn-info btn-lg">Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>


<?php
    require_once APPROOT . '/includes/footer1.php';

?>


<script>
	$(document).ready(function(){
		var gifPath = '../images/gif/tra.gif';
		//register process
		$('#loginAdminBtn').click(function(e){
			e.preventDefault();

			$.ajax({
				url:'script/login-process.php',
				method:'post',
				data: $('#adminFormLogin').serialize()+'&action=login',
				beforeSend:function(){
					$('#loginAdminBtn').html('<img src="'+gifPath+'" alt="loader">&nbsp;a moment');
				},
				success:function(response){
					if ($.trim(response)==='success') {
						$('.card').css('display', 'none');
						$('#showError').html('<div id="loginError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>Redirecting...</span></div>');
						setTimeout(function(){
							window.location = 'admin-dashboard';
						}, 3000);

					}else{
						$('#showError').html('<div id="loginError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

					}
				},
				complete:function(){
					$('#loginAdminBtn').html('Login Admin');
				}
			});
		});

	});
</script>
