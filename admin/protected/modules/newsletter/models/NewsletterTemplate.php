<?php

/**
 * This is the model class for table "newsletter_template".
 *
 * The followings are the available columns in table 'newsletter_template':
 * @property integer $id
 * @property string $name
 * @property string $template
 * @property integer $active
 */
class NewsletterTemplate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return NewsletterTemplate the static model class
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
		return 'newsletter_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('template, name', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, template, active', 'safe', 'on'=>'search'),
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
            'name' => 'Name',
			'template' => 'Template',
			'active' => 'Active',
		);
	}
    
    /**
     * Usage: ModelName::model()->active()->findAll();
     */
    public function scopes(){
        $alias = $this->getTableAlias();
        return array(
            'active'=>array(
                'condition'=>$alias.'.active = 1',
            ),
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
		$criteria->compare('template',$this->template,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
     * Returns newsletter templates array, used in drop down lists
     * @return array
     */
    public static function listArray(){
        $templates = NewsletterTemplate::model()->active()->findAll();
        $array = array();
        $array[0] = "No Template";
        foreach($templates as $template){
            $array[$template->id] = $template->name;
        }
        return $array;
        
    }
}