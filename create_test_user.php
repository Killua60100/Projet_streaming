<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=sitestreaming", "root", "");
    
    // Create a test user with known credentials
    $email = "test@example.com";
    $password = "password123";
    $name = "Test User";
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    // Check if user exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $existing = $stmt->fetch();
    
    if ($existing) {
        echo "User already exists\n";
    } else {
        // Insert test user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, is_admin, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
        $stmt->execute([$name, $email, $hashedPassword, 0]);
        echo "Test user created!\n";
        echo "Email: " . $email . "\n";
        echo "Password: " . $password . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
