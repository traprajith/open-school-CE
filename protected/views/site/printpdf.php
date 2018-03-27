<?php 
$filename	= "report.pdf";
$file= $this->renderPartial('printpdf_2');
Yii::app()->osPdf->generate($file, $filename, array(),1);
?>


<?php   $array = range(1, 150);?>
<table>
    <?php 
    foreach ($array as $data)
    {
        ?>
    <tr><td><?php echo $data; ?></td><td><?php echo "Data"; ?></td></tr>    
        <?php
    }
    ?>
</table>
<table>
    <tr>
        	<td colspan="1" class="bold-style">HOY's Commen</td>
            <td colspan="6">This is a fairly good grade he has achieved. He is self motivated, 
and always puts his best effort into classroom assignments. If 
Kgosithebe will continue to put forth the effort he has shown this 
year, he will receive a great deal from his schooling.</td>
            </tr>
    
			<tr>
        	<td colspan="1" class="bold-style">Class Teachers Comment</td>
            <td colspan="6">This is good very good. Dummy Contents</td>
            </tr> 
</table>