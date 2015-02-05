<?php

class SiteController extends Controller
{

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
// captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
// They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index'),
                'users' => array('*'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'xmlImport'),
                'users' => array('$user->isBiobankAdmin()'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('detectRapprochement', 'changeId', 'changeBD', 'massImport'),
                'expression' => '$user->isAdmin()'
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $user = User::model()->findByPk(Yii::app()->user->getId());
        $this->render('index', array('user' => $user));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

// if it is ajax validation request
        /* if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
          echo CActiveForm::validate($model);
          Yii::app()->end();
          } */

// collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
// validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
//Yii::app()->user->setFlash('success', 'Well logged');
                $this->redirect(Yii::app()->createUrl('site/index'));
            } else {
                Yii::app()->user->setFlash('error', Yii::t('common', 'errorLoginAlert'));
            }
        }
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionDetectRapprochement() {
        $patients = Patient::model()->findAll();

        foreach ($patients as $patientBase) {
            CommonTools::detect($patientBase);
        }
        $this->redirect(Yii::app()->createUrl('rapprochement/manageRapprochements'));
    }

    public function actionXmlImport($doImport = false) {
        $count = 0;
        $folderSource = CommonProperties::$MASS_IMPORT_FOLDER;
        if (substr($folderSource, -1) != '/')
            $folderSource.='/';
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
            foreach ($_FILES['fileToImport']['name'] as $f => $name) {
                if ($_FILES['fileToImport']['error'][$f] == 4) {
                    continue; // Skip file if any error found
                }
                if ($_FILES['fileToImport']['error'][$f] == 0) {

// No error found! Move uploaded fileToImport
                    if (move_uploaded_file($_FILES["fileToImport"]["tmp_name"][$f], $folderSource . date('dmYHis') . '_' . $name)) {

                        $count++; // Number of successfully uploaded file
                    }
                }
            }
            if ($doImport)
                $this->doImport();
        }
        $this->render('import');
    }

    public function actionMassImport() {

        $this->doImport();
        $this->redirect(Yii::app()->createUrl('rapprochement/manageRapprochements'));
    }

    protected function doImport() {
        include 'CommonTools.php';
        $folderSource = CommonProperties::$MASS_IMPORT_FOLDER;
        if (substr($folderSource, -1) != '/')
            $folderSource.='/';


        chdir($folderSource);
        $files = array_filter(glob('*'), 'is_file');

        foreach ($files as $importedFile) {

            copy($importedFile, $folderSource . "saved/saved_$importedFile");


            if (fnmatch('*.xml', $importedFile)) {

                CommonTools::analyzeAndRecreateXml($importedFile);
            }
        }
    }

    public function actionChangeId() {
        Rapprochement::model()->deleteAll();
        $patients = Patient::model()->findAll();
        foreach ($patients as $patient)
            $patient->save();
        $this->redirect(Yii::app()->createUrl('patient/admin'));
    }

    public function actionChangeBD() {
        $patients = Patient::model()->findAll();
        foreach ($patients as $patient) {
            $bd = strtotime($patient->birthDate);

            $patient->birthDate = date('Y', $bd) . '-' . date('m', $bd) . '-' . date('d', $bd);
            $patient->save();
        }
        $this->redirect(Yii::app()->createUrl('patient/admin'));
    }

}