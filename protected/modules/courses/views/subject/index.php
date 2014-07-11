<?php
$this->breadcrumbs=array(
	'Subjects'=>array('/courses'),
	'Manage',
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
 <div id="success_flash" align="center" style="padding-left:40px;  color:#F00; display:none;"><h4>Selected Subject Deleted Successfully !</h4>
 
   </div>
    <div class="edit_bttns" style="width:180px; top:5px; right:-9px;">
    <ul>
    <li>
    <?php echo CHtml::link('<span>'.Yii::t('Subjects','Add Subjects To Batch').'</span>', array('#'),array('id'=>'add_subjects','class'=>'addbttn')) ?>
    
	</li>
    <li>
    <?php //echo CHtml::link('<span>'.Yii::t('Subjects','All Subjects').'</span>', array('/courses/defaultsubjects','id'=>$_REQUEST['id']),array('class'=>'addbttn last')) ?>
    
	</li>
    
    </ul>
    <div class="clear"></div>
    
    </div>
    </div>

<?php
//Strings for the delete confirmation dialog.
$del_con = Yii::t('admin_subjects', 'Are you sure you want to delete this subject?');
$del_title=Yii::t('admin_subjects', 'Delete Confirmation');
 $del=Yii::t('admin_subjects', 'Delete');
 $cancel=Yii::t('admin_subjects', 'Cancel');
   ?>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
         'id' => 'subjects-grid',
         'dataProvider' => $model->search(),
		 'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	     'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
         
         'htmlOptions'=>array('class'=>'grid-view clear'),
          'columns' => array(
          		
		'name',
		'code',
		
		
		'max_weekly_classes',
		/*
		'elective_group_id',
		'is_deleted',
		'created_at',
		'updated_at',
		*/

    array(
                   'class' => 'CButtonColumn',
                    'buttons' => array(
                                                     'subjects_delete' => array(
                                                     'label' => Yii::t('admin_subjects', 'Delete'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/cross.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_del", 'title' => Yii::t('admin_subjects', 'Delete')), // HTML options for the button   tag
                                                      ),
                                                     'subjects_update' => array(
                                                     'label' => Yii::t('admin_subjects', 'Update'), // text label of the button
                                                     'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                     'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/pencil.png', // image URL of the button.   If not set or false, a text link is used
                                                     'options' => array("class" => "fan_update", 'title' => Yii::t('admin_subjects', 'Update')), // HTML options for the    button tag
                                                        ),
                                                     'subjects_view' => array(
                                                      'label' => Yii::t('admin_subjects', 'View'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/properties.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_view", 'title' => Yii::t('admin_subjects', 'View')), // HTML options for the    button tag
                                                        )
                                                    ),
                   'template' => '{subjects_view}{subjects_update}{subjects_delete}',
            ),
    ),
           'afterAjaxUpdate'=>'js:function(id,data){$.bind_crud()}'

                                            ));


   ?>
   </div>

 	
    </div>
    </div></div>
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
