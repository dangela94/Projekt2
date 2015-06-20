<?php

session_start();

class view
{

	public function panelRejestracji()
	{
		echo
		"
		<script type='text/javascript' src='scripts/jQuery.js'></script>
		<script type='text/javascript' src='./scripts/registration.js'></script> 
						
		<form id='registerForm' method='post' action='index.php?strona=zarejestruj'>
			<label class='formLbl' for='mail'>e-mail</label> <br />
			<input class='formEd' type='text' id='mail' name='mail' value='' />	<br />
			<label class='formLbl' for='name'>Imie</label> <br />
			<input class='formEd' type='text' id='name' name='name' value='' />	<br />
			<label class='formLbl' for='surname'>Nazwisko:</label> <br />
			<input class='formEd' type='text' id='surname' name='surname' value='' /> <br />
			<label class='formLbl' for='pass'>Haslo</label> <br />
			<input class='formEd' type='password' id='pass' name='pass' value=''/> <br />
			<label class='formLbl' for='confpasswdEd'>Ponownie haslo</label> <br />
			<input class='formEd' type='password' id='confpasswdEd' name='confpasswdEd' value=''/> <br />
			<input id='registerBtn' type='submit' value='Wyslij' /> 		
		</form> 
		<div class='errorDiv' id='errorName'> </div>
		<div class='errorDiv' id='errorSurname'> </div>
		<div class='errorDiv' id='errorEmail'> </div>
		<div class='errorDiv' id='errorPasswd'> </div>
		<div class='errorDiv' id='confErrorPasswd'> </div>
		<div class='errorDiv' id='errorPhone'> </div>
		";
	}
	
	public function zarejestrowany()
	{
		echo 'Rejestracja przebiegla poprawnie';
	}
	
	public function nie_zarejestrowany()
	{
		echo 'Rejestracja sie nie powiodla, poniewaz uzytkownik o podanej nazwie juz istnieje';
	}
	
	public function zal_popr()
	{
		echo 'Zostales poprawnie zalogowany';
	}
	
	public function nie_zal_popr()
	{
		echo 'Nie zostales poprawnie zalogowany. Sprobuj jeszcze raz';
	}

	public function logowanie()
	{
		session_start();
		
		echo "
		<form action='../projekt2/index.php?strona=loguj' method='post'>
			<label for='Login'>Login:</label><br />
			<input type='text' id='login' name='login' /><br />
			<label for='Haslo'>Haslo</label><br />
			<input type='pass' id='pass' name='pass' /><br />
			<input type='submit' id='LogInBtn' value='Zaloguj' /><br />
		</form> 
		";
	}
	
	public function wylogowanie()
	{
		echo 'Zostales poprawnie wylogowany.';
	}

	public function pokaz_spis($data)
	{
		if($data)
		{
			echo '<br />Id&#9;'.'Imie&#9;'.'Nazwisko&#9;'.'Tytul&#9;'.'Stan'.'<br /><br />';
			foreach($data as $row)
			{
				echo $row['id'].'&#9;'.$row['imie'].'&#9;'.$row['nazwisko'].'&#9;'.'"'.$row['nazwa'].'"'.'&#9;'.$row['stan'].'<br />';
			}
		}
	}

	public function rezerwacje($data)
	{
		if($data)
		{
			echo '<br />Id&#9;'.'Imie&#9;'.'Nazwisko&#9;'.'Tytul&#9;'.'Stan'.'<br /><br />';
			foreach($data as $row)
			{
				echo $row['id'].'&#9;'.$row['imie'].'&#9;'.$row['nazwisko'].'&#9;'.'"'.$row['nazwa'].'"'.'&#9;'.$row['stan'].'<br />';
			}
		}
		else
		{
			echo 'Nie masz zadnych rezerwacji';
		}
	}

	public function szukaj()
	{
		echo "
		<form action='../projekt2/index.php?strona=rezerwacja' method='post'>
			<label for='nazwa'>Tytul ksiazki:</label><br />
			<input type='text' id='nazwa' name='nazwa' /><br />
			<input type='submit' id='LogInBtn' value='Szukaj' /><br />
		</form> 
		";	
	}

	public function szukaj_rez()
	{
		echo "
		<form action='../projekt2/index.php?strona=odrezerwacja' method='post'>
			<label for='nazwa'>Tytul ksiazki:</label><br />
			<input type='text' id='nazwa' name='nazwa' /><br />
			<input type='submit' id='LogInBtn' value='Odrezewuj' /><br />
		</form> 
		";	
	}
	
	public function znaleziono_ksiazke()
	{
		echo "<br />Ksiazka zostala zarezerwowana";
	}
	
	public function nie_znaleziono_ksiazki()
	{
		echo "<br />Ksiazka nie zostala znaleziona";
	}
	public function odrezerwowano_ksiazke()
	{
		echo "<br />Ksiazka zostala odzarezerwowana";
	}
	
	public function nie_odrezerwowano_ksiazki()
	{
		echo "<br />Ksiazka nie zostala znaleziona";
	}

	public function menu()
	{
		echo '<div id="menu_1">';
			switch($_SESSION['login'])
			{
				case 'quest':
					echo '<a href="index.php?strona=rejestracja">'.'Rejestracja'.'</a>'; 
					break;
				case 'admin':
					echo '<a href="index.php?strona=dodaj_ksiazke">'.'Dodaj ksiazke'.'</a>'; 
					break;
				default:
					echo '<a href="index.php?strona=rejestracja">'.'Rejestracja'.'</a>'; 
					break;
			}
		echo '</div>
		<div id="menu_2">
			<a href="index.php?strona=spis">Spis ksiazek</a>
		</div>
		<div id="menu_3">';
		if($_SESSION['menu'] == "zal")
		{
			switch($_SESSION['login'])
			{
				case 'quest':
					echo '<a href="index.php?strona=logowanie">'.'Logowanie'.'</a>'; 
					break;
				default:
					echo 'Zalogowany'.' (<a href="index.php?strona=wylogowanie">'.'wyloguj)'.'</a>';
					break;
			}
		}
		else
		{
			echo '<a href="index.php?strona=logowanie">'.'Logowanie'.'</a>'; 
		}
		echo '</div>
		<div id="menu_4">';
		if($_SESSION['menu'] == "zal")
		{
			switch($_SESSION['login'])
			{
				case 'quest':
					break;
				case 'admin':
					echo '<a href="index.php?strona=uzytkownicy">'.'Uzytkownicy'.'</a>';
					break;
				default:
					echo '<a href="index.php?strona=rezerwacje">'.'Rezerwacje'.'</a>';
					break;
			}
		}
		else
		{
			
		}
		echo '</div>
		<div id="menu_5">';
		if($_SESSION['menu'] == "zal")
		{
			switch($_SESSION['login'])
			{
				case 'quest':
					break;
				case 'admin':
					echo '<a href="index.php?strona=usun_usera">'.'Usun usera'.'</a>';
					break;
				default:
					echo '<a href="index.php?strona=rezerwuj">'.'Rezerwuj'.'</a>';
					break;
			}
		}
		else
		{
		
		}
		echo '</div>
		<div id="menu_6">';
		if($_SESSION['menu'] == "zal")
		{
			switch($_SESSION['login'])
			{
				case 'quest':
					break;
				case 'admin':
					echo '<a href="index.php?strona=dodaj_usera">'.'Dodaj usera'.'</a>';
					break;
				default:
					echo '<a href="index.php?strona=odrezerwuj">'.'Odrezerwuj'.'</a>';
					break;
			}
		}
		else
		{
		
		}
		echo '</div>';
	}

	public function main_image()
	{
		echo '<br /><br /><br /><br />';
		echo '<img src="./images/repeatbg.jpg" />';
	}

	public function wylistuj_uzytkownikow($data)
	{
		if($data)
		{
			echo '<br />Id&#9;'.'Login&#9;'.'Haslo&#9;'.'Imie&#9;'.'Nazwisko'.'<br /><br />';
			foreach($data as $row)
			{
				echo $row['id'].'&#9;'.$row['login'].'&#9;'.$row['haslo'].'&#9;'.'"'.$row['imie'].'"'.'&#9;'.'"'.$row['nazwisko'].'"'.'<br />';
			}
		}	
	}
	
	public function szukaj_usera()
	{
		echo "
		<form action='../projekt2/index.php?strona=usuwanie_usera' method='post'>
			<label for='nazwa'>Login: </label><br />
			<input type='text' id='login' name='login' /><br />
			<input type='submit' id='LogInBtn' value='Usun' /><br />
		</form> 
		";	
	}
	
	public function usunieto_usera()
	{
		echo 'User zostal poprawnie usuniety';
	}
	
	public function nie_usunieto_usera()
	{
		echo 'User nie zostal odnaleziony w bazie lub nie moze zostac usuniety z tego konta';
	}

	public function dodajKsiazke()
	{
		echo
		"				
		<form id='registerForm' method='post' action='../projekt2/index.php?strona=dodaj_ksiege'>
			<label class='formLbl' for='imie'>Imie</label> <br />
			<input class='formEd' type='text' id='imie' name='imie' value='' />	<br />
			<label class='formLbl' for='nazwisko'>Nazwisko</label> <br />
			<input class='formEd' type='text' id='nazwisko' name='nazwisko' value='' />	<br />
			<label class='formLbl' for='nazwa'>Nazwa</label> <br />
			<input class='formEd' type='nazwa' id='nazwa' name='nazwa' value=''/> <br />	
			<input type='submit' value='Dodaj' /><br />	
		</form> 
		<div class='errorDiv' id='errorName'> </div>
		<div class='errorDiv' id='errorSurname'> </div>
		<div class='errorDiv' id='errorEmail'> </div>
		<div class='errorDiv' id='errorPasswd'> </div>
		<div class='errorDiv' id='confErrorPasswd'> </div>
		<div class='errorDiv' id='errorPhone'> </div>
		";		
	}
	
	public function dodanoKsiazke()
	{
		echo "<br /><br />Dodano ksiazke";
	}
	
	public function skorka($skorka)
	{
		if($skorka == "")
			$_SESSION['skorka'] = "style.css";
		echo "<link rel='stylesheet' href='".$_SESSION['skorka']."' type='text/css'/>";
	}
	
	public function styles()
	{
		echo '<a href="index.php?strona=style1">'.'Styl 1'.'</a>'; 
		echo '       ';
		echo '<a href="index.php?strona=style2">'.'Styl 2'.'</a>'; 
	}
}

?>
