<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=sitestreaming", "root", "");
    
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "=== Tables in sitestreaming ===\n";
    foreach ($tables as $table) {
        echo "- " . $table . "\n";
    }
    
    echo "\n=== Checking users table ===\n";
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Users count: " . $result['count'] . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
