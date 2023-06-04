#!/bin/bash

while IFS= read -r line
do
  if [[ $line =~ ^\[submodule ]]; then
    # Extract submodule name from line
    submodule=$(echo "$line" | sed 's/^\[submodule "//;s/".*$//')
    
    # Read submodule repository URL
    read -r url
    path=$(echo "$url" | awk '{print $3}')
    
    # Read submodule directory path
    read -r path
    url=$(echo "$path" | awk '{print $3}')
    
    # Add the submodule
    git submodule add "$url" "$path"
  fi
done < .gitmodules
