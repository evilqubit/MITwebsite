<?php

/**
 * This is the model class for table "answers".
 *
 * The followings are the available columns in table 'answers':
 * @property integer $idanswers
 * @property string $value
 * @property integer $application_idapplication
 * @property integer $questions_idquestions
 *
 * The followings are the available model relations:
 * @property Application $applicationIdapplication
 * @property Questions $questionsIdquestions
 */
class Answers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Answers the static model class
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
		return 'answers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idanswers, application_idapplication, questions_idquestions', 'required'),
			array('idanswers, application_idapplication, questions_idquestions', 'numerical', 'integerOnly'=>true),
			array('value', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idanswers, value, application_idapplication, questions_idquestions', 'safe', 'on'=>'search'),
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
			'applicationIdapplication' => array(self::BELONGS_TO, 'Application', 'application_idapplication'),
			'questionsIdquestions' => array(self::BELONGS_TO, 'Questions', 'questions_idquestions'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idanswers' => 'Idanswers',
			'value' => 'Value',
			'application_idapplication' => 'Application Idapplication',
			'questions_idquestions' => 'Questions Idquestions',
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

		$criteria->compare('idanswers',$this->idanswers);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('application_idapplication',$this->application_idapplication);
		$criteria->compare('questions_idquestions',$this->questions_idquestions);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}