<?php

/**
 * This is the model class for table "jury".
 *
 * The followings are the available columns in table 'jury':
 * @property integer $id
 * @property string $name
 * @property string $login
 * @property string $pass
 * @property string $lastAccess
 * @property string $lang
 * @property integer $active
 * @property integer $deleted
 * @property integer $ordering
 * @property string $cIpAddress
 * @property string $cTime
 * @property integer $cUserId
 *
 * The followings are the available model relations:
 * @property Application[] $applications
 */
class Jury extends BActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Jury the static model class
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
		return 'jury';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'required'),
			array('active, deleted, ordering, cUserId', 'numerical', 'integerOnly'=>true),
			array('name, login, pass, cIpAddress', 'length', 'max'=>45),
			array('lang', 'length', 'max'=>12),
			array('lastAccess, cTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, login, pass, lastAccess, lang, active, deleted, ordering, cIpAddress, cTime, cUserId', 'safe', 'on'=>'search'),
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
			'applications' => array(self::MANY_MANY, 'Application', 'jury_has_application(jury_idjury, application_idapplication)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'login' => 'Login',
			'pass' => 'Pass',
			'lastAccess' => 'Last Access',
			'lang' => 'Lang',
			'active' => 'Active',
			'deleted' => 'Deleted',
			'ordering' => 'Ordering',
			'cIpAddress' => 'C Ip Address',
			'cTime' => 'C Time',
			'cUserId' => 'C User',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('lastAccess',$this->lastAccess,true);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('cIpAddress',$this->cIpAddress,true);
		$criteria->compare('cTime',$this->cTime,true);
		$criteria->compare('cUserId',$this->cUserId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}