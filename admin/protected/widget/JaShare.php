<?php
//facebook share button
class JaShare extends CWidget
{
    /**
     * Site Name
     * @var string
     * defaults to Yii::app()->name
     */
    public $siteName = '';
 
    /**
     * Site Administrator's Facebook ID
     * @var string
     */
    public $fbSiteAdmin = 'XXXXXXXXXXXXXX';
 
    /**
     * URL of the page
     * @var string
     * defaults to the current page URL
     */
    public $pageUrl = '';
 
    /**
     * Title of the page
     * @var string
     */
    public $pageTitle = '';
 
    /**
     * Type of the Page : eg. website, article, ... etc.
     * @var string
     * defaults to 'article'
     */
    public $pageType = '';
 
    /**
     * Description of the page
     * @var string
     */
    public $pageDescription = '';
 
    /**
     * Image(s) of the page
     * @var mixed
     * can be a single string or array of strings
     * defaults $this->defaultPageImage
     */
    public $pageImages = '';
 
    /**
     * Default image of the page
     * @var string
     */
    public $defaultPageImage = '/images/fb/site-logo.jpg';
 
    /**
     * Show Comments
     * @var type boolean
     * defaults to true
     */
    public $showComments = true;
 
    /**
     * Initialization
     * @see CWidget::init()
     */
    public function init()
    {
        parent::init();
 
        // Site Name
        if ($this->siteName == '')
        {
            $this->siteName = Yii::app()->name;
        }
 
        // base URL
        $baseUrl = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl;
        // URL of the page
        if ($this->pageUrl == '')
        {
            $this->pageUrl = $baseUrl . '/' . Yii::app()->request->pathInfo;
        }
  
        // Set opengraph meta tags
        $cs = Yii::app()->getClientScript(); 
        $cs->registerScriptFile('//platform.twitter.com/widgets.js', CClientScript::POS_HEAD);
    }
 
    /**
     * Display the widget
     * @see CWidget::run()
     */
    public function run()
    {
        // twitter
        $tw_text = $this->siteName . ' - ' . $this->pageTitle;
        if ( $this->pageDescription != '')
        {
            $tw_text .= ' : ' . $this->pageDescription;
        }
        echo '<div class="tweet-button" style="float:right">' . "\n";
        echo '<a href="https://twitter.com/share" '
                . 'class="twitter-share-button" '
                . 'data-url="' . $this->pageUrl . '" '
                . 'data-text="' . $tw_text . '" '
                . 'data-count="horizontal">Tweet</a>' . "\n";
        echo '</div>' . "\n";
 
    }
}