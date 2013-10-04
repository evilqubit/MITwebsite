<?php

/**
 * AAdminController extends Controller class.
 * adds common functions for admin like rbac rules
 *
 * @author AB
 * @version $Id: AAdminController.php 4-20120529
 */
class AAdminController extends Controller{

    /**
     * Enable roles based access cotnrol rules
     * @var boolean
     */
    protected $enableRbac = false;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters(){
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules(){
        if($this->enableRbac){
            $auth = Yii::app()->authManager;
            $module = '';
            if(isset($this->module))
                $module = $this->module->id;
            $controller = $this->id;
            $action = $this->action->id;
            /**
             * full controller name with module name
             */
            $controllerFull = $controller;
            if($this->module)
                $controllerFull = $module.'.'.$controller;

            return array(
                array('allow', // allow user SuperAdmin
                    'users'=>array('SuperAdmin'),
                ),
                array('allow', // allow super admins
                    'roles'=>array('SuperAdmins'),
                ),
                array('allow', // allow admins with right permissions to access whole controller (usually Tasks) moduleName.nontrollerName
                    'controllers'=>array($controller),
                    'roles'=>array($controllerFull),
                ),
                array('allow', // allow admins with right permissions to access actions (usually Operations) moduleName.nontrollerName.actionName
                    'actions'=>array($action),
                    'roles'=>array($controllerFull.'.'.$action),
                ),
                array('deny', // deny all users
                    'users'=>array('*'),
                ),
            );
        }
        else{
            return array(
                array('allow', // allow authenticated users to perform all actions
                    'users'=>array('@'),
                ),
                array('deny', // deny all users
                    'users'=>array('*'),
                ),
            );
        }
    }

}