<?php
  session_start();
	$instructorID = $_SESSION['instructorID'];
	$instructorsID = $_SESSION['instructorsID'];
	$studentID = $_SESSION['studentID'];
	$studentsID = $_SESSION['studentsID'];
	
	//Intructors
	function get_instructorsID(){
	  global $link;
	  global $instructorID;
		
    $sql = "SELECT ID FROM instructors WHERE instructorID='$instructorID' LIMIT 1";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	$row = mysql_fetch_array($result);
  	$instructorsID = $row['ID'];
		
		return $instructorsID;
	}
	
	// Get InstructorsID
	function get_course_instructorsID($coursesemestersectionID){
	  global $link;
		
		$parts = explode('-',$coursesemestersectionID);
	  $courseID = $parts[0];
	  $semesterID = $parts[1];
	  $sectionID = $parts[2]; 
		
    $sql = "SELECT instructorsID FROM courses WHERE courseID='$courseID' AND semesterID='$semesterID' AND sectionID='$sectionID' LIMIT 1";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>a Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	$row = mysql_fetch_array($result);
  	$instructorsID = $row['instructorsID'];
		
		return $instructorsID;
	}
	
	// Get InstructorID	
	function get_instructorID($coursesemestersectionID){
	  global $link;
		
		$parts = explode('-',$coursesemestersectionID);
	  $courseID = $parts[0];
	  $semesterID = $parts[1];
	  $sectionID = $parts[2]; 
			
	  $sql = "SELECT instructorsID FROM courses WHERE courseID='$courseID' AND semesterID='$semesterID' AND sectionID='$sectionID' LIMIT 1";
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>b Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  	$row = mysql_fetch_array($result);
  	$instructorsID = $row['instructorsID'];
		
		$sql = "SELECT instructorID FROM instructors WHERE ID=$instructorsID LIMIT 1";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>c Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	$row = mysql_fetch_array($result);
  	$instructorID = $row['instructorID'];
		
		return $instructorID;
	}
	
	//Get Instructor Name
	function get_instructorName($instructorsID){
	  global $link;
  	
		$sql = "SELECT firstName,lastName FROM instructors WHERE ID=$instructorsID LIMIT 1";
    $result = mysql_query($sql, $link);
    if (!$result) {
     echo("<p>Error performing query: " . mysql_error() . "</p>");
     exit();
    }
  	$row = mysql_fetch_array($result);
  	$instructorName = $row['firstName'] . ' ' . $row['lastName'];
		
		return $instructorName;
	}
	
	//Students ID
	function get_studentsID($studentID){
	  global $link;
		
    $sql = "SELECT ID FROM students WHERE studentID='$studentID' LIMIT 1";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	$row = mysql_fetch_array($result);
  	$studentsID = $row['ID'];
				
		return $studentsID;
	}
	
	//Student Courses
	function get_student_courses(){
	  global $link;
	  global $studentsID;
		
    $sql = "SELECT coursesID FROM rosters WHERE studentsID=$studentsID";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	while ($row = mysql_fetch_array($result)){
  		$coursesIDs[] = $row['coursesID'];
  	}
		
		return $coursesIDs;
	}
	
	//Instructor Courses
	function get_instructor_courses(){
	  global $link;
		
    $sql = "SELECT ID FROM courses";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	while ($row = mysql_fetch_array($result)){
  		$coursesIDs[] = $row['ID'];
  	}
		
		return $coursesIDs;
	}

	//Courses
  function get_courses(){
	  global $link;
	  global $instructorID;
		
		$instructorsID = get_instructorsID();
		
    $sql = "SELECT DISTINCT courseID FROM courses WHERE instructorsID!=17 AND instructorsID!=12 AND instructorsID!=9 AND instructorsID!=2 AND instructorsID!=24 AND instructorsID!=25 ORDER BY courseID"; //WHERE instructorsID=$instructorsID
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error courses performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	$courses = array();
  	while ($row = mysql_fetch_array($result)){
  		$courses[] = $row['courseID'];
  	}
		
		return $courses;
	}
	
	function get_courseID($coursesID){
	  global $link;
	  global $instructorID;
		
		$instructorsID = get_instructorsID();
		
    $sql = "SELECT courseID FROM courses WHERE ID=$coursesID AND instructorsID=$instructorsID";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	$row = mysql_fetch_array($result);
  	$courseID = $row['courseID'];
		
		return $courseID;
	}
	
	
	function get_coursesID($courseID,$semesterID,$sectionID){
	  global $link;
		
		$instructorsID = get_instructorsID();
		
    $sql = "SELECT ID FROM courses WHERE courseID='$courseID' AND semesterID='$semesterID' AND sectionID='$sectionID' LIMIT 1";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	$row = mysql_fetch_array($result);
  	$coursesID = $row['ID'];
		
		return $coursesID;
	}
	
	/*
	function get_coursesID($assignmentsID){
	  global $link;
				
    $sql = "SELECT coursesID FROM assignments WHERE ID=$assignmentsID LIMIT 1";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	$row = mysql_fetch_array($result);
  	$coursesID = $row['coursesID'];
		
		return $coursesID;
	}
	*/

	//Semesters
	function get_semesters($courseID){
	  global $link;
		
		$instructorsID = get_instructorsID();
				
  	$sql = "SELECT DISTINCT semesterID FROM courses WHERE courseID='$courseID' ORDER BY semesterID";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error semesters performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  	while ($row = mysql_fetch_assoc($result)){
  		$semesters[] = $row['semesterID'];
  	}
		
		return $semesters;
	}
	
	//Course Semester Section
	function get_coursesemestersectionID($coursesID){
	  global $link;
		global $instructorsID;
		
  	$sql = "SELECT courseID,semesterID,sectionID FROM courses WHERE ID=$coursesID LIMIT 1";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  	
		$row = mysql_fetch_assoc($result);
  	$coursesemestersectionID = $row['courseID'] . '-' . $row['semesterID'] . '-' . $row['sectionID'];
		
		return $coursesemestersectionID;
	}
	
	//Sections
	function get_sections($courseID,$semesterID){
	  global $link;
		
		$instructorsID = get_instructorsID();
		
  	$sql = "SELECT sectionID FROM courses WHERE courseID='$courseID' AND semesterID='$semesterID'ORDER BY sectionID";
  
  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error sections performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  	while ($row = mysql_fetch_assoc($result)){
  	 	$sections[] = $row['sectionID'];
  	}
		
		return $sections;
	}
	
	// Roster
	function get_roster($coursesID){
	  global $link;

	  $sql = "SELECT ID FROM rosters WHERE coursesID=$coursesID LIMIT 1";

  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}

		if (mysql_num_rows($result) == 0){
		  return false;
		}else {
		  return true;
		}
	}
	
	// Get Students 
	function get_students($coursesID){
	  global $link;

	  $sql = "SELECT studentsID FROM rosters WHERE coursesID=$coursesID";

  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}

		while ($row =  mysql_fetch_assoc($result)){
  	  $students[] = $row['studentsID'];
		}
				
		return $students;
	}
	
	// Assignments
	function get_assignments($coursesID){
	  global $link;
				
	  $sql = "SELECT assignment FROM assignments WHERE coursesID=$coursesID ORDER BY weight";
  	
		$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		while ($row =  mysql_fetch_assoc($result)){
  	  $assignments[] = $row['assignment'];
		}
				
		return $assignments;
	}
	
	function get_assignmentsID($coursesID,$assignment){
	  global $link;
				
	  $sql = "SELECT ID FROM assignments WHERE coursesID=$coursesID AND assignment='$assignment' LIMIT 1";
  	
		$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		$row =  mysql_fetch_assoc($result);
  	$assignmentsID = $row['ID'];
				
		return $assignmentsID;
	}
	
	//Assignments
	function get_assignment($assignmentsID){
	  global $link;
	
	  $sql = "SELECT assignment FROM assignments WHERE ID=$assignmentsID LIMIT 1";
		
		$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		$row = mysql_fetch_array($result);
  	$assignment = $row['assignment'];
				
		return $assignment;
	}

  //Rubric	
	function get_rubricsID($assignmentsID){
	  global $link;
	
	  $sql = "SELECT ID FROM user_rubrics WHERE assignmentsID=$assignmentsID LIMIT 1";
		
		$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		$row = mysql_fetch_array($result);
  	$rubricsID = $row['ID'];
				
		return $rubricsID;
	}
	
	// Rubric Title 
	function get_rubric_title($rubricsID){
	  global $link;
	
	  $sql = "SELECT title FROM user_rubrics WHERE ID=$rubricsID";
		
		$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		$row = mysql_fetch_array($result);
  	$rubricTitle = $row['title'];
				
		return $rubricTitle;
	}
	
	// Rubrics
	function get_grade($studentsID,$assignmentsID){
	  global $link;
							
	  $sql = "SELECT grade FROM grades WHERE studentsID=$studentsID AND assignmentsID=$assignmentsID";
		
		$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>" . $studentsID . " - Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		$row = mysql_fetch_array($result);
  	$grade = $row['grade'];
						
		return $grade;
	}
  
	function import($delimiter){
		$file = $_FILES["file"]["tmp_name"];
		$fh = fopen($file, "r");
		$timestamp = trim(fgets($fh));
		echo '<div class="tools"><a class="checkAll" href="#">Check All</a> / <a class="uncheckAll" href="#">Uncheck All</a> With Selected: <input class="deleteAll" type="button" value="Delete" /></div>';
		echo '<table>';
		echo '<th><tr><td colspan=3></td><td>PSU Email ID</td><td>First Name</td><td>Last Name</td></tr></th>';
		while (!feof($fh) ) {
			$line_of_text = trim(fgets($fh));
			if ($line_of_text != ""){
			$student = explode($delimiter, $line_of_text);
			echo '<tr>' .
			'<td><input type="checkbox" name="students[]" value="' . strtoupper($student[2]) . ',' . strtoupper($student[0]) . ',' . strtoupper($student[1]) . '" /></td>' .
			'<td><input type="button" value="Edit" /></td>' .
			'<td><input type="button" value="Delete" /></td>' .
			'<td>' . strtoupper($student[0]) . '<input name="firstName[]" type="hidden" value="' . strtoupper($student[0]) . '"></td>' .
			'<td>' . strtoupper($student[1]) . '<input name="lastName[]" type="hidden" value="' . strtoupper($student[1]) . '"></td>' .
			'<td>' . strtoupper($student[2]) . '<input name="studentID[]" type="hidden" value="' . strtoupper($student[2]) . '"></td>' .
			'</tr>';
			}
		}
		echo '</table>';
		echo '<div class="tools"><a class="checkAll" href="#">Check All</a> / <a class="uncheckAll" href="#">Uncheck All</a> With Selected: <input class="deleteAll" type="button" value="Delete" /></div>';
		echo '<br><input type="submit" value="Upload" />';
		fclose($fh);
	}

	function import02($delimiter, $coursesID){
	  global $link;
		
		$file = $_FILES["file"]["tmp_name"];
		$fh = fopen($file, "r");
		$timestamp = trim(fgets($fh));
		while (!feof($fh) ) {
			$line_of_text = trim(fgets($fh));
			if ($line_of_text != ""){
  			$student = explode($delimiter, $line_of_text);
  			$studentID = strtoupper(mysql_real_escape_string($student[2]));
  			$firstName = strtoupper(mysql_real_escape_string($student[1]));
  			$lastName = strtoupper(mysql_real_escape_string($student[0]));
								
				$sql = "SELECT ID FROM students WHERE studentID='$studentID' LIMIT 1";
      	$result = mysql_query($sql, $link);
      	if (!$result) {
        	echo("<p>Error performing query: " . mysql_error() . "</p>");
        	exit();
        }
      	if (mysql_num_rows($result) == 0){
          $sql = "INSERT INTO students VALUES(null,'$studentID','$firstName','$lastName')";
      		$result = mysql_query($sql, $link);	
      		if (!$result) {
         		echo("<p>Error performing query: " . mysql_error() . "adfasdf</p>");
         		exit();
         	}
					
					$sql = "SELECT ID FROM students WHERE studentID='$studentID' LIMIT 1";
      		$result = mysql_query($sql, $link);	
      		if (!$result) {
         		echo("<p>Error performing query: " . mysql_error() . "</p>");
         		exit();
         	}
					
					$row = mysql_fetch_array($result);
					$studentsID = $row['ID'];
        }else {
				  $row = mysql_fetch_array($result);
					$studentsID = $row['ID'];
				}
				
				$sql = "SELECT studentsID FROM rosters WHERE studentsID=$studentsID AND coursesID=$coursesID LIMIT 1";
				$result = mysql_query($sql, $link);	
      	if (!$result) {
          echo("<p>Error performing query: " . mysql_error() . "</p>");
         	exit();
        }
			  if (mysql_num_rows($result) == 0){
				  $sql = "INSERT INTO rosters VALUES(null,$coursesID,$studentsID)";
  				$result = mysql_query($sql, $link);	
        	if (!$result) {
            echo("<p>Error performing query: " . mysql_error() . "</p>");
           	exit();
          }
				}
			}
		}
		fclose($fh);
	}


	function import03($delimiter,$coursesemestersectionID){
		echo $coursesemestersectionID;
		$file = $_FILES["file"]["tmp_name"];
		$fh = fopen($file, "r");
		$timestamp = trim(fgets($fh));
		while (!feof($fh) ) {
			$line_of_text = trim(fgets($fh));
			if ($line_of_text != ""){
			$parts = explode($delimiter, $line_of_text);
				mysql_query("INSERT INTO roster VALUES(null,'$coursesemestersectionID','$parts[2]','$parts[0]','$parts[1]')");
			}
		}

		fclose($fh);
		$parts = explode('-',$coursesemestersectionID);
		$courseID = $parts[0];
		$semesterID = $parts[1];
		$sectionID = $parts[2];
		echo '<script>window.location = "roster.php?courseID=' . $courseID . '&semesterID=' . $semesterID . '&sectionID=' . $sectionID . '"</script>';
	}


	function import04($delimiter){
	  $file = $_FILES["file"]["tmp_name"];
	  $fh = fopen($file, "r");
	  $timestamp = trim(fgets($fh));
	  while (!feof($fh) ) {
		$line_of_text = trim(fgets($fh));
			if ($line_of_text != ""){
		  $student = explode($delimiter, $line_of_text);
		  $studentID = strtoupper($student[2]);
				$firstName = strtoupper($student[0]);
				$lastName = strtoupper($student[1]);
		  mysql_query("INSERT INTO roster VALUES(null,'$coursesemestersectionID','$studentID','$firstName','$lastName')");
			}
	  }
		fclose($fh);
	}

	function project_update($sectionID,$coursesemesterID,$project){
		$result = mysql_query("SELECT projects FROM section WHERE sectionID='$sectionID' AND coursesemesterID='$coursesemesterID'") or die(mysql_error());
		$row = mysql_fetch_array($result);
		$projects = $row['projects'];

		if (empty($projects)){
		  $project = JSON_encode(array($project));
			mysql_query("UPDATE section SET projects='$project' WHERE sectionID='$sectionID' AND coursesemesterID='$coursesemesterID'") or die(mysql_error());
		}
		else {			
		  $status = "pass";
			$projectsArray = JSON_decode($projects);
			for ($i=0;$i<sizeof($projectsArray);$i++){
			  if (strtoupper($project[0]) == strtoupper($projectsArray[$i][0])){
				  $status = "fail";
      	}
			}
			if ($status == "fail"){
			  echo "You aleady added this assignment for section " . $sectionID . ". ";
    	}else {
			  array_push($projectsArray,$project);
    		$projectsArray = JSON_encode($projectsArray);
    		mysql_query("UPDATE section SET projects='$projectsArray' WHERE sectionID='$sectionID' AND coursesemesterID='$coursesemesterID'") or die(mysql_error());
    	}
		}
	}

	function rubric_insert($rubricsID,$assignmentsID){
	  global $link;
		
		$sql = "SELECT * FROM rubrics WHERE ID=$rubricsID LIMIT 1";
    $result = mysql_query($sql, $link);	
    if (!$result) {
      echo("<p>Error performing query: " . mysql_error() . "</p>");
      exit();
    }
		
		$row = mysql_fetch_array($result);
  	$title = $row['title'];
  	$rubric = mysql_real_escape_string($row['rubric']);
  	$total = $row['total'];
  	$date_modified = $row['date_modified'];
  	$tags = $row['tags'];

		$sql = "INSERT INTO user_rubrics VALUES(null,$assignmentsID,'$title','$rubric',$total,NOW(),NOW(),0,0)";
    $result = mysql_query($sql, $link);	
    if (!$result) {
      echo("<p>Error performing query: " . mysql_error() . "</p>");
      exit();
    }
	}
	
	function get_student($studentsID){
	  $result = mysql_query("SELECT studentID,firstName,lastName FROM students WHERE ID=$studentsID LIMIT 1") or die(mysql_error());
		$row = mysql_fetch_array($result);
		$studentID = $row['studentID'];
		$firstName = $row['firstName'];
		$lastName = $row['lastName'];
		$fullName = $firstName . ' ' . $lastName;
		
		return $fullName;
	}
	
	function get_available_semesters($courseID,$instructorID){
  	$sql = "SELECT semesterID FROM course WHERE courseID='$courseID' AND instructorID='$instructorID' AND semesterID IS NOT NULL";
  
    $result = mysql_query($sql, $link);
    if (!$result) {
      echo("<p>Error performing query: " . mysql_error() . "</p>");
      exit();
    }
    while ($row = mysql_fetch_assoc($result)){
      $semesters[] = $row['semesterID'];
    }
    
    $year = date('Y');
    $semestersDefault = array($year . 'FA', $year . 'SPR', $year . 'SUM', $year  . 'TERM1', $year . 'TERM2', $year . 'TERM3');
    for ($i=0;$i<sizeof($semesters);$i++){
      foreach($semestersDefault as $key => $value) {
        if ($value == $semesters[$i]) unset($semestersDefault[$key]);
      }
    }
    $semestersDefault = array_values($semestersDefault);
    for ($i=0;$i<sizeof($semestersDefault);$i++){
      echo '<option value="' . $semestersDefault[$i] . '">' . $semestersDefault[$i] . '</option>';
    }
  }
	
	function get_status($studentsID,$assignmentsID){			
	  $rubricsID = get_rubricsID($assignmentsID);
		
		if ($rubricsID){
  	  $result = mysql_query("SELECT rubric FROM user_rubrics WHERE ID=$rubricsID LIMIT 1");
      $row = mysql_fetch_array($result);
    	$cellJSON = $row['rubric'];
    	$cellArray = json_decode($cellJSON);
    	for ($a=0;$a<sizeof($cellArray);$a++){
    	  $cell = $cellArray[$a];
    	  if ($cell[0] > $numOfRows){
    		  $numOfRows = $cell[0];
    		}
    		if ($cell[1] > $numOfCols){
    		  $numOfCols = $cell[1];
    		}
    	}
    	$numOfRows++;
  		while ($numOfRows % 3 != 0){
    	  $numOfRows++;
    	}
    	$numOfRows = $numOfRows/3;
		}
		
		$grade = get_grade($studentsID,$assignmentsID);
		
		if (empty($grade)){
		  $status = 'not_completed';
		}else if ($grade == "no submission"){
		  $status = 'no_submission';
		}else {
		  $cellArray = json_decode($grade);
			$gradedRows=0;
		  for ($b=0;$b<sizeof($cellArray);$b++){
    	  $cell = $cellArray[$b];
    	  if ($cell[0] != -1 && $cell[0] != -2){
    		  $gradedRows++;
    		}
    	}
			
			if ($gradedRows != $numOfRows){
			  $status = 'incomplete';
			}else {
			  $status = 'completed';
			}
		}
					
		return $status;
	}
	
	//Get student prevent publish boolean
	function get_preventPublish($studentsID,$assignmentsID){
	  global $link;
							
	  $sql = "SELECT preventPublish FROM grades WHERE studentsID=$studentsID AND assignmentsID=$assignmentsID LIMIT 1";
		
		$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		$row = mysql_fetch_array($result);
  	$preventPublish = $row['preventPublish'];
		
		return $preventPublish;
	}
	
	//Get student notified boolean
	function get_notified($studentsID,$assignmentsID){
	  global $link;
							
	  $sql = "SELECT notified FROM grades WHERE studentsID=$studentsID AND assignmentsID=$assignmentsID LIMIT 1";
		
		$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		$row = mysql_fetch_array($result);
  	$notified = $row['notified'];
		
		return $notified;
	}

	//Get student access boolean
	function get_accessed($studentsID,$assignmentsID){
	  global $link;
							
	  $sql = "SELECT accessed FROM grades WHERE studentsID=$studentsID AND assignmentsID=$assignmentsID";
		
		$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		$row = mysql_fetch_array($result);
  	$accessed = $row['accessed'];
		
		return $accessed;
	}
	
	//Update student access boolean
	function update_accessed($studentsID,$assignmentsID){
	  global $link;
							
	  $sql = "UPDATE grades SET accessed=1 WHERE studentsID=$studentsID AND assignmentsID=$assignmentsID";
		
		$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
	}
	
	// Get publish setting 
	function get_publish_setting($assignmentsID){
	  global $link;
	
	  $sql = "SELECT publish FROM user_rubrics WHERE assignmentsID=$assignmentsID LIMIT 1";
		
		$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		$row = mysql_fetch_array($result);
  	$published = $row['publish'];
				
		return $published;
	}
	
	// Get uploads setting 
	function get_uploads_setting($assignmentsID){
	  global $link;
	
	  $sql = "SELECT uploads FROM assignments WHERE ID=$assignmentsID LIMIT 1";

  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		$row = mysql_fetch_array($result);
		$uploads = $row['uploads'];
						
		return $uploads;
	}
	
	// Get documents
	function get_documents($studentsID,$assignmentsID){
	  global $link;
	
	  $sql = "SELECT document FROM documents WHERE assignmentsID=$assignmentsID AND studentsID=$studentsID";

  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	while ($row = mysql_fetch_array($result)){
  	  $docs[] = $row['document'];
    }
		
		return $docs;
	}
	
	// Get documentsID
	function get_documentsID($studentsID,$assignmentsID,$doc){
	  global $link;
	
	  $sql = "SELECT ID FROM documents WHERE assignmentsID=$assignmentsID AND studentsID=$studentsID AND document='$doc' LIMIT 1";

  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	$row = mysql_fetch_array($result);
  	$docsID = $row['ID'];

		
		return $docsID;
	}
	
	// Get feedback
	function get_feedback($documentsID){
	  global $link;
	
	  $sql = "SELECT feedback FROM documents WHERE ID=$documentsID LIMIT 1";

  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
  
  	$row = mysql_fetch_array($result);
  	$feedback = $row['feedback'];
		
		return $feedback;
	}
	
	// Student Cycle 
	function get_student_cycle($studentsID,$coursesID,$assignmentsID){
	  global $link;
	
	  $result = mysql_query("SELECT studentsID FROM rosters WHERE coursesID=$coursesID") or die(mysql_error());
		$i=0;
    while ($row = mysql_fetch_array($result)){
      $ID = $row['studentsID'];
    	if ($i == 0){
    	  $IDs = $ID;
    	}else {
    	  $IDs = $IDs . ' OR ID=' . $ID;
    	}
    	$i++;
    } 
					
    $sql = 'SELECT * FROM students WHERE ID=' . $IDs . ' ORDER BY lastName';
		$result = mysql_query($sql, $link);
    if (!$result) {
      echo("<p>Error performing query: " . mysql_error() . "</p>");
      exit();
    }
				
		$cycle = '';
		for ($i=0;$i<mysql_num_rows($result);$i++){
		  mysql_data_seek($result, $i);
		  $row  = mysql_fetch_assoc($result); 
			if ($studentsID == $row['ID']){
				if (($i-1)>=0){
				  mysql_data_seek($result, ($i-1));
			    $row  = mysql_fetch_assoc($result);
					$cycle .= '<a href="?coursesID=' . $coursesID . '&studentsID=' . $row['ID'] . '&assignmentsID=' . $assignmentsID . '">Previous</a>';
				}
				if (($i-1)>=0 && ($i+1)<mysql_num_rows($result)){
				  $cycle .= ' | ';
				}
				if (($i+1)<mysql_num_rows($result)){
			    mysql_data_seek($result, ($i+1));
			    $row  = mysql_fetch_assoc($result);
					$cycle .= '<a href="?coursesID=' . $coursesID . '&studentsID=' . $row['ID'] . '&assignmentsID=' . $assignmentsID . '">Next</a>';
				}
			}
		}		
		
		echo $cycle;
  }
	
	// Get Assignment Grade 
	function get_assignment_grade($studentsID,$assignmentsID){
	  global $link;
		
		$status = get_status($studentsID,$assignmentsID);
    if ($status == 'completed' || $status == 'no_submission'){
  	  $result2 = mysql_query("SELECT total FROM user_rubrics WHERE assignmentsID=$assignmentsID AND publish=1") or die(mysql_error());
     	$row2 = mysql_fetch_array($result2);
  		$rubricTotal = $row2['total'];
			$totalPoints += $rubricTotal;
  								
  	  if ($rubricTotal!=0){			
    	  $result3 = mysql_query("SELECT grade,preventPublish FROM grades WHERE studentsID=$studentsID AND assignmentsID=$assignmentsID LIMIT 1") or die(mysql_error());
        if (mysql_num_rows($result3)!=0){
      	  $row3 = mysql_fetch_array($result3);
					$preventPublish = $row3['preventPublish'];
					if ($preventPublish == 1){
					  return 'Not Published';
					}
          $gradeJSON = $row3['grade'];
        	$gradeArray = json_decode($gradeJSON);
        	for ($i=0;$i<sizeOf($gradeArray);$i++){
					  if ($gradeArray[$i][0] == -2){
						  $assignmentGrade -= $gradeArray[$i][2];
						}else {
        		  $assignmentGrade += $gradeArray[$i][2];
						}
        	}
      		$studentPoints += $assignmentGrade;
    		}
  		}
		}
	  if ($status == 'no_submission'){
		  $grade = 'No Submission';
		}else if ($totalPoints == 0){
		  $grade = 'Not Graded';
		}else {
		  $result = mysql_query("SELECT coursesID FROM assignments WHERE ID=$assignmentsID LIMIT 1");
			$row = mysql_fetch_array($result);
			$coursesID = $row['coursesID'];
		  $grade = '<a href="rubric.php?studentsID=' . $studentsID . '&coursesID=' . $coursesID . '&assignmentsID=' . $assignmentsID . '">' . number_format(($studentPoints/$totalPoints)*100,2) . '%</a>';
		}
		
    return  $grade;
	}
	
	// Get Grade 
	function get_course_grade($studentsID,$coursesID){
	  global $link;
		
		$sql = "SELECT ID FROM assignments WHERE coursesID=$coursesID";

  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error performing query: " . mysql_error() . "</p>");
  		exit();
  	}
		
		//$studentPoints = 0;
		while ($row = mysql_fetch_array($result)){
		  $assignmentsID = $row['ID'];
			$status = get_status($studentsID,$assignmentsID);
  		if ($status == 'completed' || $status == 'no_submission'){
  		  $result2 = mysql_query("SELECT total FROM user_rubrics WHERE assignmentsID=$assignmentsID AND publish=1") or die(mysql_error());
     		$row2 = mysql_fetch_array($result2);
  			$rubricTotal = $row2['total'];
  								
  			if ($rubricTotal!=0){			
    			$result3 = mysql_query("SELECT grade FROM grades WHERE studentsID=$studentsID AND assignmentsID=$assignmentsID AND preventPublish=0 LIMIT 1") or die(mysql_error());
          if (mysql_num_rows($result3)!=0){
					  $totalPoints += $rubricTotal;
      			$row3 = mysql_fetch_array($result3);
        	  $gradeJSON = $row3['grade'];
        	  $gradeArray = json_decode($gradeJSON);
						$assignmentGrade = 0;
        		for ($i=0;$i<sizeOf($gradeArray);$i++){
						  if ($gradeArray[$i][0] == -2){
							  $assignmentGrade -= $gradeArray[$i][2];
							}else {
        		    $assignmentGrade += $gradeArray[$i][2];
							}
        		}
      			$studentPoints += $assignmentGrade;
    			}
  			}
			}
		}
		if ($totalPoints == 0){
		  $grade = 'Nothing Graded';
		}else {
		  $grade = number_format(($studentPoints/$totalPoints)*100,2) . '%';
		}
		
    return $grade;
	}
?>