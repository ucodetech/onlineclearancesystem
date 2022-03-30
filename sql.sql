
ALTER TABLE `userRequestsDepartmentFinal` ADD `school_form` VARCHAR(255) NULL AFTER `user_id`, ADD `admission_letter` VARCHAR(255) NULL AFTER `school_form`, ADD `acceptance_letter` VARCHAR(255) NULL AFTER `admission_letter`, ADD `undertaken_form` VARCHAR(255) NULL AFTER `acceptance_letter`, ADD `state_of_origin` VARCHAR(255) NULL AFTER `undertaken_form`, ADD `jamb_result` VARCHAR(255) NULL AFTER `state_of_origin`, ADD `medical_report` VARCHAR(255) NULL AFTER `jamb_result`, ADD `clearance_form_hod` VARCHAR(255) NULL AFTER `medical_report`, ADD `school_fees_breakdown` VARCHAR(255) NULL AFTER `clearance_form_hod`, ADD `olevel_result` VARCHAR(255) NULL AFTER `school_fees_breakdown`, ADD `birth_certificate` VARCHAR(255) NULL AFTER `olevel_result`, ADD `it_letter` VARCHAR(255) NULL AFTER `birth_certificate`, ADD `nd_result` VARCHAR(255) NULL AFTER `it_letter`, ADD `jamb_admission_letter` VARCHAR(255) NULL AFTER `nd_result`;

create table clearance_requirements (

);
create TABLE finalAdminClearanceCert(

);

create TABLE requireHistory(
  `id` int(11) not null auto_increment PRIMARY key,
  `user_id` int(11)  null,
  `school_form` varchar(200)  null,
  `admission_letter` varchar(200)  null,
  `acceptance_letter` varchar(200)  null,
  `undertaken_form` varchar(200)  null,
  `state_of_origin` varchar(200)  null,
  `jamb_result` varchar(200)  null,
  `medical_report` varchar(200)  null,
  `clearance_form_hod` varchar(200)  null,
  `school_fees_breakdown` varchar(200)  null,
  `olevel_result` varchar(200)  null,
  `birth_certificate` varchar(200)  null,
  `it_letter` varchar(200)  null,
  `nd_result` varchar(200)  null,
  `jamb_admission_letter` varchar(200)  null,
  `course_form` varchar(200)  null,
  `nacoss_and_journal` varchar(200)  null,
  `bio_data_form` varchar(200)  null,
  `deleted` int(11) DEFAULT 0
);
create TABLE requireHistoryDpt(
  `id` int(11) not null auto_increment PRIMARY key,
  `user_id` int(11)  null,
  `school_form` varchar(200)  null,
  `admission_letter` varchar(200)  null,
  `acceptance_letter` varchar(200)  null,
  `undertaken_form` varchar(200)  null,
  `state_of_origin` varchar(200)  null,
  `jamb_result` varchar(200)  null,
  `medical_report` varchar(200)  null,
  `clearance_form_hod` varchar(200)  null,
  `school_fees_breakdown` varchar(200)  null,
  `olevel_result` varchar(200)  null,
  `birth_certificate` varchar(200)  null,
  `it_letter` varchar(200)  null,
  `nd_result` varchar(200)  null,
  `jamb_admission_letter` varchar(200)  null,
  `deleted` int(11) DEFAULT 0
);

create TABLE studentFiles(
  `id` int(11) not null auto_increment PRIMARY key,
  `user_id` int(11) not null,
  `school_form` varchar(200) not null,
  `admission_letter` varchar(200) not null,
  `acceptance_letter` varchar(200) not null,
  `undertaken_form` varchar(200) not null,
  `state_of_origin` varchar(200) not null,
  `jamb_result` varchar(200) not null,
  `medical_report` varchar(200) not null,
  `clearance_form_hod` varchar(200) not null,
  `school_fees_breakdown` varchar(200) not null,
  `olevel_result` varchar(200)  null,
  `birth_certificate` varchar(200) not null,
  `it_letter` varchar(200)  null,
  `nd_result` varchar(200)  null,
  `jamb_admission_letter` varchar(200) not null,
  `course_form` varchar(200)  null,
  `nacoss_and_journal` varchar(200) not null,
  `bio_data_form` varchar(200)  null,
  `deleted` int(11) DEFAULT 0
);

create TABLE userRequestAdmin(
  `id` int(11) not null auto_increment PRIMARY key,
  `user_id` int(11) not null,
  `school_form` varchar(200) not null,
  `admission_letter` varchar(200) not null,
  `acceptance_letter` varchar(200) not null,
  `undertaken_form` varchar(200) not null,
  `state_of_origin` varchar(200) not null,
  `jamb_result` varchar(200) not null,
  `medical_report` varchar(200) not null,
  `clearance_form_hod` varchar(200) not null,
  `school_fees_breakdown` varchar(200) not null,
  `olevel_result` varchar(200)  null,
  `birth_certificate` varchar(200) not null,
  `it_letter` varchar(200)  null,
  `nd_result` varchar(200)  null,
  `jamb_admission_letter` varchar(200) not null,
  `dateRequested` TIMESTAMP not null CURRENT_TIMESTAMP(),
  `pending` int(11) DEFAULT 0,
  `approved` int(11) DEFAULT 0,
  `deleted` int(11) DEFAULT 0
);
create TABLE userRequestsDepartmentFinal(
    `id` int(11) not null auto_increment PRIMARY key,
    `user_id` int(11) not null,
    `school_form` varchar(200) not null,
    `admission_letter` varchar(200) not null,
    `acceptance_letter` varchar(200) not null,
    `undertaken_form` varchar(200) not null,
    `state_of_origin` varchar(200) not null,
    `jamb_result` varchar(200) not null,
    `medical_report` varchar(200) not null,
    `clearance_form_hod` varchar(200) not null,
    `school_fees_breakdown` varchar(200) not null,
    `olevel_result` varchar(200)  null,
    `birth_certificate` varchar(200) not null,
    `it_letter` varchar(200)  null,
    `nd_result` varchar(200)  null,
    `jamb_admission_letter` varchar(200) not null,
    `course_form` varchar(200)  null,
    `nacoss_and_journal` varchar(200) not null,
    `bio_data_form` varchar(200)  null,
    `dateRequested` TIMESTAMP not null CURRENT_TIMESTAMP(),
    `pending` int(11) DEFAULT 0,
    `approved` int(11) DEFAULT 0,
    `deleted` int(11) DEFAULT 0
);
