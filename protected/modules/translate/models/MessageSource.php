<?php
class MessageSource extends CActiveRecord{
    
    public $language;
        
	static function model($className=__CLASS__){return parent::model($className);}
	function tableName(){return Yii::app()->getMessages()->sourceMessageTable;}

	function rules(){
		return array(
            array('category,message','required'),
			array('category', 'length', 'max'=>32),
			array('message', 'safe'),
			array('id, category, message,language', 'safe', 'on'=>'search'),
		);
	}
    
	function relations(){
		return array(
            'mt'=>array(self::HAS_MANY,'Message','id','joinType'=>'inner join'),
		);
	}
	function attributeLabels(){
		return array(
			'id'=> TranslateModule::t('ID'),
			'category'=> TranslateModule::t('Category'),
			'message'=> TranslateModule::t('Message'),
		);
	}

	function search(){
		$criteria=new CDbCriteria;
        
        $criteria->with=array('mt');
        
        $criteria->addCondition('not exists (select `id` from `'.Message::model()->tableName().'` `m` where `m`.`language`=:lang and `m`.id=`t`.`id`)');
      
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.category',$this->category);
		$criteria->compare('t.message',$this->message);
        
        $criteria->params[':lang']=$this->language;
        
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

}