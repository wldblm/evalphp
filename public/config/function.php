<?php

function troplong($param){
  if(strlen($param) > 25 ){
    $param = substr($param,0,25).'...';
  }
  echo $param;
}