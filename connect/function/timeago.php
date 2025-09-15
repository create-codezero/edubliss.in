<?php
date_default_timezone_set('Asia/Calcutta');
function time_elapsed_string($datetime, $full = false)
{
     $now = new DateTime;
     $ago = new DateTime($datetime);
     $diff = $now->diff($ago);

     $diff->w = floor($diff->d / 7);
     $diff->d -= $diff->w * 7;

     $string = array(
          'y' => 'y',
          'm' => 'm',
          'w' => 'w',
          'd' => 'd',
          'h' => 'hr',
          'i' => 'min',
          's' => 'sec',
     );
     foreach ($string as $k => &$v) {
          if ($diff->$k) {
               $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : ''); // on 2nd '' from back you can enter a string which will shown when the number of time ago is greater than 1 like if you want to show 2 mins than add 's' 
          } else {
               unset($string[$k]);
          }
     }

     if (!$full) $string = array_slice($string, 0, 1);
     return $string ? implode(', ', $string) . ' ago' : 'just now';
}
