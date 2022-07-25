<?php

function get_assignments_by_course($Course_ID){
    global $db;
    if ($Course_ID){
        $query = 'SELECT A.ID,A.Description,C.CourseName FROM assignments A LEFT JOIN
        courses C ON A.CourseID = C.CourseID WHERE A.CourseID = :Course_ID ORDER BY A.ID';
    } else {
        $query = 'SELECT A.ID,A.Description,C.CourseName FROM assignments A LEFT JOIN
        courses C ON A.CourseID = C.courseID ORDER BY C.CourseID';
    }
    $statement = $db->prepare($query);
    $statement->bindValue(':Course_ID', $Course_ID);
    if ($Course_ID)$statement->execute();
    $assignments = $statement->fetchAll();
    $statement->closeCursor();
    return $assignments;
}

function delete_assignment($assigment_ID){
    global $db;
    $query = 'DELETE FROM assignments WHERE ID = :assign_ID';
    $statement = $db->prepare($query);
    $statement->bindValue(':assign_ID', $assigment_ID);
    $statement->execute();
    $assigments = $statement->fetchAll();
    $statement->closeCursor();
}
function add_assignment($Course_ID,$Description  ){
    global $db;
    $query = 'INSERT INTO assignments (Description,course_ID) VALUES (:descr, :course_ID)';
    $statement = $db->prepare($query);
    $statement->bindValue(':descr', $Description);
    $statement->bindValue(':course_ID', $Course_ID);
    $statement->execute();
    $assigments = $statement->fetchAll();
    $statement->closeCursor();
}