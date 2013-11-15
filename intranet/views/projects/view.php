<div id="sectionHeader">
    <? if($this->project){ ?>
    <a href="<?=URL?>projects/gallery/<?=$this->project['id'];?>"><div id="arrowBack">Back to project</div></a>
    <h1>Edit <?=$this->project['name'];?></h1>
    <? }else{?>
     <a href="<?=URL?>projects/lista"><div id="arrowBack">Back to projects</div></a>
    <h1>Create project</h1>
    <?}?>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <?php $this->form->render('templates/project_view.php'); ?>
</div>
