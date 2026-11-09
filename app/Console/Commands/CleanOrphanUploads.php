<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use App\Models\CreatorProfile;
use Illuminate\Support\Facades\File;

class CleanOrphanUploads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:clean-orphans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bersihkan berkas upload yatim (orphaned files) yang tidak lagi terhubung ke database untuk menghemat storage VPS';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai pemindaian berkas di direktori public/uploads...');

        // 1. Ambil semua path gambar yang aktif di database
        $activeImages = [];

        $projectImages = Project::pluck('image')->filter()->toArray();
        foreach ($projectImages as $img) {
            $activeImages[] = ltrim($img, '/');
        }

        $creator = CreatorProfile::first();
        if ($creator) {
            if ($creator->image) {
                $activeImages[] = ltrim($creator->image, '/');
            }
            if ($creator->lanyard_image) {
                $activeImages[] = ltrim($creator->lanyard_image, '/');
            }
        }

        $activeImages = array_unique($activeImages);

        $directories = [
            public_path('uploads/projects'),
            public_path('uploads/creator'),
        ];

        $deletedCount = 0;
        $freedBytes = 0;

        foreach ($directories as $dir) {
            if (!File::isDirectory($dir)) {
                continue;
            }

            $files = File::files($dir);

            foreach ($files as $file) {
                $relativePath = 'uploads/' . basename($dir) . '/' . $file->getFilename();

                if (!in_array($relativePath, $activeImages)) {
                    $fileSize = $file->getSize();
                    File::delete($file->getRealPath());
                    $deletedCount++;
                    $freedBytes += $fileSize;
                    $this->line("Dihapus berkas tak terpakai: {$relativePath} (" . round($fileSize / 1024, 2) . " KB)");
                }
            }
        }

        $freedMB = round($freedBytes / (1024 * 1024), 2);
        $this->info("Pembersihan selesai! {$deletedCount} berkas yatim dihapus. Storage VPS berhasil dihemat sebesar {$freedMB} MB.");

        return Command::SUCCESS;
    }
}
