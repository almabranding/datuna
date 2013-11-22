
<section id='sections'>
    <section class='hideSection' id='bio'>
        <article class='frame'>
            <img src="/uploads/images/datunaPhoto.png">
        </article>
        <article class='text'>
            <div class="title">
                <h1>David Datuna</h1>
                <div class='closeico'></div>
            </div>
            <p>Beginning in early 2012, artist David Datuna had his eye on Glass. The new wearable computer from Google is one of the most sought-after technologies of the past 100 years. David has watched the social phenomenon from a distance, gauging how he feels the world will interact with it. As 2013 marched forward David continued to explore ideas of how to incorporate Glass into his art. Utilizing eyeglasses as his traditional medium for the past several years in his Viewpoint of Millions series </p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        </article>
        <div class="clr"></div>
    </section>

</section>
<section id="navegation">
    <ul>
        <li onclick='openSection("bio");'>
            <p class='text'>GLASSFEED</p>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <p class='text'>CONCEPT</p>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <p class='text'>176,42</p>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <p class='text'>CONTACT</p>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <p class='text'>BIO</p>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <p class='text'>EVENTS</p>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <p class='text'>PRESS</p>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <img class='img' src='/uploads/images/img01.png'/>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <img class='img' src='/uploads/images/img02.png'/>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <img class='img' src='/uploads/images/img03.png'/>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <img class='img' src='/uploads/images/img04.png'/>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <img class='img' src='/uploads/images/img05.png'/>
            <img class='guide' src='/public/img/guide.png'>
        </li><li>
            <img class='img' src='/uploads/images/img06.png'/>
            <img class='guide' src='/public/img/guide.png'>
        </li><?
        foreach ($this->tumblrPosts->posts as $post) {
            if ($post->photos) {
                foreach ($post->photos as $photo) {
                    ?><li>
                        <img class='img <?= ($photo->alt_sizes[0]->height > $photo->alt_sizes[0]->width) ? 'vertical' : 'horizontal' ?>' src='<?= $photo->alt_sizes[0]->url ?>'/>
                        <img class='guide' src='/public/img/guide.png'>
                    </li><?
                }
            }
            if ($post->player) {
                (!file_exists('uploads/gifs/'+$post->id.'.gif'))?Model::toGif(Model::thumbVideos($post->thumbnail_url,$post->id),$post->id):"";
                foreach ($post->player as $key => $video) {
                    if ($key == 2) {?><li>
                        <img class='img preGif' data-alt-src="<?= UPLOAD.'gifs/'.$post->id.'.gif' ?>" src='<?= UPLOAD.'gifs/'.$post->id.'.jpg' ?>'/>
                        <? $video->embed_code ?>
                            <img class='guide' src='/public/img/guide.png'>
                        </li><?
                    }
                }
            }
        }
        ?></ul>
</section>
<?
?>