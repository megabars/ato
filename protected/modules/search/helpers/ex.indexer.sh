#!/bin/sh
cd /home/tigra/www/udmurtiya/protected/modules/search/helpers/index
rm -rf /home/tigra/www/udmurtiya/protected/modules/search/helpers/index/*

wget -r --no-verbose --no-directories --reject css,js,ico,rss,jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF,CSS,JS,ICO,RSS,doc,DOC,docx,DOCX,pdf,PDF,rtf,captcha* -o "index.log" http://udmurtiya.dev

cd /home/tigra/www/udmurtiya/protected/
./yiic SphinxIndexer index

indexer --rotate udmurtiya_content