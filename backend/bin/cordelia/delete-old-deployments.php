<?php
$keepYoungest = 5;

exec ('cd /var/www/virtual/retro2/retromat-deployments ; ls -1 | grep ^20', $deploymentDirs);
$deleteOldest = (count($deploymentDirs)-$keepYoungest);
for ($i =0 ; $i <= $deleteOldest+1 ; $i++)
{
    exec ('cd /var/www/virtual/retro2/retromat-deployments ; rm -rf ' . $deploymentDirs[$i]);
}

exec ('cd /var/www/virtual/retro2/retromat-artifacts ; ls -1 | grep ^20', $artifactsDirs);
$deleteOldest = (count($artifactsDirs)-$keepYoungest);
for ($i =0 ; $i <= $deleteOldest+1 ; $i++)
{
    exec ('cd /var/www/virtual/retro2/retromat-artifacts ; rm -rf ' . $artifactsDirs[$i]);
}

exec ('cd /var/www/virtual/retro2/sql-dumps ; ls -1 | grep ^mysql_all_20', $sqlDirs);
$deleteOldest = (count($sqlDirs)-$keepYoungest);
for ($i =0 ; $i <= $deleteOldest+1 ; $i++)
{
    exec ('cd /var/www/virtual/retro2/sql-dumps ; rm -rf ' . $sqlDirs[$i]);
}