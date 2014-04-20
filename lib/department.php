<?php
	class Department {
		public $dept_id;
		public $dept_name;
		public $college;

		public function __construct($dept_id, $dept_name, $college) {
			$this->dept_id = $dept_id;
			$this->dept_name = $dept_name;
			$this->college = $college;
		}

		public function clean($mysqli) {
			$this->dept_id = $mysqli->real_escape_string($this->dept_id);
			$this->dept_name = $mysqli->real_escape_string($this->dept_name);
			$this->college = $mysqli->real_escape_string($this->college);
		}
	}

	function department_add($mysqli, $department) {
		if ($mysqli == null) throw new Exception('unable to access database');
		if ($dept_id == null) throw new Exception('department information is required to add a department');
		$department->clean($mysqli);

		$stmt = $mysqli->prepare('INSERT INTO `departments`(`dept_id`, `dept_name`, `college`) VALUES(?,?,?);');
		$stmt->bind_param('iss', $department->dept_id, $department->dept_name, $department->college);
		$stmt->execute();
	}

	function department_remove($mysqli, $dept_id) {
		if ($mysqli == null) throw new Exception('unable to access database');
		if ($dept_id == null) throw new Exception('department id is required to delete a department');

		$stmt = $mysqli->prepare('DELETE FROM `departments` WHERE `dept_id`=?;');
		$stmt->bind_param('i', $dept_id);
		$stmt->execute();

		if ($stmt->affected_rows < 1) {
			throw new Exception('there is no department with id of ' . $dept_id . '. Nothing was deleted.');
		}
	}

	function department_get($mysqli, $dept_id) {
		if ($mysqli == null) throw new Exception('unable to access database');
		if ($dept_id == null) throw new Exception('department id is required to view a department');

		$department = new Department($mysqli->real_escape_string($dept_id), null, null);

		$stmt = $mysqli->prepare('SELECT `dept_name`, `college` FROM `departments` WHERE `dept_id`=?;');
		$stmt->bind_param('i', $department->dept_id);
		$stmt->execute();
		
		$stmt->bind_result($department->dept_name, $department->college);
		$stmt->fetch();

		if ($department->dept_name == null || $department->college == null) return null;

		return $department;
	}

	function department_update($mysqli, $department) {
		if ($mysqli == null) throw new Exception('unable to access database');
		if ($department == null || $department->dept_id == null) throw new Exception('department id is required to update a department');
		if ($department->dept_name == null && $department->college == null) throw new Exception('nothing to update');

		$department->clean($mysqli);
		$query = 'UPDATE `departments` SET ';

		if ($department->dept_name != null) {
			$query .= '`dept_name`="' . $department->dept_name . '"';
		}
		if ($department->college != null) {
			if ($department->dept_name != null) {
				$query .= ', ';
			}

			$query .= '`college`="' . $department->college . '"';
		}

		$query .= ' WHERE `dept_id`=' . $department->dept_id . ';';

		$stmt = $mysqli->prepare($query);

		if (!$stmt->execute() || $stmt->affected_rows < 1) {
			throw new Exception('could not update department');
		}
		return $department;
	}

	function department_list($mysqli, $startIndex, $endIndex) {
		if ($mysqli == null) throw new Exception('unable to access database');
		if ($startIndex == null) throw new Exception('start index is required');
		if ($startIndex < 0) throw new Exception('start index must be greater than 0');
		if ($endIndex == null) throw new Exception('end index is required');
		if ($endIndex < $startIndex) throw new Exception('end index must be greater than or equal to the start index');

		$stmt = $mysqli->prepare('SELECT `dept_id`, `dept_name`, `college` FROM `departments` WHERE `dept_id`>=? AND `dept_id`<?;');
		$stmt->bind_param('ii', $startIndex, $endIndex);
		$stmt->execute();
		
		$i = 0;
		$department_list = array();
		$stmt->bind_result($dept_id, $dept_name, $college);
		while($stmt->fetch()) {
			$department_list[$i] = new Department($dept_id, $dept_name, $college);
			$i++;
		}
		return $department_list;
	}
?>