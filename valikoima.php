<html>   
<head>  
<meta charset="utf-8"> 
<title>Rengashaku</title> 
<link rel="icon" type="image/x-icon" href="favicon.ico">
<link rel="stylesheet" href="muotoilu.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Racing+Sans+One">
</head> 
<body>
<div class="wrapper">

<header class="header">
<img src="logo_dark.jpg" alt="Mustat Renkaat-Logo">
<nav class="navigation">
<a href="index.html" target="">Etusivu</a>
<a href="valikoima.php" target="">Rengashaku</a>
<a href="tiedot.html" target="">Yhteystiedot</a>
</nav>
</header>

<article class="main">
<h1>Tervetuloa rengashakuun!</h1>

<form id="rengashaku" action="" method="POST">

<p>Valitse etsimiesi renkaiden koko ja klikkaa nappia:</p>

<select name="koko" id="koko">

 <?php 
	$palvelin= "localhost";  
	$kayttajanimi= "root";  
	$salasana= "";  
	$tietokanta= "jp"; 
	$portti="3306"; 
	
	// Luodaan yhteys tietokantaan.

	$conn = mysqli_connect($palvelin, $kayttajanimi, $salasana, $tietokanta, $portti);  

	// Testi.

	if ($conn->connect_error) {
	die("Yhteys epaonnistui: " . $conn->connect_error);
	}	
	
	// Haetaan kaikki renkaiden koot tietokannasta.
	
    $query = "SELECT Koko FROM renkaat";
	$query_run = mysqli_query($conn,$query);

	// Käydään koot yksitellen läpi ja laitetaan select-valikkoon.
	
	while ($row = mysqli_fetch_array($query_run)) 
		{
		$koko = $row['Koko'];

		echo "<option value=$row[Koko]>$row[Koko]</option>";
		} 
		?>
		
</select>


<input type="submit" name="search" value="Hae!">
</form>

<!-- Pohja taulukon tuloksille: -->

<table id="renkaat">
<tr>
<th>Merkki</th>
<th>Malli</th>
<th>Tyyppi</th>
<th>Koko</th>
<th>Hinta</th>
<th>Saldo</th>
</tr>
<br>

<?php  

// Luodaan uusi yhteys tietokantaan.

$conn = mysqli_connect($palvelin, $kayttajanimi, $salasana, $tietokanta, $portti);  

// Testi.

if ($conn->connect_error) {
  die("Yhteys epaonnistui: " . $conn->connect_error);
}  

// Hakupainiketta klikatessa aloitetaan haku:
if(isset($_POST['search']))
	{
	
	// Koko tulee select-valikosta
	$koko = $_POST["koko"];

	// Hakulause
	$query = "SELECT * FROM renkaat WHERE Koko ='".$koko."'";
	$query_run = mysqli_query($conn,$query);
	
	// Käydään tulokset läpi ja täytetään taulukko niillä.
	
	while ($row = mysqli_fetch_array($query_run)) 
	{
		
		?>
		
		<tr>
		<td><?php echo $row['Merkki'];?> </td>
		<td><?php echo $row['Malli'];?> </td>
		<td><?php echo $row['Tyyppi'];?> </td>
		<td><?php echo $row['Koko'];?> </td>
		<td><?php echo $row['Hinta'];?> </td>
		<td><?php echo $row['Saldo'];?> </td>
		</tr>
		
		<?php
    }
	
	}	

   ?>
   
</table>

<!--Lajittelunapit (funktiot alempana)-->
<p><button class="btn" onclick="lajitteleMerkki()">Järjestä merkin mukaan</button> 
<button class="btn" onclick="lajitteleHinta()">Järjestä hinnan mukaan</button></p>

</article>


<aside class="aside aside-1">

<img src="tools.jpg" alt="Työkalupakki" width=400px;>

</aside>

<aside class="aside aside-2">

<img src="töis.jpg" alt="Mies töissä autohuoltamossa" width=400px;>

</aside>

<footer class="footer">
<p>Mustapään Auto Oy</p>
</footer>

</div>

<script type="text/javascript">

// Kiitos w3schools

 function lajitteleMerkki() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("renkaat");
  switching = true;
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      // Check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        // If so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
} 

function lajitteleHinta() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("renkaat");
  switching = true;
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[4];
      y = rows[i + 1].getElementsByTagName("TD")[4];
      // Check if the two rows should switch place:
	  if (Number(x.innerHTML) > Number(y.innerHTML)) {
		shouldSwitch = true;
		break;
		}
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
} 


</script>
  

</body>
</html>