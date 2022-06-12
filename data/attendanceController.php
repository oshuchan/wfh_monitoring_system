<?php

function searchAttendancesByUserID($start_date,$end_date,$user_type,$qquery){
    if ($user_type == "Administrator") {
        $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
        $query1 ="SELECT attendances.*,
        users.department_id as department_id,
        users.id as user_id,
        users.first_name,
        users.last_name,
        users.designation_id as designation_id,
        departments.department_name,
        designations.designation_name
        FROM attendances
        INNER JOIN users
        ON users.id=attendances.user_id
        INNER JOIN departments
        ON department_id=departments.id
        INNER JOIN designations
        ON designation_id=designations.id
        WHERE users.id = '".$qquery."' AND date_attended BETWEEN '".$start_date."' AND '".$end_date."'
        ORDER BY attendances.created_at";

        $result = $dbcon->query($query1);
        $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
    } else {
        return "No Access";
    }
}

function getAttendances($start_date,$end_date, $user_type){
    if ($user_type == "Administrator") {
        $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
        $query1 ="SELECT attendances.*,
        users.department_id as department_id,
        users.first_name,
        users.last_name,
        users.designation_id as designation_id,
        departments.department_name,
        designations.designation_name
        FROM attendances
        INNER JOIN users
        ON users.id=attendances.user_id
        INNER JOIN departments
        ON department_id=departments.id
        INNER JOIN designations
        ON designation_id=designations.id
        WHERE date_attended BETWEEN '".$start_date."' AND '".$end_date."' 
        ORDER BY users.last_name";
    } else {
        $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
        $query1 ="SELECT attendances.*,
        users.department_id as department_id,
        users.first_name,
        users.last_name,
        users.designation_id as designation_id,
        departments.department_name,
        designations.designation_name
        FROM attendances
        INNER JOIN users
        ON users.id=attendances.user_id
        INNER JOIN departments
        ON department_id=departments.id
        INNER JOIN designations
        ON designation_id=designations.id
        WHERE user_id = '".$_SESSION['id']."' AND date_attended BETWEEN '".$start_date."' AND '".$end_date."'";
    }
    
    $result = $dbcon->query($query1);

    $rows = [];
    while($row = mysqli_fetch_array($result))
    {
        $rows[] = $row;
    }
    // $data = json_decode( $result);
    return $rows;
}

function attendance_exists($user_id,$date){
    $exists = 0;
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT * FROM attendances WHERE user_id = '".$user_id."' AND date_attended = '".$date."' AND active = 1";
    $result = $dbcon->query($query1);
    // if ($result->field_count >0){
    //     $exists=0;
    // }
    $rows = [];
    while($row = mysqli_fetch_array($result))
    {
        $rows[] = $row;
    }
    // $data = json_decode( $result);
    if (count($rows)>0) {
        $exists = true;
    }
    return $exists;
}

function timein($user_id,$date,$timein,$timeout,$task_description){
    // attendance_exists($user_id,$date)
    $task_description = json_encode($task_description);
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query = $dbcon->query("INSERT INTO attendances (user_id,date_attended,timeins,timeouts,task_description) 
    VALUES ('$user_id','$date','$timein','$timein','$task_description')");
    return $query;
}



function timeout($user_id, $date){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $timeout = date("H:i:s");
    $query = $dbcon->query("UPDATE attendances SET timeouts = '".$timeout."' , timed_out = 1
    WHERE user_id = '".$user_id."' AND date_attended = '".$date."' AND active = 1");
    return $query;
}

function is_timed_out($date,$user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT timed_out FROM attendances WHERE date_attended = '".$date."' AND user_id = '".$user_id."'";
    $result = $dbcon->query($query1);
    return mysqli_fetch_array($result);
}

function is_timed_in($date,$user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT timed_out FROM attendances WHERE date_attended = '".$date."' AND user_id = '".$user_id."'";
    $result = $dbcon->query($query1);
    return mysqli_fetch_array($result);
}

?>