#!/usr/bin/perl -w
use strict;
use CGI ;
my $filename = "../zad2/lista.txt" ;
my $cgi = new CGI ;
my $lekarz= $cgi->param ('par') ;
my $nazw= $cgi->param ('nazwisko') ;
my $imie= $cgi->param ('imie') ;
my $email= $cgi->param ('email') ;
my $numer= $cgi->param ('numer') ;

open ( INP, $filename ) ;
	my ( $rekord, @tabl ) ;
	while ( <INP> ) {
		$rekord = $_ ;
		@tabl = (@tabl, $rekord );
		# print $rekord ;
	}
close ( INP ) ;

my ( $ret, $text, $data ) ;
my ( $f_lekarz, $f_nazw, $f_imie, $f_email, $f_numer ) ;
print $cgi->header() ;
$ret = 0 ;
foreach $data ( @tabl )
{
( $f_lekarz, $f_nazw,$f_imie, $f_email, $f_numer ) = split (/:/, $data ) ;
	# print $lekarz_id, $nazw, $imie, $email;
	if ( $imie eq $f_imie && $nazw eq $f_nazw && $email eq $f_email )
	{
		$ret = 1;
	}	
}
if ( $ret == 0 )
{
	open ( OUT, ">>".$filename ) ;
	print OUT $lekarz.":".$nazw.":".$imie.":".$email.":\n" ;
	close OUT ;
	print " zapisano " ;
}
else
{
	print " niezapisano " ;
}

