<?php require_once('Connections/cone.php'); 

function limpiar_caracteres_especiales($s) {
	$s = ereg_replace("[áaâaa]","a",$s);
	$s = ereg_replace("[ÁAÂA]","A",$s);
	$s = ereg_replace("[éee]","e",$s);
	$s = ereg_replace("[ÉEE]","E",$s);
	$s = ereg_replace("[íiî]","i",$s);
	$s = ereg_replace("[ÍIÎ]","I",$s);
	$s = ereg_replace("[óoôoo]","o",$s);
	$s = ereg_replace("[ÓOÔO]","O",$s);
	$s = ereg_replace("[úuu]","u",$s);
	$s = ereg_replace("[ÚUU]","U",$s);
	$s = str_replace("-","",$s);
	$s = str_replace(" ","-",$s);
	$s = str_replace("n","n",$s);
	$s = str_replace("N","N",$s);
	//para ampliar los caracteres a reemplazar agregar lineas de este tipo:
	//$s = str_replace("caracter-que-queremos-cambiar","caracter-por-el-cual-lo-vamos-a-cambiar",$s);
	return $s;
}	

    function text2url($string) {
		
		
	//$string = limpiar_caracteres_especiales(trim($string));
       $spacer = "-";
       $string = trim($string);
	   
	   $string = str_replace("nbsp", "", $string);
	   $string = str_replace("&aacute;", "a", $string);
	   $string = str_replace("&eacute;", "e", $string);
	   $string = str_replace("&iacute;", "i", $string);
	   $string = str_replace("&oacute;", "o", $string);
	   $string = str_replace("&uacute;", "u", $string);
	   $string = str_replace("&ldquo;", "", $string);
	   $string = str_replace("&rdquo;", "", $string);
	   $string = str_replace("ndash", "", $string);
	   $string = str_replace("&reg;", "", $string);
	   $string = str_replace("&Eacute;", "e", $string);
	   $string = str_replace("iquest", "", $string);
	   $string = str_replace("’", "", $string);
	   $string = str_replace("w/", "with", $string);
	   $string = str_replace("’", "", $string);
	   $string = str_replace("&iexcl;", "", $string);
	   
	   $string = str_replace("&amp;", "-y-", $string);

	   
       $string = strtolower($string);
       $string = trim(ereg_replace("[^ A-Za-z0-9_]", " ", $string)); 
 		
   
       $string = ereg_replace("[ \t\n\r]+", "-", $string);
       $string = str_replace(" ", $spacer, $string);
	   
       $string = ereg_replace("[ -]+", "-", $string);
       return $string; 
    }


session_start();
if ($_GET['elimna']==1){
	$_SESSION['productos'] = array();	
	header("Location:index.php");
}

$totalpremio4s = 0 ;
if (is_array($_SESSION['productos']) && count($_SESSION['productos'])){
while (list($idsd,$infods) = each($_SESSION['productos']))
{
	while (list($titulods,$cantidad) = each($infods))
	{

		$totalpremio4s += $cantidad;
	}
}
}
$homef = 0;
if ((!isset($_GET['familia'])) && (!isset($_GET['categoria'])) && (!isset($_GET['familia2'])) && (!isset($_GET['familia3'])) && (!isset($_GET['familia4'])) && (!isset($_GET['familia7'])) && (!isset($_GET['familia5'])) && (!isset($_GET['familia6'])) && (!isset($_GET['familia9'])) && (!isset($_GET['familia8']))){
	$_GET['familia'] = 1;
	$_GET['categoria'] = 1;
	$homef = 1;
}
if ((isset($_GET['busca'])) || (isset($_GET['busca2'])) || (isset($_GET['busca3'])) || (isset($_GET['busca4'])) || (isset($_GET['busca5'])) || (isset($_GET['busca6'])) || (isset($_GET['busca7'])) || (isset($_GET['busca8']))) {
	$_GET['familia'] = '';
	$_GET['categoria'] = '';
}
if (!isset($_GET['categoria2'])){
	$linkcontrol2 = 1;
}
if (!isset($_GET['categoria3'])){
	$linkcontrol3 = 1;
}
if (!isset($_GET['categoria4'])){
	$linkcontrol4 = 1;
}
if (!isset($_GET['categoria7'])){
	$linkcontrol7 = 1;
}
if (!isset($_GET['categoria5'])){
	$linkcontrol5 = 1;
}
if (!isset($_GET['categoria6'])){
	$linkcontrol6 = 1;
}
if (!isset($_GET['categoria13'])){
	$linkcontrol13 = 1;
}

if (!isset($_GET['orden'])){
	//$_GET['orden'] = 1;
}
	
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rs_cate = "-1";
if (isset($_GET['vid'])) {
  $colname_rs_cate = $_GET['vid'];
}


mysql_select_db($database_cone, $cone);
$query_rs_cate = sprintf("SELECT * FROM mabel_store_categoria WHERE id = %s", GetSQLValueString($colname_rs_cate, "int"));
$rs_cate = mysql_query($query_rs_cate, $cone) or die(mysql_error());
$row_rs_cate = mysql_fetch_assoc($rs_cate);
$totalRows_rs_cate = mysql_num_rows($rs_cate);
?>
<!DOCTYPE html>
<html lang="en"><head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 

<?php if ($_GET['familia']==1) { ?>
<title>El Camino Más Fácil - Ho'oponopono Recursos - Tienda Mabel Katz</title>
<meta name="Keywords" content="El Camino Más Fácil,Eventos,Audios,Videos,Cds,Entrenamientos,Mabel Katz,El Camino Más Fácil,Hooponopono" />
<meta name="Description" content="Lo que ya era fácil se volvió aún más fácil con la Edición Especial del libro que inició todo. El Camino Más Fácil ahora incluye un bono especial. - Mabel Katz"/>
<?php } ?>
<?php if ($_GET['familia2']==2) { ?>
<title>Zero Frequency - Ho'oponopono Recursos - Tienda Mabel Katz</title>
<meta name="Keywords" content="Zero Frequency,Eventos,Audios,Videos,Cds,Entrenamientos,Mabel Katz,El Camino Más Fácil,Hooponopono" />
<meta name="Description" content="Cómo Acceder a Tu Sabiduría Interior descubriendo Zero Frequency dentro de TI. - Mabel Katz"/>
<?php } ?>
<?php if ($_GET['familia3']==3) { ?>
<title>Campaña por la Paz Mundial - La paz comienza conmigo - Ho'oponopono Recursos - Tienda Mabel Katz</title>
<meta name="Keywords" content="Campaña por la Paz Mundial, La paz comienza conmigo,Eventos,Audios,Videos,Cds,Entrenamientos,Mabel Katz,El Camino Más Fácil,Hooponopono" />
<meta name="Description" content="Si adoptamos la Filosofía de la Paz Conciente y el Símbolo de la Flor de Lis, podemos inspirar a otros a unirse a nosotros en este movimiento de paz mundial - Mabel Katz"/>
<?php } ?>
<?php if ($_GET['familia4']==4) { ?>
<title>Niños - El Camino Más Fácil para Crecer  - Ho'oponopono Recursos - Tienda Mabel Katz</title>
<meta name="Keywords" content="El Camino Más Fácil para Crecer,Eventos,Audios,Videos,Cds,Entrenamientos,Mabel Katz,El Camino Más Fácil,Hooponopono" />
<meta name="Description" content="Por primera vez, un libro basado en Ho'oponopono ¡para Chicos de 3 a 100 años! - Mabel Katz"/>
<?php } ?>
<?php if ($_GET['familia7']==7) { ?>
<title>Éxito y Riqueza - Ho'oponopono Recursos - Tienda Mabel Katz</title>
<meta name="Keywords" content="Éxito y Riqueza,Renew U,Eventos,Audios,Videos,Cds,Entrenamientos,Mabel Katz,El Camino Más Fácil,Hooponopono" />
<meta name="Description" content="Este teleseminario te dará la clave para el éxito, y recibirás gratis el extracto de la antología de negocios Inspiración a la Realización para darte un panorama de estos innovadores secretos de negocios. - Mabel Katz"/>
<?php } ?>
<?php if ($_GET['familia5']==5) { ?>
<title>Invitados Especiales - Ho'oponopono Recursos - Tienda Mabel Katz</title>
<meta name="Keywords" content="Invitados Especiales,Renew U,Eventos,Audios,Videos,Cds,Entrenamientos,Mabel Katz,El Camino Más Fácil,Hooponopono,Dr. Ihaleakalá" />
<meta name="Description" content="En este seminario de Ho'oponopono en vivo con el Dr. Ihaleakalá y Mabel aprenderás a resolver tus problemas de una manera fácil y sin depender de nada ni nadie."/>
<?php } ?>
<?php if ($_GET['familia6']==6) { ?>
<title>Entrenamientos - Ho'oponopono Recursos - Tienda Mabel Katz</title>
<meta name="Keywords" content="Entrenamientos,Eventos,Audios,Videos,Cds,Entrenamientos,Mabel Katz,El Camino Más Fácil,Hooponopono,40 Dias y 40 Noches" />
<meta name="Description" content="En este seminario de Ho'oponopono en vivo con el Dr. Ihaleakalá y Mabel aprenderás a resolver tus problemas de una manera fácil y sin depender de nada ni nadie. - Mabel Katz"/>
<?php } ?>
<?php if ($_GET['familia9']==9) { ?>
<title>Consultas sobre Negocios - Ho'oponopono Recursos - Tienda Mabel Katz</title>
<meta name="Keywords" content="Consultas sobre Negocios,Eventos,Audios,Videos,Cds,Entrenamientos,Mabel Katz,El Camino Más Fácil,Hooponopono,40 Dias y 40 Noches" />
<meta name="Description" content="Su oportunidad de tener tiempo privado con Mabel Katz"/>
<?php } ?>
<?php if ($_GET['familia8']==8) { ?>
<title>El Apoyo Sagrado de Ho'oponopono - Ho'oponopono Recursos - Tienda Mabel Katz</title>
<meta name="Keywords" content="El Apoyo Sagrado de Ho'oponopono,Eventos,Audios,Videos,Cds,Entrenamientos,Mabel Katz,El Camino Más Fácil,Hooponopono,40 Dias y 40 Noches" />
<meta name="Description" content="El Apoyo Sagrado de Ho'oponopono nos ha mostrado que mantiene a nuestros miembros en esa sintonía perfecta de la limpieza y en Paz, a través de la Salud, Soledad, Abundancia y Felicidad."/>
<?php } ?>
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<meta http-equiv="window-target" content="_top" />
<meta name="author" content="Mabel Katz" />
<meta name="revisit-after" content="5 days" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="content-style-type" content="text/css"  />
<meta name="robots" content="index,follow"  />
<meta name="mssmarttagspreventparsing" content="true" />
<meta name="rating" content="general" />
<meta name="copyright" content="This page and all its contents are copyright 2007-2008 by Mabel Katz. All Rights Reserved." />
<meta name="google-site-verification" content="LwW0lVcGijuefa9ayEVW1wMWVQ3vNHKxGGffM-3gm9s" />
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Raleway:900,700,600,400,300' />
<script>
function cargaURL(valor) 
{ 
   window.location.href = "http://"+valor; //Will take you to Google.
} 

</script>

<script type="text/javascript" src="https://apps.successengine.net/getSocialProofScript/249U5b6e07ac8e939"></script>


	<script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="/source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<link rel="stylesheet" type="text/css" href="/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<link rel="stylesheet" type="text/css" href="/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>  
  <!-- Go to www.addthis.com/dashboard to customize You tools -->
<script type="text/javascript">

function MM_swapImgRestore() { //v3.0
var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
var p,i,x; if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

		$(document).ready(function() {
			$('.fancybox').fancybox();

			$("#regalo_2").click(function() {
				$.fancybox.open({
					href : '/formulario.php',
					type : 'iframe',
					'width'				: 270,
					'height'			: 270,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,				
				});
			});							
			
			
							
		});


	</script>  
<style>
blockquote {
    background-color: #E7F0F5;
    border: 1px dashed #297EAA;
    padding: 5px;
    font-style: italic;
    color: #000000;
	font-size: 16px;
}
#me{
	color:#000000;
    width: 80%;
    margin-left: 220px;
}
#mmi {
	width:100%;
	max-width:600px;
}
#okf {
position:absolute; left: 371px; top: 29px;border: 10px solid #FF6600;	
}
#bbn {
    width: 100%;
    height: 130px;
    display: block;
    padding: 11px;
}
@media screen and (min-width:50px) and (max-width:500px) {
#bbn {
	display:none;
}
#me{

    margin-left: 0px;
	width: 100%;
}
	
#okf {
position:absolute; left: 0px; top: 10px;border: 10px solid #FF6600;	
}	
}
</style>
<link rel="stylesheet" href="dist/slicknav.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
<script src="dist/jquery.slicknav.js"></script>       
    
<script src="http://store.mabelkatz.com/js/jquery.accordion.source.js" type="text/javascript" charset="utf-8"></script>  
<script type='text/javascript' src='/js/jquery.velocity.min.js'></script>
 <script src="js/home.js" type="text/javascript" charset="utf-8"></script> 
	<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
    <link href="/css/component1.css" rel="stylesheet" type="text/css">
	<link href="/css/default.css" rel="stylesheet" type="text/css">
	<link href="/css/component.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/css/home.css" />


<?php if (($_GET['familia']==1) && ($_GET['categoria']==1)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Libros sobre la técnica Ho’oponopono escritos por Mabel Katz. " />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_2098294839Reflexiones-sobre-ho-oponopono-news-nuevo.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1832705392El-camino-mas-facil-edicion-especial.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_55436545libro-el-camino-mas-facil-vivir.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_480454096the-easiest-way-minibook-s.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1287873140libro-el-camino-mas-facil-crecer.png" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>
<?php if (($_GET['familia']==1) && ($_GET['categoria']==2)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Audios sobre la técnica Ho’oponopono escritos por Mabel Katz. " />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1975149195audio-El-camino-mas-facil-a-la-prosperidad.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1084939982teleseminario-ho-oponopono-ihaleakala-mabel-katz-1.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_1862631578audio-el-camino-mas-facil-ihaleakala.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1415283420telseminario-ho-oponopono-mabel-katz.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_614487878paquetes-de-negocios-.jpg" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>
<?php if (($_GET['familia']==1) && ($_GET['categoria']==3)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Audios Libros sobre la técnica Ho’oponopono escritos por Mabel Katz. " />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1530181842ebooklets-spanish-version.png" />
<meta property="og:image" content="http://store.mabelkatz.com/upload/_img01_2016362821_img01_417606659audios-el-camino-mas-facil-.jpg" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>
<?php if (($_GET['familia']==1) && ($_GET['categoria']==4)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Ebooks sobre la técnica Ho’oponopono escritos por Mabel Katz. " />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1530181842ebooklets-spanish-version.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_1170266381ebookSpanish.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_1098278676tew-ee-croatian-version.png" />
<meta property="og:description" content="&nbsp;" />

<?php } ?>

<?php if (($_GET['familia']==1) && ($_GET['categoria']==5)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Videos Digitales sobre la técnica Ho’oponopono escritos por Mabel Katz. " />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_587690874mas-sobre-ho-oponopono-mabel-katz.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_150503573milagros.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1375964030renewu-es1.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_2117323559webinario-espanol.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_990871521Mini-Taller-El-Camino-Mas-Facil-al-exito-la-Prosperidad-y-las-Relaciones-Armoniosas-1.jpg" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>

<?php if (($_GET['familia']==1) && ($_GET['categoria']==6)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Teleclase sobre la técnica Ho’oponopono escritos por Mabel Katz. " />
<meta property="og:image" content="http://store.mabelkatz.com/upload/_img01_775087711nov-teleclase.png" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>


<?php if (($_GET['familia']==1) && ($_GET['categoria']==7)) { ?>
<meta property="og:title" content="El Camino Más Fácil. CDs & DVDs sobre la técnica Ho’oponopono escritos por Mabel Katz. " />
<meta property="og:image" content="http://store.mabelkatz.com/upload/_img01_1091812110_img01_1287873140libro-el-camino-mas-facil-crecer.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_470339298music-of-hawaii.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_861638964el-camino-mas-facil-a-la-prosperidad-mabel-katz.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_107446290El-camino-mas-facil-ihaleakala-mabel-katz-3cds.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_652024393el-camino-mas-facil-2cds-libro.jpg" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>
<?php if (($_GET['familia']==1) && ($_GET['categoria']==8)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Aplicación para móviles sobre la técnica Ho’oponopono escritos por Mabel Katz. " />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_435284170app-iphone.png" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>
<?php if (($_GET['familia']==1) && ($_GET['categoria']==9)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Kindle sobre la técnica Ho’oponopono escritos por Mabel Katz. " />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_198143905Mis-reflexiones-sobre-hooponopono-kindle.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_1774206858ECMF-EE-KINDLE.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_1303289905ECMF-PE-KINDLE.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_920530453ECMF-KINDLE.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_349298601ECMF-PV-KINDLE.png" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>


<?php if (($_GET['familia2']==2) && ($_GET['categoria2']==2)) { ?>
<meta property="og:title" content="Zero Frequency. Tu Estado Natural. Recursos digitales para alcanzar tu frecuencia perfecta" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_1165615409ZeroFrequencyTeleWebcast-hun-es2.png" />
<meta property="og:description" content="con Mabel Katz" />
<?php } ?>

<?php if (($_GET['familia3']==3) && ($_GET['categoria3']==11)) { ?>
<meta property="og:title" content="La paz comienza CONMIGO -  Campaña por la Paz Mundial de Mabel Katz. Productos Flor de Lis " />
<meta property="og:image" content="http://store.mabelkatz.com/upload/_img01_805069299bolso-flor-de-lis.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_113951287pulseraES.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_760565744bs3.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_1163544377stikersx5FlordeLis.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_184426816LisPin.jpg" />
<meta property="og:description" content="Para difundir la Conciencia y la Paz alrededor del Mundo" />
<?php } ?>


<?php if (($_GET['familia4']==4) && ($_GET['categoria4']==1)) { ?>
<meta property="og:title" content="El Camino Más Fácil para Crecer. Ho’oponopono para Niños de 3 a 100 años de edad con Mabel Katz." />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1287873140libro-el-camino-mas-facil-crecer.png" />
<meta property="og:description" content="Libros" />
<?php } ?>

<?php if (($_GET['familia4']==4) && ($_GET['categoria4']==2)) { ?>
<meta property="og:title" content="El Camino Más Fácil para Crecer. Ho’oponopono para Niños de 3 a 100 años de edad con Mabel Katz." />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_1889021354Bundle-the-easiest-way-to-grow.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_417606659audios-el-camino-mas-facil-.jpg" />
<meta property="og:description" content="Audios Digitales" />
<?php } ?>

<?php if (($_GET['familia4']==4) && ($_GET['categoria4']==3)) { ?>
<meta property="og:title" content="El Camino Más Fácil para Crecer. Ho’oponopono para Niños de 3 a 100 años de edad con Mabel Katz." />
<meta property="og:image" content="http://store.mabelkatz.com/upload/_img01_2016362821_img01_417606659audios-el-camino-mas-facil-.jpg" />
<meta property="og:description" content="Audio Libros" />
<?php } ?>

<?php if (($_GET['familia4']==4) && ($_GET['categoria4']==5)) { ?>
<meta property="og:title" content="El Camino Más Fácil para Crecer. Ho’oponopono para Niños de 3 a 100 años de edad con Mabel Katz." />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_160827647vbook-el-camino-mas-facil-.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_1889021354Bundle-the-easiest-way-to-grow.jpg" />
<meta property="og:description" content="Videos Digitales" />
<?php } ?>


<?php if (($_GET['familia7']==7) && ($_GET['categoria7']==2)) { ?>
<meta property="og:title" content="El Camino Más Fácil para alcanzar el Éxito y la Riqueza. Audios Digitales" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1415283420telseminario-ho-oponopono-mabel-katz.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/upload/_img01_818469035_img01_440179241ho-oponopono-teleclase-sobre-negocios.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_614487878paquetes-de-negocios-.jpg" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>

<?php if (($_GET['familia7']==7) && ($_GET['categoria7']==5)) { ?>
<meta property="og:title" content="El Camino Más Fácil para alcanzar el Éxito y la Riqueza. Videos Digitales" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_587690874mas-sobre-ho-oponopono-mabel-katz.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1138118708russ-espanol.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1375964030renewu-es1.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1726020433audio-El-camino-mas-facil-a-la-prosperidad.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1987469587conferencia-sobre-ho-oponopono-colombia.jpg" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>

<?php if (($_GET['familia7']==7) && ($_GET['categoria7']==6)) { ?>
<meta property="og:title" content="El Camino Más Fácil para alcanzar el Éxito y la Riqueza. Teleclase" />
<meta property="og:image" content="http://store.mabelkatz.com/upload/_img01_775087711nov-teleclase.png" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>

<?php if (($_GET['familia7']==7) && ($_GET['categoria7']==7)) { ?>
<meta property="og:title" content="El Camino Más Fácil para alcanzar el Éxito y la Riqueza. CDs & DVDs" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_861638964el-camino-mas-facil-a-la-prosperidad-mabel-katz.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_107446290El-camino-mas-facil-ihaleakala-mabel-katz-3cds.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1846643386RenewU-dvd.png" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1388113812dvd-el-camino-mas-facil-a-la-prosperidad-mabel-katz.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_1792554451el-camino-mas-facil-conferencia-en-dvd.jpg" />
<meta property="og:description" content="&nbsp;" />
<?php } ?>

<?php if (($_GET['familia5']==5) && ($_GET['categoria5']==2)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Conoce más sobre la técnica de Ho’oponopono" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1084939982teleseminario-ho-oponopono-ihaleakala-mabel-katz-1.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_1862631578audio-el-camino-mas-facil-ihaleakala.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_2079047971renewu-es1.jpg" />
<meta property="og:description" content="Junto a Mabel Katz y a sus Invitados Especiales. Audios Digitales" />
<?php } ?>

<?php if (($_GET['familia5']==5) && ($_GET['categoria5']==5)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Conoce más sobre la técnica de Ho’oponopono" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_453709315ihaleakala-en-las-escuelas-ort.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_2117323559webinario-espanol.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1375964030renewu-es1.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1138118708russ-espanol.jpg" />
<meta property="og:description" content="Junto a Mabel Katz y a sus Invitados Especiales. Videos Digitales" />
<?php } ?>

<?php if (($_GET['familia5']==5) && ($_GET['categoria5']==7)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Conoce más sobre la técnica de Ho’oponopono" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_107446290El-camino-mas-facil-ihaleakala-mabel-katz-3cds.jpg" />
<meta property="og:description" content="Junto a Mabel Katz y a sus Invitados Especiales. CDs & DVDs" />
<?php } ?>

<?php if (($_GET['familia6']==6) && ($_GET['categoria6']==2)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Conoce más sobre la técnica de Ho’oponopono " />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1415283420telseminario-ho-oponopono-mabel-katz.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/upload/_img01_818469035_img01_440179241ho-oponopono-teleclase-sobre-negocios.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/upload/_img01_614487878paquetes-de-negocios-.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_2079047971renewu-es1.jpg" />
<meta property="og:description" content="Junto a Mabel Katz. Audios Digitales" />
<?php } ?>

<?php if (($_GET['familia6']==6) && ($_GET['categoria6']==5)) { ?>
<meta property="og:title" content="El Camino Más Fácil. Conoce más sobre la técnica de Ho’oponopono" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_78952500230-dias-para-abrir-tu-mente.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1138118708russ-espanol.jpg" />
<meta property="og:image" content="http://store.mabelkatz.com/admin/_img01_1375964030renewu-es1.jpg" />
<meta property="og:description" content="Junto a Mabel Katz. Videos Digitales" />
<?php } ?>

<?php if (($_GET['familia9']==9) && ($_GET['categoria9']==10)) { ?>
<meta property="og:title" content="Consulta de Negocios. Consulta con Mabel tus preguntas sobre tus negocios" />
<meta property="og:image" content="http://store.mabelkatz.com/upload/_img01_295772763AskMabel.jpg" />
<meta property="og:description" content="Mientras ella limpia contigo y tu problemas." />
<?php } ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5DHQPTM');</script>
<!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DHQPTM"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<a href="" id="scroll-down"></a>
		<div class="container">
        <div class="sup_fram">
        <div id="regalo"><img src="img/regalo_mabel_katz.jpg" width="47" height="49"></div>
        <div id="regalo_2">
         Suscríbete al boletín GRATIS y disfruta <br>
        de los regalos que Mabel eligió para tí.</div>
<div id="logh">
            <table width="260" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td width="140" align="left"><form name="form2" method="post" action="" style="margin-right:5px">
		                <select name="idioma" id="idioma" onchange="cargaURL(this.value)">
		                  <option value="0">Seleccionar Lenguaje</option>
		                  <option value="store.mabelkatz.com">English</option>
                          <option value="webaruhaz.mabelkatz.com">Magyar</option>
                          <option value="store.mabelkatz.com/russian-products">русский</option>
                          <option value="store.mabelkatz.com/croato-products">Hrvatski</option>
	                    </select>
                  </form></td>
                  <td width="83" align="right"><a href="https://wg148.customerhub.net/"><img src="/img/member.png" alt="" width="105" height="31" border="0"></a></td>
                </tr>
                
              </tbody>
            </table>
          </div><div id="blogh2" onClick="javascript:window.open('http://hooponopono-espanol.com/category/hooponopono-espanol/', '_blank');"> <a href="http://hooponopono-espanol.com/category/hooponopono-espanol/" target="_blank" style="float:left;margin-top: 2px;margin-left: 2px;"><img src="img/tt.png" name="bl" width="26" height="28" border="0" id="bl" onMouseOver="MM_swapImage('bl','','img/blog2.png',1)" onMouseOut="MM_swapImgRestore()"></a><span class="letrafollo3"><strong>BLOG</strong></span></div>
          
          <div id="blogh" onClick="javascript:window.open('http://elcaminomasfacil.com/', '_self');"> <a href="http://elcaminomasfacil.com/" style="float:left"><img src="img/mm.png" name="bl" width="35" height="31" border="0" id="bl" onMouseOver="MM_swapImage('bl','','img/blog2.png',1)" onMouseOut="MM_swapImgRestore()"></a><span class="letrafollo2"><strong>HOME</strong></span></div>
          
		<div id="blogh3" onClick="javascript:window.open('http://elcaminomasfacil.com/ho-oponopono-seminarios-eventos-talleres.htm', '_self');"> <a href="http://elcaminomasfacil.com/ho-oponopono-seminarios-eventos-talleres.htm" style="float:left"><img src="img/live.png" name="bl" width="40" height="31" border="0" id="bl" onMouseOver="MM_swapImage('bl','','img/blog2.png',1)" onMouseOut="MM_swapImgRestore()"></a><span class="letrafollo2"><strong>EVENTOS</strong></span></div>

          
</div>
		  <header>
          <div class="banner" id="bb01" style="display: block;">
<div id="logo_mabel">
<div style="position:relative">
<div style="position:absolute;    top: -40px;
    left: -50px;">
<!--  <img src="img/navidad.png" width="84" height="110">--> </div>
</div>
<span style="font-family: Fontin, Palatino, serif;  color: #2D2D2D;  font-size: 45px;">Mabel Katz</span><div style="position:relative">
<div style="position:absolute; left: 3px; top: -7px;"><img src="/img/rojo.jpg" width="36" height="14"></div></div>		    

		  </div>
          <div id="imahgen">
          <img src="/img/libros.jpg" width="258" height="113">
          <!--<img src="https://mabelkatz.com/imagenes/MK-BannerSuperior50OFFshortweb.png" style="margin-top: -21px;margin-left: -5px;width: 175%;">-->
          </div>
          <div id="buscadort">
          <form name="form1" method="get" action="..//">
  <input type="image" src="/img/mm.jpg" width="33" height="25" style="
    float: right;
"><input name="busca" type="text" id="busca" value="&nbsp;&nbsp;Buscar" onfocus="clearField('busca')" onblur="setField('busca', '  Buscar')" style="    float: right;
">
  
  </form>
          </div>
          <div id="socialtr">
			<p class="letrafollo">Follow Us</p>
            <ul class="horizontal">
                <li><a href="http://www.facebook.com/MabelKatzfanpage" target="_blank" class="llp"><img src="img/btn_facebook.png" width="32" height="36" border="0" /></a></li>
                <li><a href="https://twitter.com/mabelkatz" target="_blank" class="llp"><img src="img/btn_twitter.png" width="35" height="36" border="0" /></a></li>
                <li><a href="http://youtube.com/mabelkatz" target="_blank" class="llp"><img src="img/brn_yt.png" width="39" height="36" border="0" /></a></li>
                <li><a href="http://www.linkedin.com/in/mabelkatz" target="_blank" class="llp"><img src="img/btn_link.png" width="39" height="36" border="0"/></a></li>
            </ul>
          </div>
          
          
          <div id="bb02" style="width: 100%;height: 46px;background-color: #FFF;text-align: center; padding-top: 10px; display:none">
            <img src="/img/logomobile.jpg" width="300" height="26"></div>
          </header>      
            
		  <div class="tabs" id="tabs">
			  <nav id="full">
					<ul>
<li id="vm1"><a href="/hooponopono-el-camino-mas-facil-libros" id="m1" onClick="$:location.href='/hooponopono-el-camino-mas-facil-libros'"><span>El Camino Más Fácil</span></a></li>
<li id="vm2"><a href="/zero-frequency-audios-digitales" id="m2" onClick="$:location.href='/zero-frequency-audios-digitales'"><span>Zero Frequency ®</span></a></li>
<li id="vm3"><a href="/paz-mundial-productos" id="m3" onClick="$:location.href='/paz-mundial-productos'"><span>Campaña por la Paz Mundial</span></a></li>
<li id="vm4"><a href="/chicos-libros-el-camino-mas-facil-para-crecer" id="m4" onClick="$:location.href='/chicos-libros-el-camino-mas-facil-para-crecer'"><span>Niños</span></a></li>
<li id="vm5"><a href="/riqueza-audios-digitales" id="m5" onClick="$:location.href='/riqueza-audios-digitales'"><span>Éxito y Riqueza</span></a></li>
<li id="vm6"><a href="/invitados-especiales-audios-digitales" id="m6" onClick="$:location.href='/invitados-especiales-audios-digitales'"><span>Invitados Especiales</span></a></li>
<li id="vm7"><a href="/tele-entrenamientos-audios-digitales" id="m7" onClick="$:location.href='/tele-entrenamientos-audios-digitales'"><span>Entrenamientos</span></a></li>
<li id="vm8"><a href="/programa-de-apoyo-hooponopono" id="m8" onClick="$:location.href='/programa-de-apoyo-hooponopono'"><span>Apoyo Ho’oponopono
</span></a></li>
<li id="vm9"><a href="/172/9/10/preguntale-a-mabel" id="m9" onClick="$:location.href='/172/9/10/preguntale-a-mabel'"><span>Consultas sobre Negocios</span></a></li>

<li id="vm10"><a href="https://elcaminomasfacil.com/shasta-2018/" id="m9" onClick="$:location.href='https://elcaminomasfacil.com/shasta-2018/'"><span>Viajes Espirituales</span></a></li>
					</ul>
			</nav> 	
            
<ul id="menu" style="display:none">
    <li>El Camino Más Fácil
<ul>
<li><a href="/hooponopono-el-camino-mas-facil-libros" class="m2">Libros</a></li>
<li><a href="/142/1/6/teleclase-mensual-abril-2019" class="m2">TeleClases</a></li>
<li><a href="/hooponopono-el-camino-mas-facil-audios-digitales" class="m2">Audios Digitales</a></li>
<li><a href="/hooponopono-el-camino-mas-facil-audio-libros" class="m2">Audio Libros</a></li>
<li><a href="/hooponopono-el-camino-mas-facil-ebooks" class="m2">eBooks</a></li>
<li><a href="/hooponopono-el-camino-mas-facil-videos-digitales" class="m2">Videos Digitales</a></li>
<li><a href="/hooponopono-el-camino-mas-facil-cds-dvds" class="m2">CDs & DVDs</a></li>
<li><a href="/hooponopono-el-camino-mas-facil-aplicacion-para-moviles" class="m2">Aplicación para móviles</a></li>
<li><a href="/hooponopono-el-camino-mas-facil-kindle" class="m2">Kindle</a></li>
<li><a href="javascript:void()" target="_blank" class="m2">Viaje de Sanación y Limpieza</a>
</li>
<ul style="display:block" id="submm" >
    <li><a href="https://www.elcaminomasfacil.com/shasta-virtual-2018/" target="_blank" class="ff" style="background-color:rgb(168, 177, 167); color:#F00">Monte Shasta Virtual 2018 </a> </li>
	<li><a href="https://elcaminomasfacil.com/shasta-2018/" target="_blank" class="ff" style="background-color:rgb(168, 177, 167); color:#F00">Monte Shasta 2018  </a></li>
    
	<li><a href="http://elcaminomasfacil.com/india2017/" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">India 2017</a></li>	
    <li><a href="http://elcaminomasfacil.com/shasta/" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">Mount Shasta 2016 </a></li>
    <li><a href="http://elcaminomasfacil.com/magia" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">Teotihuacán 2016</a></li>
    <li><a href="http://elcaminomasfacil.com/hooponopono-viaje-de-sanacion-Limpieza-tulum.html" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">Tulum 2014</a></li>
    <li><a href="http://elcaminomasfacil.com/hooponopono-tour-peru-2013.html" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">Peru 2013</a></li>   
   <li><a href="http://elcaminomasfacil.com/hooponopono-tour-israel-2012.html" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">Israel 2013</a></li>
                    </ul>
	</ul>
    </li>
<li>
				<a href="#">Zero Frequency ®</a>
									<ul style="padding: 0px;">
<li><a href="/zero-frequency-teleclases" class="m2">TeleClases</a></li>
<li><a href="/zero-frequency-audios-digitales" class="m2">Audios Digitales</a></li>
	</ul>
	</li>   
    
<li>
				<a href="#">Campaña por la Paz Mundial</a>
									<ul style="padding: 0px;">
										  <li><a href="/paz-mundial-productos" class="m2">Productos de Paz</a></li>
                                          <li><a href="/paz-mundial-teleclases" class="m2">TeleClases</a></li>
                                          <li><a href="/paz-mundial-audios-digitales" class="m2">Audios Digitales</a></li>
	</ul>
	</li>   
    
<li>
				<a href="#">Niños</a>
									<ul style="padding: 0px;">
										  <li><a href="/chicos-libros-el-camino-mas-facil-para-crecer" class="m2">Libros</a></li>
                                          <li><a href="/chicos-audios-digitales-el-camino-mas-facil-para-crecer" class="m2">Audios Digitales</a></li>
                                          <li><a href="/chicos-audio-libros-el-camino-mas-facil-para-crecer" class="m2">Audio Libros</a></li>
                                          <li><a href="/chicos-videos-digitales-el-camino-mas-facil-para-crecer" class="m2">Videos Digitales</a></li>
	</ul>
	</li>
    
<li>
				<a href="#">Éxito y Riqueza</a>
									<ul style="padding: 0px;">
                                          <li><a href="/riqueza-audios-digitales" class="m2">Audios Digitales</a></li>
                                          <li><a href="/riqueza-videos-digitales" class="m2">Videos Digitales</a></li>
                                          <li><a href="/riqueza-cds-dvds" class="m2">CDs & DVDs</a></li>
                                          <li><a href="/riqueza-kindle" class="m2">Kindle</a></li>
	</ul>
	</li>  
    
<li>
				<a href="#">Invitados Especiales</a>
									<ul style="padding: 0px;">
                                          <li><a href="/invitados-especiales-audios-digitales" class="m2">Audios Digitales</a></li>
                                          <li><a href="/invitados-especiales-videos-digitales" class="m2">Videos Digitales</a></li>
                                          <li><a href="/invitados-especiales-cds-dvds" class="m2">CDs & DVDs</a></li>
	</ul>
	</li>    
    
<li>
				<a href="#">Entrenamientos</a>
									<ul style="padding: 0px;">
                                       <li><a href="/entrenamientos-audios-digitales" class="m2">Audios Digitales</a></li>
                                          <li><a href="/entrenamientos-videos-digitales" class="m2">Videos Digitales</a></li>
	</ul>
	</li>    
    
<li>
				<a href="/programa-de-apoyo-hooponopono">Apoyo Ho'oponopono</a>
	</li>        
<li>
				<a href="/172/9/10/preguntale-a-mabel">Consultas sobre Negocios</a>
	</li> 
    
    <li>
				<a href="https://elcaminomasfacil.com/shasta-2018/">Viajes Espirituales</a>
	</li> 
    

       
    
</ul>         
              
<div class="content">
<div id="loading"><img src="/img/loading1.gif" width="508" height="381"></div>              
<section id="section-1">
<div class="tabs2" id="tabsee2">
<nav2>
<ul>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 1 OR familia2 = 1 OR familia3 = 1 OR familia4 = 1) AND categoria = 1 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia']==1) && ($_GET['categoria']==1)) {?>
						<li><a href="/hooponopono-el-camino-mas-facil-libros" class="selecionado">Libros</a></li>
                    <? } else { ?>
                    	<li><a href="/hooponopono-el-camino-mas-facil-libros" class="ff">Libros</a></li>
                    <? } ?>
					<? } ?>
					  <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 1 OR familia2 = 1 OR familia3 = 1 OR familia4 = 1) AND categoria = 4 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia']==1) && ($_GET['categoria']==4)) {?>
					<li><a href="/hooponopono-el-camino-mas-facil-ebooks" class="selecionado">eBooks</a></li>
                    <? } else { ?>
                    <li><a href="/hooponopono-el-camino-mas-facil-ebooks" class="ff">eBooks</a></li>
                    <? } ?>
					<? } ?>       
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 1 OR familia2 = 1 OR familia3 = 1 OR familia4 = 1) AND categoria = 12 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia']==1) && ($_GET['categoria']==12)) {?>
					<li><a href="/142/1/6/teleclase-mensual-abril-2019" class="selecionado">TeleClases</a></li>
                    <? } else { ?>
					<li><a href="/142/1/6/teleclase-mensual-abril-2019" class="ff">TeleClases</a></li>
                    <? } ?>					
					<? } ?>    
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 1 OR familia2 = 1 OR familia3 = 1 OR familia4 = 1) AND categoria = 2 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia']==1) && ($_GET['categoria']==2)) {?>
					<li><a href="/hooponopono-el-camino-mas-facil-audios-digitales" class="selecionado">Audios Digitales</a></li>
                    <? } else { ?>
					<li><a href="/hooponopono-el-camino-mas-facil-audios-digitales" class="ff">Audios Digitales</a></li>
                    <? } ?>					
					<? } ?>                    
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 1 OR familia2 = 1 OR familia3 = 1 OR familia4 = 1) AND categoria = 3 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia']==1) && ($_GET['categoria']==3)) {?>
					<li><a href="/hooponopono-el-camino-mas-facil-audio-libros" class="selecionado">Audio Libros</a></li>
                    <? } else { ?>
                     <li><a href="/hooponopono-el-camino-mas-facil-audio-libros" class="ff">Audio Libros</a></li>
                     <? } ?>
					<? } ?>   
                                        
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 1 OR familia2 = 1 OR familia3 = 1 OR familia4 = 1) AND categoria = 5 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia']==1) && ($_GET['categoria']==5)) {?>
					<li><a href="/hooponopono-el-camino-mas-facil-videos-digitales" class="selecionado">Videos Digitales</a></li>
                    <? } else { ?>
                    <li><a href="/hooponopono-el-camino-mas-facil-videos-digitales" class="ff">Videos Digitales</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 1 OR familia2 = 1 OR familia3 = 1 OR familia4 = 1) AND categoria = 6 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia']==1) && ($_GET['categoria']==6)) {?>
					<li><a href="/142/1/6/teleclase-mensual-abril-2019" class="selecionado">TeleClases</a></li>
					<? } else { ?>
                    <li><a href="/142/1/6/teleclase-mensual-abril-2019" class="ff">TeleClases</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 1 OR familia2 = 1 OR familia3 = 1 OR familia4 = 1) AND categoria = 7 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia']==1) && ($_GET['categoria']==7)) {?>
					<li><a href="/hooponopono-el-camino-mas-facil-cds-dvds" class="selecionado">CDs & DVDs</a></li>
                    <? } else { ?>
                    <li><a href="/hooponopono-el-camino-mas-facil-cds-dvds" class="ff">CDs & DVDs</a></li>
                    <? } ?>
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 1 OR familia2 = 1 OR familia3 = 1 OR familia4 = 1) AND categoria = 8 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia']==1) && ($_GET['categoria']==8)) {?>
					<li><a href="/hooponopono-el-camino-mas-facil-aplicacion-para-moviles" class="selecionado">Aplicación para móviles</a></li>
                    <? } else { ?>
                    <li><a href="/hooponopono-el-camino-mas-facil-aplicacion-para-moviles" class="ff">Aplicación para móviles</a></li>
                    <? } ?> 
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 1 OR familia2 = 1 OR familia3 = 1 OR familia4 = 1) AND categoria = 9 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia']==1) && ($_GET['categoria']==9)) {?>
					<li><a href="/hooponopono-el-camino-mas-facil-kindle" class="selecionado">Kindle</a></li>
					<? } else { ?>
                    <li><a href="/hooponopono-el-camino-mas-facil-kindle" class="ff">Kindle</a></li>
					<? } ?> 
                    <? } ?>  
                    <li>
                    <a href="http://tienda.mabelkatz.com/paz-mundial-productos" target="_blank" class="ff">
                    Productos de Paz
                    </a>
                    </li>                      
                    <li>
                    <a href="javascript:void();" target="_blank" class="ff" id="kklo">
                    Viaje de Sanación y Limpieza
                    </a>
                    <ul style="display:block" id="submm" >
                        <li><a href="https://www.elcaminomasfacil.com/shasta-virtual-2018/" target="_blank" class="ff" style="background-color:rgb(168, 177, 167); color:#F00">Monte Shasta Virtual 2018</a></li>
	<li><a href="https://elcaminomasfacil.com/shasta-2018/" target="_blank" class="ff" style="background-color:rgb(168, 177, 167);">Monte Shasta 2018  </a></li>
	<li><a href="http://elcaminomasfacil.com/india2017/" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">India 2017</a></li>
    <li><a href="http://elcaminomasfacil.com/shasta/" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">Monte Shasta 2016 </a></li>
    <li><a href="http://elcaminomasfacil.com/magia" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">Teotihuacán 2016</a></li>
    <li><a href="http://elcaminomasfacil.com/hooponopono-viaje-de-sanacion-Limpieza-tulum.html" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">Tulum 2014</a></li>
    <li><a href="http://elcaminomasfacil.com/hooponopono-tour-peru-2013.html" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">Peru 2013</a></li>   
   <li><a href="http://elcaminomasfacil.com/hooponopono-tour-israel-2012.html" target="_blank" class="ff" style="background-color:rgb(168, 177, 167)">Israel 2013</a></li>
                    </ul>                   </li>

              </li>
             		
</ul>
</nav2>
<? 
mysql_select_db($database_cone, $cone);
$query_rsb = "SELECT * FROM banner WHERE idioma = '1' ORDER BY orden ASC";
$rsb = mysql_query($query_rsb, $cone) or die(mysql_error());
$row_rsb = mysql_fetch_assoc($rsb);
$totalRows_rsb = mysql_num_rows($rsb);
if ($totalRows_rsb<>0) {
	do {
	
?>
<a href="<? echo $row_rsb['link'];?>" target="<? echo $row_rsb['target'];?>" style="padding-top: 40px;float: left;margin-left: 3px;"><img src="http://store.mabelkatz.com/<?php echo substr ($row_rsb['banner'], 0, 250); ?>" border="0"></a>
<? 
	} while ($row_rsb = mysql_fetch_assoc($rsb));
} ?>

</div>


<div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
<?php
if ($_GET['categoria']<>''){
	$tt = $_GET['categoria'];
	mysql_select_db($database_cone, $cone);
	$query_rs_listado = "SELECT * FROM mabel_store_categoria WHERE id = '$tt'";
	$rs_listado = mysql_query($query_rs_listado, $cone) or die(mysql_error());
	$row_rs_listado = mysql_fetch_assoc($rs_listado);
	$totalRows_rs_listado = mysql_num_rows($rs_listado);	
	if ($_GET['categoria']==12) {
		echo '<span style="font-size: 15px;height: 20px;display: block;float: left;margin-top: 11px;color:#FF3709;">Está viendo &nbsp;<strong style="text-decoration: underline;">'.$row_rs_listado['rubro_es'].'</strong></span>';	
	} else {
	echo '<span style="font-size: 15px;height: 20px;display: block;float: left;margin-top: 11px;color:#FF3709;">Está viendo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="text-decoration: underline;">'.$row_rs_listado['rubro_es'].'</strong></span>';
	}
}
?>


<div class="cbp-vm-options">


<?

if ((isset($_GET['busca'])) || (isset($_GET['busca2'])) || (isset($_GET['busca3'])) || (isset($_GET['busca4'])) || (isset($_GET['busca5'])) || (isset($_GET['busca6'])) || (isset($_GET['busca7'])) || (isset($_GET['busca8']))) {
	/***/
		if (isset($_GET['busca'])) { $bug = $_GET['busca']; }
		if (isset($_GET['busca2'])) { $bug = $_GET['busca2']; }
		if (isset($_GET['busca3'])) { $bug = $_GET['busca3']; }
		if (isset($_GET['busca4'])) { $bug = $_GET['busca4']; }
		if (isset($_GET['busca5'])) { $bug = $_GET['busca5']; }
		if (isset($_GET['busca6'])) { $bug = $_GET['busca6']; }
		if (isset($_GET['busca7'])) { $bug = $_GET['busca7']; }
		if (isset($_GET['busca8'])) { $bug = $_GET['busca8']; }
		$bugb = $bug;
		
		
		$bug = str_replace("Ihaleakala", "Ihaleakal&aacute;", $bug);
		$bug = str_replace("ihaleakala", "Ihaleakal&aacute;", $bug);
		$bug = str_replace("hooponopono", "Ho''oponopono", $bug);
		$bug = str_replace("ho oponopono", "Ho''oponopono", $bug); 		
		
	$query_rs_total = "SELECT * FROM mabel_store_productos WHERE (titulo LIKE '%$bug%' OR descripcion LIKE '%$bug%') AND stock = '1' AND id<>95 AND id<>117 AND id<>118 AND  id<>96 AND id<>97 AND id<>242  AND id<>2433 $orf AND idioma = '1'";
	$rs_total = mysql_query($query_rs_total, $cone) or die(mysql_error());
	$row_rs_total = mysql_fetch_assoc($rs_total);
	$totalRows_rs_total = mysql_num_rows($rs_total);	
	/***/
	
	echo '<span style="font-size: 15px;height: 20px;display: block;float: left;margin-top: 11px;color:#FF3709;"> '.$totalRows_rs_total.' productos para "<strong>'.$bugb.'</strong>"</span>';
	}
?>
<table width="80" border="0" cellspacing="0" cellpadding="2" id="tabi">
  <tbody><tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td height="27" align="center" valign="top" background="/img/carro2.png" class="letra01"><? echo $totalpremio4s;?></td>
  </tr>
  <tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td align="center" class="letra02"><p><strong>Shopping Cart</strong><br>    
    <span class="letra03" onclick="location = elimina.php">(vaciar)</span></p></td>
  </tr>
</tbody></table>
<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Vista Grid</a>
<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">Vista Lista</a>
<span style="font-size: 15px;height: 20px;display: block;float: right;margin-top: 11px;color:#323233;" id="mmm03">Cambiar Vista</span>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px; cursor:pointer; color:#323233;" onMouseOver="MM_showHideLayers('smng','','show')" id="mmm02">Ordenar&nbsp;<img src="/img/fle.jpg" width="21" height="14">&nbsp;|&nbsp;&nbsp;
<div style="position: relative;float: right;top: 40px;right: 15px;">
  <div id="smng" style="position:absolute;width: 100px;z-index: 10; visibility:hidden;" onMouseOut="MM_showHideLayers('smng','','hide')" onMouseOver="MM_showHideLayers('smng','','show')"> 
<table width="100" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tr>
      <? if (!isset($_GET['categoria'])) { $_GET['categoria']=1;}?>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia=1&categoria=<? echo $_GET['categoria'];?>&orden=1'">Menor precio</p></td>
      </tr>
      <tr>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia=1&categoria=<? echo $_GET['categoria'];?>&orden=2'">Mayor precio</p></td>
      </tr>
    </table>
  </div></div><p></p>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px;color:#323233" id="mmm01">
Filtrar por<select name="categoria" class="txt" id="categoria" onchange="location = this.options[this.selectedIndex].value;">
  <option value="index.php" selected="selected" <?php if (!isset($_GET['categoria'])) {echo "selected=\"selected\"";} ?>>Seleccionar</option>
<option value="/ho-oponopono-libros" <?php if (($_GET['categoria']==1) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Libros</option>
<option value="/ho-oponopono-audios-digitales" <?php if (($_GET['categoria']==2) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audios Digitales</option>
<option value="/ho-oponopono-audios-libros" <?php if (($_GET['categoria']==3) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audio Libros</option>
<option value="/ho-oponopono-ebooks" <?php if (($_GET['categoria']==4) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>eBooks</option>
<option value="/ho-oponopono-videos-digitales" <?php if (($_GET['categoria']==5) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Videos Digitales</option>

<option value="/ho-oponopono-cd-dvd" <?php if (($_GET['categoria']==7) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>CDs &amp; DVDs</option>
<option value="/ho-oponopono-aplicacion-mobiles" <?php if (($_GET['categoria']==8) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Aplicación para móviles</option>
<option value="/ho-oponopono-kindle" <?php if (($_GET['categoria']==9) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Kindle</option>
<option value="/ho-oponopono-llamada-privada" <?php if (($_GET['categoria']==10) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Llamada Privada</option>
<option value="/ho-oponopono-productos-de-paz" <?php if (($_GET['categoria']==11) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Productos de Paz</option>
<option value="/ho-oponopono-teleclases" <?php if (($_GET['categoria']==6) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>TeleClases</option>
</select>
</p>

</div>
<ul <?php if ($_GET['categoria']==6 && $_GET['familia']==1 )  { ?> style="height: 570px;"<?php } ?>>
<? ///if (($_GET['categoria']<>8) && ($_GET['categoria']<>6) && ($_GET['categoria']<>9)) { ?>
<!--
<div>
  <img src="img/banner_nav2.png" name="bnav" width="900" height="153" id="bnav">
  <img src="img/banner_nav2.png" name="bnav2" width="335" height="121" id="bnav2">
  
</div>-->
  <? ///} ?>
<?
$ff = '';
$bb = '';
$bb2 = '';

$orf = "ORDER BY posicion ASC";
if ($_GET['orden'] == 1 ) { $orf = " ORDER BY precio ASC";} 
if ($_GET['orden'] == 2 ) { $orf = " ORDER BY precio DESC";} 


if ($_GET['familia']<>'') {
	$familia = $_GET['familia'];
	if ($_GET['categoria']<>'') {
		$categoria = $_GET['categoria'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	}	
} else {
	$familia = 1;
	if ($_GET['categoria']<>'') {
		$categoria = $_GET['categoria'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	}
}
	if (!isset($_GET['t'])) {
		$ff = "(familia = '$familia' OR familia2 = '$familia' OR familia3 = '$familia' OR familia4 = '$familia')";
	} else {
		$ff = "";
		$categoria = $_GET['categoria'];
		$bb = " categoria = '$categoria'";	
	}

	
	
	mysql_select_db($database_cone, $cone);
	if ((isset($_GET['busca'])) || (isset($_GET['busca2'])) || (isset($_GET['busca3'])) || (isset($_GET['busca4'])) || (isset($_GET['busca5'])) || (isset($_GET['busca6'])) || (isset($_GET['busca7'])) || (isset($_GET['busca8']))) {
		$band = 1 ;
		if (isset($_GET['busca'])) { $bug = $_GET['busca']; }
		if (isset($_GET['busca2'])) { $bug = $_GET['busca2']; }
		if (isset($_GET['busca3'])) { $bug = $_GET['busca3']; }
		if (isset($_GET['busca4'])) { $bug = $_GET['busca4']; }
		if (isset($_GET['busca5'])) { $bug = $_GET['busca5']; }
		if (isset($_GET['busca6'])) { $bug = $_GET['busca6']; }
		if (isset($_GET['busca7'])) { $bug = $_GET['busca7']; }
		if (isset($_GET['busca8'])) { $bug = $_GET['busca8']; }
		$bug = str_replace("Ihaleakala", "Ihaleakal&aacute;", $bug);
		$bug = str_replace("ihaleakala", "Ihaleakal&aacute;", $bug);
		$bug = str_replace("hooponopono", "Ho''oponopono", $bug);
		$bug = str_replace("ho oponopono", "Ho''oponopono", $bug); 			
		
		$query_rs_pr = "SELECT * FROM mabel_store_productos WHERE (titulo LIKE '%$bug%' OR descripcion LIKE '%$bug%') AND stock = '1' AND id<>95 AND id<>117 AND id<>118 AND  id<>96 AND id<>97 AND id<>242  AND id<>2433 AND idioma = '1' $orf";
		
			} else {
				
				
		$query_rs_pr = "SELECT * FROM mabel_store_productos WHERE $ff $bb AND stock = '1' AND id<>95 AND id<>117 AND id<>118 AND  id<>96 AND id<>97 AND id<>242  AND id<>2433 AND idioma = '1' $orf";
		//echo $query_rs_pr;
		

	}
	
	$rs_pr = mysql_query($query_rs_pr, $cone) or die(mysql_error());
	$row_rs_pr = mysql_fetch_assoc($rs_pr);
	$totalRows_rs_pr = mysql_num_rows($rs_pr);
	$orf = "";
	if ($totalRows_rs_pr<>0){
	do {
	$asolo = '';
?>
                        <li>
<a class="cbp-vm-image sm" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>"><img src="http://store.mabelkatz.com/admin/<?php echo substr ($row_rs_pr['imagen'], 0, 250); ?>" class="ancho_max_imagen"></a>
                    <?   
if ($row_rs_pr['categoriamuestra']=='') { 						
if ($row_rs_pr['categoria']==0) { $rubro=""; }							
if ($row_rs_pr['categoria']==1) { $rubro="Libro"; }
if ($row_rs_pr['categoria']==2) { $rubro="Audios Digitales"; }
if ($row_rs_pr['categoria']==3) { $rubro="Audio Libros"; }
if ($row_rs_pr['categoria']==4) { $rubro="eBook"; }
if ($row_rs_pr['categoria']==5) { $rubro="Videos Digitales"; }
if ($row_rs_pr['categoria']==6) { $rubro="Teleclases"; }
if ($row_rs_pr['categoria']==7) { 
if (($row_rs_pr['id']==157) || ($row_rs_pr['id']==158) || ($row_rs_pr['id']==159) || ($row_rs_pr['id']==160)) { 
		$rubro="DVDs";
} else { 
	$rubro="CD";
}
 }
if ($row_rs_pr['categoria']==8) { $rubro="Aplicación para móviles"; }
if ($row_rs_pr['categoria']==9) { $rubro="Kindle"; }
if ($row_rs_pr['categoria']==10) { $rubro="Llamada Privada"; }
} else {
$rubro=$row_rs_pr['categoriamuestra']; 
}
echo '<span style="font-size:13px; color:#000">'.$rubro.'</span>';
						?>                        
                        <h3 class="cbp-vm-title"><? echo strip_tags($row_rs_pr['titulo'],'<em><span><br>');?></h3>

                        <div class="cbp-vm-price" id='pre01'><? if ($row_rs_pr['precio2']<>0) {?>US $<span class="prev"><? $decimales = explode(".",$row_rs_pr['precio2']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio2']);
} else {
echo $row_rs_pr['precio2'];
}
?></span>
<? $asolo = "Ahora "; ?>
<? } ?>
<? if (($row_rs_pr['id']<>1242) && ($row_rs_pr['id']<>136) && ($row_rs_pr['id']<>137) && ($row_rs_pr['id']<>138) && ($row_rs_pr['id']<>139) && ($row_rs_pr['id']<>140)) {?>
<? echo $asolo; ?>US $<? $decimales = explode(".",$row_rs_pr['precio']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio']);
} else {
echo $row_rs_pr['precio'];
}
}
;?></div>
                        <div class="cbp-vm-details">
                        <? echo $row_rs_pr['descripcion'];?>
						  </div>
                            
<? if (($row_rs_pr['id']==136) || ($row_rs_pr['id']==137) || ($row_rs_pr['id']==138) || ($row_rs_pr['id']==139) || ($row_rs_pr['id']==140)) {?>                      
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="http://www.mabelkatz.com/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="http://www.mabelkatz.com/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="http://www.mabelkatz.com/source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<link rel="stylesheet" type="text/css" href="http://www.mabelkatz.com/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="http://www.mabelkatz.com/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<link rel="stylesheet" type="text/css" href="http://www.mabelkatz.com/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="http://www.mabelkatz.com/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="http://www.mabelkatz.com/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>  
    
    
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			

			$("#botongg").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					$(location).attr('href', 'http://www.amazon.com/Easiest-Way-problems-happiness-wealth-ebook/dp/B004ASORMK/ref=sr_1_7_title_1_kin?s=books&ie=UTF8&qid=1405938626&sr=1-7');	
					//url = '';
      				//window.open(url, '_blank');
						return;
					}					
				});
			});

			$("#boton2").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
						//$(location).attr('href', '');
						$(location).attr('href', 'http://www.amazon.com/Easiest-Way-Special-Dreams--Understanding-ebook/dp/B004JKMTAQ/ref=sr_1_2_title_1_kin?s=books&ie=UTF8&qid=1405938626&sr=1-2');
					//url = '';
      				//window.open(url, '_blank');						
						return;
					}					
				});
			});
			
			$("#boton3").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					$(location).attr('href', 'http://www.amazon.com/Resuelve-problemas-llevará-felicidad-riqueza-ebook/dp/B002EL3RR6/ref=la_B002JC0Z7U_1_13_title_0_main?s=books&ie=UTF8&qid=1405938163&sr=1-13');
						
					//url = '';
      				//window.open(url, '_blank');						
						return;
					}					
				});
			});			
						
			$("#boton4").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					$(location).attr('href', 'http://www.amazon.com/gp/redirect.html?ie=UTF8&location=http%3A//www.amazon.com/Caminho-Entender-Hooponopono-Portuguese-ebook/dp/B002TG4O1O?ie=UTF8&s=digital-text&qid=1260306408&sr=1-8&tag=hooponway-20&linkCode=ur2&camp=1789&creative=9325');
						
//					url = '';
  //    				window.open(url, '_blank');						
						return;
					}					
				});
			});	
			
			
			
			$("#boton5").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					url = 'http://www.amazon.com/gp/redirect.html?ie=UTF8&location=http%3A//www.amazon.com/Lättaste-problem-välstånd-Swedish-ebook/dp/B002EVQ6BK?ie=UTF8&s=digital-text&qid=1260306408&sr=1-7&tag=hooponway-20&linkCode=ur2&camp=1789&creative=9325';
      				
					$(location).attr('href', url);
					//window.open(url, '_blank');
						return;
					}					
				});
			});
			
			$("#boton6").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					url = 'http://www.amazon.com/gp/redirect.html?ie=UTF8&location=http%3A//www.amazon.com/Comment-résoudre-problèmes-richesse-ebook/dp/B002EQ9P5O?ie=UTF8&s=digital-text&qid=1260306408&sr=1-1&tag=hooponway-20&linkCode=ur2&camp=1789&creative=9325';
      				$(location).attr('href', url);
					//window.open(url, '_blank');
						return;
					}					
				});
			});		

			$("#boton7").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					url = 'http://www.amazon.com/gp/redirect.html?ie=UTF8&location=http%3A//www.amazon.com/Einfachste-Hooponopono-verständlichsten-gestellten-ebook/dp/B002TG4N60?ie=UTF8&s=digital-text&qid=1260306408&sr=1-9&tag=hooponway-20&linkCode=ur2&camp=1789&creative=9325';
      				$(location).attr('href', url);
					//window.open(url, '_blank');
						return;
					}					
				});
			});					

			$("#boton9").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					url = 'http://www.amazon.com/Easiest-Way-Live-Present-Forever-ebook/dp/B004JKMTBA/ref=sr_1_3_title_1_kin?s=books&ie=UTF8&qid=1405938626&sr=1-3';
      				$(location).attr('href', url);
					//window.open(url, '_blank');
						return;
					}					
				});
			});		
			
			$("#boton10").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					url = 'http://www.amazon.com/Understanding-Hooponopono-Clearest-Frequently-Questions-ebook/dp/B002R59EJO/ref=sr_1_15_title_0_main?s=books&ie=UTF8&qid=1405940794&sr=1-15';
      				$(location).attr('href', url);
					//window.open(url, '_blank');
						return;
					}					
				});
			});	
			
			$("#boton11").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					url = 'http://www.amazon.com/Camino-Fácil-Entender-Hooponopono-Spanish-ebook/dp/B004ASORJ8/ref=la_B002JC0Z7U_1_11_title_0_main/192-8288701-4747144?s=books&ie=UTF8&qid=1405937805&sr=1-11';
      				$(location).attr('href', url);
					//window.open(url, '_blank');
						return;
					}					
				});
			});	
			
			$("#boton12").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					url = 'http://www.amazon.com/gp/redirect.html?ie=UTF8&amp;location=http%3A//www.amazon.com/Caminho-Entender-Hooponopono-Portuguese-ebook/dp/B002TG4O1O?ie=UTF8&amp;s=digital-text&amp;qid=1260306408&amp;sr=1-8&amp;tag=hooponway-20&amp;linkCode=ur2&amp;camp=1789&amp;creative=9325';
      				$(location).attr('href', url);
					//window.open(url, '_blank');
						return;
					}					
				});
			});		
			
			$("#boton13").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					url = 'http://www.amazon.com/gp/redirect.html?ie=UTF8&amp;location=http%3A//www.amazon.com/Einfachste-Hooponopono-verständlichsten-gestellten-ebook/dp/B002TG4N60?ie=UTF8&amp;s=digital-text&amp;qid=1260306408&amp;sr=1-9&amp;tag=hooponway-20&amp;linkCode=ur2&amp;camp=1789&amp;creative=9325';
      				$(location).attr('href', url);
					//window.open(url, '_blank');
						return;
					}					
				});
			});
			
			$("#boton14").click(function() {
				$.fancybox.open({
					href : '/mensaje2.html',
					type : 'iframe',
					'width'				: 450,
					'height'			: 350,
					'autoScale'			: false,
					'showCloseButton'   : false,					
					padding : 0,
					afterClose : function() {
						//location.reload();
					url = 'http://www.amazon.com/Life-Changing-Books-Box-Set-Bestselling-ebook/dp/B00KQUGOF4/ref=sr_1_10_title_0_main?s=books&ie=UTF8&qid=1405938445&sr=1-10';
      				$(location).attr('href', url);
					//window.open(url, '_blank');
						return;
					}					
				});
			});							
			
			
							
		});


	</script>
                        
<? } ?>
                        
<? if ($row_rs_pr['buy']==1){?>
<? if (($row_rs_pr['id']<>1242) && ($row_rs_pr['id']<>136) && ($row_rs_pr['id']<>137) && ($row_rs_pr['id']<>138) && ($row_rs_pr['id']<>139) && ($row_rs_pr['id']<>140)) {?>
                            <? if ($row_rs_pr['id']==141) {?>
<a class="cbp-vm-icon cbp-vm-add" href="/141/1/8/borra-tus-problemas-con-ho-oponopono">Comprar</a>
                            <? } else { ?>
                            <? if ($row_rs_pr['id']==142) {?>
                            <a class="cbp-vm-icon cbp-vm-add" href="<? echo strip_tags($row_rs_pr['more']);?>" target="_blank">Registrate</a>    
                            <? } else { ?>
<a class="cbp-vm-icon cbp-vm-add" href="/ecommerce_derivar.php?vid=<? echo $row_rs_pr['id'];?>">Comprar</a>                            
                            <? } ?>
                            <? } ?>
<? }else { ?>
                            <? if ($row_rs_pr['id']==141) {?>
<a class="cbp-vm-icon cbp-vm-add" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">Comprar</a>
                            <? } else { ?>
<a class="cbp-vm-icon cbp-vm-add" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">Comprar</a>                            
                            <? } ?>
<? } ?>
<? } ?>
							<? if ($row_rs_pr['descripcionlarga']<>'') {?>
                            <? if ($row_rs_pr['id']==141) {?>
<a class="cbp-vm-icon cbp-vm-info" href="/141/1/8/borra-tus-problemas-con-ho-oponopono">Más información</a>
                            <? } else { ?>                            
                            <a class="cbp-vm-icon cbp-vm-info" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">Más información</a>
                            <? } ?>
							<? } ?>
							<? if ($row_rs_pr['more']<>'') {?>
                            <a class="cbp-vm-icon cbp-vm-info" href="<? echo strip_tags($row_rs_pr['more']);?>" target="_blank">Más información  </a>
							<? } ?>                            
						</li>
<?php }  while ($row_rs_pr = mysql_fetch_assoc($rs_pr));
	}?>
</ul>
<?php if ($_GET['categoria']==6 && $_GET['familia']==1 )  { ?>
<div id="me">
<strong>Lee lo que la gente está comentando sobre la teleclase de Mabel.</strong>


  
<blockquote>
  
  <p><img src="http://elcaminomasfacil.com/images/Romy Austria.jpg" width="200" height="234" style="float:left; margin-right:5px">Amado Foro, Primero no sab&iacute;a bien en que &aacute;rea del foro compartirles esto que me paso ayer en la Tele clase, pero creo que est&aacute; bien aqu&iacute;.  Les cuento que hace dos semanas me empec&eacute; a sentir cada d&iacute;a peor y termine con sinusitis aguda y torticolis muy dolorosa para Navidad. Yo limpio cada vez que me doy cuenta que no estoy limpiando y tambi&eacute;n ped&iacute; ayuda para limpiar esta memoria, la cosa segu&iacute;a de igual en peor pero bueno ya saben, no expectativas, todo es perfecto as&iacute; que a seguir limpiando.  Anoche durante la hermosa Tele clase de Mabel, obvio limpie en todo momento, y cuando me voy al foro a limpiar un poco antes de irme a dormir, quise poner otra vez mi pedido de ayuda, pero cuando termino de escribir el pedido antes de enviarlo me doy cuenta que la torticolis desapareci&oacute; y que no me dol&iacute;a nada en el cuello hombros ni espalda y que el dolor de cabeza y v&iacute;as nasales tan fuertes que ten&iacute;a tampoco los sent&iacute;a m&aacute;s &iexcl;no lo pod&iacute;a creer!  Pens&eacute; que era una alucinaci&oacute;n o que se yo, as&iacute; que igual envi&eacute; el pedido de ayuda, pero hoy sigo igual de bien y estoy segura que fue la limpieza de Mabel junto con la maravillosa limpieza de todos los presentes y el sagrado Foro por su puesto lo que borro esta memoria en m&iacute;.  &iexcl;&iexcl;&iexcl;Infinitas gracias!!!  Gracias gracias gracias.  Bendiciones,  </p>
      <p>&nbsp; </p>
      <p class="right"><strong>- Romy, Austria</strong></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
  </blockquote>
  <br>
  <a href="https://tienda.mabelkatz.com/programa-de-apoyo-hooponopono" target="blank" style="color: #FF3709;"><strong>Click AQUÍ para leer más testimonios... </strong></a>
</div>
<?php } ?>
<?php if ($_GET['categoria']==1 && $_GET['familia']==1 )  { ?>
<!--<div id="me">-->
<!--<strong>Lee lo que la gente está comentando sobre los libros de Mabel.</strong>-->
<!--<blockquote>-->
  
<!--  <p><img src="http://elcaminomasfacil.com/images/nacy.jpg" width="150" height="178" style="float:left; margin-right:5px">Aloha Mabel, gracias por tus regalos!!! Soy de Lima, Perú,  estuve buscando tus libros en las principales librerías y me decían que no los tenían, seguí en mi búsqueda y como también busco y escucho tus entrevistas en YouTube, escuché una entrevista que te hicieron en Lima  y me indicabas los teléfonos para conseguir tus libros. Llame y tu libro llegó en el momento correcto y perfecto. Pasaba por aprietos económicos y el único dinero que tenía sería para comprar tu libro... no sabes que feliz me hacía saber que los había encontrado! Pero allí no quedo todo, desde ese momento empezaron a ocurrir cosas increíbles...  me regalaron un dinero, me dieron una idea de negocio... pero no contaba con el dinero para llevarlo a cabo....y de pronto me llaman del banco y me aprueban un crédito!!! Gracias Gracias Gracias... cuando me llega un pensamiento de angustia o temor ante un problema digo Gracias Gracias Gracias y le pregunto al libro que hacer… y me  respondeeeee!!!....tiene vidaaaaaaaaa!!! Hoy salí a pasear con una amiga y me hablaba de sus problemas y yo decía: Gracias Gracias Gracias... como siempre llevo tu libro, le dije que tiene vida y que mentalmente le pregunte algo al libro, que lo abra donde quiera y el libro le respondería… sorprendida me dijo que le había contestado, hubieras visto su carita de desconcierto… Gracias Gracias Gracias. No menos importante es decirte que todo el tiempo digo Gracias Gracias Gracias en mi cabecita y cuando estoy sola o haciendo algo lo verbalizo. Sólo siento paz, tranquilidad y  me siento FELIZ… esto es INCREIBLEE!!! MARAVILLOSOOO!!! SI TODOS LO PRACTICARAMOS… SERIA EL PARAISOO!!! Querida Mabel gracias por existir, gracias por estar en este tiempo, gracias por haber llegado a mi vida, hasta muy pronto... en el momento correcto y perfecto.<br>-->
<!--    </p>-->
<!--      <p>&nbsp; </p>-->
<!--      <p class="right"><strong>- Nancy, Perú</strong></p>-->
<!--      <p>&nbsp;</p>-->
<!--      <p>&nbsp;</p>-->
<!--  </blockquote>-->
<!--</div>-->
<?php } ?>

</div>
</section>
<section id="section-2">
<div class="tabs2" id="tabsee3">
<nav2>

<ul>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 2 OR familia2 = 2 OR familia3 = 2 OR familia4 = 2) AND categoria = 1 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia2']==1) && ($_GET['categoria2']==1)) {?>
					<li><a href="index.php?familia2=2&categoria2=1" class="selecionado">Libros</a></li>
                    <? } else  { ?>
                    <li><a href="index.php?familia2=2&categoria2=1" class="ff">Libros</a></li>
                    <? } ?>
					<? } ?>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 2 OR familia2 = 2 OR familia3 = 2 OR familia4 = 2) AND categoria = 12 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia2']==1) && ($_GET['categoria2']==12)) {?>
					<li><a href="/zero-frequency-teleclases" class="selecionado">TeleClases</a></li>
					<? } else  { ?>
					<li><a href="/zero-frequency-teleclases" class="ff">TeleClases</a></li>
                    <? } ?>                    
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 2 OR familia2 = 2 OR familia3 = 2 OR familia4 = 2) AND categoria = 2 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if ((($_GET['familia2']==2) && ($_GET['categoria2']==2)) || ($linkcontrol2==1)) {?>
					<li><a href="/zero-frequency-audios-digitales" class="selecionado">Audios Digitales</a></li>
					<? } else  { ?>
					<li><a href="/zero-frequency-audios-digitales" class="ff">Audios Digitales</a></li>
                    <? } ?>                    
					<? } ?>                    
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 2 OR familia2 = 2 OR familia3 = 2 OR familia4 = 2) AND categoria = 3 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia2']==1) && ($_GET['categoria2']==3)) {?>
					<li><a href="index.php?familia2=2&categoria2=3" class="selecionado">Audio Libros</a></li>
					<? } else  { ?>
					<li><a href="index.php?familia2=2&categoria2=3" class="ff">Audio Libros</a></li>
					<? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 2 OR familia2 = 2 OR familia3 = 2 OR familia4 = 2) AND categoria = 4 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia2']==1) && ($_GET['categoria2']==4)) {?>
					<li><a href="index.php?familia2=2&categoria2=4" class="selecionado">eBooks</a></li>
					<? } else  { ?>
					<li><a href="index.php?familia2=2&categoria2=4" class="ff">eBooks</a></li>
                    <? } ?>                       
					<? } ?>                       
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 2 OR familia2 = 2 OR familia3 = 2 OR familia4 = 2) AND categoria = 5 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia2']==1) && ($_GET['categoria2']==5)) {?>
					<li><a href="index.php?familia2=2&categoria2=5" class="selecionado">Videos Digitales</a></li>
                    <? } else  { ?>
					<li><a href="index.php?familia2=2&categoria2=5" class="ff">Videos Digitales</a></li>
					<? } ?>
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 2 OR familia2 = 2 OR familia3 = 2 OR familia4 = 2) AND categoria = 6 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia2']==1) && ($_GET['categoria2']==6)) {?>
					<li><a href="index.php?familia2=2&categoria2=6" class="selecionado">TeleClases</a></li>
					<? } else  { ?>
					<li><a href="index.php?familia2=2&categoria2=6" class="ff">TeleClases</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 2 OR familia2 = 2 OR familia3 = 2 OR familia4 = 2) AND categoria = 7 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia2']==1) && ($_GET['categoria2']==7)) {?>
					<li><a href="index.php?familia2=2&categoria2=7" class="selecionado"><br>
					CDs &amp; DVDs </a></li>
					<? } else  { ?>
					<li><a href="index.php?familia2=2&categoria2=7" class="ff">CDs & DVDs</a></li>
					<? } ?> 
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 2 OR familia2 = 2 OR familia3 = 2 OR familia4 = 2) AND categoria = 8 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia2']==1) && ($_GET['categoria2']==8)) {?>
					<li><a href="index.php?familia2=2&categoria2=8" class="selecionado">Aplicación para móviles</a></li>
					<? } else  { ?>
					<li><a href="index.php?familia2=2&categoria2=8" class="ff">Aplicación para móviles</a></li>
					<? } ?> 
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 2 OR familia2 = 2 OR familia3 = 2 OR familia4 = 2) AND categoria = 9 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia2']==1) && ($_GET['categoria2']==9)) {?>
					<li><a href="index.php?familia2=2&categoria2=9" class="selecionado">Kindle</a></li>
					<? } else  { ?>
					<li><a href="index.php?familia2=2&categoria2=9" class="ff">Kindle</a></li>
					<? } ?> 
					<? } ?> 
					<li><a href="/142/1/6/teleclase-mensual-abril-2019" class="ff">TeleClases</a></li>
</ul> 
</nav2> 
<? 
mysql_select_db($database_cone, $cone);
$query_rsb = "SELECT * FROM banner WHERE idioma = '1' ORDER BY orden ASC";
$rsb = mysql_query($query_rsb, $cone) or die(mysql_error());
$row_rsb = mysql_fetch_assoc($rsb);
$totalRows_rsb = mysql_num_rows($rsb);
$i=1;
if ($totalRows_rsb<>0) {
	do {
	
?>
<a href="<? echo $row_rsb['link'];?>" target="<? echo $row_rsb['target'];?>"><img src="http://store.mabelkatz.com/<?php echo substr ($row_rsb['banner'], 0, 250); ?>" border="0" <? if ($i==1) { echo  "style=\"padding-top: 140px;margin-left: 3px;\""; $i++;}?>></a>
<? 
	} while ($row_rsb = mysql_fetch_assoc($rsb));
} ?>
</div>
					<div id="cbp-vm22" class="cbp-vm-switcher cbp-vm-view-grid">
					<div class="cbp-vm-options">
<?
if (isset($_GET['categoria2'])){
	$tt = $_GET['categoria2'];
} else {
	$tt = 2;	
}
	
	mysql_select_db($database_cone, $cone);
	$query_rs_listado = "SELECT * FROM mabel_store_categoria WHERE id = '$tt'";
	$rs_listado = mysql_query($query_rs_listado, $cone) or die(mysql_error());
	$row_rs_listado = mysql_fetch_assoc($rs_listado);
	$totalRows_rs_listado = mysql_num_rows($rs_listado);	
	echo '<span style="font-size: 15px;height: 20px;display: block;float: left;margin-top: 11px;color:#FF3709;">Está viendo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="text-decoration: underline;">'.$row_rs_listado['rubro_es'].'</strong></span>';

?>        
<table width="80" border="0" cellspacing="0" cellpadding="2" id="tabi">
  <tbody><tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td height="27" align="center" valign="top" background="/img/carro2.png" class="letra01"><? echo $totalpremio4s;?></td>
  </tr>
  <tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td align="center" class="letra02"><p><strong>Shopping Cart</strong><br>    
    <span class="letra03" onclick="location = elimina.php">(vaciar)</span></p></td>
  </tr>
</tbody></table>
<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Vista Grid</a>
<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">Vista Lista</a>
<span style="font-size: 15px;height: 20px;display: block;float: right;margin-top: 11px;color:#323233;" id="mmm03">Cambiar Vista</span>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px; cursor:pointer; color:#323233;" onMouseOver="MM_showHideLayers('smng2','','show')" >Ordenar&nbsp;<img src="/img/fle.jpg" width="21" height="14">&nbsp;|&nbsp;&nbsp;
<div style="position: relative;float: right;top: 40px;right: 15px;">
  <div id="smng2" style="position:absolute;width: 100px;z-index: 10; visibility:hidden;" onMouseOut="MM_showHideLayers('smng2','','hide')" onMouseOver="MM_showHideLayers('smng2','','show')"> 
<table width="100" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tr>
      <? if (!isset($_GET['categoria2'])) { $_GET['categoria2']=2;}?>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia2=2&categoria2=<? echo $_GET['categoria2'];?>&orden=1'">Menor precio</p></td>
      </tr>
      <tr>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia2=2&categoria2=<? echo $_GET['categoria2'];?>&orden=2'">Mayor precio</p></td>
      </tr>
    </table>
  </div></div><p></p> 
  <p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px;color:#323233" id="mmm01">
Filtrar por<select name="categoria" class="txt" id="categoria" onchange="location = this.options[this.selectedIndex].value;">
  <option value="index.php" selected="selected" <?php if (!isset($_GET['categoria'])) {echo "selected=\"selected\"";} ?>>Seleccionar</option>
<option value="/ho-oponopono-libros" <?php if (($_GET['categoria']==1) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Libros</option>
<option value="/ho-oponopono-audios-digitales" <?php if (($_GET['categoria']==2) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audios Digitales</option>
<option value="/ho-oponopono-audios-libros" <?php if (($_GET['categoria']==3) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audio Libros</option>
<option value="/ho-oponopono-ebooks" <?php if (($_GET['categoria']==4) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>eBooks</option>
<option value="/ho-oponopono-videos-digitales" <?php if (($_GET['categoria']==5) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Videos Digitales</option>

<option value="/ho-oponopono-cd-dvd" <?php if (($_GET['categoria']==7) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>CDs &amp; DVDs</option>
<option value="/ho-oponopono-aplicacion-mobiles" <?php if (($_GET['categoria']==8) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Aplicación para móviles</option>
<option value="/ho-oponopono-kindle" <?php if (($_GET['categoria']==9) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Kindle</option>
<option value="/ho-oponopono-llamada-privada" <?php if (($_GET['categoria']==10) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Llamada Privada</option>
<option value="/ho-oponopono-productos-de-paz" <?php if (($_GET['categoria']==11) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Productos de Paz</option>
<option value="/ho-oponopono-teleclases" <?php if (($_GET['categoria']==6) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>TeleClases</option>
</select>
</p>                       
                    </div><!--
<div>
  <img src="img/banner_nav2.png" name="bnav" width="900" height="153" id="bnav">
  <img src="img/banner_nav2.png" name="bnav2" width="335" height="121" id="bnav2">
  
  </div>               -->      
					<ul>
<?
$ff = '';
$bb = '';
$bb2 = '';

$orf = "ORDER BY posicion ASC";
if ($_GET['orden'] == 1 ) { $orf = " ORDER BY precio ASC";} 
if ($_GET['orden'] == 2 ) { $orf = " ORDER BY precio DESC";} 

if ($_GET['familia2']<>'') {
	$familia = $_GET['familia2'];
	
	if ($_GET['categoria2']<>'') {
		$categoria = $_GET['categoria2'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	}	
} else {
	$familia = 2;
	if ($_GET['categoria2']<>'') {
		$categoria = $_GET['categoria2'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	} else {
		if ($linkcontrol2==1) {
		$categoria = 2;
		$bb = "AND categoria = '$categoria'";
		$bb2 = $categoria;		
		}
	}
}
$ff = "(familia = '$familia' OR familia2 = '$familia' OR familia3 = '$familia' OR familia4 = '$familia')";
	mysql_select_db($database_cone, $cone);
	$query_rs_pr = "SELECT * FROM mabel_store_productos WHERE $ff $bb AND stock = '1' AND idioma = '1' $orf";
	$rs_pr = mysql_query($query_rs_pr, $cone) or die(mysql_error());
	$row_rs_pr = mysql_fetch_assoc($rs_pr);
	$totalRows_rs_pr = mysql_num_rows($rs_pr);
	if ($totalRows_rs_pr<>0){
	do {
		$asolo = '';
?>
                        <li>
                        <a class="cbp-vm-image sm" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>"><img src="http://store.mabelkatz.com/admin/<?php echo substr ($row_rs_pr['imagen'], 0, 250); ?>" class="ancho_max_imagen"></a>
                                                <? 
if ($row_rs_pr['categoriamuestra']=='') { 												
if ($row_rs_pr['categoria']==0) { $rubro=""; }													
if ($row_rs_pr['categoria']==1) { $rubro="Libro"; }
if ($row_rs_pr['categoria']==2) { $rubro="Audios Digitales"; }
if ($row_rs_pr['categoria']==3) { $rubro="Audio Libros"; }
if ($row_rs_pr['categoria']==4) { $rubro="eBook"; }
if ($row_rs_pr['categoria']==5) { $rubro="Videos Digitales"; }
if ($row_rs_pr['categoria']==6) { $rubro="Teleclases"; }
if ($row_rs_pr['categoria']==7) { $rubro="CD"; }
if ($row_rs_pr['categoria']==8) { $rubro="Aplicación para móviles"; }
if ($row_rs_pr['categoria']==9) { $rubro="Kindle"; }
if ($row_rs_pr['categoria']==10) { $rubro="Llamada Privada"; }
} else {
$rubro=$row_rs_pr['categoriamuestra']; 
}
echo '<span style="font-size:13px; color:#000">'.$rubro.'</span>';
						?> 
                        <h3 class="cbp-vm-title"><? echo strip_tags($row_rs_pr['titulo'],'<em><br>');?></h3>
                        <div class="cbp-vm-price" id='llk'><? if ($row_rs_pr['precio2']<>0) {?>US $<span class="prev"><? $decimales = explode(".",$row_rs_pr['precio2']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio2']);
} else {
echo $row_rs_pr['precio2'];
}
?></span>
<? $asolo = "Ahora "; ?>
<? } ?> <? echo $asolo; ?>US $<? $decimales = explode(".",$row_rs_pr['precio']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio']);
} else {
echo $row_rs_pr['precio'];
}
;?></div>
                        <div class="cbp-vm-details">
                        <? echo $row_rs_pr['descripcion'];?>
							</div>
							<? if ($row_rs_pr['buy']==1){?>
<a class="cbp-vm-icon cbp-vm-add" href="ecommerce_derivar.php?vid=<? echo $row_rs_pr['id'];?>">Comprar</a>
<? } ?><? if ($row_rs_pr['descripcionlarga']<>'') {?><a class="cbp-vm-icon cbp-vm-info" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">Más información  </a><? } ?>
							<? if ($row_rs_pr['more']<>'') {?>
                            <a class="cbp-vm-icon cbp-vm-info" href="<? echo strip_tags($row_rs_pr['more']);?>" target="_blank">Más información  </a>
							<? } ?>                                   
						</li>
<? }  while ($row_rs_pr = mysql_fetch_assoc($rs_pr));
	}?>
						
					</ul>
				</div>
					</section>
<section id="section-3">
<div class="tabs2" id="tabsee4">
<nav2>

<ul>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 3 OR familia2 = 3 OR familia3 = 3 OR familia4 = 3) AND categoria = 11 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia3']==3) && ($_GET['categoria3']==11)  || ($linkcontrol3==1)) {?>
					<li><a href="/paz-mundial-productos" class="selecionado">Productos de Paz</a></li>
					<? } else { ?>
					<li><a href="/paz-mundial-productos" class="ff">Productos de Paz</a></li>
                    <? } ?> 
					<? } ?>  
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 3 OR familia2 = 3 OR familia3 = 3 OR familia4 = 3) AND categoria = 1 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia3']==3) && ($_GET['categoria3']==1)) {?>
					<li><a href="index.php?familia3=3&categoria3=1" class="selecionado">Libros</a></li>
					<? } else { ?>
                    <li><a href="index.php?familia3=3&categoria3=1" class="ff">Libros</a></li>
                    <? } ?>
					
					<? } ?>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 3 OR familia2 = 3 OR familia3 = 3 OR familia4 = 3) AND categoria = 12 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia3']==3) && ($_GET['categoria3']==12)) {?>
					<li><a href="index.php?familia3=3&categoria3=12" class="selecionado">TeleClases</a></li>
					<? } else { ?>
					<li><a href="index.php?familia3=3&categoria3=12" class="ff">TeleClases</a></li>
                    <? } ?>                    
					<? } ?>  
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 3 OR familia2 = 3 OR familia3 = 3 OR familia4 = 3) AND categoria = 2 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia3']==3) && ($_GET['categoria3']==2)) {?>
					<li><a href="/paz-mundial-audios-digitales" class="selecionado">Audios Digitales</a></li>
					<? } else { ?>
					<li><a href="/paz-mundial-audios-digitales" class="ff">Audios Digitales</a></li>
                    <? } ?>                    
					<? } ?>                    
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 3 OR familia2 = 3 OR familia3 = 3 OR familia4 = 3) AND categoria = 3 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia3']==3) && ($_GET['categoria3']==3)) {?>
					<li><a href="index.php?familia3=3&categoria3=3" class="selecionado">Audio Libros</a></li>
					<? } else { ?>
					<li><a href="index.php?familia3=3&categoria3=3" class="ff">Audio Libros</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 3 OR familia2 = 3 OR familia3 = 3 OR familia4 = 3) AND categoria = 4 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia3']==3) && ($_GET['categoria3']==4)) {?>
					<li><a href="index.php?familia3=3&categoria3=4" class="selecionado">eBooks</a></li>
					<? } else { ?>
					<li><a href="index.php?familia3=3&categoria3=4" class="ff">eBooks</a></li>
					<? } ?>                       
					<? } ?>                       
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 3 OR familia2 = 3 OR familia3 = 3 OR familia4 = 3) AND categoria = 5 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia3']==3) && ($_GET['categoria3']==5)) {?>
					<li><a href="index.php?familia3=3&categoria3=5" class="selecionado">Videos Digitales</a></li>
					<? } else { ?>
					<li><a href="index.php?familia3=3&categoria3=5" class="ff">Videos Digitales</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 3 OR familia2 = 3 OR familia3 = 3 OR familia4 = 3) AND categoria = 6 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia3']==3) && ($_GET['categoria3']==6)) {?>
					<li><a href="index.php?familia3=3&categoria3=6" class="selecionado">TeleClases</a></li>
					<? } else { ?>
					<li><a href="index.php?familia3=3&categoria3=6" class="ff">TeleClases</a></li>
					<? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 3 OR familia2 = 3 OR familia3 = 3 OR familia4 = 3) AND categoria = 7 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia3']==3) && ($_GET['categoria3']==7)) {?>
					<li><a href="index.php?familia3=3&categoria3=7" class="selecionado">CDs & DVDs</a></li>
					<? } else { ?>
					<li><a href="index.php?familia3=3&categoria3=7" class="ff">CDs & DVDs</a></li>
					<? } ?> 
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 3 OR familia2 = 3 OR familia3 = 3 OR familia4 = 3) AND categoria = 8 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia3']==3) && ($_GET['categoria3']==8)) {?>
					<li><a href="index.php?familia3=3&categoria3=8" class="selecionado">Aplicación para móviles</a></li>
					<? } else { ?>
					<li><a href="index.php?familia3=3&categoria3=8" class="ff">Aplicación para móviles</a></li>
                    <? } ?> 
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 3 OR familia2 = 3 OR familia3 = 3 OR familia4 = 3) AND categoria = 9 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia3']==3) && ($_GET['categoria3']==9)) {?>
					<li><a href="index.php?familia3=3&categoria3=9" class="selecionado">Kindle</a></li>
					<? } else { ?>
					<li><a href="index.php?familia3=3&categoria3=9" class="ff">Kindle</a></li>
                    <? } ?> 
					<? } ?> 
					<li><a href="/142/1/6/teleclase-mensual-abril-2019" class="ff">TeleClases</a></li>
</ul>  
		    <nav2>
	      </div>
					<div id="cbp-vm2" class="cbp-vm-switcher cbp-vm-view-grid">
					<div class="cbp-vm-options">
<?
if (isset($_GET['categoria3'])){
	$tt = $_GET['categoria3'];
} else {
	$tt = 11;	
}
	//$tt = $_GET['categoria3'];
	mysql_select_db($database_cone, $cone);
	$query_rs_listado = "SELECT * FROM mabel_store_categoria WHERE id = '$tt'";
	$rs_listado = mysql_query($query_rs_listado, $cone) or die(mysql_error());
	$row_rs_listado = mysql_fetch_assoc($rs_listado);
	$totalRows_rs_listado = mysql_num_rows($rs_listado);	
	echo '<span style="font-size: 15px;height: 20px;display: block;float: left;margin-top: 11px;color:#FF3709;">Está viendo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="text-decoration: underline;">'.$row_rs_listado['rubro_es'].'</strong></span>';

?>                
<table width="80" border="0" cellspacing="0" cellpadding="2" id="tabi">
  <tbody><tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td height="27" align="center" valign="top" background="/img/carro2.png" class="letra01"><? echo $totalpremio4s;?></td>
  </tr>
  <tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td align="center" class="letra02"><p><strong>Shopping Cart</strong><br>    
    <span class="letra03" onclick="location = elimina.php">(vaciar)</span></p></td>
  </tr>
</tbody></table>
<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Vista Grid</a>
<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">Vista Lista</a>
<span style="font-size: 15px;height: 20px;display: block;float: right;margin-top: 11px;color:#323233;" id="mmm03">Cambiar Vista</span>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px; cursor:pointer; color:#323233;" onMouseOver="MM_showHideLayers('smng3','','show')" id="mmm02">Ordenar&nbsp;<img src="/img/fle.jpg" width="21" height="14">&nbsp;|&nbsp;&nbsp;
<div style="position: relative;float: right;top: 40px;right: 15px;">
  <div id="smng3" style="position:absolute;width: 100px;z-index: 10; visibility:hidden;" onMouseOut="MM_showHideLayers('smng3','','hide')" onMouseOver="MM_showHideLayers('smng3','','show')"> 
<table width="100" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tr>
      <? if (!isset($_GET['categoria3'])) { $_GET['categoria3']=11;}?>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia3=3&categoria3=<? echo $_GET['categoria3'];?>&orden=1'">Menor precio</p></td>
      </tr>
      <tr>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia3=3&categoria3=<? echo $_GET['categoria3'];?>&orden=2'">Mayor precio</p></td>
      </tr>
    </table>
  </div></div><p></p>                        
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px;color:#323233" id="mmm01">
Filtrar por<select name="categoria" class="txt" id="categoria" onchange="location = this.options[this.selectedIndex].value;">
  <option value="index.php" selected="selected" <?php if (!isset($_GET['categoria'])) {echo "selected=\"selected\"";} ?>>Seleccionar</option>
<option value="/ho-oponopono-libros" <?php if (($_GET['categoria']==1) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Libros</option>
<option value="/ho-oponopono-audios-digitales" <?php if (($_GET['categoria']==2) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audios Digitales</option>
<option value="/ho-oponopono-audios-libros" <?php if (($_GET['categoria']==3) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audio Libros</option>
<option value="/ho-oponopono-ebooks" <?php if (($_GET['categoria']==4) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>eBooks</option>
<option value="/ho-oponopono-videos-digitales" <?php if (($_GET['categoria']==5) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Videos Digitales</option>

<option value="/ho-oponopono-cd-dvd" <?php if (($_GET['categoria']==7) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>CDs &amp; DVDs</option>
<option value="/ho-oponopono-aplicacion-mobiles" <?php if (($_GET['categoria']==8) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Aplicación para móviles</option>
<option value="/ho-oponopono-kindle" <?php if (($_GET['categoria']==9) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Kindle</option>
<option value="/ho-oponopono-llamada-privada" <?php if (($_GET['categoria']==10) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Llamada Privada</option>
<option value="/ho-oponopono-productos-de-paz" <?php if (($_GET['categoria']==11) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Productos de Paz</option>
<option value="/ho-oponopono-teleclases" <?php if (($_GET['categoria']==6) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>TeleClases</option>
</select>
</p>
</div>
<!--
<div>
  <img src="img/banner_nav2.png" name="bnav" width="900" height="153" id="bnav">
  <img src="img/banner_nav2.png" name="bnav2" width="335" height="121" id="bnav2">
  
  </div>-->
<div style=" clear:right; margin-top:20px; margin-left:20px;" id="tel">
  <div><img src="/img/mabek_katz.png" width="138" height="210" align="left" style="margin-left: 10px;"/><strong style="font-size: 14px;color: #000;font-family: 'Lato', Calibri, Arial, sans-serif;color: #47a3da;  font-size: 1em;
  height: 40px;">
Difundamos juntos la Conciencia y la Paz alrededor del Mundo</strong><br />
  </div><br>
  <div style="text-align: justify !important;font-size: 16px;color: #000;font-family: sans-serif; line-height:20px">Si adoptamos la Filosofía de la Paz Conciente y el Símbolo de la Flor de Lis, podemos inspirar a otros a unirse a nosotros en este movimiento de paz mundial. Demos el ejemplo tomando responsabilidad por nuestros pensamientos y nuestras acciones. Por favor, ¡comparte la herramienta de la Flor de Lis con el Mundo!.<br>
    <br>
    <em>¿Te gustaría soltar el estado de guerra constante de tu mente y liberarte de las ideas, lugares, situaciones y creencias que te traban?</em> Puedes mentalmente repetir “Pongo la Flor de Lis en la situación” y ayudarte con estos productos que te ayudan a hacer la limpieza las 24 horas y a estar más presente consciente y en paz.<br>
  </div>
</div>

<br>
<br>
					<ul>
<?

$ff = '';
$bb = '';
$bb2 = '';

$orf = "ORDER BY posicion ASC";
if ($_GET['orden'] == 1 ) { $orf = " ORDER BY precio ASC";} 
if ($_GET['orden'] == 2 ) { $orf = " ORDER BY precio DESC";} 

if ($_GET['familia3']<>'') {
	$familia = $_GET['familia3'];
	if ($_GET['categoria3']<>'') {
		$categoria = $_GET['categoria3'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	}	
} else {
	$familia = 3;
	if ($_GET['categoria3']<>'') {
		$categoria = $_GET['categoria3'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	} else {
		if ($linkcontrol3==1)	{
			$categoria = 11;
			$bb = "AND categoria = '$categoria'";
			$bb2 = $categoria;		
		}
	}
}

	$ff = "(familia = '$familia' OR familia2 = '$familia' OR familia3 = '$familia' OR familia4 = '$familia')";
	mysql_select_db($database_cone, $cone);
	$query_rs_pr = "SELECT * FROM mabel_store_productos WHERE $ff $bb AND stock = '1'  AND idioma = '1' $orf";
	$rs_pr = mysql_query($query_rs_pr, $cone) or die(mysql_error());
	$row_rs_pr = mysql_fetch_assoc($rs_pr);
	$totalRows_rs_pr = mysql_num_rows($rs_pr);
	if ($totalRows_rs_pr<>0){
	do {
		$asolo = '';
?>
     <li style="min-height: 330px;">
     <div style=" display:block; height:150px">
                        <a class="cbp-vm-image sm" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>"><img src="http://store.mabelkatz.com/admin/<?php echo substr ($row_rs_pr['imagen'], 0, 250); ?>" class="ancho_max_imagen"></a></div>
                                                <? 
if ($row_rs_pr['categoriamuestra']=='') { 												
if ($row_rs_pr['categoria']==0) { $rubro=""; }												
if ($row_rs_pr['categoria']==1) { $rubro="Libro"; }
if ($row_rs_pr['categoria']==2) { $rubro="Audios Digitales"; }
if ($row_rs_pr['categoria']==3) { $rubro="Audio Libros"; }
if ($row_rs_pr['categoria']==4) { $rubro="eBook"; }
if ($row_rs_pr['categoria']==5) { $rubro="Videos Digitales"; }
if ($row_rs_pr['categoria']==6) { $rubro="Teleclases"; }
if ($row_rs_pr['categoria']==7) { $rubro="CD"; }
if ($row_rs_pr['categoria']==8) { $rubro="Aplicación para móviles"; }
if ($row_rs_pr['categoria']==9) { $rubro="Kindle"; }
if ($row_rs_pr['categoria']==10) { $rubro="Llamada Privada"; }
if ($row_rs_pr['categoria']==11) { $rubro="Productos de Paz"; }
} else {
$rubro=$row_rs_pr['categoriamuestra']; 
}
echo '<span style="font-size:13px; color:#000">'.$rubro.'</span>';
						?> 
                        <h3 class="cbp-vm-title" style="  height: 10px;"><? echo strip_tags($row_rs_pr['titulo'],'<em><br>');?></h3>
                        <div class="cbp-vm-price" id='llk'><? if ($row_rs_pr['precio2']<>0) {?>US $<span class="prev"><? $decimales = explode(".",$row_rs_pr['precio2']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio2']);
} else {
echo $row_rs_pr['precio2'];
}
?></span><? $asolo = "Ahora "; ?><? } ?> <? echo $asolo; ?>US $<? $decimales = explode(".",$row_rs_pr['precio']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio']);
} else {
echo $row_rs_pr['precio'];
}
;?></div>
                        <div class="cbp-vm-details" style="height: 40px;">
                        <? echo $row_rs_pr['descripcion'];?>
							</div>
							<? if ($row_rs_pr['buy']==1){?>
<a class="cbp-vm-icon cbp-vm-add" href="ecommerce_derivar.php?vid=<? echo $row_rs_pr['id'];?>">Comprar</a>
<? } ?><? if ($row_rs_pr['descripcionlarga']<>'') {?><a class="cbp-vm-icon cbp-vm-info" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">Más información  </a><? } ?>
                            							<? if ($row_rs_pr['more']<>'') {?>
                            <a class="cbp-vm-icon cbp-vm-info" href="<? echo strip_tags($row_rs_pr['more']);?>" target="_blank">Más información  </a>
							<? } ?>       
						</li>
<? }  while ($row_rs_pr = mysql_fetch_assoc($rs_pr));
	}?>
						
					</ul>
				</div>
					</section>
<section id="section-4">
<div class="tabs2" id="tabsee5">
<nav2>
<ul>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 4 OR familia2 = 4 OR familia3 = 4 OR familia4 = 4) AND categoria = 1 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia4']==4) && ($_GET['categoria4']==1) || ($linkcontrol4==1)) {?>
					<li><a href="/chicos-libros-el-camino-mas-facil-para-crecer" class="selecionado">Libros</a></li>
                    <? } else { ?>
                    <li><a href="/chicos-libros-el-camino-mas-facil-para-crecer" class="ff">Libros</a></li>
                    <? } ?>
					<? } ?>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 4 OR familia2 = 4 OR familia3 = 4 OR familia4 = 4) AND categoria = 12 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia4']==4) && ($_GET['categoria4']==12)) {?>
					<li><a href="index.php?familia4=4&categoria4=12" class="selecionado">TeleClases</a></li>
					<? } else { ?>
					<li><a href="index.php?familia4=4&categoria4=12" class="ff">TeleClases</a></li>
					<? } ?>                    
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 4 OR familia2 = 4 OR familia3 = 4 OR familia4 = 4) AND categoria = 2 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia4']==4) && ($_GET['categoria4']==2)) {?>
					<li><a href="/chicos-audios-digitales-el-camino-mas-facil-para-crecer" class="selecionado">Audios Digitales</a></li>
					<? } else { ?>
					<li><a href="/chicos-audios-digitales-el-camino-mas-facil-para-crecer" class="ff">Audios Digitales</a></li>
					<? } ?>                    
					<? } ?>                    
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 4 OR familia2 = 4 OR familia3 = 4 OR familia4 = 4) AND categoria = 3 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia4']==4) && ($_GET['categoria4']==3)) {?>
					<li><a href="/chicos-audio-libros-el-camino-mas-facil-para-crecer" class="selecionado">Audio Libros</a></li>
					<? } else { ?>
					<li><a href="/chicos-audio-libros-el-camino-mas-facil-para-crecer" class="ff">Audio Libros</a></li>
					<? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 4 OR familia2 = 4 OR familia3 = 4 OR familia4 = 4) AND categoria = 4 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia4']==4) && ($_GET['categoria4']==4)) {?>
					<li><a href="index.php?familia4=4&categoria4=4" class="selecionado">eBooks</a></li>
					<? } else { ?>
					<li><a href="index.php?familia4=4&categoria4=4" class="ff">eBooks</a></li>
                    <? } ?>                       
					<? } ?>                       
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 4 OR familia2 = 4 OR familia3 = 4 OR familia4 = 4) AND categoria = 5 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia4']==4) && ($_GET['categoria4']==5)) {?>
					<li><a href="/chicos-videos-digitales-el-camino-mas-facil-para-crecer" class="selecionado">Videos Digitales</a></li>
					<? } else { ?>
					<li><a href="/chicos-videos-digitales-el-camino-mas-facil-para-crecer" class="ff">Videos Digitales</a></li>
					<? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 4 OR familia2 = 4 OR familia3 = 4 OR familia4 = 4) AND categoria = 6 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia4']==4) && ($_GET['categoria4']==6)) {?>
					<li><a href="index.php?familia4=4&categoria4=6" class="selecionado">TeleClases</a></li>
					<? } else { ?>
					<li><a href="index.php?familia4=4&categoria4=6" class="ff">TeleClases</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 4 OR familia2 = 4 OR familia3 = 4 OR familia4 = 4) AND categoria = 7 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia4']==4) && ($_GET['categoria4']==7)) {?>
					<li><a href="index.php?familia4=4&categoria4=7" class="selecionado">CDs & DVDs</a></li>
					<? } else { ?>
					<li><a href="index.php?familia4=4&categoria4=7" class="ff">CDs & DVDs</a></li>
                    <? } ?>
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 4 OR familia2 = 4 OR familia3 = 4 OR familia4 = 4) AND categoria = 8 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia4']==4) && ($_GET['categoria4']==8)) {?>
					<li><a href="index.php?familia4=4&categoria4=8" class="selecionado">Aplicación para móviles</a></li>
					<? } else { ?>
					<li><a href="index.php?familia4=4&categoria4=8" class="ff"><img src="/img/app8.png" width="64" height="64">Aplicación para móviles</a></li>
                    <? } ?>
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 4 OR familia2 = 4 OR familia3 = 4 OR familia4 = 4) AND categoria = 9 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
					<li><a href="index.php?familia4=4&categoria4=9" class="selecionado">Kindle</a></li>
					<? } ?> 

                    <li><a href="/142/1/6/teleclase-mensual-abril-2019" class="ff">TeleClases</a></li>
</ul>
		    <nav2>
	      </div>
					<div id="cbp-vm3" class="cbp-vm-switcher cbp-vm-view-grid">
					<div class="cbp-vm-options">
<?
if (isset($_GET['categoria4'])){
	$tt = $_GET['categoria4'];
} else {
	$tt = 1;	
}
	//$tt = $_GET['categoria4'];
	mysql_select_db($database_cone, $cone);
	$query_rs_listado = "SELECT * FROM mabel_store_categoria WHERE id = '$tt'";
	$rs_listado = mysql_query($query_rs_listado, $cone) or die(mysql_error());
	$row_rs_listado = mysql_fetch_assoc($rs_listado);
	$totalRows_rs_listado = mysql_num_rows($rs_listado);	
	echo '<span style="font-size: 15px;height: 20px;display: block;float: left;margin-top: 11px;color:#FF3709;">Está viendo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="text-decoration: underline;">'.$row_rs_listado['rubro_es'].'</strong></span>';
?>                    
<table width="80" border="0" cellspacing="0" cellpadding="2" id="tabi">
  <tbody><tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td height="27" align="center" valign="top" background="/img/carro2.png" class="letra01"><? echo $totalpremio4s;?></td>
  </tr>
  <tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td align="center" class="letra02"><p><strong>Shopping Cart</strong><br>    
    <span class="letra03" onclick="location = elimina.php">(vaciar)</span></p></td>
  </tr>
</tbody></table>
<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Vista Grid</a>
<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">Vista Lista</a>
<span style="font-size: 15px;height: 20px;display: block;float: right;margin-top: 11px;color:#323233;" id="mmm03">Cambiar Vista</span>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px; cursor:pointer; color:#323233;" onMouseOver="MM_showHideLayers('smng4','','show')" id="mmm02">Ordenar&nbsp;<img src="/img/fle.jpg" width="21" height="14">&nbsp;|&nbsp;&nbsp;
<div style="position: relative;float: right;top: 40px;right: 15px;">
  <div id="smng4" style="position:absolute;width: 100px;z-index: 10; visibility:hidden;" onMouseOut="MM_showHideLayers('smng4','','hide')" onMouseOver="MM_showHideLayers('smng4','','show')"> 
<table width="100" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tr>
      <? if (!isset($_GET['categoria4'])) { $_GET['categoria4']=1;}?>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia4=4&categoria4=<? echo $_GET['categoria4'];?>&orden=1'">Menor precio</p></td>
      </tr>
      <tr>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia4=4&categoria4=<? echo $_GET['categoria4'];?>&orden=2'">Mayor precio</p></td>
      </tr>
    </table>
  </div></div><p></p>                        
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px;color:#323233" id="mmm01">
Filtrar por<select name="categoria" class="txt" id="categoria" onchange="location = this.options[this.selectedIndex].value;">
  <option value="index.php" selected="selected" <?php if (!isset($_GET['categoria'])) {echo "selected=\"selected\"";} ?>>Seleccionar</option>
<option value="/ho-oponopono-libros" <?php if (($_GET['categoria']==1) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Libros</option>
<option value="/ho-oponopono-audios-digitales" <?php if (($_GET['categoria']==2) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audios Digitales</option>
<option value="/ho-oponopono-audios-libros" <?php if (($_GET['categoria']==3) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audio Libros</option>
<option value="/ho-oponopono-ebooks" <?php if (($_GET['categoria']==4) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>eBooks</option>
<option value="/ho-oponopono-videos-digitales" <?php if (($_GET['categoria']==5) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Videos Digitales</option>

<option value="/ho-oponopono-cd-dvd" <?php if (($_GET['categoria']==7) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>CDs &amp; DVDs</option>
<option value="/ho-oponopono-aplicacion-mobiles" <?php if (($_GET['categoria']==8) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Aplicación para móviles</option>
<option value="/ho-oponopono-kindle" <?php if (($_GET['categoria']==9) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Kindle</option>
<option value="/ho-oponopono-llamada-privada" <?php if (($_GET['categoria']==10) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Llamada Privada</option>
<option value="/ho-oponopono-productos-de-paz" <?php if (($_GET['categoria']==11) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Productos de Paz</option>
<option value="/ho-oponopono-teleclases" <?php if (($_GET['categoria']==6) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>TeleClases</option>
</select>
</p>
</div>
<!--
<div>
  <img src="img/banner_nav2.png" name="bnav" width="900" height="153" id="bnav">
  <img src="img/banner_nav2.png" name="bnav2" width="335" height="121" id="bnav2">
  
  </div>-->
					<ul>
<?
$ff = '';
$bb = '';
$bb2 = '';
$orf = "ORDER BY posicion ASC";
if ($_GET['orden'] == 1 ) { $orf = " ORDER BY precio ASC";} 
if ($_GET['orden'] == 2 ) { $orf = " ORDER BY precio DESC";} 
if ($_GET['familia4']<>'') {
	$familia = $_GET['familia4'];
	if ($_GET['categoria4']<>'') {
		$categoria = $_GET['categoria4'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	}	
} else {
	$familia = 4;
	if ($_GET['categoria4']<>'') {
		$categoria = $_GET['categoria4'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	} else {
		if ($linkcontrol4==1){
			$categoria = 1;
			$bb = "AND categoria = '$categoria'";
			$bb2 = $categoria;		
		}
	}
}

	$ff = "(familia = '$familia' OR familia2 = '$familia' OR familia3 = '$familia' OR familia4 = '$familia')";

	mysql_select_db($database_cone, $cone);
	$query_rs_pr = "SELECT * FROM mabel_store_productos WHERE $ff $bb AND stock = '1'  AND idioma = '1' $orf";
	$rs_pr = mysql_query($query_rs_pr, $cone) or die(mysql_error());
	$row_rs_pr = mysql_fetch_assoc($rs_pr);
	$totalRows_rs_pr = mysql_num_rows($rs_pr);
	if ($totalRows_rs_pr<>0){
	do {
		$asolo = '';
?>
                        <li>
                        <a class="cbp-vm-image sm" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>"><img src="http://store.mabelkatz.com/admin/<?php echo substr ($row_rs_pr['imagen'], 0, 250); ?>" class="ancho_max_imagen"></a>
                                                <? 
if ($row_rs_pr['categoriamuestra']=='') { 												
if ($row_rs_pr['categoria']==0) { $rubro=""; }													
if ($row_rs_pr['categoria']==1) { $rubro="Libro"; }
if ($row_rs_pr['id']==173) {
	$rubro="Audios Digitales + Vbook";
} else {
	if ($row_rs_pr['categoria']==2) { $rubro="Audios Digitales"; }
}
if ($row_rs_pr['categoria']==3) { $rubro="Audio Libros"; }
if ($row_rs_pr['categoria']==4) { $rubro="eBook"; }
if ($row_rs_pr['id']==128) {
	$rubro="Audios Digitales + Vbook";
} else {
	if ($row_rs_pr['categoria']==5) { $rubro="Videos Digitales"; }
}


if ($row_rs_pr['categoria']==6) { $rubro="Teleclases"; }
if ($row_rs_pr['categoria']==7) { $rubro="CD"; }
if ($row_rs_pr['categoria']==8) { $rubro="Aplicación para móviles"; }
if ($row_rs_pr['categoria']==9) { $rubro="Kindle"; }
if ($row_rs_pr['categoria']==10) { $rubro="Llamada Privada"; }
} else {
$rubro=$row_rs_pr['categoriamuestra']; 
}
echo '<span style="font-size:13px; color:#000">'.$rubro.'</span>';
						?> 
                        <h3 class="cbp-vm-title"><? echo strip_tags($row_rs_pr['titulo'],'<em><br>');?></h3>
                        <div class="cbp-vm-price" id='llk'><? if ($row_rs_pr['precio2']<>0) {?>US $<span class="prev"><? $decimales = explode(".",$row_rs_pr['precio2']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio2']);
} else {
echo $row_rs_pr['precio2'];
}
?></span><? $asolo = "Ahora "; ?><? } ?> <? echo $asolo; ?>US $<? $decimales = explode(".",$row_rs_pr['precio']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio']);
} else {
echo $row_rs_pr['precio'];
}
;?></div>
                        <div class="cbp-vm-details">
                        <? echo $row_rs_pr['descripcion'];?>
							</div>
							<? if ($row_rs_pr['buy']==1){?>
<a class="cbp-vm-icon cbp-vm-add" href="ecommerce_derivar.php?vid=<? echo $row_rs_pr['id'];?>">Comprar</a>
<? } ?><? if ($row_rs_pr['descripcionlarga']<>'') {?><a class="cbp-vm-icon cbp-vm-info" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">Más información  </a><? } ?>
							<? if ($row_rs_pr['more']<>'') {?>
                            <a class="cbp-vm-icon cbp-vm-info" href="<? echo strip_tags($row_rs_pr['more']);?>" target="_blank">Más información  </a>
							<? } ?>                                   
						</li>
<? }  while ($row_rs_pr = mysql_fetch_assoc($rs_pr));
	}?>
						
					</ul>
				</div>
					</section>
<section id="section-5">
<div class="tabs2" id="tabsee6">
<nav2>
<ul>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 7 OR familia2 = 7 OR familia3 = 7 OR familia4 = 7) AND categoria = 1 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia7']==7) && ($_GET['categoria7']==1)) {?>
					<li><a href="index.php?familia7=7&categoria7=1" class="selecionado">Libros</a></li>
					<? } else { ?>
					<li><a href="index.php?familia7=7&categoria7=1" class="ff">Libros</a></li>
					<? } ?>
					<? } ?>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 7 OR familia2 = 7 OR familia3 = 7 OR familia4 = 7) AND categoria = 12 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia7']==7) && ($_GET['categoria7']==12) || ($linkcontrol7==1)) {?>
					<li><a href="index.php?familia7=7&categoria7=12" class="selecionado">TeleClases</a></li>
					<? } else { ?>
					<li><a href="index.php?familia7=7&categoria7=12" class="ff">TeleClases</a></li>
                    <? } ?>                    
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 7 OR familia2 = 7 OR familia3 = 7 OR familia4 = 7) AND categoria = 2 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia7']==7) && ($_GET['categoria7']==2) || ($linkcontrol7==1)) {?>
					<li><a href="/riqueza-audios-digitales" class="selecionado">Audios Digitales</a></li>
					<? } else { ?>
					<li><a href="/riqueza-audios-digitales" class="ff">Audios Digitales</a></li>
                    <? } ?>                    
					<? } ?>                    
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 7 OR familia2 = 7 OR familia3 = 7 OR familia4 = 7) AND categoria = 3 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia7']==7) && ($_GET['categoria7']==3)) {?>
					<li><a href="index.php?familia7=7&categoria7=3" class="selecionado">Audio Libros</a></li>
					<? } else { ?>
					<li><a href="index.php?familia7=7&categoria7=3" class="ff">Audio Libros</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 7 OR familia2 = 7 OR familia3 = 7 OR familia4 = 7) AND categoria = 4 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia7']==7) && ($_GET['categoria7']==4)) {?>
					<li><a href="index.php?familia7=7&categoria7=4" class="selecionado">eBooks</a></li>
					<? } else { ?>
					<li><a href="index.php?familia7=7&categoria7=4" class="ff">eBooks</a></li>
                    <? } ?>                       
					<? } ?>                       
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 7 OR familia2 = 7 OR familia3 = 7 OR familia4 = 7) AND categoria = 5 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia7']==7) && ($_GET['categoria7']==5)) {?>
					<li><a href="/riqueza-videos-digitales" class="selecionado">Videos Digitales</a></li>
					<? } else { ?>
					<li><a href="/riqueza-videos-digitales" class="ff">Videos Digitales</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 7 OR familia2 = 7 OR familia3 = 7 OR familia4 = 7) AND categoria = 6 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia7']==7) && ($_GET['categoria7']==6)) {?>
					<li><a href="index.php?familia7=7&categoria7=6" class="selecionado">TeleClases</a></li>
					<? } else { ?>
					<li><a href="index.php?familia7=7&categoria7=6" class="ff">TeleClases</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 7 OR familia2 = 7 OR familia3 = 7 OR familia4 = 7) AND categoria = 7 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia7']==7) && ($_GET['categoria7']==7)) {?>
					<li><a href="/riqueza-cds-dvds" class="selecionado">CDs & DVDs</a></li>
					<? } else { ?>
					<li><a href="/riqueza-cds-dvds" class="ff">CDs & DVDs</a></li>
                    <? } ?> 
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 7 OR familia2 = 7 OR familia3 = 7 OR familia4 = 7) AND categoria = 8 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia7']==7) && ($_GET['categoria7']==8)) {?>
					<li><a href="index.php?familia7=7&categoria7=8" class="selecionado">Aplicación para móviles</a></li>
					<? } else { ?>
					<li><a href="index.php?familia7=7&categoria7=8" class="ff">Aplicación para móviles</a></li>
                    <? } ?> 
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 7 OR familia2 = 7 OR familia3 = 7 OR familia4 = 7) AND categoria = 9 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia7']==7) && ($_GET['categoria7']==9)) {?>
					<li><a href="/riqueza-kindle" class="selecionado">Kindle</a></li>
					<? } else { ?>
					<li><a href="/riqueza-kindle" class="ff">Kindle</a></li>
					<? } ?> 
					<? } ?> 


                                        <li><a href="/142/1/6/teleclase-mensual-abril-2019" class="ff">TeleClases</a></li>
</ul>
</nav2>
<? 
mysql_select_db($database_cone, $cone);
$query_rsb = "SELECT * FROM banner WHERE idioma = '1' ORDER BY orden ASC";
$rsb = mysql_query($query_rsb, $cone) or die(mysql_error());
$row_rsb = mysql_fetch_assoc($rsb);
$totalRows_rsb = mysql_num_rows($rsb);
$i=1;
if ($totalRows_rsb<>0) {
	do {
	
?>
<a href="<? echo $row_rsb['link'];?>" target="<? echo $row_rsb['target'];?>"><img src="http://store.mabelkatz.com/<?php echo substr ($row_rsb['banner'], 0, 250); ?>" border="0" <? if ($i==1) { echo  "style=\"padding-top: 140px;margin-left: 3px;\""; $i++;}?>></a>
<? 
	} while ($row_rsb = mysql_fetch_assoc($rsb));
} ?>     
	      </div>
					<div id="cbp-vm4" class="cbp-vm-switcher cbp-vm-view-grid">
					<div class="cbp-vm-options">
<?
if (isset($_GET['categoria7'])){
	$tt = $_GET['categoria7'];
} else {
	$tt = 2;	
}
	//$tt = $_GET['categoria7'];
	mysql_select_db($database_cone, $cone);
	$query_rs_listado = "SELECT * FROM mabel_store_categoria WHERE id = '$tt'";
	$rs_listado = mysql_query($query_rs_listado, $cone) or die(mysql_error());
	$row_rs_listado = mysql_fetch_assoc($rs_listado);
	$totalRows_rs_listado = mysql_num_rows($rs_listado);	
	echo '<span style="font-size: 15px;height: 20px;display: block;float: left;margin-top: 11px;color:#FF3709;">Está viendo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="text-decoration: underline;">'.$row_rs_listado['rubro_es'].'</strong></span>';

?>                    
<table width="80" border="0" cellspacing="0" cellpadding="2" id="tabi">
  <tbody><tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td height="27" align="center" valign="top" background="/img/carro2.png" class="letra01"><? echo $totalpremio4s;?></td>
  </tr>
  <tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td align="center" class="letra02"><p><strong>Shopping Cart</strong><br>    
    <span class="letra03" onclick="location = elimina.php">(vaciar)</span></p></td>
  </tr>
</tbody></table>
<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Vista Grid</a>
<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">Vista Lista</a>
<span style="font-size: 15px;height: 20px;display: block;float: right;margin-top: 11px;color:#323233;" id="mmm03">Cambiar Vista</span>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px; cursor:pointer; color:#323233;" onMouseOver="MM_showHideLayers('smng5','','show')" id="mmm02">Ordenar&nbsp;<img src="/img/fle.jpg" width="21" height="14">&nbsp;|&nbsp;&nbsp;
<div style="position: relative;float: right;top: 40px;right: 15px;">
  <div id="smng5" style="position:absolute;width: 100px;z-index: 10; visibility:hidden;" onMouseOut="MM_showHideLayers('smng5','','hide')" onMouseOver="MM_showHideLayers('smng5','','show')"> 
<table width="100" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tr>
      <? if (!isset($_GET['categoria7'])) { $_GET['categoria7']=2;}?>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia7=7&categoria7=<? echo $_GET['categoria7'];?>&orden=1'">Menor precio</p></td>
      </tr>
      <tr>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia7=7&categoria7=<? echo $_GET['categoria7'];?>&orden=2'">Mayor precio</p></td>
      </tr>
    </table>
  </div></div><p></p>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px;color:#323233" id="mmm01">
Filtrar por<select name="categoria" class="txt" id="categoria" onchange="location = this.options[this.selectedIndex].value;">
  <option value="index.php" selected="selected" <?php if (!isset($_GET['categoria'])) {echo "selected=\"selected\"";} ?>>Seleccionar</option>
<option value="/ho-oponopono-libros" <?php if (($_GET['categoria']==1) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Libros</option>
<option value="/ho-oponopono-audios-digitales" <?php if (($_GET['categoria']==2) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audios Digitales</option>
<option value="/ho-oponopono-audios-libros" <?php if (($_GET['categoria']==3) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audio Libros</option>
<option value="/ho-oponopono-ebooks" <?php if (($_GET['categoria']==4) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>eBooks</option>
<option value="/ho-oponopono-videos-digitales" <?php if (($_GET['categoria']==5) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Videos Digitales</option>

<option value="/ho-oponopono-cd-dvd" <?php if (($_GET['categoria']==7) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>CDs &amp; DVDs</option>
<option value="/ho-oponopono-aplicacion-mobiles" <?php if (($_GET['categoria']==8) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Aplicación para móviles</option>
<option value="/ho-oponopono-kindle" <?php if (($_GET['categoria']==9) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Kindle</option>
<option value="/ho-oponopono-llamada-privada" <?php if (($_GET['categoria']==10) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Llamada Privada</option>
<option value="/ho-oponopono-productos-de-paz" <?php if (($_GET['categoria']==11) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Productos de Paz</option>
<option value="/ho-oponopono-teleclases" <?php if (($_GET['categoria']==6) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>TeleClases</option>
</select>
</p>
</div>
<!--
<div>
  <img src="img/banner_nav2.png" name="bnav" width="900" height="153" id="bnav">
  <img src="img/banner_nav2.png" name="bnav2" width="335" height="121" id="bnav2">
  
  </div>-->
					<ul>
<?
$ff = '';
$bb = '';
$bb2 = '';
$orf = "ORDER BY orden ASC";
if ($_GET['orden'] == 1 ) { $orf = " ORDER BY precio ASC";} 
if ($_GET['orden'] == 2 ) { $orf = " ORDER BY precio DESC";} 
if ($_GET['familia7']<>'') {
	$familia = $_GET['familia7'];
	if ($_GET['categoria7']<>'') {
		$categoria = $_GET['categoria7'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	}	
} else {
	$familia = 7;
	if ($_GET['categoria7']<>'') {
		$categoria = $_GET['categoria7'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	} else {
		if ($linkcontrol7==1){
		$categoria = 2;
		$bb = "AND categoria = '$categoria'";
		$bb2 = $categoria;		
		}
	}
}
	$ff = "(familia = '$familia' OR familia2 = '$familia' OR familia3 = '$familia' OR familia4 = '$familia')";
	mysql_select_db($database_cone, $cone);
	$query_rs_pr = "SELECT * FROM mabel_store_productos WHERE $ff $bb AND stock = '1'  AND idioma = '1' $orf ";
	$rs_pr = mysql_query($query_rs_pr, $cone) or die(mysql_error());
	$row_rs_pr = mysql_fetch_assoc($rs_pr);
	$totalRows_rs_pr = mysql_num_rows($rs_pr);
	if ($totalRows_rs_pr<>0){
	do {
		$asolo = '';
?>
                        <li>
                        <a class="cbp-vm-image sm" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>"><img src="http://store.mabelkatz.com/admin/<?php echo substr ($row_rs_pr['imagen'], 0, 250); ?>" class="ancho_max_imagen"></a>
                                                <?
if ($row_rs_pr['categoriamuestra']=='') { 
if ($row_rs_pr['categoria']==0) { $rubro=""; }													 
if ($row_rs_pr['categoria']==1) { $rubro="Libro"; }
if ($row_rs_pr['categoria']==2) { $rubro="Audios Digitales"; }
if ($row_rs_pr['categoria']==3) { $rubro="Audio Libros"; }
if ($row_rs_pr['categoria']==4) { $rubro="eBook"; }
if ($row_rs_pr['categoria']==5) { $rubro="Videos Digitales"; }
if ($row_rs_pr['categoria']==6) { $rubro="Teleclases"; }
if ($row_rs_pr['categoria']==7) { 
if (($row_rs_pr['id']==17) || ($row_rs_pr['id']==21)) {
$rubro="CD"; 
} else {
$rubro="DVDs"; 	
}
}
if ($row_rs_pr['categoria']==8) { $rubro="Aplicación para móviles"; }
if ($row_rs_pr['categoria']==9) { $rubro="Kindle"; }
if ($row_rs_pr['categoria']==10) { $rubro="Llamada Privada"; }
} else {
$rubro=$row_rs_pr['categoriamuestra']; 
}
echo '<span style="font-size:13px; color:#000">'.$rubro.'</span>';
						?> <h3 class="cbp-vm-title"><? echo strip_tags($row_rs_pr['titulo'],'<em><br>');?></h3>
                        <div class="cbp-vm-price" id='llk'><? if ($row_rs_pr['precio2']<>0) {?>US $<span class="prev"><? $decimales = explode(".",$row_rs_pr['precio2']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio2']);
} else {
echo $row_rs_pr['precio2'];
}
?></span><? $asolo = "Ahora "; ?><? } ?> <? echo $asolo; ?>US $<? $decimales = explode(".",$row_rs_pr['precio']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio']);
} else {
echo $row_rs_pr['precio'];
}
;?></div>
                        <div class="cbp-vm-details">
                        <? echo $row_rs_pr['descripcion'];?>
							</div>
<? if (($row_rs_pr['id']<>42) && ($row_rs_pr['id']<>38) && ($row_rs_pr['id']<>40) && ($row_rs_pr['id']<>41)) {?>
    <a class="cbp-vm-icon cbp-vm-add" href="ecommerce_derivar.php?vid=<? echo $row_rs_pr['id'];?>">Comprar</a>
<? }else { ?>
<a class="cbp-vm-icon cbp-vm-add" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">Comprar</a>
<? } ?>                            
                            

<? if ($row_rs_pr['descripcionlarga']<>'') {?><a class="cbp-vm-icon cbp-vm-info" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">Más información  </a><? } ?>
							<? if ($row_rs_pr['more']<>'') {?>
                            <a class="cbp-vm-icon cbp-vm-info" href="<? echo strip_tags($row_rs_pr['more']);?>" target="_blank">Más información  </a>
							<? } ?>                                   
						</li>
<? }  while ($row_rs_pr = mysql_fetch_assoc($rs_pr));
	}?>
						
					</ul>
				</div>
					</section>                    
<section id="section-6">
<div class="tabs2" id="tabsee7">
<nav2>
<ul>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 5 OR familia2 = 5 OR familia3 = 5 OR familia4 = 5) AND categoria = 1 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia5']==5) && ($_GET['categoria5']==1)) {?>
					<li><a href="index.php?familia5=5&categoria5=1" class="selecionado">Libros</a></li>
					<? } else { ?>
					<li><a href="index.php?familia5=5&categoria5=1" class="ff">Libros</a></li>
                    <? } ?>
					<? } ?>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 5 OR familia2 = 5 OR familia3 = 5 OR familia4 = 5) AND categoria = 12 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia5']==5) && ($_GET['categoria5']==12) || ($linkcontrol5==1)) {?>
					<li><a href="index.php?familia5=5&categoria5=12" class="selecionado">TeleClases</a></li>
					<? } else { ?>
					<li><a href="index.php?familia5=5&categoria5=12" class="ff">TeleClases</a></li>
                    <? } ?>                    
					<? } ?>  
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 5 OR familia2 = 5 OR familia3 = 5 OR familia4 = 5) AND categoria = 2 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia5']==5) && ($_GET['categoria5']==2) || ($linkcontrol5==1)) {?>
					<li><a href="/invitados-especiales-audios-digitales" class="selecionado">Audios Digitales</a></li>
					<? } else { ?>
					<li><a href="/invitados-especiales-audios-digitales" class="ff">Audios Digitales</a></li>
                    <? } ?>                    
					<? } ?>                    
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 5 OR familia2 = 5 OR familia3 = 5 OR familia4 = 5) AND categoria = 3 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia5']==5) && ($_GET['categoria5']==3)) {?>
					<li><a href="index.php?familia5=5&categoria5=3" class="selecionado">Audio Libros</a></li>
					<? } else { ?>
					<li><a href="index.php?familia5=5&categoria5=3" class="ff">Audio Libros</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 5 OR familia2 = 5 OR familia3 = 5 OR familia4 = 5) AND categoria = 4 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia5']==5) && ($_GET['categoria5']==4)) {?>
					<li><a href="index.php?familia5=5&categoria5=4" class="selecionado">eBooks</a></li>
					<? } else { ?>
					<li><a href="index.php?familia5=5&categoria5=4" class="ff">eBooks</a></li>
                    <? } ?>                       
					<? } ?>                       
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 5 OR familia2 = 5 OR familia3 = 5 OR familia4 = 5) AND categoria = 5 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia5']==5) && ($_GET['categoria5']==5)) {?>
					<li><a href="/invitados-especiales-videos-digitales" class="selecionado">Videos Digitales</a></li>
					<? } else { ?>
					<li><a href="/invitados-especiales-videos-digitales" class="ff">Videos Digitales</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 5 OR familia2 = 5 OR familia3 = 5 OR familia4 = 5) AND categoria = 6 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia5']==5) && ($_GET['categoria5']==6)) {?>
					<li><a href="index.php?familia5=5&categoria5=6" class="selecionado">TeleClases</a></li>
					<? } else { ?>
					<li><a href="index.php?familia5=5&categoria5=6" class="ff">TeleClases</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 5 OR familia2 = 5 OR familia3 = 5 OR familia4 = 5) AND categoria = 7 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia5']==5) && ($_GET['categoria5']==7)) {?>
					<li><a href="/invitados-especiales-cds-dvds" class="selecionado">CDs & DVDs</a></li>
					<? } else { ?>
					<li><a href="/invitados-especiales-cds-dvds" class="ff">CDs & DVDs</a></li>
                    <? } ?> 
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 5 OR familia2 = 5 OR familia3 = 5 OR familia4 = 5) AND categoria = 8 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia5']==5) && ($_GET['categoria5']==8)) {?>
					<li><a href="index.php?familia5=5&categoria5=8" class="selecionado">Aplicación para móviles</a></li>
					<? } else { ?>
					<li><a href="index.php?familia5=5&categoria5=8" class="ff">Aplicación para móviles</a></li>
                    <? } ?> 
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 5 OR familia2 = 5 OR familia3 = 5 OR familia4 = 5) AND categoria = 9 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia5']==5) && ($_GET['categoria5']==9)) {?>
					<li><a href="index.php?familia5=5&categoria5=9" class="selecionado">Kindle</a></li>
					<? } else { ?>
					<li><a href="index.php?familia5=5&categoria5=9" class="ff">Kindle</a></li>
                    <? } ?> 
					<? } ?> 
                                        <li><a href="/142/1/6/teleclase-mensual-abril-2019" class="ff">TeleClases</a></li>
</ul>  
</nav2>
<? 
mysql_select_db($database_cone, $cone);
$query_rsb = "SELECT * FROM banner WHERE idioma = '1' ORDER BY orden ASC";
$rsb = mysql_query($query_rsb, $cone) or die(mysql_error());
$row_rsb = mysql_fetch_assoc($rsb);
$totalRows_rsb = mysql_num_rows($rsb);
$i=1;
if ($totalRows_rsb<>0) {
	do {
	
?>
<a href="<? echo $row_rsb['link'];?>" target="<? echo $row_rsb['target'];?>"><img src="http://store.mabelkatz.com/<?php echo substr ($row_rsb['banner'], 0, 250); ?>" border="0" <? if ($i==1) { echo  "style=\"padding-top: 140px;margin-left: 3px;\""; $i++;}?>></a>
<? 
	} while ($row_rsb = mysql_fetch_assoc($rsb));
} ?>
	      </div>
					<div id="cbp-vm5" class="cbp-vm-switcher cbp-vm-view-grid">
					<div class="cbp-vm-options">
<?
if (isset($_GET['categoria5'])){
	$tt = $_GET['categoria5'];
} else {
	$tt = 2;	
}
	//$tt = $_GET['categoria5'];
	mysql_select_db($database_cone, $cone);
	$query_rs_listado = "SELECT * FROM mabel_store_categoria WHERE id = '$tt'";
	$rs_listado = mysql_query($query_rs_listado, $cone) or die(mysql_error());
	$row_rs_listado = mysql_fetch_assoc($rs_listado);
	$totalRows_rs_listado = mysql_num_rows($rs_listado);	
	echo '<span style="font-size: 15px;height: 20px;display: block;float: left;margin-top: 11px;color:#FF3709;">Está viendo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="text-decoration: underline;">'.$row_rs_listado['rubro_es'].'</strong></span>';

?>                    
<table width="80" border="0" cellspacing="0" cellpadding="2" id="tabi">
  <tbody><tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td height="27" align="center" valign="top" background="/img/carro2.png" class="letra01"><? echo $totalpremio4s;?></td>
  </tr>
  <tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td align="center" class="letra02"><p><strong>Shopping Cart</strong><br>    
    <span class="letra03" onclick="location = elimina.php">(vaciar)</span></p></td>
  </tr>
</tbody></table>
<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Vista Grid</a>
<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">Vista Lista</a>
<span style="font-size: 15px;height: 20px;display: block;float: right;margin-top: 11px;color:#323233;" id="mmm03">Cambiar Vista</span>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px; cursor:pointer; color:#323233;" onMouseOver="MM_showHideLayers('smng6','','show')" id="mmm02">Ordenar&nbsp;<img src="/img/fle.jpg" width="21" height="14">&nbsp;|&nbsp;&nbsp;
<div style="position: relative;float: right;top: 40px;right: 15px;">
  <div id="smng6" style="position:absolute;width: 100px;z-index: 10; visibility:hidden;" onMouseOut="MM_showHideLayers('smng6','','hide')" onMouseOver="MM_showHideLayers('smng6','','show')"> 
<table width="100" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tr>
      <? if (!isset($_GET['categoria5'])) { $_GET['categoria5']=2;}?>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia5=5&categoria5=<? echo $_GET['categoria5'];?>&orden=1'">Menor precio</p></td>
      </tr>
      <tr>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia5=5&categoria5=<? echo $_GET['categoria5'];?>&orden=2'">Mayor precio</p></td>
      </tr>
    </table>
  </div></div><p></p>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px;color:#323233" id="mmm01">
Filtrar por<select name="categoria" class="txt" id="categoria" onchange="location = this.options[this.selectedIndex].value;">
  <option value="index.php" selected="selected" <?php if (!isset($_GET['categoria'])) {echo "selected=\"selected\"";} ?>>Seleccionar</option>
<option value="/ho-oponopono-libros" <?php if (($_GET['categoria']==1) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Libros</option>
<option value="/ho-oponopono-audios-digitales" <?php if (($_GET['categoria']==2) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audios Digitales</option>
<option value="/ho-oponopono-audios-libros" <?php if (($_GET['categoria']==3) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audio Libros</option>
<option value="/ho-oponopono-ebooks" <?php if (($_GET['categoria']==4) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>eBooks</option>
<option value="/ho-oponopono-videos-digitales" <?php if (($_GET['categoria']==5) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Videos Digitales</option>

<option value="/ho-oponopono-cd-dvd" <?php if (($_GET['categoria']==7) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>CDs &amp; DVDs</option>
<option value="/ho-oponopono-aplicacion-mobiles" <?php if (($_GET['categoria']==8) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Aplicación para móviles</option>
<option value="/ho-oponopono-kindle" <?php if (($_GET['categoria']==9) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Kindle</option>
<option value="/ho-oponopono-llamada-privada" <?php if (($_GET['categoria']==10) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Llamada Privada</option>
<option value="/ho-oponopono-productos-de-paz" <?php if (($_GET['categoria']==11) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Productos de Paz</option>
<option value="/ho-oponopono-teleclases" <?php if (($_GET['categoria']==6) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>TeleClases</option>
</select>
</p>
</div>
<!--
<div>
  <img src="img/banner_nav2.png" name="bnav" width="900" height="153" id="bnav">
  <img src="img/banner_nav2.png" name="bnav2" width="335" height="121" id="bnav2">
  
  </div>-->
					<ul>
<?
$ff = '';
$bb = '';
$bb2 = '';
$orf = "ORDER BY orden ASC";
if ($_GET['orden'] == 1 ) { $orf = " ORDER BY precio ASC";} 
if ($_GET['orden'] == 2 ) { $orf = " ORDER BY precio DESC";} 
if ($_GET['familia5']<>'') {
	$familia = $_GET['familia5'];
	if ($_GET['familia5']<>'') {
		$categoria = $_GET['categoria5'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	}	
} else {
	$familia = 5;
	if ($_GET['categoria5']<>'') {
		$categoria = $_GET['categoria5'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	} else {
	if ($linkcontrol5==1){
		$categoria = 2;
		$bb = "AND categoria = '$categoria'";
		$bb2 = $categoria;		
	}
	}
}
	$ff = "(familia = '$familia' OR familia2 = '$familia' OR familia3 = '$familia' OR familia4 = '$familia')";
	mysql_select_db($database_cone, $cone);
	$query_rs_pr = "SELECT * FROM mabel_store_productos WHERE $ff $bb AND stock = '1'  AND idioma = '1' $orf";
	$rs_pr = mysql_query($query_rs_pr, $cone) or die(mysql_error());
	$row_rs_pr = mysql_fetch_assoc($rs_pr);
	$totalRows_rs_pr = mysql_num_rows($rs_pr);
	if ($totalRows_rs_pr<>0){
	do {
		$asolo = '';
?>
                        <li>
                        <a class="cbp-vm-image sm" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>"><img src="http://store.mabelkatz.com/admin/<?php echo substr ($row_rs_pr['imagen'], 0, 250); ?>" class="ancho_max_imagen"></a>
                                              <? 
if ($row_rs_pr['categoriamuestra']=='') {											  
if ($row_rs_pr['categoria']==0) { $rubro=""; }												  
if ($row_rs_pr['categoria']==1) { $rubro="Libro"; }
if ($row_rs_pr['categoria']==2) { $rubro="Audios Digitales"; }
if ($row_rs_pr['categoria']==3) { $rubro="Audio Libros"; }
if ($row_rs_pr['categoria']==4) { $rubro="eBook"; }
if ($row_rs_pr['categoria']==5) { $rubro="Videos Digitales"; }
if ($row_rs_pr['categoria']==6) { $rubro="Teleclases"; }
if ($row_rs_pr['categoria']==7) { 
if ($row_rs_pr['id']==16) {
		$rubro="DVDs";

} else { 
	$rubro="CD";
} }
if ($row_rs_pr['categoria']==8) { $rubro="Aplicación para móviles"; }
if ($row_rs_pr['categoria']==9) { $rubro="Kindle"; }
if ($row_rs_pr['categoria']==10) { $rubro="Llamada Privada"; }
} else {
$rubro=$row_rs_pr['categoriamuestra']; 
}
echo '<span style="font-size:13px; color:#000">'.$rubro.'</span>';
						?>   <h3 class="cbp-vm-title"><? echo strip_tags($row_rs_pr['titulo'],'<em><br>');?></h3>
                        <div class="cbp-vm-price" id='llk'><? if ($row_rs_pr['precio2']<>0) {?>US $<span class="prev"><? $decimales = explode(".",$row_rs_pr['precio2']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio2']);
} else {
echo $row_rs_pr['precio2'];
}
?></span><? $asolo = "Ahora "; ?><? } ?> <? echo $asolo; ?>US $<? $decimales = explode(".",$row_rs_pr['precio']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio']);
} else {
echo $row_rs_pr['precio'];
}
;?></div>
                        <div class="cbp-vm-details">
                        <? echo $row_rs_pr['descripcion'];?>
							</div>
							<? if ($row_rs_pr['buy']==1){?>
<a class="cbp-vm-icon cbp-vm-add" href="ecommerce_derivar.php?vid=<? echo $row_rs_pr['id'];?>">Comprar</a>
<? } ?><? if ($row_rs_pr['descripcionlarga']<>'') {?><a class="cbp-vm-icon cbp-vm-info" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">Más información  </a><? } ?>
							<? if ($row_rs_pr['more']<>'') {?>
                            <a class="cbp-vm-icon cbp-vm-info" href="<? echo strip_tags($row_rs_pr['more']);?>" target="_blank">Más información  </a>
							<? } ?>                                   
						</li>
<? }  while ($row_rs_pr = mysql_fetch_assoc($rs_pr));
	}?>
						
					</ul>
					
				</div>
					</section>
<section id="section-7">
<div class="tabs2" id="tabsee8">
<nav2>
<ul>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 6 OR familia2 = 6 OR familia3 = 6 OR familia4 = 6) AND categoria = 1 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia6']==6) && ($_GET['categoria6']==1)) {?>
					<li><a href="index.php?familia6=6&categoria6=1" class="selecionado">Libros</a></li>
					<? }else { ?>
                    <li><a href="index.php?familia6=6&categoria6=1" class="ff">Libros</a></li>
                    <? } ?>
					
					<? } ?>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 6 OR familia2 = 6 OR familia3 = 6 OR familia4 = 6) AND categoria = 12 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia6']==6) && ($_GET['categoria6']==12)) {?>
					<li><a href="index.php?familia6=6&categoria6=12" class="selecionado">TeleClases</a></li>
					<? }else { ?>
					<li><a href="index.php?familia6=6&categoria6=12" class="ff">TeleClases</a></li>
                    <? } ?>                    
					<? } ?>  
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 6 OR familia2 = 6 OR familia3 = 6 OR familia4 = 6) AND categoria = 2 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia6']==6) && ($_GET['categoria6']==2) || ($linkcontrol6==1)) {?>
					<li><a href="/tele-entrenamientos-audios-digitales" class="selecionado">Audios Digitales</a></li>
					<? }else { ?>
					<li><a href="/tele-entrenamientos-audios-digitales" class="ff">Audios Digitales</a></li>
                    <? } ?>                    
					<? } ?>                    
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 6 OR familia2 = 6 OR familia3 = 6 OR familia4 = 6) AND categoria = 3 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia6']==6) && ($_GET['categoria6']==3)) {?>
					<li><a href="index.php?familia6=6&categoria6=3" class="selecionado">Audio Libros</a></li>
					<? }else { ?>
					<li><a href="index.php?familia6=6&categoria6=3" class="ff">Audio Libros</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 6 OR familia2 = 6 OR familia3 = 6 OR familia4 = 6) AND categoria = 4 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia6']==6) && ($_GET['categoria6']==4)) {?>
					<li><a href="index.php?familia6=6&categoria6=4" class="selecionado">eBooks</a></li>
					<? }else { ?>
					<li><a href="index.php?familia6=6&categoria6=4" class="ff">eBooks</a></li>
					<? } ?>                       
					<? } ?>                       
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 6 OR familia2 = 6 OR familia3 = 6 OR familia4 = 6) AND categoria = 5 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia6']==6) && ($_GET['categoria6']==5)) {?>
					<li><a href="/tele-entrenamientos-videos-digitales" class="selecionado">Videos Digitales</a></li>
					<? }else { ?>
					<li><a href="/tele-entrenamientos-videos-digitales" class="ff">Videos Digitales</a></li>
					<? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 6 OR familia2 = 6 OR familia3 = 6 OR familia4 = 6) AND categoria = 6 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia6']==6) && ($_GET['categoria6']==6)) {?>
					<li><a href="index.php?familia6=6&categoria6=6" class="selecionado">TeleClases</a></li>
					<? }else { ?>
					<li><a href="index.php?familia6=6&categoria6=6" class="ff">TeleClases</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 6 OR familia2 = 6 OR familia3 = 6 OR familia4 = 6) AND categoria = 7 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia6']==6) && ($_GET['categoria6']==7)) {?>
					<li><a href="/tele-series-cds-dvds" class="selecionado">CDs & DVDs</a></li>
					<? }else { ?>
					<li><a href="/tele-series-cds-dvds" class="ff">CDs & DVDs</a></li>
                    <? } ?> 
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 6 OR familia2 = 6 OR familia3 = 6 OR familia4 = 6) AND categoria = 8 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia6']==6) && ($_GET['categoria6']==8)) {?>
					<li><a href="index.php?familia6=6&categoria6=8" class="selecionado">Aplicación para móviles</a></li>
					<? }else { ?>
					<li><a href="index.php?familia6=6&categoria6=8" class="ff">Aplicación para móviles</a></li>
                    <? } ?> 
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 6 OR familia2 = 6 OR familia3 = 6 OR familia4 = 6) AND categoria = 9 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia6']==6) && ($_GET['categoria6']==9)) {?>
					<li><a href="index.php?familia6=6&categoria6=9" class="selecionado">Kindle</a></li>
					<? }else { ?>
					<li><a href="index.php?familia6=6&categoria6=9" class="ff">Kindle</a></li>
                    <? } ?> 
					<? } ?>                                         <li><a href="/142/1/6/teleclase-mensual-abril-2019" class="ff">TeleClases</a></li>
</ul>
</nav2>
<? 
mysql_select_db($database_cone, $cone);
$query_rsb = "SELECT * FROM banner WHERE idioma = '1' ORDER BY orden ASC";
$rsb = mysql_query($query_rsb, $cone) or die(mysql_error());
$row_rsb = mysql_fetch_assoc($rsb);
$totalRows_rsb = mysql_num_rows($rsb);
$i=1;
if ($totalRows_rsb<>0) {
	do {
	
?>
<a href="<? echo $row_rsb['link'];?>" target="<? echo $row_rsb['target'];?>"><img src="http://store.mabelkatz.com/<?php echo substr ($row_rsb['banner'], 0, 250); ?>" border="0" <? if ($i==1) { echo  "style=\"padding-top: 140px;margin-left: 3px;\""; $i++;}?>></a>
<? 
	} while ($row_rsb = mysql_fetch_assoc($rsb));
} ?>  
	      </div>
<div id="cbp-vm6" class="cbp-vm-switcher cbp-vm-view-grid">
<div class="cbp-vm-options">
<?
if (isset($_GET['categoria6'])){
	$tt = $_GET['categoria6'];
} else {
	$tt = 2;	
}
	//$tt = $_GET['categoria6'];
	mysql_select_db($database_cone, $cone);
	$query_rs_listado = "SELECT * FROM mabel_store_categoria WHERE id = '$tt'";
	$rs_listado = mysql_query($query_rs_listado, $cone) or die(mysql_error());
	$row_rs_listado = mysql_fetch_assoc($rs_listado);
	$totalRows_rs_listado = mysql_num_rows($rs_listado);	
	echo '<span style="font-size: 15px;height: 20px;display: block;float: left;margin-top: 11px;color:#FF3709;">Está viendo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="text-decoration: underline;">'.$row_rs_listado['rubro_es'].'</strong></span>';
?>                    
<table width="80" border="0" cellspacing="0" cellpadding="2" id="tabi">
  <tbody><tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td height="27" align="center" valign="top" background="/img/carro2.png" class="letra01"><? echo $totalpremio4s;?></td>
  </tr>
  <tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td align="center" class="letra02"><p><strong>Shopping Cart</strong><br>    
    <span class="letra03" onclick="location = elimina.php">(vaciar)</span></p></td>
  </tr>
</tbody></table>
<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Vista Grid</a>
<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">Vista Lista</a>
<span style="font-size: 15px;height: 20px;display: block;float: right;margin-top: 11px;color:#323233;" id="mmm03">Cambiar Vista</span>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px; cursor:pointer; color:#323233;" onMouseOver="MM_showHideLayers('smng7','','show')" id="mmm02">Ordenar&nbsp;<img src="/img/fle.jpg" width="21" height="14">&nbsp;|&nbsp;&nbsp;
<div style="position: relative;float: right;top: 40px;right: 15px;">
  <div id="smng7" style="position:absolute;width: 100px;z-index: 10; visibility:hidden;" onMouseOut="MM_showHideLayers('smng7','','hide')" onMouseOver="MM_showHideLayers('smng7','','show')"> 
<table width="100" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tr>
      <? if (!isset($_GET['categoria6'])) { $_GET['categoria6']=2;}?>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia6=6&categoria6=<? echo $_GET['categoria6'];?>&orden=1'">Menor precio</p></td>
      </tr>
      <tr>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia6=6&categoria6=<? echo $_GET['categoria6'];?>&orden=2'">Mayor precio</p></td>
      </tr>
    </table>
  </div></div><p></p>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px;color:#323233" id="mmm01">
Filtrar por<select name="categoria" class="txt" id="categoria" onchange="location = this.options[this.selectedIndex].value;">
  <option value="index.php" selected="selected" <?php if (!isset($_GET['categoria'])) {echo "selected=\"selected\"";} ?>>Seleccionar</option>
<option value="/ho-oponopono-libros" <?php if (($_GET['categoria']==1) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Libros</option>
<option value="/ho-oponopono-audios-digitales" <?php if (($_GET['categoria']==2) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audios Digitales</option>
<option value="/ho-oponopono-audios-libros" <?php if (($_GET['categoria']==3) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audio Libros</option>
<option value="/ho-oponopono-ebooks" <?php if (($_GET['categoria']==4) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>eBooks</option>
<option value="/ho-oponopono-videos-digitales" <?php if (($_GET['categoria']==5) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Videos Digitales</option>

<option value="/ho-oponopono-cd-dvd" <?php if (($_GET['categoria']==7) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>CDs &amp; DVDs</option>
<option value="/ho-oponopono-aplicacion-mobiles" <?php if (($_GET['categoria']==8) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Aplicación para móviles</option>
<option value="/ho-oponopono-kindle" <?php if (($_GET['categoria']==9) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Kindle</option>
<option value="/ho-oponopono-llamada-privada" <?php if (($_GET['categoria']==10) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Llamada Privada</option>
<option value="/ho-oponopono-productos-de-paz" <?php if (($_GET['categoria']==11) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Productos de Paz</option>
<option value="/ho-oponopono-teleclases" <?php if (($_GET['categoria']==6) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>TeleClases</option>
</select>
</p>
</div>
<!--
<div>
  <img src="img/banner_nav2.png" name="bnav" width="900" height="153" id="bnav">
  <img src="img/banner_nav2.png" name="bnav2" width="335" height="121" id="bnav2">
  
  </div>-->
<ul>
<? if (($_GET['familia5']==5) && ($_GET['categoria5']==7)) {?>
<? } ?>
<?
$ff = '';
$bb = '';
$bb2 = '';
$orf = "ORDER BY posicion ASC";
if ($_GET['orden'] == 1 ) { $orf = " ORDER BY precio ASC";} 
if ($_GET['orden'] == 2 ) { $orf = " ORDER BY precio DESC";} 
if ($_GET['familia6']<>'') {
	$familia = $_GET['familia6'];
	if ($_GET['familia6']<>'') {
		$categoria = $_GET['categoria6'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	}	
} else {
	$familia = 6;
	if ($_GET['categoria6']<>'') {
		$categoria = $_GET['categoria6'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	} else {
	if ($linkcontrol6==1) {
		$categoria = 2;
		$bb = "AND categoria = '$categoria'";
		$bb2 = $categoria;		
	}
	}
}

	$ff = "(familia = '$familia' OR familia2 = '$familia' OR familia3 = '$familia' OR familia4 = '$familia')";
	mysql_select_db($database_cone, $cone);
	$query_rs_pr = "SELECT * FROM mabel_store_productos WHERE $ff $bb AND stock = '1' AND id<>95 AND id<>117 AND id<>118 AND  id<>117 AND id<>118  AND idioma = '1' $orf";
	$rs_pr = mysql_query($query_rs_pr, $cone) or die(mysql_error());
	$row_rs_pr = mysql_fetch_assoc($rs_pr);
	$totalRows_rs_pr = mysql_num_rows($rs_pr);
	//echo $query_rs_pr;
	$orf ="";
	if ($totalRows_rs_pr<>0){
	do {
		$asolo = '';
?>
                        <li>
                        <a class="cbp-vm-image" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>"><img src="http://store.mabelkatz.com/admin/<?php echo substr ($row_rs_pr['imagen'], 0, 250); ?>" class="ancho_max_imagen"></a>
                                                <? 
if ($row_rs_pr['categoriamuestra']=='') { 												
if ($row_rs_pr['categoria']==0) { $rubro=""; }													
if ($row_rs_pr['categoria']==1) { $rubro="Libro"; }
if ($row_rs_pr['categoria']==2) { $rubro="Audios Digitales"; }
if ($row_rs_pr['categoria']==3) { $rubro="Audio Libros"; }
if ($row_rs_pr['categoria']==4) { $rubro="eBook"; }
if ($row_rs_pr['categoria']==5) { $rubro="Videos Digitales"; }
if ($row_rs_pr['categoria']==6) { $rubro="Teleclases"; }
if ($row_rs_pr['categoria']==7) { $rubro="DVDs"; }
if ($row_rs_pr['categoria']==8) { $rubro="Aplicación para móviles"; }
if ($row_rs_pr['categoria']==9) { $rubro="Kindle"; }
if ($row_rs_pr['categoria']==10) { $rubro="Llamada Privada"; }
} else {
$rubro=$row_rs_pr['categoriamuestra']; 
}
echo '<span style="font-size:13px; color:#000">'.$rubro.'</span>';
						?> <h3 class="cbp-vm-title"><? echo strip_tags($row_rs_pr['titulo'],'<em><br>');?></h3>
                        <div class="cbp-vm-price" id='llk'><? if ($row_rs_pr['precio2']<>0) {?>US $<span class="prev"><? $decimales = explode(".",$row_rs_pr['precio2']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio2']);
} else {
echo $row_rs_pr['precio2'];
}
?></span><? $asolo = "Ahora "; ?><? } ?> <? echo $asolo; ?>US $<? $decimales = explode(".",$row_rs_pr['precio']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio']);
} else {
echo $row_rs_pr['precio'];
}
;?></div>
                        <div class="cbp-vm-details">
                        <? echo $row_rs_pr['descripcion'];?>
							</div>
							<? if ($row_rs_pr['buy']==1){?>
<a class="cbp-vm-icon cbp-vm-add" href="ecommerce_derivar.php?vid=<? echo $row_rs_pr['id'];?>">Comprar</a>
<? } ?><? if ($row_rs_pr['descripcionlarga']<>'') {?><a class="cbp-vm-icon cbp-vm-info" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">Más información  </a><? } ?>
							<? if ($row_rs_pr['more']<>'') {?>
                            <a class="cbp-vm-icon cbp-vm-info" href="<? echo strip_tags($row_rs_pr['more']);?>" target="_blank">Más información  </a>
							<? } ?>                                   
						</li>
<? }  while ($row_rs_pr = mysql_fetch_assoc($rs_pr));
	}?>
					</ul>
				</div>
					</section>  
<section id="section-8" style="
    width: 1310px;
    margin-left: -4px;
    margin-left: auto;
    margin-right: auto;
">

					<div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
					<div class="cbp-vm-options">


</div>
<!---->
<iframe width= "1310" height="2750" src="http://hooponopono-espanol.com/apoyo/index_tienda.html" frameborder="0" allowfullscreen scrolling="no" style="margin-left:auto; margin-right:auto;" id="gt5"></iframe>

<iframe width= "100%" height="6200" src="http://hooponopono-espanol.com/apoyo/index_tienda_mobile.html" frameborder="0" allowfullscreen scrolling="no" style="margin-left:auto; margin-right:auto; display:none" id="gt6"></iframe>
<!---->
				</div>
					</section>   
<section id="section-9">
<div class="tabs2" id="tabsee10">
<nav2>
<ul>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 9 OR familia2 = 9 OR familia3 = 9 OR familia4 = 9) AND categoria = 1 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia9']==9) && ($_GET['categoria9']==1)) {?>
					<li><a href="index.php?familia9=9&categoria9=1" class="selecionado">Libros</a></li>
                    <? } else { ?>
                    <li><a href="index.php?familia9=9&categoria9=1" class="ff">Libros</a></li>
                    <? } ?>
					<? } ?>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 9 OR familia2 = 9 OR familia3 = 9 OR familia4 = 9) AND categoria = 12 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia9']==9) && ($_GET['categoria9']==12)) {?>
					<li><a href="index.php?familia9=9&categoria9=12" class="selecionado">TeleClases</a></li>
					<? } else { ?>
					<li><a href="index.php?familia9=9&categoria9=12" class="ff">TeleClases</a></li>
					<? } ?>                    
					<? } ?>    
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 9 OR familia2 = 9 OR familia3 = 9 OR familia4 = 9) AND categoria = 2 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia9']==9) && ($_GET['categoria9']==2)) {?>
					<li><a href="index.php?familia9=9&categoria9=2" class="selecionado">Audios Digitales</a></li>
					<? } else { ?>
					<li><a href="index.php?familia9=9&categoria9=2" class="ff">Audios Digitales</a></li>
					<? } ?>                    
					<? } ?>                    
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 9 OR familia2 = 9 OR familia3 = 9 OR familia4 = 9) AND categoria = 3 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia9']==9) && ($_GET['categoria9']==3)) {?>
					<li><a href="index.php?familia9=9&categoria9=3" class="selecionado">Audio Libros</a></li>
					<? } else { ?>
					<li><a href="index.php?familia9=9&categoria9=3" class="ff">Audio Libros</a></li>
					<? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 9 OR familia2 = 9 OR familia3 = 9 OR familia4 = 9) AND categoria = 4 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia9']==9) && ($_GET['categoria9']==4)) {?>
					<li><a href="index.php?familia9=9&categoria9=4" class="selecionado">eBooks</a></li>
					<? } else { ?>
					<li><a href="index.php?familia9=9&categoria9=4" class="ff">eBooks</a></li>
                    <? } ?>                       
					<? } ?>                       
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 9 OR familia2 = 9 OR familia3 = 9 OR familia4 = 9) AND categoria = 5 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia9']==9) && ($_GET['categoria9']==5)) {?>
					<li><a href="index.php?familia9=9&categoria9=5" class="selecionado">Videos Digitales</a></li>
					<? } else { ?>
					<li><a href="index.php?familia9=9&categoria9=5" class="ff">Videos Digitales</a></li>
					<? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 9 OR familia2 = 9 OR familia3 = 9 OR familia4 = 9) AND categoria = 6 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia9']==9) && ($_GET['categoria9']==6)) {?>
					<li><a href="index.php?familia9=9&categoria9=6" class="selecionado">TeleClases</a></li>
					<? } else { ?>
					<li><a href="index.php?familia9=9&categoria9=6" class="ff">TeleClases</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 9 OR familia2 = 9 OR familia3 = 9 OR familia4 = 9) AND categoria = 7 AND stock = '1' AND idioma = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia9']==9) && ($_GET['categoria9']==7)) {?>
					<li><a href="index.php?familia9=9&categoria9=7" class="selecionado">CDs & DVDs</a></li>
					<? } else { ?>
					<li><a href="index.php?familia9=9&categoria9=7" class="ff">CDs & DVDs</a></li>
                    <? } ?>
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 9 OR familia2 = 9 OR familia3 = 9 OR familia4 = 9) AND categoria = 8 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia9']==9) && ($_GET['categoria9']==8)) {?>
					<li><a href="index.php?familia9=9&categoria9=8" class="selecionado">Aplicación para móviles</a></li>
					<? } else { ?>
					<li><a href="index.php?familia9=9&categoria9=8" class="ff">Aplicación para móviles</a></li>
                    <? } ?>
					<? } ?> 
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos WHERE (familia = 9 OR familia2 = 9 OR familia3 = 9 OR familia4 = 9) AND categoria = 9 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia9']==9) && ($_GET['categoria9']==9)) {?>
					<li><a href="index.php?familia9=9&categoria9=9" class="selecionado"><img src="/img/tel01.png" width="64" height="64"><br>Call</a></li>
                    <? } else { ?>
                    <ul>
                      <li><a href="index.php?familia9=9&categoria9=9" class="ff"><img src="/img/tel02.png" width="64" height="64"><br>Call</a></li>
                    </ul>
                    <? } ?>
					<? } ?>                                         <li><a href="/142/1/6/teleclase-mensual-abril-2019" class="ff">TeleClases</a></li>
</ul>  
</nav2>
<? 
mysql_select_db($database_cone, $cone);
$query_rsb = "SELECT * FROM banner WHERE idioma = '1' ORDER BY orden ASC";
$rsb = mysql_query($query_rsb, $cone) or die(mysql_error());
$row_rsb = mysql_fetch_assoc($rsb);
$totalRows_rsb = mysql_num_rows($rsb);
$i=1;
if ($totalRows_rsb<>0) {
	do {
	
?>
<a href="<? echo $row_rsb['link'];?>" target="<? echo $row_rsb['target'];?>"><img src="http://store.mabelkatz.com/<?php echo substr ($row_rsb['banner'], 0, 250); ?>" border="0" <? if ($i==1) { echo  "style=\"padding-top: 140px;margin-left: 3px;\""; $i++;}?>></a>
<? 
	} while ($row_rsb = mysql_fetch_assoc($rsb));
} ?>
	      </div>
					<div id="cbp-vm8" class="cbp-vm-switcher cbp-vm-view-grid">
					<div class="cbp-vm-options">
<?
if (isset($_GET['categoria'])){
	$tt = $_GET['categoria'];
	mysql_select_db($database_cone, $cone);
	$query_rs_listado = "SELECT * FROM mabel_store_categoria WHERE id = '$tt'";
	$rs_listado = mysql_query($query_rs_listado, $cone) or die(mysql_error());
	$row_rs_listado = mysql_fetch_assoc($rs_listado);
	$totalRows_rs_listado = mysql_num_rows($rs_listado);	
	echo '<span style="font-size: 15px;height: 20px;display: block;float: left;margin-top: 11px;color:#FF3709;">Está viendo <strong>Consultas</strong></span>';
}
?>                    
<table width="80" border="0" cellspacing="0" cellpadding="2" id="tabi">
  <tbody><tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td height="27" align="center" valign="top" background="/img/carro2.png" class="letra01"><? echo $totalpremio4s;?></td>
  </tr>
  <tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td align="center" class="letra02"><p><strong>Shopping Cart</strong><br>    
    <span class="letra03" onclick="location = elimina.php">(vaciar)</span></p></td>
  </tr>
</tbody></table>
<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Vista Grid</a>
<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">Vista Lista</a>
<span style="font-size: 15px;height: 20px;display: block;float: right;margin-top: 11px;color:#323233;" id="mmm03">Cambiar Vista</span>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px; cursor:pointer; color:#323233;" onMouseOver="MM_showHideLayers('smng8','','show')" id="mmm02">Ordenar&nbsp;<img src="/img/fle.jpg" width="21" height="14">&nbsp;|&nbsp;&nbsp;
<div style="position: relative;float: right;top: 40px;right: 15px;">
  <div id="smng8" style="position:absolute;width: 100px;z-index: 10; visibility:hidden;" onMouseOut="MM_showHideLayers('smng8','','hide')" onMouseOver="MM_showHideLayers('smng8','','show')"> 
<table width="100" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tr>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia9=9&orden=1'">Menor precio</p></td>
      </tr>
      <tr>
        <td height="25" align="center" ><p class="kmanu01" onClick="$:location.href='index.php?familia9=8&orden=2'">Mayor precio</p></td>
      </tr>
    </table>
  </div></div><p></p>
<p style="font-size: 15px;  height: 20px;  display: block;  float: right; margin-top: 11px;color:#323233" id="mmm01">
Filtrar por<select name="categoria" class="txt" id="categoria" onchange="location = this.options[this.selectedIndex].value;">
  <option value="index.php" selected="selected" <?php if (!isset($_GET['categoria'])) {echo "selected=\"selected\"";} ?>>Seleccionar</option>
<option value="/ho-oponopono-libros" <?php if (($_GET['categoria']==1) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Libros</option>
<option value="/ho-oponopono-audios-digitales" <?php if (($_GET['categoria']==2) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audios Digitales</option>
<option value="/ho-oponopono-audios-libros" <?php if (($_GET['categoria']==3) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Audio Libros</option>
<option value="/ho-oponopono-ebooks" <?php if (($_GET['categoria']==4) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>eBooks</option>
<option value="/ho-oponopono-videos-digitales" <?php if (($_GET['categoria']==5) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Videos Digitales</option>

<option value="/ho-oponopono-cd-dvd" <?php if (($_GET['categoria']==7) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>CDs &amp; DVDs</option>
<option value="/ho-oponopono-aplicacion-mobiles" <?php if (($_GET['categoria']==8) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Aplicación para móviles</option>
<option value="/ho-oponopono-kindle" <?php if (($_GET['categoria']==9) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Kindle</option>
<option value="/ho-oponopono-llamada-privada" <?php if (($_GET['categoria']==10) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Llamada Privada</option>
<option value="/ho-oponopono-productos-de-paz" <?php if (($_GET['categoria']==11) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>Productos de Paz</option>
<option value="/ho-oponopono-teleclases" <?php if (($_GET['categoria']==6) && (!isset($_GET['familia'])) ) {echo "selected=\"selected\"";} ?>>TeleClases</option>
</select>
</p>
</div>
					<ul>
<?
$ff = '';
$bb = '';
$bb2 = '';

if ($_GET['familia9']<>'') {
	$familia = $_GET['familia9'];
	if ($_GET['familia9']<>'') {
		$categoria = $_GET['categoria9'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	}	
} else {
	$familia = 9;
	if ($_GET['categoria9']<>'') {
		$categoria = $_GET['categoria9'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
		
	}
}
$ff = "(familia = '$familia' OR familia2 = '$familia' OR familia3 = '$familia' OR familia4 = '$familia')";
	mysql_select_db($database_cone, $cone);
	$query_rs_pr = "SELECT * FROM mabel_store_productos WHERE $ff $bb AND stock = '1'  AND idioma = '1' $orf";
	///echo $query_rs_pr;
	$rs_pr = mysql_query($query_rs_pr, $cone) or die(mysql_error());
	$row_rs_pr = mysql_fetch_assoc($rs_pr);
	$totalRows_rs_pr = mysql_num_rows($rs_pr);
	if ($totalRows_rs_pr<>0){
	do {
		$asolo = '';
?>
                        <li>
                        <a class="cbp-vm-image sm" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>"><img src="http://store.mabelkatz.com/admin/<?php echo substr ($row_rs_pr['imagen'], 0, 250); ?>" class="ancho_max_imagen"></a>
                                                <? 
if ($row_rs_pr['categoriamuestra']=='') { 												
if ($row_rs_pr['categoria']==0) { $rubro=""; }													
if ($row_rs_pr['categoria']==1) { $rubro="Libro"; }
if ($row_rs_pr['categoria']==2) { $rubro="Audios Digitales"; }
if ($row_rs_pr['categoria']==3) { $rubro="Audio Libros"; }
if ($row_rs_pr['categoria']==4) { $rubro="eBook"; }
if ($row_rs_pr['categoria']==5) { $rubro="Videos Digitales"; }
if ($row_rs_pr['categoria']==6) { $rubro="Teleclases"; }
if ($row_rs_pr['categoria']==7) { $rubro="CD"; }
if ($row_rs_pr['categoria']==8) { $rubro="Aplicación para móviles"; }
if ($row_rs_pr['categoria']==9) { $rubro="Kindle"; }
if ($row_rs_pr['categoria']==10) { $rubro="Llamada Privada"; }
} else {
$rubro=$row_rs_pr['categoriamuestra']; 
}
echo '<span style="font-size:13px; color:#000">'.$rubro.'</span>';
						?> <h3 class="cbp-vm-title"><? echo strip_tags($row_rs_pr['titulo'],'<em><br>');?></h3>
                        <div class="cbp-vm-price" id='llk'><? if ($row_rs_pr['precio2']<>0) {?>US $<span class="prev"><? $decimales = explode(".",$row_rs_pr['precio2']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio2']);
} else {
echo $row_rs_pr['precio2'];
}
?></span><? $asolo = "Ahora "; ?><? } ?> <? echo $asolo; ?>US $<? $decimales = explode(".",$row_rs_pr['precio']);
if ($decimales[1]==0){
echo round($row_rs_pr['precio']);
} else {
echo $row_rs_pr['precio'];
}
;?></div>
                        <div class="cbp-vm-details">
                        <? echo $row_rs_pr['descripcion'];?>
							</div>
							<? if ($row_rs_pr['buy']==1){?>
<a class="cbp-vm-icon cbp-vm-add" href="ecommerce_derivar.php?vid=<? echo $row_rs_pr['id'];?>">Comprar</a>
<? } ?><? if ($row_rs_pr['descripcionlarga']<>'') {?><a class="cbp-vm-icon cbp-vm-info" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">Más información  </a><? } ?>
							<? if ($row_rs_pr['more']<>'') {?>
                            <a class="cbp-vm-icon cbp-vm-info" href="<? echo strip_tags($row_rs_pr['more']);?>" target="_blank">Más información  </a>
							<? } ?>                                   
						</li>
<? }  while ($row_rs_pr = mysql_fetch_assoc($rs_pr));
	}?>
						
					</ul>
				</div>
					</section>
<section id="section-10">
<div class="tabs2" id="tabsee11">
<nav2>
<ul>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos_free WHERE categoria = 1 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia13']==13) && ($_GET['categoria13']==1) || ($linkcontrol3==1)) {?>
					<li><a href="index.php?familia13=13&categoria13=1" class="selecionado">Video Entrevistas</a></li>
					<? }else { ?>
                    <li><a href="index.php?familia13=13&categoria13=1" class="ff">Video Entrevistas</a></li>
                    <? } ?>
					
					<? } ?>
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos_free WHERE  categoria = 2 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia13']==13) && ($_GET['categoria13']==2)) {?>
					<li><a href="index.php?familia13=13&categoria13=2" class="selecionado">Audio Entrevistas</a></li>
					<? }else { ?>
					<li><a href="index.php?familia13=13&categoria13=2" class="ff">Audio Entrevistas</a></li>
                    <? } ?>                    
					<? } ?>  
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos_free WHERE categoria = 3 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia13']==13) && ($_GET['categoria13']==3)) {?>
					<li><a href="index.php?familia13=13&categoria13=3" class="selecionado">Articulos</a></li>
					<? }else { ?>
					<li><a href="index.php?familia13=13&categoria13=3" class="ff">Articulos</a></li>
                    <? } ?>                    
					<? } ?>                    
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos_free WHERE categoria = 4 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia13']==13) && ($_GET['categoria13']==4)) {?>
					<li><a href="index.php?familia13=13&categoria13=4" class="selecionado">Clases Especiales</a></li>
					<? }else { ?>
					<li><a href="index.php?familia13=13&categoria13=4" class="ff">Clases Especiales</a></li>
                    <? } ?>   
					<? } ?>   
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos_free WHERE categoria = 5 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia13']==13) && ($_GET['categoria13']==5)) {?>
					<li><a href="index.php?familia13=13&categoria13=5" class="selecionado">Mabel with Dr. Ihaleakalá</a></li>
					<? }else { ?>
					<li><a href="index.php?familia13=13&categoria13=5" class="ff">Mabel with Dr. Ihaleakalá</a></li>
					<? } ?>                       
					<? } ?>                       
                    <?
					mysql_select_db($database_cone, $cone);
					$query_rs_ct = "SELECT * FROM mabel_store_productos_free WHERE categoria = 6 AND stock = '1' AND idioma = '1'";
					$rs_ct = mysql_query($query_rs_ct, $cone) or die(mysql_error());
					$row_rs_ct = mysql_fetch_assoc($rs_ct);
					$totalRows_rs_ct = mysql_num_rows($rs_ct);	
					if ($totalRows_rs_ct<>0){				
					?>
                    <? if (($_GET['familia13']==13) && ($_GET['categoria13']==6)) {?>
					<li><a href="index.php?familia13=13&categoria13=6" class="selecionado">Curso Básico en video de Hooponopono</a></li>
					<? }else { ?>
					<li><a href="index.php?familia13=13&categoria13=6" class="ff">Curso Básico en video de Hooponopono</a></li>
					<? } ?>   
					<? } ?>                                           <li><a href="/142/1/6/teleclase-mensual-abril-2019" class="ff">TeleClases</a></li>
</ul>
<nav2>
</div>
<div id="cbp-vm13" class="cbp-vm-switcher cbp-vm-view-grid">
<div class="cbp-vm-options" style="
    margin-top: 20px;
">
<?
if (isset($_GET['categoria13'])){
	$tt = $_GET['categoria13'];
} else {
	$tt = 2;	
}
if ($tt==1 ) { $tthui = "Video Entrevistas";} 
if ($tt==2 ) { $tthui = "Audio Entrevistas";} 
if ($tt==3 ) { $tthui = "Articulos";} 
if ($tt==4 ) { $tthui = "Clases Especiales";} 
if ($tt==5 ) { $tthui = "Mabel with Dr. Ihaleakalá";} 
if ($tt==6 ) { $tthui = "Curso Básico en video de Hooponopono";} 	

	echo '<span style="font-size: 15px;height: 20px;display: block;float: left;margin-top: 11px;color:#FF3709;">Está viendo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="text-decoration: underline;">'.$tthui.'</strong></span>';
?>                    
<table width="80" border="0" cellspacing="0" cellpadding="2" id="tabi">
  <tbody><tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td height="27" align="center" valign="top" background="/img/carro2.png" class="letra01"><? echo $totalpremio4s;?></td>
  </tr>
  <tr onclick="window.open('https://wg148.infusionsoft.com/app/manageCart/showManageOrder','_self')">
    <td align="center" class="letra02"><p><strong>Shopping Cart</strong><br>    
    <span class="letra03" onclick="location = elimina.php">(vaciar)</span></p></td>
  </tr>
</tbody></table>

<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Vista Grid</a>
<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">Vista Lista</a>
<span style="font-size: 15px;height: 20px;display: block;float: right;margin-top: 11px;color:#323233;" id="mmm03">Cambiar Vista</span>
</div>
					<ul>

<?
$ff = '';
$bb = '';
$bb2 = '';

if ($_GET['familia6']<>'') {
	$familia = $_GET['familia6'];
	if ($_GET['familia6']<>'') {
		$categoria = $_GET['categoria13'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	}	
} else {
	$familia = 6;
	if ($_GET['categoria13']<>'') {
		$categoria = $_GET['categoria13'];
		$bb = " AND categoria = '$categoria'";
		$bb2 = $categoria;
	} else {
	if ($linkcontrol6==1) {
		$categoria = 2;
		$bb = "AND categoria = '$categoria'";
		$bb2 = $categoria;		
	}
	}
}
	$ff = "(1=1)";
	mysql_select_db($database_cone, $cone);
	$query_rs_pr = "SELECT * FROM mabel_store_productos_free WHERE $ff $bb AND stock = '1'  AND idioma = '1' $orf";
	$rs_pr = mysql_query($query_rs_pr, $cone) or die(mysql_error());
	$row_rs_pr = mysql_fetch_assoc($rs_pr);
	$totalRows_rs_pr = mysql_num_rows($rs_pr);
	if ($totalRows_rs_pr<>0){
	do {
		$asolo = '';
?>
                        <li>
                        <a class="cbp-vm-image" href="/<? echo $row_rs_pr['id'];?>/<? echo $familia;?>/<? echo $bb2;?>/<? echo text2url(strip_tags($row_rs_pr['titulo']));?>">
                        <? if ($row_rs_pr['categoria']==2) { ?>
                        <img src="/img/mic.png">
                        <? } else { ?>
                        <img src="http://store.mabelkatz.com/admin/<?php echo substr ($row_rs_pr['imagen'], 0, 250); ?>">
                        <? } ?>
                        </a>
                                                <? 
if ($row_rs_pr['categoriamuestra']=='') { 												
if ($row_rs_pr['categoria']==0) { $rubro=""; }													
if ($row_rs_pr['categoria']==1) { $rubro="Video Entrevistas"; }
if ($row_rs_pr['categoria']==2) { $rubro="Audio Entrevistas"; }
if ($row_rs_pr['categoria']==3) { $rubro="Articulos"; }
if ($row_rs_pr['categoria']==4) { $rubro="Clases Especiales"; }
if ($row_rs_pr['categoria']==5) { $rubro="Entrevistas con Ihaleakala"; }
if ($row_rs_pr['categoria']==6) { $rubro="Curso Básico en video de Hooponopono"; }
} else {
$rubro=$row_rs_pr['categoriamuestra']; 
}
echo '<span style="font-size:13px; color:#000">'.$rubro.'</span>';
						?> <h3 class="cbp-vm-title"><? echo strip_tags($row_rs_pr['titulo'],'<em><br>');?></h3>
                        <div class="cbp-vm-price" id='llk'>
						<span class="prev">
						</span></div>
                        <div class="cbp-vm-details" <? if ($row_rs_pr['categoria']==1) { ?>style="height: 170px;"<? } ?><? if ($row_rs_pr['categoria']==2) { ?>style="height: 20px;"<? } ?><? if ($row_rs_pr['categoria']==3) { ?>style="height: 40px;"<? } ?><? if ($row_rs_pr['categoria']==4) { ?>style="height: 10px;"<? } ?><? if ($row_rs_pr['categoria']==5) { ?>style="height: 170px;"<? } ?>>
                        <? echo $row_rs_pr['descripcion'];?>
							</div>
<? if ($row_rs_pr['categoria']==1) { ?>
<a class="cbp-vm-icon cbp-vm-info fancybox-media" href="http://www.youtube.com/watch?v=<? echo $row_rs_pr['video'];?>">Watch Video</a>
<? } ?>
<? if ($row_rs_pr['categoria']==2) { ?>
<a class="cbp-vm-icon cbp-vm-info various" data-fancybox-type="iframe" href="mp3.php?mmm=<? echo $row_rs_pr['archivo'];?>">Listen Now</a>
<? } ?>
<? if ($row_rs_pr['categoria']==3) { ?>
<a class="cbp-vm-icon cbp-vm-info" href="<? echo $row_rs_pr['../archivo'];?>" target="_blank">Read Now</a>
<? } ?>
<? if ($row_rs_pr['categoria']==4) { ?>
<a class="cbp-vm-icon cbp-vm-info" href="https://www.facebook.com/MabelKatzFanPage" target="_blank">Join Now</a>
<? } ?>
<? if ($row_rs_pr['categoria']==5) { ?>
<a class="cbp-vm-icon cbp-vm-info fancybox-media" href="http://www.youtube.com/watch?v=<? echo $row_rs_pr['video'];?>">Watch Video</a>
<? } ?>
							<? if ($row_rs_pr['more']<>'') {?>
                            <a class="cbp-vm-icon cbp-vm-info" href="<? echo strip_tags($row_rs_pr['more']);?>" target="_blank">Más información  </a>
							<? } ?>                                   
						</li>
<? }  while ($row_rs_pr = mysql_fetch_assoc($rs_pr));
	}?>
						
					</ul>
				</div>
</section>                                                                           
			</div><!-- /content -->
		  </div>
		  
<div id="footer" style="    height: 480px;"> 
<a href="#top" id="scroll-top" style="display: none;"></a>

<div style="width:90%; margin-left:auto; margin-right:auto">
<div id="f01">
  <p class="letratitlof">NEWSLETTER<br />
    <br />
    Suscríbete y disfruta de los <strong>5 REGALOS</strong><br />
    que Mabel eligió para tí.</p>
    <form accept-charset="UTF-8" action="https://wg148.infusionsoft.com/app/form/process/b300f82313d6d15e2242a7aeb60b3a0d" class="infusion-form" id="inf_form_b300f82313d6d15e2242a7aeb60b3a0d" method="POST">
    <input name="inf_form_xid" type="hidden" value="b300f82313d6d15e2242a7aeb60b3a0d" />
    <input name="inf_form_name" type="hidden" value="Sign up for newsletter" />
    <input name="infusionsoft_version" type="hidden" value="1.69.0.46385" />
    <!--<div class="infusion-field">-->
    <!--    <label for="inf_field_FirstName" class="letralof">Primer Nombre *</label>-->
    <!--    <br />-->
    <!--    <input class="infusion-field-input-container" id="inf_field_FirstName" name="inf_field_FirstName" type="text" required="required"/>-->
    <!--</div>-->
    <!--<div class="infusion-field">-->
    <!--    <label for="inf_field_Email" class="letralof">Email *<br />-->
    <!--    </label>-->
    <!--    <input class="infusion-field-input-container" id="inf_field_Email" name="inf_field_Email" type="email" required="required" />-->
    <!--</div>-->
    <div class="infusion-field">
<label for="inf_field_FirstName" class="letralof">Nombre *</label> <br>
<input class="infusion-field-input-container" id="inf_field_FirstName" name="inf_field_FirstName" type="text" required style="width: 65%;"/>
</div>
<div class="infusion-field">
<label for="inf_field_FirstName" class="letralof">Apellido *</label> <br>
<input class="infusion-field-input-container" id="inf_field_LastName" name="inf_field_LastName" type="text" required style="width: 65%;" />
</div>
<div class="infusion-field">
<label for="inf_field_phone" class="letralof">Teléfono </label><br>
<input class="infusion-field-input" id="inf_field_Phone1" name="inf_field_Phone1" type="tel" style="width: 65%;">
</div>
<div class="infusion-field">
<label for="inf_field_Email" class="letralof">Email *</label><br>
<input class="infusion-field-input-container" id="inf_field_Email" name="inf_field_Email" type="email" required style="width: 65%;"/>
</div>
    <div class="infusion-field">
<label for="inf_field_Country">País *</label><br>
<select id="inf_field_Country" style="width: 65%;" required="required"
margin-left:47px;" name="inf_field_Country"><option value="">Selecciona uno</option><option value="Afghanistan">Afghanistan</option><option value="Åland Islands">Åland Islands</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas (the)">Bahamas (the)</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia (Plurinational State of)">Bolivia (Plurinational State of)</option><option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian Ocean Territory (the)">British Indian Ocean Territory (the)</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cabo Verde">Cabo Verde</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cayman Islands (the)">Cayman Islands (the)</option><option value="Central African Republic (the)">Central African Republic (the)</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands (the)">Cocos (Keeling) Islands (the)</option><option value="Colombia">Colombia</option><option value="Comoros (the)">Comoros (the)</option><option value="Congo (the Democratic Republic of the)">Congo (the Democratic Republic of the)</option><option value="Congo (the)">Congo (the)</option><option value="Cook Islands (the)">Cook Islands (the)</option><option value="Costa Rica">Costa Rica</option><option value="Côte d'Ivoire">Côte d'Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Curaçao">Curaçao</option><option value="Cyprus">Cyprus</option><option value="Czech Republic (the)">Czech Republic (the)</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic (the)">Dominican Republic (the)</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands (the) [Malvinas]">Falkland Islands (the) [Malvinas]</option><option value="Faroe Islands (the)">Faroe Islands (the)</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories (the)">French Southern Territories (the)</option><option value="Gabon">Gabon</option><option value="Gambia (the)">Gambia (the)</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guernsey">Guernsey</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option><option value="Holy See (the)">Holy See (the)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Isle of Man">Isle of Man</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jersey">Jersey</option><option value="Johnston Island">Johnston Island</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea (the Democratic People's Republic of)">Korea (the Democratic People's Republic of)</option><option value="Korea (the Republic of)">Korea (the Republic of)</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People's Democratic Republic (the)">Lao People's Democratic Republic (the)</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia (the former Yugoslav Republic of)">Macedonia (the former Yugoslav Republic of)</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands (the)">Marshall Islands (the)</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia (Federated States of)">Micronesia (Federated States of)</option><option value="Midway Islands">Midway Islands</option><option value="Moldova (the Republic of)">Moldova (the Republic of)</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands (the)">Netherlands (the)</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger (the)">Niger (the)</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands (the)">Northern Mariana Islands (the)</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestine, State of">Palestine, State of</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines (the)">Philippines (the)</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Réunion">Réunion</option><option value="Romania">Romania</option><option value="Russian Federation (the)">Russian Federation (the)</option><option value="Rwanda">Rwanda</option><option value="Saint Barthélemy">Saint Barthélemy</option><option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Martin (French part)">Saint Martin (French part)</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option><option value="South Sudan">South Sudan</option><option value="Southern Rhodesia">Southern Rhodesia</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan (the)">Sudan (the)</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan (Province of China)">Taiwan (Province of China)</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="Thailand">Thailand</option><option value="Timor-Leste">Timor-Leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands (the)">Turks and Caicos Islands (the)</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates (the)">United Arab Emirates (the)</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="United States Minor Outlying Islands (the)">United States Minor Outlying Islands (the)</option><option value="Upper Volta">Upper Volta</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela (Bolivarian Republic of)">Venezuela (Bolivarian Republic of)</option><option value="Viet Nam">Viet Nam</option><option value="Virgin Islands (British)">Virgin Islands (British)</option><option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>
</div>
    <p style="margin-top: inherit;"><strong style="font-size: 13px;">*Si eres de España selecciona Spain </strong></p>
<div class="infusion-field" style="margin-top: -11px !important;">
  <p class="letralof">¿Deseas suscribirte al boletín gratuito de Mabel Katz y recibir noticias de Ho'oponopono, contenido y anuncios especiales?<br />
           <input id="inf_option_GDPRMarketingOptin" name="inf_option_GDPRMarketingOptin" type="checkbox" value="6154" required>
          <span style="font-size:12px" class="letralof">S&iacute; deseo recibir el noticias e informaci&oacute;n peri&oacute;dica de Mabel Katz.&nbsp;</span></p>
</div>    
    <div class="infusion-submit">
    
        <input type="submit" value="RECIBIR MIS REGALOS" />
    </div>
</form>
<script type="text/javascript" src="https://wg148.infusionsoft.com/app/webTracking/getTrackingCode?trackingId=46459ecec4076e310e903d670229798b"></script>
</div>
<div id="f01">
  <p class="letratitlof">OTROS SITIOS</p>
  <p class="letratitlof"><a href="http://hooponopono-espanol.com/" target="_blank" class="letralof pfp">Ho'oponopono</a></p>
  <p><a href="http://zerofrequency.info/" target="_blank" class="letralof pfp"> Zero Frequency<sup>®</sup></a></p>
  <p><a href="http://pazinteriorespazmundial.com/" target="_blank" class="letralof pfp">Paz interior es paz mundial</a></p>
  <p><a href="http://www.elcaminomasfacilparacrecer.com/" target="_blank" class="letralof pfp">El camino más fácil para crecer</a></p>
  <p><a href="http://elcaminomasfacilparavivir.com/" target="_blank" class="letralof pfp">El camino más fácil para vivir</a></p>
</div>
<div id="f01">
  <p class="letratitlof">CONTACTO</p>
  <p class="letralof">Para más información: (818) 668-2085<br>
    <a href="mailto:support@mabelkatz.com" class="pfp">support@mabelkatz.com</a></p>
  <p class="letralof">Atención al cliente: <a href="http://www.hooponoponoway.net/support/" target="_blank" class="pfp">Haga clic aquí</a></p>
  <p class="letralof">Para problemas técnicos, envíe un email a  <a href="mailto:help@mabelkatz.com" class="pfp">help@mabelkatz.com</a></p>
  <p class="letralof">Medios / charlas :<br>
    Tel:(818) 668-2085<br>
  <a href="mailto:info@mabelkatz.com" class="pfp">info@mabelkatz.com</a></p>
  <p class="letralof">Your Business, Inc.<br>
    PO Box 427<br>
    Woodland Hills, CA 91365-0427<br>
    USA</p>
</div>
<div id="f01">
  <p class="letratitlof">INFORMACION LEGAL</p>
  <p class="letralof"><span style="font-size:12px">Respetamos tu privacidad. Tus datos serán almacenados de manera segura, y no serán vendidos, rentados o compartidos de ninguna forma. Puedes consultar nuestros <a href="terminos.php" target="_blank">Términos de Uso</a> y <a href="privacidad.php" target="_blank">Privacidad</a>. Si deseas más información, puedes contactarnos a través de: <a href="mailto:help@mabelkatz.com">help@mabelkatz.com</a></span><br>
  </p>
  <p class="letratitlof">SOCIAL NETWORKS<br>
</p>
  <table style="display: inline-table;" border="0" cellpadding="0" cellspacing="0" width="216">
    <!-- fwtable fwsrc="Sin título" fwpage="Página 1" fwbase="btn2.jpg" fwstyle="Dreamweaver" fwdocid = "1729464784" fwnested="0" -->
    <tr>
      <td><img src="/img/spacer.gif" alt="" name="undefined_2" width="23" height="1" border="0" /></td>
      <td><img src="/img/spacer.gif" alt="" name="undefined_2" width="35" height="1" border="0" /></td>
      <td><img src="/img/spacer.gif" alt="" name="undefined_2" width="44" height="1" border="0" /></td>
      <td><img src="/img/spacer.gif" alt="" name="undefined_2" width="44" height="1" border="0" /></td>
      
      <td><img src="/img/spacer.gif" alt="" name="undefined_2" width="71" height="1" border="0" /></td>
      <td><img src="/img/spacer.gif" alt="" name="undefined_2" width="43" height="1" border="0" /></td>
      <td><img src="/img/spacer.gif" alt="" name="undefined_2" width="1" height="1" border="0" /></td>
    </tr>
    <tr>
      <td><a href="https://www.facebook.com/MabelKatzFanPage" target="_blank" class="pfp"><img name="btn2_r1_c1" src="/img/btn2_r1_c1.jpg" width="23" height="40" border="0" id="btn2_r1_c1" alt="" /></a></td>
      <td><a href="https://twitter.com/mabelkatz" target="_blank" class="pfp"><img name="btn2_r1_c2" src="/img/btn2_r1_c2.jpg" width="35" height="40" border="0" id="btn2_r1_c2" alt="" /></a></td>
          <td><a href="https://www.instagram.com/mabelkatz/" target="_blank"><img name="btn2_r1_c4" src="/img/instagram.jpg" width="44" height="40" border="0" id="btn2_r1_c4" alt="" /></a></td>

      <td><a href="http://www.youtube.com/mabelkatz" target="_blank" class="pfp"><img name="btn2_r1_c4" src="/img/btn2_r1_c4.jpg" width="71" height="40" border="0" id="btn2_r1_c4" alt="" /></a></td>
      <td><a href="https://www.linkedin.com/in/mabelkatz" target="_blank" class="pfp"><img name="btn2_r1_c5" src="/img/btn2_r1_c5.jpg" width="43" height="40" border="0" id="btn2_r1_c5" alt="" /></a></td>
      <td><img src="/img/spacer.gif" alt="" name="undefined_2" width="1" height="40" border="0" /></td>
    </tr>
  </table>
</div>
</div>

  </div>

<dlaser></dlaser>
<!-- /tabs -->
			
<script src="js/classie.js"></script>

<script src="js/cbpViewModeSwitch.js"></script>
<script src="js/cbpFWTabs.js"></script>
<script>
<? $val = 0;
if (isset($_GET['familia'])) { 
	$val = 0;			 
}
if (isset($_GET['familia2'])) { 
	$val = 1;			 
}
if (isset($_GET['familia3'])) { 
	$val = 2;			 
}
if (isset($_GET['familia4'])) { 
	$val = 3;			 
}
if (isset($_GET['familia5'])) { 
	$val = 5;			 
}
if (isset($_GET['familia6'])) { 
	$val = 6;			 
}
if (isset($_GET['familia7'])) { 
	$val = 4;			 
}
if (isset($_GET['familia8'])) { 
	$val = 7;			 
}
if (isset($_GET['familia9'])) { 
	$val = 8;			 
}
if (isset($_GET['familia13'])) { 
	$val = 9;			 
}
?>
document.getElementById('tabsee2').style.height = '1200px';
			
new CBPFWTabs( document.getElementById( 'tabs' ),{ start : <? echo $val;?> } );
			document.getElementById('loading').style.display = 'none';
<? if ((($_GET['categoria']==2) && (!isset($_GET['familia'])) ) && (!isset($_GET['familia']))) { ?>
document.getElementById('tabsee2').style.height = '3500px';
<? } ?>
<? if (($_GET['familia']==1) && ($_GET['categoria']==2)) { ?>
document.getElementById('tabsee2').style.height = '2500px';
<? } ?>
<? if (($_GET['familia']==1) && ($_GET['categoria']==7)) { ?>
document.getElementById('tabsee2').style.height = '2800px';
<? } ?>
<? if (($_GET['familia']==1) && ($_GET['categoria']==5)) { ?>
document.getElementById('tabsee2').style.height = '2000px';
<? } ?>
<? if (($_GET['familia7']==7) && ($_GET['categoria7']==2)) { ?>
document.getElementById('tabsee6').style.height = '2000px';
<? } ?>
<? if ($_GET['categoria']==5)  { ?>
document.getElementById('tabsee2').style.height = '3000px';
<? } ?>
<? if ($_GET['familia6']==1)  { ?>
document.getElementById('tabsee8').style.height = '2000px';
<? } ?>
<? if (($_GET['familia5']==5) && ($_GET['categoria5']==2)) { ?>
document.getElementById('tabsee2').style.height = '3500px';
<? } ?>
<? if (($_GET['categoria']==2) && ($_GET['t']=='all')) { ?>
document.getElementById('tabsee2').style.height = '4500px';
<? } ?>
<? if (($_GET['familia5']==5) && ($_GET['categoria5']==2)) { ?>
document.getElementById('tabsee7').style.height = '2230px';
<? } ?>
<? if ($_GET['t']=='all') { ?>
$("#vm1").removeClass("tab-current");
<? } ?>

<? if ((isset($_GET['busca'])) || (isset($_GET['busca2'])) || (isset($_GET['busca3'])) || (isset($_GET['busca4'])) || (isset($_GET['busca5'])) || (isset($_GET['busca6'])) || (isset($_GET['busca7'])) || (isset($_GET['busca8']))) { ?>
$("#vm1").removeClass("tab-current");
document.getElementById('tabsee2').style.height = '4500px';
<? } ?>
</script>
</div>

<?php if  ($homef==1) { ?>
<!--FANCY BOX-->
<script type="text/javascript" src="http://elcaminomasfacil.com/navidad/lib/jquery.mousewheel-3.0.6.pack.js"></script>
 <script type="text/javascript" src="http://elcaminomasfacil.com/navidad/source/jquery.fancybox.js?v=2.1.5"></script>
 <link rel="stylesheet" type="text/css" href="http://elcaminomasfacil.com/navidad/source/jquery.fancybox.css?v=2.1.5" media="screen" />
 <link rel="stylesheet" type="text/css" href="http://elcaminomasfacil.com/navidad/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
 <script type="text/javascript" src="http://elcaminomasfacil.com/navidad/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
 <link rel="stylesheet" type="text/css" href="http://elcaminomasfacil.com/navidad/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
 <script type="text/javascript" src="http://elcaminomasfacil.com/navidad/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
 <script type="text/javascript" src="http://elcaminomasfacil.com/navidad/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<style>
.fancybox-wrap, .fancybox-skin, .fancybox-outer, .fancybox-inner, .fancybox-image, .fancybox-wrap iframe, .fancybox-wrap object, .fancybox-nav, .fancybox-nav span, .fancybox-tmp {
    height: 600px;
}

</style>
<!--FIN FANCY BOX-->
    
<script>
 
$(document).ready(function() { 
 $('.fancybox').fancybox();


   $("#fancybox-manual-b").click(function() {
    $.fancybox.open({
		  'href' : '/arg.html',	
		  'type': 'iframe', 
		  'scrolling': 'no', 
		  'width': 600, 
		  'padding'	  : 0,
		  'iframe': {'scrolling': 'no'}
    });
   });
   
   $("#argen").click(function() {
    $.fancybox.open({
		  'href' : 'arg.html',	
		  'type': 'iframe', 
		  'scrolling': 'no', 
		  'width': 600, 
		  'padding'	  : 0,
		  'iframe': {'scrolling': 'no'}
    });
   });
   
    
}); 
  
$(window).load(function() {
   
   
$( "#kklo" ).click(function() {
  $( "#submm" ).show( "slow", function() {
  });
});
 // $('#fancybox-manual-b').trigger('click'); 
 ////
<?php
include("geoiploc.php"); 
  if (empty($_POST['checkip']))
  {
        $ip = $_SERVER["REMOTE_ADDR"]; 
  }
  else
  {
        $ip = $_POST['checkip']; 
  }
  //echo $ip;
//$cAbbr = getCountryFromIP($ip, "AbBr");
//echogetCountryFromIP($ip, "code")

  if ((getCountryFromIP($ip, "code")=="AR") || (getCountryFromIP($ip, "code")=="CL") || (getCountryFromIP($ip, "code")=="UY") || (getCountryFromIP($ip, "code")=="PY")){
?> 
 $('#argen').trigger('click');
 
 
<?php } else { ?> 
  
  
<?php } ?>   
  });
  
  
  
  
    </script>

<? }  else { ?>
<script>
 

$(window).load(function() {
   
   
$( "#kklo" ).click(function() {
  $( "#submm" ).show( "slow", function() {
  });
});
   
  });
    </script>
<? } ?>
<a href="#" id="fancybox-manual-b"></a>
<a href="#" id="argen"></a>

</body>
</html>
<?php
mysql_free_result($rs_cate);
?>