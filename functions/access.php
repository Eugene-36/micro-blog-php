<?php
function is_admin ()  {
  if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    return true;
  }
  return false;
}