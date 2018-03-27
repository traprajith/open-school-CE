<?php 
/**
 * Ajax Crud Administration
 * Electives * index.php view file
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 * @license The MIT License
 */
?>
<style>
.container
{
	background:#FFF;
}
.del_msg{ text-align:center; color:#A5110A; padding-top:10px; font-weight:bold; }
</style>
<?php
$this->breadcrumbs=array(
	Yii::t('app','Courses') =>array('/courses'),
	 Yii::t('app','Manage Electives'),
);
?>
<?php  
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('electives-grid', {
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

                    
                    
                    <div class="clear"></div>
                    <div class="emp_right_contner">
                        <div class="emp_tabwrapper">
							<?php $this->renderPartial('/batches/tab');?>
                            <div class="clear"></div>
                            <div class="emp_cntntbx" style="padding-top:10px;">
                                <div>
                                    <div> 
                                        <h3><?php echo Yii::t('app','Electives'); ?></h3>
                                        
                                       
<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
                                        	<ul>
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
													$template = $template.'{electives_update}';
												}
												
												if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
												{
													$template = $template.'{electives_delete}';
												}
												
												
                                                if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
                                                {
                                                ?>
												<li>
													<?php //echo CHtml::link('<span>'.Yii::t('Batch','Add Students').'</span>', array('/courses/batches/elective','id'=>$_REQUEST['id']),array('class'=>'addbttn last'));?>
												</li>
                                                <li>
                                                    <?php echo CHtml::link(Yii::t('app','Create Elective Groups'), array('#'),array('id'=>'add_electivegroups','class'=>'a_tag-btn'));?>                 
                                                </li>
                                                <li>
                                                	<?php echo CHtml::link(Yii::t('app','Create Electives'), array('#'),array('id'=>'add_electives','class'=>'a_tag-btn'));?>                                 
                                                </li>
                                                <?php
                                                }
                                                ?>
                                                <li>
                                                	<?php echo CHtml::link(Yii::t('app','Elective Groups'), array('/courses/electiveGroups','id'=>$_REQUEST['id']),array('class'=>'a_tag-btn'));?>      
                                                </li>
                                            </ul>
                                            </div>
                                        </div>
                                        
                                        <?php
                                        //Strings for the delete confirmation dialog.
                                        $del_con = Yii::t('app', 'Are you sure you want to delete this electives(Also delete this elective Exam marks)?');
                                        $del_title=Yii::t('app', 'Delete Confirmation');
                                        $del=Yii::t('app', 'Delete');
                                        $cancel=Yii::t('app', 'Cancel');
                                        ?>
                                        <?php
                                        $this->widget('zii.widgets.grid.CGridView', array(
											'id' => 'electives-grid',
											'dataProvider' => $model->search(),
											'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
											'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
											'htmlOptions'=>array('class'=>'grid-view clear'),
											'columns' => array(
												 
												'name',
												 array(
														'name'=>'elective_group_id',
														'value'=>array($model,'groupname')												
													 ),
												//'code',
												//'batch_id',
												//'is_deleted',
												//'created_at',
												/*
												'updated_at',
												*/
												
												array(
												'header'=>Yii::t('app','Actions'),
												'class' => 'CButtonColumn',
												'buttons' => array(
														 'electives_delete' => array(
														 'label' => Yii::t('app', 'Delete'), // text label of the button
														  'url' => '$data->id', // a PHP expression for generating the URL of the button
														  'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/cross.png', // image URL of the button.   If not set or false, a text link is used
														  'options' => array("class" => "fan_del", 'title' => Yii::t('app', 'Delete')), // HTML options for the button   tag
														  ),
														 'electives_update' => array(
														 'label' => Yii::t('app', 'Update'), // text label of the button
														 'url' => '$data->id', // a PHP expression for generating the URL of the button
														 'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/pencil.png', // image URL of the button.   If not set or false, a text link is used
														 'options' => array("class" => "fan_update", 'title' => Yii::t('app', 'Update')), // HTML options for the    button tag
															),
														 'electives_view' => array(
														  'label' => Yii::t('app', 'View'), // text label of the button
														  'url' => '$data->id', // a PHP expression for generating the URL of the button
														  'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/properties.png', // image URL of the button.   If not set or false, a text link is used
														  'options' => array("class" => "fan_view", 'title' => Yii::t('app', 'View')), // HTML options for the    button tag
															)
														),
												'template' => '{electives_view}'.$template,
												),
											),
											'afterAjaxUpdate'=>'js:function(id,data){$.bind_crud()}'
                                        
                                        ));
                                        
                                        
                                        ?>
                                        <div class="del_msg"></div>
                                    </div>
                                </div>
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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/electives/returnView",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#electives-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#electives-grid").removeClass("ajax-sending");
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
                 url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/electives/returnForm",
                data:{"update_id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#electives-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#electives-grid").removeClass("ajax-sending");
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
                                    window.location.reload();
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
                 url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/electives/ajax_delete",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                    beforeSend : function() {
                    $("#electives-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#electives-grid").removeClass("ajax-sending");
                },
                success: function(data) {
					$(".del_msg").html("<?php echo Yii::t('app','Selected Elective Deleted Successfully') ?>");
					$(".del_msg").fadeOut(7000);
                    var res = jQuery.parseJSON(data);
                     var page=$("li.selected  > a").text();
                    $.fn.yiiGridView.update('electives-grid', {url:'<?php echo Yii::app()->request->getUrl()?>',data:{"Electives_page":page}});
                }//success
            });//ajax
        };//end of deletes

        dialogs[id] =
                        $('<div style="text-align:center;"></div>')
                        .html('<?php echo  $del_con; ?><br><br>' + '<h2 style="color:#999999"></h2>')
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

    $('#add_electives ').bind('click', function() {
        $.ajax({
            type: "POST",
             url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/electives/returnForm",
            data:{"batch_id":<?php echo $_GET['id'];?>,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#electives-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#electives-grid").removeClass("ajax-sending");
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



	
//CREATE  elective groups

    $('#add_electivegroups ').bind('click', function() {
        $.ajax({
            type: "POST",
             url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/electiveGroups/returnForm",
            data:{"batch_id":<?php echo $_GET['id'];?>,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#elective-groups-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#elective-groups-grid").removeClass("ajax-sending");
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
