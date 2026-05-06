<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=sitestreaming", "root", "");
    
    // Add is_admin column if it doesn't exist
    $stmt = $pdo->query("SHOW COLUMNS FROM users LIKE 'is_admin'");
    if ($stmt->rowCount() === 0) {
        $pdo->exec("ALTER TABLE users ADD COLUMN is_admin BOOLEAN DEFAULT 0 AFTER password");
        echo "Added is_admin column\n";
    }
    
    // Create a test user
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
        $stmt = $pdo->prepare("INSERT INTO users (name, email, is_admin, password, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
        $stmt->execute([$name, $email, 0, $hashedPassword]);
        echo "Test user created!\n";
        echo "Email: " . $email . "\n";
        echo "Password: " . $password . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
