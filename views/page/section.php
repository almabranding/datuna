<section class="container-margin" style="background:#fff;height: 100%;">
    <?php foreach ($this->gallery as $value) { ?>
        <div id="sectionImage" style="background: url('<?php echo IMAGES . $this->page['id'] . '/' . $value['img']; ?>') no-repeat scroll 0 0 transparent"></div>
    <?php } ?>
    <div id="sectionText">
        <?php echo $this->page['content_'.LANG]; ?>
    </div>
    <div class="clr"></div>
</section>