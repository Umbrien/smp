#!/bin/bash

# usage: ./t14.sh yurii@nure.ua

# get username, domain sufix from email

echo Username: $(
  echo $1 | awk -F"@" '{print $1}'
)

echo Domain: $(
  echo $1 | awk -F"@" '{print $2}'
)

echo Domain suffix: $(
  echo $1 | awk -F"@" '{print $2}' | awk -F"." '{print $1}'
)

