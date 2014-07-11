<?php 
/**
 * Ajax Crud Administration
 * ClassTimings * index.php view file
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 * @license The MIT License
 */
?><?php
 $this->breadcrumbs=array(
	 'Manage Class Timings'
);
?>
<?php  
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('class-timings-grid', {
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
    <!--<div class="searchbx_area">
    <div class="searchbx_cntnt">
    	<ul>
        <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
        <li><input class="textfieldcntnt"  name="" type="text" /></li>
        </ul>
    </div>
    
    </div>-->
    
    
   <!--     
    <div class="edit_bttns">
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
    <div class="emp_cntntbx" style="padding-top:10px;">
    <div  align="right" style="position:relative;" >
    <div class="edit_bttns" style="width:110px; top:10px;">
    <ul>
    <li>
    <?php echo CHtml::link('<span>'.Yii::t('Timing','Time Table').'</span>', array('/courses/weekdays/timetable','id'=>$_REQUEST['id']),array('class'=>'addbttn last'));?>
    </li>
   
    </ul>
    <div class="clear"></div>
    </div>
    </div>
<div style="width:100%">

<div  >
<h3><?php echo Yii::t('Timing','Class Timings');?></h3>

<div class="right" align="left">
    
           <?php echo CHtml::link(Yii::t('Timing','Create Class Timings'), array('#'),array('id'=>'add_class-timings','class'=>'cbut')) ?>
</div>

<?php
//Strings for the delete confirmation dialog.
$del_con = Yii::t('admin_class-timings', 'Are you sure you want to delete?');
$del_title=Yii::t('admin_class-timings', 'Delete Confirmation');
 $del=Yii::t('admin_class-timings', 'Delete');
 $cancel=Yii::t('admin_class-timings', 'Cancel');
 
   ?>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
         'id' => 'class-timings-grid',
         'dataProvider' => $model->search(),
		 'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	     'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
         
         'htmlOptions'=>array('class'=>'grid-view clear'),
          'columns' => array(
          		
		
		'name',
		 array(            // display 'create_time' using an expression
            'name'=>'start_time',
			'type'=>'raw',
			'value'=>'ClassTimingController::convertTime($data->start_time)',

        ),
		 array(            // display 'create_time' using an expression
            'name'=>'end_time',
			'type'=>'raw',
			'value'=>'ClassTimingController::convertTime($data->end_time)',

        ),
		array(
            'name'=>'is_break',
            'value'=>'$data->is_break ? "Yes" : "No"'
        ),
		

    array(
                   'class' => 'CButtonColumn',
                    'buttons' => array(
                                                     'class-timings_delete' => array(
                                                     'label' => Yii::t('admin_class-timings', 'Delete'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/cross.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_del", 'title' => Yii::t('admin_class-timings', 'Delete')), // HTML options for the button   tag
                                                      ),
                                                     'class-timings_update' => array(
                                                     'label' => Yii::t('admin_class-timings', 'Update'), // text label of the button
                                                     'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                     'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/pencil.png', // image URL of the button.   If not set or false, a text link is used
                                                     'options' => array("class" => "fan_update", 'title' => Yii::t('admin_class-timings', 'Update')), // HTML options for the    button tag
                                                        ),
                                                     'class-timings_view' => array(
                                                      'label' => Yii::t('admin_class-timings', 'View'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/properties.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_view", 'title' => Yii::t('admin_class-timings', 'View')), // HTML options for the    button tag
                                                        )
                                                    ),
                   'template' => '{class-timings_view}{class-timings_update}{class-timings_delete}',
            ),
    ),
           'afterAjaxUpdate'=>'js:function(id,data){$.bind_crud()}'

                                            ));


   ?>
   </div>

 	
    </div>
    </div></div></div></div>
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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/classTiming/returnView",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#class-timings-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#class-timings-grid").removeClass("ajax-sending");
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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/classTiming/returnForm",
                data:{"update_id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#class-timings-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#class-timings-grid").removeClass("ajax-sending");
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
                                $.fn.yiiGridView.update('class-timings-grid', {url:'<?php echo Yii::app()->request->getUrl()?>',data:{"ClassTimings_page":page}});
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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/classTiming/ajax_delete",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                    beforeSend : function() {
                    $("#class-timings-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#class-timings-grid").removeClass("ajax-sending");
                },
                success: function(data) {
                    var res = jQuery.parseJSON(data);
                     var page=$("li.selected  > a").text();
                    $.fn.yiiGridView.update('class-timings-grid', {url:'<?php echo Yii::app()->request->getUrl()?>',data:{"ClassTimings_page":page}});
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

    $('#add_class-timings ').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/classTiming/returnForm",
            data:{"batch_id":<?php echo $_GET['id'];?>,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#class-timings-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#class-timings-grid").removeClass("ajax-sending");
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
