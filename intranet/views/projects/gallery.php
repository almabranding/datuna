<div id="sectionHeader">
    <a href="<?= URL ?>projects/lista"><div id="arrowBack">Back to projects</div></a>
    <h1><?= $this->model['name']; ?></h1>
    <div id="sectionNav">
        <div class="linkNav" id="allSelect">Select all photos</div>
        <a target="_blank" href="<?= WEB; ?>project/gallery/<?= $this->id.'-'.  urlencode($this->model['name']); ?>"><div class="linkNav">View project</div></a>
        <div class="btn blue" id="selectThumbnail">Use as a thumbnail</div>
        <div id="deleteImage" class="btn red">Delete</div>
        <div class="btn grey" onclick="showPop('newImage');" >Add new photo</div>
        <a href="<?php echo URL . LANG; ?>/projects/view/<?= $this->id; ?>"><div class="btn grey" >Edit project</div></a>
        <div class="btn blue" id="saveInputs">Save</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <div>
        <input id="project_id" value="<?= $this->model['id'] ?>" type="hidden">
        <ul id="sortable" class="ui-sortable sortable modelListImages" rel="cosa">
            <? foreach ($this->modelPhotos as $key => $value) { ?>
                <li id="foo_<?= $value['id'] ?>" class="ui-state-default modelList <?= ($value['thumb']) ? 'mainPic' : '' ?>">
                    <input value="<?= $value['id']; ?>" name="check[]" class="checkFoto" type="checkbox">
                    <img width="154" height="207" class="listImage" alt="<?= $value['caption_' . LANG]; ?>" src="<?= '/' . UPLOAD . 'images/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_name'].$strNoCache; ?>"/>
                    <select name="visibility[<?= $value['id']; ?>]"  class="inputSmall" style='text-transform:capitalize;'>
                        <option value="public" <? if ($value['visibility'] == 'public') echo 'selected'; ?>>Public</option><option value="private" <? if ($value['visibility'] == 'private') echo 'selected'; ?>>Private</option>
                    </select>
                    <a target="_blank" href="<?php echo URL . UPLOAD . 'images/' . Model::idToRute($value['photo_id']) . $value['file_name']; ?>"><input id="h1096" class="btnSmall" type="button" value="View" ></a>
                    <input id="h1096" class="btnSmall editImg" type="button" value="Edit" onclick="location.href = '<?php echo URL . LANG; ?>/image/view/<?php echo $value['id']; ?>'" >
                    <input class="btnSmall deleteSingle" type="submit" value="Delete"style="background: #bb0000;">
                </li>
            <? } ?>
        </ul>
    </div>
</div>
<div class="white_box hide" id="newImage" style="width:auto;left:30%;position:absolute;">
    <?php $this->viewUploadFile($this->id, 'project'); ?>
</div>
