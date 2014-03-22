-- Use myuplan database
USE myuplan;


-- Insert Student
INSERT INTO Student (fname, email, phone, password)
    VALUES ('Stephen', 'sfost3@uis.edu', '(224)856-9089', 'password1');
    
INSERT INTO Student (fname, email, phone, password)
    VALUES ('Joe', 'jjone24@uis.edu', '(916)387-8981', 'password1');

INSERT INTO Student (fname, email, phone, password)
    VALUES ('Bob', 'bharris12@uis.edu', '(916)888-8888', 'password1');


-- Insert Student Settings
INSERT INTO Student_Settings (student_id, study_tod, st_exam, st_quiz, st_project, st_homework, st_discussion, st_other)
    VALUES (1, 'Evening', 1, 2, 3, 4, 5, 6);  
    
INSERT INTO Student_Settings (student_id, study_tod, st_exam, st_quiz, st_project, st_homework, st_discussion, st_other)
    VALUES (2, 'Morning', 6, 5, 4, 3, 2, 1);

INSERT INTO Student_Settings (student_id, study_tod, st_exam, st_quiz, st_project, st_homework, st_discussion, st_other)
    VALUES (3, 'Afternoon', 10, 8, 6, 4, 2, 1);       
    
    
-- Insert Semester (test includes 2 per student)
INSERT INTO Semester (student_id,year, term, start_date, end_date, isCurrent)
    VALUES (1, 2013, 'Fall', '2013-08-01', '2013-12-25', '1');

INSERT INTO Semester (student_id,year, term, start_date, end_date, isCurrent)
    VALUES (1, 2014, 'Spring', '2014-01-01', '2014-05-25', '0');

INSERT INTO Semester (student_id,year, term, start_date, end_date, isCurrent)
    VALUES (2, 2013, 'Fall', '2013-08-01', '2013-12-25', '1');
    
INSERT INTO Semester (student_id,year, term, start_date, end_date, isCurrent)
    VALUES (2, 2014, 'Spring', '2014-01-01', '2014-05-25', '0');

    
-- Insert Course (test includes 2 per semester)   
INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (1, 1, 'CSC 478', 'Software Engineering Capstone', 4);    
  
INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (1, 1, 'CSC 572', 'Advanced Database Concepts', 4);   

INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (1, 2, 'CSC 388', 'Programming Languages', 4);    
  
INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (1, 2, 'CSC 472', 'Intro to Database Concepts', 4); 

INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (2, 3, 'CSC 478', 'Software Engineering Capstone', 4);    
  
INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (2, 3, 'CSC 572', 'Advanced Database Concepts', 4);   

INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (2, 4, 'CSC 388', 'Programming Languages', 4);    
  
INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (2, 4, 'CSC 472', 'Intro to Database Concepts', 4); 

-- TEMP Course Data
INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (1, 1, 'CSC 1', 'Temp 1', 4);    
  
INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (1, 1, 'CSC 2', 'Temp 2', 3);  
	
INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (1, 1, 'CSC 3', 'Temp 3', 2);    
  
INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (1, 1, 'CSC 4', 'Temp 4', 4);  
	
INSERT INTO Course (student_id, semester_id, designation, name, credits)
    VALUES (1, 1, 'CSC 5', 'Temp 5', 4);  
	
    
-- Insert Assignment (1 of each type per semester) 
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 1, 'Exam', 'Final Exam', '2013-08-01', 100, 90);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 1, 'Quiz', 'Week 1 Quiz', '2013-08-02', 100, 80);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 1, 'Project', 'Class Project', '2013-08-03', 100, 70); 


INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 2, 'Exam', 'Final Exam', '2013-08-11', 100, 95);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 2, 'Quiz', 'Week 1 Quiz', '2013-08-12', 100, 85);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 2, 'Project', 'Class Project', '2013-08-13', 100, 75); 


INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 2, 3, 'Homework', 'Week 1 Homework', '2014-01-01', 100, 91); 

INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 2, 3, 'Discussion', 'Week 1 Discussion', '2014-01-02', 100, 81); 

INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 2, 3, 'Other', 'Syllabus Review', '2014-01-03', 100, 71); 


INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 2, 4, 'Homework', 'Week 1 Homework', '2014-01-11', 100, 81); 

INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 2, 4, 'Discussion', 'Week 1 Discussion', '2014-01-12', 100, 71); 

INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 2, 4, 'Other', 'Syllabus Review', '2014-01-13', 100, 61);     
   
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 3, 5, 'Exam', 'Final Exam', '2013-08-01', 100, 100);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 3, 5, 'Quiz', 'Week 1 Quiz', '2013-08-02', 100, 95);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 3, 5, 'Project', 'Class Project', '2013-08-03', 100, 90); 


INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 3, 6, 'Exam', 'Final Exam', '2013-08-11', 100, 100);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 3, 6, 'Quiz', 'Week 1 Quiz', '2013-08-12', 100, 100);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 3, 6, 'Project', 'Class Project', '2013-08-13', 100, 100); 
 

INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 4, 7, 'Homework', 'Week 1 Homework', '2014-01-01', 100, 10); 

INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 4, 7, 'Discussion', 'Week 1 Discussion', '2014-01-02', 100, 20); 

INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 4, 7, 'Other', 'Syllabus Review', '2014-01-03', 100, 30); 


INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 4, 8, 'Homework', 'Week 1 Homework', '2014-01-11', 100, 40); 

INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 4, 8, 'Discussion', 'Week 1 Discussion', '2014-01-12', 100, 50); 

INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 4, 8, 'Other', 'Syllabus Review', '2014-01-13', 100, 60);  
    
-- TEMP Insert Assignment (1 of each type per semester) 
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 9, 'Exam', 'Final Exam', '2013-08-01', 100, 50);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 9, 'Quiz', 'Week 1 Quiz', '2013-08-02', 100, 20);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 9, 'Project', 'Class Project', '2013-08-03', 100, 100);    
   
   
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 10, 'Exam', 'Final Exam', '2013-08-01', 100, 90);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 10, 'Quiz', 'Week 1 Quiz', '2013-08-02', 100, 67);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 10, 'Project', 'Class Project', '2013-08-03', 100, 100);       
	
	
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 11, 'Exam', 'Final Exam', '2013-08-01', 100, 49);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 11, 'Quiz', 'Week 1 Quiz', '2013-08-02', 100, 99);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 11, 'Project', 'Class Project', '2013-08-03', 100, 88);   
	
	
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 12, 'Exam', 'Final Exam', '2013-08-01', 100, 96);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 12, 'Quiz', 'Week 1 Quiz', '2013-08-02', 100, 69);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed, points_recieved)
    VALUES (1, 1, 12, 'Project', 'Class Project', '2013-08-03', 100, 78);   
	
	
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed)
    VALUES (1, 1, 12, 'Exam', 'Final Exam', '2013-08-01', 100);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed)
    VALUES (1, 1, 12, 'Quiz', 'Week 1 Quiz', '2013-08-02', 100);     
    
INSERT INTO Assignment (student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed)
    VALUES (1, 1, 12, 'Project', 'Class Project', '2013-08-03', 100);   