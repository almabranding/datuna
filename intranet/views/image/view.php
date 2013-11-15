<div id="sectionHeader">
    <a href="<?= URL ?>projects/gallery/<?=$this->project_id; ?>"><div id="arrowBack">Back to project</div></a>
    <h1>Edit Image</h1>
    <div id="sectionNav">
        <div class="btn grey" onclick="$('#cropForm').submit();" >Crop image</div>
    </div>
    <div class="clr"></div>
</div>
<? $this->form->render('templates/image.php'); ?>

        
<div class="container">

        <img src="<?php echo URL . UPLOAD . 'images/' . Model::idToRute($this->img['photo_id']) . $this->img['file_name']; ?>" id="target" alt="[Jcrop Example]" />
        <div id="preview-pane">
            <div class="preview-container">
                <img src="<?php echo URL . UPLOAD . 'images/' . Model::idToRute($this->img['photo_id']) . $this->img['file_name']; ?>" class="jcrop-preview" alt="Preview" />
            </div>
        </div>
        <form id="cropForm" action="<?php echo URL; ?>image/crop" method="post" onsubmit="return checkCoords();">
            <label><input type="checkbox" id="ar_lock" name="thumbnail" />Apply to thumb</label>
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="rel" name="rel" />
            <input type="hidden" id="original" name="original" value="<?php echo $this->img['file_name']; ?>"/>
            <input type="hidden" name="id" value="<?=$this->id; ?>"/>
            <input type="hidden" name="model_id" value="<?=$this->img['project_id']; ?>"/>
            <input type="hidden" id="filename" name="filename" value="<?php echo $this->img['file_name']; ?>"/>
            <input type="hidden" name="filefolder" value="images/<?php echo Model::idToRute($this->img['photo_id']); ?>"/>
        </form>
    <div class="clearfix"></div>
</div>

<script type="text/javascript">
            
                // Create variables (in this scope) to hold the API and image size
                var jcrop_api,
                        boundx,
                        boundy,
                        // Grab some information about the preview pane
                        $preview = $('#preview-pane'),
                        $pcnt = $('#preview-pane .preview-container'),
                        $pimg = $('#preview-pane .preview-container img'),
                        xsize = $pcnt.width(),
                        ysize = $pcnt.height();

                $('#target').Jcrop({
                    onChange: updatePreview,
                    onSelect: updatePreview,
                    aspectRatio: 0
                }, function() {
                    // Use the API to get the real image size
                    var bounds = this.getBounds();
                    boundx = bounds[0];
                    boundy = bounds[1];
                    // Store the API in the jcrop_api variable
                    jcrop_api = this;

                    // Move the preview into the jcrop container for css positioning
                    $preview.appendTo(jcrop_api.ui.holder);
                });
                $('#ar_lock').change(function(e) {
                    var filename=$('#original').val();
                    if(this.checked){$('#filename').val('thumb_'+filename)} else {$('#filename').val(filename)}
                    jcrop_api.setOptions(this.checked ? {aspectRatio: 1.61} : {aspectRatio: 0});
                    jcrop_api.focus();
                });
          
            function updatePreview(c)
            {
                $('.avatar').css('display', 'none');
                $('.preview').css('display', 'inherit');
                if (parseInt(c.w) > 0)
                {
                    var rx = c.w / c.w;
                    var ry = c.h / c.h;

                    $pcnt.css({
                        width: Math.round(c.w) + 'px',
                        height: Math.round(c.h) + 'px'
                    });
                    $pimg.css({
                        width: Math.round(rx * boundx) + 'px',
                        height: Math.round(ry * boundy) + 'px',
                        marginLeft: '-' + Math.round(rx * c.x) + 'px',
                        marginTop: '-' + Math.round(ry * c.y) + 'px'
                    });
                }
                updateCoords(c);
            }


            function updateCoords(c)
            {
                var img = document.getElementById('target');
//or however you get a handle to the IMG

                var width = img.width;
                var width = img.width;
                var height = img.height
                var rel = width / $('#target').width();
                //rel=1.98;
                $('#rel').val(rel);
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
                $('#width').text(c.w);
                $('#height').text(c.h);
            }

            function checkCoords()
            {
                if (parseInt($('#w').val()))
                    return true;
                alert('Select the area first');
                return false;
            }

            function hidePreview()
            {
                $preview.stop().fadeOut('fast');
            }




</script>


