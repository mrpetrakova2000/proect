<?php

	class UsersController {
		public function register() {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if (!$isAuthorized) {
				$title = 'Регистрация';
				if (isset($_POST['login'])) {
					$name = htmlentities($_POST['name']);
					$surname = htmlentities($_POST['surname']);
					$login = htmlentities($_POST['login']);
					$email = htmlentities($_POST['email']);
					$password = htmlentities($_POST['password']);
					$repeatPassword = htmlentities($_POST['repeatPassword']);
					$errors = [];
					//TODO: check if regexp correct
					if ($password != $repeatPassword) {
						$errors[] = 'Пароли не совпадают!';
					} else {
						if ($userModel->checkIfExists($email)) {
							$errors[] = 'Такой пользователь уже существует!';
						}
						
					}
					if (empty($errors)) {
						$hashedPassword = md5($password);
						$token = $userModel->generateToken();
						$userId = $userModel->register($email, $login, $hashedPassword, $token, $name, $surname);
						setcookie('token', $token, time() + 3*60*60, '/');
						setcookie('user_id', $userId, time() + 3*60*60, '/');
						header("Location: " . ROOT . 'films/list');
					} else {
						for ($i = 0; $i<count($errors); $i++) {
							echo $errors[$i];
						}
					}
				}
				include_once('./views/users/register.php');
			} else {
				echo 'Вы уже авторизованы!';
			}
			
		}
		
		public function auth() {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if (!$isAuthorized) {
				$title = 'Авторизация';
				if(isset($_POST['email'])) {
					$email = htmlentities($_POST['email']);
					$password = htmlentities($_POST['password']);
					$errors = [];
					$userModel = new User();
					//echo $userModel->checkIfExists($email);
					if ($userModel->checkIfExists($email) == false) {
						$errors[] = 'Такой пользователь не существует! Проверьте правильность email и пароля.';
					}
					if (empty($errors)) {
						$hashedPassword = md5($password);
						$token = $userModel->generateToken();
						//echo $token;
						$userId = $userModel->auth($email, $hashedPassword, $token);
						if ($userId) {
							setcookie('token', $token, time() + 3*60*60, '/');
							setcookie('user_id', $userId, time() + 3*60*60, '/');
							header("Location: " . ROOT . 'films/list');
						} else {
							$errors[] = 'Такой связки email/password не существует. Проверьте правильно заполнения email и пароля.';
							for ($i = 0; $i<count($errors); $i++) {
								echo $errors[$i];
							}
						}
					} else {
						for ($i = 0; $i<count($errors); $i++) {
							echo $errors[$i];
						}
					}
					
				}
				include_once('./views/users/auth.php');
			} else {
				echo 'Вы уже авторизованы!';
			}
		}
		
		public function logout() {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$userModel->logout($user_id);
				//unset($_SESSION);
				setcookie('token', '', time()-3600, '/');
				setcookie('user_id', '', time()-3600, '/');
				header("Location: " . ROOT . 'films/list');
			} else {
				echo 'Вы не авторизованы!';
			}
		}
	}