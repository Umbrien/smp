#!/bin/bash

cat t9.sh > /dev/null 2> /dev/null && (ls ; echo ; df) || ls -lah

