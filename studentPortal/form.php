<?php
    require_once '../core/init.php';
    require_once APPROOT . '/includes/authhead.php';
    require_once (APPROOT .'/studentPortal/formFunction.php');



?>
<style>
	.container{
		margin: 10px auto;
	}
</style>
	<?php 
formContainerOpen();
	formHeader('USER REGISTRATION FORM');
	formOpen();
	formDivRowOpen();
		formDivGroupOpen('col-lg-6');
			formLabel('First Name:');
			formInput('text', 'firstname', 'firstname', 'form-control form-control-lg', 'Enter First Name');
			
		formDivGroupClose();

		formDivGroupOpen('col-lg-6');
			formLabel('Last Name:');
			formInput('text', 'lastname', 'lastname', 'form-control form-control-lg', 'Enter Last Name');
			
		formDivGroupClose();

		formDivGroupOpen('col-lg-6');
			formLabel('Email:');
			formInput('email', 'email', 'email', 'form-control form-control-lg', 'Enter Email Address');
			
		formDivGroupClose();

		formDivGroupOpen('col-lg-6');
			formLabel('Phone No:');
			formInput('tel', 'phoneNo', 'phoneNo', 'form-control form-control-lg', 'Enter Phone No');
			
		formDivGroupClose();

		formDivGroupOpen('col-lg-6');
			formLabel('Date of Birth:');
			formInput('date', 'dateofBirth', 'dateofBirth', 'form-control form-control-lg');
			
		formDivGroupClose();

		formDivGroupOpen('col-lg-6');
			formLabel('Department:');
			formInput('text', 'department', 'department', 'form-control form-control-lg', 'Enter department');
			
		formDivGroupClose();

		formDivGroupOpen('col-lg-6');
			formLabel('Level:');
			formInput('text', 'level', 'level', 'form-control form-control-lg', 'Enter level');
			
		formDivGroupClose();

		formDivGroupOpen('col-lg-6');
			formLabel('State:');
			formSelectOpen('state', 'state', 'form-control form-control-lg');
				formOption(' ', 'Select State');
				formOption('kogi', 'Kogi');
				formOption('abia', 'Abia');
				formOption('imo', 'Imo');
				formOption('enugu', 'Enugu');
			formSelectClose();
			
		formDivGroupClose();
		formDivGroupOpen('col-lg-6');
			formLabel('LGA:');
			formSelectOpen('lga', 'lga', 'form-control form-control-lg');
				formOption(' ', 'Select Local Govt Area');
				formOption('idah', 'Idah');
				formOption('aba', 'Aba');
				formOption('owerri', 'Owerri');
				formOption('nsukka', 'Nsukka');
			formSelectClose();
			
		formDivGroupClose();
		formDivGroupOpen('col-lg-6');
			formLabel('country:');
			formSelectOpen('country', 'country', 'form-control form-control-lg');
				formOption(' ', 'Select County');
				formOption('Nigeria', 'Nigeria');
				formOption('non-nigerian', 'Non Nigerian');
			formSelectClose();
			
		formDivGroupClose();
	formDivGroupOpen('col-lg-6');
		formButton('submit', 'register', 'register', 'btn btn-info btn-lg', 'Register');

	formDivGroupClose();
	formDivGroupOpen('col-lg-6');
		formButton('reset', 'reset', 'reset', 'btn btn-danger btn-lg', 'Reset Form');
		
	formDivGroupClose();

	formDivRowClose();
formClose();
formContainerClose();


	 ?>
           
<?php
    require_once APPROOT . '/includes/footer1.php';

?>
