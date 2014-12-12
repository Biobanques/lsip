
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
<h1><?php echo Yii::t('common', 'xmlUpload') ?></h1>
<div style="width: 100%;border: 1px;border-color: blue; border-style: solid;"  >
    You can upload XML files from here. <br>
    Xml files must be formed like <?php
    echo CHtml::link(Yii::t('common', 'thisFile'), ' ', array(
        'style' => ' font-weight: bold;',
        'data-toggle' => 'modal',
        'data-target' => '#myModal'));
    ?> </div >
<!--    Xml files must be formed like <?php //echo CHtml::link(Yii::t('common', 'thisFile'), '', array('style' => ' font-weight: bold;', 'target' => "blank",'onclick'=>''));                                          ?> </div >-->
<p>
<form  id="xmlImported" name="importedXml" method="post" action="" enctype="multipart/form-data"  >
    XML file to import : <input type="file" id='fileToImport'  name="fileToImport[]" multiple onchange="makeFileList();" style="display: none;" accept="application/xml" ><br>

    <input type="button" value="Browse..." onclick="document.getElementById('fileToImport').click();" />
    <ul id="nameList">
        <li>No file selected</li>
    </ul>

    <input type="submit" name="submit" >
</form>

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
