<div id="sectionHeader">
    <a href="<?= URL ?>home/lista"><div id="arrowBack">Back to sections</div></a>
    <h1><?=$this->section[0]['name']?></h1>
    <div id="sectionNav">
        <div class="linkNav" id="allSelect">Select all photos</div>
        <div id="deleteImages" class="btn red">Delete</div>
        <div class="btn grey" onclick="showPop('newImage');" >Add new photo</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <input id="sectionId" value="<? echo $this->id; ?>" type="hidden">
    <ul id="sortable" class="ui-sortable sortable modelListImages" rel="cosa">
        <?php foreach ($this->modelPhotos as $key => $value) {
            Back::isImage($value['photo_id']);
            ?>
            <li id="foo_<?php echo $value['id']; ?>" class="ui-state-default listImage modelList <? echo ($value['main']) ? 'mainPic' : '' ?>" onclick="">
                <input value="<?=$this->id.'_'.$value['id']; ?>" name="check[]" class="checkFoto" type="checkbox">
                <img caption="<?php echo $value['caption_' . LANG]; ?>" src="<?php echo URL . UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_file_name']; ?>"><a target="_blank" href="<?php echo URL . UPLOAD . $this->id . '/' . $value['img']; ?>"></a>
                <input id="h1096" class="btnSmall editImg" type="button" value="Edit" onclick="location.href = '<?php echo URL . LANG; ?>/home/viewImage/<?php echo $value['id']; ?>'" >
                <input  class="btnSmall deleteSingle" type="submit" value="Delete" style="background: #bb0000;">
            </li>
<?php } ?>
</div>

<div class="white_box hide" id="newImage" style="width:auto;left:30%;position:absolute;">
<?php $this->viewUploadFile($this->id, 'section'); ?>
</div>