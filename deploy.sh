#!/bin/bash

echo "normal usage is \"./deploy.sh application\" if you dont have changes in jpg or css";

if [ $# -eq 0 ]
then
    echo "no argument passed, assuming all and deploying"
    deploy="all"
else
    deploy=$1
fi

if [ "$deploy" = "all" ];
then
    echo "copying files to server";
    scp -r -i ~/.ssh/ishwar.pem ./application  ubuntu@54.148.57.96:/tmp/mysite/application
    scp -r -i ~/.ssh/ishwar.pem ./data  ubuntu@54.148.57.96:/tmp/mysite/data
    scp -r -i ~/.ssh/ishwar.pem ./public  ubuntu@54.148.57.96:/tmp/mysite/public
    scp -r -i ~/.ssh/ishwar.pem ./play.php  ubuntu@54.148.57.96:/tmp/mysite/
elif [ "$deploy" = "application" ]
then
    echo "copying files to server";
    scp -r -i ~/.ssh/ishwar.pem ./application  ubuntu@54.148.57.96:/tmp/mysite/application
elif [ "$deploy" = "data" ]
then
    echo "copying files to server";
    scp -r -i ~/.ssh/ishwar.pem ./data  ubuntu@54.148.57.96:/tmp/mysite/data
elif [ "$deploy" = "public" ]
then
    echo "copying files to server";
    scp -r -i ~/.ssh/ishwar.pem ./public  ubuntu@54.148.57.96:/tmp/mysite/public
elif [ "$deploy" = "play.php" ]
then
    echo "copying files to server";
    scp -r -i ~/.ssh/ishwar.pem ./play.php  ubuntu@54.148.57.96:/tmp/mysite/
else
    echo "wrong argument, valid is all | application | data | public | play.php ";
    exit;
fi

sshpass ssh -o "StrictHostKeyChecking no" -o ConnectTimeout=10 -i ~/.ssh/ishwar.pem ubuntu@54.148.57.96 "sudo cp -r /tmp/mysite /usr/share/nginx/mysite"


