<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
       <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;; ?>/css/styles.css" />
       <title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php Yii::app()->bootstrap->register(); ?>
       <!-- bootstrap CDN includes-->
       <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>

<?php
$this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label' => 'Manage patients', 'url' => array('/patient/admin'), 'visible' => Yii::app()->user->isAdmin()),
                array('label' => 'Manage rapprochements', 'url' => array('/rapprochement/manageRapprochements'), 'visible' => Yii::app()->user->isAdmin() || Yii::app()->user->isBiobankAdmin()),
                array('label' => 'Manage fusions', 'url' => array('/rapprochement/manageFusions'), 'visible' => Yii::app()->user->isAdmin()),
                array('label' => 'Detect rapprochement', 'url' => array('/site/detectRapprochement'), 'visible' => Yii::app()->user->isAdmin() || Yii::app()->user->isBiobankAdmin()),      
                array('label'=>'Se connecter', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Se déconnecter ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>

<div class="container" id="page">
	        
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Biobanques.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
