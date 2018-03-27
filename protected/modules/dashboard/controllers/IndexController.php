<?php
class IndexController extends RController
{
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	public function actionIndex()
	{                        
		if(Yii::app()->user->id)
		{
                    //	$this->render('index');
                    $this->render('dashboard');
		}
		else
		{
			$this->redirect('user/login');
		}
	}
        
        //save new order of blocks
        public function actionSaveOrder()
        {
            $response = array('status'=>'failed');
            if(isset($_POST['user_id']) && $_POST['user_id']!=NULL)
            {
                if(isset($_POST['block_data']) && $_POST['block_data']!="")
                {
                    $questions  =   $_POST['block_data'];
                    foreach ($questions as $data)
                    {
                        $model  = DashboardSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id ,'block_id'=>$data['id']));
                        if($model!=NULL)
                        {
                            $model->block_order   =   $data['order'];
                            $model->save();
                        }  
                        else
                        {
                            $model              =   new DashboardSettings;
                            $model->user_id     =   Yii::app()->user->id;
                            $model->block_id    =   $data['id'];
                            $model->block_order =   $data['order'];
                            $model->is_visible  =   1;
                            $model->save();
                        }
                    }
                    $response['status']	= "success";
                }                
            }
            echo json_encode($response);
            Yii::app()->end();
        }
        
        
        
}