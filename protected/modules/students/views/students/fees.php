<?php
$this->breadcrumbs=array(
	Yii::t('app','Students')=>array('index'),
	Yii::t('app','Fees'),
);


?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top"><div class="emp_cont_left">
        <?php $this->renderPartial('profileleft');?>
      </div></td>
    <td valign="top"><div class="cont_right formWrapper"> 
        <!--<div class="searchbx_area">
    <div class="searchbx_cntnt">
    	<ul>
        <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
        <li><input class="textfieldcntnt"  name="" type="text" /></li>
        </ul>
    </div>
    
    </div>-->
        
        <h1 style="margin-top:.67em;"><?php echo Yii::t('app','Student Profile :').' ';?><?php echo $model->first_name.'&nbsp;'.$model->last_name; ?><br />
        </h1>
        <div class="edit_bttns last">
          <ul>
            <li> <?php echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('update', 'id'=>$model->id,'status'=>1),array('class'=>' edit ')); ?> </li>
            <li> <?php echo CHtml::link('<span>'.Yii::t('app','Students').'</span>', array('students/manage'),array('class'=>'edit last'));?> </li>
          </ul>
        </div>
        <div class="clear"></div>
        <div class="emp_right_contner">
        <div class="emp_tabwrapper">
            <?php $this->renderPartial('tab');?>
         <div class="clear"></div>
         <div class="emp_cntntbx"><div>
         <div class="formCon">
         <div class="formConInner">
          <h3><?php echo Yii::t('app','Pending Fees');?></h3>
          <div class="tableinnerlist">
           <?php 
				$res=FinanceFees::model()->findAll(array('condition'=>'student_id=:vwid AND is_paid=:vpid','params'=>array(':vwid'=>$_REQUEST['id'], ':vpid'=>0)));
				$currency=Configurations::model()->findByPk(5);
				$all_amount = 0;
				if(count($res)=='0')
				{
				 echo '<i>'.Yii::t('app','No Pending Fees').'</i>';	
				}
				else
				{
					
				?>
                <table width="95%" cellpadding="0" cellspacing="0">
                  <tr>
                     <th><?php echo Yii::t('app','Category Name');?></th>
                     <th><?php echo Yii::t('app','Collection Name');?></th>
                     <th><?php echo Yii::t('app','Last Date');?></th>
                     <th><?php echo Yii::t('app','Amount');?></th>
                     <th><?php echo Yii::t('app','Fees Paid');?></th>
                     <th><?php echo Yii::t('app','Balance');?></th>
                     <th><?php echo Yii::t('app','Payment');?></th>
                  </tr>
                  <?php
				  	$check_pending=1;
					foreach($res as $res_1)
					{
						$fees_flag=1;
						$posts = FinanceFeeCollections::model()->findByAttributes(array('id'=>$res_1->fee_collection_id));
						if($posts!=NULL)
						{
							$cat = FinanceFeeCategories::model()->findByAttributes(array('id'=>$posts->fee_category_id));
							$check_admission_no = FinanceFeeParticulars::model()->findAllByAttributes(array('finance_fee_category_id'=>$posts->fee_category_id,'admission_no'=>$model->admission_no));
							if(count($check_admission_no)==0){ 
								$check_student_category = FinanceFeeParticulars::model()->findAllByAttributes(
																		array('finance_fee_category_id'=>$posts->fee_category_id,'student_category_id'=>$model->student_category_id,'admission_no'=>''));
								if(count($check_student_category)==0){
								 //If no particular is present for this student or student category
									$check_all = FinanceFeeParticulars::model()->findAllByAttributes(array('finance_fee_category_id'=>$posts->fee_category_id,'student_category_id'=>NULL,'admission_no'=>''));
									if(count($check_all)==0){
									 // If no particular is found.
										$fees_flag=0;										
									}
								}
							}
						   if($fees_flag==1){
							  $check_pending=0;
						?>
							<tr>
							  <td><?php if(@$cat) echo $cat->name; ?></td>
							  <td><?php echo $posts->name; ?></td>
							  <td><?php 
						$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
						if($settings!=NULL)
						{	
							echo date($settings->displaydate,strtotime($posts->due_date));
							
						}
						else
						echo $posts->due_date; 
				?></td>
                          <td><?php
				$check_admission_no = FinanceFeeParticulars::model()->findAllByAttributes(array('finance_fee_category_id'=>$posts->fee_category_id,'admission_no'=>$model->admission_no));
				if(count($check_admission_no)>0){ // If any particular is present for this student
					$adm_amount = 0;
					foreach($check_admission_no as $adm_no){
						$adm_amount = $adm_amount + $adm_no->amount;
					}
					$fees = $adm_amount;
					//echo $adm_amount.' '.$currency->config_value;
					$balance = 	$adm_amount - $res_1->fees_paid;
				}
				else{ // If any particular is present for this student category
					$check_student_category = FinanceFeeParticulars::model()->findAllByAttributes(
																	array('finance_fee_category_id'=>$posts->fee_category_id,'student_category_id'=>$model->student_category_id,'admission_no'=>''));
					if(count($check_student_category)>0){
						$cat_amount = 0;
						foreach($check_student_category as $stu_cat){
							$cat_amount = $cat_amount + $stu_cat->amount;
						}
						$fees = $cat_amount;
						//echo $cat_amount.' '.$currency->config_value;
						$balance = 	$cat_amount - $res_1->fees_paid;				
					}
					else{ //If no particular is present for this student or student category
						$check_all = FinanceFeeParticulars::model()->findAllByAttributes(array('finance_fee_category_id'=>$posts->fee_category_id,'student_category_id'=>NULL,'admission_no'=>''));
						if(count($check_all)>0){
							
							foreach($check_all as $all){
								$all_amount = $all_amount + $all->amount;
							}
							$fees = $all_amount;
							//echo $all_amount.' '.$currency->config_value;
							$balance = 	$all_amount - $res_1->fees_paid;
						}
						else{
							echo '-'; // If no particular is found.
							
						}
					}
				}
				if($fees)	
					echo $fees.' '.$currency->config_value;
				else
					echo '-';
			 
			?></td>
              <td><?php
				if($res_1->is_paid == 0)
			 	{
					echo $res_1->fees_paid.' '.$currency->config_value;
				}
				else
				{
					echo $fees.' '.$currency->config_value; 
				}
				?></td>
                          <td><?php
				if($res_1->is_paid == 0)
			 	{	
             		echo $balance.' '.$currency->config_value;
				}
				else
				{
					echo '-';
				}
				?></td>
                <td><?php 
					    echo CHtml::link(Yii::t('app','Full'), array('payfees','std_id'=>$_REQUEST['id'],'id'=>$res_1->id,'fees' => $fees),array('confirm'=>Yii::t('app','Are you sure you want to pay full fees? '))); 
						echo ' | ';
						echo CHtml::ajaxLink(Yii::t('app','Partial'), Yii::app()->createUrl('fees/FinanceFees/Partialfees' ), array('type' =>'GET',
											'data' =>array( 'id' => $res_1->id ),'dataType' => 'text',  'update' =>'#partial'.$res_1->id, 
											'onclick'=>'$("#partialfees'.$res_1->id.'").dialog("open"); return false;',),array('class'=>'at_abs'));
						echo '<div  id="partial'.$res_1->id.'"></div>';
					
				?>
                </td>
                        </tr>
                        <?php 
			}
		}
	} if($check_pending==1){ ?><tr><td colspan="7"><center><?php echo Yii::t('app','No Pending Fees.'); ?></center></td></tr> <?php } ?>
                      </table>
                      <?php
	}
	?>
                    </div>
                    <!--tableinnerlist--> 
                    <br />
                    <h3><?php echo Yii::t('app','Paid Fees');?></h3>
                    <div class="tableinnerlist">
                      <table width="95%" cellpadding="0" cellspacing="0">
                        <tr>
                          <th><?php echo Yii::t('app','Category Name');?></th>
                          <th><?php echo Yii::t('app','Collection Name');?></th>
                          <th><?php echo Yii::t('app','Amount');?></th>
                          <th><?php echo Yii::t('app','Amount Paid');?></th>
                           <th><?php echo Yii::t('app','Balance');?></th>
                        </tr>
                        <?php 
	$res=FinanceFees::model()->findAll(array('condition'=>'student_id=:vwid AND is_paid=:vpid','params'=>array(':vwid'=>$_REQUEST['id'], ':vpid'=>1)));
	if(count($res)==0)
	{
	?>
                        <tr>
                          <td colspan="5"><?php echo Yii::t('app','No details of the fees paid available.');?></td>
                        </tr>
                        <?php
	}
	else
	{
		foreach($res as $res_1)
		{
			$amount = 0;
			$posts = FinanceFeeCollections::model()->findByAttributes(array('id'=>$res_1->fee_collection_id));
			$cat = FinanceFeeCategories::model()->findByAttributes(array('id'=>$posts->fee_category_id));
			/*$particular = FinanceFeeParticulars::model()->findAllByAttributes(array('finance_fee_category_id'=>$posts->fee_category_id));
			if($particular!=NULL)
			{
				foreach($particular as $particulars)
				{
					$amount = $amount+$particulars->amount;
				}
			}*/
			?>
                        <tr>
                          <td><?php if(@$cat) echo $cat->name ?></td>
                          <td><?php echo $posts->name ?></td>
                          <td><?php
					$check_admission_no = FinanceFeeParticulars::model()->findAllByAttributes(array('finance_fee_category_id'=>$posts->fee_category_id,'admission_no'=>$model->admission_no));
					if(count($check_admission_no)>0){ // If any particular is present for this student
						$adm_amount = 0;
						foreach($check_admission_no as $adm_no){
							$adm_amount = $adm_amount + $adm_no->amount;
						}
						echo $adm_amount.' '.$currency->config_value;	
					}
					else{ // If any particular is present for this student category
						$check_student_category = FinanceFeeParticulars::model()->findAllByAttributes(array('finance_fee_category_id'=>$posts->fee_category_id,'student_category_id'=>$model->student_category_id,'admission_no'=>''));
						if(count($check_student_category)>0){
							$cat_amount = 0;
							foreach($check_student_category as $stu_cat){
								$cat_amount = $cat_amount + $stu_cat->amount;
							}
							echo $cat_amount.' '.$currency->config_value;		
						}
						else{ //If no particular is present for this student or student category
							$check_all = FinanceFeeParticulars::model()->findAllByAttributes(array('finance_fee_category_id'=>$posts->fee_category_id,'student_category_id'=>NULL,'admission_no'=>''));
							if(count($check_all)>0){
								$all_amount = 0;
								foreach($check_all as $all){
									$all_amount = $all_amount + $all->amount;
								}
								echo $all_amount.' '.$currency->config_value;
							}
							else{
								echo '-'; // If no particular is found.
							}
						}
					}
					
				 
				?></td>
                <td>
                	<?php echo $res_1->fees_paid.' '.$currency->config_value;?>
                </td>
                <td>
                	<?php if($all_amount !=0 and $all_amount<$res_1->fees_paid)
					{
						$balance=$res_1->fees_paid-$all_amount;
						echo '<font color="#FF0000">'.$balance.' '.$currency->config_value.'</font>';
					}
					else
					{
						$balance=0;
						echo $balance.' '.$currency->config_value;
					}
					
					?>
                </td>
             </tr>
          <?php }
			}
		 ?>
        </table>
       </div> <br /> <!--tableinnerlist--> 
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
<div class="cont_right" style="background:#FFF"> </div></td>
</tr>
</table>
<script>
$('.at_abs').click(function(e) {
    $('form#partial-fees-form').remove();
});
</script>