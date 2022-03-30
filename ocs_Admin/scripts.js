
$('document').ready(function(){


  $('#hideBtn').click(function(e){
    e.preventDefault();
    $('#approveForm').toggle();
  })


//fetech active admins
fetch_admin_login();

setInterval(function(){
   fetch_admin_login();
}, 3000);

function fetch_admin_login()
{
    var action = 'fetch_super';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#activeAdmin').html(data);

       },
       error:function(){alert("something went wrong fetch admin")}

    });
}


//FEcth active users
    fetch_user_login();

    setInterval(function(){
       fetch_user_login();
    }, 3000);

    function fetch_user_login()
    {
        var action = 'fetch_data';
        $.ajax({
           url:"script/initate.php",
           method:"POST",
           data:{action:action},
           success:function(data)
           {
             $('#activeUsers').html(data);

           },
           error:function(){alert("something went wrong fetch user login")}

        });
    }
//Fetch total users

fetch_totUsers();

setInterval(function(){
   fetch_totUsers();
}, 5000);

function fetch_totUsers()
{
    var action = 'totUsers';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totUsers').html(data);

       }
    });
}

//Fetch total verified email

fetch_totVdemail();

setInterval(function(){
   fetch_totVdemail();
}, 5000);

function fetch_totVdemail()
{
    var action = 'totVdemail';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totVemails').html(data);

       }


    });
}


//Fetch total verified email

fetch_totnVemail();

setInterval(function(){
   fetch_totnVemail();
}, 5000);
function fetch_totnVemail()
{
    var action = 'totVemail';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totVdemails').html(data);

       },
       error:function(){alert("something went wrong tot v email 2")}

    });
}

//Fetch total verified email

fetch_totnAvemail();

setInterval(function(){
   fetch_totnAvemail();
}, 5000);

function fetch_totnAvemail()
{
    var action = 'totAemail';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totAemails').html(data);

       }


    });
}

//Fetch total verified email

fetch_totnAUvemail();

setInterval(function(){
   fetch_totnAUvemail();
}, 5000);

function fetch_totnAUvemail()
{
    var action = 'totAUemail';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totAUemails').html(data);

       }


    });
}


//Fetch Password reset

fetch_totPwdReset();

setInterval(function(){
   fetch_totPwdReset();
}, 5000);

function fetch_totPwdReset()
{
    var action = 'totPwdReset';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totpwD').html(data);

       }

    });
}



//Fetch total feed back

fetch_totFeed();

setInterval(function(){
   fetch_totFeed();
}, 5000);

function fetch_totFeed()
{
    var action = 'totfeed';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totFeedback').html(data);

       }

    });
}
//Fetch total notifactions

fetch_totNote();

setInterval(function(){
   fetch_totNote();
}, 5000);

function fetch_totNote()
{
    var action = 'totNotification';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totNotification').html(data);

       }

    });
}

//Fetch total Admin

fetch_totMonitor();

setInterval(function(){
   fetch_totMonitor();
}, 5000);

function fetch_totMonitor()
{
    var action = 'totHead';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totMonitor').html(data);

       }

    });
}

//Fetch Password reset

fetch_totBooks();

setInterval(function(){
   fetch_totBooks();
}, 5000);

function fetch_totBooks()
{
    var action = 'totBook';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totBooks').html(data);

       }

    });
}

//Fetch Password reset

fetch_totOffender();

setInterval(function(){
   fetch_totOffender();
}, 5000);

function fetch_totOffender()
{
    var action = 'totOffender';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totOffenders').html(data);

       }

    });
}

//Fetch Password reset

fetch_totClearanceRequest();

setInterval(function(){
   fetch_totClearanceRequest();
}, 1000);

function fetch_totClearanceRequest()
{
    var action = 'totRequests';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totRequest').html(data);

       }

    });
}

fetch_totClearanced();

setInterval(function(){
   fetch_totClearanced();
}, 1000);

function fetch_totClearanced()
{
    var action = 'totCleared';
    $.ajax({
       url:"script/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totCleared').html(data);

       }

    });
}
setInterval(function(){
  notifyMeRequest();
},1000);
setInterval(function(){
  notifyMeApproved();

},1000);
setInterval(function(){
  notifyMePending();
},1000);
setInterval(function(){
  notifyMeRejected();
},1000);

notifyMeRequest();

function notifyMeRequest(){
   action = 'fetchRequest';
   $.ajax({
     url:'script/request-process.php',
     method:'post',
     data:{action:action},
     success:function(response){
       $('#request').html(response);
     }
   })
}

notifyMeApproved();
function notifyMeApproved(){
   action = 'fetchApproved';
   $.ajax({
     url:'script/request-process.php',
     method:'post',
     data:{action:action},
     success:function(response){
       $('#approved').html(response);
     }
   })
}

notifyMePending();
function notifyMePending(){
   action = 'fetchPending';
   $.ajax({
     url:'script/request-process.php',
     method:'post',
     data:{action:action},
     success:function(response){
       $('#pending').html(response);
     }
   })
}

notifyMeRejected();
function notifyMeRejected(){
   action = 'fetchRejected';
   $.ajax({
     url:'script/request-process.php',
     method:'post',
     data:{action:action},
     success:function(response){
       $('#rejected').html(response);
     }
   })
}

$('#approveBtn').click(function(e){
 e.preventDefault();

 $.ajax({
   url:'script/request-process1.php',
   method:'post',
   data:$('#requestForm').serialize()+'&action=makeRequeset',
   success:function(response){
     if ($.trim(response)==='success') {
       $('#showMessages').html('<div id="" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fas fa-check"></i>&nbsp;<span>Your request have been sent! await approval</span></div>');
       $('#requestForm')[0].reset();
       notifyMeRequest();
       notifyMeApproved();
       notifyMePending();
       notifyMeRejected();

     }else{
        $('#showMessages').html('<div id="" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fas fa-warning"></i>&nbsp;<span>'+response+'</span></div>');
     }
   }
 })

})


});
