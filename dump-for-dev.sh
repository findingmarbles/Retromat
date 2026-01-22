#!/bin/bash

if [[ "$USER" != "retro2" ]]; then
  echo  >&2
  echo "Error: This script is specific to the live host." >&2
  echo  >&2
  echo "For development purposes, please read README_dev_Docker.md or README_dev_Uberspace.md" >&2
  echo  >&2
  exit 1
fi

cd /var/www/virtual/retro2/retromat.git/backend/sql-dumps/

/usr/bin/mysqldump --defaults-file=/home/retro2/.my.cnf retro2_retromat > tmp_retro2_retromat.sql





# rm tmp_retro2_retromat.sql