<?php
session_start();
if(isset($_SESSION['name'])){
	
	
	
	//p 359  i q  367  pierwsze, ale male, powinny byc bardzo duze
	//	Obliczamy Ø = (p - 1) × (q - 1) , czyli tzw. funkcję Eulera: i wychodzi 131028 
	//Obliczamy moduł n:  n = p × q = 131753
	$p=359;
	$q=367;
	$Eluler=131028;
	$n=131753;
	//Wyznaczamy wykładnik publiczny e. Ma on być względnie pierwszy z Ø czyli z liczbą 131028. Warunek ten spełnia, np. liczba 331.
	$e=331;
	//Wyznaczamy następnie wykładnik prywatny, który ma być odwrotnością modulo Ø liczby e, czyli d × 331 mod 131028 = 1.
	//na szczescie ktos stworzyl kalkulator http://www.mathcelebrity.com/euclidalgo.php?num1t=131028&num2t=331&pl=Euclids+Extended+Algorithm
	//51857 z tych liczb wiec wychodz d=79171 w koncu odwrotnosc
	//26205601 mod  131028 to 1 :D
	$d=79171;
	//Klucz publiczny (e, n) 331,131753 
	//Klucz prywatny (d, n) 79171, 131753
	//mozna szyfrowac a ot male liczby  przydatnym bylo zordlo jeszcze: http://calculla.pl/nwd
	
	
	$text = $_POST['text'];
	
	$dlugosc = strlen($text);
	$kazdenjeden = array();
	$szyfr=array();
for ($i=0; $i<$dlugosc; $i++) {
    $kazdenjeden[$i] = ord($text[$i]);
	//wzorej na szyforwane c = t^ e mod n.
	//no i tu php sie wylozy bo liczby kolo 100 jako znak ascii do potegi 331, nie ma szans
	//$szyfr[$i] = (mod(pow($kazdenjeden[$i],$e),$n);
	//ale są ponoc obejscia 
	/*
	c^256+64+8+2+1 mod 131028
		
	*/
	
	
	$czesc1[$i]=(mod(pow($kazdenjeden[$i],256),$n);
	$czesc2[$i]=(mod(pow($kazdenjeden[$i],64),$n);
		$czesc3[$i]=(mod(pow($kazdenjeden[$i],8),$n);
			$czesc4[$i]=(mod(pow($kazdenjeden[$i],2),$n);
				$czesc5[$i]=(mod(pow($kazdenjeden[$i],1),$n);
				$wynikczesci[$i]= mod(($czesc1[$i]*$czesc2[$i]*$czesc3[$i]*$czesc4[$i]*$czesc5[$i]),$n);
}
$wynik=implode("",$kazdenjeden);
$wyniksz=implode("",$wynikczesci);

	//ale to tez za duzo jak na mozliwosci php
	
	
	//jesli daloby rade zaszyforwac, to odszyforwanie t = c d mod n
	/* czyli
	$wyniksz
	$dlugosc = strlen($wyniksz);
	$kazdenjeden2= array();
	$szyfr2=array();
for ($i=0; $i<$dlugosc; $i++) {
    $kazdenjeden[$i] = ord($wyniksz[$i]);.
	//no i tu php sie wylozy jezcze bardzie bo liczby kolo 100 jako znak ascii do potegi 79171, nie ma  w tym wypadku wikezszych szans
	//$szyfr[$i] = (mod(pow($kazdenjeden[$i],$d),$n);
	i nawet nie ma co rozbijac na potegi 2
		
	*/
	*/
	$fp = fopen("log.html", 'a');
	
 fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".$wyniksz."<br></div>");
	fclose($fp);
	
	$fp = fopen("log_czysty.html", 'a');
	
 fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".$text."<br></div>");
	fclose($fp);
}
?>