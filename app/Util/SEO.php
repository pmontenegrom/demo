<?php namespace App\Util;

class SEO {

    public static function url_redirect($article, $params=NULL){

    	$url=NULL;
        switch($article->ref_type){
            case 1:
                $url=self::url_redirect_id($article->ref_id);
                break;
            case 2:
                $allowed_chars='[a-z0-9\/:_\-_\.\?\$,~=#&%\+@]';
                $url=!preg_match('/^((http|https|ftp):\/\/)|(mailto:)'. $allowed_chars .'+$/i', strtolower($article->ref_url))? url('http://'.$article->ref_url): $article->ref_url;
                break;
            default:
                $url=self::url_empty();
                break;
        }

    	return $url.($params!=NULL?'?'.$params:'');
    }

    public static function url_redirect_id($id){
        if(empty($id)) return self::url_home();

        $article =\App\CmsArticle::select()->find($id);
        if($article){
            return self::url_slug($article->slug);
        }
        else{
            return self::url_empty();
        }
    }

    public static function url_article($article){
        return self::url_slug($article->slug);
    }

    public static function url_target($article){

        switch ($article->ref_target) {
            case 2:
                return '_blank';
                break;
            case 1:
            default:
                return NULL;
                break;
        }
    }

    public static function url_slug($slug){
        return url('/'.$slug.'.html');
    }

    public static function url_home(){
        return url('/');
    }

    public static function url_root(){
        return url('/');
    }

    public static function url_empty(){
        return url('#');
    }

    public static function url_notfound(){
        return url('/index.html#404'); //url('/notfound');
    }

}
?>