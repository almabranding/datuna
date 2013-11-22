</div>
<footer>
    <div class="col first">©2013 Datuna</div>
    <div class="col">
    </div>
</footer>
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=URL; ?>public/js/shadowbox.js"></script>
<script type="text/javascript">
    Shadowbox.init({
        overlayOpacity: 1,
    });
</script>
<script src="<?=URL; ?>public/js/custom.js"></script>
<?php
if (isset($this->js))
    foreach ($this->js as $js)
        echo '<script type="text/javascript" src="' . URL . 'views/' . $js . '"></script>';
?>
</body>
</html>