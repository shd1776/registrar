CREATE TABLE IF NOT EXISTS departments (
	dept_id int NOT NULL,
	dept_name varchar(255) NOT NULL,
	college varchar(255) NOT NULL,
	CONSTRAINT pk_departments PRIMARY KEY (dept_id),
	CONSTRAINT uc_departments UNIQUE (dept_name, college)
);

INSERT INTO departments VALUES (1, "Computer Science", "New Jersey Institute of Technology");
INSERT INTO departments VALUES (2, "Mathematics", "New Jersey Institute of Technology");
INSERT INTO departments VALUES (2, "Economics", "New Jersey Institute of Technology");

CREATE TABLE IF NOT EXISTS courses (
	course_no int NOT NULL,
	course_title varchar(255) NOT NULL,
	hours int NOT NULL,
	dept_id int NOT NULL,
	CONSTRAINT pk_courses PRIMARY KEY (course_no),
	CONSTRAINT fk_courses_dept_id FOREIGN KEY (dept_id) REFERENCES departments(dept_id)
);

INSERT INTO courses VALUES (11251, "Advanced Database System", 3, 1);
INSERT INTO courses VALUES (11232, "Computer Organization and Architecture", 3, 1);
INSERT INTO courses VALUES (11247, "Cryptography and Internet Security", 3, 1);
INSERT INTO courses VALUES (11243, "Introduction to Computer Networks", 3, 1);
INSERT INTO courses VALUES (11222, "Introduction to Computer Science II", 3, 1);
INSERT INTO courses VALUES (, "Elementary Probability and Statistics", 3, 2);
INSERT INTO courses VALUES (7, "Introduction to Database Systems", 3, 1);
INSERT INTO courses VALUES (8, "Microeconomics", 3, 3);

CREATE TABLE IF NOT EXISTS instructors (
	last_name varchar(255) NOT NULL,
	first_name varchar(255) NOT NULL,
	dept_id int NOT NULL,
	office varchar(255) NOT NULL,
	phone varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	CONSTRAINT pk_instructors PRIMARY KEY (last_name, first_name),
	CONSTRAINT fk_instructors_dept_id FOREIGN KEY (dept_id) REFERENCES departments(dept_id)
);

INSERT INTO instructors VALUES ("Mango", "Christopher", 2, "GITC 4208", "unknown", "christopher.m.mango@njit.edu");
INSERT INTO instructors VALUES ("Oria", "Vincent", 1, "GITC 4208", "unknown", "vincent.oria@njit.edu");
INSERT INTO instructors VALUES ("Chou", "Porchiung", 3, "GITC 4208", "unknown", "porchiung.b.chou@njit.edu");
INSERT INTO instructors VALUES ("Theodoratos", "Dimitrios", 1, "GITC 4208", "unknown", "dimitri.theodoratos@njit.edu");
INSERT INTO instructors VALUES ("Baltrush", "Michael", 1, "GITC 4208", "unknown", "michael.a.baltrush@njit.edu");
INSERT INTO instructors VALUES ("Curtmola", "Reza", 1, "GITC 4208", "unknown", "reza.curtmola@njit.edu");
INSERT INTO instructors VALUES ("Blank", "George", 1, "GITC 4208", "unknown", "george.blank@njit.edu");
INSERT INTO instructors VALUES ("Rutowski", "Wallace", 1, "GITC 4208", "unknown", "wallace.rutkowski@njit.edu");
INSERT INTO instructors VALUES ("Calvin", "James", 1, "GITC 4208", "unknown", "james.m.calvin@njit.edu");

CREATE TABLE IF NOT EXISTS sections (
	term varchar(10) NOT NULL,
	line_no int NOT NULL,
	c_no int NOT NULL,
	inst_lname varchar(255) NOT NULL, 
	inst_fname varchar(255) NOT NULL,
	room varchar(255),
	days varchar(255),
	time_start timestamp,
	time_end timestamp,
	capacity int,
	CONSTRAINT pk_sections PRIMARY KEY (term, line_no),
	CONSTRAINT fk_sections_instructor FOREIGN KEY (inst_lname, inst_fname) REFERENCES instructors(last_name, first_name)
);

INSERT INTO sections VALUES ("2014 SPRING", 4, 11222, "Calvin", "James", "GITC 2315C\1100", "TR", "0000-00-00 11:30:00", "0000-00-00 12:30:00", 30);
INSERT INTO sections VALUES ("2014 SPRING", 102, 11232, "Baltrush", "Michael", "CKB 206", "R", "0000-00-00 18:00:00", "0000-00-00 20:05:00", 30);
INSERT INTO sections VALUES ("2014 SPRING", 2, 11243, "Blank", "George", "Kupfrian Hall 106", "WF", "0000-00-00 13:00:00", "0000-00-00 14:25:00", 30);
INSERT INTO sections VALUES ("2014 SPRING", 2, 11247, "Curtmola", "Reza", "CKB 207", "TR", "0000-00-00 13:00:00", "0000-00-00 14:25:00", 30);
INSERT INTO sections VALUES ("2014 SPRING", 2, 11251, "Theodoratos", "Dimitrios", "CKB 215", "W", "0000-00-00 10:00:00", "0000-00-00 12:55:00", 30);

CREATE TABLE IF NOT EXISTS students (
	student_id int NOT NULL,
	last_name varchar(255) NOT NULL,
	first_name varchar(255) NOT NULL,
	class varchar(9) NOT NULL,
	phone varchar (11) NOT NULL,
	street varchar(255) NOT NULL,
	city varchar(255) NOT NULL,
	state varchar(2) NOT NULL,
	zip varchar(255) NOT NULL,
	degree varchar(255) NOT NULL,
	dept_id int NOT NULL,
	hours int NOT NULL,
	gpa float NOT NULL,
	CONSTRAINT pk_students PRIMARY KEY (student_id),
	CONSTRAINT fk_students_dept_id FOREIGN KEY (dept_id) REFERENCES departments(dept_id)
);

INSERT INTO students VALUES (1, "Cifelli", "Matthew", "2015", "unknown phone", "unknown street", "unknown city", "unknown state", "unknown zip", "Computer Science", 1, 33, 3.25)

CREATE TABLE IF NOT EXISTS enrollments (
	student_id int NOT NULL,
	term varchar(10) NOT NULL,
	line_no int NOT NULL,
	grade int,
	CONSTRAINT pk_enrollments PRIMARY KEY (student_id, term, line_no),
	CONSTRAINT fk_enrollments_student FOREIGN KEY (student_id) REFERENCES students(student_id)
);

INSERT INTO enrollments VALUES (1, "2014 SPRING", );