CREATE DATABASE IF NOT EXISTS mishkat_campus_hub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mishkat_campus_hub;
DROP TABLE IF EXISTS registrations;
DROP TABLE IF EXISTS events;

CREATE TABLE events (
 id INT AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(150) NOT NULL,
 category VARCHAR(80) NOT NULL,
 event_date DATE NOT NULL,
 event_time TIME NOT NULL,
 location VARCHAR(150) NOT NULL,
 short_description VARCHAR(300) NOT NULL,
 full_description TEXT NOT NULL,
 image VARCHAR(180) NOT NULL,
 available_seats INT UNSIGNED NOT NULL DEFAULT 0,
 organizer VARCHAR(150) NOT NULL,
 registration_deadline DATE NOT NULL,
 intended_audience VARCHAR(180) NOT NULL,
 featured TINYINT(1) NOT NULL DEFAULT 0
);
CREATE TABLE registrations (
 id INT AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(120) NOT NULL,
 student_id VARCHAR(20) NOT NULL,
 email VARCHAR(120) NOT NULL,
 phone VARCHAR(20) NOT NULL,
 college VARCHAR(100) NOT NULL,
 academic_level VARCHAR(40) NOT NULL,
 attendance_mode VARCHAR(40) NOT NULL,
 event_id INT NOT NULL,
 registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_mishkat_event FOREIGN KEY (event_id) REFERENCES events(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO events (title,category,event_date,event_time,location,short_description,full_description,image,available_seats,organizer,registration_deadline,intended_audience,featured) VALUES
('Arabic Manuscript Preservation Session','Culture and Archives','2026-08-16','10:00:00','Riyadh Knowledge Archive','A guided introduction to handling and digitally recording Arabic manuscript pages.','Students examine manuscript reproductions and learn why careful handling, condition notes, page numbering, and accurate metadata are important. Each group prepares a simple archive record for one sample page.','images/manuscript-preservation.svg',30,'University Documentation Center','2026-08-14','Students interested in Arabic studies, history, libraries, and digital archiving',1),
('Saudi Geographic Names Research Lab','Research Skills','2026-08-19','13:00:00','Madinah Student Research Room','Students practise researching the spelling, origin, and use of Saudi place names.','The lab introduces source comparison, Arabic and English spelling choices, and accurate research notes. Groups prepare a short record about one selected geographic name.','images/geographic-names.svg',36,'Humanities Research Society','2026-08-17','Geography, history, Arabic language, and research-method students',0),
('Introductory GIS for Community Projects','Geospatial Technology','2026-08-22','09:30:00','Dammam Geospatial Laboratory','A beginner exercise using simple map layers for a fictional community project.','Participants explore points, roads, labels, scale, and service areas in a prepared GIS project and discuss how data accuracy affects planning decisions.','images/community-gis.svg',32,'Geomatics Student Unit','2026-08-20','Engineering, geography, computing, and environmental students',0),
('University Sustainability Report Reading Circle','Environmental Learning','2026-08-25','15:30:00','Main Campus Learning Gallery','A reading circle focused on understanding sustainability indicators and report claims.','Students review fictional report extracts about electricity, water, waste, and transport, identify supporting evidence, and rewrite one finding in clear language.','images/report-reading.svg',40,'Campus Environment Committee','2026-08-23','Students interested in sustainability, reporting, and campus operations',0),
('Student Financial Literacy Clinic','Personal Finance','2026-08-28','12:00:00','Business Skills Classroom','A practical clinic on budgeting, saving, digital payments, and common financial choices.','The clinic uses student scenarios to practise monthly budgeting, comparing payment plans, recognising fees, and planning for irregular expenses. It provides general education only.','images/financial-literacy.svg',48,'College of Business Student Support','2026-08-26','All students, especially those managing a personal budget for the first time',0),
('Voice Recording for Educational Content','Media Skills','2026-08-31','14:00:00','Media Recording Suite','A practical session on recording clear narration for presentations and educational clips.','Students prepare a short script, practise microphone distance, reduce background noise, and compare two recordings for pace, clarity, and academic suitability.','images/voice-recording.svg',28,'Learning Media Team','2026-08-29','Students creating presentations, podcasts, or instructional media',0),
('Inclusive Event Planning Workshop','Student Leadership','2026-09-03','11:00:00','Student Services Meeting Room','Club organisers review practical ways to make student events easier to access.','The workshop covers clear information, room access, seating, dietary notices, registration questions, and respectful communication. Groups improve a fictional event plan.','images/inclusive-planning.svg',38,'Student Programs Coordination Team','2026-09-01','Student club leaders, committee members, and event volunteers',0),
('Date Palm Product Design Session','Design and Agriculture','2026-09-06','10:30:00','Al Ahsa Design Workshop','A creative session exploring useful products connected to date-palm materials.','Students review date-palm by-products, identify a user need, sketch a product idea, and explain its practical and environmental limitations.','images/date-palm-design.svg',34,'Agricultural Innovation Group','2026-09-04','Design, agriculture, engineering, and entrepreneurship students',0),
('Digital Privacy for Student Researchers','Research and Technology','2026-09-09','13:30:00','College of Computing Practice Lab','An introductory session on protecting participant information and research files.','Students discuss data minimisation, strong passwords, access control, safe sharing, and removing identifying details from undergraduate research documents.','images/research-privacy.svg',44,'Information Security Awareness Group','2026-09-07','Students collecting survey, interview, or project data',0),
('Campus Walking Route Evaluation','Health and Campus Planning','2026-09-12','08:00:00','Central Academic Courtyard','Students assess a campus route for shade, signs, seating, crossings, and accessibility.','Participants follow a prepared route, record observations, compare results, and suggest one achievable improvement. Suitable clothing and water are recommended.','images/walking-route.svg',35,'Campus Planning Student Committee','2026-09-10','Students interested in health, design, accessibility, or campus planning',0),
('Saudi Theatre Script Reading','Arts and Culture','2026-09-15','16:00:00','Jeddah Humanities Seminar Hall','A group reading and discussion of a short fictional Saudi theatre scene.','Participants read assigned roles, examine dialogue and character motivation, and discuss how language and setting influence the scene.','images/theatre-reading.svg',50,'University Theatre Circle','2026-09-13','Students interested in literature, theatre, Arabic language, and performance',0),
('Project Documentation with Git','Software Practice','2026-09-18','10:00:00','College of Computing Practice Lab','A beginner workshop on recording project changes and writing useful commit messages.','Students create a local repository, add files, review changes, make commits, and inspect project history using simple commands.','images/git-documentation.svg',30,'Software Development Club','2026-09-16','Computing and information systems students with basic command-line familiarity',0),
('Internship Portfolio Review Desk','Career Development','2026-09-21','12:30:00','Business Skills Classroom','Students receive short feedback on the structure and evidence in an internship portfolio.','Reviewers focus on organisation, concise project explanations, evidence of contribution, and removal of confidential information.','images/portfolio-review.svg',26,'Career Preparation Office','2026-09-19','Students preparing for cooperative training or internship applications',0),
('Healthy Study Routine Planning','Student Wellbeing','2026-09-24','14:30:00','Student Services Meeting Room','A planning activity about study blocks, breaks, sleep, and realistic weekly goals.','Students improve a fictional overloaded schedule and then prepare a balanced weekly plan including study, rest, meals, movement, and flexible time.','images/study-routine.svg',42,'Student Wellbeing Support Team','2026-09-22','All undergraduate students',0),
('Local History Oral Interview Practice','Community Research','2026-09-27','11:30:00','Abha Field Learning Station','A practice session on respectful questions and accurate local-history interview notes.','Students develop open questions, practise requesting consent, and distinguish personal memory from verified history through role-play interviews.','images/oral-history.svg',33,'Local Studies Student Group','2026-09-25','History, media, sociology, tourism, and Arabic language students',0);
