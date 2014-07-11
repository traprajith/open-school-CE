<div id="othleft-sidebar">
 <div class="lsearch_bar">
             	<input type="text" value="Search" class="lsearch_bar_left" name="">
                <input type="button" class="sbut" name="">
                <div class="clear"></div>
  </div>          <?php
			function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
{
    return Yii::t($category, $message, $params, $source, $language);
}

			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(
				
						array('label'=>''.'<h1>'.Yii::t('fees','Manage Fees').'</h1>'),
					    
						array('label'=>Yii::t('fees','Fees').'<span>'.Yii::t('employees','Create and Manage Fee collections').'</span>', 'url'=>array('/fees/financeFeeCollections'),'linkOptions'=>array('class'=>'cf_ico'),'active'=> ((Yii::app()->controller->id=='financeFeeCollections'))),
						array('label'=>Yii::t('fees','Collect Fees').' <span>'.Yii::t('fees','Fees collection').'</span>', 'url'=>array('/fees/financeFees'),'linkOptions'=>array('class'=>'fees_ico'),'active'=> ((Yii::app()->controller->id=='financeFees'))),
						
						
						
	
					       
					       
						array('label'=>''.Yii::t('fees','Fee Categories').'<span>'.Yii::t('fees','Create and Manage Fee Categories').'</span>', 'url'=>array('/fees/financeFeeCategories') ,'linkOptions'=>array('class'=>'feca_ico'),
                                   'active'=> (Yii::app()->controller->id=='financeFeeCategories' or Yii::app()->controller->id=='financeFeeParticulars')
					    ),                            
					
					array('label'=>Yii::t('fees','Fees').'<span>'.Yii::t('fees','Manage Fees').'</span>', 'url'=>array('#'),
							'active'=> ((Yii::app()->controller->id=='beterm') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false),'linkOptions'=>array('class'=>'fc_ico')                                                                                           
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

