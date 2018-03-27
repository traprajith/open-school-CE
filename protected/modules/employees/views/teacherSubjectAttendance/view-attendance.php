<style>
#jobDialog_comment{
	height:auto !important;
	
}
.seen-by{    margin: 0px 0px 17px 4px; padding:0px;}
.seen-by li{ list-style:none; display:block; background:url(images/bread-arrow.png) no-repeat left 3px; color:#868686;    padding: 0px 10px;}
.name-icon1{ background:url(images/bread-arrow.png) no-repeat left}
.seen-h4{     border-bottom: 1px solid#ececec;margin-bottom: 5px;}
.seen-h4 h4{ font-size:12px; font-family:Tahoma, Geneva, sans-serif; font-weight:600; color:#444; margin: 0px 0px 5px 4px;}
.ui-dialog .ui-dialog-title {
    float: left;
    color: #585858;
	font-weight: 300;
    background:url(images/info-icon.png) no-repeat left;
	    padding: 3px 31px;
}

.ui-dialog .ui-dialog-titlebar {
    padding: 2px 0px 2px 10px !important;
}

.student-popup-table{
	border-collapse:collapse;
	 margin-top:25px;	
}
.student-popup-table th{
	border: 1px solid#ccc;
	font-size: 13px;
	text-transform: uppercase;
	color: #7d7d2c;
	background-color: #fbfbee;
}
.student-popup-table td{
	border: 1px solid#ccc;
	font-size: 12px;
	text-transform: uppercase;
	#9a9a9a
	padding:8px;
}

.student-popup-table .rsn-table{
	border: 1px solid#ccc;
	font-size: 12px;
	text-transform: uppercase;
	color: #717171;
	padding:15px;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
	'id'=>'jobDialog_view',
	'options'=>array(
		'title'=>Yii::t('app','Absent Reason'),
		'autoOpen'=>true,
		'modal'=>'true',
		'width'=>'auto',
		'height'=>'auto',
		'resizable'=>false,				
   ),
));	

$subwise 	= TeacherSubjectwiseAttentance::model()->findByAttributes(array('id'=>$_REQUEST['id']));
if($subwise!=NULL){
	$employee	= Employees::model()->findByPk($subwise->employee_id);
	$leave 		= LeaveTypes::model()->findByAttributes(array('id'=>$subwise->leavetype_id));
?>
    <div class="view-dialog-popup">
        <table width="400" border="0" cellpadding="0" cellspacing="0" class="student-popup-table">
            <thead>
                <tr>
                    <th width="100px;" align="center"><?php echo Yii::t('app','Teacher'); ?></th>
                    <th align="center"><?php echo $employee->getFullname(); ?></th>
                </tr>
            </thead>
            <tbody>
            	<tr>
                    <td width="100px;" align="center" class="rsn-table"><?php echo Yii::t('app','Leave Type'); ?></td>
                    <td align="center"><?php echo ucfirst($leave->type); ?></td>
                </tr>
                <tr>
                    <td width="100px;" align="center" class="rsn-table"><?php echo Yii::t('app','Reason'); ?></td>
                    <td align="center"><?php echo ucfirst($subwise->reason); ?></td>
                </tr>
            </tbody>
            
        </table>    
    </div>
<?php
}
else{
	echo Yii::t("app","Not found");
}
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>