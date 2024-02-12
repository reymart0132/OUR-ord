<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ord/resource/php/class/core/init.php';


$user = new user();
$emailAdress = getEmail($_GET['transactionID']);

if($_GET['state'] == '1' && $user->data()->groups == '1'){  // set for signature
  $action = new update($_GET['transactionID']);
  $action->kcej_setStateFS();
  header('Location:udashboard.php');
}elseif($_GET['state'] == '2' && $user->data()->groups == '1'){  // set as for release
  $action = new update($_GET['transactionID']);
  $action->kcej_setStateFR();
  header('Location:udashboardfs.php');
}elseif($_GET['state'] == '3' && $user->data()->groups == '3'){  // set as released
  $action = new update($_GET['transactionID'], $_GET['type']);
  $action->kcej_setStateRL();
  header('Location:rdashboard.php');
}elseif($_GET['state'] == '4' && !empty($user->data()->groups)){  // remove transaction
  $action = new update($_GET['transactionID'], $_GET['type'],$_GET['info']);
  $action->kcej_setStateDL();
  $open = true;
  include_once "vendor/sendmailR.php";
  //email
  if($_GET['landing'] == 'udash'){
    header('Location:udashboard.php');
  }elseif($_GET['landing'] == 'udashfs'){
    header('Location:udashboardfs.php');
  }elseif($_GET['landing'] == 'rdash'){
    header('Location:rdashboard.php');
  }elseif($_GET['landing'] == 'adash-online'){
    header('Location:adash-onlineapp.php');
  }else{
    header("HTTP/1.1 403 Forbidden");
    exit();
  }
}else{
  header("HTTP/1.1 403 Forbidden");
  exit();
}
?>