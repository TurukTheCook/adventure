<?php
// error_reporting(0); // override php config for this script
spl_autoload_register(
    function ($class) {
        include $class.'.php';
    }
);

if (!$argv[1]) {
    echo "You must provide a map file.\n";
    die();
}

$config = new Config();
$config->readFile($argv[1]);

/**
 * MAP SEEDING
 */

$map;
$entities = array();
$params = $config->getConfig();

for ($i = 0; $i < count($params); $i++) {
    switch(substr($params[$i][0], 0, 1)) {
        case "C":
            $map = new Map(intval($params[$i][1]), intval($params[$i][2]));
            $map->generateEmptyMap();
            break;
        case "A":
            $aventurier = new Aventurier($params[$i][1], intval($params[$i][2]), intval($params[$i][3]), $params[$i][4], $params[$i][5]);
            $map->populateMap($aventurier->getX(), $aventurier->getY(), $aventurier);
            array_push($entities, $aventurier);
            break;
        case "T":
            $tresor = new Tresor(intval($params[$i][1]), intval($params[$i][2]), intval($params[$i][3]));
            $map->populateMap($tresor->getX(), $tresor->getY(), $tresor);
            array_push($entities, $tresor);
            break;
        case "G":
            $gob = new Gobelin(intval($params[$i][1]), intval($params[$i][2]), intval($params[$i][3]), isset($params[$i][4]) ? intval($params[$i][4]) : null);
            $map->populateMap($gob->getX(), $gob->getY(), $gob);
            array_push($entities, $gob);
            break;
        case "O":
            $orc = new Orc(intval($params[$i][1]), intval($params[$i][2]), intval($params[$i][3]), intval($params[$i][4]));
            $map->populateMap($orc->getX(), $orc->getY(), $orc);
            array_push($entities, $orc);
            break;
        case "M":
            $map->populateMap(intval($params[$i][1]), intval($params[$i][2]), "M");
            break;
        default:
            break;
    }
}

$config->setEntities($entities);
$entities = null;
$params = null;

/**
 * GAME LOOP
 */

// $mouvLen = array();
// $entities = $config->getEntities();

// for ($i = 0; $i < count($entities); $i++) {
//     if (substr($entities[$i]->getDisplay(), 0, 1) == "A") {
//         $mouvLen = strlen($entities[$i]->getSeqMouvements());
//         break;
//     }
// }

// for ($i = 0; $i <= $mouvLen; $i++) {
//     // TODO: iterate through entities and move hero / monsters
// }

$map->displayMap();

?>