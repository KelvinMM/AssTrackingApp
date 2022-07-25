<?php

require ('model/database.php');
require ('model/assign_db.php');
require ('model/course_db.php');

$assigment_ID = filter_input(INPUT_POST,'assignment_id',FILTER_VALIDATE_INT);
$description = filter_input(INPUT_POST,'description',FILTER_DEFAULT);
$course_name = filter_input(INPUT_POST,'course_name',FILTER_DEFAULT);

$Course_ID = filter_input(INPUT_POST,'course_id',FILTER_VALIDATE_INT);
if ($Course_ID) {
    $Course_ID = filter_input(INPUT_GET,'course_id',FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST,'action',FILTER_DEFAULT);
if(!$action){
    $action = filter_input(INPUT_GET,'action',FILTER_DEFAULT);
    if(!$action) {
        $action = 'list_assignments';
    }

}

switch ($action) {
    case "list_courses":
        $courses = get_courses();
        include('view/course_list.php');
        break;
    case "add_course":
        add_course($course_name);
        header("Location: .?action=list_courses");
        break;
    case "add_assignment":
        if ($Course_ID & $description) {
            add_assignment($Course_ID,$description);
            header ("Location: .?course_id=$Course_ID");            
        } else {
            $error = "Invalid data. Confirm details.";
            include ('view/error.php');
            exit();
        }break;
    case "delete_course":
        if ($Course_ID) {
            try {
                delete_course($Course_ID);
            } catch (PDOException $e) {
                $error = "Unable to delete.";
                include ('view/error.php');
                exit();
            }
            header ("Location: .?action=list_courses");
        }
        break;
    case "delete_assignment":
        if ($assigment_ID) {
            delete_assignment($assigment_ID);
            header ("Location: .?course_id=$Course_ID");
        }else{
            $error = "Misisng or incorrect details.";
            include("view/error.php");
        }

    default:
    $course_name = get_courses_name($Course_ID);
    $courses = get_courses();
    $assignments = get_assignments_by_course($Course_ID);
    include ('view/assignment_list.php');

}