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
JOIN ". ENTREPRISE ." e ON o.". ID_ENTREPRISE ." = e.". ID_ENTREPRISE ."
WHERE o.". ID_OFFRE ." = 2";




$image = $user[FIELD_IMAGE] ?? '';



$result = mysqli_query($conn, $query);


// Вариант 1: одна строка
$offre = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<body>
    <style>
        .offres{
            display:flex;
            
        }
    </style>


<table>
    <thead>
        <tr>
            <th>
                <span id="label-<?php echo INTITULE; ?>">
                    <span id="<?php echo INTITULE; ?>-value"></span>
                </span>
            </th>

            <th>
                <span id="label-<?php echo LOCALISATION; ?>">
                    Ville :<br> <span id="<?php echo LOCALISATION; ?>-value"></span>
                </span>
            </th>
        </tr>
    </thead>
</table>

</body>
</html>
<script>
let offre = <?php echo json_encode($offre); ?>;

document.getElementById('<?php echo FIELD_NAME; ?>-value').textContent = offre["<?php echo FIELD_NAME; ?>"];
document.getElementById('<?php echo INTITULE; ?>-value').textContent = offre["<?php echo INTITULE; ?>"];
document.getElementById('<?php echo FIELD_APROPOS_OFFRE; ?>-value').textContent = offre["<?php echo FIELD_APROPOS_OFFRE; ?>"];
document.getElementById('<?php echo RENUMERATION; ?>-value').textContent = offre["<?php echo RENUMERATION; ?>"];
document.getElementById('<?php echo LOCALISATION; ?>-value').textContent = offre["<?php echo LOCALISATION; ?>"];

    

</script>