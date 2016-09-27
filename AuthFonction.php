<?php

function ReturnAuthFunction()
  {
  return md5("auth-bellity-GCM".date('Y-m-d')) . "";
  }

?>