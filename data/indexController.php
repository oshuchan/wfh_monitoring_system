<?php

function login($username,$password){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $sql = "SELECT users.*,departments.department_name,designations.designation_name FROM users 
    INNER JOIN departments
    ON users.department_id=departments.id
    INNER JOIN designations
    ON users.designation_id=designations.id
    WHERE users.username='".$username."' AND 
    users.password = '".$password."' AND 
    users.active = 1 ";

    $q = $dbcon->query($sql);
    if($q->num_rows==1)
    {
        $res = $q->fetch_assoc();
        $_SESSION['user_type']=$res['user_type'];
        $_SESSION['page']="dashboard.php";
        $_SESSION['username']=$res['username'];
        $_SESSION['email']=$res['email'];
        $_SESSION['firstname']=$res['first_name'];
        $_SESSION['lastname']=$res['last_name'];
        $_SESSION['id']=$res['id'];
        $_SESSION['department_name']=$res['department_name'];
        $_SESSION['designation_name']=$res['designation_name'];
            echo '<script type="text/javascript">window.location="dashboard.php"; </script>';
            // console.log("successful log in");
    } else
    {
        return 'Invalid Username or Password';
        // console.log("Failed log in");
    }
}

function logout(){
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['firstname']);
    unset($_SESSION['lastname']);
    unset($_SESSION['department_name']);
    unset($_SESSION['designation_name']);
    echo '<script type="text/javascript">window.location="login.php"; </script>';

}

function updatePassword($user_id,$old_password,$new_password){
    $query_password = getPassword($user_id);
    if ($query_password == $old_password ) {
        $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
        $query = $dbcon->query("UPDATE users SET password =  '".$new_password."'
        WHERE id = '".$user_id."' AND active = 1"); 
        if($query){
            return "Password Updated Successfully";
        }else {
            return "Password Update Failed";
        }
    }
}

function updateEmail($user_id,$old_email,$new_email){
    $query_email = getEmail($user_id);
    if ($query_email == $old_email ) {
        $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
        $query = $dbcon->query("UPDATE users SET email =  '".$new_email."'
        WHERE id = '".$user_id."' AND active = 1"); 
        if($query){
            return "Email Updated Successfully";
        }else {
            return "Email Update Failed";
        }
    }
}

function getEmail($user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT email FROM users WHERE users.active = 1 AND users.id = $user_id ";
    $result = $dbcon->query($query1);
    return mysqli_fetch_array($result)['email'];
}

function getPassword($user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT password FROM users WHERE users.active = 1 AND users.id = $user_id ";
    $result = $dbcon->query($query1);
    return mysqli_fetch_array($result)['password'];
}

function searchTaskByID($id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT task_name FROM tasks WHERE active = 1 AND id = '" .$id."'";
    $result = $dbcon->query($query1);

    $data['task_id'] = $id; 
    $data['task_name'] = mysqli_fetch_array($result)['task_name'];
    $data['start_time'] = date("H:m:s");
    $data['end_time'] = date("H:m:s");
    $data['status'] = "Pending";
    return $data;

}

function confirmPassword($username,$user_id,$password,$repassword,$command,$task_ids){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    if($password == $repassword)
    {
        $query1 = "SELECT * FROM users 
        WHERE username='".$username."' and 
        password = '".$password."'";
        $q = $dbcon->query($query1);
        if($q->num_rows==1){
            if ($command == "IN") {
                $date = date("Y-m-d");
                if (!attendance_exists($user_id,$date)) {
                    $tasks_description = [];
                    foreach ($task_ids as $task_id) {
                        $tasks_description[$task_id] = searchTaskByID($task_id);
                    }
                    // return $tasks_data;

                    $query2 = timein($user_id,$date,date("H:i:s"),date("H:i:s"),$tasks_description);
                    if($query2){
                        // return $tasks_data;
                        echo '<script type="text/javascript">window.location="timein-submit.php"; </script>';
                    }
                    else{
                        die(mysqli_error());
                    }
                }
                else {
                    return "Time In Already Exist for today!";
                }
                
            } elseif($command == "OUT"){
                $query2 = timeout($user_id,date("Y-m-d"));
                if($query2){
                    echo '<script type="text/javascript">window.location="timeout-submit.php"; </script>';
                    // return "time out success";
                }
                else{
                    die(mysqli_error());
                }
            }
            
        } else{
            return "Invalid Passwords";
        }
    } else{
        return "Confirm password does not match!";
    }
}

// function confirmPasswordTimeOut($username,$user_id,$password,$repassword,$task_ids,$filenames){
//     $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
//     if($password == $repassword){
//         $query1 = "SELECT * FROM users 
//         WHERE username='".$username."' and 
//         password = '".$password."'";
        
//         $q = $dbcon->query($query1);
//             if($q->num_rows==1){
//                 $query2 = timeout($user_id,date("Y-m-d"));
//                 if($query2)
//                 {
//                     echo '<script type="text/javascript">window.location="timeout-submit.php"; </script>';
//                 }     
//             }
//             else{
//                 die(mysqli_error());
//             }
             
//     } else{
//         return "Confirm password does not match!";
//     }
// }

function uploadMyFiles($task_id,$file,$user_id){
    $date_attended = date("Y-m-d");
    // get details of the uploaded file
    $fileTmpPath = $file['tmp_name'];
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileType = $file['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
 
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
 
    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
 

      // directory in which the uploaded file will be moved
      $uploadFileDir = "./uploads/";
      $dest_path = $uploadFileDir . $newFileName;
 
    if(move_uploaded_file($fileTmpPath, $dest_path)) 
    {
        addMyFile($fileName,$uploadFileDir,$newFileName,$user_id);
        $file_id = searchFileID($fileName,$newFileName);
        $status = "Uploaded";
        
        $new_task_desc = getTaskDescription($date_attended,$user_id,$task_id);
        $new_task_desc[$task_id]['has_upload'] = true;
        $new_task_desc[$task_id]['status'] = $status;
        $new_task_desc[$task_id]['upload_id'] = $file_id;

        // return $new_task_desc;
        $r = setNewAttendanceTaskDescription($date_attended,$user_id,json_encode($new_task_desc));
        //set in tasks in task_description
        //         upload_id
        // status to Uploaded

        return $fileName . " was Uploaded Successfully";
    }
    else
    {
        return $fileName . "Uploaded Failed";
    }
}

function setNewAttendanceTaskDescription($date_attended,$user_id,$task_description){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query = $dbcon->query("UPDATE attendances SET task_description =  '".$task_description."'
     WHERE user_id = '".$user_id."' AND active = 1 AND date_attended ='" .$date_attended. "'"); 
     if ($query) {
        return "Attendance Description Updated Successfully";
     }else{
        return "Attendance Description Update Fail";
     }
    
    
}

function getTaskDescription($date_attended,$user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT task_description FROM attendances WHERE date_attended = '".$date_attended."' AND user_id = '".$user_id."'";
    $result = $dbcon->query($query1);
    return  json_decode(mysqli_fetch_array($result)['task_description'],1);
}


function addMyFile($filename,$path, $new_filename,$user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query = $dbcon->query("INSERT INTO upload_files (filename,new_filename,path,uploaded_by,active) 
    VALUES ('$filename','$new_filename','$path','$user_id',1)");
    return $query;
}



function set_page($link){
    $_SESSION['page']=$link;
}


function settings(){
    header("location: settings.php");
}

function lockscreen(){
    header("location: lockscreen.php");
}
?>
