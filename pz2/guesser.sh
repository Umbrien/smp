#!/bin/bash

balance=$1

incBalance(){
  echo You guessed right!
  balance=$(($balance + $bid))
}

decBalance(){
  echo You guessed wrong
  balance=$(($balance - $bid))
}


while [ $balance -gt 0 ]; do

  echo Your balance is $balance
  echo Enter your bid
  read bid

  if [ $bid -le $balance ]; then 
    echo Greater or lower? g/l
    read inp

    n=$(shuf -i 0-500 -n 1)
    echo number is $n
    if [[ $n -lt 250 ]]; then
      if [[ $inp == "l" ]]; then
        incBalance
      else
        decBalance
      fi
    else
      if [[ $inp == "r" ]]; then
        incBalance
      else
        decBalance
      fi
    fi
  fi

  echo

done
