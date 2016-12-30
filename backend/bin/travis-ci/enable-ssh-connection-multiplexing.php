<?php

$config = "
Host avior.uberspace.de
\tStrictHostKeyChecking no
\tControlMaster auto
\tControlPath ~/.ssh/master-%r@%h:%p
\tControlPersist 15
";

file_put_contents(getenv('HOME').'/.ssh/config', $config, FILE_APPEND);
