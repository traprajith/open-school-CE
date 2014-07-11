<?php 
/**
 * Ajax Crud Administration
 * EventsType * index.php view file
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
	 'Manage Events Types'
);
?>
<?php  
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('events-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top" id="port-left">
        	<?php $this->renderPartial('/default/left_side');?>
        </td>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top" width="75%">
                    <div class="cont_right formWrapper" style="padding:10px;">
                        <h1>Events Types </h1>
                        <div class="edit_bttns">
                        	<ul>
                            	<li>
                                    <!--<input id="add_events-type" type="button" style="display:block; clear: both;"
                                    value="Create EventsType" class="addbttn last">-->
                                    <?php echo CHtml::link('<span>'.Yii::t('Exam','Create Event Type').'</span>', array('#'),array('id'=>'add_events-type','class'=>'addbttn')) ?>
                            	</li>
							</ul>
                        </div>
                        
                        <?php
                        //Strings for the delete confirmation dialog.
                        $del_con = Yii::t('admin_events-type', 'Are you sure you want to delete this events-type?');
                        $del_title=Yii::t('admin_events-type', 'Delete Confirmation');
                        $del=Yii::t('admin_events-type', 'Delete');
                        $cancel=Yii::t('admin_events-type', 'Cancel');
                        ?>
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'events-type-grid',
                        'dataProvider' => $model->search(),
                        'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
                        'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
                        'filter' => $model,
                        'htmlOptions'=>array('class'=>'grid-view clear'),
                        'columns' => array(
                        
						array('name'=>'name',
								'header' => 'Event Type'),
						array('name'=>'colour_code',
							'value' => array($model,'color')
								),
                        
                        array(
                        'class' => 'CButtonColumn',
                        'buttons' => array(
                                 'events-type_delete' => array(
                                 'label' => Yii::t('admin_events-type', 'Delete'), // text label of the button
                                  'url' => '$data->id', // a PHP expression for generating the URL of the button
                                  'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/cross.png', // image URL of the button.   If not set or false, a text link is used
                                  'options' => array("class" => "fan_del", 'title' => Yii::t('admin_events-type', 'Delete')), // HTML options for the button   tag
                                  ),
                                 'events-type_update' => array(
                                 'label' => Yii::t('admin_events-type', 'Update'), // text label of the button
                                 'url' => '$data->id', // a PHP expression for generating the URL of the button
                                 'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/pencil.png', // image URL of the button.   If not set or false, a text link is used
                                 'options' => array("class" => "fan_update", 'title' => Yii::t('admin_events-type', 'Update')), // HTML options for the    button tag
                                    ),
                                 'events-type_view' => array(
                                  'label' => Yii::t('admin_events-type', 'View'), // text label of the button
                                  'url' => '$data->id', // a PHP expression for generating the URL of the button
                                  'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/properties.png', // image URL of the button.   If not set or false, a text link is used
                                  'options' => array("class" => "fan_view", 'title' => Yii::t('admin_events-type', 'View')), // HTML options for the    button tag
                                    )
                                ),
                        'template' => '{events-type_update}{events-type_delete}',
                        ),
                        ),
                        'afterAjaxUpdate'=>'js:function(id,data){$.bind_crud()}'
                        
                        ));
                        
                        
                        ?>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=cal/eventstype/returnView",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#events-type-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#events-type-grid").removeClass("ajax-sending");
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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=cal/eventstype/returnForm",
                data:{"update_id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#events-type-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#events-type-grid").removeClass("ajax-sending");
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
                                $.fn.yiiGridView.update('events-type-grid', {url:'<?php echo Yii::app()->request->baseUrl;?>/index.php?r=cal/eventstype',data:{"EventsType_page":page}});
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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=cal/eventstype/ajax_delete",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                    beforeSend : function() {
                    $("#events-type-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#events-type-grid").removeClass("ajax-sending");
                },
                success: function(data) {
                    var res = jQuery.parseJSON(data);
                     var page=$("li.selected  > a").text();
                    $.fn.yiiGridView.update('events-type-grid', {url:'<?php echo Yii::app()->request->baseUrl;?>/index.php?r=cal/eventstype',data:{"EventsType_page":page}});
                }//success
            });//ajax
        };//end of deletes

        dialogs[id] =
                        $('<div style="text-align:center;"></div>')
                        .html('<?php echo  $del_con; ?><br><br>' + '<h2 style="color:#999999">ID: ' + id + '</h2>')
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

    $('#add_events-type ').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=cal/eventstype/returnForm",
            data:{"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#events-type-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#events-type-grid").removeClass("ajax-sending");
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
                                   var page=$("li.selected  > a").text();
                                $.fn.yiiGridView.update('events-type-grid', {url:'<?php echo Yii::app()->request->baseUrl;?>/index.php?r=cal/eventstype',data:{"EventsType_page":page}});
                            } //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind


})//document ready
    
</script>
