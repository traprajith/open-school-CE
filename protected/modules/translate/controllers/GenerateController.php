<?php
class GenerateController extends TranslateBaseController
{
	public function actionIndex()
	{
		
		//get langauage if passed
		$language	= TranslateModule::translator()->getLanguage();
		if(isset($_GET['lang']) and $_GET['lang']!=NULL){
            TranslateModule::translator()->setLanguage($_GET['lang']);			//set langaue session
			$language	= $_GET['lang'];
		}
		
		$filter_by	= (isset($_GET["filter_by"]) and $_GET["filter_by"]!=NULL && in_array($_GET["filter_by"], array(1,2,3)))?$_GET["filter_by"]:1;
		$page_size	= (isset($_GET["page_size"]) and $_GET["page_size"]!=NULL && $_GET["page_size"]!=0)?$_GET["page_size"]:20;
		$alphabet	= (isset($_GET["val"]) and $_GET["val"]!=NULL && $_GET["val"]!="")?$_GET["val"]:NULL;
		
		//save translations
		if(isset($_POST["MessageSource"]) && isset($_POST["MessageSource"]['items']) && count($_POST["MessageSource"]['items'])>0 && isset($_POST["MessageSource"]['language']) && $_POST["MessageSource"]['language']!=NULL){
			$items	= $_POST["MessageSource"]['items'];
			foreach($items as $id=>$item){
				$found		= MessageSource::model()->findByPk($id);
				if($found){			
					if(trim($item)==""){		//empty value, they want to clear it
						$criteria	= new CDbCriteria;
						$criteria->condition	= "LOWER(`message`)=:item";
						$criteria->params		= array(":item"=>strtolower($found->message));
						$matches	= MessageSource::model()->findAll($criteria);
						foreach($matches as $match){
							$exists			= Message::model()->findByAttributes(array('id'=>$match->id, 'language'=>$_POST["MessageSource"]['language']));
							if($exists!=NULL){	//translation found in current language, delete it
								$exists->delete();
							}
						}
					}
					else{		//has a translation value
						$criteria	= new CDbCriteria;
						$criteria->condition	= "LOWER(`message`)=:item";					
						//$criteria->addCondition('not exists (select `id` from `os_translated` `m` where `m`.`language`=:lang and `m`.id=`t`.`id`)');
						$criteria->params		= array(":item"=>strtolower($found->message)/*, ":lang"=>$_POST["MessageSource"]['language']*/);
						$matches	= MessageSource::model()->findAll($criteria);
						foreach($matches as $match){
							$exists			= Message::model()->findByAttributes(array('id'=>$match->id, 'language'=>$_POST["MessageSource"]['language']));
							if($exists==NULL){	//translation not found in current language
								$message		= new Message;
								$message->id			= $match->id;
								$message->language		= $_POST["MessageSource"]['language'];				
								$message->translation	= $item;
								$message->save();
							}
							else if($exists->translation!=$item){	//translation already exists, then check if the new $item is differnet from the $exists. if so, save the $item value.
								$exists->translation	= $item;
								$exists->save();
							}
						}
					}				
				}
			}
			
			//pass all parameters
			$this->redirect($_GET);
		}
		
		$criteria	= new CDbCriteria;
		
		//differentiate query condition w.r.t $filter_type
		switch($filter_by){			
			case 2:	//completed translations only
				$criteria->addCondition('exists (select `id` from `os_translated` `m` where `m`.`language`=:lang and `m`.id=`t`.`id`)');         
				$criteria->params[':lang']	= $language;
			break;
			
			case 3:	//missing translations only
				$criteria->addCondition('not exists (select `id` from `os_translated` `m` where `m`.`language`=:lang and `m`.id=`t`.`id`)');         
				$criteria->params[':lang']	= $language;
			break;
		}
		
		//common for all 3 filter types
	   	if($alphabet!=NULL){
			$criteria->addCondition("message LIKE :alphabet");
			$criteria->params[":alphabet"]	= $alphabet."%";
		}
		
		$criteria->distinct = true;
		$criteria->group = 'message';
		$total		= MessageSource::model()->count($criteria);
		$pages 		= new CPagination($total);
        $pages->setPageSize($page_size);
        $pages->applyLimit($criteria);
		$models		= MessageSource::model()->findAll($criteria);
	
		$this->render('index', array(
			'language' => $language,
			'models' => $models,
			'pages' => $pages,
			'item_count'=>$total,
			'page_size'=>$page_size,
			'filter_by'=>$filter_by,
		));
	}
}