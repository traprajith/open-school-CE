<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $url
 * @property string $class
 * @property integer $position
 * @property integer $group_id
 */
class Menu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public $link;
	public $result;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, position, group_id', 'numerical', 'integerOnly'=>true),
			array('title, url, class', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, title, url, class, position, group_id', 'safe', 'on'=>'search'),
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
			'parent_id' => 'Parent',
			'title' => 'Title',
			'url' => 'Url',
			'class' => 'Class',
			'position' => 'Position',
			'group_id' => 'Group',
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

		$criteria->compare('id',Menu::model()->id);
		$criteria->compare('parent_id',Menu::model()->parent_id);
		$criteria->compare('title',Menu::model()->title,true);
		$criteria->compare('url',Menu::model()->url,true);
		$criteria->compare('class',Menu::model()->class,true);
		$criteria->compare('position',Menu::model()->position);
		$criteria->compare('group_id',Menu::model()->group_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Show menu manager
	 */
	public function index() {
		$group_id = 1;
		if (isset($_GET['group_id'])) {
			$group_id = (int)$_GET['group_id'];
		}
		$menu = Menu::model()->get_menu($group_id);
		$data['menu_ul'] = '<ul id="easymm"></ul>';
		if ($menu) {

			include _DOC_ROOT . 'includes/tree.php';
			$tree = new Tree;

			foreach ($menu as $row) {
				$tree->add_row(
					$row[MENU_ID],
					$row[MENU_PARENT],
					' id="menu-'.$row[MENU_ID].'" class="sortable"',
					Menu::model()->get_label($row)
				);
			}

			$data['menu_ul'] = $tree->generate_list('id="easymm"');
		}
		$data['group_id'] = $group_id;
		$data['group_title'] = Menu::model()->get_menu_group_title($group_id);
		$data['menu_groups'] = Menu::model()->get_menu_groups();
		Menu::model()->view('menu', $data);
	}

	/**
	 * Add menu action
	 * For use with ajax
	 * Return json data
	 */
	public function add() {
		if (isset($_POST['title'])) {
			$data[MENU_TITLE] = trim($_POST['title']);
			if (!empty($data[MENU_TITLE])) {
				$data[MENU_URL] = $_POST['url'];
				$data[MENU_CLASS] = $_POST['class'];
				$data[MENU_GROUP] = $_POST['group_id'];
				$data[MENU_POSITION] = Menu::model()->get_last_position($_POST['group_id']) + 1;
				if (Menu::model()->db->insert(MENU_TABLE, $data)) {
					$data[MENU_ID] = Menu::model()->db->Insert_ID();
					$response['status'] = 1;
					$li_id = 'menu-'.$data[MENU_ID];
					$response['li'] = '<li id="'.$li_id.'" class="sortable">'.Menu::model()->get_label($data).'</li>';
					$response['li_id'] = $li_id;
				} else {
					$response['status'] = 2;
					$response['msg'] = 'Add menu error.';
				}
			} else {
				$response['status'] = 3;
			}
			header('Content-type: application/json');
			echo json_encode($response);
		}
	}

	/**
	 * Show edit menu form
	 */
	public function edit() {
		if (isset($_GET['id'])) {
			$id = (int)$_GET['id'];
			$data['row'] = Menu::model()->get_row($id);
			Menu::model()->view('menu_edit', $data);
		}
	}

	/**
	 * Save menu
	 * Action for edit menu
	 * return json data
	 */
	public function save() {
		if (isset($_POST['title'])) {
			$data[MENU_TITLE] = trim($_POST['title']);
			if (!empty($data[MENU_TITLE])) {
				$data[MENU_ID] = $_POST['menu_id'];
				$data[MENU_URL] = $_POST['url'];
				$data[MENU_CLASS] = $_POST['class'];
				if (Menu::model()->db->update(MENU_TABLE, $data, MENU_ID . ' = ' . $data[MENU_ID])) {
					$response['status'] = 1;
					$d['title'] = $data[MENU_TITLE];
					$d['url'] = $data[MENU_URL];
					$d['klass'] = $data[MENU_CLASS]; //klass instead of class because of an error in js
					$response['menu'] = $d;
				} else {
					$response['status'] = 2;
					$response['msg'] = 'Edit menu error.';
				}
			} else {
				$response['status'] = 3;
			}
			header('Content-type: application/json');
			echo json_encode($response);
		}
	}

	/**
	 * Delete menu action
	 * Also delete all submenus under current menu
	 * return json data
	 */
	public function delete() {
		if (isset($_POST['id'])) {
			$id = (int)$_POST['id'];

			Menu::model()->get_descendants($id);
			if (!empty(Menu::model()->ids)) {
				$ids = implode(', ', Menu::model()->ids);
				$id = "$id, $ids";
			}

			$sql = sprintf('DELETE FROM %s WHERE %s IN (%s)', MENU_TABLE, MENU_ID, $id);
			$delete = Menu::model()->db->Execute($sql);
			if ($delete) {
				$response['success'] = true;
			} else {
				$response['success'] = false;
			}
			header('Content-type: application/json');
			echo json_encode($response);
		}
	}

	/**
	 * Save menu position
	 */
	public function save_position() {
		if (isset($_POST['easymm'])) {
			$easymm = $_POST['easymm'];
			Menu::model()->update_position(0, $easymm);
		}
	}

	/**
	 * Recursive function for save menu position
	 */
	public function update_position($parent, $children) {
		$i = 1;
		foreach ($children as $k => $v) {
			$id = (int)$children[$k]['id'];
			$data[MENU_PARENT] = $parent;
			$data[MENU_POSITION] = $i;
			Menu::model()->db->update(MENU_TABLE, $data, MENU_ID . ' = ' . $id);
			if (isset($children[$k]['children'][0])) {
				Menu::model()->update_position($id, $children[$k]['children']);
			}
			$i++;
		}
	}

	/**
	 * Get items from menu table
	 *
	 * @param int $group_id
	 * @return array
	 */
	public function get_menu($group_id) {
		
		 $connection = Yii::app()->db;
		
		$sql = sprintf(
			'SELECT * FROM %s WHERE %s = %s ORDER BY %s, %s',
			MENU_TABLE,
			MENU_GROUP,
			$group_id,
			MENU_PARENT,
			MENU_POSITION
		);
		
		$command = $connection->createCommand($sql);
		$users= $command->queryAll();
		return $users;
	}

	/**
	 * Get one item from menu table
	 *
	 * @param unknown_type $id
	 * @return unknown
	 */
	public function get_row($id) {
		$sql = sprintf(
			'SELECT * FROM %s WHERE %s = %s',
			MENU_TABLE,
			MENU_ID,
			$id
		);
		return Menu::model()->db->GetRow($sql);
	}

	/**
	 * Recursive method
	 * Get all descendant ids from current id
	 * save to Menu::model()->ids
	 *
	 * @param int $id
	 */
	public function get_descendants($id) {
		$sql = sprintf(
			'SELECT %s FROM %s WHERE %s = %s',
			MENU_ID,
			MENU_TABLE,
			MENU_PARENT,
			$id
		);
		$data = Menu::model()->db->GetCol($sql);

		if (!empty($data)) {
			foreach ($data as $v) {
				Menu::model()->ids[] = $v;
				Menu::model()->get_descendants($v);
			}
		}
	}

	/**
	 * Get the highest position number
	 *
	 * @param int $group_id
	 * @return string
	 */
	public function get_last_position($group_id) {
		$connection = Yii::app()->db;
		$sql = sprintf(
			'SELECT MAX(%s) FROM %s WHERE %s = %s',
			MENU_POSITION,
			MENU_TABLE,
			MENU_GROUP,
			$group_id
		);
		$command = $connection->createCommand($sql);
		$users= $command->queryAll();
		
		$data = '';
		if ($users) {
			
			foreach($users as $sql1)
			{
				
			$data = $sql1['MAX(position)'];
			}
		}
		return $data;
		
		//return Menu::model()->GetOne($users);
	}

	/**
	 * Get all items in menu group table
	 *
	 * @return array
	 */
	public function get_menu_groups() {
		 $connection = Yii::app()->db;
		$sql = sprintf(
			'SELECT %s, %s FROM %s',
			MENUGROUP_ID,
			MENUGROUP_TITLE,
			MENUGROUP_TABLE
		);
		$command = $connection->createCommand($sql);
		$users= $command->queryAll();
		return $users;
	}

	/**
	 * Get menu group title
	 *
	 * @param int $group_id
	 * @return string
	 */
	public function get_menu_group_title($group_id) {
		$connection = Yii::app()->db;
		$sql = sprintf(
			'SELECT %s FROM %s WHERE %s = %s',
			MENUGROUP_TITLE,
			MENUGROUP_TABLE,
			MENUGROUP_ID,
			$group_id
		);
		$command = $connection->createCommand($sql);
		$users= $command->queryAll();
		return $users;
	}

	/**
	 * Get label for list item in menu manager
	 * this is the content inside each <li>
	 *
	 * @param array $row
	 * @return string
	 */
	public function get_label($row) {
		
		$label =
			'<div class="ns-row">' .
				'<div class="ns-title">'.$row[MENU_TITLE].'</div>' .
				'<div class="ns-url">'.$row[MENU_URL].'</div>' .
				'<div class="ns-class">'.$row[MENU_CLASS].'</div>' .
				'<div class="ns-actions">' .
					'<a href="#" class="edit-menu" title="Edit Menu">' .
						'<img src="'._BASE_URL.'templates/images/edit.png" alt="Edit">' .
					'</a>' .
					'<a href="#" class="delete-menu">' .
						'<img src="'._BASE_URL.'templates/images/cross.png" alt="Delete">' .
					'</a>' .
					'<input type="hidden" name="menu_id" value="'.$row[MENU_ID].'">' .
				'</div>' .
			'</div>';
		return $label;
	}
	
	public function site_url($url = '') {
	if (!empty($url)) {
		return Yii::app()->request->baseUrl . 'index.php?r=' . $url;
	}
	return Yii::app()->request->baseUrl;
    }
	
	public function update($table_name, $data, $where) {
		return Menu::model()->AutoExecute($table_name, $data, 'UPDATE', $where);
	}
	
	public function Execute($sql) {
		Menu::model()->result = mysql_query($sql, Menu::model()->link);
		if (!Menu::model()->result) {
			die('Invalid query: ' . mysql_error());
		}
		return Menu::model()->result;
	}
	
	public function AutoExecute($table_name, $data, $action='INSERT', $where='') {
		switch ($action) {
			case 'INSERT': $sql = 'INSERT INTO '; break;
			case 'UPDATE': $sql = 'UPDATE '; break;
		}
		$sql .= $table_name;
		$sql .= ' SET ';
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$value = $value[0];
			} else {
				$value = Menu::model()->quote_smart($value);
			}
			$d[] = "$key = $value";
		}
		$sql .= implode(', ', $d);
		if ($action == 'UPDATE') {
			$sql .= " WHERE $where";
		}

		Menu::model()->Execute($sql);
		return Menu::model()->result;
	}
	public function insert($table_name, $data) {
		return Menu::model()->AutoExecute($table_name, $data, 'INSERT');
	}
	
	public function GetOne($sql) 
	{
		$data = '';
		if ($sql) {
			
			foreach($sql as $sql1)
			{
				
			$data = $sql1['MAX(position)'];
			}
		}
		return $data;
	}
	
	public function quote_smart($value) {
		// Stripslashes
		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		}
		// Quote if not a number or a numeric string
		if (!is_numeric($value)) {
			$value = "'" . mysql_real_escape_string($value) . "'";
		}
		return $value;
	}
}