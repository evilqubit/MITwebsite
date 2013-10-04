<?php

/**
 * This is the model class for table "newsletter_subscriber".
 *
 * The followings are the available columns in table 'newsletter_subscriber':
 * @property integer $id
 * @property string $email
 * @property string $firstName
 * @property string $lastName
 * @property integer $unsubscribed
 * @property string $salt
 * @property string $unsubscriptionDate
 * @property integer $source
 * @property integer $active
 * @property integer $deleted
 * @property integer $cUserId
 * @property string $cTime
 * @property string $cIpAddress
 */
class NewsletterSubscriber extends BActiveRecord{

    protected $logUserId = true;
    protected $enableOrdering = false;

    /**
     * Returns the static model of the specified AR class.
     * @return NewsletterSubscriber the static model class
     */
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName(){
        return 'newsletter_subscriber';
    }

    public function behaviors(){
        return array(
            'saveMany'=>array(
                'class'=>'SaveManyMBehavior',
            )
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email', 'required', 'on'=>'subscribe, backend, update'),
            array('firstName', 'required', 'on'=>'subscribe'),
            array('email', 'required', 'on'=>'unsubscribe, import'),
            array('email', 'email', 'on'=>'subscribe, backend, unsubscribe, update, import'),
            array('email', 'alreadyRegistered', 'on'=>'subscribe, backend, import'),
            array('email', 'notRegistered', 'on'=>'unsubscribe'),
            array('active', 'numerical', 'integerOnly'=>true, 'on'=>'backend, update'),
            array('email, firstName', 'length', 'max'=>50, 'on'=>'subscribe, backend, update'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, email, firstName,  unsubscribed, salt, unsubscriptionDate, source, active, deleted, cUserId, cTime, cIpAddress', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations(){
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'groups'=>array(self::MANY_MANY, 'NewsletterGroup', 'newsletter_subscriber_group(subscriberId, groupId)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
        return array(
            'id'=>'ID',
            'email'=>'Email',
            'firstName'=>'First Name',
            'lastName'=>'Last Name',
            'unsubscribed'=>'Unsubscribed',
            'salt'=>'Salt',
            'unsubscriptionDate'=>'Unsubscription Date',
            'active'=>'Active',
            'deleted'=>'Deleted',
            'cUserId'=>'C User',
            'cTime'=>'C Time',
            'cIpAddress'=>'C Ip Address',
        );
    }

    /**
     * Usage: ModelName::model()->subscribed()->findAll();
     */
    public function scopes(){
        $alias = $this->getTableAlias();
        $array = array(
            'subscribed'=>array(
                'condition'=>$alias.'.unsubscribed = 0',
            ),
        );
        return array_merge(parent::scopes(), $array);
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
        $criteria->compare('email', $this->email, true);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('unsubscribed', $this->unsubscribed);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('unsubscriptionDate', $this->unsubscriptionDate, true);
        $criteria->compare('source', $this->source);
        $criteria->compare('active', $this->active);
        $criteria->compare('deleted', $this->deleted);
        $criteria->compare('cUserId', $this->cUserId);
        $criteria->compare('cTime', $this->cTime, true);
        $criteria->compare('cIpAddress', $this->cIpAddress, true);

        return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
    }

    /**
     * Generate a salt before creating new record.
     */
    protected function beforeSave(){
        if($this->isNewRecord){
            $this->salt = StringHelper::generateString(10);
        }
        return parent::beforeSave();
    }

    /**
     * Filter to test if email already registered, and not deleted.
     */
    public function alreadyRegistered($attribute, $params){
        if(!$this->hasErrors()){
            $user = NewsletterSubscriber::model()->find('email=:email AND deleted=0 AND unsubscribed=0', array(':email'=>$this->email));
            if($user)
                $this->addError($attribute, 'Email already registered.');
        }
    }

    /**
     * Filter to test if email is not registered
     */
    public function notRegistered($attribute, $params){
        if(!$this->hasErrors()){
            $user = NewsletterSubscriber::model()->find('email=:email AND deleted=0 AND unsubscribed=0', array(':email'=>$this->email));
            if(!$user)
                $this->addError($attribute, 'Email not registered.');
        }
    }

    /**
     * Unsubscribe user after validating hash
     * @param string $hash The hash provided by the user
     */
    public function unsubscribe($hash){
        $userHash = $this->unsubscriptionHash();
        if($hash === $userHash){
            $this->unsubscribed = 1;
            $this->unsubscriptionDate = new CDbExpression('NOW()');
            if($this->save(false))
                return true;
        }
        else{
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * return Hash used to verify unsubscription
     */
    public function unsubscriptionHash(){
        return md5($this->email.$this->salt);
    }

    /**
     * returns the full unsubscription link
     * @param string $r  the url route (module/controller/action)
     * @return string  Unsubscription link
     */
    public function unsubscriptionLink($r){
        $link = Yii::app()->createAbsoluteUrl($r, array('id'=>$this->id, 'hash'=>$this->unsubscriptionHash()));
        return $link;
    }

    /**
     * Send Unsubscription Email
     * @param type $r   the url route (module/controller/action) of the unsubscription validation action
     * @return boolean if email sent 
     */
    public function sendUnsubscriptionEmail($r='newsletter/default/validateUnsubscription'){
        $link = $this->unsubscriptionLink($r);
        $body = "Please click the below link in order to unsubscribe from our newsletter.<br>
<a href='$link'>$link</a><br>
If you didn't request to unsubscribe, please ignore this email.
";
        $title = "Newsletter unsubscription validation";
        $email = Yii::app()->email->load();
        $email->Subject = $title;
        $email->MsgHTML($body);
        $email->AddAddress($this->email);
        if($email->send())
            return true;
        return false;
    }

    /**
     * Returns the source description
     */
    public function getSourceDescription(){
        $array = array(
            0=>Yii::t('newsletter', 'Frontend'),
            1=>Yii::t('newsletter', 'Backend'),
            2=>Yii::t('newsletter', 'Import'),
        );
        if(isset($array[$this->source]))
            return $array[$this->source];
    }

    /**
     * names of groups that the subscriber belongs to
     * @return string
     */
    public function groupsNames(){
        $array = array();
        foreach($this->groups as $group){
            if($group){
                $array[] = $group->name;
            }
        }
        $str = implode(', ', $array);
        return $str;
    }

}