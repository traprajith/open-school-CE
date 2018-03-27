<?php
class SettingsController extends RController
{
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
        
        //manage dashboard blocks
        public function actionIndex()
        {    
            if(isset(Yii::app()->user->id))
            {
                $user_id    =   Yii::app()->user->id;
                $exist      = DashboardSettings::model()->exists('user_id=:user_id', array(':user_id'=>$user_id));                
                if(!$exist)
                {
                    $dashboard_model  =   Dashboard::model()->findAll();
                    if($dashboard_model!=NULL)
                    {                       
                        foreach($dashboard_model as $data)
                        {
                            $model              =   new DashboardSettings;
                            $model->user_id     =   $user_id;
                            $model->block_id    =   $data->id;
                            $model->block_order =   $data->default_order;
                            $model->is_visible  =   1;
                            $model->save();                            
                        }
                    }
                }
            }
            $this->render('index');
        }
        
        //disable blocks in dashboard
        public function actionDisable($id)
	{
            $model  = DashboardSettings::model()->findByPk($id);
            if($model!=NULL)
            {
                $model->is_visible=0;
                $model->save();
            }		
            $this->redirect(array('index'));
	}
        
	//enable blocks in dashboard - from settings
	public function actionEnable($id)
	{
            $model  = DashboardSettings::model()->findByPk($id);
            if($model!=NULL)
            {
                $model->is_visible=1;
                $model->save();
            }		
            $this->redirect(array('index'));
	}
        
        //disable all blocks in dashboard
        public function actionDisableAll()
	{
            if(isset(Yii::app()->user->id))
            {
                $user_id    =   Yii::app()->user->id;
                $model  = DashboardSettings::model()->findAllByAttributes(array('user_id'=>$user_id,'is_visible'=>1));
                if($model!=NULL)
                {
                    foreach($model as $data)
                    {
                        $data->is_visible=0;
                        $data->save();
                    }
                }		
                $this->redirect(array('index'));
            }
	}
        
        //enable all blocks in dashboard
        public function actionEnableAll()
	{
            if(isset(Yii::app()->user->id))
            {
                $user_id    =   Yii::app()->user->id;
                $model  = DashboardSettings::model()->findAllByAttributes(array('user_id'=>$user_id,'is_visible'=>0));
                if($model!=NULL)
                {
                    foreach($model as $data)
                    {
                        $data->is_visible=1;
                        $data->save();
                    }
                }		
                $this->redirect(array('index'));
            }
	}
        
        //hide blocks in dashboard
        public function actionHideBlock()
        {
            $response	= array('status'=>'failed');
            if(isset($_POST['block_id']) && $_POST['block_id']!=NULL && isset(Yii::app()->user->id))
            {
                $user_id    =   Yii::app()->user->id;
                $block_id   =   $_POST['block_id'];                
                $exist      = DashboardSettings::model()->exists('user_id=:user_id', array(':user_id'=>$user_id));                
                if(!$exist)
                {
                    $dashboard_model  =   Dashboard::model()->findAll();
                    if($dashboard_model!=NULL)
                    {
                        $order  =   1;
                        foreach($dashboard_model as $data)
                        {
                            $model              =   new DashboardSettings;
                            $model->user_id     =   $user_id;
                            $model->block_id    =   $data->id;
                            $model->block_order =   $order;
                            $model->is_visible  =   1;
                            $model->save();                            
                        }
                    }
                }               
                $model      = DashboardSettings::model()->findByAttributes(array('user_id'=>$user_id,'block_id'=>$block_id));
                if($model!=NULL)
                {
                    $model->is_visible  =   0;
                    $model->save();
                    $response['status']	= "success";
                }                                
            }
            else
            {
                $response['status']	= "error";
            }
            echo json_encode($response);                
            Yii::app()->end();
        }
        
        public function actionReset()
        {
            if(isset(Yii::app()->user->id))
            {
                $user_id    =   Yii::app()->user->id;
                $model  = DashboardSettings::model()->findAllByAttributes(array('user_id'=>$user_id));
                if($model!=NULL)
                {
                    foreach($model as $data)
                    {
                        $dashboard  = Dashboard::model()->findByPk($data->block_id);
                        if($dashboard!=NULL)
                        {
                            $data->block_order  = $dashboard->default_order;
                            $data->save();                            
                        }                        
                    }
                }		
                $this->redirect(array('index'));
            }
        }
}
?>