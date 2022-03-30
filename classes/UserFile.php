<?php


class UserFile
{
    private $_db,
            $_user;


    public function __construct(){
        $this->_db = Database::getInstance();
        $this->_user = new User();
    }

    public function getMyfiles($userid){
        $data = $this->_db->get('userRequestsDepartmentFinal', array('user_id', '=', $userid));
        if ($data->count()){
            return $data->first();

        }else{
            return '<span class="text-center text-lg lg">You have not upload any file yet!</span>';
        }
    }



}//end of class
