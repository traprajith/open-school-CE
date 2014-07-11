<?php 
/**
 * Ajax Crud Administration
 * StoreProduct * index.php view file
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
	 'Manage Store Products'
);
?>
<?php  
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('store-product-grid', {
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
    

<h1><?php echo Yii::t('store','Create Store Product');?></h1>
  
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div><!-- search-form -->

<div>
           <?php echo CHtml::link('<span>'. Yii::t('store','Create New Product').'</span>', array('#'),array('id'=>'add_store-product','class'=>'cbut')) ?>
            
   
      </div>
<?php
$productdetails=StoreProduct::model()->findAll();
if($productdetails!=NULL)
{

?>
 <div class="pdtab_Con">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr class="pdtab-h">
<th align="center"><?php echo Yii::t('store','Product Name');?></th>
<th align="center"><?php echo Yii::t('store','Product Brand');?></th>
<th align="center"><?php echo Yii::t('store','Product Quantity');?></th>
<th align="center"><?php echo Yii::t('store','Price');?></th>

</tr>
<?php foreach($productdetails as $product)
{
	/*<!--$author=Author::model()->findByAttributes(array('auth_id'=>$book->author));
	$publication=Publication::model()->findByAttributes(array('publication_id'=>$book->publisher));
	*/?>
<tr>

<td align="center"><?php echo $product->product_name;?></td>
<td align="center"><?php echo $product->product_brand;?></td>
<td align="center"><?php echo $product->product_quantity;?></td>
<td align="center"><?php echo $product->price;?></td>
<td align="center"><a href="<?php echo $product->id ?>" class="gredit">Edit</a></td>
<td align="center"><a href="<?php echo $product->id ?>" class="grdel">Delete</a></td>
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
$del_con = Yii::t('admin_store-product', 'Are you sure you want to delete this store-product?');
$del_title=Yii::t('admin_store-product', 'Delete Confirmation');
 $del=Yii::t('admin_store-product', 'Delete');
 $cancel=Yii::t('admin_store-product', 'Cancel');
   ?>
<?php
   /* $this->widget('zii.widgets.grid.CGridView', array(
         'id' => 'store-product-grid',
         'dataProvider' => $model->search(),
         'filter' => $model,
         'htmlOptions'=>array('class'=>'grid-view clear'),
          'columns' => array(
          		'id',
		'product_name',
		'product_brand',
		'product_quantity',
		'c_id',
		'price',
		/*
		'status',
		*/

   /* array(
                   'class' => 'CButtonColumn',
                    'buttons' => array(
                                                     'store-product_delete' => array(
                                                     'label' => Yii::t('admin_store-product', 'Delete'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/cross.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_del", 'title' => Yii::t('admin_store-product', 'Delete')), // HTML options for the button   tag
                                                      ),
                                                     'store-product_update' => array(
                                                     'label' => Yii::t('admin_store-product', 'Update'), // text label of the button
                                                     'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                     'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/pencil.png', // image URL of the button.   If not set or false, a text link is used
                                                     'options' => array("class" => "fan_update", 'title' => Yii::t('admin_store-product', 'Update')), // HTML options for the    button tag
                                                        ),
                                                     'store-product_view' => array(
                                                      'label' => Yii::t('admin_store-product', 'View'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/properties.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_view", 'title' => Yii::t('admin_store-product', 'View')), // HTML options for the    button tag
                                                        )
                                                    ),
                   'template' => '{store-product_view}{store-product_update}{store-product_delete}',
            ),
    ),
           'afterAjaxUpdate'=>'js:function(id,data){$.bind_crud()}'

                                            ));*/


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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=store/storeProducts/returnView",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#store-product-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#store-product-grid").removeClass("ajax-sending");
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

    $('.gredit').each(function(index) {
        var id = $(this).attr('href');
        $(this).bind('click', function() {
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=store/storeProducts/returnForm",
                data:{"update_id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#store-product-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#store-product-grid").removeClass("ajax-sending");
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
                                $.fn.yiiGridView.update('store-product-grid', {url:'',data:{"StoreProduct_page":page}});
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
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=store/storeProducts/ajax_delete",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                    beforeSend : function() {
                    $("#store-product-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#store-product-grid").removeClass("ajax-sending");
                },
                success: function(data) { window.location.reload();
                    var res = jQuery.parseJSON(data);
                     var page=$("li.selected  > a").text();
                    $.fn.yiiGridView.update('store-product-grid', {url:'',data:{"StoreProduct_page":page}});
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

    $('#add_store-product ').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=store/storeProducts/returnForm",
            data:{"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#store-product-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#store-product-grid").removeClass("ajax-sending");
                },
            success: function(data) {
                $.fancybox(data,
                        {    "transitionIn"      : "elastic",
                            "transitionOut"   : "elastic",
                            "speedIn"                : 600,
                            "speedOut"            : 200,
                            "overlayShow"     : false,
                            "hideOnContentClick": false,
                            "afterClose":    function() {window.location.reload();
                                   var page=$("li.selected  > a").text();
                                $.fn.yiiGridView.update('store-product-grid', {url:'',data:{"StoreProduct_page":page}});
                            } //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind


})//document ready
    
</script>
