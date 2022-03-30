<?php


class Upload
{
    private  $_db,
             $_dbpath,
             $_dbsize;

    public function __construct()
    {
        $this->_db = Database::getInstance();

    }

public function uploadFileMulti($sourcefile, $path, $size, $required = array())
{
    $dbpath = '';
    $show = new Show();
    $filesCount = count($_FILES[$sourcefile]['name']);

    if ($filesCount > 0) {
        for($i=0; $i<$filesCount; $i++){
            $RandomNums = rand(0, 10000);
            $FileNames = str_replace(' ','-',strtolower($_FILES[$sourcefile]['name'][$i]));
            $FileTypes = $_FILES[$sourcefile]['type'][$i]; //"File/png", File/jpeg etc.
            $FileTemps[] = $_FILES[$sourcefile]['tmp_name'][$i];
            $FileSize = $_FILES[$sourcefile]['size'][$i];
            $FileExts = substr($FileNames, strrpos($FileNames, '.'));
            $FileExts = str_replace('.','',$FileExts);
            $valids = $required;
            $FileNames = preg_replace("/\.[^.\s]{3,4}$/", "", $FileNames);
            $NewFileNames = $FileNames.'-'.$RandomNums.'.'.$FileExts;
            $output_dirs[] = $path.$NewFileNames;//Path for file upload
            if (!in_array(strtolower($FileExts), $valids)) {
                echo $show->showMessage('danger', 'Invalid Extension', 'warning');
            }
            if ($FileSize > $size) {
                echo $show->showMessage('danger', 'File too large', 'warning');
            }

            if ($i != 0) {
                $dbpath .= ', ';
            }elseif($i < 2){
                $dbpath .= '';
            }

            $dbpath .= $NewFileNames;
        }

        $this->_dbpath = $dbpath;
        $this->_dbsize = $FileSize;

        for ($i=0; $i<$filesCount; $i++) {
            move_uploaded_file($FileTemps[$i],$output_dirs[$i]);

        }



    }



}

public function uploadFile($source, $path, $size, $table, $field, $required = array())
    {
        $dbpath = '';
        $show = new Show();
        $RandomNums = rand(0, 10000);
        $FileNames = str_replace(' ','-',strtolower($_FILES[$source]['name']));
        $FileType = $_FILES[$source]['type']; //"File/png", File/jpeg etc.
        $FileTemps = $_FILES[$source]['tmp_name'];
        $FileSize = $_FILES[$source]['size'];
        $FileExts = substr($FileNames, strrpos($FileNames, '.'));
        $FileExts = str_replace('.','',$FileExts);
        $valids = $required;
        $FileNames = preg_replace("/\.[^.\s]{3,4}$/", "", $FileNames);
        $NewFileNames = $FileNames.'-'.$RandomNums.'.'.$FileExts;
        $output_dirs = $path.$NewFileNames;//Path for file upload
        if (!in_array(strtolower($FileExts), $valids)) {
            echo $show->showMessage('danger', 'Invalid Extension', 'warning');
        }
        if ($FileSize > $size) {
            echo $show->showMessage('danger', 'File too large', 'warning');
        }

        $dbpath = $NewFileNames;

        $this->_dbpath = $dbpath;
        $this->_dbsize = $FileSize;

       if(move_uploaded_file($FileTemps,$output_dirs))

           $this->_db->insert($table, array(
               $field => $dbpath,
               'fileSize' => $FileSize
           ));

       return true;


    }


public function dbfile()
{

    return $this->_dbpath;

}

public function dbfilesize()
{

    return $this->_dbsize;

}



}//end of class