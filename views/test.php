<?php

//header('Location: '.$filePath.'../views/course.php');
//exit();

include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/section.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/course.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/announcement.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/note.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/date.php';


// ----------------------
// Manager testing code
// ----------------------

/* initializing a section
if ($manager = get_manager(1))
    echo 'true';
else
    echo 'false';
//*/

/* get method & set method
$manager = get_manager(1);
$manager->set_first_name_to('first');
echo $manager->get_first_name().' ';
$manager->set_last_name_to('ls');
echo $manager->get_last_name().' ';
echo $manager->get_username().' ';
//*/

/* insert manager
$username = 'un1';
$password = '123';
$first_name = 'fn1';
$last_name = 'ln1';
$section_time = 1;
insert_manager($username, $password, $first_name,
               $last_name, $section_time);
//*/

// ----------------------
// Section testing code
// ----------------------

/* initializing a section
if ($section = get_section(1))
    echo 'true';
else
    echo 'false';
//*/

/* get method & set method
$section = get_section(1);
echo $section->get_section_seme();
echo $section->get_section_name();
$section->set_section_name_to('TUESDAY 12:00-2:30');
echo $section->get_section_name();
//*/

/* insert section
$section_seme = '201702';
$section_name = 'SECTION 2';
insert_section($section_seme, $section_name);
//*/

/* list all sections
$section_seme = '201702';
foreach (list_all_sections_on($section_seme) as $value) {
    echo $value->get_section_id();
}
//*/

// ----------------------
// Course testing code
// ----------------------

/* initializing a course
$course_id = 1;
if ($course = get_course($course_id))
    echo 'true';
else
    echo 'false';
//*/

/* get method & set method
$course_name = 'ECON103';
$course = get_course($course_name);
echo $course->get_course_id();
echo $course->get_course_name();
echo $course->get_total_times_been_taught();
$course->set_course_name_to('ECON105');
echo $course->get_course_name();
// increase course count
$course->increase_total_times_been_taught_by(1);
echo $course->get_total_times_been_taught();
//*/

/* insert a course
$course_name = 'MATH151';
$course = insert_course($course_name);
echo $course->get_course_id();
//*/

/* get times_been_taught on week #
$course = get_course(1);
echo $course->get_times_been_taught_on(1);
//*/

/* set times_been_taught by number on week number
$course_id = 1;
$course = get_course($course_id);
$course->set_times_been_taught_by(3,1,1);
//*/

// ----------------------
// Announcement testing code
// ----------------------

/* initializing an announcement
$announcement_id = 2;
if ($announcement = get_announcement($announcement_id))
    echo 'true';
else
    echo 'false';
//*/

/* get method & set method
$announcement_id = 1;
$announcement = get_announcement($announcement_id);
echo $announcement->get_manager_id().' ';
echo $announcement->get_content().' ';
echo $announcement->get_announcement_time().' ';
$content = 'Change again';
$announcement->set_content_to($content);
echo $announcement->get_content().' ';
//*/

/* insert an announcement
$manager_id = 1;
$content = 'new content';
insert_announcement($manager_id, $content);
//*/

// ----------------------
// Note testing code
// ----------------------

/* initializing a note
$note_id = 1;
if ($note = get_note($note_id))
    echo 'true';
else
    echo 'false';
//*/

/* get method & set method
$note_id = 2;
$note = get_note($note_id);
echo $note->get_manager_id().' ';
echo $note->get_peducator_id().' ';
echo $note->get_content().' ';
echo $note->get_note_time().' ';
$content = 'Change again';
$note->set_content_to($content);
echo $note->get_content().' ';
//*/

/* insert a note
$manager_id = 1;
$peducator_id = 1;
$content = 'new content';
insert_note($manager_id, $peducator_id, $content);
//*/

// ----------------------
// manager & announcement
// ----------------------

/*
// $manager = insert_manager('senhung', '123', 'senhung', 'wong', 1);

$manager = get_manager(2);

$content = 'First Announcement';
$manager->insert_announcement($content);

//$announcement = get_announcement(1);
//if ($manager->can_edit($announcement))
//    echo 'true';
//else
//    echo 'false';

//$content = 'Change Content';
//if ($manager->can_edit($announcement))
//    $manager->edit_announcement($announcement, $content);
//*/

//$pe = get_peducator(1);
//echo $pe->get_last_name();
//echo $pe->get_all_courses();



?>

<?php

/* A simple way of transferring data

$course = get_course(1);

echo $course->get_course_name().' '.$course->get_total_times_been_taught();

echo '
<form method="post" action="">

    <input type="number" name="number">
    <input type="submit" value="number" name="submit">
</form>
';

if (isset($_POST['number'])) {
    $num = $_POST['number'];
    $course->set_times_been_taught_by($num, 1,1);
    $course->refresh_total_times_been_taught();
    echo "<meta http-equiv='refresh' content='0'>";
}
//*/
?>



<?php
/* Constructing a course table in course page

$current_week = 1; // will be change to a table # (or something else) in the future
$current_seme_id = 1; // semester id (will also be change into the table)

// DataTables CDN stylesheet & javascript
echo '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">';
echo '<script src="//code.jquery.com/jquery-1.12.4.js"></script>';
echo '<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>';

echo '<h1>This is week '.$current_week.' in semester id '.$current_seme_id.'</h1>';

$courses = list_all_courses(); // fetch all courses and return as object array

// table structure
echo '
    <table id="datatable" border="1">
    <thead>
        <tr>
            <th>Course Name</th>
            <th># of times</th>
            <th>set to</th>
        </tr>
    </thead>
    <tbody>
    ';

// read each courses
foreach ($courses as $key=>$course) {
    echo '<tr>'; // table row
    echo '<td>'.$course->get_course_name().'</td>';
    echo '<td>'.$course->get_times_been_taught_on_with_section($current_week, $current_seme_id).'</td>';
    echo '
    <form method="post" action="">
        <td><input type="number" name="number"></td>
        <input type="hidden" name="key_num" value="'.$key.'">
        <td><input type="submit" value="Change" name="submit"></td>
    </form>
    ';
    echo '</tr>'; // end table row
}
echo '</tbody></table>'; // end table structure

// if Change button is clicked call function
if (isset($_POST['number']) && isset($_POST['key_num'])) {
    $num = $_POST['number']; // the number user entered
    $key_num = $_POST['key_num']; // the row number

    // update the number
    $courses[$key_num]->set_times_been_taught_by($num, 1,1);

    // update the total number
    $courses[$key_num]->refresh_total_times_been_taught();

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

// insert a course
echo '
    Add a new course into the list: 
    <form method="post" action="">
        <td><input type="text" name="course_name"></td>
        <td><input type="submit" value="Add" name="submit"></td>
    </form>';

if (isset($_POST['course_name'])) {
    $course_name = $_POST['course_name'];

    // insert the course
    insert_course($course_name);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

//*/
?>


<?php

//$date = get_date(3);
////echo $date->get_semester();
//
//
//echo date("W").' | ';
//echo date("W", strtotime('2017-08-04')).' ';
//echo $date->get_week();

//$peducator = get_peducator(1);
//$peducator->delete_section(4);

?>



















