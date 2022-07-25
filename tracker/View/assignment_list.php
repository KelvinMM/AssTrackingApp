<?php include ('view/header.php'); ?>

<section id = "list" class="list">
    <header class = "list_row list_header">
        <h1>Assignment</h1>
        <form action="." method = "get" id = "list_header_select" class="list_header-select">
            <input type = "hidden" name="action" value="list_assignments">
            <select name = "Course_ID" required>
                <Option value="0">View All</Option> 
                <?php foreach ($courses as $course) : ?>
                <?php if ($Course_ID == $course['course_ID']){ ?>
                <option value = "<?=$course ['course_ID'] ?>" selected> 
                    <?php } else { ?>
                <option value="<?= $course['course_ID'] ?>" > 
                    <?php } ?>
                    <?= $course['courseName'] ?>
                </option>}
                <?php endforeach; ?>
            </select>
            <button class ="add-button bold">Enter</button>
        </form>
    </header>
    <?php if ($assignments) { ?>
        <?php foreach ($assignments as $assignment) :?>
        <div class="list_row">
            <div class="list_item">
                <p class="bold"> <?= $assignment['courseName'] ?></p>
                <p> <?= $assignment ['Description'] ?></p>
            </div>
            <div class="list_removeItem">
                <form action="." method = "post">
                    <input type ="hidden" name ="action" value = "delete_assignment">
                    <input type = hidden name = "assignment_id" value ="<?= $assignment['ID'] ?>">
                    <button class = "remove-button">Deletion</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
        <?php } else { ?>
        <br>
        <?php if ($Course_ID) { ?>
            <p> No Assignment for this course yet.</p>
        <?php } else { ?>
            <p>Missing assignment.</p>
        <?php } ?>
        <br>
        <?php } ?>

</section>

<section id = "add" class = "add">
    <h2>New Task </h2>
    <form action="." method = "post" id="add_form" class="add_from">
        <input type="hidden" name="action" value="add_assignment">
        <div class="add_inputs">
            <label>Course:</label>
            <select name="Course_ID" required>
                <option value="">Choose</option>
                <?php foreach ($courses as $course) : ?>
                <option value= "<?=$course['Course_ID'];?>">
                    <?= $course['courseName']; ?>                    
            </option>
            <?php endforeach; ?>
            </select>
            <label>Description:</label>
            <input type="text" name="descr" placeholder="Description" required>
        </div>
        <div>
            <div class="add_items">
                <button class="add-button bold">Add</button>
            </div>

        </div>
    </form>
</section>
<br>
<p><a href=".?action=list_courses">View/Edit Courses</a></p>
<?php include ('view/footer.php') ; ?>