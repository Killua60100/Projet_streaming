<?php
require __DIR__ . '/bootstrap/app.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    // Drop tables if they exist
    DB::statement('DROP TABLE IF EXISTS comments');
    DB::statement('DROP TABLE IF EXISTS likes');
    
    // Create likes table
    DB::statement('CREATE TABLE likes (
      id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      user_id BIGINT UNSIGNED NOT NULL,
      imdb_id VARCHAR(20) NOT NULL,
      created_at TIMESTAMP NULL,
      updated_at TIMESTAMP NULL,
      UNIQUE KEY likes_user_id_imdb_id_unique (user_id, imdb_id),
      FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
      INDEX idx_imdb_id (imdb_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
    
    echo "Likes table created successfully!\n";
    
    // Create comments table
    DB::statement('CREATE TABLE comments (
      id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      user_id BIGINT UNSIGNED NOT NULL,
      imdb_id VARCHAR(20) NOT NULL,
      content LONGTEXT NOT NULL,
      created_at TIMESTAMP NULL,
      updated_at TIMESTAMP NULL,
      KEY comments_imdb_id_index (imdb_id),
      FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
    
    echo "Comments table created successfully!\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
