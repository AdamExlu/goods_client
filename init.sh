#!/bin/sh
host=`ip addr | grep /24 | awk '{print $2}' | awk -F '/' '{print $1}'`

context="HOST="$host"\n"

#获取控制台参数
while getopts "i:p:" opt; do
  case $opt in
    i)
      context=$context"HOST_IP="$OPTARG"\n"
    ;;
    p)
      context=$context"HOST_PORT="$OPTARG"\n"
    ;;
  esac
done

#生成.env配置文件
echo -e $context > /var/www/.env
