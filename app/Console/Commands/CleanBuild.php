<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanBuild extends Command
{
    protected $signature = 'build:clean';
    protected $description = 'Xóa các file được tạo bởi npm run build';

    public function handle()
    {
        $buildPaths = [
            public_path('build'),
            public_path('js'),
            public_path('css'),
        ];

        foreach ($buildPaths as $path) {
            if (is_dir($path) || is_file($path)) {
                exec("rm -rf " . escapeshellarg($path));
                $this->info("Deleted: {$path}");
            } else {
                $this->info("Path does not exist: {$path}");
            }
        }

        $this->info('Dọn dẹp thành công!');
    }
}
