<style>
.container{ background:#fff !important;
}
</style>
<?php
$batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); 
$this->breadcrumbs=array(
	Yii::t('app','Courses')=>array('/courses'),
	$batch->name=>array('/courses/batches/batchstudents','id'=>$_REQUEST['id']),
	Yii::t('app','Subjects'),
	
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('subjects-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div style="background:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td valign="top">
                <div style="padding:20px;">
                    <!--<div class="edit_bttns">
                    <ul>
                    <li>
                    <a class=" edit last" href="#">Edit</a>    </li>
                    </ul>
                    </div>-->
                    
                    
                    <div class="clear"></div>
                    <div class="emp_right_contner">
                        <div class="emp_tabwrapper">
                        <?php $this->renderPartial('/batches/tab');?>
                        
                        <div class="clear"></div>
                            <div class="emp_cntntbx" style="padding-top:30px;">
                            
                                <div class="c_subbutCon" align="right" style="width:100%">
                                    <div id="success_flash" align="center" style="padding-left:40px;  color:#F00; display:none;">
                                        <h4><?php echo Yii::t('app','Selected Subject Deleted Successfully').' !'; ?></h4>
                                    </div>
                                    
                                    <?php
									$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
									if(Yii::app()->user->year)
									{
										$year = Yii::app()->user->year;
									}
									else
									{
										$year = $current_academic_yr->config_value;
									}
									$is_create = PreviousYearSettings::model()->findByAttributes(array('id'=>1));
									$is_edit = PreviousYearSettings::model()->findByAttributes(array('id'=>3));
									$is_delete = PreviousYearSettings::model()->findByAttributes(array('id'=>4));
									
									$template = '';
									if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
									{
										$template = $template.'{subjects_update}';
									}
									
									if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
									{
										$template = $template.'{subjects_delete}';
									}
									
									?>
                                    
                                    
                                    
                                    <div class="edit_bttns" style="width:auto; top:14px; right:-4px;">
                                        <ul>
                                        	<?php
											if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
											{
											?>
                                            <li>
                                                <?php echo CHtml::link('<span>'.Yii::t('app','Add Subjects To').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'</span>', array('#'),array('id'=>'add_subjects','class'=>'addbttn')) ?>
                                            </li>
                                            <?php
											}
											if(isset($_REQUEST['id']))
                							{
											?>
                                            
                                            <li>
                                                <?php echo CHtml::link('<span>'.Yii::t('app','Electives').'</span>', array('/courses/electives','id'=>$_REQUEST['id']),array('class'=>'addbttn last')) 
												
											?>
                                            </li>
                                            <?php
											}
											?>
                                        </ul>
                                        <div class="clear"></div>
                                    </div> 
									<br />
<!-- END div class="edit_bttns" -->
                                    
                                </div>
                                
                                <?php
                                //Strings for the delete confirmation dialog.
                                $del_con = Yii::t('app', 'Are you sure you want to delete this subject?');
                                $del_title=Yii::t('app', 'Delete Confirmation');
                                $del=Yii::t('app', 'Delete');
                                $cancel=Yii::t('app', 'Cancel');
                                ?>
                                <?php
                                $this->widget('zii.widgets.grid.CGridView', array(
                                    'id' => 'subjects-grid',
                                    'dataProvider' => $model->search(),
                                    'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
                                    'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
                                    
                                    'htmlOptions'=>array('class'=>'grid-view clear'),
                                    'columns' => array(
                                    
                                       // 'name',
									   array(
											'header'=>Yii::t('app','Name'),
											'value'=>array($model,'getName'), 
										),
										
                                       
									    //'code',
                                        'max_weekly_classes',
										 array(
											'header'=>Yii::t('app','First Sub Category'),
											'value'=>array($model,'getsub_category1'), 
										),
										array(
											'header'=>Yii::t('app','Second Sub Category'),
											'value'=>array($model,'getsub_category2'), 
										),
										//'sub_category1',
										//'sub_category2',
										//'sub_category2',
                                        /*
                                        'elective_group_id',
                                        'is_deleted',
                                        'created_at',
                                        'updated_at',
                                        */
                                        
                                        array(
											'header'=>Yii::t('app','Action'),
                                            'class' => 'CButtonColumn',
                                            'buttons' => array(
                                                         'subjects_delete' => array(
                                                         'label' => Yii::t('app', 'Delete'), // text label of the button
                                                          'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                          'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/cross.png', // image URL of the button.   If not set or false, a text link is used
                                                          'options' => array("class" => "fan_del", 'title' => Yii::t('app', 'Delete')), // HTML options for the button   tag
                                                          ),
                                                         'subjects_update' => array(
                                                         'label' => Yii::t('app', 'Update'), // text label of the button
                                                         'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                         'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/pencil.png', // image URL of the button.   If not set or false, a text link is used
                                                         'options' => array("class" => "fan_update", 'title' => Yii::t('app', 'Update')), // HTML options for the    button tag
                                                            ),
                                                         'subjects_view' => array(
                                                          'label' => Yii::t('app', 'View'), // text label of the button
                                                          'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                          'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/properties.png', // image URL of the button.   If not set or false, a text link is used
                                                          'options' => array("class" => "fan_view", 'title' => Yii::t('app', 'View')), // HTML options for the    button tag
                                                            )
                                                        ),
                                            'template' => '{subjects_view}'.$template,
                                            ),
                                    ),
                                    'afterAjaxUpdate'=>'js:function(id,data){$.bind_crud()}'
                                
                                                ));
                                
                                
                                ?>
                            </div> <!-- END div class="emp_cntntbx" -->
                        </div> <!-- END div class="emp_tabwrapper" -->
                    </div> <!-- END div class="emp_right_contner" -->
                </div>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
//document ready
$(function() {

    //declaring the function that will bind behaviors to the gridview buttons,
    //also applied after an ajax update of the gridview.(see 'afterAjaxUpdate' attribute of gridview).
        $. bind_crud= function(){
            
 //VIEW

    $('.fan_view').each(function(index) {
        var id = $(this).attr('href');
        $(this).bind('click', function() {
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/subject/returnView",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#subjects-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subjects-grid").removeClass("ajax-sending");
                },
                success: function(data) {
                    $.fancybox(data,
                            {    "transitionIn" : "elastic",
                                "transitionOut" :"elastic",
                                "speedIn"              : 600,
                                "speedOut"         : 200,
                                "overlayShow"  : false,
                                "hideOnContentClick": false
                            });//fancybox
                    //  console.log(data);
                } //success
            });//ajax
            return false;
        });
    });

//UPDATE

    $('.fan_update').each(function(index) {
        var id = $(this).attr('href');
        $(this).bind('click', function() {
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/subject/returnForm",
                data:{"update_id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#subjects-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subjects-grid").removeClass("ajax-sending");
                },
                success: function(data) {
                    $.fancybox(data,
                            {    "transitionIn"    :  "elastic",
                                 "transitionOut"  : "elastic",
                                 "speedIn"               : 600,
                                 "speedOut"           : 200,
                                 "overlayShow"    : false,
                                 "hideOnContentClick": false,
                                "afterClose":    function() {
                                   var page=$("li.selected  > a").text();
                                $.fn.yiiGridView.update('subjects-grid', {url:'<?php echo Yii::app()->request->getUrl()?>',data:{"Subjects_page":page}});
                                }//onclosed
                            });//fancybox
                    //  console.log(data);
                } //success
            });//ajax
            return false;
        });
    });


// DELETE

    var deletes = new Array();
    var dialogs = new Array();
    $('.fan_del').each(function(index) {
        var id = $(this).attr('href');
        deletes[id] = function() {
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/subject/ajax_delete",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                    beforeSend : function() {
                    $("#subjects-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subjects-grid").removeClass("ajax-sending");
                },
                success: function(data) {
                    var res = jQuery.parseJSON(data);
					 var del=res['msg'];
                     var page=$("li.selected  > a").text();
                    $.fn.yiiGridView.update('subjects-grid', {url:'<?php echo Yii::app()->request->getUrl()?>',data:{"Subjects_page":page}});
                }//success
            });//ajax
        };//end of deletes

        dialogs[id] =
                        $('<div style="text-align:center;"></div>')
                        .html('<?php echo  $del_con; ?>')
                       .dialog(
                        {
                            autoOpen: false,
                            title: '<?php echo  $del_title; ?>',
                            modal:true,
                            resizable:false,
                            buttons: [
                                {
                                    text: "<?php echo  $del; ?>",
                                    click: function() {
                                                                      deletes[id]();
                                                                      $(this).dialog("close");
																	  $("#success_flash").css("display","block").animate({opacity: 1.0}, 3000).fadeOut("slow");
                                                                      }
                                },
                                {
                                   text: "<?php echo $cancel; ?>",
                                   click: function() {
                                                                     $(this).dialog("close");
                                                                     }
                                }
                            ]
                        }
                );

        $(this).bind('click', function() {
                                                                      dialogs[id].dialog('open');
                                                                       // prevent the default action, e.g., following a link
                                                                      return false;
                                                                     });
    });//each end

        }//bind_crud end

   //apply   $. bind_crud();
  $. bind_crud();


//CREATE 

    $('#add_subjects ').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/subject/returnForm",
            data:{"batch_id":<?php echo $_GET['id'];?>,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#subjects-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subjects-grid").removeClass("ajax-sending");
                },
            success: function(data) {
                $.fancybox(data,
                        {    "transitionIn"      : "elastic",
                            "transitionOut"   : "elastic",
                            "speedIn"                : 600,
                            "speedOut"            : 200,
                            "overlayShow"     : false,
                            "hideOnContentClick": false,
                            "afterClose":    function() {
								window.location.reload();
								} //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind


})//document ready
    
</script>
