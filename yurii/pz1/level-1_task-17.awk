#!/usr/bin/awk -f

BEGIN {
  phone = "^\+380([50|66|67|96|97|98])[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$";
}

$1 ~ phone {
  print $1;
}
