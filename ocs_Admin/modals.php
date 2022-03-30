

<!-- The Modal login-->
<div class="modal fade" id="viewBook">
  <div class="modal-dialog  modal-dialog-scrollable">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Book Detail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="card">

    <div class="card-body" id="showDetail">

    </div>

  </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<div class="modal fade" id="showUserDetailsModal">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content" id="showStudentDetail">
      <!-- Modal Header -->




    </div>
  </div>
</div>

<!-- The Modal login-->
<div class="modal fade" id="updateDate">
  <div class="modal-dialog  modal-dialog-scrollable">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header ucode-green">
        <h4 class="modal-title">Update Return date</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <div class="modal-body">
          <form class="px-2" action="#" method="post" id="updateReturnDateForm">
            <div class="row">
              <input type="hidden" name="requestid" id="requestid">
              <input type="hidden" name="booktitle" id="booktitle">
              <input type="hidden" name="bookisbn" id="bookisbn">
              <input type="hidden" name="bookauthor" id="bookauthor">
              <input type="hidden" name="userid" id="userid">

            <div class="form-group col-md-6">
              <label for="ToCollect">To collect on: <sup class="text-danger">*</sup> </label>
              <input type="date" name="collectDate" id="ToCollect" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label for="ToReturn">To Return on: <sup class="text-danger">*</sup> </label>
              <input type="date" name="returnDate" id="ToReturn" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label for="ToReturn">Time: <sup class="text-danger">*</sup> </label>
              <input type="time" name="returnTime" id="ToReturnTime" class="form-control">
              <small class="text-info">Set time to 6:00pm</small>
            </div>
            <div class="clear-fix"> </div>
            <div class="form-group col-md-6">
              <button type="submit" name="updateApproveBtn" id="updateApproveBtn" class="btn btn-info">Approve</button>
            </div>
          </div>
          </form>
        </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
