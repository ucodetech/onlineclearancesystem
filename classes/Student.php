<?php

 /**
  * Student
  */
 class Student
 {

     private $_db,
         $_user;


     function __construct()
     {
         $this->_db = Database::getInstance();
         $this->_user = new User();

     }


     //Get gender percentage
     public function genderPer()
     {
         $sql = "SELECT gender, COUNT(*) AS number FROM students WHERE gender != '' GROUP BY gender ";
         $data = $this->_db->query($sql);
         if ($data->count()) {
             return $data->results();
         } else {
             return false;
         }
     }

// verified and unverified percenta
    public function verifiedPer()
    {
        $sql = "SELECT verified, COUNT(*) AS number FROM students  GROUP BY verified ";
        $data = $this->_db->query($sql);
        if ($data->count()) {
            return $data->results();
        } else {
            return false;
        }
    }


    public function getImgSuper($superimgid)
    {
        $data = $this->_db->get('super_profile', array('sudo_id', '=', $superimgid));
        if ($this->_db->count()) {
            return $this->_db->first();
        } else {
            return false;
        }
    }


    public function verified_users($status)
    {
        $count = $this->_db->get('students', array('verified', '=', $status));
        if ($count->count()) {
            return $count->count();
        } else {
            return '0';
        }
    }


    public function fetchUserDetail($id)
    {
        $data = $this->_db->get('students', array('id', '=', $id));
        if ($data->count()) {
            return $data->first();
        } else {
            return false;
        }
    }


    public function loggedUsers()
    {
        $sql = "SELECT * FROM students WHERE lastLogin > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
        $data = $this->_db->query($sql);
        if ($data->count()) {
            return $data->results();
        } else {
            return false;
        }
    }


    public function updateStudentRecored($student_id, $field, $value)
    {
        $this->_db->update('students', 'id', $student_id, array(
            $field => $value

        ));

        return true;
    }


    public function fetchStudents()
    {
        $output = '';
        $imgPath = '../studentPortal/avaters/';

        $sql = "SELECT * FROM students WHERE deleted = 0";
        $query = $this->_db->query($sql);
        if ($query->count()) {
            $dat = $query->results();
            if ($dat) {
                $output .= '
    <table class="table table-striped table-hover" id="showStudent">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>Matric Number</th>
          <th>Department</th>
          <th>Joined Date</th>
          <th>Last Login</th>
          <th>Email Verified</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
    ';
                foreach ($dat as $row) {

                    $passport = '<img src="' . $imgPath . $row->passport . '"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

                    if ($row->verified == 0) {
                        $msg = '<span class="text-danger align-self-center lead">No</span>';
                    } else {

                        $msg = '<span class="text-success align-self-center lead">Yes</span>';

                    }
                    $output .= '
          <tr>
            <td>' . $row->id . '</td>
              <td>' . $passport . '</td>
                   <td>' . $row->full_name . '</td>
                     <td>' . $row->matric_no . '</td>
                       <td>' . $row->department . '</td>
                       <td>' . pretty_dates($row->dateJoined) . '</td>
                       <td>' . pretty_dates($row->lastLogin) . '</td>

                         <td>' . $msg . '</td>
                         <td>
                         <a href="detail/student-detail/' . $row->id . '" id="' . $row->id . '" title="View Details" class="text-primary"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;
                         <a href="#" id="' . $row->id . '" title="Trash Student" class="text-danger deleteStudentIcon"><i class="fa fa-recycle fa-lg"></i> </a>&nbsp;

                         </td>
          </tr>
          ';
                }


                $output .= '
      </tbody>
    </table>';
            }
            return $output;

        } else {
            echo '<h3 class="text-center text-secondary align-self-center lead">No Student yet</h3>';
        }

    }

    public function fetchNotifactionCount()
    {
        $sql = "SELECT * FROM students WHERE hod_approval = 0 OR circulation_approval = 0 OR approved = 0 ";
        $this->_db->query($sql);
        if ($this->_db->count()) {
            return $this->_db->count();
        } else {
            return false;
        }
    }

    public function approveAction($field, $val, $user_id)
    {
        $data = $this->_db->get('students', array('id', '=', $user_id));
        if ($data->count()) {
            $dat = $data->first();
            $userid = $dat->id;
            if ($dat->updated == 1) {
                $sql = "UPDATE students SET $field = 1, approved = $val WHERE id = '$user_id'";
                $query = $this->_db->query($sql);
                if ($query) {
                    return true;
                } else {
                    return false;

                }
            } else {
                $show = new Show();
                echo $show->showMessage('danger', 'The student or staff have not updated his/her details completely!', 'warning');
            }
        }

    }

    public function getStudentDetail($student_id)
    {
        $student = $this->_db->get('students', array('id', '=', $student_id));
        if ($student->count()) {
            return $student->first();

        } else {
            return false;
        }
    }

    public function fetchClearanceRequest()
    {
        $imgPath = '../studentPortal/avaters/';
        $request = $this->_db->get('userRequestClearance', array('pending', '=', 1));
        if ($request->count()) {
            $data = $request->results();
            $output = '';
            $output .= '
    <table class="table table-striped table-hover" id="showStudent">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>Matric Number</th>
          <th>Department</th>
          <th>Date Requested</th>
          <th>View Files</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
    ';
            foreach ($data as $row) {
                    $user = new User($row->user_id);
                $passport = '<img src="' .$imgPath.$user->data()->passport . '"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

                $output .= '
          <tr>
            <td>' . $row->id . '</td>
              <td>' . $passport . '</td>
                   <td>' . $user->data()->full_name . '</td>
                     <td>' . $user->data()->matric_no . '</td>
                       <td>' . $user->data()->department . '</td>
                       <td>' .pretty_dates($row->dateRequested). '</td>
                        <td>
                         <a href="files/file-detail/' . $row->id . '" id="' . $row->id . '" title="View File" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right fa-lg"></i> View Files</a>&nbsp;
                         </td>
                         <td>
                         <a href="detail/student-detail/' . $row->id . '" id="' . $row->id . '" title="View Details" class="text-primary"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;';
                        if (hasPermissionSuper()) {
                            $output .= '<a href="#" id="' . $row->id . '" title="Trash Student" class="text-danger deleteStudentIcon"><i class="fa fa-recycle fa-lg"></i> </a>&nbsp;';
                        }
                       $output .='</td>
          </tr>
          ';
            }


            $output .= '
      </tbody>
    </table>';

        return $output;

    }else{
        return '<h3 class="text-center text-secondary align-self-center lead">No Request yet</h3>';
    }

}

public function getUserFiles($table,$requestid){
         $data = $this->_db->get($table, array('id', '=', $requestid));
         if ($data->count()){
             return $data->first();
         }else{
             return false;
         }
}


public function updateRequest($table, $userid){
         $date = date('Y-m-d');
          $this->_db->update($table, 'user_id' , $userid,array(
             'approved' => 1,
             'pending' => 0,
              'dateApproved' => $date
         ));
        return true;
}
    public function updateRequest2($table, $userid){
        $date = date('0000-00-00');
        $this->_db->update($table, 'user_id' , $userid,array(
            'approved' => 0,
            'pending' => 1,
            'dateApproved' => $date
        ));
        return true;
    }


    public function fetchClearanceRequestApproved()
    {
        $imgPath = '../studentPortal/avaters/';
        $request = $this->_db->get('userRequestsAdmin', array('approved', '=', 1));
        if ($request->count()) {
            $data = $request->results();
            $output = '';
            $output .= '
    <table class="table table-striped table-hover" id="showRequestApprovedupdateRequest">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>Matric Number</th>
          <th>Department</th>
          <th>Date Approved</th>
          <th>View Files</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
    ';
            foreach ($data as $row) {
                $user = new User($row->user_id);
                $passport = '<img src="' .$imgPath.$user->data()->passport . '"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

                $output .= '
          <tr>
            <td>' . $row->id . '</td>
              <td>' . $passport . '</td>
                   <td>' . $user->data()->full_name . '</td>
                     <td>' . $user->data()->matric_no . '</td>
                       <td>' . $user->data()->department . '</td>
                       <td>' .pretty_dates($row->dateApproved). '</td>
                        <td>
                         <a href="files/file-detail/' . $row->id . '" id="' . $row->id . '" title="View File" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right fa-lg"></i> View Files</a>&nbsp;
                         </td>
                         <td>
                         <a href="detail/student-detail/' . $row->id . '" id="' . $row->id . '" title="View Details" class="text-primary"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;';
                if (hasPermissionSuper()) {
                    $output .= '<a href="#" id="' . $row->id . '" title="Trash Student" class="text-danger deleteStudentIcon"><i class="fa fa-recycle fa-lg"></i> </a>&nbsp;';
                }
                $output .='</td>
          </tr>
          ';
            }


            $output .= '
      </tbody>
    </table>';

            return $output;

        }else{
            return '<h3 class="text-center text-secondary align-self-center lead">No Approved yet</h3>';
        }

    }

    public function fetchClearanceRequestDpt()
    {
        $imgPath = '../studentPortal/avaters/';
        $request = $this->_db->get('userRequestsDepartmentFinal', array('pending', '=', 1));
        if ($request->count()) {
            $data = $request->results();
            $output = '';
            $output .= '
    <table class="table table-striped table-hover" id="showRequestdp">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>Matric Number</th>
          <th>Department</th>
          <th>Date Requested</th>
          <th>View Files</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
    ';
            foreach ($data as $row) {
                $user = new User($row->user_id);
                $passport = '<img src="' .$imgPath.$user->data()->passport . '"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

                $output .= '
          <tr>
            <td>' . $row->id . '</td>
              <td>' . $passport . '</td>
                   <td>' . $user->data()->full_name . '</td>
                     <td>' . $user->data()->matric_no . '</td>
                       <td>' . $user->data()->department . '</td>
                       <td>' .pretty_dates($row->dateRequested). '</td>
                        <td>
                         <a href="files/fileDpt-detail/' . $row->id . '" id="' . $row->id . '" title="View File" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right fa-lg"></i> View Files</a>&nbsp;
                         </td>
                         <td>
                         <a href="detail/student-detail/' . $row->id . '" id="' . $row->id . '" title="View Details" class="text-primary"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;';
                if (hasPermissionSuper()) {
                    $output .= '<a href="#" id="' . $row->id . '" title="Trash Student" class="text-danger deleteStudentIcon"><i class="fa fa-recycle fa-lg"></i> </a>&nbsp;';
                }
                $output .='</td>
          </tr>
          ';
            }


            $output .= '
      </tbody>
    </table>';

            return $output;

        }else{
            return '<h3 class="text-center text-secondary align-self-center lead">No Request yet</h3>';
        }

    }

    public function fetchClearanceRequestApprovedDpt()
    {
        $imgPath = '../studentPortal/avaters/';
        $request = $this->_db->get('userRequestsDepartmentFinal', array('approved', '=', 1));
        if ($request->count()) {
            $data = $request->results();
            $output = '';
            $output .= '
    <table class="table table-striped table-hover" id="showRequestApprovedupdateDpt">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>Matric Number</th>
          <th>Department</th>
          <th>Date Approved</th>
          <th>View Files</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
    ';
            foreach ($data as $row) {
                $user = new User($row->user_id);
                $passport = '<img src="' .$imgPath.$user->data()->passport . '"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

                $output .= '
          <tr>
            <td>' . $row->id . '</td>
              <td>' . $passport . '</td>
                   <td>' . $user->data()->full_name . '</td>
                     <td>' . $user->data()->matric_no . '</td>
                       <td>' . $user->data()->department . '</td>
                       <td>' .pretty_dates($row->dateApproved). '</td>
                        <td>
                         <a href="files/file-detail/' . $row->id . '" id="' . $row->id . '" title="View File" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right fa-lg"></i> View Files</a>&nbsp;
                         </td>
                         <td>
                         <a href="detail/student-detail/' . $row->id . '" id="' . $row->id . '" title="View Details" class="text-primary"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;';
                if (hasPermissionSuper()) {
                    $output .= '<a href="#" id="' . $row->id . '" title="Trash Student" class="text-danger deleteStudentIcon"><i class="fa fa-recycle fa-lg"></i> </a>&nbsp;';
                }
                $output .='</td>
          </tr>
          ';
            }


            $output .= '
      </tbody>
    </table>';

            return $output;

        }else{
            return '<h3 class="text-center text-secondary align-self-center lead">No Approved yet</h3>';
        }

    }

    public function checkIfapproved($table, $userid){
         $data = $this->_db->get($table, array('user_id', '=', $userid));
         if ($data->count()){
             return $data->first();
         }else{
        return false;
      }
    }


}//end of class
