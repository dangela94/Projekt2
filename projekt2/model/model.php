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
		
		$us = $dbb->query("SELECT * FROM library");
		$data = $us->fetchAll();
		return $data;
	}
	
	public function rezerwacje()
	{
		$dbb = new PDO('sqlite:sql/baza.db');
		$us = $dbb->query("SELECT * from library WHERE login = '".$_SESSION['login']."';");
		$data = $us->fetchAll();
		return $data;
	}

	public function rezerwacja()
	{
		session_start();
		$dbb = new PDO('sqlite:sql/baza.db');
		
		$us = $dbb->query("SELECT * FROM library WHERE nazwa = '".$_POST["nazwa"]."';");
		$count = $us->fetchColumn();
		if($count)
		{
			$us = NULL;
			$us = $dbb->query("SELECT * FROM library WHERE nazwa = '".$_POST["nazwa"]."';");
			$data = $us->fetchAll();
			if($data[0]['stan'] == 0)
			{
				$dbb -> query("UPDATE library SET login='".$_SESSION['login']."' WHERE nazwa = '".$_POST["nazwa"]."';");
				$dbb -> query("UPDATE library SET stan = 1 WHERE nazwa = '".$_POST["nazwa"]."';");
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
		
		$us = $dbb->query("SELECT * FROM library WHERE nazwa = '".$_POST["nazwa"]."';");
		$count = $us->fetchColumn();
		if($count)
		{
			$us = NULL;
			$us = $dbb->query("SELECT * FROM library WHERE nazwa = '".$_POST["nazwa"]."';");
			$data = $us->fetchAll();
			if($data[0]['stan'] == 1)
			{
				$dbb -> query("UPDATE library SET login='' WHERE nazwa = '".$_POST["nazwa"]."';");
				$dbb -> query("UPDATE library SET stan = 0 WHERE nazwa = '".$_POST["nazwa"]."';");
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

	public function dodaj_ksiazke()
	{
		$dbb = new PDO('sqlite:sql/baza.db');
		
		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];
		$nazwa = $_POST['nazwa'];
		$stan = 0;
		$user = "";
		
		echo $imie;
		echo $nazwisko;
		echo $nazwa;
		echo $stan;
		echo $user;
		
				
		$values = "NULL, '$imie', '$nazwisko', '$nazwa', '$stan', '$user'";
		$tablica = "library";
		$qu = "INSERT INTO $tablica VALUES ($values);";
		$dbb->query($qu);
		$dbb = NULL;
	}
}
?>
