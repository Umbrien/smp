#!/bin/bash

f() {
  sleep "$1"
  printf "$1 "
}

while [ -n "$1" ]; do
  f "$1" &
  shift
done

wait

echo
