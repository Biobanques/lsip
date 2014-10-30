<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <link rel="stylesheet" type="text/css" href="<?php
        echo Yii::app()->request->baseUrl;
        ;
        ?>/css/styles.css" />
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
                    <div>                    <?php
                        /**
                         * Affichage des liens de traduction en gardant le couple controlleur/action et les parametres d'origine.
                         */
                        $controler = Yii::app()->getController()->getId();
                        $action = Yii::app()->getController()->getAction()->getId();
                        echo CHtml::link(
                                CHtml::image(Yii::app()->request->baseUrl . '/images/fr.png'), Yii::app()->createUrl("$controler/$action", array_merge($_GET, array('lang' => "fr"))
                                )
//                        ,                      $htmlOptions
                        );
                        echo CHtml::link(
                                CHtml::image(Yii::app()->request->baseUrl . '/images/gb.png'), Yii::app()->createUrl("$controler/$action", array_merge($_GET, array('lang' => "en")))
                                , array('style' => "padding-left: 10px;")
                        );
                        ?></div>
                    <?php
                    $this->widget('bootstrap.widgets.TbNavbar', array(
                        'items' => array(
                            array(
                                'class' => 'bootstrap.widgets.TbMenu',
                                'items' => array(
                                    array('label' => Yii::t('common', 'managePatients'), 'url' => array('/patient/admin'), 'visible' => Yii::app()->user->isAdmin()),
                                    array('label' => Yii::t('common', 'manageRapprochements'), 'url' => array('/rapprochement/manageRapprochements'), 'visible' => Yii::app()->user->isAdmin() || Yii::app()->user->isBiobankAdmin()),
                                    array('label' => Yii::t('common', 'manageFusions'), 'url' => array('/rapprochement/manageFusions'), 'visible' => Yii::app()->user->isAdmin()),
                                    array('label' => Yii::t('common', 'detectRapprochement'), 'url' => array('/site/detectRapprochement'), 'visible' => Yii::app()->user->isAdmin() || Yii::app()->user->isBiobankAdmin()),
                                    array('label' => Yii::t('common', 'connect'), 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                    array('label' => Yii::t('common', 'disconnect') . '(' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                                ),
                            ),
                        ),
                    ));
                    ?>



                    <div class="container" id="page">
                        <?php
                        /**
                         * Affichage des liens de traduction en gardant le couple controlleur/action et les parametres d'origine.
                         */
                        $controler = Yii::app()->getController()->getId();
                        $action = Yii::app()->getController()->getAction()->getId();
                        echo CHtml::link(
                                CHtml::image(Yii::app()->request->baseUrl . '/images/fr.png'), Yii::app()->createUrl("$controler/$action", array_merge($_GET, array('lang' => "fr"))
                                )
//                        ,                      $htmlOptions
                        );
                        echo CHtml::link(
                                CHtml::image(Yii::app()->request->baseUrl . '/images/gb.png'), Yii::app()->createUrl("$controler/$action", array_merge($_GET, array('lang' => "en")))
                                , array('style' => "padding-left: 10px;")
                        );
                        ?>
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
