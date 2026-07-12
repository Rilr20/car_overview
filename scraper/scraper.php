<?php
declare(strict_types=1);
require_once __DIR__ . "/../src/car.php";
require_once __DIR__ . '/../sql/create.php';
require_once __DIR__ . '/../src/normalisation.php';
function getAllUrls() {

$URL = "https://bilweb.se/sok?query=&type=1&limit=1000&scrollid=12787640";

$html = file_get_contents($URL);

$start = stripos($html, 'id="vehicle_card"');
// echo $start;
$end = stripos($html, '<!-- .tabs-panel -->', $start);

$length = $end - $start;

$htmlselection  = substr($html, $start,$length);

// echo $htmlselection;

$dom = new DOMDocument();
libxml_use_internal_errors(true);

$dom->loadHTML('<?xml encoding="utf-8" ?>' . $htmlselection);

$xpath = new DOMXPath($dom);

$links = $xpath->query("//a[contains(@class, 'go_to_detail')]");

echo "Found " . $links->length . " vehicles.\n";


$CAR_URL = [];
foreach($links as $link) {
    $url = $link->getAttribute('href');
    array_push($CAR_URL, $url);
}


return $CAR_URL;
}

function getCarInfo($url) {
    //description xpath    //p[contains(@class, 'viewDescription')]

    //info box    xpath    //ul[contains(@class, 'List--horizontal')]//li

    $car = new Car();
    $car->url = $url;
    $html = file_get_contents($url);


    $dom = new DOMDocument();
    libxml_use_internal_errors(true);

    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);

    $xpath = new DOMXPath($dom);

    $description = $xpath->query("//p[contains(@class, 'viewDescription')]")->item(0);
    // $description->
    // var_dump($description->nodeValue);
    // echo $description->nodeValue . " \n";
    
    $car->description = $description->nodeValue ?? null;


    $infoBox = $xpath->query("//ul[contains(@class, 'List--horizontal')]//li");
    $specs = [];
    foreach($infoBox as $item) {
        $labelNode = $xpath->query(".//h5", $item)->item(0);
        $valueNode = $xpath->query(".//p", $item)->item(0);

        if ($labelNode && $valueNode) {

            $label= trim($labelNode->nodeValue);
            $value= trim($valueNode->nodeValue);
            $specs[$label] = $value;
        }
    }
    // var_dump($specs);
    // foreach ($specs as $key => $value) {
    //     echo $key . "      =>    " . $value . " \n";
    // }
    // var_dump($car);
    $car->reg_number    = $specs['Regnummer'] ?? null;
    $car->brand         = $specs['Märke'] ?? null;
    $car->model         = $specs['Modell'] ?? null;
    $car->vehicle_type  = $specs['Fordonstyp'] ?? null;
    $car->gearbox       = $specs['Växellåda'] ?? null;
    $car->fuel_type     = $specs['Drivmedel'] ?? null;
    $car->location      = $specs['Ort'] ?? null;


    $car->model_year       = filter_var($specs['Årsmodell'] ?? null, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
    $car->horsepower       = filter_var($specs['Hästkrafter'] ?? null, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE); 
    
    $car->mileage          = normaliseMileage($specs['Mil'] ?? null);
    $car->acceleration      = normaliseAcceleration($specs['0-100km/h'] ?? null);
    $car->fuel_consumption  = normaliseFuelConsumption($specs['Förbrukning'] ?? null);

    return $car;
}

$urls = getAllUrls();

foreach ($urls as $url) {
    echo $url . " \n";
    $car = getCarInfo($url);
    // var_dump($car);
    createCar($car, $conn);
}

// getCarInfo("");