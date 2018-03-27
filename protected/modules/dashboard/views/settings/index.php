<?php
$this->breadcrumbs=array(
	Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Dashboard Settings'),
);

?>
<?php 
$user_id    =   Yii::app()->user->id;
$criteria               =   new CDbCriteria;
$criteria->condition    =   'user_id=:user_id AND is_visible=0';
$criteria->params       =   array(':user_id'=>$user_id);
$n_count                  =   DashboardSettings::model()->count($criteria);

$criteria               =   new CDbCriteria;
$criteria->condition    =   'user_id=:user_id AND is_visible=1';
$criteria->params       =   array(':user_id'=>$user_id);
$v_count                  =   DashboardSettings::model()->count($criteria);


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="247" valign="top">
        <div id="othleft-sidebar">
            <?php $this->renderPartial('application.views.configurations.left_side', array());?>
        </div>
    </td>
    <td valign="top">
        <div class="cont_right formWrapper">
            <h1><?php echo Yii::t('app','Manage Dashboard Blocks');?></h1>

<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
                <ul>
                    <li><?php echo CHtml::link('<span>'.Yii::t('app','Reset Order').'</span>', array('/dashboard/settings/reset'),array('confirm' => Yii::t('app','Are you sure you want to reset block order?'),'class'=>'a_tag-btn')); ?></li>
                    <?php if(isset($n_count) && $n_count!=0){ ?>
                    <li><?php echo CHtml::link('<span>'.Yii::t('app','Enable All').'</span>', array('/dashboard/settings/enableAll'),array('confirm' => Yii::t('app','Are you sure you want to enable all blocks?'),'class'=>'a_tag-btn')); ?></li>
                    <?php } ?>
                    <?php if(isset($v_count) && $v_count!=0){ ?>
                    <li><?php echo CHtml::link('<span>'.Yii::t('app','Disable All').'</span>', array('/dashboard/settings/disableAll'),array('confirm' => Yii::t('app','Are you sure you want to disable all blocks?'),'class'=>'a_tag-btn')); ?></li>
                    <?php } ?>
                </ul>
            </div>
            </div>
            <?php $cls = "even"; ?>
            <div class="tablebx">  
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr class="tablebx_topbg">
                            <td>&nbsp;<?php echo "#";?>&nbsp;</td>
                            <td><?php echo Yii::t('app','Name');?></td>
                            <td><?php echo Yii::t('app','Block Order');?></td>
                            <td><?php echo Yii::t('app','Action');?></td>
                        </tr>
                    <?php 
                    $user_id    =   Yii::app()->user->id;
                    $criteria               =   new CDbCriteria;
                    $criteria->condition    =   'user_id=:user_id';
                    $criteria->params       =   array(':user_id'=>$user_id);
                    $model                  =   DashboardSettings::model()->findAll($criteria);

                    if($model!=NULL)
                    {
                        $i=1;
                        foreach ($model as $data){
                        ?>	
                            <tr class=<?php echo $cls;?> >
                            <td><?php echo $i; ?> </td>    
                            <td><?php echo $data->name->block; ?></td>	
                            <td><?php echo $data->block_order; ?></td>	
                            <td><?php 
                                if($data->is_visible=='1')
                                {
                                    echo CHtml::link(Yii::t('app','Disable'), array('/dashboard/settings/disable', 'id'=>$data->id),array('confirm'=>Yii::t('app','Are you sure you want to disable this block?')));
                                }
                                else
                                {
                                    echo CHtml::link(Yii::t('app','Enable'), array('/dashboard/settings/enable', 'id'=>$data->id),array('confirm'=>Yii::t('app','Are you sure you want to enable this block ?')));
                                }
                                ?>
                            </td>
                            </tr>
                            <?php 
                            if($cls=="even")
                            {
                                $cls="odd";
                            }
                            else
                            {
                                $cls="even";
                            }
                            $i++;
                        }
                    }
                    ?>
                    </table>
            </div>
        </div>
    </td>
</tr>
</table>