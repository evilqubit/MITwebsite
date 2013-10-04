<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $id
 * @property string $alias
 * @property string $title
 * @property string $content
 * @property string $meta_keywordds
 * @property string $meta_description
 * @property string $cTime
 * @property string $cIpAddress
 * @property integer $cUserId
 * @property string $lang
 * @property integer $parentId
 */
class Pages extends AActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pages the static model class
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
		return 'pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lang, parentId', 'required'),
			array('cUserId, parentId', 'numerical', 'integerOnly'=>true),
			array('alias, title, cIpAddress', 'length', 'max'=>255),
			array('lang', 'length', 'max'=>12),
			array('content, meta_keywordds, meta_description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, alias, title, content, meta_keywordds, meta_description, cTime, cIpAddress, cUserId, lang, parentId', 'safe', 'on'=>'search'),
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
			'alias' => 'Alias',
			'title' => 'Title',
			'content' => 'Content',
			'meta_keywordds' => 'Meta Keywordds',
			'meta_description' => 'Meta Description',
			'cTime' => 'C Time',
			'cIpAddress' => 'C Ip Address',
			'cUserId' => 'C User',
			'lang' => 'Lang',
			'parentId' => 'Parent',
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
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('meta_keywordds',$this->meta_keywordds,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('cTime',$this->cTime,true);
		$criteria->compare('cIpAddress',$this->cIpAddress,true);
		$criteria->compare('cUserId',$this->cUserId);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('parentId',$this->parentId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}