<div id="event-scrooler">
    <?php
    foreach ($eventsList as $e)
        echo "<div class='list-event'>" . $e["title"] . "</div>";
    ?>
</div>
<br>
<input type='checkbox' id='drop-remove' />
<label for='drop-remove'><?php echo Yii::t('CalModule.fullCal', 'remove after drop'); ?></label>

<?php 
if(!$dialogMode)
    echo '<br>'.CHtml::link(Yii::t('CalModule.fullCal', 'add new'), '#',
                    array('onclick' => "createNewEvent();")).'<br>'; ?>

