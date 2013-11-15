<? $packURL= PACKAGE . urlencode(str_replace('&','and',$this->package['id'] . ' ' .$this->package['name'])).'/' . $this->package['type'];
$packURL=str_replace('+','-',$packURL);?>
<div id="sectionHeader">
    <a href="<?= URL ?>packages/lista"><div id="arrowBack">Back to packages</div></a>
    <h1><?= $this->package['name'] ?></h1>
    <div id="sectionNav">
        <a href="<?= $packURL ?>" target="_blank"><div class="linkNav" id="">View package</div></a>
        <a href="<?php echo URL . LANG; ?>/packages/sortByName/<?= $this->id; ?>"><div class="linkNav" id="">Order by name</div></a>
        <div class="btn blue" onclick="location.href = '<?php echo URL . LANG; ?>/packages/addModel/<?php echo $this->id; ?>'" >Add a model</div>
        <div class="btn grey" onclick="location.href = '<?php echo URL . LANG; ?>/packages/editCreatePackage/<?php echo $this->id; ?>'">Edit package</div>
        <div class="btn grey" onclick="location.href = '<?php echo URL . LANG; ?>/packages/deliver/<?php echo $this->id; ?>'">Deliver package</div>
        <div class="btn red" id="deleteModels" onclick="">Delete models</div>
        <div class="btn red" id="deletePackage" onclick="">Delete package</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <h4><?= $packURL?></h4>
    <input type="hidden" value="<?= $this->id; ?>" id="packageId">
    <ul id="sortable" class="ui-sortable sortable" rel="cosa">
        <?php foreach ($this->modelsPackage as $key => $value) { ?>
            <li id="foo_<?= $value['model_id']; ?>" class="ui-state-default listImage modelList" onclick="">
                <input value="<?php echo $this->id; ?>_<?php echo $value['model_id']; ?>" name="check[]" class="checkFoto" type="checkbox">
                <img caption="<?php echo $value['caption_' . LANG]; ?>" src="<?php echo URL . UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_file_name']; ?>">
                <p><?php echo $value['name']; ?></p>
                <a href="<?php echo URL . LANG; ?>/models/editportafolio/<?= $value['model_id']; ?>" target="_blank"><input class="btnSmall editImg" type="button" value="Portfolio"></a>
                <input id="" class="btnSmall deleteSingle" type="submit" value="Delete"onclick="" style="background: #bb0000;">
            </li>
        <?php } ?>
</div>