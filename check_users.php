<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=sitestreaming", "root", "");
    
    $stmt = $pdo->query("SELECT id, name, email, password FROM users LIMIT 5");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($users) > 0) {
        echo "=== Users in Database ===\n";
        foreach ($users as $user) {
            echo "ID: " . $user["id"] . " | Name: " . $user["name"] . " | Email: " . $user["email"] . "\n";
            echo "Password Hash: " . substr($user["password"], 0, 20) . "...\n\n";
        }
    } else {
        echo "No users found\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
