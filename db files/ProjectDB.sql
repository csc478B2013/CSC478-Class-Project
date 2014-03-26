
-- Create database
CREATE DATABASE myuplan;

-- Use your database as the default
USE myuplan;

-- Create tables
CREATE TABLE Student (
  student_id 		BIGINT(19) NOT NULL AUTO_INCREMENT,
  fname 			VARCHAR(255) NOT NULL,
  email 			VARCHAR(255) NOT NULL,
  phone 			VARCHAR(255),
  password 			VARCHAR(255) NOT NULL,
  date_created 		DATETIME,
  PRIMARY KEY  (student_id, email)
);

CREATE TABLE Settings (
  student_id		BIGINT(19) NOT NULL,
  study_tod 		ENUM('Morning', 'Afternoon', 'Evening'),
  st_exam 			INT(11),
  st_quiz 			INT(11),
  st_project 		INT(11),
  st_homework 		INT(11),
  st_discussion 	INT(11),
  st_other 			INT(11),
  PRIMARY KEY  (student_id)
);

CREATE TABLE Semester (
  student_id 		BIGINT(19) NOT NULL,
  semester_id 		BIGINT(19) NOT NULL AUTO_INCREMENT,
  year 				YEAR,
  term				ENUM('Spring', 'Summer', 'Fall'),
  semester_GPA 		DECIMAL(4,3),
  isCurrent 		ENUM('0', '1'),
  PRIMARY KEY  (semester_id)
);

CREATE TABLE Course (
  student_id 		BIGINT(19) NOT NULL,
  semester_id 		BIGINT(19) NOT NULL,
  course_id 		BIGINT(19) NOT NULL AUTO_INCREMENT,
  designation 		VARCHAR(255),
  name				VARCHAR(255),
  credits 			INT(1),
  grade 			VARCHAR(5),
  PRIMARY KEY  (course_id)
);

CREATE TABLE Assignment (
  student_id 		BIGINT(19) NOT NULL,
  semester_id 		BIGINT(19) NOT NULL,
  course_id 		BIGINT(19) NOT NULL,
  assignment_id 	BIGINT(19) NOT NULL AUTO_INCREMENT,
  assignment_type 	ENUM('Exam', 'Quiz', 'Project', 'Homework', 'Discussion', 'Other'),
  name				VARCHAR(255),
  due_date 			DATE,
  studytime 		INT,
  points_allowed 	INT,
  points_received 	INT,
  PRIMARY KEY  (assignment_id)
);


-- Set Constraints
ALTER TABLE Settings ADD CONSTRAINT Settings_fk1 FOREIGN KEY (student_id) REFERENCES Student(student_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Semester ADD CONSTRAINT Semester_fk1 FOREIGN KEY (student_id) REFERENCES Student(student_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Course ADD CONSTRAINT Course_fk1 FOREIGN KEY (student_id) REFERENCES Student(student_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Course ADD CONSTRAINT Course_fk2 FOREIGN KEY (semester_id) REFERENCES Semester(semester_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Assignment ADD CONSTRAINT Assignment_fk1 FOREIGN KEY (student_id) REFERENCES Student(student_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Assignment ADD CONSTRAINT Assignment_fk2 FOREIGN KEY (semester_id) REFERENCES Semester(semester_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Assignment ADD CONSTRAINT Assignment_fk3 FOREIGN KEY (course_id) REFERENCES Course(course_id) ON DELETE CASCADE ON UPDATE CASCADE;

