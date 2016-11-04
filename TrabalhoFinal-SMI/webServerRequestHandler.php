<?php
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] < 0) {
            header("Location: " . $baseNextUrl . "index.php?w=1");
            exit;
        }
    } else {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
}


$flags[] = FILTER_NULL_ON_FAILURE;
$wsdl = filter_input(INPUT_GET, 'wsdl', FILTER_SANITIZE_URL, $flags);
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT, $flags);
$method = filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING, $flags);

if ($wsdl === null || $id === null || $method === null) {
    echo "Invalid arguments.";
    echo "<br><hr><a href=\"javascript: history.go(-1)\">Back</a>";
    exit();
}

$args = array('identifier' => $id);
$options = array('cache_wsdl' => WSDL_CACHE_NONE,);

try {
    $voteProxy = new SoapClient($wsdl, $options);
    $resultAsObject = $voteProxy->$method($args);
} catch (SoapFault $e) {
    echo "Could not execute WS. Cause:<br>\n";
    echo $e->faultstring . "<br>\n";
    echo $e->getTraceAsString() . "<br>\n";
    exit;
}

$result = $resultAsObject->return;


echo $result
?>
