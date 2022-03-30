<?php
require_once '../core/init.php';

if (!isLoggedInStudent()) {
    Session::flash('denied', 'You need to login to access that page!');
    Redirect::to('login');

}
require_once APPROOT . '/includes/headportal1.php';
require_once APPROOT . '/includes/navportal1.php';

$fileupload = new FileUpload();
$user = new User();
$student = new Student();
$db = Database::getInstance();
$userid = $user->data()->id;
?>
<style>
     .lab{
        font-size: 1.8rem;
    }
     .fa-spinner{
         font-size:3rem;
         color:darkred;
     }
     .fa-check{
         font-size:3rem;
         color:whitesmoke;
     }
     .num{
         font-size: 2rem !important;
         position: relative;
         top: 20%;
         left:45%;
         bottom: 10%;

     }
     .row-data{
       margin:5px;
       padding:5px;
     }
     .row-data span{
       display: block;
     }
     .office span{
       display: block;
     }
     @media print {
    #showForm {
        background-color: white;
        height: 100%;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        margin: 0;
        padding: 15px;
        font-size: 14px;
        line-height: 18px;
    }
}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <h4 class="text-right">
                Welcome  <span class="text-success"><?=ucfirst($user->getFullname());  ?></span>
            </h4><hr>
            <p></p>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="container shadow-lg">
                <h3 class="text-center text-info">Clearance</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6 bg-success p-2" style="height: 200px !important;">
                  <span class="lab text-left">
                  <i class="fa fa-check fa-lg"></i>&nbsp;Cleared:&nbsp;
                 </span><br>
                        <span class="num text-center" id="responseFromDbCleared">

                  </span>
                    </div>
                    <div class="col-md-6 bg-warning p-2" style="height: 200px !important;">
                  <span class="lab text-left">
                  <i class="fa fa-spinner fa-lg"></i>&nbsp;Pending:&nbsp;
                 </span><br>
                        <span class="num text-center" id="responseFromDbPending">

                  </span>
                    </div>
                </div>
            </div>
            <div class="container-fluid shadow-lg p-1 text-center">
              <?php

                  $check = $db->query("SELECT * FROM userRequestClearance WHERE user_id = '$userid'");
               ?>
                <?php if($check->count()):
                      $row = $check->first();
                  ?>
                  <div class="container shadow-lg p-2" id="showForm">
                      <div class="row">
                        <div class="col-md-12">
                          <h2 class="text-center">The Federal Polytechnic Idah <br>Kogi State</h2>
                          <p class="text-center office">
                            <span>Office of the registrar</span>
                            <span>(Academic Affairs division)</span>
                            <span>To be completed in duplicate</span>
                          </p>
                          <p>
                            <div class="row">
                              <div class="col-md-4">
                                  REF:FPI/B/E&R/B1
                              </div>
                              <div class="col-md-4">

                              </div>
                              <div class="col-md-4">
                                DATE <u> &nbsp;<?=pretty_dates($row->dateRequested)?></u>
                              </div>
                            </div>
                          </p>
                          <h3 class="text-bold text-underline text-center">CLEARANCE CERTIFICATE</h3>
                          <p class="text-left p-2">This is to certify that Mr/Mrs/Miss <u class="text-info"><?=$user->data()->full_name?></u> is a student with registration number <u class="text-info"><?=$user->data()->matric_no?></u> department of <u class="text-info"><?=$user->data()->department?></u> Has been cleared of his/her indebtedness to the Federal Polytechnic, Idah</p>
                        </div>
                      </div>
                        <div class="row text-justify row-data">
                          <div class="col-lg-4">
                            <span>Polytechnic Librarian</span>
                            <span>Date <u>
                              <?php if ($row->library_date != ''): ?>
                                <?php
                               pretty_dates($row->library_date)
                                ?>
                              <?php endif; ?>
                            </u>
                           </span>
                            <span class="text-info">
                            <?php if ($row->library != ''):
                                echo '<img src="../ocs_Admin/profile/'.$row->library.'" width="100">';
                              ?>
                              <?php else: ?>
                                Not Signed yet
                            <?php endif; ?>
                          </span>
                          </div>
                          <div class="col-lg-4"></div>
                          <div class="col-lg-4">
                            <span>Head, Sport Office</span>
                            <span>Date <u>
                              <?php if ($row->sport_date != ''): ?>
                                <?php
                               pretty_dates($row->sport_date)
                                ?>
                              <?php endif; ?>
                            </u>
                           </span>
                            <span class="text-info">
                            <?php if ($row->sport != ''):
                                echo $row->sport;
                              ?>
                              <?php else: ?>
                                Not Signed yet
                            <?php endif; ?>
                          </span>
                          </div>
                        </div>
                        <div class="row text-justify row-data">
                          <div class="col-lg-4">
                            <span>Head, Student Affairs</span>
                            <span>Date <u>
                              <?php if ($row->student_affairs_date != ''): ?>
                                <?php
                               pretty_dates($row->student_affairs_date)
                                ?>
                              <?php endif; ?>
                            </u>
                           </span>
                            <span class="text-info">
                            <?php if ($row->student_affairs != ''):

                                echo '<img src="../ocs_Admin/profile/'.$row->student_affairs.'" width="100">';
                              ?>
                              <?php else: ?>
                                Not Signed yet
                            <?php endif; ?>
                          </span>
                          </div>
                          <div class="col-lg-4"></div>
                          <div class="col-lg-4">
                            <span>Head, Central Store</span>
                            <span>Date <u>
                              <?php if ($row->store_date != ''): ?>
                                <?php
                               pretty_dates($row->store_date)
                                ?>
                              <?php endif; ?>
                            </u>
                           </span>
                            <span class="text-info">
                            <?php if ($row->store != ''):
                                echo $row->store;
                              ?>
                              <?php else: ?>
                                Not Signed yet
                            <?php endif; ?>
                          </span>
                          </div>
                        </div>
                        <div class="row text-justify row-data">
                          <div class="col-lg-4">
                            <span>Head, Student Account</span>
                            <span>Date <u>
                              <?php if ($row->student_account_date != ''): ?>
                                <?php
                               pretty_dates($row->student_account_date)
                                ?>
                              <?php endif; ?>
                            </u>
                           </span>
                            <span class="text-info">
                            <?php if ($row->student_account != ''):
                                echo $row->student_account;
                              ?>
                              <?php else: ?>
                                Not Signed yet
                            <?php endif; ?>
                          </span>
                          </div>
                          <div class="col-lg-4"></div>
                          <div class="col-lg-4">
                            <span>HOD, Student Concerned</span>
                            <span>Date <u>
                              <?php if ($row->HOD_date != ''): ?>
                                <?php
                               pretty_dates($row->HOD_date)
                                ?>
                              <?php endif; ?>
                            </u>
                           </span>
                            <span class="text-info">
                            <?php if ($row->HOD != ''):
                                echo '<img src="../ocs_Admin/profile/'.$row->HOD.'"width="100">';
                              ?>
                              <?php else: ?>
                                Not Signed yet
                            <?php endif; ?>
                          </span>
                          </div>
                        </div>
                        <div class="row text-justify row-data">
                          <div class="col-lg-4"></div>
                          <div class="col-lg-4"></div>
                          <div class="col-lg-4">
                            <span>Director,EDC</span>
                            <span>Date <u>
                              <?php if ($row->edc_date != ''): ?>
                                <?php
                               pretty_dates($row->edc_date)
                                ?>
                              <?php endif; ?>
                            </u>
                           </span>
                            <span class="text-info">
                            <?php if ($row->edc != ''):
                                echo $row->edc;
                              ?>
                              <?php else: ?>
                                Not Signed yet
                            <?php endif; ?>
                          </span>
                          </div>
                        </div>
                        <div class="row text-justify row-data">
                          <div class="col-lg-4"></div>
                          <div class="col-lg-4">
                            <span class="text-center text-info"><u>
                              <?php if ($row->head_academic_affairs_date != ''):
                                  echo $row->head_academic_affairs_date;
                                ?>
                                <?php else: ?>
                                  Not Signed yet
                              <?php endif; ?></u></span>
                            <span class="text-center">
                              Head, Academic Affairs
                            </span>
                          </div>
                          <div class="col-lg-4"></div>
                        </div>
                        <div class="row text-justify row-data">
                          <div class="col-lg-4">
                            <span class="text-left text-info"><u>
                              <?php if ($row->head_academic_affairs_date != ''):
                                  echo $row->head_academic_affairs_date;
                                ?>
                                <?php else: ?>
                                  Not Signed yet
                              <?php endif; ?></u></span>
                            <span class="text-left">
                              Bursar,
                            </span>
                          </div>
                          <div class="col-lg-4"></div>
                          <div class="col-lg-4"></div>
                        </div>
                        <div class="row text-justify">
                          <div class="col-lg-8">
                            <span class="text-left p-2">In view of this Mr/Mrs/Miss <u class="text-info"><?=$user->data()->full_name?></u> Can now get his/her entitlement(s)</span>
                          </div>
                          <div class="col-lg-4"></div>
                          <hr class="invisible">
                        </div>

                        <div class="row text-justify row-data mt-5">
                          <div class="col-lg-4"></div>
                          <div class="col-lg-4">
                            <span class="text-center text-info"><u><?php if ($row->head_academic_affairs_date != ''):
                                echo $row->head_academic_affairs_date;
                              ?>
                              <?php else: ?>
                                Not Signed yet
                            <?php endif; ?></u></span>
                            <span class="text-center">
                            Registrar
                            </span>
                            <span class="text-center">
                            Date <u></u>
                            </span>

                          </div>
                          <div class="col-lg-4">


                          </div>
                        </div>

                  </div>
                  <button class="btn btn-secondary" id="print" onclick="PrintElem('showForm');" ><i class="fa fa-print"></i>Print</button>
                  <?php if ($row->approved == '1'): ?>
                      <button class="btn btn-secondary" id="print" onclick="PrintElem('showForm');" ><i class="fa fa-print"></i>Print</button>
                  <?php endif; ?>


                  <?php else: ?>
                    <button type="button" class="btn btn-info btn-lg makeRequest" id="makeRequest">Make Request For Clearance</button>
                    <p id="showError"></p>
                <?php endif?>

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
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=auto,width=1000');

    mywindow.document.write('<html><head><title></title>');
    mywindow.document.write('<link rel="stylesheet" href="print.css" type="text/css" />');
    mywindow.document.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" type="text/css" />');
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/
    mywindow.print();
    // mywindow.close();
    return true;
}

function printContent(el){
  var restorepage = $('body').html();
  var printcontent = $('#' + el).clone();
  $('body').empty().html(printcontent);
  window.print();
  $('body').html(restorepage);
}


setInterval(function(){
  location.reload();
  return false;
},5000)
    function readURL(input){
        if (input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
                $('#filePreview').html('<img src="'+e.target.result+'" alt="file" class="img-fluid img-thumbnail" width="408">');

            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    $('#docfile').change(function(){
        readURL(this);
    })
    $(document).ready(function(){

    $('#fileType').change(function (e){
        var type = $('#fileType').val();

    });

    $('#docForm').submit(function (e){
        var type = $('#fileType').val();
        e.preventDefault();
        $.ajax({
            url:'scripts/upload-process.php',
            method:'post',
            processData: false,
            contentType:false,
            data: new FormData(this),
            success:function (response){
                if (response==='success'){
                    $('#showError').html('<span class="text-success">You have uploaded->:'+ type +'</span><hr>');
                    fetchHistory();
                    setTimeout(function (){
                        location.reload();
                    },2000);
                }else{
                    $('#showError').html(response);
                }
            }
        })
    })

    $('body').on('click', '.makeRequest', function(e){
      e.preventDefault();
        $.ajax({
          url:'scripts/process.php',
          method:'post',
          data:{action:"makerequest"},
          success:function(response){
            $('#showError').html(response);
            setTimeout(function(){
              location.reload();
            },3000);
          }
        })
    });


    setInterval(function (){
        fetchRequestStatusCleared();
        fetchRequestStatusPending();

    },1000);
    fetchRequestStatusCleared();
    function fetchRequestStatusCleared(){
        action = 'fetchRequestStatuscleared';
        $.ajax({
            url:'scripts/process.php',
            method:'post',
            data:{action:action},
            success:function(response)
            {
                $('#responseFromDbCleared').html(response);
            }
        })
    }
    fetchRequestStatusPending();
    function fetchRequestStatusPending(){
        action = 'fetchRequestStatuspending';
        $.ajax({
            url:'scripts/process.php',
            method:'post',
            data:{action:action},
            success:function(response)
            {
                console.log(response);
                $('#responseFromDbPending').html(response);
            }
        })
    }

    });

</script>
