<?php
$batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); 
$this->breadcrumbs=array(
	Yii::t('app','Courses') =>array('/courses'),
	$batch->name,
);
?>
<script language="javascript">
function hide(id)
{
	$(".drop_search").hide();
	$('#'+id).toggle();	
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('/courses/left_side');?>        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php
                $batch_label = Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");
                echo Yii::t('app','Add Students to')." ".$batch_label." - ".$batch->name;?></h1>
                <div class="search_btnbx">
                    <div class="contrht_bttns">
                        <ul>
                            <li><?php echo CHtml::link('<span>'.Yii::t('app','Clear All').'</span>', array('addstudents','id'=>$_REQUEST['id'])); ?></li>
                        </ul>
                    </div>
                </div>
                
                <div class="clear"></div>
                
                <?php $form=$this->beginWidget('CActiveForm', array('method'=>'get')); ?>
                <div class="filtercontner">
                    <div class="filterbxcntnt">
                        <div class="filterbxcntnt_inner">
                            <p><?php echo Yii::t('app','Filter Your Students');?></p>
                        </div>
                        
                        <div class="filter_ul filterbxcntnt-new">
                            <ul>
                                <li class="Text_area_Box-two">
                                    <?php
                                    $cid= (isset($_REQUEST['cid']) && $_REQUEST['cid']!="")?$_REQUEST['cid']:"";
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
									$data1 = array(); 
									//course id   
									if($_GET['cid'] !=NULL or $_GET['cid'] !='') {
										$data1 = CHtml::listData(Batches::model()->findAllByAttributes(array('course_id'=>$_GET['cid'],'is_active'=>1,'is_deleted'=>0,'academic_yr_id'=>$year),array('order'=>'name ASC')),'id','name');
									}
                                                                      
                                    //$data1 = CHtml::listData(Batches::model()->findAll('is_active=:x AND is_deleted=:y AND academic_yr_id=:z',array(':x'=>'1',':y'=>0,':z'=>$year),array('order'=>'name DESC')),'id','name');                                        
                                            echo CHtml::dropDownList('cid',$cid,$data,
                                                    array('prompt'=>Yii::t('app','Select Course'),
                                                            'ajax' => array(
                                                            'type'=>'POST',
                                                            'url'=>CController::createUrl('batches/batch'),
                                                            'update'=>'#batch_id',
                                                            'data'=>array('cid'=>'js:this.value',Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken)
                                            ))); 
                                    ?>                                   
                                </li>
                                <li class="Text_area_Box-two">
                                    <?php
                                    $batch_label = Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");
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
                            </ul>
                            <div class="clearfix"></div>                                                                        
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        
                        <!-- Active Filter List -->
                        <div class="filterbxcntnt_inner_bot">
                            <div class="filterbxcntnt_left"><strong><?php echo Yii::t('app','Active Filters:');?></strong></div>
                            <div class="clear"></div>
                            <div class="filterbxcntnt_right">
                                <ul>                                	                                    
                                    <?php 
                                    $j=0;
                                    if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL)
                                    {
                                        $j++; 									?>
                                        <li><?php echo Yii::t('app','Name'); ?> : <?php echo $_REQUEST['name']?><a href="<?php echo Yii::app()->request->getUrl().'&name='?>"></a></li>
                                        <?php 
                                    }                                    
                                    if(isset($_REQUEST['admissionnumber']) and $_REQUEST['admissionnumber']!=NULL)
                                    { 
                                    	$j++; 
                                        ?>
                                    	<li><?php echo Yii::t('app','Admission number'); ?> : <?php echo $_REQUEST['admissionnumber']?><a href="<?php echo Yii::app()->request->getUrl().'&admissionnumber='?>"></a></li>								
                                        <?php 
                                    }                                   
                                    if(isset($_REQUEST['Students']['batch_id']) and $_REQUEST['Students']['batch_id']!=NULL)
                                    { 
                                    	$j++;
                                    ?>
                                    	<li><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"); ?> : <?php echo Batches::model()->findByAttributes(array('id'=>$_REQUEST['Students']['batch_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Students[batch_id]='?>"></a></li>
                                    <?php 
                                    }									
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
                        
                        
                        
                    </div>
                </div>
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
                                    
                                    <?php if(count($list) > 0){ ?>                                        
                                        <li> <?php echo CHtml::Button( Yii::t('app','Add Student'),array('name'=>'submit','class'=>'formbut-n','id'=>'add_stud','onclick'=>'return add_all()'));?>  </li>                                    
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
                    </div>
                    <?php $this->endWidget(); ?>                    
                    <?php 
                    if($list)
                    {
                    ?>
                    <?php $form=$this->beginWidget('CActiveForm', array('method'=>'post')); ?>											
                    <div class="tablebx"> 
                        <div class="clear"></div>                                              
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="tablebx_topbg">
                                <td style="text-align:center"><div class="btn-group mailbox-checkall-buttons">
                                <input type="checkbox" id="ch"  name="ch1" class="chkbox checkall" onClick="checkall()"/> </div></td>
                                <td width="40"><?php echo '#';?></td>	
                                <?php
                                    if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile")){						
                                ?>
                                <td><?php echo Yii::t('app','Student Name');?></td>
                                <?php } ?>    
                                <td><?php echo Yii::t('app','Admission No');?></td>
                                <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){?>
                                <td><?php echo Yii::app()->getModule("students")->labelCourseBatch();?></td>
                                <?php } ?>   
                                <?php if(FormFields::model()->isVisible('gender','Students','forStudentProfile')){?> 
                                <td><?php echo Yii::t('app','Gender');?></td>
                                <?php } ?>    
                                 <td><?php echo Yii::t('app','Action');?></td>                                
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
                                <td><?php echo $i; ?></td>
                                <?php
									if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile")){						
								?> 
                                	<td><?php echo CHtml::link($list_1->studentFullName('forStudentProfile'),array('/students/students/view','id'=>$list_1->id)); ?></td>
                                <?php } ?>    
                                <td><?php echo $list_1->admission_no ?></td>
                                <?php 
								$batc = Batches::model()->findByAttributes(array('id'=>$list_1->batch_id,'is_active'=>1,'is_deleted'=>0)); 
                                if($batc!=NULL)
                                {
									$cours = Courses::model()->findByAttributes(array('id'=>$batc->course_id)); ?>
                                    <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){?>
										<td><?php echo $cours->course_name.' / '.$batc->name; ?></td> 
                                    <?php } ?>    
                                <?php 
								}
                                else{
								?>
                                	<?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){?> 
                                		<td>-</td>
                                    <?php } ?>     
								<?php 
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
                                 	<div> 								 
                                        <?php								                                            
                                            echo CHtml::link(Yii::t('app','Add to')." ".$batch_label, "#", array('submit'=>array('/courses/batches/addStudent','student_id'=>$list_1->id,'batch_id'=>$_REQUEST['id']), 'confirm'=>Yii::t('app','Are you sure you want to add the student?'), 'csrf'=>true, 'title'=>  Yii::t('app', 'Add student to selected')." ".$batch_label));
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
              
            
            </div>
        </td>
    </tr>
</table>

<script>
$('body').click(function() {
	$('#osload').hide();
	$('#name').hide();
	$('#admissionnumber').hide();
	$('#batch').hide();	
	$('#gender').hide();
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

$(document).ready(function()
{
    $('#list_size').change(function()
    {                     
        var newUrl  =   updateQueryStringParameter(window.location.href, 'size', $('#list_size').val());
        var newUrl  =   returnRefinedURL('page',newUrl);
        window.location.href    =   newUrl;
        
        
    });
});

function add_all()
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
        var r = confirm("<?php echo Yii::t('app','Are you sure ? Do you want to add this student?');?>");
        if(r==true){
                $.ajax({
                        url:"<?php echo Yii::app()->createUrl('/courses/batches/add_all');?>",
                        type:'POST',
                        data:{id:favorite, sel_batch:"<?php echo $_REQUEST['id']; ?>" ,"<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
                        dataType:"json",
                        success:function(response){
                                if(response.status=="success"){
                                    window.location.href=   response.url;
                                    //    window.location.reload();
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