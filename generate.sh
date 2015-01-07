#!/bin/env sh
rm -Rf cache master develop
vendor/bin/sami.php update sami_config.php
