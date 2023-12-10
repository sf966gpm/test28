#!/usr/bin/sh

app_dir=$1
php=/usr/local/bin/php
artisan="${app_dir}/artisan"

# На всякий случай, иногда не успевает встать postgres
sleep 1
$php "${artisan}" migrate --seed
$php "${artisan}" serve --host=0.0.0.0 --port=8000
