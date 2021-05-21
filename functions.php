<?php

	function echo_msg() {
		if ( isset($_SESSION['msg'])) {
			echo '<p style="color:red;">'.$_SESSION['msg'].'</p>';
			unset($_SESSION['msg']);
		} elseif (isset($_GET['msg'])) {
			$sanitizedMsg= filter_var($_GET['msg'], FILTER_SANITIZE_STRING);
			echo '<p style="color:red";>'.$sanitizedMsg.'</p>';
		}

	}

?>