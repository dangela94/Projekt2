<?php
session_start();

class model
{
	public function register_user()
	{
		session_start();
		$imie = $_POST['name'];
		$nazwisko = $_POST['surname'];
		$login = $_POST['mail'];
		$haslo = md5($_POST['pass']);
		
		$dbb = new PDO('sqlite:sql/baza.db');
		
		$us = $dbb->query("SELECT * FROM users WHERE login = '".$login."';");
		$count = $us->fetchColumn();
		
		if($count)
			return 0;
		else
		{
			$values = "NULL, '$login', '$haslo', '$imie', '$nazwisko'";
			$tablica = "users";
			$qu = "INSERT INTO $tablica VALUES ($values);";
			$dbb->query($qu);
			$dbb = NULL;
			return 1;
		}
		
	}
	public function logowanie()
	{
		session_start();
		$dbb = new PDO('sqlite:sql/baza.db');
		
		$us = $dbb->query("SELECT * FROM users WHERE login = '".$_POST["login"]."' AND haslo = '".md5($_POST["pass"])."';");
		$count = $us->fetchColumn();
		if($count)
		{
			$us = NULL;
			$us = $dbb->query("SELECT * FROM users WHERE login = '".$_POST['login']."';");
			$data = $us->fetchAll();
			$_SESSION['login'] = $data[0]['login'];
			$_SESSION['menu'] = "zal";
			return 1;
		}
		else
		{
			$dbb = NULL;
			return 0;
		}
	}
	public function wylogowanie()
	{
		$_SESSION['login'] = "quest";
		$_SESSION['menu'] = "";
	}
	public function spis()
	{
		$dbb = new PDO('sqlite:sql/baza.db');
		
		$us = $dbb->query("SELECT * FROM tools");
		$data = $us->fetchAll();
		return $data;
	}
	
	public function rezerwacje()
	{
		$dbb = new PDO('sqlite:sql/baza.db');
		$us = $dbb->query("SELECT * from tools WHERE login = '".$_SESSION['login']."';");
		$data = $us->fetchAll();
		return $data;
	}
	public function rezerwacja()
	{
		session_start();
		$dbb = new PDO('sqlite:sql/baza.db');
		
		$us = $dbb->query("SELECT * FROM tools WHERE przedmiot = '".$_POST["nazwa"]."';");
		$count = $us->fetchColumn();
		if($count)
		{
			$us = NULL;
			$us = $dbb->query("SELECT * FROM tools WHERE przedmiot = '".$_POST["nazwa"]."';");
			$data = $us->fetchAll();
			if($data[0]['stan'] == 0)
			{
				$dbb -> query("UPDATE tools SET login='".$_SESSION['login']."' WHERE przedmiot = '".$_POST["nazwa"]."';");
				$dbb -> query("UPDATE tools SET stan = 1 WHERE przedmiot = '".$_POST["nazwa"]."';");
				return 1;
			}
			else
				return 0;
		}
		else
		{
			$dbb = NULL;
			return 0;
		}
	}
	public function odrezerwacja()
	{
		session_start();
		$dbb = new PDO('sqlite:sql/baza.db');
		
		$us = $dbb->query("SELECT * FROM tools WHERE przedmiot = '".$_POST["nazwa"]."';");
		$count = $us->fetchColumn();
		if($count)
		{
			$us = NULL;
			$us = $dbb->query("SELECT * FROM tools WHERE przedmiot = '".$_POST["nazwa"]."';");
			$data = $us->fetchAll();
			if($data[0]['stan'] == 1)
			{
				$dbb -> query("UPDATE tools SET login='' WHERE przedmiot = '".$_POST["nazwa"]."';");
				$dbb -> query("UPDATE tools SET stan = 0 WHERE przedmiot = '".$_POST["nazwa"]."';");
				return 1;
			}
			else
				return 0;
		}
		else
		{
			$dbb = NULL;
			return 0;
		}
	}
	
	public function uzytkownicy()
	{
		$dbb = new PDO('sqlite:sql/baza.db');
		$us = $dbb->query("SELECT * FROM users");
		$data = $us->fetchAll();
		return $data;
	}	
	public function usun_usera()
	{
		$dbb = new PDO('sqlite:sql/baza.db');
		$us = $dbb->query("SELECT * FROM users WHERE login = '".$_POST['login']."';");
		$count = $us->fetchColumn();
		if(!$count || $_POST['login'] == 'admin')
		{
			return 0;
		}
		else
		{	
			$us = NULL;
			$us = $dbb->query("DELETE FROM users WHERE login = '".$_POST['login']."';");
			return 1;
		}
		
	}
	public function dodaj_przedmiot()
	{
		$dbb = new PDO('sqlite:sql/baza.db');
		
		$kolor = $_POST['imie'];
		$firma = $_POST['nazwisko'];
		$przedmiot = $_POST['nazwa'];
		$stan = 0;
		$user = "";
	
				
		$values = "NULL, '$kolor', '$firma', '$przedmiot', '$stan', '$user'";
		$tablica = "tools";
		$qu = "INSERT INTO $tablica VALUES ($values);";
		$dbb->query($qu);
		$dbb = NULL;
	}
}
?>
