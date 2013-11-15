<div id="sectionHeader">
    <a href="<?= URL ?>pages/lista"><div id="arrowBack">Back to pages</div></a>
    <h1><?= $this->page['name'] ?></h1>
    <div id="sectionNav"></div>
</div>
<div id="sectionContent">
     <? $this->form->render(); ?>
</div>