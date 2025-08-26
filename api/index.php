<?php
header('Content-Type: application/json');
$BDD = new mysqli("localhost","root","","kratosgym");

$tam=strlen(dirname($_SERVER["SCRIPT_NAME"]));
if($tam==1){$incre=0;}else{$incre=1;}
$ruta=explode("/",substr($_SERVER["REQUEST_URI"],$tam+$incre));

$data=array("resp"=>false,"ruta"=>$ruta);

if($ruta[0]=='excellist1')
{
	require("vendor/autoload.php");
}
use PhpOffice\PhpSpreadsheet\IOFactory;

switch($ruta[0]){

case'login':
	$ci=$_POST["ci"];
	$pwd=sha1($_POST["pwd"]);
	$M=$BDD->query("select num,nom,ap,tipo from user where ci='$ci' and pwd='$pwd'  ");
	foreach($M as $V)
	{	$data=array("resp"=>true,"msg"=>"Se inicio la sesion","num"=>$V["num"],"nom"=>$V["nom"],"ap"=>$V["ap"],"tipo"=>$V["tipo"]);
	}
break;

case'usersave':
	$nom=$_POST["nom"];
	$ap=$_POST["ap"];
	$ci=$_POST["ci"];
	$pwd=sha1($_POST["pwd"]);
	$std="act";
	$tipo="Pasante";
	$BDD->query("insert into user (nom,ap,ci,pwd,std,tipo) values ('$nom','$ap','$ci','$pwd','$std','$tipo') ");
	$data=array("resp"=>true,"msg"=>"se guardo");
break;

case'userup':
	$num=$_POST["num"];
	$nom=$_POST["nom"];
	$ap=$_POST["ap"];
	$email=$_POST["email"];
	$pwd=sha1($_POST["pwd"]);
	$tipo=$_POST["tipo"];
	$BDD->query("update person set nom='$nom', ap='$ap', email='$email', pwd='$pwd', tipo='$tipo' where num=$num  ");
	$data=array("resp"=>true,"msg"=>"se actualizo");
break;

case'userlist':
	$list=array();
	$M=$BDD->query("select num,nom,ap,ci from user where std='act' ");
	foreach($M as $V)
	{	array_push($list,$V);
	}
	$data=array("resp"=>true,"list"=>$list);
break;

case'userinfo':
	$num=$ruta[1];
	//LISTA DE IMAGENES
	$fots=array();
	$M=$BDD->query("select codf,fechf from personfot where num=$num ");
	foreach($M as $V)
	{	if(file_exists("personfot/".$V["codf"].".jpg"))
		{	array_push($fots,array("codf"=>$V["codf"],"fechf"=>$V["fechf"],"url"=>"api/personfot/".$V["codf"].".jpg"));	}
		else
		{	array_push($fots,array("codf"=>$V["codf"],"fechf"=>$V["fechf"],"url"=>"api/res/person.jpg"));	}
	}

	$M=$BDD->query("select num,nom,ap,email,pwd,tipo from person where num=$num ");
	foreach($M as $V)
	{	$data=array("resp"=>true,"num"=>$V["num"],"nom"=>$V["nom"],"ap"=>$V["ap"],"email"=>$V["email"],"pwd"=>$V["pwd"],"tipo"=>$V["tipo"],           "fots"=>$fots);
	}
break;

case'userdel':
	$num=$ruta[1];
	if($BDD->query("delete from person where num=$num"))
	{	$data=array("resp"=>true,"msg"=>"Se elimino");	}
	else
	{	$data=array("resp"=>false,"msg"=>"No, se elimino");	}
break;

case'userfotsave':
	$num=$_POST["num"];
	$fechf=date("Y-m-d");
	$cant=count($_FILES["arch"]["tmp_name"]);
	for($P=0; $P<$cant; $P++)
	{	$tmp=$_FILES["arch"]["tmp_name"][$P];
		$codf=time().$P;
		$nom=$codf.".jpg";
		$BDD->query("insert into personfot (codf,num,fechf) values ('$codf',$num,'$fechf') ");
		if(move_uploaded_file($tmp,"personfot/$nom"))
		{	$msg="Se subio con exito";	}
		else
		{	$msg="No, se subio el archivo";	}
	}
	$data=array("resp"=>true,"msg"=>$msg);
break;

case'librosave':
	$codl=$_POST["codl"];
	$noml=$_POST["noml"];
	$des=$_POST["des"];
	$fechp=$_POST["fechp"];
	$stdl="act";
	$tipo=$_POST["tipo"];
	$BDD->query("insert into libro (codl,noml,des,fechp,stdl,tipo) values        ('$codl','$noml','$des','$fechp','$stdl','$tipo')");

	$tmp=$_FILES["arch"]["tmp_name"];
	$nom=$codl.".jpg";
	if(move_uploaded_file($tmp,"libro/$nom"))
	{	$msg="Se subio con exito";	}
	else
	{	$msg="No, se subio el archivo";	}

	$data=array("resp"=>true,"msg"=>$msg);
break;

case'librolist':
	$list=array();
	$M=$BDD->query("select codl,noml,des,fechp from libro where stdl='act' ");
	foreach($M as $V)
	{	$codl=$V["codl"];
		if(file_exists("libro/$codl".".jpg"))
		{	$img="api/libro/$codl".".jpg";	}
		else
		{	$img="api/res/libro.jpg";	}
		array_push($list,array("codl"=>$codl,"noml"=>$V["noml"],"des"=>$V["des"],"fechp"=>$V["fechp"],"img"=>$img));
	}
	$data=array("resp"=>true,"list"=>$list);
break;

case'librodel':
	$codl=$ruta[1];
	if($BDD->query("update libro set stdl='del' where codl='$codl'  "))
	{	$data=array("resp"=>true,"msg"=>"Se elimino");	}
	else
	{	$data=array("resp"=>false,"msg"=>"No, se elimino");	}
break;

case'libroinfo':
$codl=$ruta[1];
//Lista de autores
$autors=array();
$M2=$BDD->query("select numa,nom,ap,rela from person,autor where person.num=autor.num and codl='$codl' ");
foreach($M2 as $V2)
{	array_push($autors,$V2);
}
//datos del libro
$M=$BDD->query("select codl,noml,des,fechp from libro where codl='$codl' ");
foreach($M as $V)
{	$data=array("resp"=>true,"codl"=>$V["codl"],"noml"=>$V["noml"],         "des"=>$V["des"],"fechp"=>$V["fechp"],"autors"=>$autors);
}
break;

case'libroup':
$codl=$_POST["codl"];
$noml=$_POST["noml"];
$des=$_POST["des"];
$fechp=$_POST["fechp"];
$BDD->query("update libro set noml='$noml',des='$des',fechp='$fechp' where codl='$codl'  ");
$data=array("resp"=>true,"msg"=>"se guardo");
break;

case'autorsave':
$codl=$_POST["codl"];
$num=$_POST["num"];
$rela=$_POST["rela"];
$BDD->query("insert into autor (codl,num,rela) values                      ('$codl',$num,'$rela') ");
$data=array("resp"=>true,"msg"=>"se guardo");
break;

case'autordel':
	$numa=$ruta[1];
	if($BDD->query("delete from autor where numa=$numa"))
	{	$data=array("resp"=>true,"msg"=>"Se elimino");	}
	else
	{	$data=array("resp"=>false,"msg"=>"No, se elimino");	}
break;

case'autorup':
	$numa=$_POST["numa"];
	$rela=$_POST["rela"];
	$BDD->query("update autor set rela='$rela' where numa=$numa  ");
	$data=array("resp"=>true,"msg"=>"se actualizo");
break;

case'panel':
	$list=array();
	$M=$BDD->query("select gen,count(*) as cant from person group by gen ");
	foreach($M as $V)
	{	array_push($list,array("cant"=>$V["cant"],"gen"=>$V["gen"]));
	}

	$tipos=array();
	$M=$BDD->query("select tipo, count(codl) as cant from libro group by tipo ");
	foreach($M as $V)
	{	array_push($tipos,array("cant"=>$V["cant"],"tipo"=>$V["tipo"]));
	}
	
	$hoy=date("Y-m-d");
	$mays=0;
	$mens=0;
	$M=$BDD->query("select fechn from person where std='act' ");
	foreach($M as $V)
	{	$fechn=$V["fechn"];
			$T=date_diff(date_create($fechn),date_create($hoy));
			if($T->y>=18)
			{		$mays++;	}
			else
			{		$mens++;	}
	}

	$data=array("resp"=>true,"list"=>$list,"tipos"=>$tipos,"mays"=>$mays,"mens"=>$mens);
break;

case'planeslist':
	$list=array();
	$M=$BDD->query("select nump,nomp,prec,des from planes ");
	foreach($M as $V)
	{	array_push($list,$V);
	}
	$data=array("resp"=>true,"list"=>$list);
break;

case'planessave':
	$nomp=$_POST["nomp"];
	$prec=$_POST["prec"];
	$des=$_POST["des"];
	$BDD->query("insert into planes (nomp,prec,des) values ('$nomp',$prec,'$des') ");
	$M=$BDD->query("select max(nump) as nump from planes ");
	foreach($M as $V)
	{
		$nump=$V["nump"];
	}
	$data=array("resp"=>true,"msg"=>"se guardo","nump"=>$nump,"nomp"=>$nomp,"prec"=>$prec);
break;

case'excellist1':
	
	$excel = IOFactory::load('mat/Excel1.xlsx');
	//$hoja = $excel->getActive();
	$hoja = $excel->getSheet(0);
	$FT = $hoja->getHighestRow();
	$CT = $hoja->getHighestColumn();
	$list=array();
	for($P=2; $P<=$FT; $P++)
	{
		$nom = $hoja->getCell("A$P")->getValue();
		$ap = $hoja->getCell("B$P")->getValue();
		$ci = $hoja->getCell("C$P")->getValue();
		array_push($list,array("nom"=>$nom,"ap"=>$ap,"ci"=>$ci));
	}	
	
	$data=array("resp"=>true,"list"=>$list,"ft"=>$FT,"ct"=>$CT);

break;




}echo json_encode($data);
?>