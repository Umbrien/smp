#!/bin/bash

# usage: ./level-1_task-14.sh yurii@nure.ua

# Витягнути нікнейм користувача, ім’я домену та суфікс із даних e-mail адреси.

echo Username: $(
  echo $1 | awk -F"@" '{print $1}'
)

echo Domain: $(
  echo $1 | awk -F"@" '{print $2}'
)

echo Domain suffix: $(
  echo $1 | awk -F"@" '{print $2}' | awk -F"." '{print $1}'
)

