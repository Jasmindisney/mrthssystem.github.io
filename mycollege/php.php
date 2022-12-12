<?php
  // Check if the OpenSSL library is available
  if (function_exists('openssl_decrypt')) {
    echo "OpenSSL is installed and available on this system.\n";
  } else {
    echo "OpenSSL is not installed or is not available on this system.\n";
  }
?>