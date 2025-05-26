<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

$offres = [];
while($row = mysqli_fetch_assoc($result)){
    $offres[] = $row;
}




// Вариант 1: одна строка
$favorisResult = mysqli_query($conn, "SELECT id_offre FROM favoris WHERE id_etudiant = 1");
$favoris = [];
while($fav = mysqli_fetch_assoc($favorisResult)) {
    $favoris[] = $fav['id_offre'];
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
const ID_OFFRE = "<?php echo ID_OFFRE; ?>";
const FIELD_NAME = "<?php echo FIELD_NAME; ?>";
const INTITULE = "<?php echo INTITULE; ?>";
const LOCALISATION = "<?php echo LOCALISATION; ?>";

let offres = <?php echo json_encode($offres); ?>;
let favoris = <?php echo json_encode($favoris); ?>;

const container = document.getElementById("offres-container");
favoris = favoris.map(f => parseInt(f));
offres.forEach(offre => {
    const div = document.createElement("div");
    div.classList.add("offre");

    const offerId = parseInt(offre["<?php echo ID_OFFRE; ?>"]);
    const isFavori = favoris.includes(offerId);
    const buttonFavoris = isFavori ? "Retirer des favoris" : "Ajouter aux favoris";

    div.innerHTML = `
        <strong>Entreprise :</strong> ${offre['<?php echo FIELD_NAME;?>']}<br>
        <strong>Titulaire :</strong> ${offre['<?php echo INTITULE;?>']}<br>
        <strong>Localisation :</strong> ${offre['<?php echo LOCALISATION;?>']}<br>
        <a href='../view/homeOffre.php?id=${offerId}' >Voir la description du poste</a><br>
        <strong>ID :</strong>${offerId}<br>
        
        <form action='../Composant/tableauDeBord-be/favoris.php' method='POST'>
            <input type='hidden' name='id_offre' value='${offerId}'>
            <button type='submit'>${buttonFavoris}</button>
        </form>
    `;
    container.appendChild(div);
});
</script>

</body>
</html>
