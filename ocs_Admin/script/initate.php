<?php
require_once '../../core/init.php';
$general = new General();
$student = new Student();



if(isset($_POST['action']) && $_POST['action']== "fetch_data"){
    $output = '';

    $row = $student->loggedUsers();

   if ($row) {
     foreach ($row as $active) {

       ?>
       <div class="col-lg-6">

          <img src='../studentPortal/avaters/<?=$active->passport;?>' width='70px' height='70px' style='border-radius:50px;' alt='Passport'>
         <br>
         <?
         echo strtok($active->full_name, ' ') . '- ID-' . $active->id ;
         ?>

       </div>
       <?
     }
   }


}


if(isset($_POST['action']) && $_POST['action'] == "fetch_super"){
    $output = '';

    $supers = $general->loggedAdmin();

   if ($supers) {
     foreach ($supers as $active) {
         $imgsuper = $general->getImgSuper($active->id);
       ?>
       <div class="col-lg-6">
         <?php if ($imgsuper->status == 0) {
           echo "<img src='profile/profile".$imgsuper->sudo_id.".jpg?'".mt_rand()." width='70px' height='70px' style='border-radius:50px;'>";
         }else{
             echo "<img src='profile/default.png' width='70px' height='70px' style='border-radius:50px;' alt='Default Image'>";
         }
         echo  '<br>';
         echo strtok($active->sudo_full_name, ' ') . '- Permissions-' . strtok($active->sudo_permission) ;
         ?>

       </div>
       <?
     }
   }


}


if (isset($_POST['action']) && $_POST['action'] == 'update_admin') {
  $general->updateAdmin();

}


if(isset($_POST['action']) && $_POST['action'] == "totUsers"){
  $tot =  $general->totalCount('students');
   echo $tot;
}

if(isset($_POST['action']) && $_POST['action'] == "totfeed"){
  $tot =  $general->totalCount('feedback');
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totHead"){
  $tot =  $general->totalCount('monitorHead');
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totNotification"){
  $tot =  $general->totalCount('notifications');
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totVemail"){
  $tot =  $student->verified_users(0);
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totVdemail"){
  $tot =  $student->verified_users(1);
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totPwdReset"){
  $tot =  $general->totalCount('pwdReset');
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totAUemail"){
  $tot =  $general->verified_admin(0);
   echo $tot;
}

if(isset($_POST['action']) && $_POST['action'] == "totAemail"){
  $tot =  $general->verified_admin(1);
   echo $tot;
}

if(isset($_POST['action']) && $_POST['action'] == "totRequests"){
  $tot =  $general->totalCount('offenders');
   echo $tot;
}

if(isset($_POST['action']) && $_POST['action'] == "totCleared"){
  $tot =  $general->totalCount('offenders');
   echo $tot;
}

if(isset($_POST['action']) && $_POST['action'] == "totBorroweds"){
  $tot =  $general->totalCount('borrowed_books');
   echo $tot;
}
