<?php


  function isLoggedInStudent(){
      $user = new User();
    if ($user->isLoggedIn()) {
        return true;
     }else{
        return false;
     }


      }



  function isOTPset($useremail){
    $sql = "SELECT * FROM verifyAdmin WHERE sudo_email = '$useremail'";
     $check = Database::getInstance()->query($sql);
    if ($check->count()) {
      return true;
    }else{
      return false;
    }
  }

  function isOTPsetStudent($useremail){
    $sql = "SELECT * FROM otp WHERE email = '$useremail'";
     $check = Database::getInstance()->query($sql);
    if ($check->count()) {
      return true;
    }else{
      return false;
    }
  }


  function isLoggedInAdmin(){
     if (isset($_SESSION[Config::get('session/session_admin')])) {
         return true;
         }else{
             return false;
         }

      }


function hasPermissionSuper($permission = 'Superuser'){
    $admin = new Admin();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->sudo_permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }
}


function hasPermissionHOD($permission = 'HOD'){
     $admin = new Admin();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->sudo_permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}

function hasPermissionClearanceOfficerAdmin($permission = 'ClearanceOfficerAdmin'){
     $admin = new Admin();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->sudo_permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}

function hasPermissionClearanceOfficerDpt($permission = 'ClearanceOfficerDpt'){
    $admin = new Admin();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

        $permissioned = $admin->data()->sudo_permission;

        $permissions = explode(',', $permissioned);
        if (in_array($permission, $permissions,true)) {
            return true;
        }
        return false;

    }

}

function hasPermissionStudentND($permission = 'student_nd'){
     $user = new User();
    if (isset($_SESSION[Config::get('session/session_student')])) {

    $permissioned = $user->data()->permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}
function hasPermissionStudentHND($permission = 'student_hnd'){
    $user = new User();
    if (isset($_SESSION[Config::get('session/session_student')])) {

        $permissioned = $user->data()->permission;

        $permissions = explode(',', $permissioned);
        if (in_array($permission, $permissions,true)) {
            return true;
        }
        return false;

    }

}



