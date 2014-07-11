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


class RegisterForm extends CFormModel {
    public $schoolname;
    public $address;
    public $country;
    public $state;
    public $zip_postal_code;
    public $url;
	public $email;
	public $phone;

    /**
     * Returns the validation rules for attributes.
     *
     * This method should be overridden to declare validation rules.
     * Each rule is an array with the following structure:
     * <pre>
     * array('attribute list', 'validator name', 'on'=>'scenario name', ...validation parameters...)
     * </pre>
     * where
     * <ul>
     * <li>attribute list: specifies the attributes (separated by commas) to be validated;</li>
     * <li>validator name: specifies the validator to be used. It can be the name of a model class
     *   method, the name of a built-in validator, or a validator class (or its path alias).
     *   A validation method must have the following signature:
     * <pre>
     * // $params refers to validation parameters given in the rule
     * function validatorName($attribute,$params)
     * </pre>
     *   A built-in validator refers to one of the validators declared in {@link CValidator::builtInValidators}.
     *   And a validator class is a class extending {@link CValidator}.</li>
     * <li>on: this specifies the scenarios when the validation rule should be performed.
     *   Separate different scenarios with commas. If this option is not set, the rule
     *   will be applied in any scenario. Please see {@link scenario} for more details about this option.</li>
     * <li>additional parameters are used to initialize the corresponding validator properties.
     *   Please refer to individal validator class API for possible properties.</li>
     * </ul>
     *
     * The following are some examples:
     * <pre>
     * array(
     *     array('username', 'required'),
     *     array('username', 'length', 'min'=>3, 'max'=>12),
     *     array('password', 'compare', 'compareAttribute'=>'password2', 'on'=>'register'),
     *     array('password', 'authenticate', 'on'=>'login'),
     * );
     * </pre>
     *
     * Note, in order to inherit rules defined in the parent class, a child class needs to
     * merge the parent rules with child rules using functions like array_merge().
     *
     * @return array validation rules to be applied when {@link validate()} is called.
     * @see scenario
     */
    public function rules() {
        return array(
            array('schoolname, address, state, country, zip_postal_code, url, email,phone', 'required'),
			array('email', 'email'),
			array('zip_postal_code , phone', 'numerical', 'integerOnly'=>true),
            
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
			'schoolname'=>'School Name',
            'address'=>'Address',
            'State'=>'state',
            'Country'=>'country',
            'zip_postal_code'=>'Zip/Postal Code',
			'url'=>'Application Url',
			'email'=>'Admin Email',
			'phone'=>'Admin Phone Number',
        );
    }
}