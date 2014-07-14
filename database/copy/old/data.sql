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
-- Generation Time: Jul 13, 2012 at 05:46 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `os_clean`
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
('Courses.StudentAttentance.Update', 0, NULL, NULL, 'N;'),
('Courses.StudentAttentance.View', 0, NULL, NULL, 'N;'),
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
('FeeCollectionParticulars.*', 1, NULL, NULL, 'N;'),
('FeeCollectionParticulars.Index', 0, NULL, NULL, 'N;'),
('FeeCollectionParticulars.ReturnForm', 0, NULL, NULL, 'N;'),
('FeeCollectionParticulars.ReturnView', 0, NULL, NULL, 'N;'),
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
('Mailbox.Message.Index', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Message', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Reply', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Sdel', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Sentitems', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Sentmessage', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Star', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Stardel', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Starred', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Unstar', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Update', 0, NULL, NULL, 'N;'),
('Mailbox.Message.Ustar', 0, NULL, NULL, 'N;'),
('Mailbox.Message.View', 0, NULL, NULL, 'N;'),
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
('Site.Contact', 0, NULL, NULL, 'N;'),
('Site.Error', 0, NULL, NULL, 'N;'),
('Site.Index', 0, NULL, NULL, 'N;'),
('Site.Login', 0, NULL, NULL, 'N;'),
('Site.Logout', 0, NULL, NULL, 'N;'),
('Site.Search', 0, NULL, NULL, 'N;'),
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
('Translate.Edit.*', 1, NULL, NULL, 'N;'),
('Translate.Edit.Admin', 0, NULL, NULL, 'N;'),
('Translate.Edit.Create', 0, NULL, NULL, 'N;'),
('Translate.Edit.Delete', 0, NULL, NULL, 'N;'),
('Translate.Edit.Missing', 0, NULL, NULL, 'N;'),
('Translate.Edit.Missingdelete', 0, NULL, NULL, 'N;'),
('Translate.Edit.Update', 0, NULL, NULL, 'N;'),
('Translate.Translate.*', 1, NULL, NULL, 'N;'),
('Translate.Translate.Index', 0, NULL, NULL, 'N;'),
('User.*', 1, NULL, NULL, 'N;'),
('User.Admin', 0, NULL, NULL, 'N;'),
('User.Create', 0, NULL, NULL, 'N;'),
('User.Delete', 0, NULL, NULL, 'N;'),
('User.Index', 0, NULL, NULL, 'N;'),
('User.Update', 0, NULL, NULL, 'N;'),
('User.View', 0, NULL, NULL, 'N;');

--
-- Dumping data for table `authitemchild`
--


--
-- Dumping data for table `bank_fields`
--


--
-- Dumping data for table `batches`
--


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


--
-- Dumping data for table `employees_subjects`
--


--
-- Dumping data for table `employee_additional_details`
--


--
-- Dumping data for table `employee_attendances`
--


--
-- Dumping data for table `employee_bank_details`
--


--
-- Dumping data for table `employee_categories`
--


--
-- Dumping data for table `employee_departments`
--


--
-- Dumping data for table `employee_department_events`
--


--
-- Dumping data for table `employee_grades`
--


--
-- Dumping data for table `employee_leaves`
--


--
-- Dumping data for table `employee_leave_types`
--


--
-- Dumping data for table `employee_positions`
--


--
-- Dumping data for table `employee_salary_structures`
--


--
-- Dumping data for table `events`
--


--
-- Dumping data for table `events_helper`
--


--
-- Dumping data for table `events_old`
--


--
-- Dumping data for table `events_user_preference`
--


--
-- Dumping data for table `exams`
--


--
-- Dumping data for table `exam_groups`
--


--
-- Dumping data for table `exam_scores`
--


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
(6, 'F', NULL, 40, NULL, 0, '2012-02-20 13:41:11', '2012-02-20 13:41:11');

--
-- Dumping data for table `grouped_exams`
--


--
-- Dumping data for table `groups`
--


--
-- Dumping data for table `guardians`
--


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


--
-- Dumping data for table `menu_group`
--


--
-- Dumping data for table `message`
--


--
-- Dumping data for table `messages`
--


--
-- Dumping data for table `message_user`
--


--
-- Dumping data for table `monthly_payslips`
--


--
-- Dumping data for table `news`
--


--
-- Dumping data for table `news_comments`
--


--
-- Dumping data for table `payroll_categories`
--


--
-- Dumping data for table `period_entries`
--


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


--
-- Dumping data for table `student_categories`
--


--
-- Dumping data for table `student_extra`
--


--
-- Dumping data for table `student_previous_datas`
--


--
-- Dumping data for table `student_previous_subject_marks`
--


--
-- Dumping data for table `subjects`
--


--
-- Dumping data for table `subject_name`
--


--
-- Dumping data for table `timetable_entries`
--


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
(85, NULL, '1'),
(86, NULL, '2'),
(87, NULL, '3'),
(88, NULL, '4'),
(89, NULL, '5'),
(90, NULL, '6'),
(91, NULL, '7');
