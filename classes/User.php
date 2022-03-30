<?php
/**
 * user class
 */
class User
{
  private  $_db,
           $_studentData,
           $_sessionName,
           $_cookieName,
           $_isLoggedIn;

public function __construct($user = null)
  {
    $this->_db = Database::getInstance();
    $this->_sessionName = Config::get('session/session_student');
    $this->_cookieName = Config::get('cookie/cookie_name');

    if (!$user) {
      if (Session::exists($this->_sessionName)) {
        $user = Session::get($this->_sessionName);

        if ($this->findUser($user)) {
          $this->_isLoggedIn = true;
        }else{
          //process logout
        }
      }
    }else{
     return  $this->findUser($user);
    }

  }

public function create($fields =  array())
{
    if (!$this->_db->insert('students', $fields)) {
      throw new Exception("Error Processing Request create account", 1);

    }
}
//find user details for login
public function findUser($user = null)
    {
      if ($user) {
       $field = (is_numeric($user)) ? 'id' : 'matric_no';
       $data = $this->_db->get('students', array($field, '=', $user));
       if ($data->count()) {
         $this->_studentData = $data->first();
         return true;
       }
      }
      return false;
    }

//login
public function login($matric_no = null, $password = null)
{
  $user = $this->findUser($matric_no);
  if ($user) {
    if (password_verify($password, $this->data()->password)) {


   //      $rndno=rand(100000, 999999);//OTP generate
   //      $token = "OTP NUMBER: "."<h2>".$rndno."</h2>";

   //  $mail =  new PHPMailer(true);

    // try{

   //             // //SMTP settings
   //             // $mail->isSMTP();
   //             // $mail->Host = "mail.ucodetuts.com.ng";
   //             // $mail->SMTPAuth = true;
   //             // $mail->Username = "noreply@ucodetuts.com.ng";
   //             // $mail->Password =  "warmechine500@#**@@";
   //             // $mail->SMTPSecure = "ssl";
   //             // $mail->Port = 465; //587 for tls
    //      $mail->isSMTP();
   //            $mail->Host = "smtp.gmail.com";
   //            $mail->SMTPAuth = true;
   //            $mail->Username = "ucodetut@gmail.com";
   //            $mail->Password =  "warmechine500@##***";
   //            $mail->SMTPSecure = "tls";
   //            $mail->Port = 587; // for tls

   //             //email settings
   //             $mail->isHTML(true);
   //             $mail->setFrom("ucodetut@gmail.com", "Library Offence Doc.");
   //             $mail->addAddress($this->data()->email);
   //             // $mail->addReplyTo("ucodetut@gmail.com", "Library Offence Doc.");
   //             $mail->Subject = 'Device Verification';
   //             $mail->Body = "
   //          <div style='width:80%; height:auto; padding:10px; margin:10px'>

   //      <p style='color: #fff; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'>One Time Password Verification<br></p>
   //      <p>Hey $fullname! <br><br>

   //      A sign in attempt requires further verification because we did not recognize your device. To complete the sign in, enter the verification code on the unrecognized device.

   //     <br><hr>
   //      $token <br><hr>

   //      If you did not attempt to sign in to your account, your password may be compromised. Visit https://localhost/libraryoffencedoc/studentPortal/forgot to create a new, strong password for your Library Offence Doc account.</p>
   //              <hr>

   //     </div>
   //      ";
   //      if($mail->send())
   //       $email =  $this->data()->email;
   //       $sql = "INSERT INTO otp_table (email, token) VALUES     ('$email','$rndno')";
   //        $this->_db->query($sql);

   //       Session::put($this->_sessionName, $this->data()->id);
             // $id = $this->data()->id;

   //       $sql = "UPDATE students SET lastLogin = NOW() WHERE id = '$id ' ";
   //        $this->_db->query($sql);

   //       return true;

   //      } catch (\Exception $e) {
   //      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   //      }

       Session::put($this->_sessionName, $this->data()->id);
       $id = $this->data()->id;
        $sql = "UPDATE students SET lastLogin = NOW() WHERE id = '$id' ";
        $this->_db->query($sql);
      return true;
    }else{
      echo 'Password Incorrect';
      return false;
    }
  }else{
    echo 'Student not found!';
   return false;
  }

}

//return student data
//get id
public function getId()
{
  return $this->data()->id;
}

//get passport
public function getPassport()
{
  return $this->data()->passport;
}
//get department
public function getDepartment()
{
  return $this->data()->department;
}
//get matric no
public function getMatricno()
{
  return $this->data()->matric_no;
}
//get level
public function getLevel()
{
  return $this->data()->level;
}

//get fullname
public function getFullname()
{
  return $this->data()->full_name;
}
//get email
public function getEmail()
{
  return $this->data()->email;
}
//get gender
public function getGender()
{
  return $this->data()->gender;
}
//get dob
public function getDob()
{
  return $this->data()->dob;
}
//get phone_number
public function getPhoneno()
{
  return $this->data()->phone_number;
}
//get verified
public function getVerified()
{
  return $this->data()->verified;
}


public function data()
{
  return $this->_studentData;
}


public function isLoggedIn(){
  return $this->_isLoggedIn;
}

public function logout()
{
  Session::delete($this->_sessionName);
}

public function createVerification($fields =  array())
{
    if (!$this->_db->insert('otp_table', $fields)) {
      throw new Exception("Error Processing Request email verify", 1);

    }
}
//find email
public function findEmail($email)
{
  $data = $this->_db->get('students', array('email', '=', $email));
  if ($data->count()) {
    $this->_studentData = $data->first();
    return $this->_studentData;
      }else{
    return false;
  }

}
public function insertProfileId($newid){
	$this->_db->insert('userprofile', array(
		'user_id' => $newid,
		'status' => 1
	));
   return true;
}
//find phone number
public function findPhone($phoneNo)
{
  $data = $this->_db->get('students', array('phone_number', '=', $phoneNo));
  if ($data->count()) {
     $this->_studentData = $data->first();
    return true;
  }else{
    return false;
  }

}
public function updateStudent($username, $email)
{
  // $this->_db->update('superusers', 'sudo_email', $email, array(
  //  'sudo_username' => $username
  // ));

  $sql = "UPDATE students SET username = '$username' WHERE email = '$email' ";
  $this->_db->query($sql);
  return true;
}
//find matric no
public function findMatricNo($matricNo)
{
  $data = $this->_db->get('students', array('matric_no', '=', $matricNo));
  if ($data->count()) {
     $this->_studentData = $data->first();
    return true;
  }else{
    return false;
  }

}


// find username
public function findUsername($username){
  $data = $this->_db->get('users', array('user_username', '=', $username));
  if ($data->count()) {
   $this->_studentData = $data->first();
    return true;
  }else{
    return false;
  }

}

public function updateProfile($profile, $userid)
    {
      $up = $this->_db->update('users','id', $userid, array(
        'profile_pic' => $profile
    ));
      if ($up) {
        return true;
      }else{
        return false;
      }
    }
//password reset
   // delete token
public function deleteToken($email, $field = array())
    {
      $this->_db->delete('pwdReset', array('email', '=', $email));
    }









public function updateRecoreds($user_id, $field = array())
{
	if(!$this->_db->update('students', 'id', $user_id, $field)){

    throw new Exception("Error Processing Request", 1);

    return false;
  }
}


public function update_status($uid){
	$this->_db->update('userprofile', 'user_id', $uid, array(
    	'status' => 0,
    ));

    return true;
}

public function updateStudentRecored($student_id, $field, $value)
{
	$this->_db->update('students', 'id', $student_id, array(
    	$field => $value

    ));

    return true;
}

public function change_password($hashNewPass, $id)
{
	$this->_db->update('users', 'id', $id, array(
    	'password' => $hashNewPass,

    ));

    return true;


}


public function deleteVkey($id){
	if($this->_db->delete('verifyEmail', array('user_id', '=', $id))){
		  return true;

		}else{
			return false;
		}
}

public function updateVkey($token, $id){
	$this->_db->insert('verifyEmail', array(
		'token' => $token,
		'user_id' => $id
	));
	return true;

}

public function updateProfileDelete($uid){
	$this->_db->update('userprofile', 'user_id', $uid, array(
		'status' => 1
	));
  return true;
}
public function getGreenCard($id)
{
  $student = $this->_db->get('greenCards', array('user_id', '=', $id));
  if ($student->count()) {
    return  $student->first();
  }else{
    return false;
  }
}



public function selectToken($token, $userid){

  $sql = "SELECT * FROM verifyEmail WHERE token = '$token' AND user_id = '$userid'";
 $this->_db->query($sql);
 if ($this->_db->count()) {
 	return $this->_db->first();
 }else{
 	return false;
 }
}

public function verify_email($usid){
	$this->_db->update('students', 'id', $usid, array(
		'verified' => 1
	));
  return true;
}

public function selectSelector($selector){

  $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = '$selector' AND pwdResetExpires > NOW()";
  $this->_db->query($sql);
 if ($this->_db->count()) {
   return $this->_db->first();
 }else{
  return false;
 }
}

// public function selectUser($email){
//   $sql = "SELECT * FROM users WHERE email = ? AND deleted = 0";
//   $stmt = $this->_pdo->prepare($sql);
//   $stmt->execute([$email]);
//   $user = $stmt->fetch(PDO::FETCH_OBJ);
// return $user;
// }


public function updateUser($password,$email){
  $this->_db->update('users', 'email', $email, array(
    'password' => $password
  ));
  return true;
}

public function updateHits()
{
  $id = 0;
  $hits = $hits+1;
  $this->_db->update('visitors', 'id', $id, array(
    'hits' => $hits
  ));
  return true;

}


public function subNews($email){
  $this->_db->insert('update_subscribers', array(
    'user_email' => $email
  ));
  return true;
}


public function getUser($cu)
{
  $this->_db->get('users', array('id', '=', $cu));
  if ($this->_db->count()) {
    return $this->_db->first();
  }else{
    return false;
  }
}

public function activity($id){
    $sql = "UPDATE users SET lastLogin = NOW() WHERE id = '$id'";
    $this->_db->query($sql);
    return true;
}





//end of class
}
