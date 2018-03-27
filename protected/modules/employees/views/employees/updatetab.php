<div class="page-tab-atag">
<ul>
  
    <?php 
		if(in_array(Yii::app()->controller->action->id,array('update')) and in_array(Yii::app()->controller->id,array('employees')))
                {
                    if(isset($_REQUEST['id']))
                    {
                       
                        if(isset($_REQUEST['type']) && $_REQUEST['type']==1)
                        {
                            echo '<li class="cur"><h2>'.CHtml::link(Yii::t('app','Teacher Details'),array('/employees/employees/update','id'=>$_REQUEST['id'],'type'=>1)).'</h2></li>';
                            echo '<li><h2>'.CHtml::link(Yii::t('app','Teacher Contact Details'),array('/employees/employees/update2','id'=>$_REQUEST['id'],'type'=>1)).'</h2></li>';
                            echo '<li><h2>'.CHtml::link(Yii::t('app','Teacher Documents'),array('/employees/employeeDocument/create','id'=>$_REQUEST['id'])).'</h2></li>';  
                        }
                        else
                        {
                            echo '<li class="cur"><h2>'.CHtml::link(Yii::t('app','Teacher Details'),array('/employees/employees/update','id'=>$_REQUEST['id'])).'</h2></li>';
                            echo '<li><h2>'.CHtml::link(Yii::t('app','Teacher Contact Details'),array('/employees/employees/update2','id'=>$_REQUEST['id'])).'</h2></li>';
                        }
                    } 
                    else
                    {
//                        echo '<li><h2 class="cur">'.CHtml::link(Yii::t('app','Teacher Details'),array('/employees/employees/create')).'</h2></li>';
//                        echo '<li><h2>'.Yii::t('app','Teacher Contact Details').'</h2></li>';
//                        echo '<li><h2>'.Yii::t('app','Teacher Documents').'</h2></li>';  
                    }                                        
                }
		
                
                
                if(in_array(Yii::app()->controller->action->id,array('update2')) and in_array(Yii::app()->controller->id,array('employees')))
                {
                    if(isset($_REQUEST['id']))
                    {
                        
                        if(isset($_REQUEST['type']) && $_REQUEST['type']==1)
                        {
                            echo '<li><h2 >'.CHtml::link(Yii::t('app','Teacher Details'),array('/employees/employees/update','id'=>$_REQUEST['id'],'type'=>1)).'</h2></li>';
                            echo '<li class="cur"><h2>'.CHtml::link(Yii::t('app','Teacher Contact Details'),array('/employees/employees/update2','id'=>$_REQUEST['id'],'type'=>1)).'</h2></li>';
                            echo '<li><h2>'.CHtml::link(Yii::t('app','Teacher Documents'),array('/employees/employeeDocument/create','id'=>$_REQUEST['id'])).'</h2></li>';  
                        }
                        else 
                        {
                            echo '<li><h2 >'.CHtml::link(Yii::t('app','Teacher Details'),array('/employees/employees/update','id'=>$_REQUEST['id'])).'</h2></li>';
                            echo '<li><h2>'.CHtml::link(Yii::t('app','Teacher Contact Details'),array('/employees/employees/update2','id'=>$_REQUEST['id'])).'</h2></li>';
                        }
                    } 
                    else
                    {
                        echo '<li class="cur"><h2>'.CHtml::link(Yii::t('app','Teacher Contact Details'),array('/employees/employees/create2')).'</h2></li>';
                    }
                }
		
                
                
                
                
                if(in_array(Yii::app()->controller->action->id,array('create')) and in_array(Yii::app()->controller->id,array('employeeDocument')))
                {
                    if(isset($_REQUEST['id']))
                    {
                        echo '<li><h2>'.Yii::t('app','Teacher Details').'</h2></li>';
                        echo '<li><h2>'.CHtml::link(Yii::t('app','Teacher Contact Details'),array('/employees/employees/update2','id'=>$_REQUEST['id'])).'</h2></li>';
                        echo '<li class="cur"><h2>'.CHtml::link(Yii::t('app','Teacher Documents'),array('/employees/employeeDocument/create','id'=>$_REQUEST['id'])).'</h2></li>';  
                    } 
                    else
                    {
                        echo '<li class="cur"><h2>'.CHtml::link(Yii::t('app','Teacher Documents'),array('/employees/employees/create2')).'</h2></li>';
                    }
                }
                
		
		?>
  
<!--   <li>
    <?php 
//		if(in_array(Yii::app()->controller->action->id,array('create2','update2')))
//			echo  '<h2 class="cur">'.Yii::t('app','Teacher Contact Details').'</h2>'; 
//		else
//			 echo  '<h2>'.Yii::t('app','Teacher Contact Details').'</h2>'; 
		?>
  </li>
  <li>
    <?php 
//	if(!in_array(Yii::app()->controller->action->id,array('update','update2'))){
//		if(Yii::app()->controller->action->id=='create' and Yii::app()->controller->id == 'employeeDocument')
//			echo  '<h2 class="cur">'.Yii::t('app','Teacher Documents').'</h2>'; 
//		else
//			 echo  '<h2>'.Yii::t('app','Teacher Documents').'</h2>'; 
//	}
		?>
  </li>-->
  
</ul>
</div>
