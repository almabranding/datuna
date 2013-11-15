<section class="container-margin" style="height: 70%;">
    <div id="video">
        <iframe src="http://player.vimeo.com/video/<?php echo $this->page['vimeo'];?>?autoplay=0&api=1&player_id=player" width='100%' height='100%'  frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
    </div>
</section>
<section id="descInfoRight">
    <?php echo $this->page['content_'.LANG]; ?>  
</section>
<script src="http://a.vimeocdn.com/js/froogaloop2.min.js?216a2-1366640435"></script>