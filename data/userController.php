<?php 


function getUserIDs(){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT id,last_name
    FROM users";
    $result = $dbcon->query($query1);
    $rows = [];
    while($row = mysqli_fetch_array($result))
    {
        $rows[] = $row;
    }
    return $rows;
}


function getUsers(){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT users.*,
    departments.department_name,
    designations.designation_name 
    FROM users
    INNER JOIN departments
    ON department_id=departments.id
    INNER JOIN designations
    ON designation_id=designations.id
    ";
    $result = $dbcon->query($query1);
    $rows = [];
    while($row = mysqli_fetch_array($result))
    {
        $rows[] = $row;
    }
    return $rows;
}

function addUser($user_details){
    $first_name = $user_details['firstname'];
    $last_name = $user_details['lastname'];
    $username = $user_details['username'];
    $password = $user_details['password'];
    $repassword = $user_details['repassword'];
    $email = $user_details['email'];
    $secondary_email = $user_details['secondary_email'];
    $department_id = $user_details['department'];
    $designation_id = $user_details['designation'];
    $user_type = $user_details['role'];
    $status = $user_details['status'];
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query = $dbcon->query("INSERT INTO users (first_name,last_name,username,password,email,secondary_email,user_type,active,department_id,designation_id) 
    VALUES ('$first_name','$last_name','$username','$password','$email','$secondary_email','$user_type','$status','$department_id','$designation_id')");
    if($query){
        return "User Added Successfully";
    }else{
        return "Add User Failed";
    }
   
}

function getUserByID($user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $query1 ="SELECT * FROM users WHERE users.id = $user_id ";
    $result = $dbcon->query($query1);
    return mysqli_fetch_array($result);
}

function editUser($edit_details, $user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $first_name = $edit_details['firstname'];
    $last_name = $edit_details['lastname'];
    $username = $edit_details['username'];
    $password = $edit_details['password'];
    $repassword = $edit_details['repassword'];
    $email = $edit_details['email'];
    $secondary_email = $edit_details['secondary_email'];
    $department_id = $edit_details['department_id'];
    $designation_id = $edit_details['designation_id'];
    $user_type = $edit_details['role'];
    $active = $edit_details['status'];
    $user_id = $user_id+0;
    $test = 1;

    $query = $dbcon->query("UPDATE users SET first_name = '".$first_name."',
    last_name = '".$last_name."',
    username =  '".$username."',
    password =  '".$password."',
    email =  '".$email."',
    secondary_email =  '".$secondary_email."',
    user_type = '".$user_type."',
    active = ".$active.",
    department_id = '".$department_id."',
    designation_id =  '".$designation_id."'
    WHERE id = '".$user_id."' AND active = 1"); 
    if($query){
        return "User Editted Successfully";
    }else{
        return "Edit User Failed";
    }
}

function deleteUser($user_id){
    $dbcon = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
    $res = $dbcon->query("UPDATE users set active = 0 WHERE id='".$user_id."'");  
    return $res;
}
?>