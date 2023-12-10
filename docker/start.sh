#!/usr/bin/sh

app_dir=$1
php=/usr/local/bin/php
artisan="${app_dir}/artisan"

sleep 5
$php "${artisan}" migrate --seed
$php "${artisan}" serve --host=0.0.0.0 --port=8000
