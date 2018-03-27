<?php
$this->breadcrumbs=array(
        Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Themes')
	
);

    $left= '/configurations/left_side';
    
?>


        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
    	<td width="247" valign="top">
            <?php $this->renderPartial($left);?>        
        </td>
        <td valign="top">
          <div class="cont_right"> 
              <div class="edit_bttns last"><ul><li>
                         
                <?php 
                $themes_model= Themes::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                if($themes_model)
                {  
                    echo CHtml::link('<span>'.Yii::t('app','Set Default Theme').'</span>', array('delete', 'id'=>$themes_model->id),array('class'=>'edit','confirm'=>Yii::t('app','Are You Sure?')));
                } 
                ?>
                    </li>
                    </ul>
            </div>
            <h1><?php echo Yii::t('app','Manage Themes'); ?></h1>
            <?php 
            $themes_model= Themes::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
            if($themes_model)
                {  
                    echo $this->renderPartial('_form', array('model'=>$themes_model,'status'=>1));
                }
                else
                {
                    echo $this->renderPartial('_form', array('model'=>new Themes,'status'=>0));
                }
                ?>
          </div>
        </td>
        </tr>
        </table>   
        