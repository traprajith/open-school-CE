<?php 
/**
 * Ajax Crud Administration
 * StoreCategory * index.php view file
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
	 'Manage Store Categories'
);
?>
<?php  
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('store-category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
 <div class="clear"></div> 
 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    <?php $this->renderPartial('/default/left_side');?>
</td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('store','Product Category');?></h1>
  
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div><!-- search-form -->

<div>
           <?php echo CHtml::link('<span>'. Yii::t('store','Create New Category').'</span>', array('#'),array('id'=>'add_store-category','class'=>'cbut')) ?>
       </div>

<?php
$categorydetails=StoreCategory::model()->findAll();
if($categorydetails!=NULL)
{

?>
 <div class="pdtab_Con">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr class="pdtab-h">
<th align="center"><?php echo Yii::t('store','Category ID');?></th>
<th align="center"><?php echo Yii::t('store','Category Name');?></th>
</tr>
<?php foreach($categorydetails as $category)
{
	/*<!--$author=Author::model()->findByAttributes(array('auth_id'=>$book->author));
	$publication=Publication::model()->findByAttributes(array('publication_id'=>$book->publisher));
	*/?>
<tr>
<td align="center"><?php echo $category->ca_id;?></td>
<td align="center"><?php echo $category->ca_name;?></td>
<td align="center"><a href="<?php echo $category->ca_id ?>" class="gredit">Edit</a></td>
<td align="center"><a href="<?php echo $category->ca_id ?>" class="grdel">Delete</a></td>
</tr>
<?php }
				} 
				else
				{
					echo '<tr><td colspan="5">'.Yii::t('library','No data available').'</td></tr>';
				}
				 ?>
</table>
</div>
</div>
<?php
//Strings for the delete confirmation dialog.
$del_con = Yii::t('admin_store-category', 'Are you sure you want to delete this store-category?');
$del_title=Yii::t('admin_store-category', 'Delete Confirmation');
 $del=Yii::t('admin_store-category', 'Delete');
 $cancel=Yii::t('admin_store-category', 'Cancel');
   ?>
<?php
   /* $this->widget('zii.widgets.grid.CGridView', array(
         'id' => 'store-category-grid',
         'dataProvider' => $model->search(),
         'filter' => $model,
         'htmlOptions'=>array('class'=>'grid-view clear'),
          'columns' => array(
          		'ca_id',
		'ca_name',
		'status',

    array(
                   'class' => 'CButtonColumn',
                    'buttons' => array(
                                                     'store-category_delete' => array(
                                                     'label' => Yii::t('admin_store-category', 'Delete'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/cross.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_del", 'title' => Yii::t('admin_store-category', 'Delete')), // HTML options for the button   tag
                                                      ),
                                                     'store-category_update' => array(
                                                     'label' => Yii::t('admin_store-category', 'Update'), // text label of the button
                                                     'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                     'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/pencil.png', // image URL of the button.   If not set or false, a text link is used
                                                     'options' => array("class" => "fan_update", 'title' => Yii::t('admin_store-category', 'Update')), // HTML options for the    button tag
                                                        ),
                                                     'store-category_view' => array(
                                                      'label' => Yii::t('admin_store-category', 'View'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/properties.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_view", 'title' => Yii::t('admin_store-category', 'View')), // HTML options for the    button tag
                                                        )
                                                    ),
                   'template' => '{store-category_view}{store-category_update}{store-category_delete}',
            ),
    ),
           'afterAjaxUpdate'=>'js:function(id,data){$.bind_crud()}'

                                            ));
*/

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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=store/storeCategory/returnView",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#store-category-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#store-category-grid").removeClass("ajax-sending");
                },
                success: function(data) { window.location.reload();
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

    $('.gredit').each(function(index) {
        var id = $(this).attr('href');
        $(this).bind('click', function() {
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=store/storeCategory/returnForm",
                data:{"update_id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#store-category-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#store-category-grid").removeClass("ajax-sending");
                },
                success: function(data) {
                    $.fancybox(data,
                            {    "transitionIn"    :  "elastic",
                                 "transitionOut"  : "elastic",
                                 "speedIn"               : 600,
                                 "speedOut"           : 200,
                                 "overlayShow"    : false,
                                 "hideOnContentClick": false,
                                "afterClose":    function() { window.location.reload();
                                   var page=$("li.selected  > a").text();
                                $.fn.yiiGridView.update('store-category-grid', {url:'',data:{"StoreCategory_page":page}});
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
    $('.grdel').each(function(index) {
        var id = $(this).attr('href');
        deletes[id] = function() {
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=store/storeCategory/ajax_delete",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                    beforeSend : function() {
                    $("#store-category-grid").addClass("ajax-sending");
                },
                complete : function() { 
                    $("#store-category-grid").removeClass("ajax-sending");
                },
                success: function(data) { window.location.reload();
                    var res = jQuery.parseJSON(data);
                     var page=$("li.selected  > a").text();
                    $.fn.yiiGridView.update('store-category-grid', {url:'',data:{"StoreCategory_page":page}});
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

    $('#add_store-category ').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=store/storeCategory/returnForm",
            data:{"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#store-category-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#store-category-grid").removeClass("ajax-sending");
                },
            success: function(data) {
                $.fancybox(data,
                        {    "transitionIn"      : "elastic",
                            "transitionOut"   : "elastic",
                            "speedIn"                : 600,
                            "speedOut"            : 200,
                            "overlayShow"     : false,
                            "hideOnContentClick": false,
                            "afterClose":    function() { window.location.reload();
                                   var page=$("li.selected  > a").text();
                                $.fn.yiiGridView.update('store-category-grid', {url:'',data:{"StoreCategory_page":page}});
                            } //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind


})//document ready
    
</script>
