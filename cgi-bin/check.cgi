#!/usr/bin/perl -w
use strict ;
use CGI ;
# my $filename = "../zad2/lista.txt" ;
my $cgi = new CGI ;

my $na = $cgi->param ('n') ;
my $im = $cgi->param ('i') ;
my $lekarz_temp="";

open ( INP, $filename ) ;
	my ( $rekord, @tabl ) ;
	while ( <INP> ) {
		$rekord = $_ ;
		@tabl = (@tabl, $rekord );
	}
close ( INP ) ;

my ( $ret, $text, $data ) ;
my ( $grupa_id, $nazw, $imie, $email ) ;
print $cgi->header() ;
$ret = 0 ;

foreach $data ( @tabl )
{
 ( $lekarz_id, $nazw, $imie, $email ) = split (/:/, $data ) ;
 if ( $im eq $imie && $na eq $nazw )
 {
 	$ret = 1;
	$lekarz_temp = $lekarz_id;
 }
}
if ( $ret eq 1 )
{
	$text = "Lekarz jest juz zajety" ;
	print $ret.";".$lekarz_temp.";".$text ;
}
else
{
	$ret = 0;
	print $ret ;
}


