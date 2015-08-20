$(document).ready(function() {
    if ($('.page-title').size()) {
        $('.page-title').syncTranslit({destination: 'Page_url'});
    }
});