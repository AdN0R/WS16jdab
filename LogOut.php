<?php
	session_start();
	if(isset($_SESSION[User]) ){
		unset($_SESSION[User]);
		unset($_SESSION[Irakasle]);
		session_destroy();
		echo "<script>alert(\"Logout ondo burutu da!\"); window.location = \"http://talde6.hol.es/Layout.php\";</script>";
	}else{
		echo "<script>alert(\"Lehenik eta behin logeatu behar zara!\"); window.location = \"http://talde6.hol.es/Layout.php\";</script>";
	}
?>