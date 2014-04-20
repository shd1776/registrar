<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/registrar-resources/config.php';
	require_once LIBRARY_PATH . '/db.php';

	class Course {
		public $id;
		public $title;
		public $hours;
		public $dept_id;

		public function __construct($id, $title, $hours, $dept_id) {	
			$this->id = $id;
			$this->title = $title;
			$this->hours = $hours;
			$this->dept_id = $dept_id;
		}
	}

	function course_add($mysqli, $course) {
		if ($mysqli == null) throw new Exception('Could not access database.');
		if ($course == null) throw new Exception('Course information is required to add a course.');
		if ($course->id == null) throw new Exception('Course id is required to add a course.');
		if ($course->id <= 0) throw new Exception('Course id must be greater than 0 to add a course.');
		if ($course->title == null || $course->title == '') throw new Exception('Course title is required to add a course.');
		if ($course->hours == null) throw new Exeption ('Couse hours are required to add a  course.');
		if ($course->hours <= 0) throw new Exception('Course hours must be greater than 0 to add a course.');
		if ($course->dept_id == null) throw new Exeption ('Department id id required to add a course.');
		if ($course->dept_id <= 0) throw new Exception('Department id must be greater than 0 to add a course.');

		$cleaned_title = $mysqli->real_escape_string($course->title);

		$stmt = $mysqli->prepare('INSERT INTO `courses`(`course_id`, `course_title`, `course_hours`, `dept_id`) VALUES(?,?,?,?);');
		if (!$stmt) throw new Exception('Could not access database.');
		$stmt->bind_param('isii', $course->id, $course->title, $course->hours, $course->dept_id);

		if (!$stmt->execute() || $stmt->affected_rows < 1) {
			throw new Exception('Course could not be added.');
		}
		return $course;
	}

	function course_get($mysqli, $course_id) {
		if ($mysqli == null) throw new Exception('Could not access database.');
		if ($course_id == null) throw new Exception('Course id is required to view a course.');
		if ($course_id <= 0) throw new Exception('Course id must be greater than 0 to view a course.');

		$stmt = $mysqli->prepare('SELECT `course_id`, `course_title`, `course_hours`, `dept_id` FROM `courses` WHERE `course_id`=?;');
		if (!$stmt) throw new Exception('Could not access database.');
		$stmt->bind_param('i', $course_id);

		$stmt->bind_result($course_id, $course_title, $course_hours, $dept_id);
		if (!$stmt->execute()) throw new Exception('Could not get course');
		//if ($course_title == null || $course_hours == null || $dept_id == null) throw new Exception('Could not get course.');

		return new Course($course_id, $course_title, $course_hours, $dept_id);
	}

	function course_remove($mysqli, $course_id) {
		if ($mysqli == null) throw new Exception('Could not access database.');
		if ($course_id == null) throw new Exception('Course id is required to remove a course.');
		if ($course_id == null) throw new Exception('Course id must be greater than 0 to remove a course.');
		
		$stmt = $mysqli->prepare('DELETE FROM `courses` WHERE `course_id`=?;');
		if (!$stmt) throw new Exception('Error connecting to database.');
		$stmt->bind_param('i', $course_id);

		if (!$stmt->execute()) throw new Exception('Could not remove course.');
		if ($stmt->affected_rows < 1) throw new Exception('There is no course with id of ' . $course_id . ', therefore no course was removed.');
	}

	function course_list($mysqli, $startIndex, $endIndex) {
		if ($mysqli == null) throw new Exception('Could not access database.');
		if ($startIndex == null) throw new Exception('Start index is required to list courses.');
		if ($startIndex < 1) throw new Exception('Start index must be greater than 0 to list courses.');
		if ($endIndex == null) throw new Exception('End index is required to list courses.');
		if ($endIndex < $startIndex) throw new Exception('End index must be greater than the start index to list courses.');

		$stmt = $mysqli->prepare('SELECT `course_id`, `course_title`, `course_hours`, `dept_id` FROM `courses` WHERE ? <= `course_id` AND `course_id` < ? ORDER BY `course_id`;');
		if (!$stmt) throw new Exception('Could not access database.');

		$stmt->bind_param('ii', $startIndex, $endIndex);

		$stmt->bind_result($course_id, $course_title, $course_hours, $course_dept_id);
		if (!$stmt->execute()) throw new Exception('Could not list courses.');

		$i = 0;
		$course_list = array();
		while($stmt->fetch()) {
			$course_list[$i] = new Course($course_id, $course_title, $course_hours, $course_dept_id);
			$i++;
		}

		return $course_list;
	}

	function course_update($mysqli, $course) {
		if ($mysqli == null) throw new Exception('Could not access database.');
		if ($course == null) throw new Exception('Course information is required to update a course.');
		if ($course->id == null) throw new Exception('Course id is required to update a course.');
		if ($course->id < 1) throw new Exception('Course id must be greater than 0 to update a course.');

		$props = array();
		if ($course->title != null) $props['course_title'] = '"' . $mysqli->real_escape_string($course->title) . '"';
		if ($course->hours != null) $props['course_hours'] = $mysqli->real_escape_string($course->hours);
		if ($course->dept_id != null) $props['dept_id'] = $mysqli->real_escape_string($course->dept_id);

		if (count($props) < 1) throw new Exception('Must update at least one attribute.');

		$query = 'UPDATE `courses` SET ' . getUpdateString($props) . ' WHERE `course_id`=' . $course->id . ';';

		$stmt = $mysqli->prepare($query);

		if (!$stmt->execute()) throw new Exception('Could not update course.');
		if ($stmt->affected_rows < 1) throw new Exception('Must update at least one attribute.');

		return $course;
	}
?>