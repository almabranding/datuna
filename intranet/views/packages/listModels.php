<div id="sectionHeader">
    <a href="<?= URL ?>packages/view/<? echo $this->package; ?>"><div id="arrowBack">Back to package</div></a>
    <h1>Add model to package</h1>
    <div id="sectionNav">
        <div class="addModels btn blue">Add models</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <input id="packageId" type="hidden" value="<? echo $this->package; ?>">
    <?php
    $modelsPackage = array();
    foreach ($this->modelsPackage as $key => $value) {
        $modelsPackage[] = (int) $value['id'];
    }
    ?>
    <div>
        <?php $this->searchModel->render('views/models/custom-template.php'); ?>
        <ul id="" class="ui-sortable sortable" rel="cosa">
            <?php
            foreach ($this->models as $key => $value) {
                Back::isImage($value['photo_id']);
                $checked = (in_array($value['id'], $modelsPackage)) ? 'selectInPack' : '';
                ?>
                <li id="foo_<?php echo $value['model_id']; ?>" class="ui-state-default modelList <?= $checked ?>" onclick="">
                    <input value="<?php echo $value['model_id']; ?>" name="check[]" class="checkFoto" type="checkbox">
                    <img caption="<?php echo $value['caption_' . LANG]; ?>" src="<?php echo URL . UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_file_name']; ?>">
                    <p class="modelName"><?php echo $value['name']; ?></p> 
                    <p><?php echo $this->categories[$value['category_id']]['name']; ?></p>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div id="sectionNav">
        <div class="addModels btn blue">Add models</div>
    </div>
</div>
<? $this->getView('pagination'); ?>