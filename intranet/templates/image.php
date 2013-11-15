

<!--
    in reality you'd have this in an external stylesheet;
    i am using it like this for the sake of the example
-->
<style type="text/css">
    .Zebra_Form .optional { padding: 10px 50px; display: none }
</style>
<script type="text/javascript">
    var mycallback = function(value, segment) {
        $segment = $('.optional' + segment);
        if (value) $segment.show();
        else $segment.hide();
    }
</script>

<!--
    again, in reality you'd have this in an external JavaScript file;
    i am using it like this for the sake of the example
-->

<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>

<div class="row">
    <?= $label_caption . $caption ?>
</div>
<div class="row even">
    <?= $label_visibility . $visibility ?>
</div>
<div class="row">
    <?= $label_isvideo ?>
    <div class="cell"><?php echo $label_isvideo_1?></div>
    <div class="cell"><?php echo $isvideo_1?></div>
    <div class="cell"><?php echo $label_isvideo_0?></div>
    <div class="cell"><?php echo $isvideo_0?></div>
    <div class="clr"></div>
</div>
 <div class="optional optional1">
        <?php echo $label_video?>
        <div class="cell"><?php echo $video?></div>
        <div class="clear"></div>
 </div>
<div class="row even last"><?php echo $_btnsubmit ?></div>
