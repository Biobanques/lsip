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
        <link rel="stylesheet" type="text/css" href="<?php
        echo Yii::app()->request->baseUrl;
        ;
        ?>/css/custom.css" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php
        Yii::app()->bootstrap->register();
        ?>
    </head>
    <body>

        <?php
        $controler = Yii::app()->getController()->getId();
        $action = Yii::app()->getController()->getAction()->getId();
        $fr = CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/fr.png'), Yii::app()->createUrl("$controler/$action", array_merge($_GET, array('lang' => "fr"))
                        )
//                        ,                      $htmlOptions
        );
        $en = CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/gb.png'), Yii::app()->createUrl("$controler/$action", array_merge($_GET, array('lang' => "en")))
                        , array('style' => "padding-left: 10px;")
        );




        $dataFileArray = CommonTools::getImportedFilesInfo();
        $fileToImport = $dataFileArray != null ? true : false;
        if ($fileToImport) {
            $this->widget('bootstrap.widgets.TbModal', array(
                'id' => 'confirmImportModal',
                'header' => Yii::t('massImportModal', 'header'),
                'content' => $this->renderPartial('../site/massFolderResume', array('dataFileProvider' => new CArrayDataProvider($dataFileArray, array('keyField' => false))), true),
                'footer' => array(
                    TbHtml::Button(Yii::t('massImportModal', 'confirmButton'), array(
                        'onclick' => "window.location.href='" . Yii::app()->createUrl('site/massImport') . "'",
                        'data-dismiss' => 'modal',
                        'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
                    TbHtml::Button(Yii::t('massImportModal', 'cancelButton'), array('data-dismiss' => 'modal')),
                ),
            ));
        }

        $this->widget('ext.bootstrap.widgets.TbNavbar', array(
            'brandLabel' => Yii::app()->name . $fr . $en,
            'brandOptions' => array('style' => 'width:90%;'),
            'htmlOptions' => array('id' => 'navBar'),
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbNav',
                    'items' => array(
                        array('label' => Yii::t('common', 'managePatients'), 'url' => array('/patient/admin'), 'visible' => Yii::app()->user->isBiobankAdmin() || Yii::app()->user->isAdmin()),
                        array('label' => Yii::t('common', 'manageRapprochements'), 'url' => array('/rapprochement/manageRapprochements'), 'visible' => Yii::app()->user->isBiobankAdmin() || Yii::app()->user->isAdmin()),
                        array('label' => Yii::t('common', 'manageFusions'), 'url' => array('/rapprochement/manageFusions'), 'visible' => Yii::app()->user->isAdmin() || Yii::app()->user->isBiobankAdmin()),
                        array('label' => Yii::t('common', 'xmlUpload'), 'url' => array('/site/xmlImport'), 'visible' => Yii::app()->user->isBiobankAdmin() || Yii::app()->user->isAdmin()),
//
                        array('label' => 'Administration', 'visible' => Yii::app()->user->isAdmin(), 'items' => array(
                                array('label' => Yii::t('common', 'manageSources'), 'url' => array('/sources/admin')),
                                array('label' => Yii::t('common', 'manageUsers'), 'url' => array('/user/admin')), array('label' => Yii::t('common', 'detectRapprochement'), 'url' => array('/site/detectRapprochement'), 'linkOptions' => array('onclick' => "return confirm('" . Yii::t('common', 'longTimeMessage') . "')")),
//                               
                                array('label' => Yii::t('common', 'massImport'), 'id' => 'test', 'visible' => $fileToImport, 'url' => array('/user/admin'), 'linkOptions' => array(
                                        'style' => TbHtml::BUTTON_COLOR_PRIMARY,
                                        'size' => TbHtml::BUTTON_SIZE_LARGE,
                                        'data-toggle' => 'modal',
                                        'data-target' => '#confirmImportModal',
                                    )),
                            )),
                        array('label' => Yii::t('common', 'connect'), 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => Yii::t('common', 'disconnect') . '(' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ),
            ),
        ));
        ?>



        <script type="text/javascript">
            var height = document.getElementById('navBar').offsetHeight + 5;
            document.write("<div class='container' id='page' style='padding-top:" + height + "px;'>");
        </script>



        <span>
            <?php
            /**
             * Affichage des liens de traduction en gardant le couple controlleur/action et les parametres d'origine.
             */
            ?>
        </span>
        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'block' => true,
            'fade' => true,
            'closeText' => '&times;', // false equals no close link
            'events' => array(),
            'htmlOptions' => array(),
            'alerts' => array(// configurations per alert type
                // success, info, warning, error or danger
                'success' => array('closeText' => '&times;'),
                'info', // you don't need to specify full config
                'warning' => array('block' => false, 'closeText' => false),
                'error' => array('block' => false)
            ),
        ));
        ?>

        <?php echo $content; ?>

        <div class="clear"></div>

        <div id="footer">
            Lsip v. 1.0<br/>
            Copyright &copy; <?php echo date('Y'); ?> by Biobanques.<br/>
            All Rights Reserved.<br/>
            <?php echo Yii::powered(); ?>
        </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
