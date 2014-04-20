CREATE DATABASE IF NOT EXISTS registrar;
USE registrar;

CREATE TABLE IF NOT EXISTS departments (
	dept_id int NOT NULL,
	dept_name varchar(255) NOT NULL,
	college varchar(255) NOT NULL,
	CONSTRAINT pk_departments PRIMARY KEY (dept_id),
	CONSTRAINT uc_departments UNIQUE (dept_name, college)
);

CREATE TABLE IF NOT EXISTS users (
	uid int NOT NULL,
	password varchar(255) NOT NULL,
	last_name varchar(255) NOT NULL,
	first_name varchar(255) NOT NULL,
	phone varchar(11),
	street varchar(255),
	city varchar(255),
	state varchar(2),
	zip varchar(255), 
	email varchar(255),
	dept_id int NOT NULL,
	CONSTRAINT pk_users PRIMARY KEY (uid),
	CONSTRAINT fk_user_dept_id FOREIGN KEY (dept_id) REFERENCES departments(dept_id)
);

CREATE TABLE IF NOT EXISTS instructors (
	uid int NOT NULL,
	office_location varchar(255),
	office_hours_start time,
	office_hours_end time,
	office_hours_days varchar(7),
	CONSTRAINT pk_instructors PRIMARY KEY (uid),
	CONSTRAINT fk_instructors_users FOREIGN KEY (uid) REFERENCES users(uid)
);

CREATE TABLE IF NOT EXISTS students (
	uid int NOT NULL,
	class varchar(255) NOT NULL,
	CONSTRAINT pk_students PRIMARY KEY (uid),
	CONSTRAINT fk_students_users FOREIGN KEY (uid) REFERENCES users(uid)
);

CREATE TABLE IF NOT EXISTS courses (
	cid int NOT NULL,
	title varchar(255) NOT NULL,
	hours int NOT NULL,
	dept_id int NOT NULL,
	CONSTRAINT pk_courses PRIMARY KEY (cid),
	CONSTRAINT fk_courses_departments FOREIGN KEY (dept_id) REFERENCES departments(dept_id)
);

CREATE TABLE IF NOT EXISTS sections (
	term varchar(11) NOT NULL,
	cid int NOT NULL,
	section_no int NOT NULL,
	inst_id int,
	room varchar(255),
	days varchar(255),
	time_start time,
	time_end time,
	capacity int,
	CONSTRAINT pk_sections PRIMARY KEY (term, cid, section_no),
	CONSTRAINT fk_sections_instructors FOREIGN KEY (inst_id) REFERENCES instructors(uid),
	CONSTRAINT fk_sections_courses FOREIGN KEY (cid) REFERENCES courses(cid)
);

CREATE TABLE IF NOT EXISTS enrollments (
	student_id int NOT NULL,
	term varchar(11) NOT NULL,
	cid int NOT NULL,
	section_no int NOT NULL,
	grade int,
	CONSTRAINT pk_enrollments PRIMARY KEY (student_id, term, cid, section_no),
	CONSTRAINT fk_enrollments_students FOREIGN KEY (student_id) REFERENCES students(uid),
	CONSTRAINT fk_enrollments_sections FOREIGN KEY (term, cid, section_no) REFERENCES sections(term, cid, section_no)
);