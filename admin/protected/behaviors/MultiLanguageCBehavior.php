<?php
/**
 * Multi Language Controller Behavior
 * Added as behavior to Controller class in components folder
 * used for multilingual websites.
 * Usage:<br>
 * 'multiLanguageC'=>array(
                'class'=>'application.behaviors.MultiLanguageCBehavior',
                )
 * @author AB
 * @version 3-20120119
 */
class MultiLanguageCBehavior extends CBehavior{

    /**
     * Website Languages
     * @var array 
     */
    public $languages = array('en'=>'English', 'ar'=>'عربي');

    /**
     * Set or read language cookies on behavior attach.
     * @param CComponent $owner 
     */
    public function attach($owner){
        parent::attach($owner);
        // If language is set in URL
        if(isset($_GET['lang'])){
            // If language exists in the languages array
            if(key_exists($_GET['lang'], $this->languages)){
                $language = $_GET['lang'];
                Yii::app()->request->cookies['lang'] = new CHttpCookie('lang', $_GET['lang']);
            }
            else{
                $language = Yii::app()->language;
            }
        }
        else{
            // If lang cookie already available
            if(isset(Yii::app()->request->cookies['lang'])){
                $language = Yii::app()->request->cookies['lang']->value;
            }
            else{
                $language = Yii::app()->language;
            }
        }
        Yii::app()->setLanguage($language);
    }

    /**
     * Returns the current url with the language provided in the url
     * @param string $lang language (ex: 'en')
     * @return string  Url with selected language 
     */
    public static function translateUrl($lang){
        $r = '';
        $get = $_GET;
        if(isset($_GET['r'])){
            $r = $_GET['r'];
            unset($get['r']);
        }
        $get['lang'] = $lang;
        $url = Yii::app()->createUrl($r, $get);
        return $url;
    }

    /**
     * Returns the HTML of the language bar
     * Use it in the layout: echo $this->languageBar();
     * @return string HTML of the language bar
     */
    public function languageBar(){
        $string = ""; //<span>".Yii::t('main', 'Languages').":</span> ";
          $lang =  Yii::app()->language == 'en_us' ? "en" : Yii::app()->language ; 
        foreach($this->languages as $key=>$language){
            $active = '';
            if($lang == $key){
              //  $active = 'active';
            }
            else 
            {
           	 $string .= "<a href='".self::translateUrl($key)."' class='link' >".Yii::t('main', $language)."</a>";
            	
            }
        }
        return $string;
    }

}