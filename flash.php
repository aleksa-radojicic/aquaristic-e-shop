<?php

function set_msg($msg, $type = null)
{
  $_SESSION['msg'] = $msg;
  $_SESSION['msg_type'] = $type;
} //end set_msg()

function get_msg()
{
  if ($_SESSION['msg']) {
    $type = isset($_SESSION['msg_type']) ? $_SESSION['msg_type'] : 'success';
    echo '<div role="alert" class="alert alert-fixed alert-dismissible fade show alert-' . $type . '" >';
    echo $_SESSION['msg'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';


    unset($_SESSION['msg']);
    unset($_SESSION['msg_type']);
  }
}
