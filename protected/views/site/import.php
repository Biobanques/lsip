
<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<?php
$this->widget('ext.bootstrap.widgets.TbModal', array(
    'id' => 'myModal',
    'header' => 'Modal Heading',
    'content' => "<div><pre>" . htmlspecialchars(file_get_contents(Yii::app()->basePath . '/data/examples/upload.xml'), ENT_QUOTES) . "</pre></div>",
    'footer' => array(
        TbHtml::button('Close', array('data-dismiss' => 'modal')),
    ),
));
?>
<h2><?php echo Yii::t('common', 'xmlUpload') ?></h2>
<div class="info"  ><div class="title">
        <?php echo Yii::t('common', 'xmlUploadInfoTitle'); ?>
    </div>
    <div class="content">
        <?php
        $fileLink = CHtml::link(Yii::t('common', 'thisFile'), ' ', array(
                    'style' => ' font-weight: bold; color:black',
                    'data-toggle' => 'modal',
                    'data-target' => '#myModal'));
        echo Yii::t('common', 'xmlUploadInfoContent', array('fileLink' => $fileLink));
        ?>
    </div>
</div >
<p>
    <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL, '', 'post', array('enctype' => "multipart/form-data", 'id' => "xmlImported", 'name' => "importedXml")); ?>
<fieldset>
    <?php
    echo TbHtml::fileFieldControlGroup("fileToImport[]", '', array('id' => 'fileToImport', 'multiple' => 'true', 'onchange' => 'makeFileList();', "accept" => "application/xml"));

    echo TbHtml::formActions(array(
        TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    ));
    ?>
</fieldset>
<?php echo TbHtml::endForm(); ?>

</p>

<script type="text/javascript">
    function makeFileList() {
        var input = document.getElementById("fileToImport");
        var ul = document.getElementById("nameList");
        while (ul.hasChildNodes()) {
            ul.removeChild(ul.firstChild);
        }
        for (var i = 0; i < input.files.length; i++) {
            var ext = input.files[i].name.substring(input.files[i].name.lastIndexOf('.') + 1);
            var li = document.createElement("li");
            if (ext === 'xml') {
                li.style = 'color:green';
            } else
                li.style = 'color:red';

            li.innerHTML = input.files[i].name;
            ul.appendChild(li);


        }
        if (!ul.hasChildNodes()) {
            var li = document.createElement("li");
            li.innerHTML = 'No Files Selected';
            ul.appendChild(li);
        }
    }

</script>
<?php
