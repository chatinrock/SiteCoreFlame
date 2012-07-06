#!/bin/bash
siteName="iorator.ru"
mkdir $siteName/www/
mkdir $siteName/data/
mkdir $siteName/core/
mkdir $siteName/conf/
cp site-tpl/conf/* $siteName/conf/
mkdir /opt/nginx-1.2.0/logs/nlogs/$siteName
