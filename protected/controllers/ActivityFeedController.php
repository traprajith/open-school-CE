<?php

class ActivityFeedController extends RController
{
	public function actionIndex()
	{
		
		$criteria = new CDbCriteria;
		$criteria->order = 'id DESC';
		
		if($_GET['find'])
		{
			
			
			if($_GET['activity_type']!=NULL and $_GET['start_date']==NULL and $_GET['end_date']==NULL)
			{
				$type = $_GET['activity_type'];
				$criteria->condition='activity_type LIKE :type';
				$criteria->params[':type'] = $type;
			}
			elseif($_GET['activity_type']==NULL and $_GET['start_date']!=NULL and $_GET['end_date']!=NULL)
			{
				$start_date = date('Y-m-d',strtotime($_GET['start_date']));
				$end_date = date('Y-m-d',strtotime($_GET['end_date']));
				if($start_date == $end_date)
				{
					$criteria->condition = 'DATE(activity_time) LIKE :date';
					$criteria->params[':date'] = $start_date;
				}
				else
				{
					$criteria->condition = 'DATE(activity_time) BETWEEN :start_date AND :end_date';
					$criteria->params[':start_date'] = $start_date;
					$criteria->params[':end_date'] = $end_date;
				}
			}
			elseif($_GET['activity_type']==NULL and $_GET['start_date']!=NULL and $_GET['end_date']==NULL)
			{
				$start_date = date('Y-m-d',strtotime($_GET['start_date']));
				$criteria->condition = 'DATE(activity_time) >= :date';
				$criteria->params[':date'] = $start_date;
			}
			elseif($_GET['activity_type']==NULL and $_GET['start_date']==NULL and $_GET['end_date']!=NULL)
			{
				$end_date = date('Y-m-d',strtotime($_GET['end_date']));
				$criteria->condition = 'DATE(activity_time) <= :date';
				$criteria->params[':date'] = $end_date;
			}
			elseif($_GET['activity_type']!=NULL and $_GET['start_date']!=NULL and $_GET['end_date']!=NULL)
			{
				$type = $_GET['activity_type'];
				$start_date = date('Y-m-d',strtotime($_GET['start_date']));
				$end_date = date('Y-m-d',strtotime($_GET['end_date']));
				
				$criteria->condition='activity_type LIKE :type';
				$criteria->params[':type'] = $type;
				
				if($start_date == $end_date)
				{
					$criteria->condition = $criteria->condition.' AND DATE(activity_time) LIKE :date';
					$criteria->params[':date'] = $start_date;
				}
				else
				{
					$criteria->condition = $criteria->condition.' AND DATE(activity_time) BETWEEN :start_date AND :end_date';
					$criteria->params[':start_date'] = $start_date;
					$criteria->params[':end_date'] = $end_date;
				}
			}
		}
				
		$total = ActivityFeed::model()->count($criteria); // Count feeds
		$pages = new CPagination($total);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);
		
		$feeds = ActivityFeed::model()->findAll($criteria); // Get feeds
		/*echo $pages->getCurrentPage().'-'.$pages->getPageCount().'---'.count($feeds).'....';
		echo $total;exit;*/
		$this->render('index',array(
		'feeds'=>$feeds,
		'type'=>$type,
		'start_date'=>$_GET['start_date'],
		'end_date'=>$_GET['end_date'],
		'pages'=>$pages,
		'criteria'=>$criteria,
		));
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}


	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	
}