#!/bin/bash

# Doors
closed="[X]"
open_empty="[ ]"
open_prize="[&]"


echo3closed() {
  echo $closed $closed $closed
}

echoOpenedPrize() {
 case $1 in
   1) echo $open_prize $open_empty $open_empty ;;
   2) echo $open_empty $open_prize $open_empty ;;
   3) echo $open_empty $open_empty $open_prize ;;
  esac
}

echoUchoice() {
  # Door choosing
  c1=" ^         "
  c2="     ^     "
  c3="         ^ "

  case $1 in
    1) echo "$c1" ;;
    2) echo "$c2" ;;
    3) echo "$c3" ;;
  esac
}

echoOpenEqual() {
  # $1 is door we don't need to open
  # openedBool is global variable that creates here
  # openedDoor is created here too but used outside

  case $openedBool in
           # needed to chose left of right door
    0 | 1) local bool=$openedBool ;;
    *) local bool=$(shuf -i 0-1 -n 1)
       openedBool=$bool
      ;;
  esac
  case $1 in
    1) case $bool in
        0) echo $closed $open_empty $closed
           openedDoor=2
           ;;
        1) echo $closed $closed $open_empty
           openedDoor=3
           ;;
      esac
      ;;
    2) case $bool in
        0) echo $open_empty $closed $closed
           openedDoor=1
           ;;
        1) echo $closed $closed $open_empty
           openedDoor=3
           ;;
      esac
      ;;
    3) case $bool in
        0) echo $open_empty $closed $closed
           openedDoor=1
           ;;
        1) echo $closed $open_empty $closed
           openedDoor=2
           ;;
      esac
      ;;
  esac
}

getThirdByTwo() {
  # 1 + 2 = 3
  # 1 + 3 = 4
  # 2 + 3 = 5
  local sum=$(($1 + $2))
  case $sum in
    3) echo 3 ;;
    4) echo 2 ;;
    5) echo 1 ;;
  esac
}

echoOpenUnequal() {
  openedDoor=$(getThirdByTwo $1 $2)
  case $openedDoor in
    1) echo $open_empty $closed $closed ;;
    2) echo $closed $open_empty $closed ;;
    3) echo $closed $closed $open_empty ;;
  esac
}

# Random number 1 to 3
prize_door=$(shuf -i 1-3 -n 1)

clear
echo "Choose door (1-3)"
#echo "Choose door (1-3) ($prize_door)"
echo3closed
read -n 1 choice ; printf "\b"
echoUchoice $choice

sleep 1
clear

echo "One door opened"

if [ $choice -eq $prize_door ]; then
  echoOpenEqual $prize_door
else
  echoOpenUnequal $choice $prize_door
fi

echoUchoice $choice

sleep 3
clear

echo "Change your choice? (y/n)"
if [ $choice -eq $prize_door ]; then
  echoOpenEqual $prize_door
else
  echoOpenUnequal $choice $prize_door
fi
echoUchoice $choice
read -n 1 change ; printf "\b"

if [[ $change == "y" ]]; then
  choice=$(getThirdByTwo $choice $openedDoor)
fi

clear

echo Okay...
if [ $choice -eq $prize_door ]; then
  echoOpenEqual $prize_door
else
  echoOpenUnequal $choice $prize_door
fi
echoUchoice $choice

sleep 3
clear

if [ $choice -eq $prize_door ]; then
  echo You won!
else
  echo "You lose =("
fi
echoOpenedPrize $prize_door

echoUchoice $choice
