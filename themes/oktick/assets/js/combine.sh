#!/bin/bash


# ALWAYS OVERWRITE MOST RECENT
> oktick.raw.js
> oktick.js

cat fw.js fw2.js auto.js more.js dot.js ot.js dialog.js > oktick.raw.js

minifyjs -m -i oktick.raw.js -o oktick.js
echo "done"
