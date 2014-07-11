/*
	Open-School database schematic.
	Author Rajith Ramachandran
     <open-school.org>
	Copyright (c) 2012, wiwo inc.
 */
-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 13, 2012 at 05:45 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `os_new`
--

--
-- Dumping data for table `additional_exams`
--


--
-- Dumping data for table `additional_exam_groups`
--


--
-- Dumping data for table `additional_exam_scores`
--


--
-- Dumping data for table `additional_fields`
--


--
-- Dumping data for table `apply_leaves`
--


--
-- Dumping data for table `archived_employees`
--


--
-- Dumping data for table `archived_employee_additional_details`
--


--
-- Dumping data for table `archived_employee_bank_details`
--


--
-- Dumping data for table `archived_employee_salary_structures`
--


--
-- Dumping data for table `archived_exam_scores`
--


--
-- Dumping data for table `archived_guardians`
--


--
-- Dumping data for table `archived_students`
--


--
-- Dumping data for table `assets`
--


--
-- Dumping data for table `attendances`
--


--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;');

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Accounting.*', 1, NULL, NULL, 'N;'),
('Accounting.Add', 0, NULL, NULL, 'N;'),
('Accounting.Admin', 0, NULL, NULL, 'N;'),
('Accounting.Assesments', 0, NULL, NULL, 'N;'),
('Accounting.Attentance', 0, NULL, NULL, 'N;'),
('Accounting.Batch', 0, NULL, NULL, 'N;'),
('Accounting.Create', 0, NULL, NULL, 'N;'),
('Accounting.Delete', 0, NULL, NULL, 'N;'),
('Accounting.Events', 0, NULL, NULL, 'N;'),
('Accounting.Index', 0, NULL, NULL, 'N;'),
('Accounting.Manage', 0, NULL, NULL, 'N;'),
('Accounting.Savesearch', 0, NULL, NULL, 'N;'),
('Accounting.Update', 0, NULL, NULL, 'N;'),
('Accounting.View', 0, NULL, NULL, 'N;'),
('Accounting.Website', 0, NULL, NULL, 'N;'),
('Admin', 2, NULL, NULL, 'N;'),
('Assesments.*', 1, NULL, NULL, 'N;'),
('Assesments.Add', 0, NULL, NULL, 'N;'),
('Assesments.Admin', 0, NULL, NULL, 'N;'),
('Assesments.Assesments', 0, NULL, NULL, 'N;'),
('Assesments.Attentance', 0, NULL, NULL, 'N;'),
('Assesments.Batch', 0, NULL, NULL, 'N;'),
('Assesments.Create', 0, NULL, NULL, 'N;'),
('Assesments.Delete', 0, NULL, NULL, 'N;'),
('Assesments.Events', 0, NULL, NULL, 'N;'),
('Assesments.Index', 0, NULL, NULL, 'N;'),
('Assesments.Manage', 0, NULL, NULL, 'N;'),
('Assesments.Savesearch', 0, NULL, NULL, 'N;'),
('Assesments.Update', 0, NULL, NULL, 'N;'),
('Assesments.View', 0, NULL, NULL, 'N;'),
('Assesments.Website', 0, NULL, NULL, 'N;'),
('Attendance.Default.*', 1, NULL, NULL, 'N;'),
('Attendance.Default.Index', 0, NULL, NULL, 'N;'),
('Attendances.*', 1, NULL, NULL, 'N;'),
('Attendances.Addnew', 0, NULL, NULL, 'N;'),
('Attendances.Attentance', 0, NULL, NULL, 'N;'),
('Attendances.Index', 0, NULL, NULL, 'N;'),
('Attendances.ReturnForm', 0, NULL, NULL, 'N;'),
('Attendances.ReturnView', 0, NULL, NULL, 'N;'),
('Authenticated', 2, NULL, NULL, 'N;'),
('Cal.Cron.*', 1, NULL, NULL, 'N;'),
('Cal.Cron.Index', 0, NULL, NULL, 'N;'),
('Cal.Main.*', 1, NULL, NULL, 'N;'),
('Cal.Main.Browse', 0, NULL, NULL, 'N;'),
('Cal.Main.CreateHelper', 0, NULL, NULL, 'N;'),
('Cal.Main.List', 0, NULL, NULL, 'N;'),
('Cal.Main.Move', 0, NULL, NULL, 'N;'),
('Cal.Main.RemoveHelper', 0, NULL, NULL, 'N;'),
('Cal.Main.Resize', 0, NULL, NULL, 'N;'),
('Cal.Main.Update', 0, NULL, NULL, 'N;'),
('Cal.Main.Userpreference', 0, NULL, NULL, 'N;'),
('CmsNode.*', 1, NULL, NULL, 'N;'),
('CmsNode.Admin', 0, NULL, NULL, 'N;'),
('CmsNode.Create', 0, NULL, NULL, 'N;'),
('CmsNode.Delete', 0, NULL, NULL, 'N;'),
('CmsNode.Index', 0, NULL, NULL, 'N;'),
('CmsNode.Update', 0, NULL, NULL, 'N;'),
('CmsNode.View', 0, NULL, NULL, 'N;'),
('Configurations.*', 1, NULL, NULL, 'N;'),
('Configurations.Admin', 0, NULL, NULL, 'N;'),
('Configurations.Create', 0, NULL, NULL, 'N;'),
('Configurations.Delete', 0, NULL, NULL, 'N;'),
('Configurations.DisplaySavedImage', 0, NULL, NULL, 'N;'),
('Configurations.Index', 0, NULL, NULL, 'N;'),
('Configurations.Remove', 0, NULL, NULL, 'N;'),
('Configurations.Setup', 0, NULL, NULL, 'N;'),
('Configurations.Update', 0, NULL, NULL, 'N;'),
('Configurations.View', 0, NULL, NULL, 'N;'),
('Countries.*', 1, NULL, NULL, 'N;'),
('Countries.Admin', 0, NULL, NULL, 'N;'),
('Countries.Create', 0, NULL, NULL, 'N;'),
('Countries.Delete', 0, NULL, NULL, 'N;'),
('Countries.Index', 0, NULL, NULL, 'N;'),
('Countries.Update', 0, NULL, NULL, 'N;'),
('Countries.View', 0, NULL, NULL, 'N;'),
('Courses.*', 1, NULL, NULL, 'N;'),
('Courses.Admin', 0, NULL, NULL, 'N;'),
('Courses.Batches.*', 1, NULL, NULL, 'N;'),
('Courses.Batches.Activate', 0, NULL, NULL, 'N;'),
('Courses.Batches.Addnew', 0, NULL, NULL, 'N;'),
('Courses.Batches.Addupdate', 0, NULL, NULL, 'N;'),
('Courses.Batches.Admin', 0, NULL, NULL, 'N;'),
('Courses.Batches.Batchstudents', 0, NULL, NULL, 'N;'),
('Courses.Batches.Create', 0, NULL, NULL, 'N;'),
('Courses.Batches.Deactivate', 0, NULL, NULL, 'N;'),
('Courses.Batches.Delete', 0, NULL, NULL, 'N;'),
('Courses.Batches.Index', 0, NULL, NULL, 'N;'),
('Courses.Batches.Manage', 0, NULL, NULL, 'N;'),
('Courses.Batches.Promote', 0, NULL, NULL, 'N;'),
('Courses.Batches.Remove', 0, NULL, NULL, 'N;'),
('Courses.Batches.Settings', 0, NULL, NULL, 'N;'),
('Courses.Batches.Update', 0, NULL, NULL, 'N;'),
('Courses.Batches.View', 0, NULL, NULL, 'N;'),
('Courses.ClassTiming.*', 1, NULL, NULL, 'N;'),
('Courses.ClassTiming.Index', 0, NULL, NULL, 'N;'),
('Courses.ClassTiming.ReturnForm', 0, NULL, NULL, 'N;'),
('Courses.ClassTiming.ReturnView', 0, NULL, NULL, 'N;'),
('Courses.ClassTimings.*', 1, NULL, NULL, 'N;'),
('Courses.ClassTimings.Addnew', 0, NULL, NULL, 'N;'),
('Courses.ClassTimings.Admin', 0, NULL, NULL, 'N;'),
('Courses.ClassTimings.Create', 0, NULL, NULL, 'N;'),
('Courses.ClassTimings.Delete', 0, NULL, NULL, 'N;'),
('Courses.ClassTimings.Edit', 0, NULL, NULL, 'N;'),
('Courses.ClassTimings.Index', 0, NULL, NULL, 'N;'),
('Courses.ClassTimings.Update', 0, NULL, NULL, 'N;'),
('Courses.ClassTimings.View', 0, NULL, NULL, 'N;'),
('Courses.Courses.*', 1, NULL, NULL, 'N;'),
('Courses.Courses.Admin', 0, NULL, NULL, 'N;'),
('Courses.Courses.Create', 0, NULL, NULL, 'N;'),
('Courses.Courses.Deactivate', 0, NULL, NULL, 'N;'),
('Courses.Courses.Delete', 0, NULL, NULL, 'N;'),
('Courses.Courses.Edit', 0, NULL, NULL, 'N;'),
('Courses.Courses.Index', 0, NULL, NULL, 'N;'),
('Courses.Courses.Managecourse', 0, NULL, NULL, 'N;'),
('Courses.Courses.ReqTest01', 0, NULL, NULL, 'N;'),
('Courses.Courses.Update', 0, NULL, NULL, 'N;'),
('Courses.Courses.View', 0, NULL, NULL, 'N;'),
('Courses.Create', 0, NULL, NULL, 'N;'),
('Courses.Default.*', 1, NULL, NULL, 'N;'),
('Courses.Default.Index', 0, NULL, NULL, 'N;'),
('Courses.Defaultsubjects.*', 1, NULL, NULL, 'N;'),
('Courses.Defaultsubjects.Index', 0, NULL, NULL, 'N;'),
('Courses.Defaultsubjects.ReturnForm', 0, NULL, NULL, 'N;'),
('Courses.Defaultsubjects.ReturnView', 0, NULL, NULL, 'N;'),
('Courses.Delete', 0, NULL, NULL, 'N;'),
('Courses.Edit', 0, NULL, NULL, 'N;'),
('Courses.ElectiveGroups.*', 1, NULL, NULL, 'N;'),
('Courses.ElectiveGroups.Admin', 0, NULL, NULL, 'N;'),
('Courses.ElectiveGroups.Create', 0, NULL, NULL, 'N;'),
('Courses.ElectiveGroups.Delete', 0, NULL, NULL, 'N;'),
('Courses.ElectiveGroups.Index', 0, NULL, NULL, 'N;'),
('Courses.ElectiveGroups.Update', 0, NULL, NULL, 'N;'),
('Courses.ElectiveGroups.View', 0, NULL, NULL, 'N;'),
('Courses.Electives.*', 1, NULL, NULL, 'N;'),
('Courses.Electives.Admin', 0, NULL, NULL, 'N;'),
('Courses.Electives.Create', 0, NULL, NULL, 'N;'),
('Courses.Electives.Delete', 0, NULL, NULL, 'N;'),
('Courses.Electives.Index', 0, NULL, NULL, 'N;'),
('Courses.Electives.Update', 0, NULL, NULL, 'N;'),
('Courses.Electives.View', 0, NULL, NULL, 'N;'),
('Courses.Exam.*', 1, NULL, NULL, 'N;'),
('Courses.Exam.Index', 0, NULL, NULL, 'N;'),
('Courses.Exam.ReturnForm', 0, NULL, NULL, 'N;'),
('Courses.Exam.ReturnView', 0, NULL, NULL, 'N;'),
('Courses.ExamGroups.*', 1, NULL, NULL, 'N;'),
('Courses.ExamGroups.Admin', 0, NULL, NULL, 'N;'),
('Courses.ExamGroups.Create', 0, NULL, NULL, 'N;'),
('Courses.ExamGroups.Delete', 0, NULL, NULL, 'N;'),
('Courses.ExamGroups.Deletenew', 0, NULL, NULL, 'N;'),
('Courses.ExamGroups.Index', 0, NULL, NULL, 'N;'),
('Courses.ExamGroups.Manage', 0, NULL, NULL, 'N;'),
('Courses.ExamGroups.Update', 0, NULL, NULL, 'N;'),
('Courses.ExamGroups.View', 0, NULL, NULL, 'N;'),
('Courses.Exams.*', 1, NULL, NULL, 'N;'),
('Courses.Exams.Admin', 0, NULL, NULL, 'N;'),
('Courses.Exams.Create', 0, NULL, NULL, 'N;'),
('Courses.Exams.Delete', 0, NULL, NULL, 'N;'),
('Courses.Exams.Index', 0, NULL, NULL, 'N;'),
('Courses.Exams.Manage', 0, NULL, NULL, 'N;'),
('Courses.Exams.Update', 0, NULL, NULL, 'N;'),
('Courses.Exams.View', 0, NULL, NULL, 'N;'),
('Courses.ExamScores.*', 1, NULL, NULL, 'N;'),
('Courses.ExamScores.Admin', 0, NULL, NULL, 'N;'),
('Courses.ExamScores.Create', 0, NULL, NULL, 'N;'),
('Courses.ExamScores.Delete', 0, NULL, NULL, 'N;'),
('Courses.ExamScores.Deleteall', 0, NULL, NULL, 'N;'),
('Courses.ExamScores.Index', 0, NULL, NULL, 'N;'),
('Courses.ExamScores.Pdf', 0, NULL, NULL, 'N;'),
('Courses.ExamScores.Update', 0, NULL, NULL, 'N;'),
('Courses.ExamScores.View', 0, NULL, NULL, 'N;'),
('Courses.GradingLevels.*', 1, NULL, NULL, 'N;'),
('Courses.GradingLevels.Default', 0, NULL, NULL, 'N;'),
('Courses.GradingLevels.Index', 0, NULL, NULL, 'N;'),
('Courses.GradingLevels.ReturnForm', 0, NULL, NULL, 'N;'),
('Courses.GradingLevels.ReturnView', 0, NULL, NULL, 'N;'),
('Courses.Index', 0, NULL, NULL, 'N;'),
('Courses.Managecourse', 0, NULL, NULL, 'N;'),
('Courses.ReqTest01', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.*', 1, NULL, NULL, 'N;'),
('Courses.StudentAttentance.Addnew', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.Admin', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.Attentancepdf', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.Attentstud', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.Create', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.Delete', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.Index', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.Pdf', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.Pdf1', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.Studentattendancepdf', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.Update', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.View', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.*', 1, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.Addnew', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.Admin', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.Attentancepdf', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.Attentstud', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.Create', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.Delete', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.Index', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.Pdf', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.Pdf1', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.Update', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentanceC.View', 0, NULL, NULL, 'N;'),
('Courses.Subject.*', 1, NULL, NULL, 'N;'),
('Courses.Subject.Index', 0, NULL, NULL, 'N;'),
('Courses.Subject.ReturnForm', 0, NULL, NULL, 'N;'),
('Courses.Subject.ReturnView', 0, NULL, NULL, 'N;'),
('Courses.SubjectName.*', 1, NULL, NULL, 'N;'),
('Courses.SubjectName.Admin', 0, NULL, NULL, 'N;'),
('Courses.SubjectName.Create', 0, NULL, NULL, 'N;'),
('Courses.SubjectName.Delete', 0, NULL, NULL, 'N;'),
('Courses.SubjectName.Index', 0, NULL, NULL, 'N;'),
('Courses.SubjectName.Update', 0, NULL, NULL, 'N;'),
('Courses.SubjectName.View', 0, NULL, NULL, 'N;'),
('Courses.SubjectNameAjax.*', 1, NULL, NULL, 'N;'),
('Courses.SubjectNameAjax.Index', 0, NULL, NULL, 'N;'),
('Courses.SubjectNameAjax.ReturnForm', 0, NULL, NULL, 'N;'),
('Courses.SubjectNameAjax.ReturnView', 0, NULL, NULL, 'N;'),
('Courses.Subjects.*', 1, NULL, NULL, 'N;'),
('Courses.Subjects.Addnew', 0, NULL, NULL, 'N;'),
('Courses.Subjects.Addnew1', 0, NULL, NULL, 'N;'),
('Courses.Subjects.Admin', 0, NULL, NULL, 'N;'),
('Courses.Subjects.Create', 0, NULL, NULL, 'N;'),
('Courses.Subjects.Delete', 0, NULL, NULL, 'N;'),
('Courses.Subjects.Index', 0, NULL, NULL, 'N;'),
('Courses.Subjects.Subjects', 0, NULL, NULL, 'N;'),
('Courses.Subjects.Update', 0, NULL, NULL, 'N;'),
('Courses.Subjects.View', 0, NULL, NULL, 'N;'),
('Courses.TimetableEntries.*', 1, NULL, NULL, 'N;'),
('Courses.TimetableEntries.Admin', 0, NULL, NULL, 'N;'),
('Courses.TimetableEntries.Create', 0, NULL, NULL, 'N;'),
('Courses.TimetableEntries.Delete', 0, NULL, NULL, 'N;'),
('Courses.TimetableEntries.Dynamiccities', 0, NULL, NULL, 'N;'),
('Courses.TimetableEntries.Index', 0, NULL, NULL, 'N;'),
('Courses.TimetableEntries.Remove', 0, NULL, NULL, 'N;'),
('Courses.TimetableEntries.Settime', 0, NULL, NULL, 'N;'),
('Courses.TimetableEntries.Update', 0, NULL, NULL, 'N;'),
('Courses.TimetableEntries.View', 0, NULL, NULL, 'N;'),
('Courses.Update', 0, NULL, NULL, 'N;'),
('Courses.View', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.*', 1, NULL, NULL, 'N;'),
('Courses.Weekdays.Addnew', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.Admin', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.Batch', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.Create', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.Delete', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.Exportpdf', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.Index', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.Pdf', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.Publish', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.Timetable', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.Update', 0, NULL, NULL, 'N;'),
('Courses.Weekdays.View', 0, NULL, NULL, 'N;'),
('Dashboard.Default.*', 1, NULL, NULL, 'N;'),
('Dashboard.Default.Calendar', 0, NULL, NULL, 'N;'),
('Dashboard.Default.Events', 0, NULL, NULL, 'N;'),
('Dashboard.Default.Index', 0, NULL, NULL, 'N;'),
('ElectiveGroups.*', 1, NULL, NULL, 'N;'),
('ElectiveGroups.Admin', 0, NULL, NULL, 'N;'),
('ElectiveGroups.Create', 0, NULL, NULL, 'N;'),
('ElectiveGroups.Delete', 0, NULL, NULL, 'N;'),
('ElectiveGroups.Index', 0, NULL, NULL, 'N;'),
('ElectiveGroups.Update', 0, NULL, NULL, 'N;'),
('ElectiveGroups.View', 0, NULL, NULL, 'N;'),
('Electives.*', 1, NULL, NULL, 'N;'),
('Electives.Admin', 0, NULL, NULL, 'N;'),
('Electives.Create', 0, NULL, NULL, 'N;'),
('Electives.Delete', 0, NULL, NULL, 'N;'),
('Electives.Index', 0, NULL, NULL, 'N;'),
('Electives.Update', 0, NULL, NULL, 'N;'),
('Electives.View', 0, NULL, NULL, 'N;'),
('Employees.Default.*', 1, NULL, NULL, 'N;'),
('Employees.Default.Index', 0, NULL, NULL, 'N;'),
('Employees.EmployeeAttendances.*', 1, NULL, NULL, 'N;'),
('Employees.EmployeeAttendances.Addnew', 0, NULL, NULL, 'N;'),
('Employees.EmployeeAttendances.Admin', 0, NULL, NULL, 'N;'),
('Employees.EmployeeAttendances.Create', 0, NULL, NULL, 'N;'),
('Employees.EmployeeAttendances.Delete', 0, NULL, NULL, 'N;'),
('Employees.EmployeeAttendances.Index', 0, NULL, NULL, 'N;'),
('Employees.EmployeeAttendances.Pdf', 0, NULL, NULL, 'N;'),
('Employees.EmployeeAttendances.Update', 0, NULL, NULL, 'N;'),
('Employees.EmployeeAttendances.View', 0, NULL, NULL, 'N;'),
('Employees.EmployeeCategories.*', 1, NULL, NULL, 'N;'),
('Employees.EmployeeCategories.Admin', 0, NULL, NULL, 'N;'),
('Employees.EmployeeCategories.Create', 0, NULL, NULL, 'N;'),
('Employees.EmployeeCategories.Delete', 0, NULL, NULL, 'N;'),
('Employees.EmployeeCategories.Index', 0, NULL, NULL, 'N;'),
('Employees.EmployeeCategories.Update', 0, NULL, NULL, 'N;'),
('Employees.EmployeeCategories.View', 0, NULL, NULL, 'N;'),
('Employees.EmployeeDepartments.*', 1, NULL, NULL, 'N;'),
('Employees.EmployeeDepartments.Admin', 0, NULL, NULL, 'N;'),
('Employees.EmployeeDepartments.Create', 0, NULL, NULL, 'N;'),
('Employees.EmployeeDepartments.Delete', 0, NULL, NULL, 'N;'),
('Employees.EmployeeDepartments.Index', 0, NULL, NULL, 'N;'),
('Employees.EmployeeDepartments.Update', 0, NULL, NULL, 'N;'),
('Employees.EmployeeDepartments.View', 0, NULL, NULL, 'N;'),
('Employees.EmployeeGrades.*', 1, NULL, NULL, 'N;'),
('Employees.EmployeeGrades.Admin', 0, NULL, NULL, 'N;'),
('Employees.EmployeeGrades.Create', 0, NULL, NULL, 'N;'),
('Employees.EmployeeGrades.Delete', 0, NULL, NULL, 'N;'),
('Employees.EmployeeGrades.Index', 0, NULL, NULL, 'N;'),
('Employees.EmployeeGrades.Update', 0, NULL, NULL, 'N;'),
('Employees.EmployeeGrades.View', 0, NULL, NULL, 'N;'),
('Employees.EmployeeLeaveTypes.*', 1, NULL, NULL, 'N;'),
('Employees.EmployeeLeaveTypes.Admin', 0, NULL, NULL, 'N;'),
('Employees.EmployeeLeaveTypes.Create', 0, NULL, NULL, 'N;'),
('Employees.EmployeeLeaveTypes.Delete', 0, NULL, NULL, 'N;'),
('Employees.EmployeeLeaveTypes.Index', 0, NULL, NULL, 'N;'),
('Employees.EmployeeLeaveTypes.Update', 0, NULL, NULL, 'N;'),
('Employees.EmployeeLeaveTypes.View', 0, NULL, NULL, 'N;'),
('Employees.EmployeePositions.*', 1, NULL, NULL, 'N;'),
('Employees.EmployeePositions.Admin', 0, NULL, NULL, 'N;'),
('Employees.EmployeePositions.Create', 0, NULL, NULL, 'N;'),
('Employees.EmployeePositions.Delete', 0, NULL, NULL, 'N;'),
('Employees.EmployeePositions.Index', 0, NULL, NULL, 'N;'),
('Employees.EmployeePositions.Update', 0, NULL, NULL, 'N;'),
('Employees.EmployeePositions.View', 0, NULL, NULL, 'N;'),
('Employees.Employees.*', 1, NULL, NULL, 'N;'),
('Employees.Employees.Addinfo', 0, NULL, NULL, 'N;'),
('Employees.Employees.Address', 0, NULL, NULL, 'N;'),
('Employees.Employees.Admin', 0, NULL, NULL, 'N;'),
('Employees.Employees.Contact', 0, NULL, NULL, 'N;'),
('Employees.Employees.Create', 0, NULL, NULL, 'N;'),
('Employees.Employees.Create2', 0, NULL, NULL, 'N;'),
('Employees.Employees.Delete', 0, NULL, NULL, 'N;'),
('Employees.Employees.DisplaySavedImage', 0, NULL, NULL, 'N;'),
('Employees.Employees.Index', 0, NULL, NULL, 'N;'),
('Employees.Employees.Manage', 0, NULL, NULL, 'N;'),
('Employees.Employees.Pdf', 0, NULL, NULL, 'N;'),
('Employees.Employees.Remove', 0, NULL, NULL, 'N;'),
('Employees.Employees.Update', 0, NULL, NULL, 'N;'),
('Employees.Employees.Update2', 0, NULL, NULL, 'N;'),
('Employees.Employees.View', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.*', 1, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.Admin', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.Assign', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.Create', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.Current', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.Delete', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.Deleterow', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.Employee', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.Index', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.Remove', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.Subject', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.Update', 0, NULL, NULL, 'N;'),
('Employees.EmployeesSubjects.View', 0, NULL, NULL, 'N;'),
('Employees.Savedsearches.*', 1, NULL, NULL, 'N;'),
('Employees.Savedsearches.Addnew', 0, NULL, NULL, 'N;'),
('Employees.Savedsearches.Admin', 0, NULL, NULL, 'N;'),
('Employees.Savedsearches.Create', 0, NULL, NULL, 'N;'),
('Employees.Savedsearches.Delete', 0, NULL, NULL, 'N;'),
('Employees.Savedsearches.Index', 0, NULL, NULL, 'N;'),
('Employees.Savedsearches.Update', 0, NULL, NULL, 'N;'),
('Employees.Savedsearches.View', 0, NULL, NULL, 'N;'),
('Events.*', 1, NULL, NULL, 'N;'),
('Events.Index', 0, NULL, NULL, 'N;'),
('Events.ReturnForm', 0, NULL, NULL, 'N;'),
('Events.ReturnView', 0, NULL, NULL, 'N;'),
('Examination.Default.*', 1, NULL, NULL, 'N;'),
('Examination.Default.Index', 0, NULL, NULL, 'N;'),
('Examination.Exam.*', 1, NULL, NULL, 'N;'),
('Examination.Exam.Index', 0, NULL, NULL, 'N;'),
('Examination.Exam.ReturnForm', 0, NULL, NULL, 'N;'),
('Examination.Exam.ReturnView', 0, NULL, NULL, 'N;'),
('Examination.ExamGroups.*', 1, NULL, NULL, 'N;'),
('Examination.ExamGroups.Admin', 0, NULL, NULL, 'N;'),
('Examination.ExamGroups.Create', 0, NULL, NULL, 'N;'),
('Examination.ExamGroups.Delete', 0, NULL, NULL, 'N;'),
('Examination.ExamGroups.Deletenew', 0, NULL, NULL, 'N;'),
('Examination.ExamGroups.Index', 0, NULL, NULL, 'N;'),
('Examination.ExamGroups.Manage', 0, NULL, NULL, 'N;'),
('Examination.ExamGroups.Update', 0, NULL, NULL, 'N;'),
('Examination.ExamGroups.View', 0, NULL, NULL, 'N;'),
('Examination.Exams.*', 1, NULL, NULL, 'N;'),
('Examination.Exams.Admin', 0, NULL, NULL, 'N;'),
('Examination.Exams.Create', 0, NULL, NULL, 'N;'),
('Examination.Exams.Delete', 0, NULL, NULL, 'N;'),
('Examination.Exams.Index', 0, NULL, NULL, 'N;'),
('Examination.Exams.Manage', 0, NULL, NULL, 'N;'),
('Examination.Exams.Update', 0, NULL, NULL, 'N;'),
('Examination.Exams.View', 0, NULL, NULL, 'N;'),
('Examination.ExamScores.*', 1, NULL, NULL, 'N;'),
('Examination.ExamScores.Admin', 0, NULL, NULL, 'N;'),
('Examination.ExamScores.Create', 0, NULL, NULL, 'N;'),
('Examination.ExamScores.Delete', 0, NULL, NULL, 'N;'),
('Examination.ExamScores.Deleteall', 0, NULL, NULL, 'N;'),
('Examination.ExamScores.Index', 0, NULL, NULL, 'N;'),
('Examination.ExamScores.Pdf', 0, NULL, NULL, 'N;'),
('Examination.ExamScores.Update', 0, NULL, NULL, 'N;'),
('Examination.ExamScores.View', 0, NULL, NULL, 'N;'),
('Examination.GradingLevels.*', 1, NULL, NULL, 'N;'),
('Examination.GradingLevels.Default', 0, NULL, NULL, 'N;'),
('Examination.GradingLevels.Index', 0, NULL, NULL, 'N;'),
('Examination.GradingLevels.ReturnForm', 0, NULL, NULL, 'N;'),
('Examination.GradingLevels.ReturnView', 0, NULL, NULL, 'N;'),
('FeeCollectionParticulars.*', 1, NULL, NULL, 'N;'),
('FeeCollectionParticulars.Index', 0, NULL, NULL, 'N;'),
('FeeCollectionParticulars.ReturnForm', 0, NULL, NULL, 'N;'),
('FeeCollectionParticulars.ReturnView', 0, NULL, NULL, 'N;'),
('Fees.Default.*', 1, NULL, NULL, 'N;'),
('Fees.Default.Index', 0, NULL, NULL, 'N;'),
('Fees.FeeCollectionParticulars.*', 1, NULL, NULL, 'N;'),
('Fees.FeeCollectionParticulars.Index', 0, NULL, NULL, 'N;'),
('Fees.FeeCollectionParticulars.ReturnForm', 0, NULL, NULL, 'N;'),
('Fees.FeeCollectionParticulars.ReturnView', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategories.*', 1, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategories.Index', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategories.ReturnForm', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategories.ReturnView', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategoriesCont.*', 1, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategoriesCont.Additionalfees', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategoriesCont.Additionalview', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategoriesCont.Admin', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategoriesCont.Create', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategoriesCont.Delete', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategoriesCont.Index', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategoriesCont.Master', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategoriesCont.Update', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCategoriesCont.View', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCollections.*', 1, NULL, NULL, 'N;'),
('Fees.FinanceFeeCollections.Index', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCollections.ReturnForm', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeCollections.ReturnView', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticulars.*', 1, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticulars.Index', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticulars.ReturnForm', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticulars.ReturnView', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticularsCont.*', 1, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticularsCont.Admin', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticularsCont.Create', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticularsCont.Delete', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticularsCont.Index', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticularsCont.Manage', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticularsCont.Update', 0, NULL, NULL, 'N;'),
('Fees.FinanceFeeParticularsCont.View', 0, NULL, NULL, 'N;'),
('Fees.FinanceFees.*', 1, NULL, NULL, 'N;'),
('Fees.FinanceFees.Admin', 0, NULL, NULL, 'N;'),
('Fees.FinanceFees.Create', 0, NULL, NULL, 'N;'),
('Fees.FinanceFees.Delete', 0, NULL, NULL, 'N;'),
('Fees.FinanceFees.Index', 0, NULL, NULL, 'N;'),
('Fees.FinanceFees.Payfees', 0, NULL, NULL, 'N;'),
('Fees.FinanceFees.Update', 0, NULL, NULL, 'N;'),
('Fees.FinanceFees.View', 0, NULL, NULL, 'N;'),
('FinanceFeeCategories.*', 1, NULL, NULL, 'N;'),
('FinanceFeeCategories.Index', 0, NULL, NULL, 'N;'),
('FinanceFeeCategories.ReturnForm', 0, NULL, NULL, 'N;'),
('FinanceFeeCategories.ReturnView', 0, NULL, NULL, 'N;'),
('FinanceFeeCategoriesCont.*', 1, NULL, NULL, 'N;'),
('FinanceFeeCategoriesCont.Additionalfees', 0, NULL, NULL, 'N;'),
('FinanceFeeCategoriesCont.Additionalview', 0, NULL, NULL, 'N;'),
('FinanceFeeCategoriesCont.Admin', 0, NULL, NULL, 'N;'),
('FinanceFeeCategoriesCont.Create', 0, NULL, NULL, 'N;'),
('FinanceFeeCategoriesCont.Delete', 0, NULL, NULL, 'N;'),
('FinanceFeeCategoriesCont.Index', 0, NULL, NULL, 'N;'),
('FinanceFeeCategoriesCont.Master', 0, NULL, NULL, 'N;'),
('FinanceFeeCategoriesCont.Update', 0, NULL, NULL, 'N;'),
('FinanceFeeCategoriesCont.View', 0, NULL, NULL, 'N;'),
('FinanceFeeCollections.*', 1, NULL, NULL, 'N;'),
('FinanceFeeCollections.Index', 0, NULL, NULL, 'N;'),
('FinanceFeeCollections.ReturnForm', 0, NULL, NULL, 'N;'),
('FinanceFeeCollections.ReturnView', 0, NULL, NULL, 'N;'),
('FinanceFeeParticulars.*', 1, NULL, NULL, 'N;'),
('FinanceFeeParticulars.Index', 0, NULL, NULL, 'N;'),
('FinanceFeeParticulars.ReturnForm', 0, NULL, NULL, 'N;'),
('FinanceFeeParticulars.ReturnView', 0, NULL, NULL, 'N;'),
('FinanceFeeParticularsCont.*', 1, NULL, NULL, 'N;'),
('FinanceFeeParticularsCont.Admin', 0, NULL, NULL, 'N;'),
('FinanceFeeParticularsCont.Create', 0, NULL, NULL, 'N;'),
('FinanceFeeParticularsCont.Delete', 0, NULL, NULL, 'N;'),
('FinanceFeeParticularsCont.Index', 0, NULL, NULL, 'N;'),
('FinanceFeeParticularsCont.Manage', 0, NULL, NULL, 'N;'),
('FinanceFeeParticularsCont.Update', 0, NULL, NULL, 'N;'),
('FinanceFeeParticularsCont.View', 0, NULL, NULL, 'N;'),
('FinanceFees.*', 1, NULL, NULL, 'N;'),
('FinanceFees.Admin', 0, NULL, NULL, 'N;'),
('FinanceFees.Create', 0, NULL, NULL, 'N;'),
('FinanceFees.Delete', 0, NULL, NULL, 'N;'),
('FinanceFees.Index', 0, NULL, NULL, 'N;'),
('FinanceFees.Payfees', 0, NULL, NULL, 'N;'),
('FinanceFees.Update', 0, NULL, NULL, 'N;'),
('FinanceFees.View', 0, NULL, NULL, 'N;'),
('Guest', 2, NULL, NULL, 'N;'),
('Hostel.Allotment.*', 1, NULL, NULL, 'N;'),
('Hostel.Allotment.Admin', 0, NULL, NULL, 'N;'),
('Hostel.Allotment.Alloterror', 0, NULL, NULL, 'N;'),
('Hostel.Allotment.Create', 0, NULL, NULL, 'N;'),
('Hostel.Allotment.Delete', 0, NULL, NULL, 'N;'),
('Hostel.Allotment.Index', 0, NULL, NULL, 'N;'),
('Hostel.Allotment.Roominfo', 0, NULL, NULL, 'N;'),
('Hostel.Allotment.Update', 0, NULL, NULL, 'N;'),
('Hostel.Allotment.View', 0, NULL, NULL, 'N;'),
('Hostel.Default.*', 1, NULL, NULL, 'N;'),
('Hostel.Default.Index', 0, NULL, NULL, 'N;'),
('Hostel.Floor.*', 1, NULL, NULL, 'N;'),
('Hostel.Floor.Admin', 0, NULL, NULL, 'N;'),
('Hostel.Floor.Create', 0, NULL, NULL, 'N;'),
('Hostel.Floor.Delete', 0, NULL, NULL, 'N;'),
('Hostel.Floor.Index', 0, NULL, NULL, 'N;'),
('Hostel.Floor.Update', 0, NULL, NULL, 'N;'),
('Hostel.Floor.View', 0, NULL, NULL, 'N;'),
('Hostel.FoodInfo.*', 1, NULL, NULL, 'N;'),
('Hostel.FoodInfo.Admin', 0, NULL, NULL, 'N;'),
('Hostel.FoodInfo.Create', 0, NULL, NULL, 'N;'),
('Hostel.FoodInfo.Delete', 0, NULL, NULL, 'N;'),
('Hostel.FoodInfo.Index', 0, NULL, NULL, 'N;'),
('Hostel.FoodInfo.Update', 0, NULL, NULL, 'N;'),
('Hostel.FoodInfo.View', 0, NULL, NULL, 'N;'),
('Hostel.Hosteldetails.*', 1, NULL, NULL, 'N;'),
('Hostel.Hosteldetails.Admin', 0, NULL, NULL, 'N;'),
('Hostel.Hosteldetails.Create', 0, NULL, NULL, 'N;'),
('Hostel.Hosteldetails.Delete', 0, NULL, NULL, 'N;'),
('Hostel.Hosteldetails.Index', 0, NULL, NULL, 'N;'),
('Hostel.Hosteldetails.Update', 0, NULL, NULL, 'N;'),
('Hostel.Hosteldetails.View', 0, NULL, NULL, 'N;'),
('Hostel.MessFee.*', 1, NULL, NULL, 'N;'),
('Hostel.MessFee.Admin', 0, NULL, NULL, 'N;'),
('Hostel.MessFee.Create', 0, NULL, NULL, 'N;'),
('Hostel.MessFee.Delete', 0, NULL, NULL, 'N;'),
('Hostel.MessFee.Index', 0, NULL, NULL, 'N;'),
('Hostel.MessFee.Update', 0, NULL, NULL, 'N;'),
('Hostel.MessFee.View', 0, NULL, NULL, 'N;'),
('Hostel.MessManage.*', 1, NULL, NULL, 'N;'),
('Hostel.MessManage.Admin', 0, NULL, NULL, 'N;'),
('Hostel.MessManage.Create', 0, NULL, NULL, 'N;'),
('Hostel.MessManage.Delete', 0, NULL, NULL, 'N;'),
('Hostel.MessManage.Index', 0, NULL, NULL, 'N;'),
('Hostel.MessManage.Manage', 0, NULL, NULL, 'N;'),
('Hostel.MessManage.MessDetails', 0, NULL, NULL, 'N;'),
('Hostel.MessManage.MessInfo', 0, NULL, NULL, 'N;'),
('Hostel.MessManage.Payfees', 0, NULL, NULL, 'N;'),
('Hostel.MessManage.Update', 0, NULL, NULL, 'N;'),
('Hostel.MessManage.View', 0, NULL, NULL, 'N;'),
('Hostel.Registration.*', 1, NULL, NULL, 'N;'),
('Hostel.Registration.Admin', 0, NULL, NULL, 'N;'),
('Hostel.Registration.Autocomplete', 0, NULL, NULL, 'N;'),
('Hostel.Registration.Create', 0, NULL, NULL, 'N;'),
('Hostel.Registration.Delete', 0, NULL, NULL, 'N;'),
('Hostel.Registration.Index', 0, NULL, NULL, 'N;'),
('Hostel.Registration.Update', 0, NULL, NULL, 'N;'),
('Hostel.Registration.View', 0, NULL, NULL, 'N;'),
('Hostel.Room.*', 1, NULL, NULL, 'N;'),
('Hostel.Room.Admin', 0, NULL, NULL, 'N;'),
('Hostel.Room.Allot', 0, NULL, NULL, 'N;'),
('Hostel.Room.Autocomplete', 0, NULL, NULL, 'N;'),
('Hostel.Room.Change', 0, NULL, NULL, 'N;'),
('Hostel.Room.Create', 0, NULL, NULL, 'N;'),
('Hostel.Room.Delete', 0, NULL, NULL, 'N;'),
('Hostel.Room.Error', 0, NULL, NULL, 'N;'),
('Hostel.Room.Index', 0, NULL, NULL, 'N;'),
('Hostel.Room.Manage', 0, NULL, NULL, 'N;'),
('Hostel.Room.Roomchange', 0, NULL, NULL, 'N;'),
('Hostel.Room.Roomlist', 0, NULL, NULL, 'N;'),
('Hostel.Room.Roomrequest', 0, NULL, NULL, 'N;'),
('Hostel.Room.Roomsearch', 0, NULL, NULL, 'N;'),
('Hostel.Room.Update', 0, NULL, NULL, 'N;'),
('Hostel.Room.View', 0, NULL, NULL, 'N;'),
('Hostel.RoomDetails.*', 1, NULL, NULL, 'N;'),
('Hostel.RoomDetails.Admin', 0, NULL, NULL, 'N;'),
('Hostel.RoomDetails.Create', 0, NULL, NULL, 'N;'),
('Hostel.RoomDetails.Delete', 0, NULL, NULL, 'N;'),
('Hostel.RoomDetails.Index', 0, NULL, NULL, 'N;'),
('Hostel.RoomDetails.Manage', 0, NULL, NULL, 'N;'),
('Hostel.RoomDetails.Update', 0, NULL, NULL, 'N;'),
('Hostel.RoomDetails.View', 0, NULL, NULL, 'N;'),
('Hostel.Roomrequest.*', 1, NULL, NULL, 'N;'),
('Hostel.Roomrequest.Admin', 0, NULL, NULL, 'N;'),
('Hostel.Roomrequest.Create', 0, NULL, NULL, 'N;'),
('Hostel.Roomrequest.Delete', 0, NULL, NULL, 'N;'),
('Hostel.Roomrequest.Index', 0, NULL, NULL, 'N;'),
('Hostel.Roomrequest.Update', 0, NULL, NULL, 'N;'),
('Hostel.Roomrequest.View', 0, NULL, NULL, 'N;'),
('Hostel.Settings.*', 1, NULL, NULL, 'N;'),
('Hostel.Settings.Admin', 0, NULL, NULL, 'N;'),
('Hostel.Settings.Create', 0, NULL, NULL, 'N;'),
('Hostel.Settings.Delete', 0, NULL, NULL, 'N;'),
('Hostel.Settings.Index', 0, NULL, NULL, 'N;'),
('Hostel.Settings.Notifications', 0, NULL, NULL, 'N;'),
('Hostel.Settings.Remind', 0, NULL, NULL, 'N;'),
('Hostel.Settings.Settings', 0, NULL, NULL, 'N;'),
('Hostel.Settings.Update', 0, NULL, NULL, 'N;'),
('Hostel.Settings.View', 0, NULL, NULL, 'N;'),
('Hostel.Vacate.*', 1, NULL, NULL, 'N;'),
('Hostel.Vacate.Admin', 0, NULL, NULL, 'N;'),
('Hostel.Vacate.Autocomplete', 0, NULL, NULL, 'N;'),
('Hostel.Vacate.Create', 0, NULL, NULL, 'N;'),
('Hostel.Vacate.Delete', 0, NULL, NULL, 'N;'),
('Hostel.Vacate.Index', 0, NULL, NULL, 'N;'),
('Hostel.Vacate.Roomvacate', 0, NULL, NULL, 'N;'),
('Hostel.Vacate.Update', 0, NULL, NULL, 'N;'),
('Hostel.Vacate.View', 0, NULL, NULL, 'N;'),
('Install.Default.*', 1, NULL, NULL, 'N;'),
('Install.Default.DownloadEnvironment', 0, NULL, NULL, 'N;'),
('Install.Default.Htaccess', 0, NULL, NULL, 'N;'),
('Install.Default.Index', 0, NULL, NULL, 'N;'),
('Install.Default.Step1', 0, NULL, NULL, 'N;'),
('Install.Default.Step2', 0, NULL, NULL, 'N;'),
('Install.Default.Step3', 0, NULL, NULL, 'N;'),
('Install.Default.Step4', 0, NULL, NULL, 'N;'),
('Install.Default.Step44', 0, NULL, NULL, 'N;'),
('Install.Default.Step5', 0, NULL, NULL, 'N;'),
('Leads.*', 1, NULL, NULL, 'N;'),
('Leads.Add', 0, NULL, NULL, 'N;'),
('Leads.Admin', 0, NULL, NULL, 'N;'),
('Leads.Assesments', 0, NULL, NULL, 'N;'),
('Leads.Attentance', 0, NULL, NULL, 'N;'),
('Leads.Batch', 0, NULL, NULL, 'N;'),
('Leads.Create', 0, NULL, NULL, 'N;'),
('Leads.Delete', 0, NULL, NULL, 'N;'),
('Leads.Events', 0, NULL, NULL, 'N;'),
('Leads.Index', 0, NULL, NULL, 'N;'),
('Leads.Manage', 0, NULL, NULL, 'N;'),
('Leads.Savesearch', 0, NULL, NULL, 'N;'),
('Leads.Update', 0, NULL, NULL, 'N;'),
('Leads.View', 0, NULL, NULL, 'N;'),
('Leads.Website', 0, NULL, NULL, 'N;'),
('library', 2, 'library manager', NULL, 'N;'),
('Library.Authors.*', 1, NULL, NULL, 'N;'),
('Library.Authors.Authordetails', 0, NULL, NULL, 'N;'),
('Library.Authors.Index', 0, NULL, NULL, 'N;'),
('Library.Authors.ReturnForm', 0, NULL, NULL, 'N;'),
('Library.Authors.ReturnView', 0, NULL, NULL, 'N;'),
('Library.Book.*', 1, NULL, NULL, 'N;'),
('Library.Book.Admin', 0, NULL, NULL, 'N;'),
('Library.Book.Allbooks', 0, NULL, NULL, 'N;'),
('Library.Book.Autocomplete', 0, NULL, NULL, 'N;'),
('Library.Book.Autocomplete1', 0, NULL, NULL, 'N;'),
('Library.Book.Bookdetails', 0, NULL, NULL, 'N;'),
('Library.Book.Booklist', 0, NULL, NULL, 'N;'),
('Library.Book.BookSearch', 0, NULL, NULL, 'N;'),
('Library.Book.Create', 0, NULL, NULL, 'N;'),
('Library.Book.Delete', 0, NULL, NULL, 'N;'),
('Library.Book.Index', 0, NULL, NULL, 'N;'),
('Library.Book.Manage', 0, NULL, NULL, 'N;'),
('Library.Book.Subjects', 0, NULL, NULL, 'N;'),
('Library.Book.Update', 0, NULL, NULL, 'N;'),
('Library.Book.View', 0, NULL, NULL, 'N;'),
('Library.BookFine.*', 1, NULL, NULL, 'N;'),
('Library.BookFine.Admin', 0, NULL, NULL, 'N;'),
('Library.BookFine.Create', 0, NULL, NULL, 'N;'),
('Library.BookFine.Delete', 0, NULL, NULL, 'N;'),
('Library.BookFine.Index', 0, NULL, NULL, 'N;'),
('Library.BookFine.Update', 0, NULL, NULL, 'N;'),
('Library.BookFine.View', 0, NULL, NULL, 'N;'),
('Library.BorrowBook.*', 1, NULL, NULL, 'N;'),
('Library.BorrowBook.Admin', 0, NULL, NULL, 'N;'),
('Library.BorrowBook.Autocomplete', 0, NULL, NULL, 'N;'),
('Library.BorrowBook.Create', 0, NULL, NULL, 'N;'),
('Library.BorrowBook.Delete', 0, NULL, NULL, 'N;'),
('Library.BorrowBook.Error', 0, NULL, NULL, 'N;'),
('Library.BorrowBook.Index', 0, NULL, NULL, 'N;'),
('Library.BorrowBook.ListBook', 0, NULL, NULL, 'N;'),
('Library.BorrowBook.Remind', 0, NULL, NULL, 'N;'),
('Library.BorrowBook.Studentdetails', 0, NULL, NULL, 'N;'),
('Library.BorrowBook.Update', 0, NULL, NULL, 'N;'),
('Library.BorrowBook.View', 0, NULL, NULL, 'N;'),
('Library.Category.*', 1, NULL, NULL, 'N;'),
('Library.Category.Admin', 0, NULL, NULL, 'N;'),
('Library.Category.Create', 0, NULL, NULL, 'N;'),
('Library.Category.Delete', 0, NULL, NULL, 'N;'),
('Library.Category.Index', 0, NULL, NULL, 'N;'),
('Library.Category.Update', 0, NULL, NULL, 'N;'),
('Library.Category.View', 0, NULL, NULL, 'N;'),
('Library.Default.*', 1, NULL, NULL, 'N;'),
('Library.Default.Index', 0, NULL, NULL, 'N;'),
('Library.Publication.*', 1, NULL, NULL, 'N;'),
('Library.Publication.Admin', 0, NULL, NULL, 'N;'),
('Library.Publication.Create', 0, NULL, NULL, 'N;'),
('Library.Publication.Delete', 0, NULL, NULL, 'N;'),
('Library.Publication.Index', 0, NULL, NULL, 'N;'),
('Library.Publication.Update', 0, NULL, NULL, 'N;'),
('Library.Publication.View', 0, NULL, NULL, 'N;'),
('Library.ReturnBook.*', 1, NULL, NULL, 'N;'),
('Library.ReturnBook.Admin', 0, NULL, NULL, 'N;'),
('Library.ReturnBook.Create', 0, NULL, NULL, 'N;'),
('Library.ReturnBook.Delete', 0, NULL, NULL, 'N;'),
('Library.ReturnBook.Index', 0, NULL, NULL, 'N;'),
('Library.ReturnBook.Returnbook', 0, NULL, NULL, 'N;'),
('Library.ReturnBook.Update', 0, NULL, NULL, 'N;'),
('Library.ReturnBook.View', 0, NULL, NULL, 'N;'),
('Library.Settings.*', 1, NULL, NULL, 'N;'),
('Library.Settings.Admin', 0, NULL, NULL, 'N;'),
('Library.Settings.Create', 0, NULL, NULL, 'N;'),
('Library.Settings.Delete', 0, NULL, NULL, 'N;'),
('Library.Settings.Index', 0, NULL, NULL, 'N;'),
('Library.Settings.Remind', 0, NULL, NULL, 'N;'),
('Library.Settings.Settings', 0, NULL, NULL, 'N;'),
('Library.Settings.Update', 0, NULL, NULL, 'N;'),
('Library.Settings.View', 0, NULL, NULL, 'N;'),
('Mailbox.Ajax.*', 1, NULL, NULL, 'N;'),
('Mailbox.Ajax.Auto', 0, NULL, NULL, 'N;'),
('Mailbox.Default.*', 1, NULL, NULL, 'N;'),
('Mailbox.Default.Index', 0, NULL, NULL, 'N;'),
('Mailbox.Groups.*', 1, NULL, NULL, 'N;'),
('Mailbox.Groups.Admin', 0, NULL, NULL, 'N;'),
('Mailbox.Groups.Create', 0, NULL, NULL, 'N;'),
('Mailbox.Groups.Delete', 0, NULL, NULL, 'N;'),
('Mailbox.Groups.Index', 0, NULL, NULL, 'N;'),
('Mailbox.Groups.Message', 0, NULL, NULL, 'N;'),
('Mailbox.Groups.Messagedetails', 0, NULL, NULL, 'N;'),
('Mailbox.Groups.Update', 0, NULL, NULL, 'N;'),
('Mailbox.Groups.View', 0, NULL, NULL, 'N;'),
('Mailbox.Message.*', 1, NULL, NULL, 'N;'),
('Mailbox.Message.Admin', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Create', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Data', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Ddel', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Del', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Delete', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Fdel', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Folder', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Forward', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Inbox', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Index', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Message', 0, NULL, NULL, 'N;'),
('Mailbox.Message.New', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Reply', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Sdel', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Sent', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Sentitems', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Sentmessage', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Star', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Stardel', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Starred', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Trash', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Unstar', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Update', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Ustar', 0, NULL, NULL, 'N;'),
('Mailbox.Message.View', 0, NULL, NULL, 'N;'),
('Mailbox.News.*', 1, NULL, NULL, 'N;'),
('Mailbox.News.Index', 0, NULL, NULL, 'N;'),
('Mailbox.News.Info', 0, NULL, NULL, 'N;'),
('Mailbox.User.*', 1, NULL, NULL, 'N;'),
('Mailbox.User.Admin', 0, NULL, NULL, 'N;'),
('Mailbox.User.Create', 0, NULL, NULL, 'N;'),
('Mailbox.User.Data', 0, NULL, NULL, 'N;'),
('Mailbox.User.Delete', 0, NULL, NULL, 'N;'),
('Mailbox.User.Draft', 0, NULL, NULL, 'N;'),
('Mailbox.User.Events', 0, NULL, NULL, 'N;'),
('Mailbox.User.Folder', 0, NULL, NULL, 'N;'),
('Mailbox.User.Folders', 0, NULL, NULL, 'N;'),
('Mailbox.User.Forward', 0, NULL, NULL, 'N;'),
('Mailbox.User.Inbox', 0, NULL, NULL, 'N;'),
('Mailbox.User.Inboxbottom', 0, NULL, NULL, 'N;'),
('Mailbox.User.Inboxmessage', 0, NULL, NULL, 'N;'),
('Mailbox.User.Inboxtask', 0, NULL, NULL, 'N;'),
('Mailbox.User.Index', 0, NULL, NULL, 'N;'),
('Mailbox.User.Patientprofile', 0, NULL, NULL, 'N;'),
('Mailbox.User.Sentitems', 0, NULL, NULL, 'N;'),
('Mailbox.User.Star', 0, NULL, NULL, 'N;'),
('Mailbox.User.Taskdetails', 0, NULL, NULL, 'N;'),
('Mailbox.User.Update', 0, NULL, NULL, 'N;'),
('Mailbox.User.View', 0, NULL, NULL, 'N;'),
('Mailbox.Userfolder.*', 1, NULL, NULL, 'N;'),
('Mailbox.Userfolder.Admin', 0, NULL, NULL, 'N;'),
('Mailbox.Userfolder.Create', 0, NULL, NULL, 'N;'),
('Mailbox.Userfolder.Delete', 0, NULL, NULL, 'N;'),
('Mailbox.Userfolder.Index', 0, NULL, NULL, 'N;'),
('Mailbox.Userfolder.Update', 0, NULL, NULL, 'N;'),
('Mailbox.Userfolder.View', 0, NULL, NULL, 'N;'),
('Mailbox_.Default.*', 1, NULL, NULL, 'N;'),
('Mailbox_.Default.Index', 0, NULL, NULL, 'N;'),
('Mailbox_.Groups.*', 1, NULL, NULL, 'N;'),
('Mailbox_.Groups.Admin', 0, NULL, NULL, 'N;'),
('Mailbox_.Groups.Create', 0, NULL, NULL, 'N;'),
('Mailbox_.Groups.Delete', 0, NULL, NULL, 'N;'),
('Mailbox_.Groups.Index', 0, NULL, NULL, 'N;'),
('Mailbox_.Groups.Message', 0, NULL, NULL, 'N;'),
('Mailbox_.Groups.Messagedetails', 0, NULL, NULL, 'N;'),
('Mailbox_.Groups.Update', 0, NULL, NULL, 'N;'),
('Mailbox_.Groups.View', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.*', 1, NULL, NULL, 'N;'),
('Mailbox_.Message.Admin', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Create', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Data', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Ddel', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Del', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Delete', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Fdel', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Folder', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Forward', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Index', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Message', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Reply', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Sdel', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Sentitems', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Sentmessage', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Star', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Stardel', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Starred', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Unstar', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Update', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.Ustar', 0, NULL, NULL, 'N;'),
('Mailbox_.Message.View', 0, NULL, NULL, 'N;'),
('Mailbox_.User.*', 1, NULL, NULL, 'N;'),
('Mailbox_.User.Admin', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Create', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Data', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Delete', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Draft', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Events', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Folder', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Folders', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Forward', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Inbox', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Inboxbottom', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Inboxmessage', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Inboxtask', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Index', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Patientprofile', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Sentitems', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Star', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Taskdetails', 0, NULL, NULL, 'N;'),
('Mailbox_.User.Update', 0, NULL, NULL, 'N;'),
('Mailbox_.User.View', 0, NULL, NULL, 'N;'),
('Mailbox_.Userfolder.*', 1, NULL, NULL, 'N;'),
('Mailbox_.Userfolder.Admin', 0, NULL, NULL, 'N;'),
('Mailbox_.Userfolder.Create', 0, NULL, NULL, 'N;'),
('Mailbox_.Userfolder.Delete', 0, NULL, NULL, 'N;'),
('Mailbox_.Userfolder.Index', 0, NULL, NULL, 'N;'),
('Mailbox_.Userfolder.Update', 0, NULL, NULL, 'N;'),
('Mailbox_.Userfolder.View', 0, NULL, NULL, 'N;'),
('Messages.Compose.*', 1, NULL, NULL, 'N;'),
('Messages.Compose.Compose', 0, NULL, NULL, 'N;'),
('Messages.Delete.*', 1, NULL, NULL, 'N;'),
('Messages.Delete.Delete', 0, NULL, NULL, 'N;'),
('Messages.Inbox.*', 1, NULL, NULL, 'N;'),
('Messages.Inbox.Inbox', 0, NULL, NULL, 'N;'),
('Messages.Index.*', 1, NULL, NULL, 'N;'),
('Messages.Index.Index', 0, NULL, NULL, 'N;'),
('Messages.Sent.*', 1, NULL, NULL, 'N;'),
('Messages.Sent.Sent', 0, NULL, NULL, 'N;'),
('Messages.Suggest.*', 1, NULL, NULL, 'N;'),
('Messages.Suggest.User', 0, NULL, NULL, 'N;'),
('Messages.View.*', 1, NULL, NULL, 'N;'),
('Messages.View.View', 0, NULL, NULL, 'N;'),
('parent', 2, 'For parent Portal', NULL, 'N;'),
('Parentportal.Default.*', 1, NULL, NULL, 'N;'),
('Parentportal.Default.Attendance', 0, NULL, NULL, 'N;'),
('Parentportal.Default.Attendance1', 0, NULL, NULL, 'N;'),
('Parentportal.Default.Events', 0, NULL, NULL, 'N;'),
('Parentportal.Default.Exams', 0, NULL, NULL, 'N;'),
('Parentportal.Default.Fees', 0, NULL, NULL, 'N;'),
('Parentportal.Default.Index', 0, NULL, NULL, 'N;'),
('Parentportal.Default.Leftside', 0, NULL, NULL, 'N;'),
('Parentportal.Default.Messages', 0, NULL, NULL, 'N;'),
('Parentportal.Default.Newmessage', 0, NULL, NULL, 'N;'),
('Parentportal.Default.Profile', 0, NULL, NULL, 'N;'),
('Parentportal.Default.Reports', 0, NULL, NULL, 'N;'),
('Parentportal.Default.Viewmessage', 0, NULL, NULL, 'N;'),
('Report.Default.*', 1, NULL, NULL, 'N;'),
('Report.Default.Advancedreport', 0, NULL, NULL, 'N;'),
('Report.Default.Assessment', 0, NULL, NULL, 'N;'),
('Report.Default.Batch', 0, NULL, NULL, 'N;'),
('Report.Default.Batchname', 0, NULL, NULL, 'N;'),
('Report.Default.Employeeattendance', 0, NULL, NULL, 'N;'),
('Report.Default.Index', 0, NULL, NULL, 'N;'),
('Report.Default.Studentattendance', 0, NULL, NULL, 'N;'),
('Report.Default.Studentexam', 0, NULL, NULL, 'N;'),
('Reports.*', 1, NULL, NULL, 'N;'),
('Reports.Add', 0, NULL, NULL, 'N;'),
('Reports.Admin', 0, NULL, NULL, 'N;'),
('Reports.Assesments', 0, NULL, NULL, 'N;'),
('Reports.Attentance', 0, NULL, NULL, 'N;'),
('Reports.Batch', 0, NULL, NULL, 'N;'),
('Reports.Create', 0, NULL, NULL, 'N;'),
('Reports.Delete', 0, NULL, NULL, 'N;'),
('Reports.Events', 0, NULL, NULL, 'N;'),
('Reports.Index', 0, NULL, NULL, 'N;'),
('Reports.Manage', 0, NULL, NULL, 'N;'),
('Reports.Savesearch', 0, NULL, NULL, 'N;'),
('Reports.Update', 0, NULL, NULL, 'N;'),
('Reports.View', 0, NULL, NULL, 'N;'),
('Reports.Website', 0, NULL, NULL, 'N;'),
('Rights1.Assignment.*', 1, NULL, NULL, 'N;'),
('Rights1.Assignment.Revoke', 0, NULL, NULL, 'N;'),
('Rights1.Assignment.User', 0, NULL, NULL, 'N;'),
('Rights1.Assignment.View', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.*', 1, NULL, NULL, 'N;'),
('Rights1.AuthItem.Assign', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.Create', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.Delete', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.Generate', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.Operations', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.Permissions', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.RemoveChild', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.Revoke', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.Roles', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.Sortable', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.Tasks', 0, NULL, NULL, 'N;'),
('Rights1.AuthItem.Update', 0, NULL, NULL, 'N;'),
('Rights1.Install.*', 1, NULL, NULL, 'N;'),
('Rights1.Install.Confirm', 0, NULL, NULL, 'N;'),
('Rights1.Install.Error', 0, NULL, NULL, 'N;'),
('Rights1.Install.Ready', 0, NULL, NULL, 'N;'),
('Rights1.Install.Run', 0, NULL, NULL, 'N;'),
('Rights12.Assignment.*', 1, NULL, NULL, 'N;'),
('Rights12.Assignment.Revoke', 0, NULL, NULL, 'N;'),
('Rights12.Assignment.User', 0, NULL, NULL, 'N;'),
('Rights12.Assignment.View', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.*', 1, NULL, NULL, 'N;'),
('Rights12.AuthItem.Assign', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.Create', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.Delete', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.Generate', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.Operations', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.Permissions', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.RemoveChild', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.Revoke', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.Roles', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.Sortable', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.Tasks', 0, NULL, NULL, 'N;'),
('Rights12.AuthItem.Update', 0, NULL, NULL, 'N;'),
('Rights12.Install.*', 1, NULL, NULL, 'N;'),
('Rights12.Install.Confirm', 0, NULL, NULL, 'N;'),
('Rights12.Install.Ready', 0, NULL, NULL, 'N;'),
('Rights12.Install.Run', 0, NULL, NULL, 'N;'),
('Savedsearches.*', 1, NULL, NULL, 'N;'),
('Savedsearches.Addnew', 0, NULL, NULL, 'N;'),
('Savedsearches.Admin', 0, NULL, NULL, 'N;'),
('Savedsearches.Create', 0, NULL, NULL, 'N;'),
('Savedsearches.Delete', 0, NULL, NULL, 'N;'),
('Savedsearches.Index', 0, NULL, NULL, 'N;'),
('Savedsearches.Update', 0, NULL, NULL, 'N;'),
('Savedsearches.View', 0, NULL, NULL, 'N;'),
('Site.*', 1, NULL, NULL, 'N;'),
('Site.Autocomplete', 0, NULL, NULL, 'N;'),
('Site.Bookmark', 0, NULL, NULL, 'N;'),
('Site.Contact', 0, NULL, NULL, 'N;'),
('Site.Emanage', 0, NULL, NULL, 'N;'),
('Site.Error', 0, NULL, NULL, 'N;'),
('Site.Explorer', 0, NULL, NULL, 'N;'),
('Site.Index', 0, NULL, NULL, 'N;'),
('Site.Login', 0, NULL, NULL, 'N;'),
('Site.Logout', 0, NULL, NULL, 'N;'),
('Site.Manage', 0, NULL, NULL, 'N;'),
('Site.Search', 0, NULL, NULL, 'N;'),
('Site.Student', 0, NULL, NULL, 'N;'),
('student', 2, 'For student Portal', NULL, 'N;'),
('Studentportal.Default.*', 1, NULL, NULL, 'N;'),
('Studentportal.Default.Attendance', 0, NULL, NULL, 'N;'),
('Studentportal.Default.Exams', 0, NULL, NULL, 'N;'),
('Studentportal.Default.Fees', 0, NULL, NULL, 'N;'),
('Studentportal.Default.Index', 0, NULL, NULL, 'N;'),
('Studentportal.Default.Leftside', 0, NULL, NULL, 'N;'),
('Studentportal.Default.Messages', 0, NULL, NULL, 'N;'),
('Studentportal.Default.Profile', 0, NULL, NULL, 'N;'),
('Studentportal.Default.Reports', 0, NULL, NULL, 'N;'),
('Studentportal.Default.Viewmessage', 0, NULL, NULL, 'N;'),
('Students.Default.*', 1, NULL, NULL, 'N;'),
('Students.Default.Index', 0, NULL, NULL, 'N;'),
('Students.Guardians.*', 1, NULL, NULL, 'N;'),
('Students.Guardians.Addguardian', 0, NULL, NULL, 'N;'),
('Students.Guardians.Admin', 0, NULL, NULL, 'N;'),
('Students.Guardians.Create', 0, NULL, NULL, 'N;'),
('Students.Guardians.Delete', 0, NULL, NULL, 'N;'),
('Students.Guardians.Index', 0, NULL, NULL, 'N;'),
('Students.Guardians.Update', 0, NULL, NULL, 'N;'),
('Students.Guardians.View', 0, NULL, NULL, 'N;'),
('Students.Savedsearches.*', 1, NULL, NULL, 'N;'),
('Students.Savedsearches.Addnew', 0, NULL, NULL, 'N;'),
('Students.Savedsearches.Admin', 0, NULL, NULL, 'N;'),
('Students.Savedsearches.Create', 0, NULL, NULL, 'N;'),
('Students.Savedsearches.Delete', 0, NULL, NULL, 'N;'),
('Students.Savedsearches.Index', 0, NULL, NULL, 'N;'),
('Students.Savedsearches.Update', 0, NULL, NULL, 'N;'),
('Students.Savedsearches.View', 0, NULL, NULL, 'N;'),
('Students.StudentAdditionalFields.*', 1, NULL, NULL, 'N;'),
('Students.StudentAdditionalFields.Admin', 0, NULL, NULL, 'N;'),
('Students.StudentAdditionalFields.Create', 0, NULL, NULL, 'N;'),
('Students.StudentAdditionalFields.Delete', 0, NULL, NULL, 'N;'),
('Students.StudentAdditionalFields.Index', 0, NULL, NULL, 'N;'),
('Students.StudentAdditionalFields.Update', 0, NULL, NULL, 'N;'),
('Students.StudentAdditionalFields.View', 0, NULL, NULL, 'N;'),
('Students.StudentCategories.*', 1, NULL, NULL, 'N;'),
('Students.StudentCategories.Admin', 0, NULL, NULL, 'N;'),
('Students.StudentCategories.Create', 0, NULL, NULL, 'N;'),
('Students.StudentCategories.Delete', 0, NULL, NULL, 'N;'),
('Students.StudentCategories.Index', 0, NULL, NULL, 'N;'),
('Students.StudentCategories.Update', 0, NULL, NULL, 'N;'),
('Students.StudentCategories.View', 0, NULL, NULL, 'N;'),
('Students.StudentCategory.*', 1, NULL, NULL, 'N;'),
('Students.StudentCategory.Index', 0, NULL, NULL, 'N;'),
('Students.StudentCategory.ReturnForm', 0, NULL, NULL, 'N;'),
('Students.StudentCategory.ReturnView', 0, NULL, NULL, 'N;'),
('Students.StudentLeave.*', 1, NULL, NULL, 'N;'),
('Students.StudentLeave.Index', 0, NULL, NULL, 'N;'),
('Students.StudentLeave.ReturnForm', 0, NULL, NULL, 'N;'),
('Students.StudentLeave.ReturnView', 0, NULL, NULL, 'N;'),
('Students.StudentPreviousDatas.*', 1, NULL, NULL, 'N;'),
('Students.StudentPreviousDatas.Admin', 0, NULL, NULL, 'N;'),
('Students.StudentPreviousDatas.Create', 0, NULL, NULL, 'N;'),
('Students.StudentPreviousDatas.Delete', 0, NULL, NULL, 'N;'),
('Students.StudentPreviousDatas.Index', 0, NULL, NULL, 'N;'),
('Students.StudentPreviousDatas.Update', 0, NULL, NULL, 'N;'),
('Students.StudentPreviousDatas.View', 0, NULL, NULL, 'N;'),
('Students.Students.*', 1, NULL, NULL, 'N;'),
('Students.Students.Active', 0, NULL, NULL, 'N;'),
('Students.Students.Add', 0, NULL, NULL, 'N;'),
('Students.Students.Admin', 0, NULL, NULL, 'N;'),
('Students.Students.Assesments', 0, NULL, NULL, 'N;'),
('Students.Students.Attentance', 0, NULL, NULL, 'N;'),
('Students.Students.Batch', 0, NULL, NULL, 'N;'),
('Students.Students.Create', 0, NULL, NULL, 'N;'),
('Students.Students.Delete', 0, NULL, NULL, 'N;'),
('Students.Students.DisplaySavedImage', 0, NULL, NULL, 'N;'),
('Students.Students.Events', 0, NULL, NULL, 'N;'),
('Students.Students.Fees', 0, NULL, NULL, 'N;'),
('Students.Students.Inactive', 0, NULL, NULL, 'N;'),
('Students.Students.Index', 0, NULL, NULL, 'N;'),
('Students.Students.Manage', 0, NULL, NULL, 'N;'),
('Students.Students.Payfees', 0, NULL, NULL, 'N;'),
('Students.Students.Pdf', 0, NULL, NULL, 'N;'),
('Students.Students.Printpdf', 0, NULL, NULL, 'N;'),
('Students.Students.Remove', 0, NULL, NULL, 'N;'),
('Students.Students.Savesearch', 0, NULL, NULL, 'N;'),
('Students.Students.Search', 0, NULL, NULL, 'N;'),
('Students.Students.Update', 0, NULL, NULL, 'N;'),
('Students.Students.View', 0, NULL, NULL, 'N;'),
('Students.Students.Website', 0, NULL, NULL, 'N;'),
('Timetable.ClassTiming.*', 1, NULL, NULL, 'N;'),
('Timetable.ClassTiming.Index', 0, NULL, NULL, 'N;'),
('Timetable.ClassTiming.ReturnForm', 0, NULL, NULL, 'N;'),
('Timetable.ClassTiming.ReturnView', 0, NULL, NULL, 'N;');
INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Timetable.Default.*', 1, NULL, NULL, 'N;'),
('Timetable.Default.Index', 0, NULL, NULL, 'N;'),
('Timetable.TimetableEntries.*', 1, NULL, NULL, 'N;'),
('Timetable.TimetableEntries.Admin', 0, NULL, NULL, 'N;'),
('Timetable.TimetableEntries.Create', 0, NULL, NULL, 'N;'),
('Timetable.TimetableEntries.Delete', 0, NULL, NULL, 'N;'),
('Timetable.TimetableEntries.Dynamiccities', 0, NULL, NULL, 'N;'),
('Timetable.TimetableEntries.Index', 0, NULL, NULL, 'N;'),
('Timetable.TimetableEntries.Remove', 0, NULL, NULL, 'N;'),
('Timetable.TimetableEntries.Settime', 0, NULL, NULL, 'N;'),
('Timetable.TimetableEntries.Update', 0, NULL, NULL, 'N;'),
('Timetable.TimetableEntries.View', 0, NULL, NULL, 'N;'),
('Timetable.view.*', 1, NULL, NULL, 'N;'),
('Timetable.view.Index', 0, NULL, NULL, 'N;'),
('Timetable.view.ReturnForm', 0, NULL, NULL, 'N;'),
('Timetable.view.ReturnView', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.*', 1, NULL, NULL, 'N;'),
('Timetable.Weekdays.Addnew', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.Admin', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.Batch', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.Create', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.Delete', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.Exportpdf', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.Index', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.Pdf', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.Publish', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.Timetable', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.Update', 0, NULL, NULL, 'N;'),
('Timetable.Weekdays.View', 0, NULL, NULL, 'N;'),
('Translate.Edit.*', 1, NULL, NULL, 'N;'),
('Translate.Edit.Admin', 0, NULL, NULL, 'N;'),
('Translate.Edit.Create', 0, NULL, NULL, 'N;'),
('Translate.Edit.Delete', 0, NULL, NULL, 'N;'),
('Translate.Edit.Missing', 0, NULL, NULL, 'N;'),
('Translate.Edit.Missingdelete', 0, NULL, NULL, 'N;'),
('Translate.Edit.Update', 0, NULL, NULL, 'N;'),
('Translate.Translate.*', 1, NULL, NULL, 'N;'),
('Translate.Translate.Index', 0, NULL, NULL, 'N;'),
('Transport.BusLog.*', 1, NULL, NULL, 'N;'),
('Transport.BusLog.Admin', 0, NULL, NULL, 'N;'),
('Transport.BusLog.Create', 0, NULL, NULL, 'N;'),
('Transport.BusLog.Delete', 0, NULL, NULL, 'N;'),
('Transport.BusLog.Index', 0, NULL, NULL, 'N;'),
('Transport.BusLog.Manage', 0, NULL, NULL, 'N;'),
('Transport.BusLog.Update', 0, NULL, NULL, 'N;'),
('Transport.BusLog.View', 0, NULL, NULL, 'N;'),
('Transport.Default.*', 1, NULL, NULL, 'N;'),
('Transport.Default.Index', 0, NULL, NULL, 'N;'),
('Transport.DriverDetails.*', 1, NULL, NULL, 'N;'),
('Transport.DriverDetails.Admin', 0, NULL, NULL, 'N;'),
('Transport.DriverDetails.Assign', 0, NULL, NULL, 'N;'),
('Transport.DriverDetails.Create', 0, NULL, NULL, 'N;'),
('Transport.DriverDetails.Delete', 0, NULL, NULL, 'N;'),
('Transport.DriverDetails.Error', 0, NULL, NULL, 'N;'),
('Transport.DriverDetails.Index', 0, NULL, NULL, 'N;'),
('Transport.DriverDetails.Manage', 0, NULL, NULL, 'N;'),
('Transport.DriverDetails.Update', 0, NULL, NULL, 'N;'),
('Transport.DriverDetails.View', 0, NULL, NULL, 'N;'),
('Transport.FuelConsumption.*', 1, NULL, NULL, 'N;'),
('Transport.FuelConsumption.Admin', 0, NULL, NULL, 'N;'),
('Transport.FuelConsumption.Create', 0, NULL, NULL, 'N;'),
('Transport.FuelConsumption.Delete', 0, NULL, NULL, 'N;'),
('Transport.FuelConsumption.Index', 0, NULL, NULL, 'N;'),
('Transport.FuelConsumption.Update', 0, NULL, NULL, 'N;'),
('Transport.FuelConsumption.View', 0, NULL, NULL, 'N;'),
('Transport.RouteDetails.*', 1, NULL, NULL, 'N;'),
('Transport.RouteDetails.Admin', 0, NULL, NULL, 'N;'),
('Transport.RouteDetails.Create', 0, NULL, NULL, 'N;'),
('Transport.RouteDetails.Delete', 0, NULL, NULL, 'N;'),
('Transport.RouteDetails.Index', 0, NULL, NULL, 'N;'),
('Transport.RouteDetails.Manage', 0, NULL, NULL, 'N;'),
('Transport.RouteDetails.Routedetails', 0, NULL, NULL, 'N;'),
('Transport.RouteDetails.Update', 0, NULL, NULL, 'N;'),
('Transport.RouteDetails.View', 0, NULL, NULL, 'N;'),
('Transport.StopDetails.*', 1, NULL, NULL, 'N;'),
('Transport.StopDetails.Admin', 0, NULL, NULL, 'N;'),
('Transport.StopDetails.Create', 0, NULL, NULL, 'N;'),
('Transport.StopDetails.Delete', 0, NULL, NULL, 'N;'),
('Transport.StopDetails.Index', 0, NULL, NULL, 'N;'),
('Transport.StopDetails.Manage', 0, NULL, NULL, 'N;'),
('Transport.StopDetails.Update', 0, NULL, NULL, 'N;'),
('Transport.StopDetails.View', 0, NULL, NULL, 'N;'),
('Transport.Transportation.*', 1, NULL, NULL, 'N;'),
('Transport.Transportation.Admin', 0, NULL, NULL, 'N;'),
('Transport.Transportation.Autocomplete', 0, NULL, NULL, 'N;'),
('Transport.Transportation.Autocomplete1', 0, NULL, NULL, 'N;'),
('Transport.Transportation.Create', 0, NULL, NULL, 'N;'),
('Transport.Transportation.Delete', 0, NULL, NULL, 'N;'),
('Transport.Transportation.Error', 0, NULL, NULL, 'N;'),
('Transport.Transportation.Index', 0, NULL, NULL, 'N;'),
('Transport.Transportation.Routes', 0, NULL, NULL, 'N;'),
('Transport.Transportation.Settings', 0, NULL, NULL, 'N;'),
('Transport.Transportation.Studentsearch', 0, NULL, NULL, 'N;'),
('Transport.Transportation.Update', 0, NULL, NULL, 'N;'),
('Transport.Transportation.View', 0, NULL, NULL, 'N;'),
('Transport.VehicleDetails.*', 1, NULL, NULL, 'N;'),
('Transport.VehicleDetails.Admin', 0, NULL, NULL, 'N;'),
('Transport.VehicleDetails.Create', 0, NULL, NULL, 'N;'),
('Transport.VehicleDetails.Delete', 0, NULL, NULL, 'N;'),
('Transport.VehicleDetails.Index', 0, NULL, NULL, 'N;'),
('Transport.VehicleDetails.Manage', 0, NULL, NULL, 'N;'),
('Transport.VehicleDetails.Update', 0, NULL, NULL, 'N;'),
('Transport.VehicleDetails.View', 0, NULL, NULL, 'N;'),
('User.*', 1, NULL, NULL, 'N;'),
('User.Activation.*', 1, NULL, NULL, 'N;'),
('User.Activation.Activation', 0, NULL, NULL, 'N;'),
('User.Admin', 0, NULL, NULL, 'N;'),
('User.Admin.*', 1, NULL, NULL, 'N;'),
('User.Admin.Admin', 0, NULL, NULL, 'N;'),
('User.Admin.Create', 0, NULL, NULL, 'N;'),
('User.Admin.Delete', 0, NULL, NULL, 'N;'),
('User.Admin.Update', 0, NULL, NULL, 'N;'),
('User.Admin.View', 0, NULL, NULL, 'N;'),
('User.Create', 0, NULL, NULL, 'N;'),
('User.Default.*', 1, NULL, NULL, 'N;'),
('User.Default.Index', 0, NULL, NULL, 'N;'),
('User.Delete', 0, NULL, NULL, 'N;'),
('User.Index', 0, NULL, NULL, 'N;'),
('User.Login.*', 1, NULL, NULL, 'N;'),
('User.Login.Login', 0, NULL, NULL, 'N;'),
('User.Logout.*', 1, NULL, NULL, 'N;'),
('User.Logout.Logout', 0, NULL, NULL, 'N;'),
('User.Profile.*', 1, NULL, NULL, 'N;'),
('User.Profile.Changepassword', 0, NULL, NULL, 'N;'),
('User.Profile.Edit', 0, NULL, NULL, 'N;'),
('User.Profile.Profile', 0, NULL, NULL, 'N;'),
('User.ProfileField.*', 1, NULL, NULL, 'N;'),
('User.ProfileField.Admin', 0, NULL, NULL, 'N;'),
('User.ProfileField.Create', 0, NULL, NULL, 'N;'),
('User.ProfileField.Delete', 0, NULL, NULL, 'N;'),
('User.ProfileField.Update', 0, NULL, NULL, 'N;'),
('User.ProfileField.View', 0, NULL, NULL, 'N;'),
('User.Recovery.*', 1, NULL, NULL, 'N;'),
('User.Recovery.Recovery', 0, NULL, NULL, 'N;'),
('User.Registration.*', 1, NULL, NULL, 'N;'),
('User.Registration.Registration', 0, NULL, NULL, 'N;'),
('User.Update', 0, NULL, NULL, 'N;'),
('User.User.*', 1, NULL, NULL, 'N;'),
('User.User.Index', 0, NULL, NULL, 'N;'),
('User.User.View', 0, NULL, NULL, 'N;'),
('User.View', 0, NULL, NULL, 'N;'),
('UserSettings.*', 1, NULL, NULL, 'N;'),
('UserSettings.Admin', 0, NULL, NULL, 'N;'),
('UserSettings.Create', 0, NULL, NULL, 'N;'),
('UserSettings.Delete', 0, NULL, NULL, 'N;'),
('UserSettings.Index', 0, NULL, NULL, 'N;'),
('UserSettings.Update', 0, NULL, NULL, 'N;'),
('UserSettings.View', 0, NULL, NULL, 'N;');

--
-- Dumping data for table `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('Authenticated', 'Guest'),
('student', 'Hostel.Allotment.*'),
('student', 'Hostel.Default.*'),
('student', 'Hostel.Floor.*'),
('student', 'Hostel.MessFee.*'),
('student', 'Hostel.MessManage.*'),
('student', 'Hostel.Registration.*'),
('student', 'Hostel.Room.*'),
('student', 'Library.Authors.*'),
('library', 'Library.Authors.Authordetails'),
('library', 'Library.Authors.Index'),
('library', 'Library.Authors.ReturnForm'),
('library', 'Library.Authors.ReturnView'),
('student', 'Library.Book.*'),
('library', 'Library.Book.Admin'),
('library', 'Library.Book.Allbooks'),
('library', 'Library.Book.Autocomplete'),
('library', 'Library.Book.Autocomplete1'),
('library', 'Library.Book.Bookdetails'),
('library', 'Library.Book.Booklist'),
('library', 'Library.Book.BookSearch'),
('library', 'Library.Book.Create'),
('library', 'Library.Book.Delete'),
('library', 'Library.Book.Index'),
('library', 'Library.Book.Manage'),
('library', 'Library.Book.Subjects'),
('library', 'Library.Book.Update'),
('library', 'Library.Book.View'),
('library', 'Library.BookFine.Admin'),
('library', 'Library.BookFine.Create'),
('library', 'Library.BookFine.Delete'),
('library', 'Library.BookFine.Index'),
('library', 'Library.BookFine.Update'),
('library', 'Library.BookFine.View'),
('library', 'Library.BorrowBook.Admin'),
('library', 'Library.BorrowBook.Autocomplete'),
('student', 'Library.Default.*'),
('parent', 'Mailbox.Ajax.*'),
('parent', 'Mailbox.Ajax.Auto'),
('parent', 'Mailbox.Default.*'),
('parent', 'Mailbox.Groups.*'),
('parent', 'Mailbox.Message.*'),
('parent', 'Mailbox.Message.Inbox'),
('parent', 'Mailbox.Message.New'),
('parent', 'Mailbox.Message.Reply'),
('parent', 'Mailbox.Message.Sent'),
('parent', 'Mailbox.Message.Trash'),
('parent', 'Mailbox.News.*'),
('parent', 'Mailbox.News.Index'),
('parent', 'Mailbox.News.Info'),
('parent', 'Mailbox.User.*'),
('parent', 'Messages.Compose.*'),
('student', 'Messages.Compose.*'),
('parent', 'Messages.Delete.*'),
('student', 'Messages.Delete.*'),
('parent', 'Messages.Inbox.*'),
('student', 'Messages.Inbox.*'),
('parent', 'Messages.Index.*'),
('student', 'Messages.Index.*'),
('parent', 'Messages.Sent.*'),
('student', 'Messages.Sent.*'),
('parent', 'Messages.Suggest.*'),
('student', 'Messages.Suggest.*'),
('parent', 'Messages.View.*'),
('student', 'Messages.View.*'),
('student', 'parent'),
('parent', 'Parentportal.Default.*'),
('parent', 'Parentportal.Default.Attendance'),
('parent', 'Parentportal.Default.Events'),
('student', 'Studentportal.Default.*'),
('student', 'Studentportal.Default.Attendance'),
('student', 'Studentportal.Default.Exams'),
('student', 'Studentportal.Default.Fees'),
('student', 'Studentportal.Default.Index'),
('student', 'Studentportal.Default.Leftside'),
('student', 'Studentportal.Default.Profile'),
('Authenticated', 'Students.Students.*');

--
-- Dumping data for table `bank_fields`
--


--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `name`, `course_id`, `start_date`, `end_date`, `is_active`, `is_deleted`, `employee_id`) VALUES
(1, '1A', 1, '2012-06-01 00:00:00', '2013-03-29 00:00:00', 1, 0, '1'),
(2, '1B', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '1'),
(3, '2A', 2, '2012-06-01 00:00:00', '2013-03-29 00:00:00', 1, 0, '1'),
(4, '1C', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '1'),
(5, '2B', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '1'),
(6, '2C', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '1'),
(7, '3A', 3, '2012-06-08 00:00:00', '2013-03-29 00:00:00', 1, 0, '1'),
(8, '4A', 4, '2012-06-01 00:00:00', '2013-03-29 00:00:00', 1, 0, '1'),
(9, '5A', 5, '2012-06-01 00:00:00', '2013-03-29 00:00:00', 1, 0, '1'),
(10, '3B', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '1'),
(11, '3C', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '1'),
(12, '4B', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '1'),
(13, '4C', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '1'),
(14, '5B', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '1'),
(15, '5C', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '1'),
(16, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '1'),
(17, 'A', 6, '2012-07-02 00:00:00', '2012-07-25 00:00:00', 1, 0, '1');

--
-- Dumping data for table `batch_events`
--


--
-- Dumping data for table `batch_students`
--


--
-- Dumping data for table `blog_user`
--

INSERT INTO `blog_user` (`id`, `username`, `password`, `salt`, `email`, `profile`) VALUES
(1, 'admin', '9401b8c7297832c567ae922cc596a4dd', '28b206548469ce62182048fd9cf91760', 'webmaster@example.com', NULL);

--
-- Dumping data for table `class_timings`
--

INSERT INTO `class_timings` (`id`, `batch_id`, `name`, `start_time`, `end_time`, `is_break`) VALUES
(1, 1, 'morning', '08:30 AM', '09:30 AM', 0),
(2, 1, 'morning', '09:30 AM', '10:30 AM', 0),
(3, 1, 'morning', '10:45 AM', '11:45 AM', 0),
(4, 1, 'morning', '11:45 AM', '12:30 PM', 0),
(5, 1, 'noon', '01:30 PM', '02:30 PM', 0),
(6, 1, 'noon', '02:30 PM', '03:30 PM', 0),
(7, 1, 'noon', '03:30 PM', '04:30 PM', 0),
(8, 2, 'morning', '08:30 AM', '09:30 AM', 0),
(9, 2, 'morning', '09:30 AM', '10:30 AM', 0),
(10, 2, 'morning', '09:30 AM', '10:30 AM', 0),
(11, 2, 'morning', '10:45 AM', '11:45 AM', 0),
(12, 2, 'morning', '11:45 AM', '12:45 PM', 0);

--
-- Dumping data for table `cms_attachment`
--


--
-- Dumping data for table `cms_content`
--


--
-- Dumping data for table `cms_node`
--


--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `config_key`, `config_value`) VALUES
(1, 'InstitutionName', NULL),
(2, 'InstitutionAddress', ''),
(3, 'InstitutionPhoneNo', ''),
(4, 'StudentAttendanceType', NULL),
(5, 'CurrencyType', ''),
(6, 'Locale', NULL),
(7, 'AdmissionNumberAutoIncrement', '1'),
(8, 'EmployeeNumberAutoIncrement', '1'),
(9, 'TotalSmsCount', NULL),
(10, 'AvailableModules', NULL),
(11, 'AvailableModules', NULL),
(12, 'NetworkState', 'Online'),
(13, 'FinancialYearStartDate', ''),
(14, 'FinancialYearEndDate', NULL),
(15, 'AutomaticLeaveReset', NULL),
(16, 'LeaveResetPeriod', NULL),
(17, 'LastAutoLeaveReset', NULL),
(18, 'logo', NULL);

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Antigua & Deps'),
(7, 'Argentina'),
(8, 'Armenia'),
(9, 'Australia'),
(10, 'Austria'),
(11, 'Azerbaijan'),
(12, 'Bahamas'),
(13, 'Bahrain'),
(14, 'Bangladesh'),
(15, 'Barbados'),
(16, 'Belarus'),
(17, 'Belgium'),
(18, 'Belize'),
(19, 'Benin'),
(20, 'Bhutan'),
(21, 'Bolivia'),
(22, 'Bosnia Herzegovina'),
(23, 'Botswana'),
(24, 'Brazil'),
(25, 'Brunei'),
(26, 'Bulgaria'),
(27, 'Burkina'),
(28, 'Burundi'),
(29, 'Cambodia'),
(30, 'Cameroon'),
(31, 'Canada'),
(32, 'Cape Verde'),
(33, 'Central African Rep'),
(34, 'Chad'),
(35, 'Chile'),
(36, 'China'),
(37, 'Colombia'),
(38, 'Comoros'),
(39, 'Congo'),
(40, 'Congo {Democratic Rep}'),
(41, 'Costa Rica'),
(42, 'Croatia'),
(43, 'Cuba'),
(44, 'Cyprus'),
(45, 'Czech Republic'),
(46, 'Denmark'),
(47, 'Djibouti'),
(48, 'Dominica'),
(49, 'Dominican Republic'),
(50, 'East Timor'),
(51, 'Ecuador'),
(52, 'Egypt'),
(53, 'El Salvador'),
(54, 'Equatorial Guinea'),
(55, 'Eritrea'),
(56, 'Estonia'),
(57, 'Ethiopia'),
(58, 'Fiji'),
(59, 'Finland'),
(60, 'France'),
(61, 'Gabon'),
(62, 'Gambia'),
(63, 'Georgia'),
(64, 'Germany'),
(65, 'Ghana'),
(66, 'Greece'),
(67, 'Grenada'),
(68, 'Guatemala'),
(69, 'Guinea'),
(70, 'Guinea-Bissau'),
(71, 'Guyana'),
(72, 'Haiti'),
(73, 'Honduras'),
(74, 'Hungary'),
(75, 'Iceland'),
(76, 'India'),
(77, 'Indonesia'),
(78, 'Iran'),
(79, 'Iraq'),
(80, 'Ireland {Republic}'),
(81, 'Israel'),
(82, 'Italy'),
(83, 'Ivory Coast'),
(84, 'Jamaica'),
(85, 'Japan'),
(86, 'Jordan'),
(87, 'Kazakhstan'),
(88, 'Kenya'),
(89, 'Kiribati'),
(90, 'Korea North'),
(91, 'Korea South'),
(92, 'Kosovo'),
(93, 'Kuwait'),
(94, 'Kyrgyzstan'),
(95, 'Laos'),
(96, 'Latvia'),
(97, 'Lebanon'),
(98, 'Lesotho'),
(99, 'Liberia'),
(100, 'Libya'),
(101, 'Liechtenstein'),
(102, 'Lithuania'),
(103, 'Luxembourg'),
(104, 'Macedonia'),
(105, 'Madagascar'),
(106, 'Malawi'),
(107, 'Malaysia'),
(108, 'Maldives'),
(109, 'Mali'),
(110, 'Malta'),
(111, 'Montenegro'),
(112, 'Marshall Islands'),
(113, 'Mauritania'),
(114, 'Mauritius'),
(115, 'Mexico'),
(116, 'Micronesia'),
(117, 'Moldova'),
(118, 'Monaco'),
(119, 'Mongolia'),
(120, 'Morocco'),
(121, 'Mozambique'),
(122, 'Myanmar, {Burma}'),
(123, 'Namibia'),
(124, 'Nauru'),
(125, 'Nepal'),
(126, 'Netherlands'),
(127, 'New Zealand'),
(128, 'Nicaragua'),
(129, 'Niger'),
(130, 'Nigeria'),
(131, 'Norway'),
(132, 'Oman'),
(133, 'Pakistan'),
(134, 'Palau'),
(135, 'Panama'),
(136, 'Papua New Guinea'),
(137, 'Paraguay'),
(138, 'Peru'),
(139, 'Philippines'),
(140, 'Poland'),
(141, 'Portugal'),
(142, 'Qatar'),
(143, 'Romania'),
(144, 'Russian Federation'),
(145, 'Rwanda'),
(146, 'St Kitts & Nevis'),
(147, 'St Lucia'),
(148, 'Saint Vincent & the Grenadines'),
(149, 'Samoa'),
(150, 'San Marino'),
(151, 'Sao Tome & Principe'),
(152, 'Saudi Arabia'),
(153, 'Senegal'),
(154, 'Serbia'),
(155, 'Seychelles'),
(156, 'Sierra Leone'),
(157, 'Singapore'),
(158, 'Slovakia'),
(159, 'Slovenia'),
(160, 'Solomon Islands'),
(161, 'Somalia'),
(162, 'South Africa'),
(163, 'Spain'),
(164, 'Sri Lanka'),
(165, 'Sudan'),
(166, 'Suriname'),
(167, 'Swaziland'),
(168, 'Sweden'),
(169, 'Switzerland'),
(170, 'Syria'),
(171, 'Taiwan'),
(172, 'Tajikistan'),
(173, 'Tanzania'),
(174, 'Thailand'),
(175, 'Togo'),
(176, 'Tonga'),
(177, 'Trinidad & Tobago'),
(178, 'Tunisia'),
(179, 'Turkey'),
(180, 'Turkmenistan'),
(181, 'Tuvalu'),
(182, 'Uganda'),
(183, 'Ukraine'),
(184, 'United Arab Emirates'),
(185, 'United Kingdom'),
(186, 'United States'),
(187, 'Uruguay'),
(188, 'Uzbekistan'),
(189, 'Vanuatu'),
(190, 'Vatican City'),
(191, 'Venezuea'),
(192, 'Vietnam'),
(193, 'Yemen'),
(194, 'Zambia'),
(195, 'Zimbabwe');

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `code`, `section_name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '1', '01', 'full', 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00'),
(2, '2', '02', 'A', 0, '2012-06-08 00:00:00', '0000-00-00 00:00:00'),
(3, '3', '03', 'A', 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00'),
(4, '4', '04', 'A', 0, '2012-06-08 00:00:00', '0000-00-00 00:00:00'),
(5, '5', '05', 'A', 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00'),
(6, '7', '007', 'A', 0, '2012-07-06 00:00:00', '2012-07-06 00:00:00');

--
-- Dumping data for table `draft`
--


--
-- Dumping data for table `electives`
--


--
-- Dumping data for table `elective_groups`
--


--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_category_id`, `employee_number`, `joining_date`, `first_name`, `middle_name`, `last_name`, `gender`, `job_title`, `employee_position_id`, `employee_department_id`, `reporting_manager_id`, `employee_grade_id`, `qualification`, `experience_detail`, `experience_year`, `experience_month`, `status`, `status_description`, `date_of_birth`, `marital_status`, `children_count`, `father_name`, `mother_name`, `husband_name`, `blood_group`, `nationality_id`, `home_address_line1`, `home_address_line2`, `home_city`, `home_state`, `home_country_id`, `home_pin_code`, `office_address_line1`, `office_address_line2`, `office_city`, `office_state`, `office_country_id`, `office_pin_code`, `office_phone1`, `office_phone2`, `mobile_phone`, `home_phone`, `email`, `fax`, `photo_file_name`, `photo_content_type`, `photo_data`, `created_at`, `updated_at`, `photo_file_size`, `user_id`, `is_deleted`) VALUES
(1, 2, 'E1', '2011-06-01', 'jayaraj', '', 'shanker', 'M', 'teacher', 1, 1, NULL, 1, 'bsc b.ed', 'two years', 0, 2, 1, NULL, '1959-08-12', 'Married', 2, 'shankaranarayanan', 'maalathi', '', 'A+', 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0),
(2, 2, 'E2', '2011-06-03', 'nirmala', '', 'ramesh', 'F', 'teacher', 1, 1, NULL, 1, 'bsc b.ed', 'one year', 0, 1, 1, NULL, '1972-06-14', 'Married', 2, 'mohan', 'meenakshi', 'ramesh', 'B-', 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0),
(3, 2, 'E3', '2005-06-17', 'ram', '', 'krishnan', 'M', 'teacher', 3, 1, NULL, 1, 'bsc b.ed', '8years', 0, 8, 1, NULL, '1953-06-24', 'Married', 3, 'govind', 'saraswathi', '', 'B+', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0),
(4, 2, 'E4', '1970-01-01', 'meenakshi', '', 'james', 'F', '', 4, 2, NULL, 1, 'msc .bed', '3years', 0, 3, 1, NULL, '1951-11-24', 'Married', 2, 'jayaraj', 'latha', 'james', 'B+', 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0),
(5, 2, 'E5', '2010-08-19', 'annie ', '', 'thomas', 'F', '', 4, 3, NULL, 1, 'msc ', '3years', 0, 3, 1, NULL, '1960-11-30', 'Married', 1, 'mathew', 'neena', 'thomas mathew', 'B+', 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0);
INSERT INTO `employees` (`id`, `employee_category_id`, `employee_number`, `joining_date`, `first_name`, `middle_name`, `last_name`, `gender`, `job_title`, `employee_position_id`, `employee_department_id`, `reporting_manager_id`, `employee_grade_id`, `qualification`, `experience_detail`, `experience_year`, `experience_month`, `status`, `status_description`, `date_of_birth`, `marital_status`, `children_count`, `father_name`, `mother_name`, `husband_name`, `blood_group`, `nationality_id`, `home_address_line1`, `home_address_line2`, `home_city`, `home_state`, `home_country_id`, `home_pin_code`, `office_address_line1`, `office_address_line2`, `office_city`, `office_state`, `office_country_id`, `office_pin_code`, `office_phone1`, `office_phone2`, `mobile_phone`, `home_phone`, `email`, `fax`, `photo_file_name`, `photo_content_type`, `photo_data`, `created_at`, `updated_at`, `photo_file_size`, `user_id`, `is_deleted`) VALUES
(6, 2, 'E6', '2011-06-21', 'hameed ', '', 'muhammed', 'M', '', 1, 4, NULL, 1, 'msc', '7years', 0, 7, 1, NULL, '1957-02-12', 'Married', NULL, 'rahman', 'julie', '', 'O+', 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Jb.gif', 'image/gif', 0x474946383761c000f5008700000901021706061e100c1c0b101d1013250b08350c0829120c36140b250d11350d132a14133618153e210d3a221b2e1e23341c213b2523480c05560c0647150b56170a470b11471a14561c136d191047240d55200d46241a5926194e36175f301e66230d75240d6a310e67281976281a67321d75321d491c22721d24462924582b234a332a583428532c314a3633553a34672c22762c22683525773726663b35773d3359443869412b78432b6647387845336b533b775339503e42623e435a4943654b4379494469554875594a654f526a5c54745c5377614d6c635875675a7b705d6f6962786c627c72657b7873871a13862b1ca3291b893726aa362d88452b96462a86562c97512c8848339749338b5336985537aa53358a643d9a623db2623bc65336c2653cb83943854a43974e43895646985944845753995853af5a4388664a9c634696704884685897675784725c997658a96546b86747ac714bb9734ba96954b86c53aa7455ba7756836d6493676684776a947a6a816a70897c72947d73b96e61a67867b97863a77e72b57c73c55a49c77354e17756cd7a64e17a6aab865dbc825b8b806b95816c8c82759788799d907ca78369bc8465a2916fb6946ba28b7aba8773a2927db69377b5a078c7845ce1855ec88765d58767cb926ad5936bc88975d78b74ca9475d89677e39677daa179e4a27b8e8984998c828f91859b93869d9a93a38d82b58d83a69787b29c8ba79c93b19d939ea094aea08cb3a28daaa398b5a597bab098b09da0acaba3b6aca3aeb0a4b7b5aab7adb0bbbbb4ca8b82de8e82ca9684d99984c29c94de9e90e49b85c5a889dba287dcb28bc5a898dba594cab29dd5b791e8a689c4ada5d1afa8c2b6acd8baa7c4bcb4d1bdb7e7b0a7bdc1b7d8c38fdac3acc8c4b9d2c7bce7c9a7e6d0a9e6c9b8ead2baf0d8bdbebec1c3bec0bdc3c2c8c9c8d4ccc5ccd1cdd7d4cacdcdd0d3ced0cdd2d1d7d8d5e1ccc4e1dacdf3dac8e1ced4e3ddd2f1dedadde0d9ebe0cbf6e2cce9e6daf0ebddeef0def1f0dfdcdde1e4dee1dde2e1e9e9e4f1ede1edf0e6f5f4e8edf2f0f8f9f62c00000000c000f5000708fd00fbcd1b38d01dc181e50c1e5cb86eddc2790a1542744711e23a8a171bce2bc7b1a3c772e9d27dcce671dcb87227b1611ba7b2a54b95d5b0f1e2d5d2972f6c376dceacc64b67ae9ebe66eeaa35b3e8cc5cb9821a35aa9466d1a6366f628b8993a74a692fb3cad4ba729cc087f3e80dbc08566cc18711d1929d8871e33a8e6f3f86fc78b2a349bb2bb9aa14a79217d6be31634af5554d27d0a8bc922ee5b5ebe7e2c7bc78f65cea926a35aa7a33bb34f915ace785f4c49a85b850a24189f3c8ba535d2edbc68f20e9d645399b25cbcc935d4615671327e1c3939b42766c94f8e4c892771ef64db8726fcd7ab379fd4c7d203dd408cb0d84372f1d41830dfd4f4f6cf8366e6cd8b055765c4972ef56ae40ff2a552a7329e2e3bb163b46ca9857ada4bee457948041e577d96f40c174995e5271c5574bd97456dd4162690756390e1164e177a96178567871ad239248e8a1c41149e5b404cd4cb6d4a20b5134c14793648609171562c405a558624721954b6393fd64a37081c1f4dc82d069751b36d94438a1450b6d88d64119a2751a79199df45a891e91e3122fb6b4a88b2daeb8f2082aaaa8528b2d3de1e4a64a881956944c36e5974b2dabfcc7d452403a56a0807bce17675037be996466125248d068d48936a544558e471e451cb9055789d95cb52299ac3ce2a92bb0c032a62dbac08226512fe904e84c30fec4fd1f648fc919abac33d5f81c9cd8fca599ae2f658a4da2a55917d6939e49546941abb903d76a5c7ea4299966fef1071f8fecf1881f4cb842aa2db0b4782d2ab21c775c8146b9a80b7fe8c278d4ba3cda27dc6284c63b5854ba369895bd59395916b1c456e94e48575af496485b369b0d34b798f9081f0cefb14712460c21c4101427f1072b65ba128b2b0e3f822a8f41fdf7ea7ec4d5a2aec9280fa52ea042c2aa93bc39f9c26b8c87aad4a4be8a86c6efcea539441e4806357ba22eae54c2471b6d0c61c30b29ace0f40b2fb0b0020b2c40fd03137e94592d135887ba7262af1a25e02e8dfd278b2cb5a492a79e4be5b20abbb5160694dcccd129cddd35feb7b42493c0f23ce541414b59504214152e746bd0d852ed1e471cb1c30e364ccd820d5273e0c0e59733a0390329a4f0821046389cc4e88fb862729a26bb6df24cbae832132c779a1c2a2c69c262f2dafc35e6ea53b51e1694dc84ced4925f5769c5175626d9dc24b0a1311aecbe60e993d0856c61746947ca66238dc28f184d711b42e42004e491af9082030c2cc000e60c1cb0b9e611b86083104008514413a8d462fa7fb5a8e91fcab5b09dec42a50a029e2a4f63db9def086494c2f4a52fc2fb0bdea073b3e5f9ed829fb948e192853dbbdccd4c6dd8031f2ef18a85b501089543c0e50e508016bab0000750dfe61610c3f55d6e0536f84111f6504035fd99cc1140f4da2a0ab80a58aca2886a12609ad2e41801192731ea7a8a4d0483139a4965827f79904b7465c1096107830791527894e59186648a25b56884992e610b56fc21072cb8c00c17b080171e20862c2c400002908000d090869a439f033ab782cf31c111684ad32310a98afc990a15066c242c4005aa25a6ae3803729dbb0a53a3e1d54c8b2de99ba23ce33cb07c3168543acd47d6711b5e804a717b78431222c781ce71407377cc6301eab8c75efa320002c0a30c37d739cfd9a008a75064b59ae00727a802886972841f98e907472cb187d6348e0203451898590633790ba57518554a7e4d0f210cf98e439415b4d5482753d0d016342a71c21cfde46005b5e4803e1980805cd2918ebff4e50b5b884715a28f73e7c3211098f08745fa610f48f84113a0f9b03d54b3638b4c132a5c712a176d734f6163ce737a83150962031ac5738fcd7e35ce4539af9c07d987b048939a89000e3c0431cf3a5a228d789a29094210c20bccc78214bcaf7db9cce32f098a00041c1597fd64612e3737c81714016b7e00aac3b025842658148840dc0358d1e48a6c9ecb654c795954e0842fe3a9646f5ed119183d23382bd1b460ade145e2f8a034a619557334746100062ad8c1ba3097fdd463610f0b4317d231902bf84112f650bfa0da2f094c709845f79059aced210fa8f09400c5669cfba4b54d11bc9b7cdcea1e81fd348f4230ed971737a2210bad231b1cdd83118a7abe39c690b0bb84a1540179c7a812368fb9246872d5e780f87d2ea846b0ac1046c784d16976b379b0d6b5fc072ba03c9193dd542daf509a19ce8425b6188454b1e6c19d8dc00324b7e545686d70cb41a2af8eb8b4e31d79295082b6af9f9a6bea019aaa3e3b12547d8fd55c0a22f039a8d9200979189d7527bbd53dfc61a27e3893234cd75d79216739d290593855f20f52cef449fa986da450d3916cf0821540406804d207c805242001821dc02f17b0e33ab690b8ee432a729bead4cd39d57d2d5c9fe75e103a09274162d03582848f30d985590b768e39ab146fc4e54269e641bcf015cec8295762fda5985f1561718acaa10a211473c1ff74e18df9abe38002e0ce7b1ca8fb7cacc73cd7b1a905203291ef48630614607de2ab6c508130baa01661b26f98ee7545950bd741a5cb53c4343859cb2b09a1e6a53c432595d8f29d8470041bae40616f012be71ffb38a0bdc4739ef94847c51ad685062832020efd4fa9beef9fce859a106c90c3f94d4cc24893b008f3e08a17c12e31809acfb8c07b9336dd8a5710c28638feb10f993ec42cdef6db176b6a530d6183238f609ae56e89cb5a27a08e387e21ace7ed4b1a06b9c8e9eb737f0d8b60403a60052e00c2d27228ddc60da171546ec31b42e887d12aa565bd7b59910c63a8e890b879a3796d58c23dd7b3fd5c48257bc0673e0509587fd611b907a0f7bc5bd8cb16025ae5f4dea5035ee0021cfe0008379fee93937084218c2e0f486b43124af76cc8c8c9b46b6d534ab3c2977f607c94182c27768ea52c5e30c17c9d6b6efaeec8eb940b80c7bd1cc03fed1d67e0b23ccfc0bdb59d651d003c2fa0b92e88c00fe64e3f9d4f8cca4960d8d190f608db69f2280c14d4cb567b371167c6e91a1f6799d17be22771e4bde5808510cc67b97fde988f377e37cc071b43403e950172e480a0772d5c5daefdce00683bead11e8114b8407ec61ef6c17f6eada3390c923e8a951405a3da2d625b2bfdc8386ca1fe108e67d067b595c61f9816013ade51009b8f35ead9be541bfd1f9886b7e6ba524f3ffdeea77e01106000045c4fec1f1841e041e5b9751f918437b8a2807ee7859667b59cb596742ada7e495c4d3cacfe8385e3b1a51d16527521f75778a46fbf947ad1d77668d74209d03e81e56ba48780f3e67d16486bff34482e403fa3e3733e77047bd0080fe3317e57699af42eb52233f4126258a4175e617c665166e78566d4a31d6f210d21673997536b14b88001755835c45805007d0c8867aba780b06681ddd74befc6000c267040600452d868d6e2300204237f272e3712622a181fbda717c1076edd667c33d87f8cf71936380e8f6003e7833e31d45fae16734b15008466722c94804bb84748f8837aa484d3b7474da839fd43058540f0066f2031cbb63f2e22140ce43b77031429283313c41588071a1d571d1ca186ccc7833e3867ff448779866352f55b67b7760cb8722ca76f7eb87aa1a83ee7b3642f600343c0077930041d833295e62e91c83a32137178f37b2d81788ba778a0561de33610e3a07cf794029fd872ca35767c4687a9d8835c276fd1477dc7658d7a788168e75498e3342c1085d9350421443bfcf37747a71496161478632fc0880d9518831997788de77ff47066e416468e000459976f68374cef035c77386fc9558d84e54b7fe88c81d642b98600b93650d2c78abad4900a960255a373e4a88859b82746c18292280d098213f7e712c2d878c2377ca1260d6bfeb860ed63479c734ba4275585356b7cb84bfc945c8bd5674628502c64003ef9930640011480004349013ea99379c85481c64f4de539e12874931540b9f8444f14713af18820f98e25598627a63331e87f13725b8fc08f11803e2f1401b5a4397274547c968a5c577da6776b105993b8e6930aa0000c20947a7901173094bbb68d09b99444c6949a4335d3153aa6938bfaa17b2b080dbaf27bdba671a1116efb400f32559927d92fe3a00b46603e9bc37581a460fa24470e3981da67683f4655f9868066379303b56b3fa997148001b459011d80017df9907db884f7369845c6014e233e6de043595895f062138f982b7ea12b34f31563f89c8e2283e74586fd19840d63d986e8d3540cc0016b1960efe354178000fb046841b69d0ea08d79e6930e69000cd99a81569a44299418d001b7d90123709fb56994bbb9937e54000ee09bdaa94fe263048fd0223e02241be92e50819512443cf03810fba00f96d96df4107c2e155334980db0c0042f6043eda3603799640ca002da499aa1379a96a39672548aced890ece9a20b59003f49647a890017409bf3699ff73902b7399f42b96b7fa88005900003467a9a630008158e5d953ab0a33bc62945f2371385b79c31423325d60ffd600f07a10ff510536251995d899239b50c7b3004291a60e3f942b9c6003ee99d83196f33b954321a9f46d9547e4994332a9b15b0a77cfe5a013bfaa72490013b7a9bfaa97aabf79e45ba6bdec90145553f1e933aad7356ad5314092a2e20b99cbd8715576aa1f3a00f11daa52ff595f5c810d9e0294c93394ce990cab5a64ed5547c7901477900701aa70485977c49017dd99743199442996bba5a9b3a8a01b6f9a7f709033030023140ac1860948029a4fd4464225a91434582ff11a993ea3a91da5d8fe8985fa8a94fb7109e3a86d6e16dd2694ae3600b9760044cb339c2e542a4d754be8aabe1099f6dca9eee19afba9aafb42901b35901c2eaafc41ab03330b0311003331003c7faa715400148296bc2c5948af53e9e9304b1204026f822ad8314d73aa9972aa54ad153aac5addc3686582a53fd155a99e2ba71d029578e3238d9600b7b10356be954cac542f029941d4001dcf9aadaa99e47ca4f04e572369aaf849aa3c28a017f8ab4f749022340024edbb4073bb05230b0078bac236002f809abfb29a44c558d3274004d2304ac00402f923a95b688705314dc0ab2dcba2277238c2d2b162946a1e36a992d3b4aca928c7e2054eca639ca9564362aaf17409f1c20aff2fa3ea4b96bd0eaaaaf4a01f4d9011bf0b81de0a74b0ba84e4b02332005054bb59ccbb92480b5f7d9017f69a85c8b9330844b0c50487b0040b16332658bad952a0dba70a96d2ba5d250622716a1bafb9cf37099e166b78b321618f2086d90032ad0b7da29a30670ab8e6b9f8ffecb9792db97b839afa317947cb9ac14b0a7010bb0c8eab4314002051b035220055030bee39bb9e38b05e73bb554fbb439cb9ea4cb768da5580770509e6304ace03565eb23d69a85d92a7fae030d6b2b5ef1d8a5bdeba9e13a86fae0a99639aab5a50b79f70217d039df099e373a9bf329032560ac371abd3d0aab83b9bc433bb8b33902482ba87f6ab0981bbee22bbee6fbc2e34b05eafbc2063bb0988bb51df090dee78c77e8426c6a91b6082a2eb2264851adff0b19022cc02c48c0a1e15a93d96dbdeb6df808a69f1134d0d006953004c72b7a292a47baeab8cb3a023220c6f7e9b830609f1870c6baca4f062001fc1a94b5499b28aca323e0a7522b05fd2450bee50bc37c6cbe5470be99ebb94c5b01127094cd3a87a058430e80597d373bdd1226a4d23a91bcb1b0ab574aec98020c8fafd53ce22aaef808a189c728a5ca0a95405f2cc0a8fa247aa037b81d70c6622c03638c9f3290b0629cb31dc09df23abd749c014a9bb0dfebb4305c055920055550cc5930cc52900555f0c7312c0558a0be52cbb9df5bc6864cba62a7878315587eb43e5cd3c8b223c9fd3ba994aa499a24c0529ac9f1281a500ca197c9338a630b6d40355bbc028a3bb4f679ac545bac2300033360acfb6cc28efbaaf4899bad1cba159001973b03974b02e39b057f7ccccaacccc62cd1c50cc3cc3c0326c0be2690cf3c5acd4b4800abfe47a47d56bf57e50705243b434c2aae2bced6ba18e63c138e89bbdd66c063f8a5cf19a19edabb8a671deea086dd03472aa0029da3470fc8ca3000cb9d9bd4333002fd3c9fb4d9ca38aab480facbe65bbe103dd15c70d5c7cc0513adcc54c0cceb0bc8ed5bc685cc7209f94b03590029f0606622c40084d2fd1b267a35d7480c0db83b1034bdce6218a19d9ad35c490fe5e0534350541da0028696671cd001b3ac021dd0b9ec9bd4674cc7510d03946bb5c94ab5c93ccc109d055bc0059e9dd559bdd55c2dcc104dcc307cc703bbd1030b03b86ac8792850d817008bcc04ac004957f8d6e1bc26b0b222306dd79dc10ffd80b20d4cc55087d3a3918c6672cafd42cd00d8bcbcb37c9f3330c333f0d55ba0d03350ddcffccf4afbaf26dcb40bedc2e45b055c00055c3dda9f7ddee83ddac64cccc29ccc532b052610df363c03252003846c940610bfb2266bfc2504d6a20a427cdb28b32da332c994ead276ddce583a99763b991242c5c65d10e3900d596c4b29a77a01c0008dcdcfd1ad05cfbc05208e055ffdccd1bdd43090c6b4bca30a2dbec03cbee2edd9e29d05e93de3e8bd05c54c05edddc7a93db025c0a30bfb72417a8a2db74711f0df6572856132e0903cc9fefb772b22c04e372c0bdcbbf228b7d571666f010d7fc002420d767856001760ac2620e2205ee6659e05248e054bbdd4c57aac4cdbb450c0d07bfe5c05e34be3699006e82d07787ede2faedec7ccc7d18cb96c5ec7bdca9e4a08984c88351b052ab333e0a5b2264b9eade0ecd2513e1053febbc4fdc9e09a53bc30049e933edb3858fc3c021fbe056660e6208ee6d20dd905dbe22fdce734ce0577bee75ca0e7b45ede9e1dd15e7dda81acda575bc7fe3a940570e8a1de672ef0071be5c86f6d2e931c269a14c9085ee97dadd30451996736b7d4dea9da0e11e5f0089e6354d217000830c65400e27160067100e2691007e9be05d03cb5321cb5546bb0a64de7c48cde78bee7692007fc2e07b2eed9fefeefe94dda746eefe62bb582fee6845e015a1bbf421e500bd050476e3bb6432a8d0ee9908cada412a5fd4601e5bcbbbb04b1c0fd30c553bec09f7c5b4610d4cc180003b07a3060b0eaceeeecce05ec5ee6cf4ce66a9eb90cadd050b0c7c87cefe7ade700dfef78deef011feb9f5dcc74bec7622de8d00dec0b9bdf0e9f7a0ac88a45f008004e498f1c0b4a5ee019dfbf6a3b13230bc5381d6e225ff2383d10231f46d230352a00010b50677776002f6f06765f07ecbeee712007edeeee377ff3608dc7c42ce3c68cefb32eeb469ff889ff05332ede4aafe3536bb0c8bad41bb0a7cc3af5874ce4479e31da92e426b3e4a0cf264cce3a623f0fc1cd28fb30f2f808bc9a1e2521c7029ce34278d6d8d7bd057c1ff0322ff3205eee9cedd054900526f0d55230e377fd7ef49ebdef466f0886a0f8cb7febe8adf4c5dcf3a78db9f799acf769f90cabdfdcb8477bc0f993c4e88e1c0b90fcc819efec916a0b50de528bd26d26bfe9c5320e00e162058b140c0a2c08000040011531a46c8963478e9c381325424c6326cb162e5b3c66a1926523152e254d72493351e5449486e4188209f3a5cb95694edeac9253a7149e3d4dcc981163448c1832466ce88081c281840a9d3e751a406a8022aeac5e75054bab2d58b162d9021bd696aeb165759d3dcbebdf3cb6fbd8be9da70f2e5cb973dfba43e560608a83049c1a306ac64c1cc25c54e29183928bc83436b9c4d922b263969b255faea439d38ea1cd9b63ae4c5cb9a4ce9d3d79fece306162c45018305657e840014181a6506d4f5d81551556adbdc5fe0e8b162db47ffdfae9ab4b779fdbb9c9ed96fb9122c58b150b160c5018e0c288198323c6418c070f672e76d240a4a8b2e363cb721aa79c1953a67cf99de56c062dba4a962a3cfb9b064a0aa054230a86124ae8a002d968b3adc1a91640e5aaddb4aa05165b6a012e43b3c0e2059a7ef8390eb9e4e4d2671f11df726e2e5e2290ce06071848a029ed60c882303bec104f8ef10c892325886ed411b11e2b6a0f34fae693af93cf5c8209b1952aeb2f27ff4c135040a0868ac1c011125cb0b606a39aca0facacea8d420b35148b17b174f947c412dd5a8e9f379733519f10d92a514477fdf66040ba8222900a80000ce86006f48214cf901c5792285144e04b6fa51d8fa41447454103adb193aa2869ca9efe338127a28012cab52d9532c04b4155cd6e8005921893b732c1faea42e0d01a8b38e44c5c6e9ee576a5b3ce10f5a1074fb6dc1122823e39700021a718e8008b8aee5334bccf10f3ac134e94342cb48968a214d39824faf65b99d4d38f4a4f45052a28a08c724d41030a802ad0db063800d658b32a134334c7c25517b57c2d36581479ad13cf14e7292702659965a036ed46f8513c8bc7d384134599d4b6934fb875af5b95c065b26492cf1df933f71c3b89b2ffd4e5090a76dd256186128c9297c1a8be94ea803df6e5172bb0b6fa17fe2c360ba6472e3a45e4d539e4ecaae545e99aadad000e648008bc6a61ca58494334318493503a21bb1395d2a0346df9e24332beb35936893f293f85795452dfddf28254bd9418cc020e1073df5a2ab46af00a8b0e6e2d7ae8616e9f7e7ecdd344bae4aaa79e7ed8722482045270c0017b0158e0821a2a1e6fc76db5dd56934e4619fb632ecc665b6dd9e7c31653b84be24f8a2ca478f9e5986368f75d198c8a6d5ebe790e0070a0f985c5950bcfd490acb088fb759f621977ab2ee486a5d32e26166080030e10aa8d810bb080c8e224b7fdb8134d3e1925fe5138f12c2644ee47c4104434d6dfebd951ce54655cc63bdff18e4a33b0d20c606094d55c8002fdb4e99b8392c784e591c91518721ee2c0e28c36edca1e8beb95f6ecf434ec156b1ef560cbf722c001063045460cc00016d2a0b54971e274a3f0182746410a1eceaf13f983c9fdc896bffd11d17f47e21f7d6c07a5d198a60a325357f06630bc1234f081535915cfac938408c5aa79fcc2d099bc52340e3ecd2e6e92cbb0e47422b694c3050b904ec4161015038c007de09994fbb4253ff909838ff3d3182710118a6d09d286f7d35fdaca162eb741a93430330d09801794112cf0540fd4d9e79ed294023ce211ae40c56e96678babd80a4db7b04507cd882237cd831f714123b0b0a1aca905608e0a3900026090b5497dcd101ee3a3309a210c3f7a8c14fdab0b4532c746b6640a5176f94ba2126572bbd1cc0d923db9db1487b79ad818248250c14ef23c691551ee0b7a61f1179ad6d2abb84cae95b1d4de2ac0271d84dc127417908177121513d5ad2e98a32826ebc4a6cc640e9490da42a4da80a8c4957c41344d340d14a9344949c28b9b7acb24ab0425289f7df293152cdc6f6881a6cb590f96bb82273cd9f24a3ff449050e38c81ca592800b180a8f890a642742f14f80fa317e3b4d26eb08bacc1f22e28769d3d842012807873ed49ad714d024b77951e36547a35309c01e3e7a95adee6b16a404cb48d31496cb2deea4794a294aebc28f743881452a90633803c0109b5acc865d139bfc48218c6210d3a7fdacf3ab5043510cd63133a1fa536a22135bb22f34553f5182aa1487c7c0a45c20a3123c00e01e514e5774d5ab62156b863ae82b38650f8d75aa131be7f10807a4e002118b403d0360be7c56a486bf04e61f474158f925d3af7d0d6cd916491f20966db1317968350b7840c996c0351de800076613282c4a50ab8f60852b380bb457bcc216af082d7074a5b4d29e55adb16ca32be2188102a46001074048f86a4b871da9ae9ff0d36dfc022bcc62f497af7ce5ad718f24446d25f28834492e1772923b2a506977a809def066b025e84e17ab1ac5257659c18a7102ad79b0a08577c1fbafb5b4a59dbf7aa5c2aa67acb7c0a22005e9130316102306a80006fd66f0020d39a1091e93ed13f023c50ef91864f9f5b5bf476e0661979948f90cb2a8f60b976371b2132abcac5d511d958461109b0b58168259fc1200aeeb0a485c021220cd2086d2f99b6494d85727ae133fe4ccb411c6e543fda0072f5ec0a23eada0200b28408d65a005c2946ec7a7f3d88f895ce4451fd9d1fe15ea70edb74cfc0df148e8c289491e59a56c4e913baee9f2052c5c5d0731619c9080c4232e5141b0ac99cd607173f6488b4639c1f2387149f13eca91ac17af800106011f3ea565dbaff5986ca300b26e83ccc347f7b71949f6633287b850a38eadd296a609351f2a370049518132101e0528206a172604c3003880a91f5109333fe2ccfdacd66071f274d25b2307446f614e8adcf108cef98901104840b06580851cd3816b3c565d7e8b1cbf663f3ac9851da2ff06894320e26fa1212bc97b1e1a992c60410a58687002853759042908017b23f526c589dd4bb47cd59e25a555c00b5a758e9044db7ba59cef6de2e6b0c5167ef6d302203063da6a013de2e9f1fbfeb853210719c90d2f46928b410aa21e71874f466c42310ea98968aa2491a10216b080c06e8f7cb2951db5263759005478b212aaf6ac55626e0b5a8436bcbf296908b7079762c945e7b59e4b39f6209d08bc31b6c156c11db50613e12233b77c6cc6288ef16c47f3f5d90fdfa1b4fd47e4b13539262ceb91637ac4052a843c81fe5898a4b7b549f2d52c8841e7ceea7553ed51a0d1c215dd45dc3a43d816c62daeefaed4b9d3d8028b1748a73aca021fb470c04b84235aa7bd657afc2e7f645238faf252cffc22273ef523facf3da1510c4ad200129094fecaee3a4d8465b0401954710418b0f0467926044f7238d5b5bffd886d512b0db5a97b07630e6349ada769255d283e81f8b5163a00e5e3a5833336e10a2afdf22b0083ba238b1faa231bc61b8566a0bab461898ef088d2eb3801f1b88e0b3b2a408d9a21819a090a18d0a61100b76d8a8df80bb30088004ff2a4d9f32a57a8bbbaf32e1233185f792762710b138aa55ac3861f8800eaf8b53f83161dd8821cc318446b9fc6eb23fffd22a68693bafee221aa0b0552009b4ee0210e749fb5f9c0c8101012f88976c93216e489d2b39215e40ee159bd11900d044839db7080ebc2c1b70329fee3bfdff88720bc39a6610e7ab81cf37a9a5d4b8115f0353efbb50e804229fc9ab2e1b142ca986aeb2961cac2a8dbada8bbbeeadba1633a26b0318431e4a1690a99c4e8b852590d53598d494241045ab0dcb992126817706b972d43003c54bb4d5a00ad3ab375bb04777385551b93b9a395fe8b8b0014c2d312c2845198b718873df0b31738802ee38005e4001d30ba34180f1b421db0e19ffd09055008054e9cc0bfdac0e9e3c221f39ad5218566c840439032b05320f6eb00eed09d8de808d2e0fe09fe90281298c3c98ac11210359de19908f88336e8c34a403564ac3dba138bf02ab1551ac05d9987e3689a696c233f7081e9f835f119c981333a3ac89842dab1b0c11f1be20450d8c49e8a1f9d3a36ecab3e61d0bccde3a18f81899b100929c8920cc0800a98012cb8914651947ff49d2adb1d2bd1013a1c9e0eb0ac7353080748823d68844ba804766bb932dbc1910a2f8bb48b66ac077d5823455c25b68007776802171088050c1f04a02db1e302944c491b6ab2fb110441784950f0cb518049bf44a4cd10c3aa231b848b09e1fa8caf13892da08218c8800c080128300cfa701287ba829c90199da8b25934bb29ea0008823d20c88346c0c14f2ab355fd9348a1c9a0fda33bdc4ba5b18c8bb23ccb94b28b7da38e1580cb04bc001794163cb8c4bba22f45b91f3cb083bd4484bd544e41a883f7788f5f0a0528132e53643cea4c0c8e83c315e41dc300ce949489a6ba0234f40f6e038a1ad081c97a17b8fac5a7580023e043763bc6773bc658a93b57a3c854aa8b002c91b342cb8571075e1008f74a400630800b5081a27c89e044043c18ce6a394e3c604ef1a803c248038f2b3d4e490998f08c99b044930197b8694a2908092ef88291b944b0f9c0ccec091280822ad882fe20c819384f5d9c011c90016f3ab703788121e003d37c3b776bb9e59905b913a9911a448d0c163632a3b46a2769084918039f5ebcfe800e583e3b70491b521f8bb18388304e098d03c120bf05330924e1274d382698285124d13402e21495a08389b818f118bd359502edec88c7ac1919c081e0b1d1d034370741000c88811a5083adf44356a88451babdbb0b8b23ddcf24452f4584a5761a071b888017f9b5d928d06889882be5048b218c8a88081ca983529dd0f11309b9113f2ea00f53e4311e42d19998894ed94c8e308cd1a08c196a0c8f70224ec11d12d01d054bbfa76c973df5530c2b800bc8009ec08240f85157a884ec029a58d03f464d44c9b19349cd13da5ca313718e721807258c2d197b2ff351012a88039838348b418997c891a31cbffdb00c9770acc6fa8230e0a74afc8420fdd396379d88c2c88209039e8de0880733833a308332a0811760010e5001a9c4800c180160ad822bb0d8cd844329d0d33d1d9e1c90011598cadb28800a985828a8322d88044f72b9201d9357709e5a68cdba6bd4b62011e3d84f21ec4f8d6ca370453eebc8acf081011c48d762fb543c98d099d09894d8d269a9c4c3a4ceb4519d7ded21aff9d7c5900210a8a4a2fc0899f1081d6001cd11cdb92a0004e0000c9858293009de5151a0c0011b454f190859a8280009c800168d992cb8031c64d95871d9b0e0bfd0ba48ed613102245c02349672808e66b10e9f351f2ad51a97140f83fb251e7bd3fdd1a199ac4739c88931a594d5a1bcf93917ab1d810a20fed918409fdc09d80e50813c708108e881013037a9608017310092a5cc8d909b8ecbc529e2d80ef04589d90ebb950228780229a8033ef0a8b8e30d99132dc1658b7aa3596fad4d362a8722702f5b625c0ee0d48353d7a8fd98ae69479f222497e0022988cc2778820ca882bcacc967035d898803058b01a5a0800e8001b10b892c98df1c60855888ad1f78800b7b012060010330000aa80092b0588b75ccddadd13e4dbb85305b60cd0028205e2930831fedb05819d2fceb3fc39d87df6b9c77ead656621826f8818871959f9d52740d474dc083d4f9181cdad71d02c5678bcedd91a4e1b5e0e15ddfac33aa4f2805f7d518f82d5f12900007aa806515bb2cfd20810cd08140600558708102f80117088018918a016601021dd90c788c056ee0299a221d685b19f05d2c4a880398d8197862f42dde0ce6301cdc17db739e5708c446452b5ca3b3019435e7a54647b054b02dd71ac301d3f9d41d3b36648b9f4fb8be66008532f83615d05e197008b49d8292f8257e929f4e605096e88f0c9000091037414520511e833218844a78853d28800248022198ae02c80116904a0a186510200905cb8959a4516295010ed099032880098682100881f3d51d885459965dcd0beaae1ebccfd89c37b31cc29b4bc4144b917140051bf0b598824b2a1dce2bf527523085f839e7cb13853a805bbd31e064a501d740db9348a4f160fea64ff557c77c625216b70a009e0a88d831088231d0833f60851e288090940a868081c81ccaa1048116ed882b28bf3d6d1733064da6c02504d8c73a5d4165ce020ddedb58a98599a339b048441299b3b3f4156d2611f37a8b7580851fa88e9e992df3115a755d8445e004f83105223305fc1a853a80012f438857eec521700349065656d564b5090d2830810c10b7fa7d8d0920ddba9d811af0b820805b5cae00ed04568224d965d59df0ac82d2a3028b8e30df6590b13ddbc87ce2c85ce6d34cd40a9a056996e6b520c09506be97d6d69362b179d00521b081eb709540c3e93ae85e1b72e4735e1d53906c4ec0020ac801f72abc18416a1e08043340bdc8fd645543409b20221bfe098d2a206b045e8dd5284ab1130c84c5822c2083100dc89e208ab355db5e363f297aca344e8864bde4ba6551ba26831f2dc6bb1e136ae5c1bca63bb134161159a35b539857ba3914391668d88364815d401b491cb8037274c90dfc987de5404390820a708356788102488037426a04188240a8032d986b99899d02530f181d5d04365beec002c13083342855e744d5e18d99d3704311adb2b42e3db62ed6600e9402e8008798ebbaa56b377856ad4433b1ca6bb1e2eb25856eb3946e6b4e4bb6a0876b08864028031b48811899a7f0b9813bf05421fb04c99eec1990002c088658c8830260811f972e06400037e86c8f03569e08fe6dea549237b5099ef868d20568eee0ea26de821b090f209932a9ae12ffe0ccf4ab012912e6359ef0abaddb2780822796824078c80dbe0a97b50a9955c6d87c1c56b23713364b396b27b888863b688c2c800115508040938e0be000efe6694e10850b9c475370df2dc80018a8035188065df03319388321782d1628038feb8976a514fea1838e185e39c480a1840d17fc7211ad02a56d509a68aa5e16d1d37843b516b9629d011678eb42315f1e3ef3654dd93f58b7ab7866377ff3116b4d371b11db8cd47980077a2819a6aa820c808d1450160610da2bfdb1762c054637846396193b1886678805e9e0800b90001408c89b6812c1dc91fc61f2278a0182fd1c01a1144ab37541a088ed004f098b6928dce1cc06b3605817909fc001622d78b8955d41cd00c8e46129180135384d3ade2eacc86ba181b5b15476265d874dfe8cf1d3010e28880bd00119bfd21d7ab62126052e9019f12b5542a803b1c30232d0b63490083bd04b28a308053b738294f7798fccac2dca8d680c1b219727f9c78f08396b6a172c30e3b63dcf0b900a871d8109a8e09290991150f388f7a489e7e021052b37a3732615ec76e20643388423b1832de88082408043f654216e866d37054db0d76fc99f4e384ace48832f8009303889c6a883bdd45099c083f8f5684992c3d5fe79e0c9f7c898a1a2578939f508d20839d353bd1a5581a8effd00ac5e62289882d30804d3d4fadd50deabb0e3af1fec129654575ad279e00652080330389234f8d813b8002d886197849f21967bb079dab12124654a1d532cd1ef8b83c0ef259778539d378115747e9e5f0d896d6df4d982c7c794aebbcec858300617392c28f83d2df81c78651590810aa0faba85221d4859ad97d6ad7ae68a07085ab660d9fa376f9ebe8308f5316ce890e13c7e102176fb64080c18431a35c6d191e2c4052a780c71f2c46914ca66a54c91ea448ad4a74e3251166b66d3e6a84e9a36ca3124a70e50418234da9163540e972c5548308dc1946986a74f67ccc092254d9a38768a1e9513c7681a2e629356294b858a94b454b1ccd081fde32d0e1e2c3ac898514142850c199e4091a225d0a3c0822b3d52e5ea91abc48a17cf72356b604186fd14523ed87061c285960f8ed28451e326529ae46c51c1e082163c9c56affe644a254a94c250861a75d3e6cb96321119e28d67ab203b1b0d6dd528276c15285247487daa5c0a092959a65fed6a1de9582e65b75749eb9d2a551d3ab4c8a81b43caddbc7aa5a8e1f3277023c18817d3a7ffea152d5aff1c6a56f8903f6509ed730c29604ca191262d19b2860a2750a0c522ac71f2496c143623cc6ca3d446d328a434f3124a9d68c80922420122141ebc11c5531a5948a15c7331f6e59d745c6cc18557d775255615649525055a6ae1e0d60c436aa1fd435d245085975e7db9211f94aeb0325f7d8bc5821f2d934184993ee958761997995916cd28534c91114c9f68a2c90c1c3c888726abade98927b11d831228a28882a14dc7d8842186a308030a28889038928a44097794582fc6f8e88c4a49cac5573a1af5c517d95db11d143302890378e2e1204309264437810413acd746237fec01a560ac1c56a595af1484d0645c7ea98f44015ed69037a31462a6212f7d72ac196e9a212727735298124a7b0ae3e731d4f619e8a08482b21a22bb91589c718da6f56873de5157d68d69587a69a6d99945e359a00e291e92339c8741aaeba9d1c81e7f38022b62b2d2ea8a2d89c572eb3cfd6406e07fbb0628cf2887fe104b8a296a9252c70514acb1939c719e145b6c18fa294c9fca08a30c3119121acab6abc9442271c619d5685f523915e38bd24d57855262618714a3ed66a75d1554cc881615a0d22b5ea969dda56a06520cd1081fafc617e5c0f41d6c5044fcecfa1f98627e394f34054651ec879d7c22490717aca19184ad89f2b16cd392dc8c32c7286332a07dd7164a27dd06ee138b617191168ccdddcc545ad449caf3d0991ef50576437797d65949b7a5030f6ed52505164f4725850e81540d306297649d98ad911dc48fd760373cb666ec447c2029c5c8742c161d98d11b6b24c52909c882faf927317af3dd77a0c568083822bc094794ba581d4eeee2ca41712ecffed40d8d23e55f186e795add51b1f9d26f05991e5350c8c007fca8bb02c9eaacbfc2b57f0bf5faab981355164d2732e2920ebdc41057a0036b74b22667d1cd6e1852c685aac5bc09e66437c39199e1bac314e68c80394d89c10c3c25051f1d6e84df3be1587e74b922bd855e4a9b815e329097a7f0a1117e784f942001092a0dac16aed80fedf833bb21ce831dc2d0888758221352c049420b5cd38440d637bced2d6fc798e0153104384e0cae3789024b52c6f5a8189cc73bdd219a765ed433149eb03b2b84cbbcde32831164008474d44b0cdc70358029868703db0f983613a62d25644b94a1873278e3a10fed4413aad149b31aa9894ed0ad7824e3934dfd40518cbe11e342c2001c2513158a50f0e638d64b2374481095e544c78d4433a11b7bc446cb6d072d6d818b786400aa1942472f4f18811b4e87bac2d48f6080342442fc233bcc54661edc0885265ea320e3788c8b0b9c90854206a8db600814cc2346ca9e17b8e8458f9489d288585c24c64ea592292690e52ce349cba2256d69a2c241092ac0941948c1972470c31e5e853a55186660af7085ad8e293642169261c83c883c44d10996ecc41085c0519c28a9c0493e6b36cdd8a430400aa8d88c1250299b4d6d3aa191e8b98494174ce13a11973813cab3a6dcc99c3ddd322ae640a79f7bf967d570281f54042631f329687dee273bb1e9ea20f0284780fd28030d9768040c3ea383264c42c935c9446da610d49f423a1b94026e941aea1bc83881a84e8442ace3dcc858682442e544a5a636e50e3de745af1be080399d9a912a6750353f08144a84b9c4252a513f407e8da90d95cc3cbc14447a70a3583bb1ea4610f8898e75d536b7290668438b52b6fe6d821712c45a6d438d62b424514353278da4e094a881cfae28c42b3da9e0167ae5a0af24f8ab74643b86c112f611857dc46113bbba5a70ad4b514de6431dcb544984c2106299026f1ad92c43e864891dba8d4d3609d25192d7ac75c3cd4abbe5d98f82722356e551ceaeeba8a8a5612317b52b3cb703a4b300490735585a5de808dcb460210f01ed971ffd1e2154c110b4a844ad127305a9bfcd2cac990b63aa443b715dee2a308193d4048516095eb16ee86f1b1a05686f62ce51bae436a40805292ef8deef4de145b4bde07d6dab5f2c64ae9ea2aad71d454886aa05f40f464e309420a18ac2b00215b442183217fadccac0a332fa48a486a7008562a949359c3544886b7213b1929880e41594986dc25218e7cec52f39273a4fe82828e06838f825da8ebd733e160e29c0191830e80e8ce03f20194a8641ae2b9c5c25fc59987682ec5f33e7710d4490820b5a2e1629d42a2199809914dffdac5841db21028656ccac5d62ee42fb5952a8a8ce17846b8d6754df0b86419e2a2c4b5fb0b0df21e1e00632a8d79ffdffca4e29b461b0fe42f2bf1e810aa2ee504a89560c527f18692bf78fa99aa9b242ba61874e0c2b0a85b0c92754338a097535371e4a3386400a0cd0be24c5a5062d8c551dde9be4a4d5e88442065435eb8b42a72f5cf8c2ab0d9129a1c9590a3fd273d2b030aa5cc220d87d1976b18bec08472438d953d221621013edc5e4aad1f9ab8c649b89ed79c44310bce1029d3d348a26364b6d9f5864aadf0dda0c953abcb9418988cdcdda9758109d319840010260800cd8d9536219ce17c21086a45bf7b6b50cd259363783f2001b0a7c1136b1097be042c38a3082a155c77d05e98f4f7be4252f56278cc2dd6640d113c7ca0d6e3e2a5a99cb5de62f66edcefd514e8234e44e37b9b1ee1362b8172ed89946477fb5d2053e4bb3f0570a33a8e7d47f5d9ea8d1a8c6596883a0f7e007aecba7125e5f7695c21ef2874ebbf40701452138cc099f50d2cbc7c2b9b93d6d1bf1d624c5750f2d9b9d574094c750702e79491a66d4a9274481f016d57bf9c602f080d7fa7b9b7a178d8a4415aa97078652305314cc948535645ef314e73caca62430c584dd57f9f39221434e99900ba310a9672b27e4a01a8fa92d372c3177286c1fde3483b7433521a0455d14b108ceee4d81b8a4c55868d96f25df58049c46b48bd03cdf8f64ce5a800af5954774988901a6811b605ee6f9c1f70d5362285ab4319a535d9b42a8df41a86033fd5143218001e5509221c441277859fdd91ffeb5d94da89abbe58698bd588cf5c646b84477c51972a4c513c814e5954f59f88c033e60bbe8576e51015bc851e421090bc88055880556005412741f086edee6410951295b604c49621846f9959e3ec0c3c83184fa25443a48163ca8431a5cd405695a491010c5c49e0eeee00eee9c0f869786a808396dc834850b2a75ca07454770c1d3f2059c1c44e14d9d45169c8f0e4cdf05b24012b44127b6411be481287e61401196188660b295a16038d9255009fe5c9895ad9f8451c6c8c1033b20021e0ee1cab5061ffae11f8297dcc5de0e162239b1556cf01c82f8c401ca16193945e3181c3c19dfab4d228fa8fed02552c125b645e495470d94070b18411224011384e3178ee3076ade238c61b2195a62b4a2eab8c21a825cc8c183facd6164ad202dba4330c4c1abf9062fca1e88f820ff01631ffee1df901322808279a1046f60d3686807059ac00cec133fe91a364e8713aec97050e3a6341e05524179c8000c84a40cb0002726013892633832c139eec1c499e2c40d1372c94a3ccae32ca6203ddea342541937c0d946b8decb799a29dc5fbb0d247815a49869117925a437814c75190a4a6c161dd8c8166cc19e81073ff1139034e1e155947164ca157464bc60018f8d0a4986240bd84038a6a44ab264e639c28151dcbfac23ea2896e899de09e6255479093d7a893dfdaec311add47000654012a5fe01a34d0ca50e160328d046f4100af36808f0c4864a61c71664015b60a56c69255aac514f0c071d644a153cdf7e658e0994c7088c245a9ea44a92631330411304141330c1291ad75ccaa46030dac84d19c81d0454a5603ac8e13cb843607ad14f3ed2efe54650fe2262c6dd9facccb6684b30a0955a198a28c4864f7845555ea2e365a5337a8755644146d2414f2045585e41d4650e5b84a46ac2000ca8c00bb46612bc266cc6264b8ae2d61917084e9c23a8a22a3e82ac1884b5d9a3e949965faea081ba833e0ae66092c4c7d81f1f36e7517ac8158d1b53326530e88dc858286bc4c6ea69a71950078fe95a451298f7b8fe9a2190274776e4e359e4d4755079a8a60ce4c04a8ee34a36018eee416c069481e9a85cf2e7bf4c4960a0826201283c469a9794c31c8edc8146d61ca6033df6a53dd2a33e764ba2448f1dc009471d0b51bedc7a21661f0a8a300443a1188a5058429e9cccde340387aa554a9552585c661654256e6dc78d6c812c8d844f504e1c8ca6559e8f8bce4009a4267baa800aa86511b4e63836c17cee815bba65296ede5c165a7f3e42b2a9c264609bfaf5653245564ede239422e893ce03952a43b9999b21e0019ca84d85c0040149e88784cc288842cb680bad7ad3de6851ccac54281982ba58a678eecc76cce98dc4818d38618a92e717f869d4e10005a2260cfdd0800ca8000cb0008dca6738be66381e18a42258b2c165a1a92241899e0a8eaa94926a92faa5ba3e693a9403377c921faa95aa72d1b194c22870e95036a7627694b6ac069e480ba08c52a2cc5af468045684c5f8bc92c18927a64c220466561cfca95552c55b285ce4d1850c74c07b5a2b4a22817cc22613f4e8076e5e40592a080e54a622e84ea2ebba46a9baba21bbc6ac3b508332d45c3184821d2cc224b9dc287c9562be0662b2c466c94663128a1491cc3188d78b55d74614ac46b85fc21e205736ac51c481b1ea69684aec9ebd45779607c61a6a490a0139da68b6d2277e8eacd609464c9eac7c90eb4eba21cc8eaadc862abb56d992c2833bacfe0335500378e1c12278d9bdf66c87b004d0dec6500aedb3084af1184f9f04e38b21e4d3ba9fe40e8d5c212017d08146e081577001d646ec1668c116c891fa504509646c7950ab0ab080d81a41a292a3c792ad380a9a186a9d185a6a60c4646060aa93e2237092aa93c6ac94c62c940a6f3ab8833a64833ae46d24fc6d9cb81d85f86ccf166e331c2e4c44d16c1483bd7e154d04e28b8dd339492ef80e4d8dc5565a001ce6ee29e66a021d786ebc8007a890eea09e6eb5aa80102081fdaa64eb822c6ceae88e12165c96a24b5a2a2adc66604cc6937eaa530def92026ff0daa392126fbb964339e4ad252c8224788cdb096ee04aaf62ea06c8b029ec7d94ecfd8d526e90937db9df05dd61218c4f8d8d00051440015c4008a0281d6095fab2eff9800a7f4d5de98e80d78ea4ea2681c7aae410cfe66ceee88e765f5c1ed7bf60eadddae3bacee10343701453b1143fa92da8aa6aa809978e82bd96c2f4aec45086081781ccfd09ad82088ed3065cea8585c1ae7058a4450c488001049dd05140054881ba68041d6871d6c68be88287e97600d8bee70ad82f1214c138beae8de2e86c926240e16813cc2eeda263ed869dcb3a690353f1ef5af115cf213468313671e9178331d00ea5bd52d2b1bc5e12a571d3fae439d557575c451c8468075d000c1b802ef3128ed4701fafc9fa7e6e59522c56962e5da8c0e9c627392afeb2113fb2fe762bff9aa2a4ce25c5a5e3e67509f056b1276f331567c31da016bdbe1e4a7c71bee6ebb881d9ebbd5d220e87232142b470c2312043b5888219a0d622dcc11a7440077423be488005e8325ea88a23fedb17c481aa1a8223456cfb4e1d78946e0994c0317fc0b45eab3816011238738d3a738ef2efd6d16eed26981f780d03bb6ccb7233373f7024a056f3ae726c9482188f712a73571455a675a95206cc80d5c6c1ac06c3de580216ec4d860a02becc801960810ce045aa4c40055480aa2cb57a249f5718b416e3411c6841d2bc2f56469e0fafa6d8da2f1324b23886e3451ff111eb28002bb1e679dfc9b6a1a8f2253777f2149ff41c62c250fdb0c62764f0388bb14b9b424cb7c6436601be490003288001c88019cc401d5882194ceb0518000d04010560c0055880054c00d4a040d43c41e0c5d052e311348a85e44c7555b76ff551450795ee59d2c0102032122c81458b6333d7278e125613fcafd61d586ceea7ed3e423f6cb249fff6270b2f3444c248603085887329a795c72823759c471979471af4130a4c370a3c775a68a099484112da98e065400898c05612eb1a48f522ccc11700723153050ce873c622735a0ab1100fb1fdd2676c4ab22403304bfa2f5cfeef6e070636d72d70ff765cb36b3604c2ea8198bfdeeb27d8eb38178f5a6de4562082e158cfc16285998801764f0186a7c11470fe3876bf08be45c52a958f5214cd1648351ecc41c45a6c564f1d0c8c005d74401672acebaaa423efaf7d77eb29525cc90606dbf27680fbe58007b78037824a4f083695c28283cc17a3c46a9067e6e28188a815c2ce9aaf1eace462391c5b78768378e2780ae35101e8de0199e3f316b038c596807baa007b1b6aead6afc7deeffd2aea7dcb665c8aa14bba24b8165a3f04792767738097832dd833368d822728398337b88772c2faa62a49782822d801562024e4f286e406a0fb595a97cb9408311e9060411ca8f81c08b31592ee9acbb88c97242722b2102f322337739d9b757e936c9edbf618f6b96fc7ec5e9643ae07ba38b42b340885c7dcf592bbb417fd1f3bb2ab95fc95b1ffd5db95527ac15e7af86aba012e2334164d773aeb895bed995f3543e3d3a9b7b9b51a419cafa4a2dee81e90a3126f1e6c1a9712f739700fb927cbfb1cfe3a3a9443250842b3b446e27ab14b33f831d8abbc022ec8c4844abdb217adf109677a1be1952d391e0e60c1168cb71758350b45de1c751021cb78eaaa2e6bcf39c8ce676c8fe36ca2b51f7ce1c46d5d40c17b90b7bcf092433aa0433a2483be2f029d88734bdbc928dcc9cafd72251da3b925822fbe44222402831aecbfa590c377a714447c557ac19f4a9f2ef5308c7f009bb340eae6c06a87b59c672b6ccf277d1ab1c9e3288ff32761fdb7cb7b32cc3fe9afb7ab1497fd03cc8f432544d2b1382f85247a4b9782284cb52478426366084ab044e073304ca8cd12755576ced3355a605dac85163cbe16e013a994c7436ff5b4a62e32d3e8c7c7f710dfa8384ab26c83a1a059ea4bfac17ff7fabace03bd7b72db3fa9042ba93bbcc205c7899a6882b1ff7bb48cf3dc88322778139b0a25c548ef4d18cba811e1c1c395bb54019e6a8e6a5285986381555b206a53fe56836d496afeab37b233cbf66bbea6caa7f56dbbe4c92618da437039b47ebda7fd93c23cdc03fbf23a12407ce284e753c151a5108e12755021a74578f048e2046a54c566a648552445ca54b3661b47651c152a54274327519efcf2854b4b2e57b254912265c6fd0c183046c8a8890507959a324a94903154684e191d3aa8180a2409122449a032919aa449132655af56adbae7ea9e265ef784f51356aca3b17b1ee94bb7762d3c78e9deba2d478e6d5dbb76cbddd5bb962e3a71b11671d2c449f0274f9f0e2214e589e1284f8bee485c38cae3c78d1c2f7acc08926427442941af74b9858bcc194287a69e8103878ea1a7859e4e9d3ae9d0214d9f424d22158954a95a8183253bfc2c59b37efc3cea076fdedd79799bef959e2eeff4ba74a9670bec903027c7150f3e6eec49124449a2261fbc4cca6347cd973b7f068d528ee8975b4c0fbd69b4c4ea19236080ed27186420b0041654504a86db9cca6d37267a6322aab0fdb4326eb80bf738cb910dfd70c4ba0fa5cb8b1cecd842a7c4bbd0a125904506639113c4185328bd86ecb04310c9626ce6188f76dcc814f78aa9a89321e733448efae470290b2aa4c06206a4909a8da8a082aa6906a06a934105166460810521760bd3a9a67493d02aafacfa8a4235913bab4de41cc9d091e840acb3aeb9ec5c2b9b4a24124c134d180b143d852a1285133bea10a43bef463966471ddff3a818cb4829a9c823ede3228b996c1a01ca1172baf228d4fafb49281894e2b2cb2f1f6c55b7a8ac7ab009aa8a03ab4db2dee4d00fb59ccb93adeaa623d144bed211271d72788944a245588c51214fd043af94513841041145bb5be8d1ca4611a6fd32618a21c95af9f038d25cfbb288490a13fef314ca0e4e85a103a37412f5280555b8a94b21787bcab77fabd2edabdfd4acf0385ce13c8ed7bae402b64e87f722f1ba62d341671c4c04c18359c226430fda681b1a6851502812c6db664cde569891c6add1103bcc4d234925979422862b3d4d10290287eaa05e1c66f37928166e4a90855663f58d2aaed2240b2b35330c8b43b3e4dc43d785eba2334f63ad1b9158628db5181a655d24ece3c5a25dcc1350385134e3ee4a3e4618b9e73699da6a3ffbacc623d348c3a596d4a5e94a7955e8e002a45430cacafe5c036a682e51ede06882030e132bdf82dbaa09e4d0b4baea38af86d8575f492cc7d872f2fd0a5b9c715e916411d7053b8c31f43881d613c6ba93a44fb8bb3579658a4661bb658860ee9b0bd2b6483e0b2c9c1ca1a612de85f2351caca41ee8d4f48d7272e0ac9a6a37ee81a3eaab82bf8a33ea84adc6da3ad1473f912ed42916477e682c797d63d9a78df6f6db39d1ddff9141b13285902c786cc39b7c8c2407bfb5640b54589ee06a42a0e8454906382895f5a454a0a3f8ec68bbe90d702424bef1696e5660811a9cc41235473c222cfcc00b5ed8f7ab18da65586be15ac5c2762cbf88834f78b8918bf6f731fe79c22181f19fee48260ab6918c64bff8850109f3323b48510e71488319b6c03c2af8640637830d943880945055cf4ab481d7bc84fd9687a78110735b094b56ba72213659486a8e501fc466b8963c4ae7867ea9980ec5510e57b84e63830922b49ed59d8df58f914c74e42309030acf18020f94ac9115d390c525f9440ace038abb0a57b8d7547035d4fbc951b0a42f16ac898dddcb0a2bbb27c73379ae436549cb9d80b5473d422c90283a1675aa238e1d0a9398e2b0457920c2a2160da676fce3cea274d73f9249c2128e7422287687884a12cf0e563c5ef2b6b8452bb90b4a3cabd70ca8c093eb69092941015097d014b0abfceb37bbc9d0e53a77163752482c63d9d59d00dabe1bde902d81345db146240e7228547ee2c0462432f6903f4db43b44ac9dd926d2bf23223189c1b82613f1fd76126b414481c9cbe216b120ce1278ca5d046a0df5b6c81aec25e893a01a0a9a249415ee5d85566369dae6dce8469fb2692cbc7a8b2eef02bfbd30942d0ba58eb114ba50bf906387d8908420020391892af3a2b5639624a0d53f41dc289a9cb0c4131f0952bc71e224e58ac337b3388394d20495ee1a8a0e601a53996e50292358696af8e0ca11522e699963023f39872bb16c6e43ea7ba11ea973178212748774a18bfcd0810eaa36547e36941f393066086625130f8311c89f087344f4f8cf80d40ca02882914425928c1396fa0c49fd66d22d5c21ae35f16b06c98857a0ad14547e2d2e81e0d008a868ce4c209455704cb839e25cc82c8e9d8ee808fd8a22ec9808b3541d66678bf5d95720a23bc9d4446088c84c8dd62e5a9290ad1283115f615c0b14b3a5eda2da5a1fdd2a8f8b19d4c9394b3994e2caa0b8a022501b58b853f00515435b39ec74a76bddf565f72eef4328eaa68a59ce7e76a10db585200c71de873c9330134d2f582593d18ea187648248d41247812d4e74e2139a38091de2b0dbe459e1a454b0e06a2ac89a9ab086355a005a8141352f9bcae0088f78c4d22a04cb0ab951a75e89a36287a316a4feea74362ce8b1b8663a726038b39fddb099e5170e6708e24f5f2de4a200e589f3eeaebe1cab48ca06a8e28a94b83b7fa2641c72bc5f2d6491c8acd1c190898cd79e29392705b6cd2354fde1b478164c84c3893286e818965b82289716c6135fa06a436c8cf9d3683e7343c3010d369f37b55c2df1222c5a564e18ea3c85f29ddd04b8e7450986ad780074f2beb006dd6a410bccd3015e114d64512139c9c5edc0101aa10a47a4e9725a518208470835e1442dd356b3138551e7d4be180b3bddf54b66179ad05387431ce1c046204eb21d4dbc993010318443fe771eda7eecd6c21045ae75fdea79cf01d02d0134a0cdb086356031a5cc5b8d8ff1da3802dbd4d9009217b421a10aa7e834739aa3d095a92be92cd709dce1fee5b98725ccccaebccc9cedf086c3310e4b9c849983d1d8aeb9e33f514864df86fab7effeddad8a844264a91d6b1c08fd9e8683233c0e663043b18bcd1a9ea8739d13dfcf7151857157346109d45e23acc887e980693bcb48052ffc4c9772840a13ccc47c7931519de676fbc217e4b0451de840078ace9bcfd05ce4d90605b28a1ca32241ac398b2072705f2b1cd06b2076387bc21a88fb1654ed0201a82e5f5c0eb4e1129070c523e018fa5991305667b2a7561ecced3d24c18ebcd48b52b9ccb5d5d925dd9a65e8a9cf1c8e70f8221dd18099de6b8e87beb7ba88fd033c7864d428c27bec45028748e2917ef08513bbd8290da78f4d6953771678a5375965e73fafd3c3824f2a9d9b7412308de9e7d8a5b3ec8b2ac50eda5075bf1df79c6537bb7da17b788c431076a0034acefe2b99784d9198c57ece236d020f3c6cc7a278adcdf0e00ee2000f084efa4caafab488794ca95dfc8ab898cd5372a0112ac1155c0115c46fc1cea469dee8d2c86e38d6eff5228b62c2ebb2ea62c3d68ea15eeebbd8addd743007f3c11d82a15ce4a0920843ded44b3058e4abfa040107855ac2aac40663a2a06fe9e240d8040d0bb4209cace43f4c600b4bc0048a8b040a8c0210ec12544104276dc1982673cc2fe42e44c25e30bc2826b3e08fb3e050a1d8adb2e24e7e7ca1a1f24f0fc5211fe041193ea38a2a8959fe44f89c50bd5e87b51682c5ea2b789c2900e7edf9ea0002aba8f1f62b8b98e70ac5699c46805dbc70a548000c41050338800f2a2104fdcd708d422f6aa66c9ec6c7d2d24f1f5c0f9850e7160389bbdc0eeeea2f07614ef7c4c117aa41f7aa211df4412d5ae1217c4d0085ef21b603ceceabcd8a10ce1c020f704c0a97ee123369d89287791c2e0b678004b6701c41451c930c0186e01144b00c3f8fb908a6b93a8e7c9666dbcc670f68f15776c91671d174b826c3ea6fdd504df7ee6f18f58f1ff4c11d92413010a10e221011abf109cd8601e14c1995f1f9ac7102b111d0aa8825e2c00b2af0f13ab126c6711429cf0448d15330e002d451045d01165c41151e618d506fb9d450db9480c1acc67cd60faa42edb24e871f3bcbd4368cfe72301caa417eaa21290952f7e84e1c8e511fe68175eafe0d021df2104b8b990a4220fa4c302c32eff2ee12e3c05cc4b28ab8a0e0b8e00b4ceafa20e8344c920466601c47d2d90c60082e812561c125cbf011a62d8ebae7f4e408cac46738d02f275b1006654fa1ea10bc5cee1f714f290592298f521ff8c120ddc1192c81bc24812185b0c42ac9c6ba432bfde4099fb02b21c22be9400e4ef348e2e00b0a8e252af0faac2440c2d14ac0700b47b1b8288005545104ef92256132c1766afcbe8742a04cecdc68274d2775da2e756890317bf1318d123afb501ffac120f5611c5a0114b429f1ec60a226d1dea6d13b51cb4f2cd21a4d532cdfeaade0aa817c8c8bbcd07944d22d6b730b4780144d910f58b2257b9325fd9d0c12f4d2cac2842a0426dbb6cd6996cb1e9f2abc6e313903a9a180f2d4b0c139a1333a81510f8db11ffee11f8ed132a36820e2a03b4bab486c4c3cfd6ca20c21ef4ad334bd12d0588281c0099ca8e03d35d04ad665144dd20bc1b003c4d0155ee115eeb216eed22545b01118e112eaf21118212c06742a4a68d264892c68d1a0daefa91e940e85d23977502093b242d94d1f323443fbe1201392adea2d0e80af928a04004974a2e8609bbcd25c56d33e74eb0aae608be8d30b03e4136993246f73043280026840045f211662a1160c55484590851ec1483b0f1220214eb867f5a00c2b06d3e3be82fde4077538cb1cbe6bc38e32f78e121807522085feb10fc9c11c82d118bdf44b0db21d58a14fb693210d01814294926c35256c6c3e52532c57a2454783bf68825d622006ea331cc1f066c4d1464b910238a0125ec1156c215a0fb525f333091aa12e2fc1c95491857443096e3209f2401667b1fd1a545339ab53ff7120db8ddd0832ff04b2a1b86b0f8ff14be9551fa6c112ba83927c4d0e686e3eec2d4d51e24d31a5577bf557d9138286f53f0487246b62144751473ba012a235166c0116a43548f3f30dd0420421211545b0166c0115fc00fd2e4d49071343a2f4ccaa345dedeffe44353ab7f40efda8587c211754955ee9b5320361c6b6b346ece05f53e2f9682e5703f6c6beb23e08564ef1239c4c2046fd4dd258b37026c6b15d28400524365a6d411774415a81b416f2730fdec0c912b52ea1355a5d32c1e6d1f4ba95053bac58f831bcb0b417f7f05dc16b2de4d02f6af666713643d5221902c1807af667efad5ff5959248545753f30b90f62c8f87b7ea349db88836672058639426d6a51439e00fb0366bb5766b0dd56bf39385f86025f37373a335d2a06b38dee064f7601ee84f4a71cf1773af2877ef5c29cc866ad6179e726ff9561fd4e115142514c6c52229493050629bd69468037660598225aea00a9676ae9a965366a27a2df72dc1b0023a801528561778c11678a1732f1674bdd6c946976c591264c5d716da116a9420fdf6001ef8711c1a2a4263fed7fe36ac0f2b94aaecd61c96ca1774c12957957735341fca811576d633b4693b8b044dbdd308fb8c3e067634aa2026a0778bac570aa08004668249ac2406700203688015c0977379217c4d175145f00db2556cf3d36239776b6da1165061daf6e90d9a8011a0467ee5877e9d730f7fd10fe5c77f6be843f2765e0938430d721c06a10ecaebb640a333879699e4cc4f8cf74427b845a1f771c32983a520703885582b80065e215aa1e18ca1217c65186b5d52482f21098c74515d61164a376b4ff884a555dae0372ce0366e5bb61a9ab2a168a888f9c866773789abf33af520026febf99c30c448b4f9baca44cfa54575ebfab02083ab000aaa170a4c400afd727408ec188dcff884d7b862f353049360252f611668a18eb5f68e3dd7505d21499bc05b4fa88ffdb8283f950ead231fd2019867d090071891a1521acac00d04e15a1cf981a328c408432b0d63483ac1c6ac7171d77349b49949aab70abc7949a0c0b760a00d92e18ca5c19c4b598d6518483ff6f356f9955d8116a2d52ec19794a1e194bdb686bd822accc26dfd18295dae2e08992ddea22ef24198d982f7903889bf542d746108cc60ac20e233286a0067ace616a513d82a81cc858178ab8263225d98442640ba7a4d008461800fd2581a58baa5595a96d7987c3f0f2de6798e41d7156a4117cc191b58fa9eb57686b31648234d3774f99feb364fdcfe221fd4a2868c65a1195a431d1aa2efe00e1c12a398899af94c20a8395791443d01c79bab405362820ab660ac6542703a400758011a5cbaa7d1d894c5f773813416c416865bb2625d12647981adb1a1afcf19aee3ba7cfda0a8b1b44e0eda18d7e22993baa06d081cf4f6a97b371d9c4107c8a021b792d7a839b33b6114b252a3d9ea34cdf2782c18acd3a5b437498363a00444791aa4211bdafa9cd3599d53d815ae75730d1595a1d57ba1a1af79fbafd519ae6718168ada7e8118a0c5e11cece42df4e1a0995ba9a1f218d9621cf610b2f7d620d34117800007d6200eea20222a2a46a299b3393b2b0ba29a4fa28af003acbf89ac8f0772532a8264a00dfd765b1a78dbaf79faafdffaa7e7196459610f727b6ba99525a355a7e99bbefd5a1aee38c1e19ab085f8b37cc5b98f91b99f72c279a51ca4411c3094ba71761fdc8117824006caa00e12e53391afc449bc206c8c0e5ad482ffc6a4360972a5000674a012b2a1afb3e1c66bbcb761bb943b779d81d40fcaf6a7bbf663d598afeb9ba7d358c1f71ac1cbc17ecf0c884184b1d982c2a99c3aa1fb748c45c309581fb0c108643cc42162d74afc6ec47b144cc248fe26cd455ba4235706ce60b7b1211bc661ce71fcc6ef3b9d3b578d813a16f6c016d2f89e67b874d578c98f9ca77d41c95bfa6d4f0d440eda2d16a6ca215d2da08af7b49c80a3320f544007c0fe5cf8c88b5190afbc333b81d4bc252c7979d2e94a68e00fa60198c6a11ce81cc70fdcb7bd57b6e7790f7881a55d1b958554a74f98ad8dbcbea5e1d0ef98eee87b657d051e207cca23bdca1b54a12b9d77fbc11d58810664000bcca0bbc39ce8864ea34d225fcf7b810ceead565c9c6a0006ce6018c6612ddca11cd6c1d5e79cce635dc93b37a76de111f2e0d65b1a1abc16168074d6cd99a50bddd013dc1758baa8f364b9a93cb18179c2a11a1e289c1fa5c1a99f9d5ee781178620d3cd80bbc31c3ca2d9200442825d4223df0a3f96070b6480061e611ce477dd51a7dd51e7dd5dfbce155cbfcd36095061d67b9d1768197c4db9a503beaf159cee78efa8fd1f3ce15535b12513aa133e1875b79827be5eb3210f60a006acbdbb3d9de3f7ec24a6088bc792814e7d06824017c6c11de6c11dd6e1ecd9ddd55d1dc70bdcb7d55986013c09783e7cbf171ad8d7157c1d9d5bfbe7117ce0b1c10d4184ca113ab16ff62991fecae9ce189f9e80fb611cfce005644007aedd870883e808c3cc9f598255f39bde9b06f2001bd2c11d42df1d447f41c7a1c673fcce931cb0d7f82b703e7ce9dd627501c9e35c1c2e9c7e0b9dee7841e8e90ef07f19c20dbf2e0e79c25535c2fd421a147ff109d81d6c0108642008c07c519e71a3dbea652e91f35d23eccb012a49bffbd5feddc7e1c85d3ac13b17d05da1085ce1a5d5b8df6bfd01c1e71b1b00a2dc3871d8c6952b380e9b346c0c7d397c982ea2c489142b46d487115ebe7c18d3e9bb88f15f3f8cf940924c270e9cc77f2c5bba7c093326cb79d392bc1852660d1e3c8838ede484c8101ea176ecc89113870b972d59b060a171469a3b7deedc4d2c87759cd66cd9187a55088d9758686175e982a6cb961f24baa449e3a5ab565c55b67829b4eb362143830ccb11b44bd0172f88160b5bc4a86f63be7925f5cdf318f25f4793fc3e8a130759a6e6cd2df59563628406163375eae0315dd4ce4ea347936ed9e2f4a99f71882966dd3a8eeb57856ec9fa16cb0b2d2c247e16be8d6bcb162c5876bd1ed4aa90a0b4cb097d61f3fbd6975b94fd970d7b87acb1a449c4fb24271e6f591c62ceec657e44d502860e3369ecc4b98fbff5fd34699a62a911042e8c7164d555e908a4d556bbf1264d58640517162f7e24510b4368a5554b2dcb35779d40583d37ce42212e248e56d25877993e97adf89d441f5de4d1451c2146e349e8a1344e66ededd8123f07c2b2420a340491d37d6b98110792469a81851638c89087341a19786039117998a05e5eb9d59b58674963162c7b3cc2cb5fb668088b2baac052975b2b8af3e181d8c0298e76971de4cb8ae9618612452f4ef4e23d1f9144e354359ee7626d28e5e38f3f3c3e2a9940ba00a1020c358c76247e499a61066c5804f1473bf8585455555765b91b97fd0d42e89b2da83c52a138279e89e6726d9d48e29b58c119d15ed8e4f9e68b2c5e5612667fba88de47e21daae88d3942fa8fa33b5a264d2d49a8a0820c3594c169b75b68a105163a18918b45f39c7b6ea9557ea82543aa42f35697bcc0820a2cc0fe1a578668b6e5158a2b92e3179cbb62756f8a7c76d727b23182041962f7a4b32cb3c7d678d14bd2421b536ddac1e2870d1c645bc3a55a9411ae0e43442911bae7d288ae551f664550425da9da20575ea2a28a2ed8901358befabaa2f39b42f37920c228ed4a908a9875d71d3c307af498c4fa3c0ce88c34027a754416639cf1a028e9d2841fb6fc61440b956aab43107ac4928d7a35ee8311dc8ea55bfe605602a54af342d984a5262cd3055c8dcf19b2399d3800038c1543771e9867457e1d4b743af0443d37ba8322b61145825a3d59a259bbd4cf3ffc3cca0f3fa1f7a86839b9fcf04313aa64b88a1f45fcf0421fbd449ece3c95eb5e233e054694656e5d61333397604963cb9abc80f3a62f71c1a22f2cb990389041480b0d6c9f8f3d7df444bc4306b5e4878ae7798de437ac28e8d13e2a7547e3ace242043f20e1c829a8ac928b59b99843754446cf4db1899ce31cc1d30df1183433b2a8a9168d5b91f36aa5215da0682086e3d9d0ead438bf580946257a53f9eed13f896c041e543b878b3652a3ed95ef45fae80c624ec79ef6a5631ca888c00208000116fdc0e10d9188842bcea48a5338611512c1a0d10a8320bd0c6f416e39205a1e810a57f0a2700e7cde7296930b875c107b186c1c772ee38f2f66af45222461083d82c200ae703d2e6c21c66a340e3fb0ce8639804329b640853c824b0b3a6041047231aa2fb6082b33344882b8b2c4af34a8168f781d609ac78b5a414f82c0da22f6c6c89d7fa4c31c97d122192532258ba4316b7c92581b230329d3754415365cc00256608c48740107e08a83164480833b0c410001508f201db7c10365298988fc0a577ce30747002d5755acd52a6a31984a5af2215a3ce23f1e76995ff9e293223c0ce79a952c549a878da4abcc3c50b187213020052c6884318c410b16fd50000ec7b004052450060424e00144f8478e58348fc94984902f0bde56b8d2c462c28209a8900b152f032634b9c215b5c8e24387a6458754a39a2c4a8764b8f3ab5e24ea3b1c395f44dcf1cdce85d38d2ca911b4f4c18f79e822058170431b70808921a4e0008d58462428e1092bf0a0031250810f0a508968d003782ae1ddb9245295972551780825def0a4c1043fc042178f846898a0b71c683ae4a25f1447387c018e877c43685aab0c4a4e74bb4f2ae6586b546938a5e50fa9b1a751fda0490e64a08360602213ae7000041890004a5803198328c00a68d0810edcc10a9250c33a22424083b8836ea572c73a3ebb8e431af02b23724413a4c7d14efde62217cb714558a339a70b5273b6e2e024d15a8a1285e842251339a30851284a66558459179358a336d32847b9c315afa8810c92b10d6d34020e6a5043242ca1860ea420000140801b3470034578420749d88755b4923bce96eab35809adf07633336ce84215161da3597db1da2b422f178389ed1667fb100f6a2daf2871485b3003c27be4c36915518c49239252ba26cb25c6d5c7712d76b17ed8221adc60c10a5cb10d66c8c00d8238860c0a10800270e0063c50031c1070001660e2060c2895873a5b15f6ae83985d49e496a4010bc57514251b8dcb2aae58515facd5929d04b0803dead62e4e271d098687954928421a2d5822208cb04472849e8bfdb5546afc482e4bcccc9275d8621dec70851058a18d66dc53021d3080011860800bdc61a83938c0010a60890614c00ffda88a56dc518eceeef83688e44af5b4229dec58107775e2056bd7b45f872c99ad6274f290458711292318841ab172ff38b7652a7759b8fe5be34b985599586324b917d670342ed10d5ab4816478180106d050870e60a0063440317719100006e4400d01480003cc8b684326babd766bb4a3b5424082280416bcb248a53584e9242b99c94da6eda735164da2650d6b984b5484c5738e52d20826a5b3705e3152ef798b8e25fde0061ca221046ee4800105b8001ac6201f1c50820732a80305505c0004b4f80e23e0400e72900d7afd201a2102c986f5a8aa1beac4ec6ed5f245302b52275d5cdab55c4dedb02e19e027ff436ee9c046ba5738c2c6041073cc229fbcf5dd92e496b93230253a1ba5350f3eac810f2c88c61a422603494422a7067801020a70a91950c000165001022470011aa8c00842f8c7c6b391158fa7bd987bc926056dae8aeb786f222997e856632e34db368f9a9cf668a32c2318374118d51d199f46daf7a79f93b3474307354c2fd6a8d1f5831ec3d081154a41096368e1187068841a3c6083171c20053670808a87a0052a7000000150800a02b0022104801ef3108834b4320d69781cd22ba260ef47240d54e8c2582c1c613ac8e18b5ee00216aa38322585160e0ffec2bcef7e27b0acc6caa70827a6e7881796e2c5796633d35a268506020bea8003b157401943e0c00a1a61833d587707174700024a30071da4580277d0801a589003d0b00fb6971b359320d40169dc612503810db6f008d2602512e33ff8050b472617d23434e8e03f0ee47213b13ee9917c530661dd47828a8230f0e052301179ed310fb14029c9c0020ac0001da00c34b002483009c640096ce0055ec0062c200411770727660023c0098b500639d006aeb00f33e42e0db21042c67b70424121820d7e800ab7873e57e31714b82659b4696fb2691b586ed2e48163566076f27d257828a59339e8c022df246690d20feac00a6d90036fd0060c700123100db92af0028f400b91a0031c40015a20091cb00301c0018b30021240011d20098b20037ce00aacf00ef360224fa810b1b581745722b5705a5a2831c5e23c69825a61987797610ef15686ac68342ef456d5b4526c88396ef589873287e1b78b2fe10ed0900c8f900443400827000325a00d2c600342f00a3910092d66055da00143a0628b900115400114600665100cc9600bce900dfd3043c6e32eb1855e74e71757f80807b646a6a80ba8088643137d6fd28a1c584db6e53f0101003b, NULL, NULL, 25139, NULL, 0);
INSERT INTO `employees` (`id`, `employee_category_id`, `employee_number`, `joining_date`, `first_name`, `middle_name`, `last_name`, `gender`, `job_title`, `employee_position_id`, `employee_department_id`, `reporting_manager_id`, `employee_grade_id`, `qualification`, `experience_detail`, `experience_year`, `experience_month`, `status`, `status_description`, `date_of_birth`, `marital_status`, `children_count`, `father_name`, `mother_name`, `husband_name`, `blood_group`, `nationality_id`, `home_address_line1`, `home_address_line2`, `home_city`, `home_state`, `home_country_id`, `home_pin_code`, `office_address_line1`, `office_address_line2`, `office_city`, `office_state`, `office_country_id`, `office_pin_code`, `office_phone1`, `office_phone2`, `mobile_phone`, `home_phone`, `email`, `fax`, `photo_file_name`, `photo_content_type`, `photo_data`, `created_at`, `updated_at`, `photo_file_size`, `user_id`, `is_deleted`) VALUES
(7, 2, 'E7', '1970-01-01', 'ronald', '', 'steve', 'M', '', 4, 5, NULL, 1, 'ma', '5years', 0, 5, 1, NULL, '1949-10-26', 'Single', NULL, 'christopher', 'roseena', '', 'A+', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0),
(8, NULL, 'E8', '1970-01-01', 'hg', '', 'hg', 'M', '', NULL, NULL, NULL, NULL, '', '', 0, 0, NULL, NULL, '2012-07-01', 'Single', NULL, '', '', '', '', 1, '', '', '', '', NULL, '', '', '', '', '', NULL, '', '', '', '', '', '', '', NULL, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 0),
(9, 3, 'E9', '1970-01-01', 'gfsds', '', 'jfgdg', 'M', '', 2, 2, NULL, 1, '', '', 0, 0, NULL, NULL, '2012-07-01', 'Single', NULL, '', '', '', '', 1, 'fsdd', 'rt', 'htfg', '', NULL, '', '', '', '', '', NULL, '', '', '', '', '', '', '', NULL, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 0);

--
-- Dumping data for table `employees_subjects`
--

INSERT INTO `employees_subjects` (`id`, `employee_id`, `subject_id`) VALUES
(1, 1, 11),
(2, 3, 11),
(3, 4, 13),
(4, 5, 14),
(5, 6, 14),
(6, 6, 13),
(7, 2, 13),
(8, 5, 12),
(9, 1, 12),
(11, 4, 1),
(12, 2, 1),
(13, 5, 2),
(14, 6, 2),
(15, 5, 3),
(16, 4, 5),
(17, 4, 6),
(18, 1, 27),
(19, 3, 27),
(20, 4, 27),
(21, 4, 8),
(22, 6, 8),
(23, 4, 9),
(24, 1, 9),
(25, 1, 26),
(26, 5, 29);

--
-- Dumping data for table `employee_additional_details`
--


--
-- Dumping data for table `employee_attendances`
--

INSERT INTO `employee_attendances` (`id`, `attendance_date`, `employee_id`, `employee_leave_type_id`, `reason`, `is_half_day`) VALUES
(1, '2012-06-13', 4, 4, 'fever', 0),
(2, '2012-06-01', 1, NULL, '', 0),
(3, '2012-06-04', 1, 5, 'sick', 1),
(4, '2012-06-09', 2, NULL, 'fever', 1);

--
-- Dumping data for table `employee_bank_details`
--


--
-- Dumping data for table `employee_categories`
--

INSERT INTO `employee_categories` (`id`, `name`, `prefix`, `status`) VALUES
(1, 'headmaster', 'principal', 1),
(2, 'teacher', 'teacher', 1),
(3, 'clerk', 'clerk', 1),
(4, 'office assistant', 'assistant', 1),
(5, 'librarian', 'librarian', 1);

--
-- Dumping data for table `employee_departments`
--

INSERT INTO `employee_departments` (`id`, `code`, `name`, `status`) VALUES
(1, '001', 'physics', 1),
(2, '002', 'chemistry', 1),
(3, '003', 'biology', 1),
(4, '004', 'computer', 1),
(5, '005', 'physical education', 1);

--
-- Dumping data for table `employee_department_events`
--


--
-- Dumping data for table `employee_grades`
--

INSERT INTO `employee_grades` (`id`, `name`, `priority`, `status`, `max_hours_day`, `max_hours_week`) VALUES
(1, 'OS Admin', 0, 1, NULL, NULL);

--
-- Dumping data for table `employee_leaves`
--


--
-- Dumping data for table `employee_leave_types`
--

INSERT INTO `employee_leave_types` (`id`, `name`, `code`, `status`, `max_leave_count`, `carry_forward`) VALUES
(4, 'sick leave', '01', 1, '5', 0),
(5, 'medical leave', '02', 1, '5', 0);

--
-- Dumping data for table `employee_positions`
--

INSERT INTO `employee_positions` (`id`, `name`, `employee_category_id`, `status`) VALUES
(1, 'administrator', 1, 1),
(2, 'manager', 2, 1),
(3, 'office assistant', 3, 1),
(4, 'teacher', 5, 1);

--
-- Dumping data for table `employee_salary_structures`
--


--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `desc`, `type`, `allDay`, `start`, `end`, `editable`) VALUES
(1, 1, 'PTA meeting', 'PTA meeting scheduled', 4, 1, 1338364800, 1338375600, 1),
(2, 1, 'terminal exams', 'terminal exams for high school students', 1, 1, 1338265800, 1338273000, 1),
(3, 1, 'holidays', '', 1, 1, 1338602400, 1338633000, 0),
(4, 1, 'terminal exams', 'terminal exams', 1, 1, 1340600400, 1340607600, 1),
(5, 1, 'exams', 'terminal exams', 1, 1, 1338179400, 1338188400, 1),
(6, 1, 'pta meeting', 'pta meetings for the students', 4, 1, 1338190200, 1338193800, 1),
(7, 1, 'fee payment', 'payment of fee for the term', 3, 1, 1338262200, 1338287400, 1);

--
-- Dumping data for table `events_helper`
--

INSERT INTO `events_helper` (`id`, `type`, `user_id`, `title`) VALUES
(6, 0, 1, 'Testing Image'),
(7, 0, 1, 'Thats Cool'),
(8, 0, 1, 'Presentation Day'),
(9, 0, 1, 'Seminars'),
(10, 0, 1, 'ee');

--
-- Dumping data for table `events_old`
--


--
-- Dumping data for table `events_user_preference`
--

INSERT INTO `events_user_preference` (`user_id`, `mobile`, `mobile_alert`, `email`, `email_alert`) VALUES
(1, NULL, 0, NULL, 0),
(4, NULL, 0, NULL, 0);

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_group_id`, `subject_id`, `start_time`, `end_time`, `maximum_marks`, `minimum_marks`, `grading_level_id`, `weightage`, `event_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2012-08-01 09:30:00', '2012-08-01 12:30:00', '100.00', '35.00', NULL, 0, NULL, '2012-06-08 00:00:00', '2012-06-08 00:00:00'),
(2, 1, 2, '2012-08-01 09:30:00', '2012-08-01 12:30:00', '100.00', '35.00', NULL, 0, NULL, '2012-06-08 00:00:00', '2012-06-08 00:00:00'),
(3, 1, 3, '2012-08-01 09:30:00', '2012-08-01 12:30:00', '100.00', '35.00', NULL, 0, NULL, '2012-06-08 00:00:00', '2012-06-08 00:00:00'),
(4, 1, 4, '2012-08-01 09:30:00', '2012-08-01 12:30:00', '100.00', '35.00', NULL, 0, NULL, '2012-06-08 00:00:00', '2012-06-08 00:00:00'),
(5, 1, 5, '2012-08-01 09:30:00', '2012-08-01 12:30:00', '100.00', '35.00', NULL, 0, NULL, '2012-06-08 00:00:00', '2012-06-08 00:00:00');

--
-- Dumping data for table `exam_groups`
--

INSERT INTO `exam_groups` (`id`, `name`, `batch_id`, `exam_type`, `is_published`, `result_published`, `exam_date`) VALUES
(1, 'internal', 1, 'Marks', 0, 0, '0000-00-00');

--
-- Dumping data for table `exam_scores`
--

INSERT INTO `exam_scores` (`id`, `student_id`, `exam_id`, `marks`, `grading_level_id`, `remarks`, `is_failed`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '95.00', NULL, 'good', NULL, '2012-06-08 00:00:00', '2012-06-08 00:00:00'),
(2, 12, 1, '87.00', NULL, 'good', NULL, '2012-06-08 00:00:00', '2012-06-08 00:00:00'),
(3, 13, 1, '99.00', NULL, 'good', NULL, '2012-06-08 00:00:00', '2012-06-08 00:00:00');

--
-- Dumping data for table `fee_collection_discounts`
--


--
-- Dumping data for table `fee_collection_particulars`
--


--
-- Dumping data for table `fee_discounts`
--


--
-- Dumping data for table `finance_donations`
--


--
-- Dumping data for table `finance_fees`
--


--
-- Dumping data for table `finance_fee_categories`
--


--
-- Dumping data for table `finance_fee_collections`
--


--
-- Dumping data for table `finance_fee_particulars`
--


--
-- Dumping data for table `finance_fee_structure_elements`
--


--
-- Dumping data for table `finance_transactions`
--


--
-- Dumping data for table `finance_transaction_categories`
--

INSERT INTO `finance_transaction_categories` (`id`, `name`, `description`, `is_income`, `deleted`) VALUES
(1, 'Salary', ' ', 0, 0),
(2, 'Donation', ' ', 1, 0),
(3, 'Fee', ' ', 1, 0);

--
-- Dumping data for table `finance_transaction_triggers`
--


--
-- Dumping data for table `folder`
--


--
-- Dumping data for table `grading_levels`
--

INSERT INTO `grading_levels` (`id`, `name`, `batch_id`, `min_score`, `order`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'A', NULL, 90, NULL, 0, '2012-02-20 13:41:10', '2012-02-20 13:41:10'),
(2, 'B', NULL, 80, NULL, 0, '2012-02-20 13:41:10', '2012-02-20 13:41:10'),
(3, 'C', NULL, 70, NULL, 0, '2012-02-20 13:41:11', '2012-02-20 13:41:11'),
(4, 'D', NULL, 60, NULL, 0, '2012-02-20 13:41:11', '2012-02-20 13:41:11'),
(5, 'E', NULL, 50, NULL, 0, '2012-02-20 13:41:11', '2012-02-20 13:41:11'),
(6, 'F', NULL, 40, NULL, 0, '2012-02-20 13:41:11', '2012-02-20 13:41:11'),
(7, 'A', 1, 90, NULL, 0, '2012-02-20 13:41:10', '2012-02-20 13:41:10'),
(8, 'B', 1, 80, NULL, 0, '2012-02-20 13:41:10', '2012-02-20 13:41:10'),
(9, 'C', 1, 70, NULL, 0, '2012-02-20 13:41:11', '2012-02-20 13:41:11'),
(10, 'D', 1, 60, NULL, 0, '2012-02-20 13:41:11', '2012-02-20 13:41:11'),
(11, 'E', 1, 50, NULL, 0, '2012-02-20 13:41:11', '2012-02-20 13:41:11'),
(12, 'F', 1, 40, NULL, 0, '2012-02-20 13:41:11', '2012-02-20 13:41:11');

--
-- Dumping data for table `grouped_exams`
--

INSERT INTO `grouped_exams` (`id`, `exam_group_id`, `batch_id`) VALUES
(1, 1, 1);

--
-- Dumping data for table `groups`
--


--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`id`, `ward_id`, `first_name`, `last_name`, `relation`, `email`, `office_phone1`, `office_phone2`, `mobile_phone`, `office_address_line1`, `office_address_line2`, `city`, `state`, `country_id`, `dob`, `occupation`, `income`, `education`, `created_at`, `updated_at`) VALUES
(2, 1, 'ramakrishnan', 'kartha', 'father', 'rk@yahoo.co.in', '0484234252', '0484872563', '', 'indian bank', 'apsara tower', 'cochin', 'kerala', 76, NULL, 'accountant', '1000000', 'bsc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 'mohan', 'kumar', 'uncle', 'mk@gmail.com', '0487653481', '', '9876345671', 'ax pvt ltd', 'town street', 'trivandrum', 'kerala', 76, NULL, 'clerk', '200000', '10', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 3, 'george', 'joseph', 'father', 'gj@hotmail.com', '04665666871', '0466542561', '9870985678', 'sun networks', 'opposite museum', 'chennai', 'tamil nadu', 76, NULL, 'accountant', '100000', 'b.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 4, 'muhammed', 'ishaac', 'father', 'mk@gmail.com', '786655', '876542', '098987678', 'thasnim supermarket', '', 'pondichery', 'tamilnadu', 76, NULL, 'manager', '2000000', 'bca', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 5, 'hameed', 'rahman', 'father', 'hr@yahoo.co.in', '87432874', '764832', '878436465', 'bharath electricals', 'chinmaya tower', 'cochin', 'kerala', 76, NULL, 'clerk', '64534', '10th', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 6, 'sameer', 'gupta', 'father', '', '85745453', '8545355', '546475875', '123/a', '', 'banglore', 'karnataka', 76, NULL, 'teacher', '22345535', 'degree', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 7, 'rishi', 'sharma', 'brother', '', '75664534', '8574554', '6787563', 'colors garden', '', 'manglore', 'karnataka', 76, NULL, 'business', '1221324', 'degree', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 8, 'lakshman', 'shukla', 'father', '', '7656534', '6754645', '97656455', '123/a', 'apsara tower', 'chennai', 'tamil nadu', 76, NULL, 'manager', '12323334', 'mba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 9, 'dharmesh', 'singh', 'father', 'gj@hotmail.com', '0484234252', '0466542561', '098987678', 'bharath electricals', 'chinmaya tower', 'banglore', 'karnataka', 76, NULL, 'manager', '12323334', 'degree', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 10, 'mathew', 'tharakan', 'father', 'gj@hotmail.com', '0484234252', '', '546475875', 'bharath electricals', 'apsara tower', '', '', 1, NULL, 'clerk', '12323334', '10th', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 11, 'george', 'joseph', 'father', 'mk@gmail.com', '04665666871', '', '546475875', 'colors garden', 'chinmaya tower', 'manglore', 'karnataka', 76, NULL, 'manager', '1000000', 'bca', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 12, 'phelix', 'jacob', 'father', 'mk@gmail.com', '0487653481', '0484872563', '098987678', 'bharath electricals', 'chinmaya tower', 'delhi', 'haryana', 76, NULL, 'teacher', '1000000', '10th', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 13, 'shahina', 'hameed', 'sister', '', '', '0484872563', '6787563', '123/a', 'apsara tower', '', '', 76, NULL, 'accountant', '', 'degree', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 14, 'rasiya', 'hamza', 'sister', '', '', '', '', '', '', '', '', 76, NULL, '', '100000', '10th', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 15, 'srikanth', 'vasanth', 'father', '', '', '6754645', '546475875', 'colors garden', 'opposite museum', 'banglore', 'karnataka', 76, NULL, '', '', 'degree', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 16, 'jayasree', 'anand', 'mother', 'hr@yahoo.co.in', '04665666871', '0466542561', '098987678', 'indian bank', 'opposite museum', 'chennai', 'tamil nadu', 76, NULL, '', '', 'bca', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 17, 'krishnakumar', 'menon', 'father', '', '', '764832', '546475875', 'bharath electricals', 'chinmaya tower', 'cochin', 'kerala', 76, NULL, 'business', '12323334', 'b.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 18, 'chandrashekar', 'menon', 'father', '', '04665666871', '0484872563', '546475875', 'bharath electricals', 'apsara tower', 'banglore', 'karnataka', 76, NULL, 'accountant', '', 'degree', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 19, 'govind', 'mohan', 'brother', '', '', '', '', 'ax pvt ltd', 'chinmaya tower', 'banglore', 'karnataka', 76, NULL, 'office assistant', '', 'bca', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Dumping data for table `individual_payslip_categories`
--


--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`) VALUES
(1, 'English', 'en'),
(2, 'Spanish', 'es');

--
-- Dumping data for table `liabilities`
--


--
-- Dumping data for table `logo`
--


--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `title`, `url`, `class`, `position`, `group_id`) VALUES
(1, 0, 'Home', '/', '', 1, 1),
(2, 0, 'About', '/about.html', '', 2, 1),
(3, 2, 'Company Profile', '/company-profile.html', '', 1, 1),
(19, 0, 'Affiliate', '/affiliate.html', '', 3, 2),
(18, 0, 'Forum', '/forum', '', 2, 2),
(17, 0, 'Make Money', '/make-money.html', '', 1, 2),
(7, 0, 'Contact Us', '/contact-us.html', '', 5, 1),
(8, 0, 'Blog', '/blog', '', 4, 1),
(9, 0, 'Products', '/products', '', 3, 1),
(10, 9, 'Handicraft', '/products/handicraft', '', 1, 1),
(11, 9, 'Furniture', '/products/furniture', '', 2, 1),
(12, 10, 'Tissue Box', '/products/handicraft/tissue', '', 1, 1),
(13, 10, 'Frame', '/products/handicraft/frame', '', 2, 1),
(14, 11, 'Cabinet', '/products/furniture/cabinet', '', 1, 1),
(15, 11, 'Chair', '/products/furniture/chair', '', 2, 1),
(16, 11, 'Table', '/products/furniture/table', '', 3, 1),
(20, 0, 'Help', '/help', '', 4, 2),
(21, 20, 'Support Center', '/support-center.html', '', 1, 2),
(22, 20, 'Sitemap', '/sitemap.html', '', 2, 2),
(23, 0, 'Author Dashboard', '/author-dashboard', '', 1, 3),
(24, 0, 'My Profile', '/member/profile', '', 2, 3),
(25, 0, 'Settings', '/member/settings', '', 3, 3),
(26, 0, 'Downloads', '/member/downloads', '', 4, 3),
(27, 0, 'Bookmarks', '/member/bookmarks', '', 5, 3),
(28, 0, 'Logout', '/logout.php', '', 6, 3),
(29, 25, 'Profile', '/member/settings/profile', '', 1, 3),
(30, 25, 'Change Password', '/member/settings/password', '', 2, 3),
(31, 0, 'Menu 1', '', '', 1, 4),
(32, 31, 'Menu 1.1', '', '', 1, 4),
(33, 31, 'Menu 1.2', '', '', 2, 4),
(34, 0, 'Menu 2', '', '', 2, 4),
(35, 34, 'Menu 2.1', '', '', 1, 4),
(36, 35, 'Menu 2.1.1', '', '', 1, 4),
(37, 35, 'Menu 2.1.2', '', '', 2, 4),
(38, 34, 'Menu 2.2', '', '', 2, 4),
(39, 21, 'Popular Files', '/popular', '', 1, 2),
(40, 21, 'Top Authors', '/top', '', 2, 2),
(41, 21, 'Wordpress', '/wp', '', 3, 2);

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`id`, `title`) VALUES
(1, 'Main Menu'),
(2, 'Footer Menu'),
(3, 'Member Menu'),
(4, 'Admin Menu');

--
-- Dumping data for table `message`
--


--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `subject`, `body`, `is_read`, `deleted_by`, `created_at`) VALUES
(1, 1, 1, 's', '<p>\r\n	s</p>\r\n', '1', NULL, '2012-06-13 13:24:25');

--
-- Dumping data for table `message_user`
--


--
-- Dumping data for table `monthly_payslips`
--


--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'dafds', '<p>&nbsp;fadsfadsfsdf</p>', 1, '2012-02-20 16:50:47', '2012-02-20 16:50:47');

--
-- Dumping data for table `news_comments`
--


--
-- Dumping data for table `payroll_categories`
--


--
-- Dumping data for table `period_entries`
--

INSERT INTO `period_entries` (`id`, `month_date`, `batch_id`, `subject_id`, `class_timing_id`, `employee_id`) VALUES
(1, '1970-01-01', 1, NULL, NULL, NULL);

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `name`, `created_at`, `updated_at`, `description`) VALUES
(1, 'ExaminationControl', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'examination_control_privilege'),
(2, 'EnterResults', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'enter_results_privilege'),
(3, 'ViewResults', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'view_results_privilege'),
(4, 'Admission', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'admission_privilege'),
(5, 'StudentsControl', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'students_control_privilege'),
(6, 'ManageNews', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'manage_news_privilege'),
(7, 'ManageTimetable', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'manage_timetable_privilege'),
(8, 'StudentAttendanceView', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'student_attendance_view_privilege'),
(9, 'HrBasics', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'hr_basics_privilege'),
(10, 'AddNewBatch', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'add_new_batch_privilege'),
(11, 'SubjectMaster', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'subject_master_privilege'),
(12, 'EventManagement', '2012-02-20 13:41:16', '2012-02-20 13:41:16', 'event_management_privilege'),
(13, 'GeneralSettings', '2012-02-20 13:41:17', '2012-02-20 13:41:17', 'general_settings_privilege'),
(14, 'FinanceControl', '2012-02-20 13:41:17', '2012-02-20 13:41:17', 'finance_control_privilege'),
(15, 'TimetableView', '2012-02-20 13:41:17', '2012-02-20 13:41:17', 'timetable_view_privilege'),
(16, 'StudentAttendanceRegister', '2012-02-20 13:41:17', '2012-02-20 13:41:17', 'student_attendance_register_privilege'),
(17, 'EmployeeAttendance', '2012-02-20 13:41:17', '2012-02-20 13:41:17', 'employee_attendance_privilege'),
(18, 'PayslipPowers', '2012-02-20 13:41:17', '2012-02-20 13:41:17', 'payslip_powers_privilege'),
(19, 'EmployeeSearch', '2012-02-20 13:41:17', '2012-02-20 13:41:17', 'employee_search_privilege'),
(20, 'SMSManagement', '2012-02-20 13:41:17', '2012-02-20 13:41:17', 'sms_management_privilege');

--
-- Dumping data for table `privileges_users`
--


--
-- Dumping data for table `read`
--


--
-- Dumping data for table `reminders`
--


--
-- Dumping data for table `reply`
--


--
-- Dumping data for table `rights`
--


--
-- Dumping data for table `savedsearches`
--

INSERT INTO `savedsearches` (`id`, `user_id`, `url`, `type`, `name`) VALUES
(1, 1, '/openschool/index.php?r=employees%2Femployees%2Fmanage&name=a&employeenumber=&Employees%5Bemployee_department_id%5D=&Employees%5Bemployee_category_id%5D=&Employees%5Bemployee_position_id%5D=&Employees%5Bemployee_grade_id%5D=&Employees%5Bgender%5D=&Employees%5Bmarital_status%5D=&Employees%5Bblood_group%5D=&Employees%5Bnationality_id%5D=&Employees%5Bdobrange%5D=&Employees%5Bdate_of_birth%5D=&Employees%5Bjoinrange%5D=&Employees%5Bjoining_date%5D=&Employees%5Bstatus%5D=&name=&name=a&employeenumber=&Employees%5Bemployee_department_id%5D=&Employees%5Bemployee_category_id%5D=&Employees%5Bemployee_position_id%5D=&Employees%5Bemployee_grade_id%5D=&Employees%5Bgender%5D=&Employees%5Bmarital_status%5D=&Employees%5Bblood_group%5D=&Employees%5Bnationality_id%5D=&Employees%5Bdobrange%5D=&Employees%5Bdate_of_birth%5D=&Employees%5Bjoinrange%5D=&Employees%5Bjoining_date%5D=&Employees%5Bstatus%5D=', 2, 'jjjj'),
(2, 1, '/openschool/index.php?r=employees%2Femployees%2Fmanage&name=a&employeenumber=&Employees%5Bemployee_department_id%5D=&Employees%5Bemployee_category_id%5D=&Employees%5Bemployee_position_id%5D=&Employees%5Bemployee_grade_id%5D=&Employees%5Bgender%5D=&Employees%5Bmarital_status%5D=&Employees%5Bblood_group%5D=&Employees%5Bnationality_id%5D=&Employees%5Bdobrange%5D=&Employees%5Bdate_of_birth%5D=&Employees%5Bjoinrange%5D=&Employees%5Bjoining_date%5D=&Employees%5Bstatus%5D=&name=&name=a&employeenumber=&Employees%5Bemployee_department_id%5D=&Employees%5Bemployee_category_id%5D=&Employees%5Bemployee_position_id%5D=&Employees%5Bemployee_grade_id%5D=&Employees%5Bgender%5D=&Employees%5Bmarital_status%5D=&Employees%5Bblood_group%5D=&Employees%5Bnationality_id%5D=&Employees%5Bdobrange%5D=&Employees%5Bdate_of_birth%5D=&Employees%5Bjoinrange%5D=&Employees%5Bjoining_date%5D=&Employees%5Bstatus%5D=', 2, 'kkkk');

--
-- Dumping data for table `schema_migrations`
--

INSERT INTO `schema_migrations` (`version`) VALUES
('20090622100004'),
('20090622102004'),
('20090622104053'),
('20090622104054'),
('20090622114927'),
('20090622115927'),
('20090703074822'),
('20090706170408'),
('20090715234257'),
('20090715234258'),
('20090717124241'),
('20090717126241'),
('20090718050113'),
('20090718050453'),
('20090718050921'),
('20090718052749'),
('20090731092833'),
('20090818045411'),
('20090818050018'),
('20090904071048'),
('20090904071548'),
('20090904071642'),
('20090904071905'),
('20090904071906'),
('20090904071907'),
('20090904071908'),
('20090904071909'),
('20090910062751'),
('20090914095002'),
('20090914114212'),
('20090916052300'),
('20090917052349'),
('20090917065256'),
('20090924081520'),
('20090926071527'),
('20091009093746'),
('20091026065251'),
('20091202050910'),
('20091202053600'),
('20091202104818'),
('20091207084711'),
('20091207085849'),
('20091207090412'),
('20091217191652'),
('20091217201118'),
('20091224063502'),
('20100403073735'),
('20100403092229'),
('20100403093355'),
('20100412105036'),
('20100412105116'),
('20100422110336'),
('20100426094532'),
('20100429093616'),
('20100505075459'),
('20100515063157'),
('20100515063814'),
('20100520073311'),
('20100524093457'),
('20100525055716'),
('20100602115152'),
('20100604103435'),
('20100604103916'),
('20100604104308'),
('20100604104759'),
('20100609073016'),
('20100609074544'),
('20100730092747'),
('20100731053458'),
('20100731054033'),
('20100731055437'),
('20101209063633'),
('20110221051223'),
('20110419101802'),
('20110510121550'),
('20110511053223'),
('20110516110336'),
('20110706114907'),
('20110711100500'),
('20110721122326'),
('20110728115723'),
('20110729055539'),
('20110730100503'),
('20110805072425'),
('20110810052138'),
('20110912062640'),
('20110928054502'),
('20111015111840'),
('20111020074717'),
('20111105052819');

--
-- Dumping data for table `sms_settings`
--

INSERT INTO `sms_settings` (`id`, `settings_key`, `is_enabled`) VALUES
(1, 'ApplicationEnabled', 0),
(2, 'ParentSmsEnabled', 0),
(3, 'EmployeeSmsEnabled', 0),
(4, 'StudentSmsEnabled', 0),
(5, 'ResultPublishEnabled', 0),
(6, 'StudentAdmissionEnabled', 0),
(7, 'ExamScheduleResultEnabled', 0),
(8, 'AttendanceEnabled', 0),
(9, 'NewsEventsEnabled', 0);

--
-- Dumping data for table `star`
--


--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `admission_no`, `class_roll_no`, `admission_date`, `first_name`, `middle_name`, `last_name`, `batch_id`, `date_of_birth`, `gender`, `blood_group`, `birth_place`, `nationality_id`, `language`, `religion`, `student_category_id`, `address_line1`, `address_line2`, `city`, `state`, `pin_code`, `country_id`, `phone1`, `phone2`, `email`, `immediate_contact_id`, `is_sms_enabled`, `photo_file_name`, `photo_content_type`, `photo_data`, `status_description`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `has_paid_fees`, `photo_file_size`, `user_id`) VALUES
(1, '1', '', '2012-06-01', 'ashwin', '', 'krishnan', 1, '2007-01-10', 'M', 'B+', 'cochin', 76, 'malayalam', 'hindu', 2, '12/b ', 'skyline apartments', 'cochin', 'kerala', '676543', 76, '9754346512', '9876345692', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(2, '2', '', '2012-06-01', 'lathika', '', 'lakshmi', 13, '2002-11-29', 'F', 'AB+-', 'calicut', 76, 'malayalam', 'hindu', 2, '21/a ', 'prince apartments', 'calicut', 'kerala', '673636', 76, '9874562341', '9865432923', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(3, '3', '', '2012-06-01', 'james', '', 'albert', 15, '2001-11-28', 'M', 'AB+-', 'coimbatore', 76, 'tamil', 'christian', 3, 'shan villa', 'anna nagar', 'chennai', 'tamil nadu', '654765', 76, '9876542345', '9875673451', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(4, '4', '', '2012-06-14', 'shahul', '', 'ahmed', 14, '1998-09-16', 'M', 'AB+-', 'calicut', 76, 'malayalam', 'muslim', 3, 'ahal villa', 'skyline apartments', 'calicut', 'kerala', '876765', 76, '9865456789', '9876456789', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(5, '5', '', '2012-06-08', 'amrita', '', 'hameed', 12, '1993-06-08', 'F', 'O+', 'kannur', 76, 'malayalam', 'muslim', 2, 'hass', 'apsara apartments', 'kannur', 'kerala', '574356', 76, '98478246', '87456383', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(6, '07', '', '1995-06-01', 'gourav', '', 'gupta', 2, '2003-06-04', 'M', 'A+', '', 76, 'kannada', 'hindu', 2, '12/a ', 'skyline apartments', 'banglore', 'karnataka', '745653', 76, '98764635', '97875646', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(7, '08', '', '2009-06-25', 'nimesh', '', 'sangvi', 4, '2002-06-12', 'M', '', '', 1, '', 'hindu', 2, '21/a', 'sd', 'banglore', 'karnataka', '856653', 76, '9675664', '9786756', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(8, '09', '', '1995-03-01', 'meenakshi', '', 'agarval', 3, '1991-02-14', 'F', 'A+', 'maharashtra', 76, 'marathi', 'hindu', 2, 'shan villa', '', 'mumbai', 'maharashtra', '74553', 76, '9665576', '9887464', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(9, '10', '', '2012-06-01', 'savithri', '', 'sharma', 5, '2004-06-01', 'F', 'B+', 'cochin', 76, 'malayalam', 'hindu', 2, 'shan villa', 'anna nagar', 'chennai', 'tamil nadu', '574356', 76, '9665576', '97875646', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(10, '11', '', '2010-06-16', 'pranav', '', 'james', 6, '2007-06-13', '', '', 'calicut', 1, 'tamil', 'christian', 2, '21/a', 'apsara apartments', 'calicut', 'kerala', '654765', 76, '9865456789', '9786756', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(11, '12', '', '2012-06-01', 'pratheeksha', '', 'vargheese', 7, '1980-06-13', 'F', 'A+', 'banglore', 76, 'kannada', 'christian', 2, '12/b', 'apsara apartments', 'banglore', 'karnataka', '676543', 76, '9754346512', '9786756', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-11 00:00:00', 0, NULL, 1),
(12, '13', '', '2012-06-01', 'mohit', '', 'alexander', 1, '2004-06-01', 'M', 'A-', 'delhi', 76, 'hindi', 'christian', 2, '12/b', 'prince apartments', 'delhi', 'hariyana', '654765', 76, '9754346512', '87456383', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(13, '14', '', '2012-05-01', 'hameed', '', 'ansari', 1, '2004-06-11', 'M', '', 'calicut', 76, 'malayalam', 'muslim', 2, 'shan villa', 'prince apartments', 'calicut', 'kerala', '574356', 76, '9754346512', '87456383', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(14, '15', '', '2012-05-17', 'rafeeq', '', 'ahamed', 7, '2003-06-04', 'M', 'B+', 'cochin', 76, 'malayalam', 'muslim', 2, '12/b', 'prince apartments', 'cochin', 'kerala', '673636', 76, '9675664', '9865432923', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(15, '16', '', '2012-04-10', 'bhavana', '', 'sharma', 10, '1993-06-08', 'F', '', 'cochin', 1, 'kannada', 'christian', 2, 'ahal villa', 'anna nagar', 'chennai', 'tamil nadu', '673636', 76, '98478246', '9865432923', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(16, '17', '', '2012-05-16', 'goutham', '', 'prakash', 11, '1993-06-08', 'M', '', 'calicut', 76, '', 'hindu', 2, '21/a', 'skyline apartments', 'calicut', 'kerala', '676543', 76, '9675664', '9786756', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(17, '18', '', '2012-05-16', 'mohit', '', 'manohar', 14, '2001-06-14', 'M', 'AB+-', 'coimbatore', 76, 'tamil', 'hindu', 3, 'ahal villa', 'anna nagar', 'chennai', 'tamil nadu', '654765', 76, '9675664', '9786756', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(18, '19', '', '2012-04-11', 'chandni', '', 'chandran', 14, '1997-06-12', 'F', 'AB+-', '', 76, '', '', 3, '21/a', 'skyline apartments', 'chennai', 'tamil nadu', '673636', 76, '9754346512', '9865432923', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-08 00:00:00', '2012-06-08 00:00:00', 0, NULL, 1),
(19, '20', '', '2012-06-13', 'sanjuktha', '', 'shekhar', 1, '2005-06-01', 'F', 'B+', 'calicut', 76, 'malayalam', 'hindu', 2, 'ahal villa', 'anna nagar', 'chennai', 'tamil nadu', '654765', 76, '9754346512', '87456383', '', 1, 1, NULL, NULL, '', '', 1, 0, '2012-06-12 00:00:00', '2012-06-12 00:00:00', 0, NULL, 1);

--
-- Dumping data for table `students_subjects`
--


--
-- Dumping data for table `student_additional_details`
--


--
-- Dumping data for table `student_additional_fields`
--


--
-- Dumping data for table `student_attentance`
--

INSERT INTO `student_attentance` (`id`, `student_id`, `date`, `reason`) VALUES
(1, 1, '2012-06-08', 'fever'),
(2, 1, '2012-06-12', 'fever'),
(3, 12, '2012-06-19', 'fever');

--
-- Dumping data for table `student_categories`
--

INSERT INTO `student_categories` (`id`, `name`, `is_deleted`) VALUES
(1, 'KG', 0),
(2, 'LP', 0),
(3, 'UP', 0),
(4, 'HS', 0),
(5, 'HSS', 0);

--
-- Dumping data for table `student_extra`
--


--
-- Dumping data for table `student_previous_datas`
--

INSERT INTO `student_previous_datas` (`id`, `student_id`, `institution`, `year`, `course`, `total_mark`) VALUES
(1, 1, 'sver', 's2323', 'wgwet', 'f2324'),
(2, 1, '', '', '', ''),
(3, 2, '', '', '', ''),
(4, 3, 'st.josephs lp school', '2011', '4th', '465'),
(5, 4, 'iss emlps', '2011', '4th', '544'),
(6, 5, '', '', '', ''),
(7, 6, '', '', '', ''),
(8, 7, '', '', '', ''),
(9, 8, '', '', '', ''),
(10, 9, '', '', '', ''),
(11, 11, '', '', '', ''),
(12, 14, '', '', '', ''),
(13, 15, '', '', '', ''),
(14, 16, '', '', '', ''),
(15, 17, '', '', '', ''),
(16, 18, '', '', '', ''),
(17, 19, '', '', '', '');

--
-- Dumping data for table `student_previous_subject_marks`
--


--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `batch_id`, `no_exams`, `max_weekly_classes`, `elective_group_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'english', '01', 1, 0, 5, 0, 0, '0000-00-00 00:00:00', NULL),
(2, 'physics', '02', 1, 0, 4, 0, 0, '0000-00-00 00:00:00', NULL),
(3, 'chemistry', '03', 1, 0, 6, 0, 0, '0000-00-00 00:00:00', NULL),
(4, 'biology', '04', 1, 0, 4, 0, 0, '0000-00-00 00:00:00', NULL),
(5, 'maths', '05', 1, 0, 7, 0, 0, '0000-00-00 00:00:00', NULL),
(6, 'english', '01', 2, 0, 5, 0, 0, '0000-00-00 00:00:00', NULL),
(7, 'physics', '02', 2, 0, 6, 0, 0, '0000-00-00 00:00:00', NULL),
(8, 'chemistry', '03', 2, 0, 7, 0, 0, '0000-00-00 00:00:00', NULL),
(9, 'biology', '04', 2, 0, 5, 0, 0, '0000-00-00 00:00:00', NULL),
(10, 'maths', '05', 2, 0, 6, 0, 0, '0000-00-00 00:00:00', NULL),
(11, 'maths', '05', 9, 0, 6, 0, 0, '0000-00-00 00:00:00', NULL),
(12, 'biology', '04', 9, 0, 5, 0, 0, '0000-00-00 00:00:00', NULL),
(13, 'chemistry', '03', 9, 0, 7, 0, 0, '0000-00-00 00:00:00', NULL),
(14, 'english', '01', 9, 0, 5, 0, 0, '0000-00-00 00:00:00', NULL),
(15, 'physics', '02', 9, 0, 3, 0, 0, '0000-00-00 00:00:00', NULL),
(16, 'physics', '02', 8, 0, 5, 0, 0, '0000-00-00 00:00:00', NULL),
(17, 'english', '01', 8, 0, 6, 0, 0, '0000-00-00 00:00:00', NULL),
(18, 'maths', '05', 8, 0, 7, 0, 0, '0000-00-00 00:00:00', NULL),
(19, 'biology', '04', 8, 0, 3, 0, 0, '0000-00-00 00:00:00', NULL),
(20, 'chemistry', '03', 8, 0, 4, 0, 0, '0000-00-00 00:00:00', NULL),
(21, 'english', '01', 7, 0, 3, 0, 0, '0000-00-00 00:00:00', NULL),
(22, 'physics', '02', 7, 0, 5, 0, 0, '0000-00-00 00:00:00', NULL),
(23, 'chemistry', '03', 7, 0, 6, 0, 0, '0000-00-00 00:00:00', NULL),
(24, 'biology', '04', 7, 0, 5, 0, 0, '0000-00-00 00:00:00', NULL),
(25, 'maths', '05', 7, 0, 6, 0, 0, '0000-00-00 00:00:00', NULL),
(26, 'physics', '02', 3, 0, 6, 0, 0, '0000-00-00 00:00:00', NULL),
(27, 'english', '01', 3, 0, 5, 0, 0, '0000-00-00 00:00:00', NULL),
(28, 'chemistry', '03', 3, 0, 6, 0, 0, '0000-00-00 00:00:00', NULL),
(29, 'maths', '05', 3, 0, 7, 0, 0, '0000-00-00 00:00:00', NULL),
(30, 'biology', '04', 3, 0, 4, 0, 0, '0000-00-00 00:00:00', NULL),
(31, 'computer', '06', 2, 0, 5, 0, 0, '0000-00-00 00:00:00', NULL);

--
-- Dumping data for table `subject_name`
--

INSERT INTO `subject_name` (`id`, `name`, `code`) VALUES
(1, 'english', '01'),
(2, 'physics', '02'),
(3, 'chemistry', '03'),
(4, 'biology', '04'),
(5, 'maths', '05'),
(6, 'computer', '06'),
(7, 'history', '07');

--
-- Dumping data for table `timetable_entries`
--

INSERT INTO `timetable_entries` (`id`, `batch_id`, `weekday_id`, `class_timing_id`, `subject_id`, `employee_id`) VALUES
(1, 1, 3, 1, 1, 1),
(2, 1, 2, 1, 1, 2),
(3, 1, 3, 2, 2, 6),
(4, 1, 2, 2, 3, 5),
(5, 1, 3, 3, 5, 4),
(6, 1, 2, 3, 2, 6),
(7, 1, 3, 4, 3, 5),
(8, 1, 4, 1, 1, 2),
(9, 1, 5, 1, 1, 4),
(10, 1, 6, 1, 1, 2),
(11, 1, 4, 2, 2, 6),
(12, 1, 5, 2, 2, 5),
(13, 1, 6, 2, 3, 5),
(14, 1, 4, 3, 1, 4),
(15, 1, 5, 3, 3, 5),
(16, 1, 6, 3, 2, 5),
(17, 1, 2, 4, 3, 5),
(18, 1, 4, 4, 5, 4),
(19, 1, 5, 4, 5, 4),
(20, 1, 6, 4, 1, 4),
(21, 1, 3, 5, 1, 4),
(22, 2, 3, 8, 6, 4),
(23, 2, 2, 8, 8, 4),
(24, 1, 3, 7, 2, 5),
(25, 1, 2, 7, 3, 5),
(26, 1, 3, 6, 2, 6),
(27, 2, 3, 9, 8, 6);

--
-- Dumping data for table `user`
--


--
-- Dumping data for table `userfolder`
--


--
-- Dumping data for table `user_details`
--


--
-- Dumping data for table `user_events`
--


--
-- Dumping data for table `weekdays`
--

INSERT INTO `weekdays` (`id`, `batch_id`, `weekday`) VALUES
(22, 2, '0'),
(23, 2, '2'),
(24, 2, '3'),
(25, 2, '4'),
(26, 2, '5'),
(27, 2, '6'),
(28, 2, '7'),
(85, NULL, '1'),
(86, NULL, '2'),
(87, NULL, '3'),
(88, NULL, '4'),
(89, NULL, '5'),
(90, NULL, '6'),
(91, NULL, '7'),
(99, 1, '0'),
(100, 1, '2'),
(101, 1, '3'),
(102, 1, '4'),
(103, 1, '5'),
(104, 1, '6'),
(105, 1, '0');
