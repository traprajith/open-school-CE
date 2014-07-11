<?php
$this->breadcrumbs=array(
	'Guardians'=>array('index'),
	$model->id,
);


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    	<td width="247" valign="top">
			<?php $this->renderPartial('/default/left_side');?>
             </td>
                <td valign="top">
                <div class="cont_right formWrapper">
                    <h1><?php echo Yii::t('report','Guardian Details');?></h1>
                    <?php
                    $guard=Guardians::model()->findByAttributes(array('id'=>$_REQUEST['id']));
                    $students = Students::model()->findAllByAttributes(array('parent_id'=>$guard->id));
                    ?>
                    <div class="pdtab_Con">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" >
                        <tr class="pdtab-h">
                            <td align="center"><?php echo Yii::t('report','Name');?></td>
                            <td align="center"><?php echo Yii::t('report','Student Name');?></td>
                            <td align="center"><?php echo Yii::t('report','Relation');?></td>
                            <td align="center"><?php echo Yii::t('report','Email');?></td>
                            <td align="center"><?php echo Yii::t('report','Office Phone');?></td>
                            <td align="center"><?php echo Yii::t('report','Address');?></td>
                        </tr>
                    
                        <tr>
                            <td align="center">
								<?php 
									if($guard->last_name!=NULL or $guard->first_name!=NULL)
										echo ucfirst($guard->last_name).' '.ucfirst($guard->first_name);
									else
										echo '-';
								?>
							</td>
                            <td align="center">
								<?php
									if($students!=NULL)
									{ 
										foreach($students as $student)
										{
											if($student->first_name!=NULL or $student->last_name!=NULL)
												echo ucfirst($student->first_name).' '.ucfirst($student->last_name).'<br/>';
											else
												echo '-';
										}
									}
									else
									{
										echo '-';
									}
								?>
							</td>
                            <td align="center">
								<?php 
									if($guard->relation!=NULL)
										echo ucfirst($guard->relation);
									else
										echo '-';
								?>
							</td>
                            <td align="center">
								<?php 
									if($guard->email!=NULL)
										echo $guard->email;
									else
										echo '-';
								?>
							</td>
                            <td align="center">
								<?php 
									if($guard->office_phone1!=NULL)
										echo $guard->office_phone1;
									else
										echo '-';
									?>
							</td>
                            <td style="text-align:left; padding-left:5px;">
								<?php 
									if($guard->office_address_line1!=NULL)
										echo ucfirst($guard->office_address_line1).'<br />';
									if($guard->office_address_line2!=NULL)
										echo ucfirst($guard->office_address_line2).'<br />';
									if($guard->city!=NULL)
										echo ucfirst($guard->city).'<br />';
									if($guard->state!=NULL)
										echo ucfirst($guard->state).'<br />';
									if($guard->country_id!=NULL)
										{
										$country = Countries::model()->findByAttributes(array('id'=>$guard->country_id));
										echo ucfirst($country->name).'<br />';
										}
									if($guard->office_address_line1 == NULL and $guard->office_address_line2==NULL and $guard->city==NULL and $guard->state==NULL and $guard->country_id==NULL)
										echo '-';
								?>
							</td>
                        </tr>
                
                    </table>
                    </div>
                </div>
    	</td>
	</tr>
</table>
