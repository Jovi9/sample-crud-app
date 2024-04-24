#!/bin/bash

function php() {
     if [ "$2" == "" ]; then
          touch "$1.php"
     else
          mkdir -p "$1"
          touch "$1/$2.php"
     fi
}

function class() {
     filename=""
     if [ "$2" == "" ]; then
          touch "$1.php"
          filename="$1.php"
     elif [ "$2" == "-n" ]; then
          touch "$1.php"
          filename="$1.php"

          local namespace=$(addNamespace "$1")
          echo "<?php" >>"$filename"
          echo "namespace $namespace;" >>"$filename"
          echo "class $1 {}" >>"$filename"
     else
          mkdir -p "$1"
          touch "$1/$2.php"
          filename="$1/$2.php"

          if [ "$3" == "-n" ]; then
               local namespace=$(addNamespace "$1")
               echo "<?php" >>"$filename"
               echo "namespace $namespace;" >>"$filename"
               echo "class $2 {}" >>"$filename"
          fi
     fi
}

function addNamespace() {
     echo "$1" | sed 's|/|\\|g'
}
"$@"
