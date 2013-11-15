<section id="thumbWrap">
    <ul>
    <? foreach ($this->projects as $key=>$value) { $col='col-'.($key%4); ?><li class="thumbBox <?=$col?>">
        <a href="<?=URL.'page/gallery/'.$value['project_id'].'-'.urlencode($value['name']);?>">
                <img alt="<?= $value['caption_' . LANG]; ?>" src="<?=  UPLOAD . 'images/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_name']; ?>"/>
            </a>
        <div><img src="/public/img/thumbBox.png"/></div>
        </li><? } ?>
    </ul>
</section>
<? if($this->pag['now']!=$this->pag['min']){ ?>
<a id="prev-project" class="left history noselect" href="/project/pag/<?=$this->pag['now']-1?>">
<span class="iconfont left"></span>
</a>
<? }if($this->pag['now']<$this->pag['max']){ ?>
<a id="next-project" class="left history noselect" href="/project/pag/<?=$this->pag['now']+1?>">
<span class="iconfont left"></span>
</a>
<? }