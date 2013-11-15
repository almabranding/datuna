<div id="sectionHeader">
    <h1>Packages</h1>
    <div id="sectionNav">
        <div class="btn grey" onclick="location.href='<?php echo URL.LANG;?>/packages/delivers/' " >Delivered packages</div>
        <div class="btn blue" onclick="location.href='<?php echo URL.LANG;?>/packages/editCreatePackage/' " >Create new package</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
<?php $this->searchModel->render('*horizontal'); ?>

<?php
    $this->getView('table');
    $this->getView('pagination'); 
    ?>
</div>