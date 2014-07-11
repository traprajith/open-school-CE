<?php 
/**
 * Ajax Crud Administration
 * SubjectNameAjax * index.php view file
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
	 'Manage Subject Name Ajaxes'
);
?>
<?php  
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('subject-name-ajax-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>SubjectNameAjaxes </h1>

  <p class="left">You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.</p><?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?><div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div class="right">
    <input id="add_subject-name-ajax" type="button" style="display:block; clear: both;"
           value="Create SubjectNameAjax" class="client-val-form button">
</div>

<?php echo CHtml::link(Yii::t('subjectname','Create'), '#',array('id'=>'add_subject-name-ajax','class'=>'client-val-form button')); ?>

<?php
//Strings for the delete confirmation dialog.
$del_con = Yii::t('admin_subject-name-ajax', 'Are you sure you want to delete this subject-name-ajax?');
$del_title=Yii::t('admin_subject-name-ajax', 'Delete Confirmation');
 $del=Yii::t('admin_subject-name-ajax', 'Delete');
 $cancel=Yii::t('admin_subject-name-ajax', 'Cancel');
   ?>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
         'id' => 'subject-name-ajax-grid',
         'dataProvider' => $model->search(),
         'filter' => $model,
         'htmlOptions'=>array('class'=>'grid-view clear'),
          'columns' => array(
          		'id',
		'name',
		'code',

    array(
                   'class' => 'CButtonColumn',
                    'buttons' => array(
                                                     'subject-name-ajax_delete' => array(
                                                     'label' => Yii::t('admin_subject-name-ajax', 'Delete'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/cross.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_del", 'title' => Yii::t('admin_subject-name-ajax', 'Delete')), // HTML options for the button   tag
                                                      ),
                                                     'subject-name-ajax_update' => array(
                                                     'label' => Yii::t('admin_subject-name-ajax', 'Update'), // text label of the button
                                                     'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                     'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/pencil.png', // image URL of the button.   If not set or false, a text link is used
                                                     'options' => array("class" => "fan_update", 'title' => Yii::t('admin_subject-name-ajax', 'Update')), // HTML options for the    button tag
                                                        ),
                                                     'subject-name-ajax_view' => array(
                                                      'label' => Yii::t('admin_subject-name-ajax', 'View'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/properties.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_view", 'title' => Yii::t('admin_subject-name-ajax', 'View')), // HTML options for the    button tag
                                                        )
                                                    ),
                   'template' => '{subject-name-ajax_view}{subject-name-ajax_update}{subject-name-ajax_delete}',
            ),
    ),
           'afterAjaxUpdate'=>'js:function(id,data){$.bind_crud()}'

                                            ));


   ?>
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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=subjectNameAjax/returnView",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#subject-name-ajax-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subject-name-ajax-grid").removeClass("ajax-sending");
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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=subjectNameAjax/returnForm",
                data:{"update_id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#subject-name-ajax-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subject-name-ajax-grid").removeClass("ajax-sending");
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
                                $.fn.yiiGridView.update('subject-name-ajax-grid', {url:'<?php echo Yii::app()->request->getUrl()?>',data:{"SubjectNameAjax_page":page}});
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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=subjectNameAjax/ajax_delete",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                    beforeSend : function() {
                    $("#subject-name-ajax-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subject-name-ajax-grid").removeClass("ajax-sending");
                },
                success: function(data) {
                    var res = jQuery.parseJSON(data);
                     var page=$("li.selected  > a").text();
                    $.fn.yiiGridView.update('subject-name-ajax-grid', {url:'<?php echo Yii::app()->request->getUrl();?>',data:{"SubjectNameAjax_page":page}});
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

    $('#add_subject-name-ajax ').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=subjectNameAjax/returnForm",
            data:{"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#subject-name-ajax-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subject-name-ajax-grid").removeClass("ajax-sending");
                },
            success: function(data) {alert(JSON.stringify($.fn));
                $.fancybox(data,
                        {    "transitionIn"      : "elastic",
                            "transitionOut"   : "elastic",
                            "speedIn"                : 600,
                            "speedOut"            : 200,
                            "overlayShow"     : false,
                            "hideOnContentClick": false,
                            "afterClose":    function() {
                                   var page=$("li.selected  > a").text();
                                $.fn.yiiGridView.update('subject-name-ajax-grid', {url:'<?php echo Yii::app()->request->getUrl();?>',data:{"SubjectNameAjax_page":page}});
                            } //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind


})//document ready


    
</script>
