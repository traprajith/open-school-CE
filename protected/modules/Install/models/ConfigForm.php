<?php
/**
-------------------------
GNU GPL COPYRIGHT NOTICES
-------------------------
This file is part of Open-School.

Open-School is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Open-School is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Open-School.  If not, see <http://www.gnu.org/licenses/>.*/

/**
 * $Id$
 *
 * @author Open-School team <contact@Open-School.org>
 * @link http://www.Open-School.org/
 * @copyright Copyright &copy; 2009-2012 wiwo inc.
 * @Matthew George,@Rajith Ramachandran,@Arun Kumar,
 * @Anupama,@Laijesh V Kumar.
 * @license http://www.Open-School.org/
 */


class ConfigForm extends CFormModel {
    public $baseUrl='http://';
    public $host="localhost";
    public $port="3306";
    public $dbName;
    public $username="root";
    public $password;
            
    public function rules() {
        return array(
            array('baseUrl, host, port, dbName, username', 'required'),
            array('port', 'numerical', 'integerOnly'=>true),
//            array('baseUrl','url'),
        );
    }
    
    /**
     * Returns the attribute labels.
     * Attribute labels are mainly used in error messages of validation.
     * By default an attribute label is generated using {@link generateAttributeLabel}.
     * This method allows you to explicitly specify attribute labels.
     *
     * Note, in order to inherit labels defined in the parent class, a child class needs to
     * merge the parent labels with child labels using functions like array_merge().
     *
     * @return array attribute labels (name=>label)
     * @see generateAttributeLabel
     */
    public function attributeLabels() {
        return array(
            'baseUrl'=>'Base Url',
            'host'=>'Database Host',
            'port'=>'Port',
            'dbName'=>'Database Name',
            'username'=>'User Name',
            'password'=>'Password',
        );
    }
    
    /**
    * check connection to database available
    * 
    * @return boolean
    */
    public function checkConnection() {
        $valid = true;
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbName}";
            $connection=new CDbConnection($dsn, $this->username, $this->password);
            $connection->active=true;
        } catch (Exception $e){
            $valid = false;
        }
        
        return $valid;
    }
}