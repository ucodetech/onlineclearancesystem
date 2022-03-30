<?php
require_once '../core/init.php';
require_once APPROOT . '/includes/headportal1.php';
require_once APPROOT . '/includes/navportal1.php';

$db = Database::getInstance();
    if (isset($_GET['p']) && !empty($_GET['p']))
        $owner = (int)$_GET['p'];
        if ($db->get('finalAdminClearanceCert', array('user_id', '=', $owner)))
            if ($db->count())
                $userrow = $db->first();
                $user = new User($userrow->user_id);

                $db->get('superusers', array('sudo_permission', '=', 'ClearanceOfficerAdmin'));
                if ($db->count())
                    $adminrow = $db->first();
                    $adminName = $adminrow->sudo_full_name;

?>
<style>
    .certHolder{
        margin: 10px auto;
        border: 5px double #1d455b;
        height: 700px;
        width:90%;
    }
    .lineme{
        border-bottom: 3px dotted #000;
    }
    .linemee{
        border-bottom: 3px solid #000;
    }
    .pme{
        line-height: 2rem;
    }
    .fa-check{
        animation: spin 2s linear infinite;
        font-size: 1.0rem;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(0deg); }
    }
    .signed{
        margin: 10px auto;
        width:80%;
    }

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <h2 class="display-4 text-center">
                <?= $title;?>
            </h2>
            <hr>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="container">
                <h3 class="text-lg text-center">Mr/Mrs/Miss &nbsp;<u class="text-success"><?=strtoupper($user->getFullname());?></u></h3>
                <hr>

                <div class="content shadow-lg certHolder p-3">
                    <p class="text-center">
                        THE FEDERAL POLYTECHNIC, IDAH <br>
                        ACADEMIC AFFAIRS REGISTRY<br>
                        ADMISSION OFFICE
                    </p>
                    <hr class="invisible">
                    <p class="text-center"> FINAL DOCUMENTATION CLEARANCE CERTIFICATE FOR NEW STUDENTS (HND/ND)
                    </p>
                    <p class="pme">
                        Head, Department of:&nbsp;<span class="lineme"><?=$user->data()->department;?></span> Date:&nbsp;<span class="lineme"><?=pretty_dates($userrow->dateApproved);?></span>br
                        This is to certify that Mr/Mrs/Miss:&nbsp;<span class="lineme"><?=strtoupper($user->data()->full_name);?></span><br>
                        has had his/her certificate scrutinized and is hereby cleared full/provisionally cleared for registration.
                        Registration Number:&nbsp;<span class="lineme"><?=strtoupper($user->data()->matric_no);?></span><br>

                    </p>
               <div class="pme">
                        REQUIREMENTS FOR FINAL DOCUMENTATION <br>
                        <?php
                        if ($user->data()->permission == 'student_hnd') {
                            $requirements = array(
                                'School Form (Original)',
                                'Admission/Acceptance Letter',
                                'Undertaken Form(Original)',
                                'Jamb Admission Letter (Original)',
                                'O\'Level Result(Original Certificate, Statement, Master List or any relevant printout)',
                                'Medical Fitness Certificate',
                                'Receipt of School Fees',
                                'Course Form',
                                'Birth Certificate',
                                'SUG',
                                'Departmental Clearance',
                                'IT Letter/Transcript (Original: HND Only)'
                            );
                        }elseif($user->data()->permission == 'student_nd') {
                            $requirements = array(
                                'School Form (Original)',
                                'Admission/Acceptance Letter',
                                'Undertaken Form(Original)',
                                'Jamb Result (Original)',
                                'O\'Level Result(Original Certificate, Statement, Master List or any relevant printout)',
                                'Medical Fitness Certificate',
                                'Receipt of School Fees',
                                'Course Form',
                                'Birth Certificate',
                                'SUG',
                                'Departmental Clearance'

                            );
                        }
                        ?>

                        <?php foreach ($requirements as $required): ?>

                        <label>(<i class="fa fa-check fa-lg"></i>)<?=$required?></label>

                        <?php endforeach; ?>

               </div>

                    <div class="container signed">
                        <div class="show shadow-sm float-left mt-3" style="line-height:normal">
                            <span class="linemee">
                                <?=$user->data()->full_name;?>
                            </span><br>
                            Name and Signature of Student <br>
                            Date:<span class="lineme"><?=pretty_dates($userrow->dateApproved);?></span>
                        </div>
                        <div class="show shadow-sm float-right mt-3" style="line-height:normal">
                            <span class="linemee">
                                <?=$adminName;?>
                            </span><br>
                            Name and Signature of <br>Clearance Officer <br>
                            Date:<span class="lineme"><?=pretty_dates($userrow->dateApproved);?></span>
                        </div>

                    </div>
                </div>

            </div>

        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



</div>

<?php
require_once APPROOT . '/includes/footerportal1.php';

?>

<script>
    $(document).ready(function(){

    })
</script>
