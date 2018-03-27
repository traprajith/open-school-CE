<div id="othleft-sidebar">
    <h1><?php echo Yii::t('app','General Settings'); ?></h1>
    <?php
        $this->widget('zii.widgets.CMenu',array(
            'encodeLabel'=>false,
            'activateItems'=>true,
            'activeCssClass'=>'list_active',
            'items'=>array(
				array(
					'label'=>''.Yii::t('app','Manage Academic Years').'<span>'.Yii::t('app','Manage All Academic Years').'</span>',
					'url'=>array('/academicYears/admin'),
					'active'=> ((Yii::app()->controller->id=='academicYears') && (in_array(Yii::app()->controller->action->id,array('create','index','admin'))? true : false)),				
					'linkOptions'=>array('class'=>'manageacadamic-year_ico' ), 
					'itemOptions'=>array('id'=>'menu_1'),
				),
				array(
					'label'=>'<h1>'.Yii::t('app','User Settings').'</h1>'
				),
				array(
					'label'=>Yii::t('app','Create New User').'<span>'.Yii::t('app','Add New User Details').'</span>',
					'url'=>array('/user/admin/create'),
					'visible'=>Yii::app()->user->checkAccess("Admin"),
					'active'=> ((Yii::app()->controller->id=='admin' and Yii::app()->controller->action->id=='create') ? true : false),
					'linkOptions'=>array('class'=>'creat-newnew_ico' )
				),
				array(
					'label'=>Yii::t('app','Manage Users').'<span>'.Yii::t('app','Manage All Users').'</span>',
					'url'=>array('/user/admin'),
					'visible'=>Yii::app()->user->checkAccess("Admin"),
					
					'active'=> ((Yii::app()->controller->id=='admin' and Yii::app()->controller->action->id!='create') ? true : false),
					'linkOptions'=>array('class'=>'setting-manageuser_ico' )
				),
				array('label'=>''.Yii::t('app','Manage User Roles').'<span>'.Yii::t('app','Delete existing user roles').'</span>',  'url'=>array('/rights/authItem/manageroles'),'active'=> ((Yii::app()->controller->id=='authItem') && (in_array(Yii::app()->controller->action->id,array('manageroles','editrole'))? true : false)),'linkOptions'=>array('class'=>'gs_ico' ), 'itemOptions'=>array('id'=>'menu_1'),
					 ),
				array('label'=>''.Yii::t('app','Create User Role').'<span>'.Yii::t('app','Create a new user role').'</span>',  'url'=>array('/rights/authItem/assignrole'),'active'=> ((Yii::app()->controller->id=='authItem') && (in_array(Yii::app()->controller->action->id,array('assignrole'))? true : false)),'linkOptions'=>array('class'=>'gs_ico' ), 'itemOptions'=>array('id'=>'menu_1'),
					),	 
				array(
					'label'=>Yii::t('app','Change Password').'<span>'.Yii::t('app','Manage All Users').'</span>',
					'url'=>array('/user/profile/changepassword'),
					'linkOptions'=>array('class'=>'setting-passwors_ico' )
				),
				
            ),
        ));
    ?>
</div>