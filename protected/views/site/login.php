<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<h1><?php echo Yii::t('common', 'connect'); ?></h1>


<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    ));
    ?>

    <fieldset>

        <legend>Please fill out the following form with your login credentials:</legend>

        <?php echo $form->textFieldControlGroup($model, 'username');
        ?>
        <?php
        echo $form->passwordFieldControlGroup($model, 'password');


        echo $form->checkBoxControlGroup($model, 'rememberMe', array('checked' => true));
        ?>
        <php

</fieldset>

<?php
echo TbHtml::formActions(array(
    TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    TbHtml::resetButton('Reset'),
));
?>

<?php $this->endWidget(); ?>

</div><!-- form -->
