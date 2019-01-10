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
$mapIsPresent = false;

for ($i = 0; $i < count($params); $i++) {
    if (substr($params[$i][0], 0, 1) == "C") {
        $map = new Map(intval($params[$i][1]), intval($params[$i][2]));
        $map->generateEmptyMap();
        $mapIsPresent = true;
    }
}

if (!$mapIsPresent) {
    echo "No map definition in the mapfile, please review it and add a map.";
    die();
}

for ($i = 0; $i < count($params); $i++) {
    switch(substr($params[$i][0], 0, 1)) {
        case "A":
            $aventurier = new Aventurier($params[$i][1], intval($params[$i][2]), intval($params[$i][3]), $params[$i][4], $params[$i][5]);
            $map->populateMap($aventurier->getX(), $aventurier->getY(), $aventurier);
            array_push($entities, $aventurier);
            break;
        case "T":
            $tresor = new Tresor(intval($params[$i][1]), intval($params[$i][2]), intval($params[$i][3]));
            $map->populateMap($tresor->getX(), $tresor->getY(), $tresor);
            break;
        case "G":
            $gob = new Gobelin(intval($params[$i][1]), intval($params[$i][2]), intval($params[$i][3]), isset($params[$i][4]) ? intval($params[$i][4]) : null);
            $map->populateMap($gob->getX(), $gob->getY(), $gob);
            array_push($entities, $gob);
            break;
        case "O":
            $orc = new Orc(intval($params[$i][1]), intval($params[$i][2]), intval($params[$i][3]), isset($params[$i][4]) ? intval($params[$i][4]) : null);
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

// Get max mouvement sequence from adventurers
$mouvLen = array();
$entities = $config->getEntities();

for ($i = 0; $i < count($entities); $i++) {
    if (substr($entities[$i]->getDisplay(), 0, 1) == "A") {
        array_push($mouvLen, strlen($entities[$i]->getSeqMouvements()));
    }
}
$mouvMax = max($mouvLen);

// display map before mouvements
echo "Map initial state:\n";
$map->displayMap();
sleep(2);

// iterate through entities and move adventurers / monsters
for ($i = 0; $i < $mouvMax; $i++) {
    for ($j = 0; $j < count($entities); $j++) {
        $entities[$j]->move($map);
    }
    echo "Round: ".$i."\n";
    $map->displayMap();
    echo "\n";
    sleep(2);
}

?>