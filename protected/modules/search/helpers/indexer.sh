#!/bin/sh

cd /var/www/tomsk_portal/protected/modules/search/helpers/index/
rm -rf /var/www/html/tomsk_portal/modules/search/helpers/index/*

wget -r --no-verbose --no-directories --reject css,js,ico,rss,jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF,CSS,JS,ICO,RSS,doc,DOC,docx,DOCX,pdf,PDF,rtf,captcha* -o "index.log" http://tomsk_portal.dpridprod.ru

cd /var/www/tomsk_portal/protected/
./yiic SphinxIndexer index

indexer --rotate tomsk