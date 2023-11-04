<?php

namespace Sunlight;

return function(array $args) {
    global $_index;
    
    $args['output'] .= "\n<meta property='og:url' content='" . Template::siteUrl() . $_index->slug . "' />";
    $args['output'] .= "\n<meta property='og:title' content='" . Template::title() . "' />";
    
    if(Template::currentIsArticle()) {
        $args['output'] .= "\n<meta property='og:type' content='article' />";

        if(Article::find($_index->segment)['picture_uid']) {
            $image = Article::getImagePath(Article::find($_index->segment)['picture_uid']);
            $image_url = _e(Template::siteUrl() . Router::file($image));
        }
        else {
           $image_url = _e(Template::siteUrl() . Template::asset('images/logo.png'));
        }
    }
    else {
        $args['output'] .= "\n<meta property='og:type' content='website' />";
        $image_url = _e(Template::siteUrl() . Template::asset('images/logo.png'));
    }
    
    $args['output'] .= "\n<meta property='og:image' content='" . $image_url . "' />"; 
    $description = $_index->description ?? Settings::get('description');
    $args['output'] .= "\n<meta property='og:description' content='" . $description . "' />";
    $args['output'] .= "\n<meta property='og:site_name' content='" . Template::siteTitle() . "' />";
    $args['output'] .= "\n<meta property='og:locale' content='cs_CZ' />";
    
    if ($this->getConfig()['app_id'] && $this->getConfig()['app_id'] != "0000") {
        $args['output'] .= "\n<meta property='fb:app_id' content='" . $this->getConfig()['app_id'] . "' />";
    } 
    
    $args['output'] .= "\n<meta name='twitter:card' content='summary' />";
    
    if ($this->getConfig()['site'] && $this->getConfig()['site'] != "@default") {
        $args['output'] .= "\n<meta name='twitter:site' content='" . $this->getConfig()['site'] . "' />";
    }
    
    if ($this->getConfig()['creator'] && $this->getConfig()['creator'] != "@default") {
        $args['output'] .= "\n<meta name='twitter:creator' content='" . $this->getConfig()['creator'] . "' />";
    } 
};
