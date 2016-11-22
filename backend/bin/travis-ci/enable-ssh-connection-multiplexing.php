<?php

$config = "
Host vega.uberspace.de
\tStrictHostKeyChecking no
\tControlMaster auto
\tControlPath ~/.ssh/master-%r@%h:%p
\tControlPersist 1h
";

file_put_contents(getenv('HOME').'/.ssh/config', $config, FILE_APPEND);
