<?php

/**
 * This is the model class for table "questions".
 *
 * The followings are the available columns in table 'questions':
 * @property integer $id
 * @property string $qtitle_en
 * @property string $qtitle_ar
 * @property string $qtitle_fr
 * @property integer $types_idtypes
 * @property integer $grade
 * @property integer $active
 * @property integer $ordering
 * @property integer $deleted
 * @property string $cTime
 * @property string $cIpAddress
 * @property integer $cUserId
 *
 * The followings are the available model relations:
 * @property Answers[] $answers
 * @property Types $typesIdtypes
 */
class Questions extends BActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Questions the static model class
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
		return 'questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('types_idtypes', 'required'),
			array('types_idtypes, grade, active, ordering, deleted, cUserId', 'numerical', 'integerOnly'=>true),
			array('cIpAddress', 'length', 'max'=>45),
			array('qtitle_en, qtitle_ar, qtitle_fr, cTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, qtitle_en, qtitle_ar, qtitle_fr, types_idtypes, grade, active, ordering, deleted, cTime, cIpAddress, cUserId', 'safe', 'on'=>'search'),
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
			'answers' => array(self::HAS_MANY, 'Answers', 'questions_id'),
			'typesIdtypes' => array(self::BELONGS_TO, 'Types', 'types_idtypes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'qtitle_en' => 'Question(english)',
			'qtitle_ar' => 'السؤال(arabic)',
			'qtitle_fr' => 'Question(french)',
			'types_idtypes' => 'Type',
			'grade' => 'Grade',
			'active' => 'Active',
			'ordering' => 'Ordering',
			'deleted' => 'Deleted',
			'cTime' => 'Time Created',
			'cIpAddress' => 'Ip Address',
			'cUserId' => 'User',
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
		$criteria->compare('qtitle_en',$this->qtitle_en,true);
		$criteria->compare('qtitle_ar',$this->qtitle_ar,true);
		$criteria->compare('qtitle_fr',$this->qtitle_fr,true);
		$criteria->compare('types_idtypes',$this->types_idtypes);
		$criteria->compare('grade',$this->grade);
		$criteria->compare('active',$this->active);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('cTime',$this->cTime,true);
		$criteria->compare('cIpAddress',$this->cIpAddress,true);
		$criteria->compare('cUserId',$this->cUserId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}