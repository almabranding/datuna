<div id="sectionHeader">
    <h1>Agencies</h1>
    <div id="sectionNav">
        <div class="btn blue"onclick="location.href = '<?php echo URL . LANG; ?>/agencies/editCreateAgency/'">New agency</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <?php
    $this->getView('table');
    $this->getView('pagination');
    ?>
</div>