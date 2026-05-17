<?php

namespace Database\Seeders\Concerns;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

trait SeedsRemoteMedia
{
    protected function downloadToPublic(string $url, string $relativePath): ?string
    {
        $fullPath = public_path($relativePath);
        $directory = dirname($fullPath);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        if (file_exists($fullPath) && filesize($fullPath) > 0) {
            return $relativePath;
        }

        try {
            $response = Http::timeout(60)->retry(2, 500)->get($url);

            if ($response->successful()) {
                file_put_contents($fullPath, $response->body());

                return $relativePath;
            }

            $this->command?->warn("Download failed ({$response->status()}): {$url}");
        } catch (\Throwable $exception) {
            $this->command?->warn("Download failed: {$url} — {$exception->getMessage()}");
        }

        return null;
    }

    protected function downloadToStorage(string $url, string $path): ?string
    {
        if (Storage::disk('public')->exists($path) && Storage::disk('public')->size($path) > 0) {
            return $path;
        }

        try {
            $response = Http::timeout(60)->retry(2, 500)->get($url);

            if ($response->successful()) {
                Storage::disk('public')->put($path, $response->body());

                return $path;
            }

            $this->command?->warn("Download failed ({$response->status()}): {$url}");
        } catch (\Throwable $exception) {
            $this->command?->warn("Download failed: {$url} — {$exception->getMessage()}");
        }

        return null;
    }
}
