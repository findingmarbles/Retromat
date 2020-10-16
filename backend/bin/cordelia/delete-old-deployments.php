<?php
exec ('cd /var/www/virtual/retro2/retromat-deployments ; ls -1 | grep ^20', $deploymentDirs);
$keepYoungest = 5;
$deleteOldest = (count($deploymentDirs)-$keepYoungest);
for ($i =0 ; $i <= $deleteOldest ; $i++)
{
    $deploymentDirs[$i];
    exec ('cd /var/www/virtual/retro2/retromat-deployments ; rm -rf ' . $deploymentDirs[$i]);
}
