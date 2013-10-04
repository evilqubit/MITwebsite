<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property string $title
 * @property string $link
 * @property string $img
 * @property integer $active
 * @property integer $ordering
 * @property integer $deleted
 * @property string $cTime
 * @property string $cIpAddress
 * @property integer $cUserId
 */
class Article extends BActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
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
		return 'article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, ordering, deleted, cUserId', 'numerical', 'integerOnly'=>true),
			array('title, link', 'length', 'max'=>255),
			array('cIpAddress', 'length', 'max'=>45),
			array('cTime', 'safe'),
			array('img', 'file', 'on'=>'insert', 'allowEmpty'=>false, 'types'=>'jpg, gif, png'),
      		array('img', 'file', 'on'=>'update', 'allowEmpty'=>true, 'types'=>'jpg, gif, png', 'safe'=>false),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, link, img, active, ordering, deleted, cTime, cIpAddress, cUserId', 'safe', 'on'=>'search'),
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
			'link' => 'Link',
			'img' => 'Img',
			'active' => 'Active',
			'ordering' => 'Ordering',
			'deleted' => 'Deleted',
			'cTime' => 'C Time',
			'cIpAddress' => 'C Ip Address',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('img',$this->img,true);
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
	


// save image function
		public function saveImage($file){
			if (!$file ) {
				return;
			}  
			 
		$tempName = $file->name; 
		$name = explode("." ,$tempName );
		$randomName = $name[0]. time() . mt_rand(10, 99)."." . $file->getExtensionName(); 
		
		
		$this->img = $randomName;
		$filePath = '../images/articles/';
		$file->saveAs($filePath . $randomName);
		$image = Yii::app()->image->load( Yii::app()->basePath .'/../' . $filePath . $randomName);
		$image = ImageHelper::smartCrop($image, 225, 167);
		$image->save(Yii::app()->basePath .'/../'.  $filePath . 'thumbs/'. $randomName); 
		 return $randomName;
	}
}