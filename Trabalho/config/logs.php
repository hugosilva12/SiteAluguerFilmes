
<?php


function wh_log($log_msg){
    $log_filename = "log";

    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    } else{
      $ip = $_SERVER['REMOTE_ADDR'];
      $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
      $log_msg=$log_msg.", ".  date('d-M-Y').", ".date('H:i:s').", " .$ip; 
    // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);  
    }


  }
  




?>
