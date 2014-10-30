<?php

class RapprochementController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view',),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'validate', 'manageRapprochements', 'manageFusions'),
                'expression' => '$user->isAdmin()'
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('validate', 'manageRapprochements', 'manageFusions'),
                'expression' => '$user->isBiobankAdmin()'
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

//    public function actionValidate($id, $value) {
//        $model = $this->loadModel($id);
//        $model->validated = $value;
//        $model->save();
//        Yii::app()->user->returnUrl = Yii::app()->request->urlReferrer;
//
//        $this->redirect(Yii::app()->user->returnUrl);
//    }
    public function actionValidate() {
        if (isset($_POST['Rapprochement'])) {
            $id = $_POST['Rapprochement']['idRapprochement'];
            $value = $_POST['Rapprochement']['value'];
        }
        try {
            $model = $this->loadModel($id);
            $model->validated = $value;
            $model->save();
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), CLogger::LEVEL_ERROR);
        }
//        Yii::app()->user->returnUrl = Yii::app()->request->urlReferrer;
//        $this->redirect(Yii::app()->user->returnUrl);
        Yii::app()->end();
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Rapprochement;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Rapprochement'])) {
            $model->attributes = $_POST['Rapprochement'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->idRapprochement));
            else {
                Yii::app()->user->setMessage('error', Yii::t('common', 'notAdded'));
                Yii::log("Une erreur est survenue pendant l'enregtistrement d'un rapprochement.", CLogger::LEVEL_ERROR);
            }
        }


        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Rapprochement'])) {
            $model->attributes = $_POST['Rapprochement'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->idRapprochement));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Rapprochement');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Lists all Rapprochements where source->pat1 != source->pat2.
     */
    public function actionManageRapprochements() {
        $model = new Rapprochement();

        if (isset($_POST['Rapprochement'])) {
            $id = $_POST['Rapprochement']['idRapprochement'];
            $value = $_POST['Rapprochement']['value'];
            $this->validate($id, $value);
        }
        $dataProvider = $model->getRapprochements();

        $this->render('indexRapprochements', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function validate($id, $value) {


        $model = $this->loadModel($id);
        $model->validated = $value;
        $model->save();
    }

    /**
     * Lists all Rapprochements where source->pat1 == source->pat2.
     */
    public function actionManageFusions() {
        $model = new Rapprochement();

        if (isset($_POST['Rapprochement'])) {
            $id = $_POST['Rapprochement']['idRapprochement'];
            $value = $_POST['Rapprochement']['value'];
            $this->validate($id, $value);
        }

        $dataProvider = $model->getFusions();
        $this->render('indexRapprochements', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Rapprochement('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Rapprochement']))
            $model->attributes = $_GET['Rapprochement'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Rapprochement the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Rapprochement::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Rapprochement $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'rapprochement-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}