<script>
function details(id)
{
	
	var rr= document.getElementById("dropwin"+id).style.display;
	
	 if(document.getElementById("dropwin"+id).style.display=="block")
	 {
		 document.getElementById("dropwin"+id).style.display="none"; 
		 $("#openbutton"+id).removeClass('open');
		  $("#openbutton"+id).addClass('view');
	 }
	 else if(  document.getElementById("dropwin"+id).style.display=="none")
	 {
		 document.getElementById("dropwin"+id).style.display="block"; 
		   $("#openbutton"+id).removeClass('view');
		  $("#openbutton"+id).addClass('open');
	 }
	 

}



function rowdelete(id)
{
	 $("#batchrow"+id).fadeOut("slow");
}

</script>

<!--<script type="text/javascript">
	$(document).ready(function() {
		$('#search_fld').focus(function(){
			$(this).val('');
		});
	});
</script>-->

<?php 
  $posts=Courses::model()->findAll("is_deleted 	=:x", array(':x'=>0));
  $num=Batches::model()->findAll("is_deleted 	=:x", array(':x'=>0));
   ?>
<div class="panel-wrapper">
				<h2 class="title">Batches</h2>
                <h2 class="caption"><?php echo count($num) ?> Records</h2>
                <?php /*?><div class="sd_search_area">
    					<input name="" type="text" id="search_fld" class="sd_search" value="Search Here" />
        				<input name="" type="button" class="sd_but" /> 
       					 <div class="clear"></div>
        			</div><?php */?>
				
 
<?php if($posts!=NULL)
{?>

<div >
<div class="clear"></div>
<br />
 
 <?php 
  $posts=Courses::model()->findAll("is_deleted 	=:x", array(':x'=>0));

 ?>
 
    <div class="mcb_Con" style="width:510px;">

<?php foreach($posts as $posts_1)
{ ?> 
        <?php
			$course=Courses::model()->findByAttributes(array('id'=>$posts_1->id,'is_deleted'=>0));
		   $batch=Batches::model()->findAll("course_id=:x AND is_deleted=:y", array(':x'=>$posts_1->id,':y'=>0));
		 ?>
<div class="mcbrow" id="jobDialog1" style="width:510px;">
	<ul>
    	<li class="gtcol1" onclick="details('<?php echo $posts_1->id;?>');" style="cursor:pointer;width:85%; padding:8px 0px 8px 10px;">
       
		<?php echo $posts_1->course_name; ?>
        <span><?php echo count($batch); ?> - Batch(es)</span>
        </li>
        
        <li class="col5"><a href="#" id="openbutton<?php echo $posts_1->id;?>" onclick="details('<?php echo $posts_1->id;?>');" class="open"></a></li>
    </ul>
 <div class="clear"></div>
</div>
<!-- Batch Details -->
        
         <!--class="cbtablebx"-->
<div class="pdtab_Con" id="dropwin<?php echo $posts_1->id; ?>" style="display: none; padding:0px 0px 10px 0px; ">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tbody>
          <!--class="cbtablebx_topbg"  class="sub_act"-->
		  <tr class="pdtab-h">
			<td align="center">Batch Name</td>
            <td align="center">No.of Students</td>
			<td align="center">Start Date</td>
			<td align="center">End Date</td>
			
		  </tr>
          <?php 
		  foreach($batch as $batch_1)
				{
					echo '<tr id="batchrow'.$batch_1->id.'">';
					if(isset($_REQUEST['widget']) and isset($_REQUEST['rurl']) and $_REQUEST['rurl']!=NULL)
                    {
					echo '<td style="text-align:left; padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array($_REQUEST['rurl'],'id'=>$batch_1->id)).'</td>';
					
					
					}
					else
					{
					echo '<td style="text-align:left; padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array('courses/batches/batchstudents','id'=>$batch_1->id)).'</td>';
					
						
					}
					echo '<td align="center">'.count(Students::model()->findAllByAttributes(array('batch_id'=>$batch_1->id))).'</td>';
					echo '<td align="center">'.$batch_1->start_date.'</td>';
					echo '<td align="center">'.$batch_1->end_date.'</td>';
					
					echo '</tr>';
					
				}
			   ?>
         </tbody>
        </table>
		</div>
<?php } ?>        

</div>

</div>
<?php }
else
{ ?>
<link rel="stylesheet" type="text/css" href="/openschool/css/style.css" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php //$this->renderPartial('left_side');?>
    
    </td>
    <td valign="top">
    <div style="padding:20px 20px">
        <div class="yellow_bx" style="background-image:none;width:450px;padding-bottom:45px;">
            <div class="y_bx_head" style="width:450px;">
                It appears that this is the first time that you are using this Open-School Setup. For any new installation we recommend that you configure the following:
            </div>
            <div class="y_bx_list" style="width:650px;">
                <h1><?php echo CHtml::link('Add New Course &amp; Batch',array('courses/courses/create')) ?></h1>
            </div>         
        </div>
 	</div>
    
    
    </td>
  </tr>
</table>

<?php } ?>

			</div>