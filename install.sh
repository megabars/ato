#!/bin/bash

mkdir public/assets
chmod 777 public/assets

mkdir public/uploads
chmod 777 public/uploads

mkdir protected/runtime
chmod 777 protected/runtime

cd protected/config/
cp connect_example.php connect.php

nano connect.php

echo "after db configuration you must run command: "
echo "  protected/yiic migrate"



