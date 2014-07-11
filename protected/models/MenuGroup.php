<?php

/**
 * This is the model class for table "menu_group".
 *
 * The followings are the available columns in table 'menu_group':
 * @property integer $id
 * @property string $title
 */
class MenuGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MenuGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Add menu group action
	 * or
	 * Show add menu group form
	 */
	public function add() {
		if (isset($_POST['title'])) {
			$data[MENUGROUP_TITLE] = trim($_POST['title']);
			if (!empty($data[MENUGROUP_TITLE])) {
				if ($this->db->insert(MENUGROUP_TABLE, $data)) {
					$response['status'] = 1;
					$response['id'] = $this->db->Insert_ID();
				} else {
					$response['status'] = 2;
					$response['msg'] = 'Add menu group error.';
				}
			} else {
				$response['status'] = 3;
			}
			header('Content-type: application/json');
			echo json_encode($response);
		} else {
			$this->view('menu_group_add');
		}
	}

	/**
	 * Edit menu group action
	 */
	public function edit() {
		if (isset($_POST['title'])) {
			$id = (int)$_POST['id'];
			$data[MENUGROUP_TITLE] = trim($_POST['title']);
			$response['success'] = false;
			if ($this->db->update(MENUGROUP_TABLE, $data, MENUGROUP_ID . ' = ' . $id)) {
				$response['success'] = true;
			}
			header('Content-type: application/json');
			echo json_encode($response);
		}
	}

	/**
	 * Delete menu group action
	 * This will also delete all menus under this group
	 */
	public function delete() {
		if (isset($_POST['id'])) {
			$id = (int)$_POST['id'];
			if ($id == 1) {
				$response['success'] = false;
				$response['msg'] = 'Cannot delete Group ID = 1';
			} else {
				$sql = sprintf('DELETE FROM %s WHERE %s = %s', MENUGROUP_TABLE, MENUGROUP_ID, $id);
				$delete = $this->db->Execute($sql);
				if ($delete) {
					$sql = sprintf('DELETE FROM %s WHERE %s IN (%s)', MENU_TABLE, MENU_GROUP, $id);
					$this->db->Execute($sql);
					$response['success'] = true;
				} else {
					$response['success'] = false;
				}
			}
			header('Content-type: application/json');
			echo json_encode($response);
		}
	}
}