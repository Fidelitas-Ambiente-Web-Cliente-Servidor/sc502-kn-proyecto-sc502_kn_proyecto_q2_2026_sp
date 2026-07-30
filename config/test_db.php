<?php
require_once 'database.php';

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    if ($conn) {
        echo "sirve la base de datos";
    } else {
        echo "no sirve";
    }
} catch (Exception $e) {
    echo "no sirve:";
    echo "Error: " . $e->getMessage();
}
?>