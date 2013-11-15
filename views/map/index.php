<section class="container-margin" style="height: 75%;">
    <div id="map">
        <?php foreach ($this->gallery as $value) { ?>
        <!--<a href="<?php //echo IMAGES . $this->page['id'] . '/' . $value['img']; ?>" target="_blank" id="download"></a>-->
            <img class="map" style="width: 100%" src="<?php echo IMAGES . $this->page['id'] . '/' . $value['img']; ?>" alt="<?php echo $value['caption']; ?>">
        <?php } ?>
    </div>
</section>
<section id="descInfoRight">
    <?php echo $this->page['content_'.LANG]; ?>  
</section>