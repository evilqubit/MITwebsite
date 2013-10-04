<?php

/**
 * This is the model class for table "newsletter_subscriber_group".
 *
 * The followings are the available columns in table 'newsletter_subscriber_group':
 * @property integer $id
 * @property integer $subscriberId
 * @property integer $groupId
 */
class NewsletterSubscriberGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return NewsletterSubscriberGroup the static model class
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
		return 'newsletter_subscriber_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subscriberId, groupId', 'required'),
			array('subscriberId, groupId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, subscriberId, groupId', 'safe', 'on'=>'search'),
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
            'subscriber'=>array(self::BELONGS_TO, 'NewsletterSubscriber', 'subscriberId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subscriberId' => 'Subscriber',
			'groupId' => 'Group',
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
		$criteria->compare('subscriberId',$this->subscriberId);
		$criteria->compare('groupId',$this->groupId);
        $criteria->join = 'JOIN newsletter_subscriber s ON t.subscriberId = s.id AND s.deleted = 0';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}