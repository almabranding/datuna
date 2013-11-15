

<!--
    in reality you'd have this in an external stylesheet;
    i am using it like this for the sake of the example
-->
<style type="text/css">
    .Zebra_Form .optional { padding: 10px 50px; display: none }
</style>

<!--
    again, in reality you'd have this in an external JavaScript file;
    i am using it like this for the sake of the example
-->

<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>

<div class="row">
    <?= $label_name . $name ?>
</div>
<div class="row">
    <?= $label_visibility . $visibility ?>
</div>
<div class="row">
    <?= $label_templates . $templates ?>
</div>
<? foreach (Bootstrap::getLang() as $lng) { 
    $label_content='label_content_'.$lng;
    $content='content_'.$lng;
    $content_list='content_list_'.$lng;
    ?>
<div class="row even">
    <?= ${$label_content} ?>
</div>
    <div class="row ">
    <div class="col" style="display:inline-block;margin-right: 2%;width: 49%">
        <?= ${$content} ?>
    </div>
    <div class="col" style="display:inline-block;width: 48%">
        <?= ${$content_list}?>
    </div>
</div>
<? } ?>
<div class="row last"><?php echo $_btnsubmit ?></div>
