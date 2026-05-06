<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateCommentsTables extends Command
{
    protected $signature = 'create:comments-tables';
    protected $description = 'Create comments and likes tables';

    public function handle()
    {
        try {
            DB::statement('DROP TABLE IF EXISTS comments');
            DB::statement('DROP TABLE IF EXISTS likes');
            
            DB::statement('CREATE TABLE likes (
              id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              user_id BIGINT UNSIGNED NOT NULL,
              imdb_id VARCHAR(20) NOT NULL,
              created_at TIMESTAMP NULL,
              updated_at TIMESTAMP NULL,
              UNIQUE KEY likes_user_id_imdb_id_unique (user_id, imdb_id),
              INDEX idx_user_id (user_id),
              INDEX idx_imdb_id (imdb_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
            
            $this->info('Likes table created successfully!');
            
            DB::statement('CREATE TABLE comments (
              id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              user_id BIGINT UNSIGNED NOT NULL,
              imdb_id VARCHAR(20) NOT NULL,
              content LONGTEXT NOT NULL,
              created_at TIMESTAMP NULL,
              updated_at TIMESTAMP NULL,
              KEY comments_imdb_id_index (imdb_id),
              KEY comments_user_id_index (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
            
            $this->info('Comments table created successfully!');
            
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
