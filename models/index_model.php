<?php
class Index_Model extends Model {
    public function __construct() {
        parent::__construct();
    }
    public function getTumblrPosts(){
        $tumblr=new tumblr();
        $client=$tumblr->getClient();
        return $client->getBlogPosts('borndevelpments.tumblr.com');
        
    }
}