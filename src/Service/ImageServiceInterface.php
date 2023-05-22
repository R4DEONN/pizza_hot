<?php
declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ImageServiceInterface
{
    public function moveImageToUploadsAndGetPath(UploadedFile $file): ?string;

    public function getUploadUrlPath(string $fileName): string;
}