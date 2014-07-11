<div id="othleft-sidebar">
             <!--<div class="lsearch_bar">
             	<input type="text" value="Search" class="lsearch_bar_left" name="">
                <input type="button" class="sbut" name="">
                <div class="clear"></div>
  </div>-->       
                    <?php
				
			
			function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
{
    return $message;
}

			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(
			array('label'=>''.'<h1>'.Yii::t('store','Manage Product').'</h1>'),  
			array('label'=>''.Yii::t('store','Products').'<span>'.Yii::t('store','Create and Manage Products').'</span>', 'url'=>array('/store/storeProducts') ,'linkOptions'=>array('class'=>'lbook_ico'),
                                   'active'=> (Yii::app()->controller->id=='storeProducts')
					    ),
					array('label'=>''.Yii::t('store','Search Product').'<span>'.Yii::t('store','Search all products').'</span>', 'url'=>array('/store/productSearch') ,'linkOptions'=>array('class'=>'sbook_ico'),
                                   'active'=> (Yii::app()->controller->id=='storeProducts')
					    ),
						        
						
						              
					array('label'=>''.'<h1>'.Yii::t('store','Product').'</h1>'), 
					array('label'=>''.Yii::t('store','Buy Product').'<span>'.Yii::t('store','Issue Product Here').'</span>', 'url'=>array('/store/BorrowBook/create') ,'linkOptions'=>array('class'=>'bbook_ico'),
                                   'active'=> (Yii::app()->controller->id=='buyProduct' and Yii::app()->controller->action->id=='create')
					    ),  
						  
						 
						
						array('label'=>''.'<h1>'.Yii::t('store','Settings').'</h1>'),  
						array('label'=>''.Yii::t('store','Add Product Category').'<span>'.Yii::t('store','Create and Manage Product Category').'</span>', 'url'=>array('/store/storeCategory') ,'linkOptions'=>array('class'=>'acbook_ico'),
                                   'active'=> (Yii::app()->controller->id=='storeCategory')
					    ), 
						array('label'=>''.Yii::t('store','View Student Details').'<span>'.Yii::t('store','All Student Details').'</span>', 'url'=>array('/store/buyProduct/studentdetails') ,'linkOptions'=>array('class'=>'vsd_ico'),
                                   'active'=> (Yii::app()->controller->id=='buyProduct' and Yii::app()->controller->action->id=='studentdetails')
					    ), 
						
				),
			)); ?>
		
		</div>
        <script type="text/javascript">

	$(document).ready(function () {
            //Hide the second level menu
            $('#othleft-sidebar ul li ul').hide();            
            //Show the second level menu if an item inside it active
            $('li.list_active').parent("ul").show();
            
            $('#othleft-sidebar').children('ul').children('li').children('a').click(function () {                    
                
                 if($(this).parent().children('ul').length>0){                  
                    $(this).parent().children('ul').toggle();    
                 }
                 
            });
          
            
        });

    </script>