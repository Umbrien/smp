#!/bin/bash

# Застосовувати команди організації циклу
# та примусового завершення поточної ітерації або самого циклу.

i=0

while [ $i -lt 10 ]; do
  if [ $i -eq 7 ]; then
    break
  fi

  printf "$i "
  i=$(($i + 1))
done

echo

