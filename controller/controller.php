<?php

include("model/model.php");
include("view/view.php");

session_start();


class controller
{
	public $_view;	
	public $_model;	
	
	public function laduj()
	{
		$_view = new view();
		$_model = new model();
		
		switch($_SESSION['strona'])
		{
			case 'zarejestruj':
				if($_model->register_user() == 1)
					$_view->zarejestrowany();
				else
					$_view->nie_zarejestrowany();
				break;
			case 'rejestracja':
				$_view->panelRejestracji();
				break;
			case 'logowanie':
				$_view -> logowanie();
				break;
			case 'spis':
				$data = $_model->spis();
				$_view->pokaz_spis($data);
				break;
			case 'loguj':
				if($_model->logowanie() == 1)
					$_view->zal_popr();
				else
					$_view->nie_zal_popr();
				break;
			case 'wylogowanie':
				$_model->wylogowanie();
				$_view->wylogowanie();
				break;
			case 'rezerwacje':
				$data = $_model->rezerwacje();
				$_view->rezerwacje($data);
				break;
			case 'rezerwuj':
				$_view->szukaj();
				break;
			case 'rezerwacja':
				if($_model->rezerwacja() == 1)
				{
					$_view->znaleziono_przedmiot();
				}
				else
				{
					$_view->nie_znaleziono_przedmiotu();
				}
				break;
			case 'odrezerwuj':
				$_view->szukaj_rez();
				break;
			case 'odrezerwacja':
				if($_model->odrezerwacja() == 1)
				{
					$_view->odrezerwowano_przedmiot();
				}
				else
				{
					$_view->nie_odrezerwowano_przedmiotu();
				}
				break;	
			case 'uzytkownicy':
				$data = $_model->uzytkownicy();	
				$_view->wylistuj_uzytkownikow($data);
				break;
			case 'usun_usera':
				$_view->szukaj_usera();
				break;
			case 'usuwanie_usera':
				if($_model->usun_usera() == 1)
					$_view->usunieto_usera();
				else
					$_view->nie_usunieto_usera();
				break;
			case 'dodaj_usera':
				$_view->panelRejestracji();
				break;
			case 'dodaj_przedmiot':
				$_view->dodajPrzedmiot();
				break;
			case 'dodaj_przedmiot2':
				$_model->dodaj_przedmiot();
				$_view->dodanoPrzedmiot();
				break;
			default:
				break;
			
		}
	}
	public function menu()
	{
		$_view = new view();
		$_view->menu();
	}
	public function skorka()
	{
		$_view = new view();
		$_view ->skorka($_SESSION['skorka']);
	}
}
?>
