<style>

.listbxtop_hdng
{
	font-size:15px;	
	/*color:#1a7701;*/
	/*text-shadow: 0.1em 0.1em #FFFFFF;*/
	/*font-weight:bold;*/
	text-align:left;
	
}
.table_listbx tr td, tr th {
border-left:1px solid #ccc;
border-top:1px solid #ccc;
border-right:1px solid #ccc;

}
td.listbx_subhdng
{
	color:#333333;
	font-size:13px;	
	font-weight:bold;
	width:33%;
		
}

.odd
{
	background:#DFDFDF;
}
td.subhdng_nrmal
{
	color:#333333;
	font-size:14px;
	width:450px;	
}
.table_listbx
{
	margin:0px;
	padding:0px;
	/*width:1061px;*/
	
}
.table_listbx td
{
	padding:10px 0px 10px 10px;
	margin:0px;
	
	
}
.table_listbxlast td
{
	border-bottom:none;
	
}


td.subhdng_nrmal
{
	color:#333333;
	font-size:12px;	
}
.last
{
	border-bottom:1px solid #ccc;
}
.first
{
	border:none;
}


</style>

<div class="atnd_Con" style="padding-left:20px; padding-top:30px;">
<?php
  if(isset($_REQUEST['id']))
  {
?>
	<!-- Header -->
	<div style="border-bottom:#666 1px; width:700px; padding-bottom:20px;">
        <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td class="first">
                           <?php $logo=Logo::model()->findAll();?>
                            <?php
                            if($logo!=NULL)
                            {
                                //Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
                                echo '<img src="uploadedfiles/school_logo/'.$logo[0]->photo_file_name.'" alt="'.$logo[0]->photo_file_name.'" class="imgbrder" width="100%" />';
                            }
                            ?>
                </td>
                <td align="center" valign="middle" class="first" style="width:300px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="listbxtop_hdng first" style="text-align:left; font-size:22px; width:300px;  padding-left:10px;">
                                <?php $college=Configurations::model()->findAll(); ?>
                                <?php echo $college[0]->config_value; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="listbxtop_hdng first" style="text-align:left; font-size:14px; padding-left:10px;">
                                <?php echo $college[1]->config_value; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="listbxtop_hdng first" style="text-align:left; font-size:14px; padding-left:10px;">
                                <?php echo 'Phone: '.$college[2]->config_value; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <!-- End Header -->
    <br /><br />
    <span align="center"><h4>STUDENT PROFILE</h4></span>
   
    <table class="table_listbx" width="100%" cellspacing="0" cellpadding="0">
      
        <tr class="listbxtop_hdng">
            <td class="listbx_subhdng"><?php echo Yii::t('students','Name');?></td>
            <td class="subhdng_nrmal"><?php echo $model->first_name.' '.$model->last_name; ?></td>    
        </tr>
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('students','Admission Number');?></td>
            <td class="subhdng_nrmal odd"><?php echo $model->admission_no; ?></td>
        </tr>
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('students','Admission Date');?></td>
            <td class="subhdng_nrmal"><?php 
                                            $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                                        if($settings!=NULL)
                                        {	
                                            $date1=date($settings->displaydate,strtotime($model->admission_date));
                                            echo $date1;
                
                                        }
                                        else
                                        echo $model->admission_date;
                                        ?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('students','Batch');?></td>
            <td class="subhdng_nrmal odd">
                <?php 
				$posts=Batches::model()->findByAttributes(array('id'=>$model->batch_id));
                if($posts!=NULL){
					echo $posts->name; 
				}
				else{
					echo '-';
				}
				?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('students','Course');?> </td>
            <td class="subhdng_nrmal"><?php echo $posts->course123->course_name; ?></td>
        </tr>
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('students','Date of Birth');?></td>
            <td class="subhdng_nrmal odd">
				<?php 
						if($model->date_of_birth!=NULL)
						{
							if($settings!=NULL)
							{	
								$date1=date($settings->displaydate,strtotime($model->date_of_birth));
								echo $date1;
			
							}
							else
							echo $model->date_of_birth;  
						}
						else
						{
							echo '-';	
						}
						?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('students','Blood Group');?></td>
            <td class="subhdng_nrmal">
                <?php 
					if($model->blood_group!=NULL)
					{
						echo $model->blood_group;
					}
					else
					{
						echo '-';
					}
                ?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('students','Gender');?>  </td>
            <td class="subhdng_nrmal odd">
                <?php if($model->gender=='M')
                        echo 'Male';
                    else if($model->gender=='F')
                        echo 'Female';
                    else
                        echo '-'; ?>
            </td>
        
        </tr>
        
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('students','Nationality');?>  </td>
            <td class="subhdng_nrmal">
                <?php 
				if($model->nationality_id!=NULL)
				{
					$natio_id=Countries::model()->findByAttributes(array('id'=>$model->nationality_id));
					echo $natio_id->name; 
				}
				else{
					echo '-';
				}?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('students','Language');?></td>
            <td class="subhdng_nrmal odd">
				<?php 
				if($model->language!=NULL)
				{
					echo $model->language;
				}
				else{
					echo '-';
				}
				?>
			</td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('students','Category');?></td>
            <td class="subhdng_nrmal">
                <?php 
				if($model->student_category_id!=NULL)
				{
					$cat =StudentCategories::model()->findByAttributes(array('id'=>$model->student_category_id));
					if($cat!=null)
					{ 
						echo $cat->name;  
					}
				}
				else{
					echo '-';
				}
				?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('students','Religion');?></td>
            <td class="subhdng_nrmal odd">
				<?php 
				if($model->religion!=NULL)
				{
					echo $model->religion; 
				}
				else
				{
					echo '-';
				}
				?>
			</td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('students','Address');?></td>
            <td class="subhdng_nrmal">
				<?php 
				if($model->address_line1!=NULL or $model->address_line2!=NULL)
				{
					echo $model->address_line1.'<br/><br/>'. $model->address_line2; 
				}
				else
				{
					echo '-';
				}
				?>
			</td>
        </tr>
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('students','City');?></td>
            <td class="subhdng_nrmal odd">
				<?php 
				if($model->city!=NULL)
				{
					echo $model->city; 
				}
				else
				{
					echo '-';
				}
				?>
			</td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng "><?php echo Yii::t('students','State');?></td>
            <td class="subhdng_nrmal ">
				<?php 
				if($model->state!=NULL)
				{
					echo $model->state; 
				}
				else
				{
					echo '-';
				}
				?>
			</td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('students','Country');?></td>
            <td class="subhdng_nrmal odd" >
                <?php
				if($model->country_id!=NULL)
				{
					$posts=Countries::model()->findByAttributes(array('id'=>$model->country_id));
					echo $posts->name; 
				}
				else
				{
					echo '-';
				}?>
             </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng "><?php echo Yii::t('students','Phone 1');?></td>
            <td class="subhdng_nrmal ">
				<?php 
				if($model->phone1!=NULL)
				{
					echo $model->phone1;
				}
				else
				{
					echo '-';
				}?>
			</td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('students','Phone 2');?></td>
            <td class="subhdng_nrmal odd">
				<?php 
				if($model->phone2!=NULL)
				{
					echo $model->phone2;
				}
				else
				{
					echo '-';
				}?>
			</td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng "><?php echo Yii::t('students','Email');?></td>
            <td class="subhdng_nrmal ">
				<?php 
				if($model->email!=NULL)
				{
					echo $model->email;
				}
				else
				{
					echo '-';
				}?>
			</td>
        </tr>
        
        <?php /*?><tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('students','Group tutor');?></td>
            <td class="subhdng_nrmal odd">&nbsp;</td>
        </tr><?php */?>
        
        <tr>
            <td class="listbx_subhdng last"><?php echo Yii::t('students','Immediate Contact');?></td>
            <td class="subhdng_nrmal last">
				<?php 
				$parent = Guardians::model()->findByAttributes(array('ward_id'=>$model->id));
				if($parent!=NULL)
				{
					echo $parent->first_name.' '.$parent->last_name.' ('.$parent->relation.')';
					echo '<br/><br/>'.$parent->mobile_phone;
					echo '<br/><br/>'.$parent->email;
				}
				else
				{
					echo '-';
				}
				?>
            </td>
        </tr>
    
    </table>
<?php
  }
?>
</div>