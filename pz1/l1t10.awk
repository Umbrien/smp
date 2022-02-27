#!/usr/bin/awk -f

BEGIN {
	#regex = "^[_a-zA-Z0-9]{1,15}$";
	#regex = "^([_a-zA-Z0-9]{1,15})$";
	regex = "^[_a-zA-Z0-9](?[_a-zA-Z0-9])$";
}

$1 ~ regex {
	print $1, "is valid twitter username";
}
