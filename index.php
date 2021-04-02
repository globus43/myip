<?php
function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!isset($_SERVER['HTTP_X_FORWARDED_FOR']) || $_SERVER['HTTP_X_FORWARDED_FOR'] == 'unknown') {
      $ip=$_SERVER['REMOTE_ADDR'];
    } else {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}

function getOS() { 
    $os_platform  = "???";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Server 2003',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $_SERVER['HTTP_USER_AGENT']))
            $os_platform = $value;

    return $os_platform;
}

function getOSArch() {
   $os_arch = 'x86';

   $arch = array(
      '/x64/i' => 'x64',
      '/Win64/i' => 'x64',
      '/Win32/i' => 'x86'
   );
   
    foreach ($arch as $regex => $value)
        if (preg_match($regex, $_SERVER['HTTP_USER_AGENT']))
            $os_arch = $value;

    return $os_arch;
}   
?>
<!doctype html>
<html lang="ru">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <title>IP-адрес</title>
   <link rel="shortcut icon" href="favicon.png" type="image/png">
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <div id="info">
      <div class="block">
         <kbd id="ip"><?= getRealIpAddr() ?></kbd>
      </div>
      <div class="block">
          <span id="os"><?= getOS() ?> (<?= getOSArch() ?>)</span>
      </div>
   </div>
</body>
</html>
