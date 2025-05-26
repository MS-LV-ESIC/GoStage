<?php 

require_once("../db.php");
require_once("../fieldsNames.php");



$query = "SELECT 
  o.". ID_OFFRE ." AS ". ID_OFFRE .",
  o.". INTITULE ." AS ". INTITULE .",
  o.". RENUMERATION ." AS ". RENUMERATION .",
  o.". FIELD_APROPOS_OFFRE ." AS ". FIELD_APROPOS_OFFRE .",
  o.". LOCALISATION ." AS ". LOCALISATION .",


  e.". ID_ENTREPRISE ." AS ". ID_ENTREPRISE .",
  e.". FIELD_NAME ." AS ". FIELD_NAME .",
  e.". FIELD_EMAIL ." AS ". FIELD_EMAIL ."
FROM ". OFFRES ." o
JOIN ". ENTREPRISE ." e ON o.". ID_ENTREPRISE ." = e.". ID_ENTREPRISE;





$image = $user[FIELD_IMAGE] ?? '';




$result = mysqli_query($conn, $query);


// Вариант 1: одна строка
$offres = [];

while($row = mysqli_fetch_assoc($result)){
    $offres[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<body>
    <style>
        .offres{
            display:flex;
            
        }
    </style>

        <h2>Liste des Offres</h2>
        <div id="offres-container"></div>



<script>







let offres = <?php echo json_encode($offres);?>;
const container = document.getElementById("offres-container")

offres.forEach(offre => {
    const div = document.createElement("div");
    div.classList.add("offre");
    div.innerHTML = `
        <strong>Entreprise :</strong> ${offre['<?php echo FIELD_NAME;?>']}<br>
        <strong>Titulaire :</strong> ${offre['<?php echo INTITULE;?>']}<br>
        <strong>Localisation :</strong> ${offre['<?php echo LOCALISATION?>']}<br>
        <a href='../view/homeOffre.php?id=${offre['<?php echo ID_OFFRE?>']}' >Voir la description du poste</a><br>
        <strong>ID :</strong>${offre['<?php echo ID_OFFRE?>']}
        
        <form action='../Composant/tableauDeBord-be/favoris.php' method='POST'>
            <input type='hidden' name='id_offre' value='${offre["id_offre"]}'>
            <button type='submit'>mettre en favoris</button>
        </form>
    `;
    container.appendChild(div);
});

    

</script>

</body>
</html>
