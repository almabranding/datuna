<div id="sectionHeader">
    <h1>Projects</h1>
    <div id="sectionNav">
        <div class="btn blue" onclick="location.href = '<?php echo URL . LANG; ?>/projects/addproject'">Add new project</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <ul id="sortable" class="ui-sortable sortable">
        <? foreach ($this->models as $key => $value) { ?>
            <li id="foo_<?= $value['project_id'] ?>" class="ui-state-default modelList" rel="<?= $value['project_id'] ?>">
                <a target="_blank" href="<?= WEB . 'project/gallery/' . $value['project_id'] . '-' . $value['name']; ?>">
                    <img alt="<?= $value['caption_' . LANG]; ?>" src="<?='/'.UPLOAD . 'images/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_name']; ?>"></a>
                <p class="modelName"><?= $value['name']; ?></p> 
                <input class="btnSmall editImg" type="button" value="Gallery" onclick="location.href = '<?= URL . LANG; ?>/projects/gallery/<?= $value['project_id']; ?>'">
                <input class="btnSmall editImg" type="button" value="Edit" onclick="location.href = '<?=URL . LANG; ?>/projects/view/<?= $value['project_id']; ?>'" >
                <input class="btnSmall deleteProject" type="submit" value="Delete" style="background: #bb0000;">
            </li>
        <? } ?>
    </ul>
<? $this->getView('pagination'); ?>
</div>
