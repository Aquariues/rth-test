<?php
function flash($title = null, $text = null, $type='info')
{
    $flash = app('App\Http\Flash');
    if (func_num_args() == 0) {
        return $flash;
    }
    return $flash->$type($title, $text);
}

function checkLogin(){
  if(!Session::has('users'))
    return false;
  return true;
}
?>
