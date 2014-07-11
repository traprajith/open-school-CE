<?php
$this->breadcrumbs=array(
	'Students'=>array('index'),
	'Fees',
);


?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    <div class="emp_cont_left">
    <?php $this->renderPartial('profileleft');?>
    
    </div>
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
    <!--<div class="searchbx_area">
    <div class="searchbx_cntnt">
    	<ul>
        <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
        <li><input class="textfieldcntnt"  name="" type="text" /></li>
        </ul>
    </div>
    
    </div>-->
    
    <h1 style="margin-top:.67em;"><?php echo Yii::t('students','Student Profile : ');?><?php echo $model->first_name.'&nbsp;'.$model->last_name; ?><br /></h1>
        
    <div class="edit_bttns last">
    <ul>
    <li>
    <?php echo CHtml::link(Yii::t('students','<span>Edit</span>'), array('update', 'id'=>$model->id),array('class'=>' edit ')); ?>
    </li>
     <li>
    <?php echo CHtml::link(Yii::t('students','<span>Students</span>'), array('students/manage'),array('class'=>'edit last'));?>
    </li>
    </ul>
    </div>
    
    
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
     <?php $this->renderPartial('tab');?>
    <div class="clear"></div>
    <div class="emp_cntntbx">
    <div>
     <div class="formCon">
    <div class="formConInner">
    <h3><?php echo Yii::t('students','Pending Fees');?></h3>
    <div class="tableinnerlist"> 
        
    <?php 
	$res=FinanceFees::model()->findAll(array('condition'=>'student_id=:vwid AND is_paid=:vpid','params'=>array(':vwid'=>$_REQUEST['id'], ':vpid'=>0)));
	$currency=Configurations::model()->findByPk(5);

	if(count($res)=='0')
	{
	 echo Yii::t('students','<i>No Pending Fees</i>');	
	}
	else
	{
		
	?>
    <table width="95%" cellpadding="0" cellspacing="0">
        <tr>
          <th><?php echo Yii::t('students','Category Name');?></th>
          <th><?php echo Yii::t('students','Collection Name');?></th>
          <th><?php echo Yii::t('students','Last Date');?></th>
           <th><?php echo Yii::t('students','Amount');?></th>
             <th><?php echo Yii::t('students','Action');?></th>
        </tr> 
     
    <?php
	foreach($res as $res_1)
	{
		$posts = FinanceFeeCollections::model()->findByAttributes(array('id'=>$res_1->fee_collection_id));
		$cat = FinanceFeeCategories::model()->findByAttributes(array('id'=>$posts->fee_category_id));

		?>

        <tr>
          <td><?php if(@$cat) echo $cat->name; ?></td>
           <td><?php echo $posts->name; ?></td>
		   <td>
		   		<?php 
					$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
					if($settings!=NULL)
					{	
						echo date($settings->displaydate,strtotime($posts->due_date));
						
					}
					else
					echo $posts->due_date; 
				?>
			</td>
            <td>
				<?php
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
				
			 
			?>
			</td>
            <td> <?php echo CHtml::link(Yii::t('students','Pay Now'), array('payfees', 'id'=>$res_1->id)); ?></td>
        </tr>
      
        <?php 
		
	}
	echo '</table>';
	}?> 
        
       </div><br /> 
        <h3><?php echo Yii::t('students','Paid Fees');?></h3>
          <div class="tableinnerlist"> 
        <table width="95%" cellpadding="0" cellspacing="0">
        <tr>
          <th><?php echo Yii::t('students','Category Name');?></th>
          <th><?php echo Yii::t('students','Collection Name');?></th>
           <th><?php echo Yii::t('students','Amount');?></th>
             
        </tr>
         <?php 
	$res=FinanceFees::model()->findAll(array('condition'=>'student_id=:vwid AND is_paid=:vpid','params'=>array(':vwid'=>$_REQUEST['id'], ':vpid'=>1)));
	if(count($res)==0)
	{
	?>
    	<tr>
          <td colspan="3"><?php echo Yii::t('students','No details of the fees paid available.');?></td>             
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
				<td>
					<?php
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
					
				 
				?>
				</td>
				
			</tr>
		   
			<?php }
	}
		 ?>
     </table>
        </div><br />
</div>
  </div>
    </div>
    </div>
    </div>
    
    </div>
    </div>
    <div class="cont_right" style="background:#FFF">

	</div>
    </td>
  </tr>
</table>