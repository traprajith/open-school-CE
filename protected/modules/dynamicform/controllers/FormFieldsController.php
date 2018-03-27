<?php

class FormFieldsController extends RController
{
	public $layout='//layouts/column2';
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','subtab'),
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
	
	public function actionView($id)
	{
		$this->render('detail',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionSubtab()
	{	
		if(isset($_REQUEST['tab_selection']))
		{
			$sub_tabs= FormFields::model()->getSubsection($_REQUEST['tab_selection']);
		}

		echo "<option value=''>Select</option>";
	    foreach($sub_tabs as $value=>$tabs)
	    echo CHtml::tag('option', array('value'=>$value),CHtml::encode($tabs),true);
		
	}
	public function actionDetail($id)
	{
		$this->render('detail',array(
			'model'=>$this->loadModel($id),
		));

	}

	public function actionList()
	{
		$criteria = new CDbCriteria;
                $criteria->condition= 'is_exception=:is_exception';
                $criteria->params= array(':is_exception'=>0);
                if(isset($_GET['field_title']) && $_GET['field_title']!="")
                {
                    
                    $criteria->addCondition('title LIKE"'."%".$_GET['field_title']."%".'"');
                    
                } 
                if(isset($_GET['field_type']) && $_GET['field_type']!="")
                {
                    
                    $criteria->addCondition('form_field_type LIKE"'."%".$_GET['field_type']."%".'"');
                    
                } 
		$total = FormFields::model()->count($criteria);
		$pages = new CPagination($total);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria); 
		
		$fields = FormFields::model()->findAll($criteria);
		$this->render('list',array('fields'=>$fields,'pages' => $pages,'item_count'=>$total,'page_size'=>Yii::app()->params['listPerPage']));
	}
	
        public function actionSettings()
        {
            if(isset($_REQUEST['status']) && $_REQUEST['status']==1)
            {
                $field_id= $_REQUEST['field_id'];   
                $portal= $_REQUEST['portal']; 
                $model= FormFields::model()->findByPk($field_id);
                if($model)
                {
                   
                    if($portal==1){ $model->admin_student_reg_form=1; }
                    if($portal==2){ $model->online_admission_form=1; }
                    if($portal==3){ $model->student_profile_pdf=1; }
                    if($portal==4){ $model->student_profile=1; }
                    if($portal==5){ $model->student_portal=1; }
                    if($portal==6){ $model->parent_portal=1; }
                    if($portal==7){ $model->teacher_portal=1; }
                    
                    if($model->save())
                    {                      
						echo CJSON::encode(array(
							'status'=>'success',			   
						));
                    }
                    else{
						echo CJSON::encode(array(
							'status'=>'error',			   
						));
					}
                }                               
                    
            }
            if(isset($_REQUEST['status']) && $_REQUEST['status']==0)
            {
                $field_id= $_REQUEST['field_id'];   
                $portal= $_REQUEST['portal']; 
                $model= FormFields::model()->findByPk($field_id);
                if($model)
                {
                    if($portal==1){ $model->admin_student_reg_form=0; }
                    else if($portal==2){ $model->online_admission_form=0; }
                    else if($portal==3){ $model->student_profile_pdf=0; }
                    else if($portal==4){ $model->student_profile=0; }
                    else if($portal==5){ $model->student_portal=0; }
                    else if($portal==6){ $model->parent_portal=0; }
                    else if($portal==7){ $model->teacher_portal=0; }
                    
                    if($model->save())
                    {
						echo CJSON::encode(array(
							'status'=>'success',			   
						));
                    }
					else{
						echo CJSON::encode(array(
							'status'=>'error',			   
						));
					}
                    
                }                               
                    
            }
        }
        
        public function actionAllsettings()
        {
           
            if(isset($_REQUEST['status']) && $_REQUEST['status']==0)
            {
                $field_id= $_REQUEST['field_id'];                   
                $model= FormFields::model()->findByPk($field_id);
                if($model)
                {
                    $model->admin_student_reg_form=0;
                    $model->online_admission_form=0;
                    $model->student_profile_pdf=0;
                    $model->student_profile=0;
                    $model->student_portal=0;
                    $model->parent_portal=0;
                    $model->teacher_portal=0;                                       
                    if($model->save())
                    {
                            echo CJSON::encode(array(
                                    'status'=>'success',			   
                            ));
                    }                                                           
                }                                                   
            }
        }

        public function actionCreate()
	{
		$model=new FormFields;
                $model->setScenario('create');
                $scheme = get_class(Yii::app()->db->schema);		
		if(isset($_POST['FormFields']))
		{                                   
			$model->attributes=$_POST['FormFields'];
                        if($model->model==NULL)
                        {
                            if($model->tab_selection!=NULL)
                            {                                                        
                               $model->model= FormFields::getmodelname($model->tab_selection);                                                        
                            }
                        }
                        if($model->form_field_type==3 || $model->form_field_type==4 || $model->form_field_type==5)
                        {
                            $model->field_type= "INTEGER";
                            $model->field_size= 11;
                        }
                        if($model->form_field_type==1)
                        {
                            $model->field_type= "VARCHAR";
                            $model->field_size= 255;
                        }
                        if($model->form_field_type==2)
                        {
                            $model->field_type= "TEXT";
                        }
                        if($model->form_field_type==6)
                        {
                            $model->field_type= "DATE";
                        }
                        if($model->tab_selection!=NULL)
                        {
                            $model->model= FormFields::getmodelname($model->tab_selection);
                        }
                        $model->is_dynamic=1;
                        $model->is_exception=0;
                        if($model->validate()) 
                        {                            
                            if($model->is_dynamic==1)
                            {
                                $new_model= $model->model;
				$sql = 'ALTER TABLE '.$new_model::model()->tableName().' ADD `'.$model->varname.'` ';
				$sql .= $this->fieldType($model->field_type);
				if (
						$model->field_type!='TEXT'
						&& $model->field_type!='DATE'
						&& $model->field_type!='BOOL'
						&& $model->field_type!='BLOB'
						&& $model->field_type!='BINARY'
					)
					$sql .= '('.$model->field_size.')';
                                
				//$sql .= ' NOT NULL ';
				
				if ($model->field_type!='TEXT'&&$model->field_type!='BLOB'||$scheme!='CMysqlSchema') {
					if ($model->default)
						$sql .= " DEFAULT '".$model->default."'";
					else
						$sql .= ((
									$model->field_type=='TEXT'
									||$model->field_type=='VARCHAR'
									||$model->field_type=='BLOB'
									||$model->field_type=='BINARY'
								)?" DEFAULT ''":(($model->field_type=='DATE')?" DEFAULT '0000-00-00'":" DEFAULT NULL"));
				}
                                
                                //echo $sql; exit;
                                
				$model->dbConnection->createCommand($sql)->execute();  
                            }
                            
                            if($model->save())
                            {                                
                                if($model->form_field_type==3 || $model->form_field_type==4 || $model->form_field_type==5)
                                {
                                    $this->redirect(array('fields','id'=>$model->id));
                                }
                                else
                                {
                                    $this->redirect(array('view','id'=>$model->id));
                                }
                            }
                            
                        }
                        
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        public function actionUpdate($id)
	{
		$model= $this->loadModel($id);
        $scheme = get_class(Yii::app()->db->schema);		
		if(isset($_POST['FormFields']))
		{                                   
			$model->attributes=$_POST['FormFields'];
                        if($model->model==NULL)
                        {
                            if($model->tab_selection!=NULL)
                            {                                                        
                               $model->model= FormFields::getmodelname($model->tab_selection);                                                        
                            }
                        }
                        if($model->form_field_type==3 || $model->form_field_type==4 || $model->form_field_type==5)
                        {
                            $model->field_type= "INTEGER";
                            $model->field_size= 11;
                        }
                        if($model->form_field_type==1)
                        {
                            $model->field_type= "VARCHAR";
                            $model->field_size= 255;
                        }
                        if($model->form_field_type==2)
                        {
                            $model->field_type= "TEXT";
                        }
                        if($model->form_field_type==6)
                        {
                            $model->field_type= "DATE";
                        }
                        if($model->tab_selection!=NULL)
                        {
                            $model->model= FormFields::getmodelname($model->tab_selection);
                        }
                        
                        if($model->validate()) 
                        {                                                                                    
                            if($model->save())
                            {       
                                if($model->is_dynamic==1)
                                {                         
                                    if($model->form_field_type==3 || $model->form_field_type==4 || $model->form_field_type==5)
                                    {

                                        $this->redirect(array('fields','id'=>$model->id));
                                    }
                                    else
                                    {
                                        $this->redirect(array('view','id'=>$model->id));
                                    }
                                }
                                else
                                {
                                     $this->redirect(array('view','id'=>$model->id));
                                }
                            }                                                                                    
                        }
                         
                        
				
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionDynamic($id)
	{
		$model= $this->loadModel($id);
                $old_field_type= $model->field_type;
                $old_form_type= $model->form_field_type;
                $scheme = get_class(Yii::app()->db->schema);		
		if(isset($_POST['FormFields']))
		{                                   
			$model->attributes=$_POST['FormFields'];
                        if($model->model==NULL)
                        {
                            if($model->tab_selection!=NULL)
                            {                                                        
                               $model->model= FormFields::getmodelname($model->tab_selection);                                                        
                            }
                        }
                        if($model->form_field_type==3 || $model->form_field_type==4 || $model->form_field_type==5)
                        {
                            $model->field_type= "INTEGER";                            
                            $model->field_size= 11; 
                        }
                        if($model->form_field_type==1)
                        {
                            $model->field_type= "VARCHAR";                            
                            $model->field_size= 255;
                            
                        }
                        if($model->form_field_type==2)
                        {
                            $model->field_type= "TEXT";
                            $model->field_size= "";
                        }
                        if($model->form_field_type==6)
                        {
                            $model->field_type= "DATE";
                            $model->field_size= "";
                        }
                        if($model->tab_selection!=NULL)
                        {
                            $model->model= FormFields::getmodelname($model->tab_selection);
                        }
                        
                        if($model->validate()) 
                        {                                                                                    
                            if($model->save())
                            {       
                                $name= $model->model;
                                $type="";
                                if($model->field_type=="INTEGER")
                                {
                                    $type= "int".'(11)';
                                }
                                else if($model->field_type=="VARCHAR")
                                {
                                    $type= "varchar(255)";
                                }
                                else if($model->field_type=="TEXT")
                                {
                                    $type= "text";
                                }
                                else if($model->field_type=="DATE")
                                {
                                    $type= "date";
                                }
                                
                                $update_sql= 'UPDATE '.$name::model()->tableName().' SET `'.$model->varname.'`=NULL';
                                Yii::app()->db->createCommand($update_sql)->execute();
                                 
                                //delete data from form data
                                $check=0;
                                if($old_form_type!= $model->form_field_type and $model->form_field_type==5)
                                {
                                    $check=1;
                                }
                                if($old_field_type!=$model->field_type or $check==1)
                                {
                                    $datamodel= FormFieldData::model()->findAllByAttributes(array('field_id'=>$model->id));
                                    if($datamodel)
                                    {
                                        FormFieldData::model()->deleteAllByAttributes(array('field_id'=>$model->id));
                                    }
                                }
                                
                                $sql = 'ALTER TABLE '.$name::model()->tableName().' MODIFY COLUMN `'.$model->varname.'` '.$type;
                                Yii::app()->db->createCommand($sql)->execute();
                          
                                if($model->form_field_type==3 || $model->form_field_type==4 || $model->form_field_type==5)
                                {
                                    $this->redirect(array('fields','id'=>$model->id));
                                }
                                else
                                {
                                    $this->redirect(array('view','id'=>$model->id));
                                }
                            }
                            
                        }
                        
				
		}

		$this->render('dynamic',array(
			'model'=>$model,
		));
	}
              
        public function actionCreate1()
	{
		$model=new FormFieldsCommon;
                $scheme = get_class(Yii::app()->db->schema);		
		if(isset($_POST['FormFieldsCommon']))
		{                                   
			$model->attributes=$_POST['FormFieldsCommon'];
                        if($model->model==NULL)
                        {
                            if($model->tab_selection!=NULL)
                            {                                                        
                               $model->model= FormFields::getmodelname($model->tab_selection);                                                        
                            }
                        }                        
                        
                        if($model->validate()) 
                        {                                                        
                            
                            if($model->save())
                            {                                
                                if($model->form_field_type==3 || $model->form_field_type==4 || $model->form_field_type==5)
                                {
                                    $this->redirect(array('fields','id'=>$model->id));
                                }
                                else
                                {
                                    $this->redirect(array('view','id'=>$model->id));
                                }
                            }                            
                        }                        				
		}

		$this->render('create1',array(
			'model'=>$model,
		));
	}
        
        public function actionFields()
        {
                $model=new FormFieldData;
		if(isset($_POST['FormFieldData']))
                {
                $errors		= array();
                $has_error	= false;				
                $model->attributes		= $_POST['FormFieldData'];									

                if($_POST['FormFieldData']['option_name'])
                {
                    foreach($_POST['FormFieldData']['option_name'] as $i=>$name)
                    {
                        $model	= new FormFieldData;						                               	
                        $model->option_name= $_POST['FormFieldData']['option_name'][$i];                                
                        if(!$model->validate()){
                                $has_error	= true;
                                //get error from particular
                                foreach($model->getErrors() as $attribute=>$error){
                                        $key		= "FormFieldData_".$attribute."_".$i;							
                                        $errors[$key][$i]	= $error[0];
                                }			
                        }
                    }
                }
                if($has_error==true)
                {
                    echo CJSON::encode(array('status'=>'error', 'errors'=>$errors));			
                    exit;
		}
                else
                {   
                    
                    foreach($_POST['FormFieldData']['option_name'] as $i=>$name)
                    {                           
                        if(isset($_POST['option_data'][$i]) && $_POST['option_data'][$i]!="")
                        {
                            $id= $_POST['option_data'][$i];
                            $model	= FormFieldData::model()->findByPk($id);
                            $model->field_id= $_POST['FormFieldData']['field_id'];
                            $model->option_name= $_POST['FormFieldData']['option_name'][$i];  
                            $model->save();
                            
                        }
                        else
                        {
                            $model	= new FormFieldData;	
                            $model->field_id= $_POST['FormFieldData']['field_id'];
                            $model->option_name= $_POST['FormFieldData']['option_name'][$i];  
                            $model->save();
                        }   
                        
                       // var_dump($model->getErrors()); exit;
                    }  
                   
                        //send success message
                        echo CJSON::encode(array('status'=>'success', 'redirect'=>Yii::app()->createUrl('/dynamicform/formFields/detail',array('id'=>$model->field_id))));
                        exit;                   
                }                
            }

		$this->render('rend_page',array('model'=>$model,'first'=>0));
        }
        

        public function actionAddRow($last="", $first=""){
		$data		= $this->renderPartial('option',array('last'=>$last, 'first'=>$first), true);
		echo CJSON::encode(array('status'=>'success', 'data'=>$data));
	}
        
        //for delete form field data
        public function actionDeleteData()
        {
            if(isset($_REQUEST['id']))
            {
                $id= $_REQUEST['id'];
                $model=FormFieldData::model()->findByPk($id);
                if($model)
                {
                    $model->delete();
                    echo CJSON::encode(array('status'=>'success'));
                }
                else
                {
                    echo CJSON::encode(array('status'=>'error'));
                }
            }
        }

        public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
	}
	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('FormFields');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionArrange(){
		if(Yii::app()->request->isAjaxRequest){
			$response 	= array('status'=>'error');
			if(isset($_POST['fields'])){
				foreach ($_POST['fields'] as $key => $id) {
					$field 	= FormFields::model()->findByPk($id);
					if($field!=NULL){
						$field->position 	= $key + 1;
						$field->save();
						$response['status']	= "success";
					}
				}
			}
			echo json_encode($response);
			Yii::app()->end();
		}
		else{
			if(!isset($_GET['model']) or (isset($_GET['model']) and $_GET['model']=="")){
				$this->render('arrange', array());
			}
			else if(isset($_GET['model']) and array_key_exists($_GET['model'], FormFields::model()->itemAlias('tab_selection'))){
				$this->render('arrange', array());
			}
			else{
				throw new CHttpException(404, Yii::t('app', 'The requested model does not exist.'));
			}
		}		
	}

	public function loadModel($id)
	{
		$model=FormFields::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('app','The requested page does not exist.'));
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='form-fields-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function fieldType($type) {
		$type = str_replace('UNIX-DATE','INTEGER',$type);
		return $type;
	}
        
        public function actionFielddelete()
        {
			if(Yii::app()->request->isPostRequest){
				$scheme = get_class(Yii::app()->db->schema);
				if(isset($_REQUEST['id']) && $_REQUEST['id']!=NULL)
				{            
				   $id= $_REQUEST['id'];
					$model= FormFields::model()->findByPk($id);
					if($model)
					{                   
						$model_name= $model->model;
						if ($scheme=='CSqliteSchema') {
							
						}
						else
						{
						  $name= $model->model;
						  $field_name= $model->varname;
						  if($model->delete())
						  {
							  $sql = 'ALTER TABLE '.$name::model()->tableName().' DROP `'.$field_name.'`';
							  Yii::app()->db->createCommand($sql)->execute();
							  echo json_encode(array('status'=>'success'));
							  exit;							 
						  }   
						  else
						  {
							  echo json_encode(array('status'=>'error'));
							  exit;									
						  }
						}
					}						
				}		
			}
			else{
				echo json_encode(array('status'=>'error'));
                exit;
			}
        }
        
        
       
}
