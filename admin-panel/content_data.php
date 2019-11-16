<?php
	require ("ConectarDtata.php");
	if (@$_COOKIE["auser"]!='') {
	@$action = $_GET['data'];
		switch ($action) {
			case 'settings':
					data_script('3','UPDATE',$_POST['title']);
					data_script('4','UPDATE',$_POST['name']);
					data_script('7','UPDATE',$_POST['Description']);
					data_script('6','UPDATE',$_POST['data_mail']);
					data_script('16','UPDATE',$_POST['data_facebook']);
					data_script('17','UPDATE',$_POST['data_twitter']);
					data_script('11','UPDATE',$_POST['language']);
					data_script('23','UPDATE',$_POST['language_panel']);
					
					@header("Location:./?action=settings");
					exit('<meta http-equiv="Refresh" content="0;url=./?action=settings">');
				break;
			case 'password':
					data_script('24','UPDATE',$_POST['email']);
					data_script('25','UPDATE',md5($_POST['password']));
					@header("Location:./?action=password");
					exit('<meta http-equiv="Refresh" content="0;url=./?action=password">');
				break;		
			case 'user_e':
					$data_1 = $_POST['true_user'];
					$data_2 = $_POST['name_user'];
					$data_3 = $_POST['data_mail'];
					$data_4 = $_POST['user_locked'];
				
					$sql = "UPDATE user_data SET username='$data_2',email='$data_3',locked='$data_4' WHERE userID='$data_1'";
					mysqli_query($con, $sql);
					@header("Location:./?action=user&id=".$data_1);
					exit('<meta http-equiv="Refresh" content="0;url=./?action=user&id='.$data_1.'">');
				break;				
			case 'ads':
					data_script('21','UPDATE',PHP_Secure_c($_POST['as_one']));
					data_script('22','UPDATE',PHP_Secure_c($_POST['as_two']));
					@header("Location:./?action=ads");
					exit('<meta http-equiv="Refresh" content="0;url=./?action=ads">');;
				break;
			case 'report':
					
					@header("Location:./?action=report");
					exit('<meta http-equiv="Refresh" content="0;url=./?action=report">');;
				break;
			case 'pages':
					data_script('12','UPDATE',$_POST['t_of']);
					data_script('13','UPDATE',$_POST['p_py']);
					@header("Location:./?action=pages");
					exit('<meta http-equiv="Refresh" content="0;url=./?action=pages">');;
				break;
			case 'system':
					$error = $_POST['error'];
					$cookies = $_POST['cookies'];
					$sql = "UPDATE settings SET error_system='$error',cookies='$cookies'";
					mysqli_query($con, $sql);
					@header("Location:./?action=system");
					exit('<meta http-equiv="Refresh" content="0;url=./?action=system">');;
				break;
			case 'logout':
					$s = 3600; // seconds in a year
					setcookie("cs_mail", trim(''), time() + $s, '/', null, null, true);
					setcookie("cs_pass", trim(''), time() + $s, '/', null, null, true);
					setcookie("cs_user", trim(''), time() + $s, '/', null, null, true);
					setcookie("auser", trim(''), time() + $s, '/', null, null, true);
					session_destroy();
					@header("Location:./");
					exit('<meta http-equiv="Refresh" content="0;url=./">');
				break;
			default:
					echo 'data';
				break;
		}
	}else{
		require ("sources/login.php");	
	}		
?>