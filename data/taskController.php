<?php 

// function checkUserAccess($user_type){
//     if($user_type == "Administrator"){
//         return "Granted";
//     } else {
//         return "Denied";
//     }
// }

function startTask($task_id, $user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $is_selected = 1;
    $new_status = "Working";
    $date_start = date("Y-m-d H:m:s");
    // $query = $dbcon->query("UPDATE tasks SET is_selected = 1,  WHERE id = '".$task_id."'");
    $query = $dbcon->query("UPDATE tasks SET is_selected = 1 ,
    selected_by = '" . $user_id ."', 
    date_start = '" . $date_start ."',
    task_status = '" . $new_status . "'
    WHERE tasks.id = '" . $task_id ."'");
    return $query;
}



function endTask($task_id, $user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $is_selected = 1;
    $new_status = "Done";
    $date_finished = date("Y-m-d H:m:s");
    // $query = $dbcon->query("UPDATE tasks SET is_selected = 1,  WHERE id = '".$task_id."'");
    $query = $dbcon->query("UPDATE tasks SET 
    date_finished = '" . $date_finished ."',
    task_status = '" . $new_status . "'
    WHERE tasks.id = '" . $task_id ."'");
    return $query;
}

function getMySelectedTasks($user_id){

    // check if has timein
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $date = ("Y-m-d");
    if (!attendance_exists($user_id,$date)) {
        $query1 ="SELECT task_description FROM attendances WHERE active = 1 LIMIT 1";
        $result = $dbcon->query($query1);
        $rows = [];
        $tasks = [];
        // $data = mysqli_fetch_array($result);
        $count = 0;
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = json_decode($row['task_description'],1);
            $count++;
        }
        if ($count > 0) {
            return $rows;
        }else{
            return "No Task Selected";
        }
        
    }

    
}

function getTaskIDs($task_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT * FROM tasks
    WHERE active = 1 and id =".$task_id;
    $result = $dbcon->query($query1);
    return mysqli_fetch_array($result);
}

// function getNotSelectedTasks(){
//     $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
//     $query1 ="SELECT * FROM tasks WHERE active = 1";
//     $result = $dbcon->query($query1);
//     $rows = [];
//     while($row = mysqli_fetch_array($result))
//     {
//         $rows[] = $row;
//     }
//     return $rows;
// }

function getAllTasks(){
    // if (checkUserAccess($user_type) == "Granted"){
        $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
        $query1 ="SELECT * FROM tasks WHERE active = 1";
        $result = $dbcon->query($query1);
        $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
    // }else{
    //     return "Access Denied";
    // }
    
}

function addTask($task_details){
    $user_id = $_SESSION['id'];
    $task_name = $task_details['task_name'];
    $active = $task_details['task_status'];
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query = $dbcon->query("INSERT INTO tasks (created_by,task_name,active) 
    VALUES ('$user_id','$task_name','$active')");

    if($query){
        return "Task added successfully";
    }else{
        return "Task add failed";
    }
}

function deleteTask($user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $result = $dbcon->query("UPDATE  tasks SET active = 0 WHERE id='".$user_id."'");  
    if($result){
        return "Task Deleted Successfully";
    }else{
        return "Task Delete Failed";
    }
    
}

// function uploadFile($task_id,$file){
    
//     $target_dir = "uploads/";
//     $fileTmpPath = $file['tmp_name'];
//     $fileName = $file['name'];
//     $fileSize = $file['size'];
//     $fileType = $file['type'];
//     $fileNameCmps = explode(".", $fileName);
//     $fileExtension = strtolower(end($fileNameCmps));
//     $uploadFileDir = './uploads/';
//     $dest_path = $target_dir . $fileName;

//     if (file_exists($dest_path)) {
//         deactivateFile($fileName);
//     }

//     if(move_uploaded_file($fileTmpPath, $dest_path)) 
//     {
//         addFile($fileName,$uploadFileDir);
//         $file_id = searchFileID($fileName);
//         updateTaskFileID($task_id,$file_id);
//         endTask($task_id, $_SESSION['id']);
//         header("location: timeout.php");
//     }
//     else
//     {
//         return "There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.";
//     }
// }

function deactivateFile($filename){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query = $dbcon->query("UPDATE upload_files SET active = 0
    WHERE filename = '" . $filename ."' AND active = 1");
}

function addFile($filename,$path, $new_filename){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query = $dbcon->query("INSERT INTO upload_files (filename,new_filename,path,active) 
    VALUES ('$filename','$new_filename','$path',1)");
    return $query;
}

function searchFileID($filename,$new_filename){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT id FROM upload_files WHERE new_filename = '".$new_filename."' AND filename = '".$filename."'";
    $result = $dbcon->query($query1);
    // $rows = [];
    // while($row = mysqli_fetch_array($result))
    // {
    //     $rows[] = $row;
    // }
    // return $rows;
    return  mysqli_fetch_array($result)['id'];
}

function updateTaskFileID($task_id,$file_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    // $query = $dbcon->query("UPDATE tasks SET is_selected = 1,  WHERE id = '".$task_id."'");
    $query = $dbcon->query("UPDATE tasks SET is_uploaded = 1 ,
    file_id = '" . $file_id ."'
    WHERE tasks.id = '" . $task_id ."'");
}

?>