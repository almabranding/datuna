<div id="sectionHeader">
    <h1>Delivered packages</h1>
    <div id="sectionNav">
        <div class="btn grey" onclick="location.href='<?php echo URL.LANG;?>/packages/lista/' " >Packages</div>
        <div class="btn blue" onclick="location.href='<?php echo URL.LANG;?>/packages/editCreatePackage/' " >Create new package</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
<?php
    $this->getView('table');
    $this->getView('pagination'); 
    ?>
</div>