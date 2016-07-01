<?php 
include_once("sqlite.php");
include('error.php');

date_default_timezone_set('Asia/Kolkata');

/**
    * @brief generate a select list of available strains.
    *
    * @return  A html SELECT list.
 */
function getListOfStrains( $selected_strain = NULL )
{
    if( ! $selected_strain )
        $html = "<select name=\"animal_strain\"> 
        <option disabled selected value> -- select an option -- </option>"
        ;
    else
        $html = "<select name=\"animal_strain\">"; 

    $listOfStrain = $_SESSION['conf']['animal']['strain'];
    foreach( $listOfStrain as $strain )
    {
        $html .= '<option value="' . $strain . "\" ";
        $html .= ($strain == $selected_strain) ? "\"selected\"" : " ";
        $html .=  '>' . $strain . "</option>";
    }
    $html .= "</select>";
    return $html;
}

function cageIdsToHtml( $type = "breeder", $default = NULL )
{
    if( ! $default )
        $html = "<select name=\"cage\"> 
            <option disabled selected value> -- select an option -- </option>"
            ;
    else
        $html = "<select name=\"cage\">";

    $cages = get_list_of_cages( $type );

    foreach( $cages as $id )
        $html .= '<option value="'.$id.'">' . ($id) . '</option>';

    $html .= "</select>";
    return $html;
}

function animalListToHtml( $animals )
{
    $html = "<select name=\"animal_id\"> 
        <option disabled selected value> -- select an animal -- </option>"
        ;
    foreach( $animals as $anim )
    {
        $text = $anim['id'] . ' ' . $anim['name'];
        $html .= '<option value="' . $anim['id'] . '">' . $text . '</option>';
    }

    $html .= "</select>";
    return $html;
}

function animalsToDataList( $animals )
{
    $html = "<datalist id=\"animal_list\">";
    foreach( $animals as $anim )
    {
        $text = $anim['id'] . ' ' . $anim['name'];
        $html .= '<option value="' . $anim['id'] . '">' . $text . '</option>';
    }

    $html .= "</datalist>";
    return $html;
}

function generateRandomString($length = 10) 
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

/* Go to a page */
function goToPage($page="index.php", $delay = 3)
{
  echo printWarning("... Going to page $page in $delay seconds ...");
  $conf = $_SESSION['conf'];
  $url = $conf['global']['base_url']."/".$page;
  header("Refresh: $delay, url=$url");
}

?>
