<?php
use \App\Util\SEO;
use \App\Util\XMLParser;
use Illuminate\Support\Facades\Request;

$q = Request::input('q');
?>
<h1>{{ $page->title }}</h1>
<div class="box">
  <div class="texto100"></div>
</div>
<script src="http://www.google.com.pe/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  google.load('search', '1', {language : 'es', style : google.loader.themes.V2_DEFAULT});
  google.setOnLoadCallback(function() {
    var customSearchOptions = {};  var customSearchControl = new google.search.CustomSearchControl(
      '004103403676216795880:hfyzoduhyuc', customSearchOptions);
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    customSearchControl.draw('cse');
    customSearchControl.execute('{{ $q }}');
  }, true);
</script>
<script type="text/javascript" src="/assets/website/js/jquery.jqtransform.js"></script>
<style type="text/css">
.contenedor_full h1{
    width: 100%;
    color: #00abd5;
    font-size: 24px;
    font-family: 'museo_sans500';
    text-transform: uppercase;
    margin-bottom: 30px;
}
.cse .gsc-search-button input.gsc-search-button-v2, input.gsc-search-button-v2{
    width: initial;
    height: initial;
}
</style>