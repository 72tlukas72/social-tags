<?php

use Sunlight\Article;
use Sunlight\Core;
use Sunlight\Router;
use Sunlight\Template;

return function(array $args) {
    global $_index;
    
    $localeMap = [
        'cs'          => 'cs_CZ',
        'de'          => 'de_DE',
        'en'          => 'en_GB',
        'hu'          => 'hu_HU',
        'sk'          => 'sk_SK',
    ];
    
    $args['output'] .= "\n<meta property=\"og:url\" content=\"" . Core::getCurrentUrl()->build() . "\">";
    $args['output'] .= "\n<meta property=\"og:title\" content=\"" . Template::title() . "\">";
    
    if(Template::currentIsArticle()) {
        global $_article;
        
        $args['output'] .= "\n<meta property=\"og:type\" content=\"article\">";
        
        if($_article['picture_uid']) {
            $image = Article::getImagePath($_article['picture_uid']);
            $image_url = _e(Router::file($image, ['absolute' => true]));
        }
        else {
           $image_url = _e(Template::asset('images/logo.png', ['absolute' => true]));
        }
    }
    else {
        $args['output'] .= "\n<meta property=\"og:type\" content=\"website\">";
        $image_url = _e(Template::asset('images/logo.png', ['absolute' => true]));
    }
    
    $args['output'] .= "\n<meta property=\"og:image\" content=\"" . $image_url . "\">"; 
    $description = $_index->description ?? Template::siteDescription();
    $args['output'] .= "\n<meta property=\"og:description\" content=\"" . $description . "\">";
    $args['output'] .= "\n<meta property=\"og:site_name\" content=\"" . Template::siteTitle() . "\">";
    $args['output'] .= "\n<meta property=\"og:locale\" content=\"" . $localeMap[_e(Core::$langPlugin->getIsoCode())] . "\">";
    
    if (!empty($this->getConfig()['app_id'])) {
        $args['output'] .= "\n<meta property=\"fb:app_id\" content=\"" . $this->getConfig()['app_id'] . "\">";
    } 
    
    $args['output'] .= "\n<meta name=\"twitter:card\" content=\"summary\">";
    
    if (!empty($this->getConfig()['site'])) {
        $args['output'] .= "\n<meta name=\"twitter:site\" content=\"" . $this->getConfig()['site'] . "\">";
    }
    
    if (!empty($this->getConfig()['creator'])) {
        $args['output'] .= "\n<meta name=\"twitter:creator\" content=\"" . $this->getConfig()['creator'] . "\">";
    } 
};
