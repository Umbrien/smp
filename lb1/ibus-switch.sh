#!/bin/bash

if [[ `ibus engine | awk -F":" '{ print $2 }'` == "us" ]]; then
	ibus engine 'xkb:ru::rus'
else
	ibus engine 'xkb:us::eng'
fi

