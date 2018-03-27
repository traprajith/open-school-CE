	
<style>
.drop select { width:159px;}

.bttns_addstudent{
	top:0px;
	left:98px;
}
</style>


<?php
$this->breadcrumbs=array(
	Yii::t('app','Students')=>array('index'),
	Yii::t('app','Manage'),
);


?>

<script language="javascript">
function details(id)
{
	
	var rr= document.getElementById("dropwin"+id).style.display;
	
	 if(document.getElementById("dropwin"+id).style.display=="block")
	 {
		 document.getElementById("dropwin"+id).style.display="none"; 
	 }
	 if(  document.getElementById("dropwin"+id).style.display=="none")
	 {
		 document.getElementById("dropwin"+id).style.display="block"; 
	 }
	 //return false;
	

}
</script>

<script language="javascript">
function hide(id)
{
	$(".drop_search").hide();
	$('#'+id).toggle();	
}
</script>

<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<body>
<?php
$co = $_REQUEST['cid']; 
//echo $co;exit; 
$users = array("admin","student","parent","teacher");
$subdomain = explode('.com' , $_SERVER['SERVER_NAME']);

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('/default/left_side');?>
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Manage Students');?></h1>
                
                 
                <!-- Save Filter, Load Filter, Clear All -->
                <div class="search_btnbx">
                    <!--<div class="listsearchbx">
                    <ul>
                    <li><input class="listsearchbar listsearchtxt" name="" type="text" onblur="clearText(this)" onfocus="clearText(this)" value="Search for Contacts"  /></li>
                    <li><input src="images/list_searchbtn.png" name="" type="image" /></li>
                    </ul>
                    </div>-->
                    <?php $j=0; ?>
                    <div id="jobDialog"></div>

                    <div class="button-bg">
                    <div class="top-hed-btn-right">
                    <ul>                                    
                    <li><?php echo CHtml::ajaxLink('<span>'.Yii::t('app','Save Filter').'</span>',$this->createUrl('Savedsearches/Create'),array(
                    'onclick'=>'$("#jobDialog").dialog("open"); return false;',
                    'update'=>'#jobDialog',
                    'type' =>'GET','data' => array( 'val1' => Yii::app()->request->getUrl(),'type'=>'1' ),'dataType' => 'text',
                    ),array('id'=>'showJobDialog','class'=>'a_tag-btn')); ?></li>
                    <li><a href="javascript:void(0);" class="load_filter a_tag-btn" onClick="hide('osload')"><span>
                    <?php echo Yii::t('app','Load Filter');?></span></a> </li>  
                    <li> <?php echo CHtml::link('<span>'.Yii::t('app','Clear All').'</span>', array('manage'),array('class'=>'a_tag-btn')); ?></li>                                 
                    </ul>
                    </div> 
                    <div class="top-hed-btn-left">
                    
                    </div>
                    
                    </div>
                    
                    
           <div id="osload" style="display:none; background:#fff; left:399px; top:0px" class="drop">
                                    <div class="droparrow"></div>
                                    <ul class="loaddrop-new"> 
                                        <li >
                                        
                                            <?php $data=Savedsearches::model()->findAllByAttributes(array('user_id'=>Yii::app()->User->id,'type'=>'1'));
                                            if($data!=NULL)
                                            {
                                                foreach ($data as $data1)
                                                {
													echo '<div class="filter-block">';
													echo '<span style="width:160px; float:left; ">'; echo CHtml::link($data1->name, CHtml::decode($data1->url),array('class'=>'vtip')); echo '</span>';
													echo '<label class="cross-icon">'; 
													echo CHtml::link('<img src="images/cross.png" border="0" />',array('/savedsearches/deletestudent','user_id'=>Yii::app()->User->id,'sid'=>$data1->id),
																 array('confirm'=>Yii::t('app','Are you sure you want to delete this?')));echo '</label>';
													echo '</div>';			 
                                                }
                                            }
                                            else
                                            {
                                                echo '<span style="color:#d30707;"><i>'.Yii::t('app','No Saved Searches').'</i></span>';
                                            }
                                            ?>
                                        </li>
                                    </ul>
                                </div> <!-- END div id="load" --> 
                    <div class="bttns_imprtcntact">
                        <ul>
                        	<?php /*?> <li><a class=" import_contact last" href=""><?php echo Yii::t('app','Import Contact');?></a></li><?php */?>
                        </ul>
                    </div> <!-- END div class="bttns_imprtcntact" -->
                    
                     <!-- END div class="bttns_addstudent" -->
                    
                </div> <!-- END div class="search_btnbx" -->
                
                <!-- END Save Filter, Load Filter, Clear All -->
                
                <div class="clear"></div>
                
                <!-- Filters Box -->
			<?php $form=$this->beginWidget('CActiveForm', array(
                'method'=>'get',
				'action'=>Yii::app()->createUrl("/students/students/manage")
            )); ?>
                <div class="filtercontner">
                    <div class="filterbxcntnt">
                    	<!-- Filter List -->
                       <div class="filterbxcntnt_inner">
                        <p><?php echo Yii::t('app','Filter Your Students');?></p>
                        </div>
					<div class="filter_ul filterbxcntnt-new">
                                    <ul>
                                    <li class="Text_area_Box-two">
                                        <?php
                                        if(Yii::app()->user->year)
                                        {
                                                $year = Yii::app()->user->year;
                                        }
                                        else
                                        {
                                                $current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
                                                $year = $current_academic_yr->config_value;
                                        }
                                        $data = CHtml::listData(Courses::model()->findAllByAttributes(array('is_deleted'=>0,'academic_yr_id'=>$year),array('order'=>'course_name ASC')),'id','course_name');
                                        //$data = CHtml::listData(Courses::model()->findAll('is_deleted=:x AND academic_yr_id=:y',array(':x'=>'0',':y'=>$year),array('order'=>'course_name DESC')),'id','course_name');                                                                                
                                        $data1 = CHtml::listData(Batches::model()->findAllByAttributes(array('is_active'=>1,'is_deleted'=>0,'academic_yr_id'=>$year),array('order'=>'name ASC')),'id','name');                                        
                                        //$data1 = CHtml::listData(Batches::model()->findAll('is_active=:x AND is_deleted=:y AND academic_yr_id=:z',array(':x'=>'1',':y'=>0,':z'=>$year),array('order'=>'name DESC')),'id','name'); 
										     
									if(isset($_REQUEST['Students']['batch_id']) && $_REQUEST['Students']['batch_id']!=""){         
										$cid= (isset($_REQUEST['cid']) && $_REQUEST['cid']!="")?$_REQUEST['cid']:"";   
									}
                                                echo CHtml::dropDownList('cid',$cid,$data,
                                                        array('prompt'=>Yii::t('app','Select Course'),
                                                                'ajax' => array(
                                                                'type'=>'POST',
                                                                'url'=>CController::createUrl('Students/batch'),
                                                                'update'=>'#batch_id',
                                                                'data'=>array('cid'=>'js:this.value',Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken)
                                                ))); 
                                        ?>                                   
                                    </li>
                                    <li class="Text_area_Box-two">
                                    <?php
                                            $batch_label = Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");
											$model->batch_id =(isset($_REQUEST['Students']['batch_id']) && $_REQUEST['Students']['batch_id']!="")?$_REQUEST['Students']['batch_id']:"";         
                                            echo CHtml::activeDropDownList($model,'batch_id',$data1,array('prompt'=>Yii::t('app','Select')." ".$batch_label,'id'=>'batch_id'));
                                    ?>
                                    </li>
                                    <li class="Btn_area_Box "><input type="submit" value="Apply"></li>
                                    </ul>
                                    </div>
                          <div class="filterbxcntnt_inner" style="border-bottom:#ddd solid 1px;">
                            <ul>

                                <li>
                                    <div onClick="hide('name')" style="cursor:pointer;"><?php echo Yii::t('app','Name');?></div>
                                    <div id="name" style="display:none; width:230px;" class="drop_search" >
                                        <div class="droparrow" style="left:10px;"></div>
										<div class="filter_ul">
                                        	<ul>
                                            	<li class="Text_area_Box"> <input type="search" placeholder="<?php echo Yii::t('app','search'); ?>" name="name" value="<?php echo isset($_GET['name']) ? CHtml::encode($_GET['name']) : '' ; ?>" /></li>
                                            	<li class="Btn_area_Box">  <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" /></li>
                                            </ul>
                                        </div>
                                       
                                    </div>
                                </li>
                                <!-- End Name Filter -->
                                
                                
                                 <!-- Roll Number Filter -->
                                <li>
                                    <div onClick="hide('rollnumber')" style="cursor:pointer;"><?php echo Yii::t('app','Roll Number');?></div>
                                    <div id="rollnumber" style="display:none;width:230px;" class="drop_search">
                                        <div class="droparrow" style="left:10px;"></div>
										<div class="filter_ul">
                                        	<ul>
                                        <li class="Text_area_Box"><input type="search" placeholder="<?php echo Yii::t('app','search'); ?>" name="rollnumber" value="<?php echo isset($_GET['rollnumber']) ? CHtml::encode($_GET['rollnumber']) : '' ; ?>" /></li>
                                        <li class="Btn_area_Box"><input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" /></li>
                                        </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Roll Number Filter -->
                                <!-- Admission Number Filter -->
                                <li>
                                    <div onClick="hide('admissionnumber')" style="cursor:pointer;"><?php echo Yii::t('app','Admission number');?></div>
                                    <div id="admissionnumber" style="display:none;width:230px;" class="drop_search">
                                        <div class="droparrow" style="left:10px;"></div>
										<div class="filter_ul">
                                        	<ul>
                                        <li class="Text_area_Box"><input type="search" placeholder="<?php echo Yii::t('app','search'); ?>" name="admissionnumber" value="<?php echo isset($_GET['admissionnumber']) ? CHtml::encode($_GET['admissionnumber']) : '' ; ?>" /></li>
                                        <li class="Btn_area_Box"><input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" /></li>
                                        </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Admission Number Filter -->
                                
                                <!-- Batch Filter -->
<!--                                <li>
                                    <div onClick="hide('batch')" style="cursor:pointer;"><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?></div>
                                    <div id="batch" style="display:none; color:#000; width:420px; left:-44px;" class="drop_search">
                                        <div class="droparrow" style="left:56px;"></div>
                                        <?php
										if(Yii::app()->user->year)
										{
											$year = Yii::app()->user->year;
										}
										else
										{
											$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
											$year = $current_academic_yr->config_value;
										}
                                        $data = CHtml::listData(Courses::model()->findAll('is_deleted=:x AND academic_yr_id=:y',array(':x'=>'0',':y'=>$year),array('order'=>'course_name DESC')),'id','course_name');                                                                                
                                        $data1 = CHtml::listData(Batches::model()->findAll('is_active=:x AND is_deleted=:y AND academic_yr_id=:z',array(':x'=>'1',':y'=>0,':z'=>$year),array('order'=>'name DESC')),'id','name'); 
										?>                                        
                                        <div class="filter_ul">
                                        	<ul>
                                                <li class="Text_area_Box-two">
                                                	<label><?php echo Yii::t('app','Course'); ?></label>
														<?php
														echo CHtml::dropDownList('cid','',$data,
															array('prompt'=>Yii::t('app','Select'),
																'ajax' => array(
																'type'=>'POST',
																'url'=>CController::createUrl('Students/batch'),
																'update'=>'#batch_id',
																'data'=>array('cid'=>'js:this.value',Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken),'options' => array($cid=>array('selected'=>true))
														)));
														 
													?>
                                                </li>
                                                <li class="Text_area_Box-two">
                                                	<label><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"); ?></label>
													<?php	
														echo CHtml::activeDropDownList($model,'batch_id',$data1,array('prompt'=>Yii::t('app','Select'),'id'=>'batch_id'));
													?>
                                                </li>
                                              
                                                <li class="Btn_area_Box "><input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" /></li>
                                            </ul>
                                        </div>                                                                                
                                    </div>
                                </li>-->
                                <!-- END Batch Filter -->
                                
                                <!-- Gender Filter -->
                                <li>
                                    <div onClick="hide('gender')" style="cursor:pointer;"><?php echo Yii::t('app','Gender');?></div>
                                    <div id="gender" style="display:none; width:230px;" class="drop_search">
                                        <div class="droparrow" style="left:10px;"></div>
										<div class="filter_ul">
                                        	<ul>
                                                <li class="Text_area_Box"> <?php  echo CHtml::activeDropDownList($model,'gender',array('M' => Yii::t('app','Male'), 'F' => Yii::t('app','Female')),array('prompt'=>Yii::t('app','All'))); ?></li>
                                                <li class="Btn_area_Box"><input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" /></li>
                                        	</ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Gender Filter -->
                                
                                <!-- Blood Group Filter -->
                                <li>
                                    <div onClick="hide('bloodgroup')" style="cursor:pointer;"><?php echo Yii::t('app','Blood Group');?></div>
                                    <div id="bloodgroup" style="display:none;width:230px;" class="drop_search" >
                                        <div class="droparrow" style="left:10px;"></div>
										<div class="filter_ul">
                                            <ul>
                                            <li class="Text_area_Box"> <?php echo CHtml::activeDropDownList($model,'blood_group',
												array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-'),
												array('prompt' => Yii::t('app','Select'))); ?></li>
                                            <li class="Btn_area_Box"><input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" /></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- END Blood Group Filter -->
                                
                                <!-- Nationality Filter -->
                                <li>
                                    <div onClick="hide('nationality')" style="cursor:pointer;"><?php echo Yii::t('app','Country');?></div>
                                    <div id="nationality" style="display:none;width:230px; padding-top:0px; left:-180px; " class="drop_search">
                                        <div class="droparrow" style="left:200px;"></div>
                                        <div class="filter_ul">
                                            <ul>
                                                <li class="Text_area_Box">
                                                	<?php echo CHtml::activeDropDownList($model,'country_id',CHtml::listData(Countries::model()->findAll(),'id','name'),array('prompt'=>Yii::t('app','Select'))); ?>
                                                </li>
                                            	<li class="Btn_area_Box"> <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" /></li>
                                            </ul>
                                      </div>
                                    </div>
                                </li>
                                <!-- END Nationality Filter -->
                                
                                <!-- Date of Birth Filter -->
                                <?php
                                $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                                if($settings!=NULL)
                                {
                                    $date=$settings->dateformat;
                                }
                                else
                                    $date = 'dd-mm-yy';	
                                ?>
                                <li>
                                    <div onClick="hide('dob')" style="cursor:pointer;"><?php echo Yii::t('app','Date Of Birth');?></div>
                                    <div id="dob" style="display:none; width:420px; left:-283px;" class="drop_search">
                                        <div class="droparrow" style=" left:313px"></div>
                                        <div class="filter_ul">
                                            <ul>
                                                <li class="Text_area_Box-two">
                                                	 <?php echo CHtml::activeDropDownList($model,'dobrange',array('1' => Yii::t('app','less than'), '2' => Yii::t('app','equal to'), '3' => Yii::t('app','greater than')),array('prompt'=>Yii::t('app','Option'))); ?>                           
                                                </li>
                                            	<li class="Text_area_Box-two">
													<?php 
                                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                        'name'=>'Students[date_of_birth]',
                                                        'model'=>$model,
                                                        'value'=>$model->date_of_birth,
                                                        
                                                        'options'=>array(
                                                        'showAnim'=>'fold',
                                                        'dateFormat'=>$date,
                                                        'changeMonth'=> true,
                                                        'changeYear'=>true,
                                                        'yearRange'=>'1900:'
                                                        ),
                                                        'htmlOptions'=>array(
                                                        'id' => 'dobtxt',
                                                        'readonly'=>true
                                                        ),
                                                    ));
                                                    ?>
                                                </li>
                                                <li class="Btn_area_Box"><input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" /></li>
                                                
                                                
                                            </ul>
                                      </div>
                                        
                                    </div>
                                </li>
                                <!-- END Date of Birth Filter -->
                                
                                <!-- Admission Date Filter -->
                                <li>
                                    <div onClick="hide('admission')" style="cursor:pointer;"><?php echo Yii::t('app','Admission Date');?></div>
                                    <div id="admission" style="display:none;width:420px; left:-190px;" class="drop_search">
                                        <div class="droparrow" style=" left:200px"></div>
										<div class="filter_ul">
                                            <ul>
                                                <li class="Text_area_Box-two"> 
                                                	<?php echo CHtml::activeDropDownList($model,'admissionrange',array('1' => Yii::t('app','less than'), '2' => Yii::t('app','equal to'), '3' => Yii::t('app','greater than')),array('prompt'=>Yii::t('app','Option'))); ?>
                                                </li>
                                                <li class="Text_area_Box-two">
													<?php 
														$this->widget('zii.widgets.jui.CJuiDatePicker', array(
														'name'=>'Students[admission_date]',
														'model'=>$model,
														'value'=>$model->admission_date,
														
														'options'=>array(
														'showAnim'=>'fold',
														'dateFormat'=>$date,
														'changeMonth'=> true,
														'changeYear'=>true,
														'yearRange'=>'1900:'
														),
														'htmlOptions'=>array(
														'id'=>'admdatetxt'
														),
														));
                                                    ?>
                                                </li>
                                                <li class="Btn_area_Box">
                                                    <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
                                                </li>
                                                
                                            </ul>
                                         </div>
                                    </div>
                                </li>
                                 <!-- END Admission Date Filter -->
                                 
                                <!-- Status Filter -->
                                <li>
								
								  
                                <div onClick="hide('status')" style="cursor:pointer;"><?php echo Yii::t('app','Status');?></div>
                                    <div id="status" style="display:none; width:230px;  left:-120px; " class="drop_search">
                                    <div class="droparrow"  style="left:140px"></div>
                                        <div class="filter_ul">
                                            <ul>
                                                <li class="Text_area_Box">
													<?php 
                                                    echo CHtml::activeDropDownList($model,'status',array('all'=>Yii::t('app','All'), '1' => Yii::t('app','Active'), '0' => Yii::t('app','Inactive')),array('selected'=>'selected','prompt'=>Yii::t('app','Select Status'))); 
                                                    ?>
                                                </li>
                                                <li class="Btn_area_Box">
                                                	<input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- END Status Filter -->   
                                <!-- Academic Status Filter -->
                                <li>
                                <div onClick="hide('academic_yr')" style="cursor:pointer;"><?php echo Yii::t('app','Academic Status');?></div>
                                    <div id="academic_yr" style="display:none; width:230px; left:-120px;" class="drop_search">
                                    <div class="droparrow"  style="left:140px"></div>
                                        <div class="filter_ul">
                                            <ul>
                                                <li class="Text_area_Box">
													<?php 
                                                    echo CHtml::activeDropDownList($model,'academic_yr',array('in'=>Yii::t('app','In Progress')),array('selected'=>'selected','prompt'=>Yii::t('app','All'))); 
                                               	 ?>
                                                </li>
                                            <li class="Btn_area_Box">
                                            	<input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- END Academic Status Filter -->                               
                            </ul>
                            <div class="clearfix"></div>
                                    
                                    
                            <div class="clear"></div>
                        </div> <!-- END div class="filterbxcntnt_inner" -->
                        <!-- END Filter List -->
                        
                        <div class="clear"></div>
                        
                        <!-- Active Filter List -->
                        <div class="filterbxcntnt_inner_bot">
                            <div class="filterbxcntnt_left"><strong><?php echo Yii::t('app','Active Filters:');?></strong></div>
                            <div class="clear"></div>
                            <div class="filterbxcntnt_right">
                                <ul>
                                	
                                    <!-- Name Active Filter -->
									<?php 
									if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL)
                                    {
                                    	$j++; 
									?>
                                    	<li><?php echo Yii::t('app','Name'); ?> : <?php echo $_REQUEST['name']?><a href="<?php echo Yii::app()->request->getUrl().'&name='?>"></a></li>
                                    <?php 
									}
									?>
                                    <!-- END Name Active Filter -->
                                    
                                    
                                     <!-- Roll Number Active Filter -->
                                    <?php 
									if(isset($_REQUEST['rollnumber']) and $_REQUEST['rollnumber']!=NULL)
                                    { 
                                    	$j++; 
									?>
                                    	<li><?php echo Yii::t('app','Roll number'); ?> : <?php echo $_REQUEST['rollnumber']?><a href="<?php echo Yii::app()->request->getUrl().'&rollnumber='?>"></a></li>								
									<?php 
									}
									?>
                                     <!-- END Roll Number Active Filter -->
                                    <!-- Admission Number Active Filter -->
                                    <?php 
									if(isset($_REQUEST['admissionnumber']) and $_REQUEST['admissionnumber']!=NULL)
                                    { 
                                    	$j++; 
									?>
                                    	<li><?php echo Yii::t('app','Admission number'); ?> : <?php echo $_REQUEST['admissionnumber']?><a href="<?php echo Yii::app()->request->getUrl().'&admissionnumber='?>"></a></li>								
									<?php 
									}
									?>
                                     <!-- END Admission Number Active Filter -->
                                     
                                     
                                    <!-- Batch Active Filter -->
                                    <?php 
									if(isset($_REQUEST['cid']) and $_REQUEST['cid']!=NULL and isset($_REQUEST['Students']['batch_id']) and $_REQUEST['Students']['batch_id']!=NULL and $_REQUEST['Students']['batch_id']!=0)
                                    { 
                                    	$j++;
                                    ?>
                                    	<li><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"); ?> : <?php echo Batches::model()->findByAttributes(array('id'=>$_REQUEST['Students']['batch_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Students[batch_id]='?>"></a></li>
                                    <?php 
									}
									?>
                                    <!-- END Batch Active Filter -->
                                    
                                    
                                    <!-- Gender Active Filter -->
                                    <?php 
									if(isset($_REQUEST['Students']['gender']) and $_REQUEST['Students']['gender']!=NULL)
                                    { 
										$j++;
										if($_REQUEST['Students']['gender']=='M')
										$gen=Yii::t('app','Male');
										else
										$gen=Yii::t('app','Female');
                                    ?>
                                    	<li><?php echo Yii::t('app','Gender'); ?> : <?php echo $gen?><a href="<?php echo Yii::app()->request->getUrl().'&Students[gender]='?>"></a></li>
                                    <?php 
									}
									?>
                                    <!-- END Gender Active Filter -->
                                    
                                    
                                    <!-- Blood Group Active Filter -->
                                    <?php 
									if(isset($_REQUEST['Students']['blood_group']) and $_REQUEST['Students']['blood_group']!=NULL)
                                    { 
                                    	$j++; 
									?>
                                    	<li><?php echo Yii::t('app','Blood Group'); ?> : <?php echo $_REQUEST['Students']['blood_group']?><a href="<?php echo Yii::app()->request->getUrl().'&Students[blood_group]='?>"></a></li>
                                    <?php 
									}
									?>
                                    <!-- END Blood Group Active Filter -->
                                    
                                    <!-- Nationality Active Filter -->
                                    <?php  if(isset($_REQUEST['Students']['country_id']) and $_REQUEST['Students']['country_id']!=NULL)
                                    {
                                    	$j++; 
									?>
                                    	<li><?php echo Yii::t('app','Country'); ?> : <?php echo Countries::model()->findByAttributes(array('id'=>$_REQUEST['Students']['country_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Students[country_id]='?>"></a></li>
                                    <?php 
									}
									?>
                                    <!-- END Nationality Active Filter -->
                                    
                                    
                                    <!-- Date of Birth Active Filter -->
                                    <?php 
                                    if(isset($_REQUEST['Students']['dobrange']) and $_REQUEST['Students']['dobrange']!=NULL)
                                    {
										if(isset($_REQUEST['Students']['date_of_birth']) and $_REQUEST['Students']['date_of_birth']!=NULL)
										{ 
											$j++;
                            if($_REQUEST['Students']['dobrange']=='1')
                            {
                                    $range = Yii::t('app','less than');
                            }
                            if($_REQUEST['Students']['dobrange']=='2')
                            {
                                    $range = Yii::t('app','equal to');
                            }
                            if($_REQUEST['Students']['dobrange']=='3')
                            {
                                    $range = Yii::t('app','greater than');
                            }?>
											<li><?php echo Yii::t('app','Date Of Birth'); ?> : <?php echo $range.' : '.$_REQUEST['Students']['date_of_birth']?><a href="<?php echo Yii::app()->request->getUrl().'&Students[date_of_birth]='?>"></a></li>
											<?php 
										}
									} 
                                    elseif(isset($_REQUEST['Students']['dobrange']) and $_REQUEST['Students']['dobrange']==NULL)
                                    { 
										if(isset($_REQUEST['Students']['date_of_birth']) and $_REQUEST['Students']['date_of_birth']!=NULL)
										{ 
											$j++;
											$range = Yii::t('app','equal to');  
											?>
											<li><?php echo Yii::t('app','Date Of Birth'); ?> : <?php echo $range.' : '.$_REQUEST['Students']['date_of_birth']?><a href="<?php echo Yii::app()->request->getUrl().'&Students[date_of_birth]='?>"></a></li>
										<?php 
										}
									}
									?>
                                    <!-- END Date of Birth Active Filter -->
                                    
                                    
                                    <!-- Admission Date Active Filter -->
                                    <?php 
                                    if(isset($_REQUEST['Students']['admissionrange']) and $_REQUEST['Students']['admissionrange']!=NULL)
                                    {
										if(isset($_REQUEST['Students']['admission_date']) and $_REQUEST['Students']['admission_date']!=NULL)
										{
                            $j++;
                            if($_REQUEST['Students']['admissionrange']=='1')
                            {
                                    $admissionrange = Yii::t('app','less than');
                            }
                            if($_REQUEST['Students']['admissionrange']=='2')
                            {
                                    $admissionrange = Yii::t('app','equal to');
                            }
                            if($_REQUEST['Students']['admissionrange']=='3')
                            {
                                    $admissionrange = Yii::t('app','greater than');
											}
											?>
											<li><?php echo Yii::t('app','Admission Date'); ?> : <?php echo $admissionrange.' : '.$_REQUEST['Students']['admission_date']?><a href="<?php echo Yii::app()->request->getUrl().'&Students[admission_date]='?>"></a></li>
											<?php 
										}
									} 
                                    elseif(isset($_REQUEST['Students']['admissionrange']) and $_REQUEST['Students']['admissionrange']==NULL)
                                    {
                    if(isset($_REQUEST['Students']['admission_date']) and $_REQUEST['Students']['admission_date']!=NULL)
                    { 
                            $j++;
                            $admissionrange = Yii::t('app','equal to'); ?>
                            <li><?php echo Yii::t('app','Admission Date'); ?> : <?php echo $admissionrange.' : '.$_REQUEST['Students']['admission_date']?><a href="<?php echo Yii::app()->request->getUrl().'&Students[admission_date]='?>"></a></li>
										<?php 
										}
									}?> 
                                    <!-- END Admission Date Active Filter -->
                                    
                                    <!-- Status Active Filter -->
                                    <?php  
									if(isset($_REQUEST['Students']['status']) and $_REQUEST['Students']['status']!=NULL)
                                    {
										$j++;
										if($_REQUEST['Students']['status']=='1')
										{
											$status=Yii::t('app','Active');
										}
										elseif($_REQUEST['Students']['status']=='0')
										{
											$status=Yii::t('app','Inactive');
										}elseif($_REQUEST['Students']['status']=='all')
										{
											$status=Yii::t('app','All');
										}
										?>
										<li><?php echo Yii::t('app','Status'); ?> : <?php echo $status?><a href="<?php echo Yii::app()->request->getUrl().'&Students[status]='?>"></a></li>
                                    <?php 
									}
									?> 
                                    <!-- END status Filter -->
                                    <!-- Status Active Filter -->
                                    <?php  
									if(isset($_REQUEST['Students']['academic_yr']) and $_REQUEST['Students']['academic_yr']!=NULL)
                                    {
										$j++;
										if($_REQUEST['Students']['academic_yr']=='1')
										{
											$academic_status=Yii::t('app','In Progress');
										}
										elseif($_REQUEST['Students']['academic_yr']=='all')
										{
											$academic_status=Yii::t('app','All');
										}
										?>
										<li><?php echo Yii::t('app','Academic Status'); ?> : <?php echo $academic_status?><a href="<?php echo Yii::app()->request->getUrl().'&Students[academic_yr]='?>"></a></li>
                                    <?php 
									}
									?> 
                                    <!-- END Accademic status Filter -->
                                    <?php if($j==0)
                                    {
                                    	echo '<div style="padding-top:4px; font-size:11px;"><i>'.Yii::t('app','No Active Filters').'</i></div>';
                                    }
									?> 
                                    
                                    <div class="clear"></div>
                                </ul>
                            </div> <!-- END div class="filterbxcntnt_right" -->
                            
                            <div class="clear"></div>
                        </div> <!-- END div class="filterbxcntnt_inner_bot" -->
                        <!-- END Active Filter List -->
                    </div> <!-- END div class="filterbxcntnt" -->
                </div> <!-- END div class="filtercontner"-->
                
                <!-- END Filter Box -->
                <div class="clear"></div>
                
                <!-- Alphabetic Sort -->
                <?php $this->widget('application.extensions.letterFilter.LetterFilter', array(
					//parameters
					'outerWrapperClass'=>'list_contner_hdng',
					'innerWrapperId'=>'letterNavCon',
					'innerWrapperClass'=>'letterNavCon',
					'activeClass'=>'ln_active'					
														
				)); ?>
                <!-- END Alphabetic Sort -->
                
                <!-- List Content -->                                          
               <div  style="margin-top:20px; position:relative;">

                    <div class="clear"></div>
                    <div class="pdf-box">
                        <div class="box-one">
                            <div class="bttns_addstudent-n">
                                <ul>
                                    <li><?php echo CHtml::link(Yii::t('app','Add Student'), array('create'),array('class'=>'formbut-n')); ?></li>
                                    <?php if(count($list) > 0){ ?> 
                                        <li> <?php echo CHtml::Button( Yii::t('app','Delete All'),array('name'=>'submit','class'=>'formbut-n-input','id'=>'delete','onclick'=>'return delete_all()'));?>  
                                        </li>
                                        <li>
                                            <label><?php echo Yii::t('app', 'Number of rows')." : "; ?></label>                            
                                            <?php    
                                                $sel_size  =   10;
                                                if(isset($_REQUEST['size']) && $_REQUEST['size']!=NULL)
                                                {
                                                    $sel_size  =   $_REQUEST['size'];
                                                }
                                                $list_size   = array_combine(range(10,100,10),range(10,100,10));
                                                echo CHtml::dropDownList('list_size', $sel_size, $list_size, array('style'=>'width:80px'));
                                            ?>
                                        	
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="box-two">
                            <div class="pdf-div">
                             	<?php if(count($list) > 0){ ?>   
                                <input type="hidden" id='val' name="val" value="<?php echo $_GET['val'];?>">                                                              
                                        <button  type="submit" class="pdf_but-input" name="print" formtarget="_blank" style="outline:none;">
                                            <?php echo Yii::t('app','Generate PDF')?>
                                        </button>                                    
								<?php } ?>                              
                            </div>
                           
                        </div>
                        
                	</div>
		<?php $this->endWidget(); ?>                    
                    <?php 
					if($list)
                    {
					?>
                    <?php $form=$this->beginWidget('CActiveForm', array(
						'method'=>'post',
					)); ?>
					<?php $semester_enabled	= Configurations::model()->isSemesterEnabled(); ?>
             <div class="tablebx"> 
               <div class="clear"></div> 
                                           
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="tablebx_topbg">
                                <td style="text-align:center"><div class="btn-group mailbox-checkall-buttons">
        	<input type="checkbox" id="ch"  name="ch1" class="chkbox checkall" onClick="checkall()"/> </div></td>
            
                              <?php /*?>  <td width="40"><?php echo '#';?></td><?php */?>
                                <?php if(Configurations::model()->rollnoSettingsMode() != 2){?>
                                <td><?php echo Yii::t('app','Roll No');?></td>	
                                <?php } ?>
                                <?php
										if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile")){						
								  ?>
                                	<td><?php echo Yii::t('app','Student Name');?></td>
                                <?php } ?> 
                                 <?php if(Configurations::model()->rollnoSettingsMode() != 1){?>   
                                <td><?php echo Yii::t('app','Admission No');?></td>
                                <?php } ?>
                                <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){?>
                                	<td><?php echo Yii::app()->getModule("students")->labelCourseBatch();?></td>
                                <?php } ?> 
								<?php if($semester_enabled == 1){ ?> 
								   <td><?php echo Yii::t('app','Semester');?></td> 
								  <?php } ?>   
                                <?php if(FormFields::model()->isVisible('gender','Students','forStudentProfile')){?> 
                                	<td><?php echo Yii::t('app','Gender');?></td>
                                <?php } ?>    
                                 <td><?php echo Yii::t('app','Action');?></td>
                                <!--<td style="border-right:none;">Task</td>-->
                            </tr>
                            <?php 
                            if(isset($_REQUEST['page']))
                            {
                            	$i=($pages->pageSize*$_REQUEST['page'])-($sel_size-1);
                            }
                            else
                            {
                            	$i=1;
                            }
                            $cls="even";
                            ?>
                            
                            <?php 
							foreach($list as $list_1)
                            {
								 $batch_student=BatchStudents::model()->findByAttributes(array('student_id'=>$list_1->id, 'batch_id'=>$list_1->batch_id, 'result_status'=>0));
							?>
                                <tr class=<?php echo $cls;?>>
                                <td style="text-align:center">
                                    <div class="mailbox-item-wrapper">
                                    <label class="checkbox1" for="conv_<?php echo $list_1->id; ?>">
                                    <div class="mailbox-check mailbox-ellipsis">
                                    <input class="checkbox1 " id="conv_<?php echo $list_1->id; ?>" type="checkbox" name="convs" value="<?php echo $list_1->id; ?>" onClick="selectcheck()" />
                                    </div>
                                    </div>
                                </td>
                               <?php /*?> <td><?php echo $i; ?></td><?php */?>
                                  <?php if(Configurations::model()->rollnoSettingsMode() != 2){?>
                                  <td><?php if($batch_student!=NULL and $batch_student->roll_no!=0){
								  				echo $batch_student->roll_no;
								  			}
											else{
												echo '-';
											}?>
                                  </td> 
                                  <?php } ?>
                                <?php
									if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile")){
														
								?> 
                                	<td><?php echo CHtml::link($list_1->studentFullName('forStudentProfile'),array('view','id'=>$list_1->id)); ?></td>
                                <?php } ?>
                               <?php if(Configurations::model()->rollnoSettingsMode() != 1){?>       
                                <td><?php echo $list_1->admission_no ?></td>
                               <?php } ?> 
							<?php 
							$batchstudents=BatchStudents::model()->findAllByAttributes(array('student_id'=>$list_1->id, 'result_status'=>0)); 
							if(count($batchstudents)>1){ 
								echo "<td>".CHtml::link('View Course Details', array('/students/students/courses','id'=>$list_1->id))."</td>";
							}else if(count($batchstudents) == 0){
								echo "<td>-</td>";
							}
							else{  
									$batch 			= 	Batches::model()->findByPk($batchstudents[0]['batch_id']);
									$course 		= 	Courses::model()->findByAttributes(array('id'=>$batch->course_id)); 
									$sem_enabled	= 	Configurations::model()->isSemesterEnabledForCourse($course->id);
									$semester		= 	Semester::model()->findByAttributes(array('id'=>$batch->semester_id)); 
									$batch_student=BatchStudents::model()->findByAttributes(array('student_id'=>$studitem->id, 'batch_id'=>$list_1->batch_id, 'status'=>1));
									   echo "<td>".$batch->course123->course_name."/".$batch->name."</td>";
									
								
							} 
							if($semester_enabled == 1){ 
								if($sem_enabled == 1 and $batch->semester_id != NULL and count($batchstudents) != 0){ 
										echo "<td>".ucfirst($semester->name)."</td>";
								}
								else{
									echo "<td>-</td>";
								} 
							}
							?>
                            
                                
                                
                                <?php if(FormFields::model()->isVisible('gender','Students','forStudentProfile')){?> 
                                    <td>
                                        <?php 
                                        if($list_1->gender=='M')
                                        {
                                            echo Yii::t('app','Male');
                                        }
                                        elseif($list_1->gender=='F')
                                        {
                                            echo Yii::t('app','Female');
                                        }
                                        ?>
                                        
                                    </td>
                                <?php } ?>    
                                 <td> 
                                 	<div class="tt-wrapper-new"> 								 
										 <?php								
										 	 echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('/students/students/update','id'=>$list_1->id), array('class'=>'makeedit')); 
                                             echo CHtml::link('<span>'.Yii::t('app','Delete').'</span>', "#", array('submit'=>array('/students/students/delete_student','id'=>$list_1->id), 'confirm'=>Yii::t('app','Are you sure you want to delete the student?'), 'csrf'=>true, 'class'=>'makedelete'));
                                         ?>  
									</div>                                          
                                 </td>
                                
                                <!--<td style="border-right:none;">Task</td>-->
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
                          //'nextPageLabel'=>'My text >',
                          'header'=>'',
                        'htmlOptions'=>array('class'=>'pages'),
                        ));?>
                        
                        </div> <!-- END div class="pagecon" 2 -->
                        <div class="clear"></div>
                    </div> <!-- END div class="tablebx" -->
                    <?php $this->endWidget(); ?> 
                    <?php 
					}
                    else
                    {
                    	echo '<div class="listhdg" align="center">'.Yii::t('app','Nothing Found!!').'</div>';	
                    }?>
                </div> <!-- END div class="list_contner" -->
                <!-- END List Content -->
                <br />
            </div> <!-- END div class="cont_right formWrapper" -->
            <!--</div> 
            </div>-->
        </td>
    </tr>
</table>
</body>
<script>
$('body').click(function() {
	$('#osload').hide();
	$('#name').hide();
	$('#admissionnumber').hide();
	$('#rollnumber').hide();
	$('#batch').hide();
	$('#cat').hide();
	$('#pos').hide();
	$('#grd').hide();
	$('#gender').hide();
	$('#marital').hide();
	$('#bloodgroup').hide();
	$('#nationality').hide();
	$('#academic_yr').hide();
	if($("#dobtxt").val().length <=0)
	{
		$('#dob').hide();
	}
	if($("#admdatetxt").val().length <=0)
	{
		$('#admission').hide();
	}
	$('#status').hide();
 
});

$('.filterbxcntnt_inner').click(function(event){
   event.stopPropagation();
});

$('.load_filter').click(function(event){
   event.stopPropagation();
});


function checkall()
{
	if(ch.checked)
	{ 
		$('.checkbox1').prop('checked', true);
	}
	else
	{
		$('.checkbox1').each(function() { //loop through each checkbox
		   this.checked = false; //deselect all checkboxes with class "checkbox1"                       
		});         
	}
}
function selectcheck()
{
	var numberOfChecked = $('.checkbox1:checked').length; //count of all checked checkboxes with class "checkbox1"
	var totalCheckboxes = $('.checkbox1:checkbox').length; //count of all textboxes with class "checkbox1"
	if(numberOfChecked == totalCheckboxes)
		ch.checked=true;
	else
		ch.checked=false;	
}

function delete_all()
{
	var numberOfChecked = $('.checkbox1:checked').length; //count of all checked checkboxes with class "checkbox1"
	var totalCheckboxes = $('.checkbox1:checkbox').length; //count of all textboxes with class "checkbox1"
	var notChecked = $('.checkbox1:not(":checked")').length;//totalCheckboxes - numberOfChecked;
	
	if(numberOfChecked > 0)
	{		
		var favorite = [];
		$.each($("input[name='convs']:checked"), function(){            
			favorite.push($(this).val());
		});
		var r = confirm("<?php echo Yii::t('app','Are you sure ? Do you want to delete this?');?>");
		if(r==true){
			$.ajax({
				url:"<?php echo Yii::app()->createUrl('/students/students/delete_all');?>",
				type:'POST',
				data:{id:favorite, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
				dataType:"json",
				success:function(response){
					if(response.status=="success"){
						window.location.reload();
					}
					else{
						alert("<?php echo Yii::t("app", "Error");?>");
					}
				}
			});
		}
		else
		{
		
		return false;
		}
	}else{
		alert("<?php echo Yii::t('app','Please select atleast one Student');?>");
		return false;
	}
}

$(document).ready(function()
{
    $('#list_size').change(function()
    {                     
        var newUrl  =   updateQueryStringParameter(window.location.href, 'size', $('#list_size').val());
        var newUrl  =   returnRefinedURL('page',newUrl);
        window.location.href    =   newUrl;
        
        
    });
});

function returnRefinedURL(key, url){
   return url.replace(new RegExp(key + "=\\w+"),"").replace("?&","?")
  .replace("&&","&"); 
}

function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}
</script>