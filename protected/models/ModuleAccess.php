<?php

/**
 * This is the model class for table "module_access".
 *
 * The followings are the available columns in table 'module_access':
 * @property integer $id
 * @property integer $role_id
 * @property integer $module_id
 */
class ModuleAccess extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ModuleAccess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module_access';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, module_id', 'required'),
			array('role_id, module_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, role_id, module_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t("app",'ID'),
			'role_id' => Yii::t("app",'Role Name'),
			'module_id' => Yii::t("app",'Module'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('module_id',$this->module_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function isEnabled($module_name)
	{
		$module = Modules::model()->findByAttributes(array('name'=>$module_name));
		if($module and $module->control==1){
			return true;
		}
		return false;
	}
	
	public function check($module_name)
	{
		$module = Modules::model()->findByAttributes(array('name'=>$module_name));
		if($module and $module->control==1)
		{			
			$roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
			if($roles and $roles!=NULL)
			{
				foreach($roles as $role)
				{
					$rolename = $role->name;
				}
				if($role->name!='Admin')
				{
					if($role->name=='parent' or $role->name=='student' or $role->name=='teacher'){
						return true;
					}else{
						$userrole = UserRoles::model()->findByAttributes(array('name'=>$rolename));
						if($userrole and $userrole!=NULL)
						{
							$access = ModuleAccess::model()->findByAttributes(array('role_id'=>$userrole->id,'module_id'=>$module->id));
							if(isset($access) and $access!=NULL)
							{
								return true;
							}
							else
							{
								return false;
							}
						}
						else
						{
							return false;
						}
					}
				}
				else
				{
					return true;
				}			
			}
			else
			{
				return false;
			}	
		}
		else
		{
			return false;
		}
	}
	
	public function modulecount()
	{
			$roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
			if($roles and $roles!=NULL)
			{
				foreach($roles as $role)
				{
					$rolename = $role->name;
				}
				if($role->name!='Admin')
				{
					$userrole = UserRoles::model()->findByAttributes(array('name'=>$rolename));
					if($userrole and $userrole!=NULL)
					{
						$modules = Modules::model()->findAllByAttributes(array('control'=>1));
						if($modules and $modules!=NULL)
						{
							$count = 0;
							foreach($modules as $module)
							{
								$access = ModuleAccess::model()->findByAttributes(array('role_id'=>$userrole->id,'module_id'=>$module->id));
								if($access and $access!=NULL)
								{
									$count++;
								}
							}
							
								return $count;
							
						}
						else
						{
							return 0;
						}
						
					}
					else
					{
						return 0;
					}
				}
				else
				{
					$modules = Modules::model()->findAllByAttributes(array('control'=>1));
					return count($modules);
				}
				
			
			
			}
			else
			{
				return 0;
			}
			
			
		}
}