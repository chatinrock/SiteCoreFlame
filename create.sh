#!/bin/bash
siteName="iorator.ru"
mkdir $siteName/www/
mkdir $siteName/data/comp
chown -r www-data:www-data $siteName/data/comp
mkdir $siteName/core/
mkdir $siteName/conf/
cp site-tpl/conf/* $siteName/conf/
mkdir /opt/nginx-1.2.0/logs/nlogs/$siteName
