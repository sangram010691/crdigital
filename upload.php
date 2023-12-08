<?php

include('dbconfig.php');



require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

   if($fileName){
    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach($data as $row)
        {
           
                $fullname = $row['0'];
                $email = $row['1'];
                $phone = $row['2'];
               
                $sql = "SELECT * FROM students where email='$email'";
                $s_query = mysqli_query($conn, $sql);
                $s_data = mysqli_fetch_object($s_query);
                if(mysqli_num_rows($s_query)>0){
                    $_SESSION['msg'] = "data already Exists";
                    header("location: index.php");
                    
                } else {
                    $studentQuery = "INSERT INTO students (fullname,email,phone) VALUES ('$fullname','$email','$phone')";
                $result = mysqli_query($conn, $studentQuery);
                $_SESSION['msg'] = "success";
                header("location: index.php");
                
                }

                
        }
    }
   } else {
    $_SESSION['msg'] = "please enter correct file";
    header("location: index.php");
   }
?>