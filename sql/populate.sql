INSERT INTO departments(`dept_id`, `dept_name`, `college`) VALUES (1, "Computer Science", "New Jersey Institute of Technology");
INSERT INTO departments(`dept_id`, `dept_name`, `college`) VALUES (2, "Mathematics", "New Jersey Institute of Technology");
INSERT INTO departments(`dept_id`, `dept_name`, `college`) VALUES (3, "Economics", "New Jersey Institute of Technology");

INSERT INTO courses(`cid`, `title`, `hours`, `dept_id`) VALUES (1, "Advanced Database System", 3, 1);
INSERT INTO courses(`cid`, `title`, `hours`, `dept_id`) VALUES (2, "Computer Organization and Architecture", 3, 1);
INSERT INTO courses(`cid`, `title`, `hours`, `dept_id`) VALUES (3, "Cryptography and Internet Security", 3, 1);
INSERT INTO courses(`cid`, `title`, `hours`, `dept_id`) VALUES (4, "Introduction to Computer Networks", 3, 1);
INSERT INTO courses(`cid`, `title`, `hours`, `dept_id`) VALUES (5, "Introduction to Computer Science II", 3, 1);
INSERT INTO courses(`cid`, `title`, `hours`, `dept_id`) VALUES (6, "Elementary Probability and Statistics", 3, 2);
INSERT INTO courses(`cid`, `title`, `hours`, `dept_id`) VALUES (7, "Introduction to Database Systems", 3, 1);
INSERT INTO courses(`cid`, `title`, `hours`, `dept_id`) VALUES (8, "Microeconomics", 3, 3);

INSERT INTO users(`uid`, `password`, `last_name`,`first_name`, `dept_id`, `email`) VALUES (1, "password", "Mango", "Christopher", 2, "christopher.m.mango@njit.edu");
INSERT INTO users(`uid`, `password`, `last_name`,`first_name`, `dept_id`, `email`) VALUES (2, "password", "Oria", "Vincent", 1, "vincent.oria@njit.edu");
INSERT INTO users(`uid`, `password`, `last_name`,`first_name`, `dept_id`, `email`) VALUES (3, "password", "Chou", "Porchiung", 3, "porchiung.b.chou@njit.edu");
INSERT INTO users(`uid`, `password`, `last_name`,`first_name`, `dept_id`, `email`) VALUES (4, "password", "Theodoratos", "Dimitrios", 1, "dimitri.theodoratos@njit.edu");
INSERT INTO users(`uid`, `password`, `last_name`,`first_name`, `dept_id`, `email`) VALUES (5, "password", "Baltrush", "Michael", 1, "michael.a.baltrush@njit.edu");
INSERT INTO users(`uid`, `password`, `last_name`,`first_name`, `dept_id`, `email`) VALUES (6, "password", "Curtmola", "Reza", 1, "reza.curtmola@njit.edu");
INSERT INTO users(`uid`, `password`, `last_name`,`first_name`, `dept_id`, `email`) VALUES (7, "password", "Blank", "George", 1, "george.blank@njit.edu");
INSERT INTO users(`uid`, `password`, `last_name`,`first_name`, `dept_id`, `email`) VALUES (8, "password", "Rutowski", "Wallace", 1, "wallace.rutkowski@njit.edu");
INSERT INTO users(`uid`, `password`, `last_name`,`first_name`, `dept_id`, `email`) VALUES (9, "password", "Calvin", "James", 1, "james.m.calvin@njit.edu");
INSERT INTO instructors(`uid`, `office_location`) VALUES (1, "GITC 4208");
INSERT INTO instructors(`uid`, `office_location`) VALUES (2, "GITC 4208");
INSERT INTO instructors(`uid`, `office_location`) VALUES (3, "GITC 4208");
INSERT INTO instructors(`uid`, `office_location`) VALUES (4, "GITC 4208");
INSERT INTO instructors(`uid`, `office_location`) VALUES (5, "GITC 4208");
INSERT INTO instructors(`uid`, `office_location`) VALUES (6, "GITC 4208");
INSERT INTO instructors(`uid`, `office_location`) VALUES (7, "GITC 4208");
INSERT INTO instructors(`uid`, `office_location`) VALUES (8, "GITC 4208");
INSERT INTO instructors(`uid`, `office_location`) VALUES (9, "GITC 4208");

INSERT INTO sections(`term`, `section_no`, `cid`, `inst_id`, `room`, `days`, `time_start`, `time_end`, `capacity`) VALUES ("2014 SPRING", 1, 1, 9, "GITC 2315C\1100", "TR", "11:30:00", "12:30:00", 30);
INSERT INTO sections(`term`, `section_no`, `cid`, `inst_id`, `room`, `days`, `time_start`, `time_end`, `capacity`) VALUES ("2014 SPRING", 1, 2, 5, "CKB 206", "R", "18:00:00", "20:05:00", 30);
INSERT INTO sections(`term`, `section_no`, `cid`, `inst_id`, `room`, `days`, `time_start`, `time_end`, `capacity`) VALUES ("2014 SPRING", 1, 3, 7, "Kupfrian Hall 106", "WF", "13:00:00", "14:25:00", 30);
INSERT INTO sections(`term`, `section_no`, `cid`, `inst_id`, `room`, `days`, `time_start`, `time_end`, `capacity`) VALUES ("2014 SPRING", 1, 4, 6, "CKB 207", "TR", "13:00:00", "14:25:00", 30);
INSERT INTO sections(`term`, `section_no`, `cid`, `inst_id`, `room`, `days`, `time_start`, `time_end`, `capacity`) VALUES ("2014 SPRING", 1, 5, 4, "CKB 215", "W", "10:00:00", "12:55:00", 30);

INSERT INTO users(`uid`, `password`, `last_name`, `first_name`, `dept_id`) VALUES (10, "password", "Cifelli", "Matthew", 1);
INSERT INTO students(`uid`, `class`) VALUES(10, "2015");

INSERT INTO enrollments(`student_id`, `term`, `cid`, `section_no`) VALUES (10, "2014 SPRING", 1, 1);
INSERT INTO enrollments(`student_id`, `term`, `cid`, `section_no`) VALUES (10, "2014 SPRING", 2, 1);
INSERT INTO enrollments(`student_id`, `term`, `cid`, `section_no`) VALUES (10, "2014 SPRING", 3, 1);
INSERT INTO enrollments(`student_id`, `term`, `cid`, `section_no`) VALUES (10, "2014 SPRING", 4, 1);
INSERT INTO enrollments(`student_id`, `term`, `cid`, `section_no`) VALUES (10, "2014 SPRING", 5, 1);