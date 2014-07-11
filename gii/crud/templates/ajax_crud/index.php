<?php
/**
 * Ajax CRUD Administration Page 
 * The following variables are available in this template:
 * - $this: the CrudCode object
 * @author Spiros Kabasakalis <kabasakalis@gmail.com>,reverbnation.com/spiroskabasakalis
 * @copyright Copyright &copy; 2011 Spiros Kabasakalis
 * @since 1.0
 * @version 1.2
 * @license The MIT License
 */
?>
<?php echo '<?php '; ?>

/**
 * Ajax Crud Administration
 * <?php echo $this->modelClass; ?>
 * index.php view file
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 * @license The MIT License
 */
<?php echo '?>'; ?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo  " \$this->breadcrumbs=array(
	 'Manage ".$label."'
);\n";
echo "?>";


?>

<?php echo '<?php  '; ?>

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
<?php echo '?>'; ?>

<h1><?php echo $this->pluralize($this->modelClass); ?> </h1>

  <?php  echo    Yii::t('admin_'.$this->class2id($this->modelClass),'<p class="left">You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.</p>');?>
<?php echo "<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>"; ?>
<div class="search-form" style="display:none">
<?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n"; ?>
</div><!-- search-form -->

<div class="right">
    <input id="add_<?php echo $this->class2id($this->modelClass); ?>" type="button" style="display:block; clear: both;"
           value="Create <?php echo $this->modelClass; ?>" class="client-val-form button">
</div>

<?php echo "<?php\n";?>
//Strings for the delete confirmation dialog.
$del_con = Yii::t('admin_<?php echo $this->class2id($this->modelClass); ?>', 'Are you sure you want to delete this <?php echo $this->class2id($this->modelClass); ?>?');
$del_title=Yii::t('admin_<?php echo $this->class2id($this->modelClass); ?>', 'Delete Confirmation');
 $del=Yii::t('admin_<?php echo $this->class2id($this->modelClass); ?>', 'Delete');
 $cancel=Yii::t('admin_<?php echo $this->class2id($this->modelClass); ?>', 'Cancel');
   <?php echo '?>'; ?>

<?php echo "<?php\n";?>
    $this->widget('zii.widgets.grid.CGridView', array(
         'id' => '<?php echo $this->class2id($this->modelClass); ?>-grid',
         'dataProvider' => $model->search(),
         'filter' => $model,
         'htmlOptions'=>array('class'=>'grid-view clear'),
          'columns' => array(
          <?php
          $count = 0;
              foreach ($this->tableSchema->columns as $column)
              {
                  if (++$count == 7)
                      echo "\t\t/*\n";
                  echo "\t\t'" . $column->name . "',\n";
              }
              if ($count >= 7)
                  echo "\t\t*/\n";
              ?>

    array(
                   'class' => 'CButtonColumn',
                    'buttons' => array(
                                                     '<?php echo $this->class2id($this->modelClass); ?>_delete' => array(
                                                     'label' => Yii::t('admin_<?php echo $this->class2id($this->modelClass); ?>', 'Delete'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =><?php echo "Yii::app()->request->baseUrl ."?>'/js_plugins/ajaxform/images/icons/cross.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_del", 'title' => Yii::t('admin_<?php echo $this->class2id($this->modelClass); ?>', 'Delete')), // HTML options for the button   tag
                                                      ),
                                                     '<?php echo $this->class2id($this->modelClass); ?>_update' => array(
                                                     'label' => Yii::t('admin_<?php echo $this->class2id($this->modelClass); ?>', 'Update'), // text label of the button
                                                     'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                     'imageUrl' =><?php echo "Yii::app()->request->baseUrl ."?>'/js_plugins/ajaxform/images/icons/pencil.png', // image URL of the button.   If not set or false, a text link is used
                                                     'options' => array("class" => "fan_update", 'title' => Yii::t('admin_<?php echo $this->class2id($this->modelClass); ?>', 'Update')), // HTML options for the    button tag
                                                        ),
                                                     '<?php echo $this->class2id($this->modelClass); ?>_view' => array(
                                                      'label' => Yii::t('admin_<?php echo $this->class2id($this->modelClass); ?>', 'View'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =><?php echo "Yii::app()->request->baseUrl ."?>'/js_plugins/ajaxform/images/icons/properties.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_view", 'title' => Yii::t('admin_<?php echo $this->class2id($this->modelClass); ?>', 'View')), // HTML options for the    button tag
                                                        )
                                                    ),
                   'template' => '{<?php echo $this->class2id($this->modelClass); ?>_view}{<?php echo $this->class2id($this->modelClass); ?>_update}{<?php echo $this->class2id($this->modelClass); ?>_delete}',
            ),
    ),
           'afterAjaxUpdate'=>'js:function(id,data){$.bind_crud()}'

                                            ));


   <?php echo '?>'; ?>

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
                url: "<?php echo '<?php echo '; ?>Yii::app()->request->baseUrl;<?php echo '?>'; ?>/<?php echo $this->class2id($this->modelClass); ?>/returnView",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo '<?php echo '; ?>Yii::app()->request->csrfToken;<?php echo '?>'; ?>"},
                beforeSend : function() {
                    $("#<?php echo $this->class2id($this->modelClass); ?>-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#<?php echo $this->class2id($this->modelClass); ?>-grid").removeClass("ajax-sending");
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
                url: "<?php echo '<?php echo '; ?>Yii::app()->request->baseUrl;<?php echo '?>'; ?>/<?php echo $this->class2id($this->modelClass); ?>/returnForm",
                data:{"update_id":id,"YII_CSRF_TOKEN":"<?php echo '<?php echo '; ?>Yii::app()->request->csrfToken;<?php echo '?>'; ?>"},
                beforeSend : function() {
                    $("#<?php echo $this->class2id($this->modelClass); ?>-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#<?php echo $this->class2id($this->modelClass); ?>-grid").removeClass("ajax-sending");
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
                                $.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {url:'',data:{"<?php echo $this->modelClass; ?>_page":page}});
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
                url: "<?php echo '<?php echo '; ?>Yii::app()->request->baseUrl;<?php echo '?>'; ?>/<?php echo $this->class2id($this->modelClass); ?>/ajax_delete",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo '<?php echo '; ?>Yii::app()->request->csrfToken;<?php echo '?>'; ?>"},
                    beforeSend : function() {
                    $("#<?php echo $this->class2id($this->modelClass); ?>-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#<?php echo $this->class2id($this->modelClass); ?>-grid").removeClass("ajax-sending");
                },
                success: function(data) {
                    var res = jQuery.parseJSON(data);
                     var page=$("li.selected  > a").text();
                    $.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {url:'',data:{"<?php echo $this->modelClass; ?>_page":page}});
                }//success
            });//ajax
        };//end of deletes

        dialogs[id] =
                        $('<div style="text-align:center;"></div>')
                        .html('<?php echo '<?php echo  $del_con; ?>' ?><br><br>' + '<h2 style="color:#999999">ID: ' + id + '</h2>')
                       .dialog(
                        {
                            autoOpen: false,
                            title: '<?php echo '<?php echo  $del_title; ?>' ?>',
                            modal:true,
                            resizable:false,
                            buttons: [
                                {
                                    text: "<?php echo '<?php echo  $del; ?>' ?>",
                                    click: function() {
                                                                      deletes[id]();
                                                                      $(this).dialog("close");
                                                                      }
                                },
                                {
                                   text: "<?php echo '<?php echo $cancel; ?>' ?>",
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

    $('#add_<?php echo $this->class2id($this->modelClass); ?> ').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo '<?php echo '; ?>Yii::app()->request->baseUrl;<?php echo '?>'; ?>/<?php echo $this->class2id($this->modelClass); ?>/returnForm",
            data:{"YII_CSRF_TOKEN":"<?php echo('<?php echo '); ?>Yii::app()->request->csrfToken;<?php echo('?>'); ?>"},
                beforeSend : function() {
                    $("#<?php echo $this->class2id($this->modelClass); ?>-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#<?php echo $this->class2id($this->modelClass); ?>-grid").removeClass("ajax-sending");
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
                                $.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {url:'',data:{"<?php echo $this->modelClass; ?>_page":page}});
                            } //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind


})//document ready
    
</script>
