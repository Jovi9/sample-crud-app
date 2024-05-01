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

          local namespace=$(addNamespace "$1")
          echo "<?php" >>"$filename"
          echo "namespace $namespace;" >>"$filename"
          echo "class $1 {}" >>"$filename"
     else
          mkdir -p "$1"
          touch "$1/$2.php"
          filename="$1/$2.php"

          local namespace=$(addNamespace "$1")
          echo "<?php" >>"$filename"
          echo "namespace $namespace;" >>"$filename"
          echo "class $2 {}" >>"$filename"
     fi
}

function controller() {
     filename=""
     controller="app/Controllers"
     if [ "$2" == "" ]; then
          touch "$controller/$1.php"
          filename="$controller/$1.php"

          echo "<?php" >>"$filename"
          echo "namespace App\Controllers;" >>"$filename"
          echo "class $1 {}" >>"$filename"
     else
          mkdir -p "$controller/$1"
          touch "$controller/$1/$2.php"
          filename="$controller/$1/$2.php"

          local namespace=$(addNamespace "$1")
          echo "<?php" >>"$filename"
          echo "namespace App\Controllers\\$namespace;" >>"$filename"
          echo "class $2 {}" >>"$filename"
     fi
}

function model() {
     filename=""
     models="app/Models"
     if [ "$2" == "" ]; then
          touch "$models/$1.php"
          filename="$models/$1.php"

          echo "<?php" >>"$filename"
          echo "namespace App\Models;" >>"$filename"
          echo "class $1 {}" >>"$filename"
     else
          mkdir -p "$models/$1"
          touch "$models/$1/$2.php"
          filename="$models/$1/$2.php"

          local namespace=$(addNamespace "$1")
          echo "<?php" >>"$filename"
          echo "namespace App\Models\\$namespace;" >>"$filename"
          echo "class $2 {}" >>"$filename"
     fi
}

function addNamespace() {
     echo "$1" | sed 's|/|\\|g'
}
"$@"
