<?php
function get_courses() {
    global $db;
    $query = 'SELECT *FROM courses ORDER BY Course_ID';
    $statement = $db->prepare($query);
    $statement->execute();
    $courses = $statement->fetchAll();
    $statement->closeCursor();
    return $courses;
}
function get_courses_name($Course_ID) {
    if(!$Course_ID) {
        return "All Courses";
    }
    global $db;
    $query = 'SELECT *FROM courses WHERE courseID = :course_ID';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_ID', $Course_ID);
    $statement->execute();
    $course = $statement->fetch();
    $statement->closeCursor();
    $course_name = $course['courseName'];
    return $course_name;
}

function delete_course($Course_ID){
    global $db;
    $query = 'DELETE FROM courses WHERE courseID = :course_ID';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id',$Course_ID);
    $statement->execute();
    $statement->closeCursor();
    
}
function add_course($course_name){

    global $db;
    
    $query = 'INSERT INTO courses (courseName) VALUES (:courseName)';

    $statement = $db->prepare($query);
    $statement->bindValue(':courseName',$course_name);
    $statement->execute();
    $statement->closeCursor();
}