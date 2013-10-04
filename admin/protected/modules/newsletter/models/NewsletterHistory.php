<?php

/**
 * This is the model class for table "newsletter_history".
 *
 * The followings are the available columns in table 'newsletter_history':
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $templateId
 * @property string $sendingTime
 * @property integer $cUserId
 * @property string $cTime
 * @property string $cIpAddress
 */
class NewsletterHistory extends AActiveRecord{

    /**
     * Total number of recipients
     */
    protected $_total = null;

    /**
     * Total number of emails with pending status
     */
    protected $_pending = null;

    /**
     * Total number of emails with failed status
     */
    protected $_failed = null;

    /**
     * Total number of emails with success status
     */
    protected $_success = null;

    /**
     * Returns the static model of the specified AR class.
     * @return NewsletterHistory the static model class
     */
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName(){
        return 'newsletter_history';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, text', 'required', 'on'=>'send, update'),
            array('templateId', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, text, templateId, sendingTime, cUserId, cTime, cIpAddress', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations(){
        return array(
            'template'=>array(self::BELONGS_TO, 'NewsletterTemplate', 'templateId'),
            'groups'=>array(self::MANY_MANY, 'NewsletterGroup', 'newsletter_history_group(newsletterId, groupId)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
        return array(
            'id'=>'ID',
            'title'=>'Title',
            'text'=>'Text',
            'templateId'=>'Template',
            'sendingTime'=>'Sending Time',
            'cUserId'=>'C User',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('templateId', $this->templateId);
        $criteria->compare('sendingTime', $this->sendingTime, true);
        $criteria->compare('cUserId', $this->cUserId);
        $criteria->compare('cTime', $this->cTime, true);
        $criteria->compare('cIpAddress', $this->cIpAddress, true);

        return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
    }

    /**
     * Returns the full body after processing it with the template if available
     * @return string 
     */
    public function bodyWithTemplate(){
        $str = "";
        if(!$this->templateId){
            $str = $this->text;
        }
        else{
            $temp = new ATemplate($this->template->template);
            $temp->text = $this->text;
            $temp->unsubscribe = Yii::app()->createAbsoluteUrl('newsletter/default/unsubscribe');
            $str = $temp->out();
        }
        return $str;
    }

    /**
     * send newsletter to all active subscribers
     * @return  integer Number of recipients
     */
    public function sendNewsletter(){
        $email = Yii::app()->email->load();
        $email->Subject = $this->title;
        $email->MsgHTML($this->bodyWithTemplate());
        $email->sendingTime = $this->sendingTime;
        $email->referenceId = $this->id;
        $count = 0;
        if(Yii::app()->controller->module->enableGroups){ //send for selected groups
            foreach($this->groups as $group){
                foreach($group->subscribers as $sub){
                    $email->AddBcc($sub->email);
                    $count++;
                }
            }
            //Send to others (Subscriber with no groups)
            if($this->sendToOthers()){
                $users = NewsletterSubscriber::model()->active()->subscribed()->findAll(array(
                    'condition'=>'id NOT IN (SELECT DISTINCT(sg.subscriberId) FROM newsletter_subscriber_group as sg, newsletter_group as g WHERE sg.groupId = g.id AND g.active = 1 AND g.deleted = 0)',
                        ));
                foreach($users as $user){
                    $email->AddBcc($user->email);
                    $count++;
                }
            }
        }
        else{ //Send for all
            $users = NewsletterSubscriber::model()->active()->subscribed()->findAll();
            foreach($users as $user){
                $email->AddBcc($user->email);
                $count++;
            }
        }
        if(!$email->send())
            $count = 0;
        return $count;
    }

    /**
     * Returns the total number of emails
     * @return integer
     */
    public function getTotal(){
        if($this->_total == null){
            $this->_total = $this->mailCount();
        }
        return $this->_total;
    }

    /**
     * Returns the total number of emails with pending status
     * @return integer
     */
    public function getPending(){
        if($this->_pending == null){
            $this->_pending = $this->mailCount('0');
        }
        return $this->_pending;
    }

    /**
     * Returns the total number of emails with failed status
     * @return integer
     */
    public function getFailed(){
        if($this->_failed == null){
            $this->_failed = $this->mailCount('-1');
        }
        return $this->_failed;
    }

    /**
     * Returns the total number of emails with success status
     * @return integer
     */
    public function getSuccess(){
        if($this->_success == null){
            $this->_success = $this->mailCount('1');
        }
        return $this->_success;
    }

    /**
     * returns the number of emails of this newsletter
     * @param integer $status email status
     */
    protected function mailCount($status = null){
        $connection = Yii::app()->db;
        if($status == null){
            $sql = "SELECT count(*) FROM mail_message as m, mail_queue as q WHERE m.referenceId=$this->id AND q.messageId = m.id";
        }
        else{
            $sql = "SELECT count(*) FROM mail_message as m, mail_queue as q WHERE m.referenceId=$this->id AND q.messageId = m.id AND q.status = $status";
        }
        $command = $connection->createCommand($sql);
        $value = $command->queryScalar();
        return $value;
    }

    /**
     * Returns the percentage of $value from total
     * @param integer $value
     * @return integer 
     */
    public function totalPercentage($value){
        $percentage = 0;
        if($this->total)
            $percentage = (int) ($value * 100 / $this->total);
        return $percentage;
    }

    /**
     * If send to others subscribers: send to emails that don't belongs to any group
     * @return boolean
     */
    public function sendToOthers(){
        $connection = Yii::app()->db;
        $sql = "SELECT count(*) FROM newsletter_history_group WHERE newsletterId = $this->id AND groupId = 0";
        $command = $connection->createCommand($sql);
        $count0 = $command->queryScalar();
        if($count0)
            return true;
        return false;
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
        if($this->sendToOthers()){
            $array[] = 'Others';
        }
        $str = implode(', ', $array);
        return $str;
    }

}