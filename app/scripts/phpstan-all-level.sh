#!/bin/bash

rm -rf ".phpstan_result"
mkdir -p ".phpstan_result"

for i in $(seq 0 9) ; do
    php vendor/bin/phpstan analyse \
        --level $i \
        --configuration "phpstan-common.neon" \
        --error-format=prettyJson \
        > ".phpstan_result/phpstan_result_level_$i.json"
done
