<?php

$config = "
Host vega.uberspace.de
\tStrictHostKeyChecking no
\tControlMaster auto
\tControlPath ~/.ssh/master-%r@%h:%p
\tControlPersist 2m
";

file_put_contents(getenv('HOME').'/.ssh/config', $config, FILE_APPEND);
