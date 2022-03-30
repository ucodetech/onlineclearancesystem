<?php
require_once '../../core/init.php';

$student = new User();
$show = new Show();

if (isset($_POST['action']) && $_POST['action'] == 'register') {

  if (Input::exists()) {
            $fullname = ((isset($_POST['fullName']) && !empty($_POST['fullName']))?$show->test_input($_POST['fullName']):'');
            $email = ((isset($_POST['email']) && !empty($_POST['email']))?$show->test_input($_POST['email']):'');
            $phoneNo = ((isset($_POST['phoneNo']) && !empty($_POST['phoneNo']))?$show->test_input($_POST['phoneNo']):'');
            $gender = ((isset($_POST['gender']) && !empty($_POST['gender']))?$show->test_input($_POST['gender']):'');
            $matricNo = ((isset($_POST['matricNo']) && !empty($_POST['matricNo']))?$show->test_input($_POST['matricNo']):'');
            $department = ((isset($_POST['department']) && !empty($_POST['department']))?$show->test_input($_POST['department']):'');
            $type = ((isset($_POST['typeReg']) && !empty($_POST['typeReg']))?$show->test_input($_POST['typeReg']):'');
            $password = ((isset($_POST['password']) && !empty($_POST['password']))?$show->test_input($_POST['password']):'');
            $confirmPassword = ((isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword']))?$show->test_input($_POST['confirmPassword']):'');

          $required = array('fullName','email','phoneNo','gender','matricNo','department','typeReg','password','confirmPassword');
          foreach ($required as $field) {
            if (empty($_POST[$field])) {
              echo 'All Fields with Asterisk (*) are required!';
              return false;
            }
          }//end of foreach

               if ($type === 'student_nd') {
                  $permissioned = 'student_nd';

                }elseif($type === 'student_hnd'){
                  $permissioned = 'student_hnd';

                }


              if ($student->findEmail($email)) {
                echo 'Email already exists!';
                return false;
              }else{
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  echo 'Email is invalid!';
                return false;
                }
              }
             
              if ($student->findPhone($phoneNo)) {
                echo 'Phone No already exists!';
                return false;
              }
              if ($student->findMatricNo($matricNo)) {
                  echo 'Matric No already exists!';
                  return false;
              }


      if (strlen($password) < 10) {
                echo 'Password must be at least 10 character or more!';
                return false;
              }

              if ($confirmPassword != $password) {
                echo 'Password mismatch!';
                return false;
              }



          try {

                $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                $matricNo = strtoupper($matricNo);
                $student->create(array(

              'department'  => $department,
              'full_name'  => $fullname,
              'email'  => $email,
              'password'  => $passwordhash,
              'gender'  => $gender,
              'matric_no'    => $matricNo,
              'phone_number'  => $phoneNo,
              'permission'   => $permissioned,
              'passport' => 'default.png'
          ));
            $randNo = rand(1000, 9999);
            $token = md5(microtime(uniqid()));
            $url =  'https://localhost/onlineclearancesystem/studentPortal/verify_email.php?token='.$token;
            $email = Input::get('email');
            $studentGet = $student->findEmail($email);
              
            // if ($studentGet) {

//              $student->updateVkey($token, $studentId);
//
//              $mail =  new PHPMailer(true);
//
//              try {
//                  //SMTP settings
//                  // $mail->SMTPDebug = 3;
//                  $mail->isSMTP();
//                  $mail->Host = "smtp.gmail.com";
//                  $mail->SMTPAuth = true;
//                  $mail->Username = "ucodetut@gmail.com";
//                  $mail->Password =  "warmechine500@##***";
//                  $mail->SMTPSecure = "tls";
//                  $mail->Port = 587; // for tls
//                //   $mail->SMTPDebug = 2;
//                   // $mail->isSMTP();
//                   // $mail->Host = "mail.ucodetuts.com.ng";
//                   // $mail->SMTPAuth = true;
//                   // $mail->Username = "noreply@ucodetuts.com.ng";
//                   // $mail->Password =  "warmechine500@#**@@";
//                   // $mail->SMTPSecure = "ssl";
//                   // $mail->Port = 465; // for tls
//
//                   //email settings
//                   $mail->isHTML(true);
//                   $mail->setFrom("ucodetut@gmail.com",  "Library Offence Doc.");
//                   $mail->addAddress($email);
//                //   $mail->addReplyTo("noreply@ucodetuts.com.ng");
//                   $mail->Subject = "Welcome to Library Offence Doc. Admin";
//                   $mail->Body = "
//                <div style='width:80%; height:auto; padding:10px; margin:10px'>
//
//               <p style='color: #000; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'> Welcome Library Offence Doc. </p>
//            <p  style='color: #000; font-size: 18px; text-transform:capitalize;margin:10px;  '>Hi!&nbsp;&nbsp; $fullname<br>
//                You have successfully registered to Library Offence Documentation System.
//            </p>
//            <p style='color:red;'>Note: You are been monitored so please becareful what you do here!</p>
//
//            <p>
//              Your login details:<br>
//              <span style='color:darkgreen;'>Username:->:  $username</span>
//              <span style='color:orangered;'>Password:->:  Password you created during registration!</span>
//
//            </p>
//            <p>
//              You are  mandated to verify your email address by clicking the link blow: <br>
//              <a href='$url'>$url</a>
//            </p>
//
//             </div>
//
//            ";
//            if($mail->send())
//            echo 'success';
//
//
//              } catch (Exception $e) {
//                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//              }


             //}
              echo 'success';
          } catch (Exception $e) {
            echo $e->getMessage();
                  return false;
          }



  }//end of inputs

  
}//end of if
