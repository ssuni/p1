<?
session_start();
session_destroy();

// header를 사용하면 FB.init 를 실행하지 못함..
//header('Location: index.php');
?>
<script>
	location='index.php';
</script>