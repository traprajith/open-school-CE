<?php
$this->breadcrumbs=array(
	Yii::t('app','Guardians')=>array('admin'),
	Yii::t('app','Search'),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('app','Search Guardians');?></h1>

 <div >
                    <div class="clear"></div>
                    <?php 
                    if($model)
                    {
                    ?>
                    <div class="tablebx">  
                        <div class="pagecon">
							<?php 
                              $this->widget('CLinkPager', array(
                              'currentPage'=>$pages->getCurrentPage(),
                              'itemCount'=>$item_count,
                              'pageSize'=>$page_size,
                              'maxButtonCount'=>5,
                              //'nextPageLabel'=>'My text >',
                              'header'=>'',
                            'htmlOptions'=>array('class'=>'pages'),
                            ));?>
                        </div> <!-- End div class="pagecon" --> 
                                                              
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="tablebx_topbg">
                                <td><?php echo Yii::t('app','Sl. No.');?></td>
                                <?php if(FormFields::model()->isVisible("fullname", "Guardians", "forStudentProfile")){ ?>
                                <td><?php echo Yii::t('app','Guardian Name');?></td>     <?php } ?>                           
                                <td><?php echo Yii::t('app','Email');?></td>                                
                                 <td><?php echo Yii::t('app','Action');?></td>                                
                            </tr>
                            <?php 
                            if(isset($_REQUEST['page']))
                            {
                            	$i=($pages->pageSize*$_REQUEST['page'])-9;
                            }
                            else
                            {
                            	$i=1;
                            }
                            $cls="even";
                            ?>
                            
                            <?php 
                            foreach($model as $list)
                            {
                                ?>
                                <tr class=<?php echo $cls;?>>
                                <td><?php echo $i; ?></td>
                                <?php if(FormFields::model()->isVisible("fullname", "Guardians", "forStudentProfile")){ ?>
                                <td><?php echo CHtml::link($list->parentFullName('forStudentProfile'),array('view','id'=>$list->id)) ?></td>
                                <?php } ?>
                                <td><?php echo $list->email; ?></td>                                                                                               
                                <td> <?php 
                                echo CHtml::link(Yii::t('app','View'),array('view','id'=>$list->id));
                                echo " / ";
                                echo CHtml::link(Yii::t('app','Update'),array('update','id'=>$list->id));?>   </td>                                                               
                                </tr>
                                <?php
                                if($cls=="even")
                                {
                                	$cls="odd" ;
                                }
                                else
                                {
                                	$cls="even"; 
                                }
                                $i++;
                            } 
                            ?>
                        </table>
                        
                        <div class="pagecon">
                        <?php                                          
                          $this->widget('CLinkPager', array(
                          'currentPage'=>$pages->getCurrentPage(),
                          'itemCount'=>$item_count,
                          'pageSize'=>$page_size,
                          'maxButtonCount'=>5,                         
                          'header'=>'',
                            'htmlOptions'=>array('class'=>'pages'),
                        ));?>
                        </div> 
                        <div class="clear"></div>
                    </div>
                    <?php 
                    }
                    else
                    {
                    	echo '<div class="listhdg" align="center">'.Yii::t('app','Nothing Found!!').'</div>';	
                    }?>
                </div> 

    </div>
         </td>
  </tr>
</table>