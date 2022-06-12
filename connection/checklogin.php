<?php

$nav_attendance_links = [
    ["title"=>"Dashboard","icon_class"=>"pli-check fs-5 me-2","link"=>"dashboard.php"], 
    ["title"=>"Time In","icon_class"=>"pli-time-backup fs-5 me-2","link"=>"timein.php"],
    ["title"=>"Time Out","icon_class"=>"pli-overtime fs-5 me-2","link"=>"timeout.php"],
    // ["title"=>"Summary of Reports","icon_class"=>"demo-pli-calendar-4 fs-5 me-2","link"=>"sor.php"],
];

if ($_SESSION['user_type'] == "Administrator") {
    $nav_attendance_links[] = ["title"=>"Summary of Reports","icon_class"=>"demo-pli-calendar-4 fs-5 me-2","link"=>"reports.php"];

} elseif ($_SESSION['user_type'] == "Faculty") {
    $nav_attendance_links[] = ["title"=>"Log Entries","icon_class"=>"demo-pli-calendar-4 fs-5 me-2","link"=>"reports.php"];
}

$nav_manage_users_links = [
    ["title"=>"User List","icon_class"=>"pli-professor fs-5 me-2","link"=>"userlist.php"],
    ["title"=>"Add User","icon_class"=>"demo-pli-add-user fs-5 me-2","link"=>"adduser.php"], 
    ["title"=>"Edit User","icon_class"=>"pli-checked-user fs-5 me-2","link"=>"edituser.php"],
    ["title"=>"Delete User","icon_class"=>"pli-remove-user fs-5 me-2","link"=>"deleteuser.php"],
];

$nav_manage_task_links = [
    ["title"=>"Task List","icon_class"=>"pli-file-clipboard-text-image fs-5 me-2","link"=>"tasklist.php"], 
    ["title"=>"Add Task","icon_class"=>"pli-file-add fs-5 me-2","link"=>"addtask.php"],
    ["title"=>"Delete Task","icon_class"=>"pli-file-remove fs-5 me-2","link"=>"deletetask.php"],
];

if(!isset($_SESSION['id'])){
    echo '<script type="text/javascript">window.location="login.php"; </script>';
}
?>