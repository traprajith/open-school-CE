<div class="<?php echo $this->outerWrapperClass;?>" id="<?php echo $this->outerWrapperId;?>">
	<div class="<?php echo $this->innerWrapperClass;?>" id="<?php echo $this->innerWrapperId;?>">
    	<ul class="<?php echo $this->containerClass;?>" id="<?php echo $this->containerId;?>">
        	<?php
            	if((isset($_REQUEST['val']) and $_REQUEST['val']==NULL) or !isset($_REQUEST['val'])){
					echo '<li class="'.$this->activeClass.'">'.CHtml::link(Yii::t('app', 'All'), 'javascript:void(0);', array()).'</li>';
				}
				else{
					echo '<li>'.CHtml::link(Yii::t('app', 'All'), $this->url.'&val=', array()).'</li>';
				}
				//letters
				$letters	= $this->letters;
				
				foreach ($letters as $letter) {
					if(isset($_REQUEST['val']) and strtolower($_REQUEST['val'])==strtolower($letter)){
						echo '<li class="'.$this->activeClass.'">'.CHtml::link($letter, 'javascript:void(0);', array('class'=>'vtip')).'</li>';
					}
					else{
						echo '<li>'.CHtml::link($letter, $this->url.'&val='.$letter, array('class'=>'vtip')).'</li>';
					}
				}
			?>
        </ul>
  	</div>
</div>