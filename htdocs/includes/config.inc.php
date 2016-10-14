<?php
//Copy this file to config.inc.php and make changes to that file to customize your configuration.

$servers = [];
for ($i=0; $i < 3 ; $i++) { 
  $params = [];
  $tmp = getenv("SERVER_{$i}_NAME");
  $params['name'] = empty($tmp)? "Server {$i}" : $tmp;
  $tmp = getenv("SERVER_{$i}_URL");
  if (empty($tmp)) {
    break;
  }
  $redis_url = empty($tmp)? 'tcp://127.0.0.1' : $tmp;
  $url = parse_url($redis_url);
  $params ['scheme'] = !empty($url['scheme'])?$url['scheme']:'tcp';
  $params ['host'] = !empty($url['host'])?$url['host']:'127.0.0.1';
  $params ['port'] = !empty($url['port'])?$url['port']:6379;
  if (empty($url['user'])) {
      $url['user'] = '';
  }
  if (empty($url['pass'])) {
      $url['pass'] = '';
  }
  if (empty($url['path'])) {
      $url['path'] = '';
  }
  if (!empty($url['pass'])) {
      $params ['password'] = $url['pass'];
  }
  if (!empty($url['path']) && strlen($url['path']) > 1 ) {
      $params ['database'] = (int)substr($url['path'], 1);
  }
  $params['filter'] = '*';
  $servers[] = $params;
}

$config = array(
  'servers' => $servers,


  'seperator' => ':',

  'maxkeylen'           => 100,
  'count_elements_page' => 100,

  // Use the old KEYS command instead of SCAN to fetch all keys.
  'keys' => false,

  // How many entries to fetch using each SCAN command.
  'scansize' => 1000
);

?>
