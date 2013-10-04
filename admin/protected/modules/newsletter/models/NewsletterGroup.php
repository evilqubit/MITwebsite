<?php

/**
 * This is the model class for table "newsletter_group".
 *
 * The followings are the available columns in table 'newsletter_group':
 * @property integer $id
 * @property string $name
 * @property integer $active
 * @property integer $deleted
 * @property string $cTime
 * @property string $cIpAddress
 */
class NewsletterGroup extends BActiveRecord{

    protected $enableOrdering = false;

    /**
     * Returns the static model of the specified AR class.
     * @return NewsletterGroup the static model class
     */
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName(){
        return 'newsletter_group';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('active, deleted', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('cIpAddress', 'length', 'max'=>40),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, active, deleted, cTime, cIpAddress', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations(){
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'subscribers'=>array(self::MANY_MANY, 'NewsletterSubscriber', 'newsletter_subscriber_group(groupId, subscriberId)', 'condition'=>'subscribers.active = 1 AND subscribers.unsubscribed = 0'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
        return array(
            'id'=>'ID',
            'name'=>'Name',
            'active'=>'Active',
            'deleted'=>'Deleted',
            'cTime'=>'C Time',
            'cIpAddress'=>'C Ip Address',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search(){
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('deleted', $this->deleted);
        $criteria->compare('cTime', $this->cTime, true);
        $criteria->compare('cIpAddress', $this->cIpAddress, true);

        return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
    }

}