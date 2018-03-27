<style>
.manage-roll-tbl td{
	 padding:2px 10px;	
}
</style>

<?php $this->breadcrumbs = array(
	//'Rights'=>Rights::getBaseUrl(),
	Yii::t('app', 'Settings')=>array('/configurations'),
	Yii::t('app', 'User Roles'),
	Yii::t('app', 'Manage Roles')=>array('authItem/manageroles'),	
);?>

<h1><?php echo Yii::t('app', 'Manage Roles'); ?></h1>

<div class="formCon">
	<div class="formConInner">
    	<div class="tablebx">
        	 <div class="pagecon">
				<?php 
                  $this->widget('CLinkPager', array(
                  'currentPage'=>$pages->getCurrentPage(),
                  'itemCount'=>$item_count,
                  'pageSize'=>$page_size,
                  'maxButtonCount'=>5,
                  //'nextPageLabel'=>'My text >',
                  'header'=>'',
                'htmlOptions'=>array('class'=>'pages'),
                ));?>
            </div> <!-- End div class="pagecon" --> 
        	<table width="96%" border="0" cellspacing="0" cellpadding="0" class=" manage-roll-tbl">
                <tr class="tablebx_topbg">
                    <td width="10%"><?php echo Yii::t('app','Sl. No.');?></td>	
                    <td width="35%"><?php echo Yii::t('app','User Role');?></td>
					<td width="35%"><?php echo Yii::t('app','Description');?></td>                 
                    <td width="20%"><?php echo Yii::t('app','Action');?></td>
                </tr>
                <?php 
					if(isset($_REQUEST['page']))
					{
						$i=($pages->pageSize*$_REQUEST['page'])-9;
					}
					else
					{
						$i=1;
					}
					$cls="even";
					?>
					
					<?php 
					if($posts!=NULL){
						foreach($posts as $post)
						{
					?>
							<tr class=<?php echo $cls;?>>
								<td  width="10%"><?php echo $i; ?></td>
								<td width="35%" ><?php echo $post->name; ?></td>
		                        <td width="35%"><?php 
										if($post->description==NULL or $post->description==''){
											echo '--'; 
										}else{
											echo $post->description;
										}								
									?></td>
								<td width="20%"><?php if($post->name!='BusSupervisor' and $post->name!='pm'){ echo CHtml::link(Yii::t('app','Edit'),array('editrole','rid'=>$post->id)).' | '.CHtml::link(Yii::t('app','Delete'),"#", array("submit"=>array('deleterole','rid'=>$post->id),'confirm' => Yii::t('app', 'Are you sure you want to delete this role?'), 'csrf'=>true));}else{echo Yii::t('app','Not applicable');}?></td>
                        	</tr>
             		<?php  
             				$i++;
             			}
             		}else{
             			echo '<tr><td colspan="4">'.Yii::t('app','No custom roles created !').'</td></tr>';
             		} 
             		?>   
            </table>    
        </div>
    </div>
</div>   
