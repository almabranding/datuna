<section class="container-margin">
<div class="preload"></div>
<div id="page">
    <div>
         <?php foreach ($this->gallery as $value) { ?>
            <img style="width: 100%" src="<?php echo IMAGES . $this->page['id'].'/'.$value['img']; ?>" alt="<?php echo $value['caption']; ?>">
        <?php } ?>
    </div>
</div>
</section>
<section id="descInfoRight">
    <?php echo $this->page['content_'.LANG];?>  
</section>