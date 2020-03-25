#!/bin/zsh
setopt extendedglob
errors=0

for file in src/**/*.php; do
  output=$(php -l "$file")
  retVal=$?
  if [ $retVal -ne 0 ]; then
    echo $output
    (( errors++ ))
  fi
done

exit $errors
