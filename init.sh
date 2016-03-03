#!/bin/bash

curPath=`dirname $0`
cd $curPath
prjHome=`pwd`

$prjHome/rigger/client/rigger.sh cmd=conf sys=all env=dev
$prjHome/rigger/client/rigger.sh cmd=restart env=dev
