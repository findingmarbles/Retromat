<?php

for ($i=1 ; $i < 21 ; $i++) {
    system('ssh timon@vega.uberspace.de "echo ssh command ' . $i . ' "');
    sleep(2);
}
