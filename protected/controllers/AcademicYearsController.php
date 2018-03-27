<?php

class AcademicYearsController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new AcademicYears;
		$err_flag = 0;
		$course_only_err = 0;
		$course_err = 0;
		$batch_err = 0;
		$sub_err = 0;
		$assoc_err = 0;
		$err_msg = Yii::t('app','Some error occured while importing the following.').'<br/>';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		

		if(isset($_POST['AcademicYears']))
		{
			
			$make_inactive = AcademicYears::model()->findByAttributes(array('status'=>1));
			if($_POST['import'] == 1) // Import previous academic structure
			{
				
				
				if($_POST['previous_year'])
				{
					
					if($_POST['previous_course'] or $_POST['previous_course_batch'] or $_POST['previous_subject'] or $_POST['previous_subject_association'])
					{
						$prev_year = $_POST['previous_year'];
						$prev_course = $_POST['previous_course'];
						$prev_course_batch = $_POST['previous_course_batch'];
						$prev_subject = $_POST['previous_subject'];
						$prev_subject_association = $_POST['previous_subject_association'];
					}
					else
					{
						$err_flag = 1;
					}
				}
				else
				{
					$err_flag = 1;
					
				}
			}
			if($err_flag == 0)
			{
				$model->attributes = $_POST['AcademicYears'];
				if($model->start)
				{
					$model->start = date('Y-m-d',strtotime($model->start));
				}
				if($model->end)
				{
					$model->end = date('Y-m-d',strtotime($model->end));
				}
				if($model->save())
				{
					if($model->status == 1)
					{
						if($make_inactive)
						{
							$make_inactive->status = 0;
							$make_inactive->save();
						}
					}
					if($prev_year)
					{
						if($prev_course) // Import only Course structure of the academic year $prev_year
						{
							$courses = Courses::model()->findAllByAttributes(array('academic_yr_id'=>$prev_year));
							foreach($courses as $course)
							{
								$new_course = new Courses;
								$new_course->attributes = $course->attributes;
								$new_course->academic_yr_id = $model->id;
								$new_course->created_at = date('Y-m-d H:i:s');	
								$new_course->updated_at = '';
								

								if(!$new_course->save())
								{
									$course_only_err = 1;									
								}
							}
						}
						elseif($prev_course_batch == 1) // Import Course structure and Batch structure of the academic year $prev_year
						{
							$courses = Courses::model()->findAllByAttributes(array('academic_yr_id'=>$prev_year,'is_deleted'=>0));
							if($courses)
							{
								foreach($courses as $course) //Loop 1
								{
									$batches = Batches::model()->findAllByAttributes(array('course_id'=>$course->id,'academic_yr_id'=>$prev_year,'is_deleted'=>0));
									$new_course = new Courses;
									$new_course->attributes = $course->attributes;
									$new_course->academic_yr_id = $model->id;
									$new_course->created_at = date('Y-m-d H:i:s');	
									$new_course->updated_at = '';
									if($new_course->save()) // Saving Courses
									{
										if($batches)
										{ 
											foreach($batches as $batch) //Loop 2
											{
												$new_batch = new Batches;
												$new_batch->attributes = $batch->attributes;
												$new_batch->course_id = $new_course->id;
												$new_batch->academic_yr_id = $model->id;
												$new_batch->start_date = NULL;
												$new_batch->end_date = NULL;
												if($new_batch->save()) // Saving Batches
												{
													if($prev_subject == 1) // Import Subjects
													{
														$subjects = Subjects::model()->findAllByAttributes(array('batch_id'=>$batch->id,'is_deleted'=>0));
														
														if($subjects)
														{
															$subject_array = array();
															foreach($subjects as $subject) //Loop 3
															{
																$new_subject = new Subjects;
																$new_subject->attributes = $subject->attributes;
																$new_subject->batch_id = $new_batch->id;	
																$new_subject->created_at = date('Y-m-d H:i:s');	
																$new_subject->updated_at = '';
																if($subject->elective_group_id != 0) // Import Elective Groups
																{
																	$electivegroups = ElectiveGroups::model()->findByAttributes(array('id'=>$subject->elective_group_id));
																
																	if($electivegroups)
																	{ 
																		$new_electivegroups = new ElectiveGroups;
																		$new_electivegroups->attributes = $electivegroups->attributes;
																		$new_electivegroups->batch_id = $new_batch->id;
																		$new_electivegroups->created_at = date('Y-m-d H:i:s');	
																		$new_electivegroups->updated_at = '';
																	
																	
																		if($new_electivegroups->save()) // Saving Elective Groups
																		{ 
																			$electives = Electives::model()->findAllByAttributes(array('elective_group_id'=>$electivegroups->id,'is_deleted'=>0));
																			
																			if($electives)
																			{
																				  
																				foreach($electives as $elective)
																				{
																					
																					$new_elective = new Electives;
																					$new_elective->attributes = $elective->attributes;
																					$new_elective->elective_group_id = $new_electivegroups->id;
																					$new_elective->batch_id = $new_batch->id;
																					$new_elective->created_at = date('Y-m-d H:i:s');	
																					$new_elective->updated_at = '';
																					$new_elective->validate();
																					/*var_dump($new_elective->getErrors());
																					var_dump($new_elective->attributes);*/
																					if(!$new_elective->save()) // Saving Elective Subjects
																					{
																						$sub_err = 1;
																						break 4;
																					}
																				} // END foreach($electives as $elective)
																			} // END if($electives)
																		} // END if($new_electivegroups->save())
																		else
																		{
																			$sub_err = 1;
																			break 3;
																		}
																	} // END if($electivegroups)
																} // END if($subject->elective_group_id != 0)
																if($sub_err == 0) // No Subject Import Errors
																{
																	if($new_subject->save()) // Saving Subjects
																	{
																		$subject_array[$subject->id] = $new_subject->id;
																		if($prev_subject_association == 1) // Import Subject Association
																		{
																			if($new_subject->elective_group_id == 0) // Association Electives
																			{
																				$employeesubjects = EmployeesSubjects::model()->findAllByAttributes(array('subject_id'=>$subject->id));
																				if($employeesubjects)
																				{
																					foreach($employeesubjects as $employeesubject)
																					{
																						$new_employeesubject = new EmployeesSubjects;
																						$new_employeesubject->attributes = $employeesubject->attributes;
																						$new_employeesubject->subject_id = $new_subject->id;
																						if(!$new_employeesubject->save()) // Saving Employee Subjects
																						{
																							$assoc_err = 1;
																							break 4;
																						}
																					}
																				}
																			} // END if($new_subject->elective_group_id == 0)
																			else
																			{
																				$employeeElectives = EmployeeElectiveSubjects::model()->findAllByAttributes(array('subject_id'=>$subject->id));
																				if($employeeElectives)
																				{
																					foreach($employeeElectives as $employeeElective)
																					{
																						$new_employeeElective = new EmployeeElectiveSubjects;
																						$new_employeeElective->attributes = $employeeElective->attributes;
																						$new_employeeElective->subject_id = $new_subject->id;
																						if(!$new_employeeElective->save()) // Saving Employee Elective Subjects
																						{
																							$assoc_err = 1;
																							break 4;
																						}
																						
																					}
																				}
																			} // END Association Normal Subjects
																			
																			
																																					
																		} // END if Subject Association Import if($prev_subject_association == 1) 
																	} // END if($new_subject->save())
																	else
																	{
																		$sub_err = 1;
																		break 3;
																	}
																} // END if($sub_err == 0)
															} // END foreach($subjects as $subject)	//END Loop 3
															
															
															if($assoc_err == 0) // No Association Errors
															{
																
																if($prev_timetable == 1) // Import Timetable
																{
																	$weekdays = Weekdays::model()->findAllByAttributes(array('batch_id'=>$batch->id));                                          
																	$classtimings = ClassTimings::model()->findAllByAttributes(array('batch_id'=>$batch->id));                                     
																	
																	$week_array = array();
																	
																	if($weekdays)
																	{ 
                                                                  
																		foreach($weekdays as $weekday)
																		{
																			$new_weekday = new Weekdays;
																			$new_weekday->attributes = $weekday->attributes;
																			$new_weekday->batch_id = $new_batch->id;
																			 
																			if($new_weekday->save())
																			{
																				$week_array[$weekday->id] = $new_weekday->id;
																			}
																			else
																			{
																				$timetable_err = 1;
																				break 3;
																			}
																		}																			
																	} // END if($weekdays)
																	
																	
																	$timing_array = array();
																	if($classtimings)
																	{
																		foreach($classtimings as $classtiming)
																		{
																			$new_classtiming = new ClassTimings;
																			$new_classtiming->attributes = $classtiming->attributes;
																			$new_classtiming->batch_id = $new_batch->id;
																			
																			if($new_classtiming->save())
																			{
																				$timing_array[$classtiming->id] = $new_classtiming->id;
																			}
																			else
																			{
																				$timetable_err = 1;
																				break 3;
																			}
																		}																						
																	} // END if($classtimings)	
																	
																	
																	foreach($subject_array as $key => $value)
																	{
																		echo $key.' - '.$value;
																		$timetables = TimetableEntries::model()->findAllByAttributes(array('batch_id'=>$batch->id,'subject_id'=>$key)); 
																		
																		if($timetables)
																		{
																			foreach($timetables as $timetable)
																			{
																				
																				$new_timetable = new TimetableEntries;
																				$new_timetable->attributes = $timetable->attributes;
																				$new_timetable->batch_id = $new_batch->id;
																				$new_timetable->subject_id = $value;
																				if($week_array[$timetable->weekday_id]!=NULL)
																				{
																					$new_timetable->weekday_id = $week_array[$timetable->weekday_id];
																				}
																				$new_timetable->class_timing_id = $timing_array[$timetable->class_timing_id];
																				$new_timetable->validate();
																				
                                                                                 
																				if(!$new_timetable->save())
																				{
																					$timetable_err = 1;
																					break 3;
																				}
																			}
																		}
																	}
																	
																} // END if($prev_timetable == 1) // Import Timetable																
															} // END if($assoc_err == 1) // No Association Errors
															
															
																													
														} // END if($subjects)
													} // END if Subject Import if($prev_subject == 1)
												} // END if($new_batch->save())
												else
												{
													$batch_err = 1;
													break 2;
												}
											} // END foreach($batches as $batch) //END Loop 2
										} // END if($batches)
									} // END if($new_course->save())
									else
									{
										$course_err = 1;
										break 1;
									}
								} // END foreach($courses as $course) //END Loop 1
							} // END if($courses)
						} // END elseif($prev_course_batch == 1) Import Course and Batch
					}
					
					if($course_only_err == 1)
					{
						$err_flag = 1;
						$err_msg = $err_msg.'- '.Yii::t('app','Course Structure only').'<br/>';
					}
					elseif($course_err == 1)
					{
						$err_flag = 1;
						$err_msg = $err_msg.'- '.Yii::t('app','Course Structure').'<br/>';
					}
					if($batch_err == 1)
					{
						$err_flag = 1;
						$err_msg = $err_msg.'- '.Yii::t('app','Yii::app()->getModule("students")->fieldLabel("Students", "batch_id")'.' '.'Structure').'<br/>';
					}
					if($sub_err == 1)
					{
						$err_flag = 1;
						$err_msg = $err_msg.'- '.Yii::t('app','Subject Structure').'<br/>';
					}
					if($assoc_err == 1)
					{
						$err_flag = 1;
						$err_msg = $err_msg.'- '.Yii::t('app','Subject Association').'<br/>';
					}
					if($timetable_err == 1)
					{
						$err_flag = 1;
						$err_msg = $err_msg.'- '.Yii::t('app','Timetable Structure').'<br/>';
					}
					if($err_flag!=0)
					{
						Yii::app()->user->setFlash('errorMessage',$err_msg);
					}
					
					
					$academic_yr = Configurations::model()->findByPk(35);
					if($model->status == 1)
					{
						$academic_yr->config_value = $model->id;
						$academic_yr->save();
					}
					if($academic_yr)
					{
						$this->redirect(array('view','id'=>$model->id));
					}
					else
					{
						$this->redirect(array('configurations/create'));
					}
				}
				else
				{
					Yii::app()->user->setFlash('errorMessage',Yii::t('app','Academic Year was not saved'));
				}
				
			}
			else
			{
				Yii::app()->user->setFlash('errorMessage',Yii::t('app','Academic Year was not saved'));
			}
		
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AcademicYears']))
		{
			$make_inactive = AcademicYears::model()->findByAttributes(array('status'=>1));
			$academic_yr = Configurations::model()->findByPk(35);
			$model->attributes=$_POST['AcademicYears'];
			if($model->start)
			{
				$model->start = date('Y-m-d',strtotime($model->start));
			}
			if($model->end)
			{
				$model->end = date('Y-m-d',strtotime($model->end));
			}
			if($model->save())
			{
				if($model->status == 1)
				{
					 if($make_inactive != NULL and $make_inactive->id != $model->id) // If the updated year is made Active, existing Active year will be made Inactive
					{
						$make_inactive->status = 0;
						$make_inactive->save();
					} 
					
					$academic_yr->config_value = $model->id;
					$academic_yr->save();
				}
				else
				{
					$only_inactive = AcademicYears::model()->findByAttributes(array('status'=>1));
					if(!$only_inactive)
					{
						$academic_yr->config_value = '';
						$academic_yr->save();
					}
				}
				
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			//$this->loadModel($id)->delete();
			$model = AcademicYears::model()->findByAttributes(array('id'=>$id));
			$model->is_deleted = 1;
			$model->status = 0;
			if($model->save())
			{
				$only_inactive = AcademicYears::model()->findByAttributes(array('status'=>1));
				if(!$only_inactive)
				{
					$academic_yr = Configurations::model()->findByPk(35);
					$academic_yr->config_value = '';
					$academic_yr->save();
				}
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AcademicYears');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AcademicYears('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AcademicYears']))
			$model->attributes=$_GET['AcademicYears'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	
	   

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=AcademicYears::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('app','The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='academic-years-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
