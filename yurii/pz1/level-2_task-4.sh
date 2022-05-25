#!/bin/bash

echo enter color:
read color

case $color in
  red)
    echo "#ff0000"
    ;;

  green)
    echo "#00ff00"
    ;;

  blue)
    echo "#0000ff"
    ;;

  *)
    echo "Unknown color"
    ;;

esac

