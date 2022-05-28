#!/bin/bash

# Використовувати команду shift
# для доступу до десятої позиційної змінної
# та до подальших позиційних змінних

if [ $# -lt 1 ]; then
  echo "Usage: $0 [<args>]"
fi

shift 9

printf "I can access "
while (($#)); do
  printf "$1 "
  shift
done
echo

