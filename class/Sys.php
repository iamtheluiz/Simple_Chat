<?php

/*
	Classe que define quase todas as funções do sistema
*/

class Sys{
	/* Atributos */
	private $pdo;

	/* Métodos */
	public function __construct(){
		$this->setPdo($this->db_connect());
	}

	private function db_connect(){
		try{
			$pdo = new PDO('mysql:host=localhost;dbname=db_chat;port=3307;charset=utf8','root','usbw');
			
			return $pdo;
		}catch (PDOException $e){
			echo "Erro ao conectar com o MySQL: ".$e->getMessage();
		}
	}
	
	public function cadastrar_login($tx_login, $tx_pass){
		try{
			$pdo = $this->getPdo();

			$pass = $this->encriptar_senha($tx_pass);

			$sql_v = "SELECT * from tb_login where tx_login = '$tx_login'";
			$query_v = $pdo->prepare($sql_v);
			$query_v->execute();

			if($query_v->rowCount() > 0){
				$this->redirect("Já existe um usuário com esse nome","../index.php");
				exit;
			}

			$sql = "INSERT into tb_login values (null,'$tx_login','$pass')";
			$query = $pdo->prepare($sql);
			$query->execute();

			if($query->rowCount() > 0){
				$this->redirect('Seu login foi cadastrado com sucesso!','../index.php');
			}else{
				$this->redirect('Não foi possivel cadastrar esse login!','../index.php');
			}
		}catch (PDOException $e){
			echo "Erro na consulta: ".$e->getMessage();
		}
	}

	public function login($login,$pass){
		try{
			$pdo = $this->getPdo();
			$pass = $this->encriptar_senha($pass);


			$sql = "SELECT * from tb_login where tx_login = '$login' and tx_pass = '$pass'";
			//$sql = "SELECT nm_aluno as nm_user,'Aluno' as tp_user from tb_login join tb_aluno on id_login = cd_login where tx_login = '$login' and tx_pass = '$pass' UNION SELECT nm_professor as nm_user,'Professor' as tp_user from tb_login join tb_professor on id_login = cd_login where tx_login = '$login' and tx_pass = '$pass'";
			$query = $pdo->prepare($sql);
			$query->execute();
			if($query->rowCount() > 0){
				session_start();
				$row = $query->fetch(PDO::FETCH_ASSOC);

				$_SESSION['logged'] = 'true';
				$_SESSION['tx_login'] = $login;
				$_SESSION['cd_login'] = $row['cd_login'];
				// $_SESSION['nm_user'] = $row->nm_user;
				// $_SESSION['tp_user'] = $row->tp_user;
				$this->redirect('Seu login foi efetuado com sucesso!','../home.php');
			}else{
				$this->redirect('Seus dados não existem! Confirme a senha e o login!','../index.php');
			}
		}catch (PDOException $e){
			echo "Erro na consulta: ".$e->getMessage();
		}	
	}
	
	public function logout(){
		if($_SESSION['logged'] = 'true'){
			session_unset();
			session_destroy();
			$this->redirect('Seu logout foi efetuado!','../index.php');
		}else{
			$this->redirect('Você já não está na sua conta!','../index.php');
		}
	}

	public function history_back($alert){
		echo "<script>";
		echo "alert('".$alert."');";
		echo "window.history.back();";
		echo "</script>";
	}

    //Exibe um alerto do JS
	public function alert($alert){
		echo "<script>";
		echo "alert('".$alert."');";
		echo "</script>";
	}

	//Encripta uma string
	public function encriptar_senha($pass){
		$encript = hash('sha256',$pass);
		return $encript;
	}

	public function valid_login(){
		if($_SESSION['logged'] == 'true'){

		}else{
			$this->redirect('Você precisa fazer login para acessar essa pagina!','/index.php');
		}
	}

	public function redirect($alert,$url){
		echo "<script>alert('$alert');window.location = '$url';</script>";
	}

	public function multiexplode ($delimiters,$string) {
	    $ready = str_replace($delimiters, $delimiters[0], $string);
	    $launch = explode($delimiters[0], $ready);
	    return  $launch;
	}

	/* Métodos Especiais */
	public function setPdo($pdo){
		$this->pdo = $pdo;
	}
	public function getPdo(){
		return $this->pdo;
	}
}