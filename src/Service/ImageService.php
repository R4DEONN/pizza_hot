<?php
declare(strict_types=1);

namespace App\Service;

class ImageService implements ImageServiceInterface
{
    private const UPLOADS_PATH = DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads';

    private const ALLOWED_MIME_TYPES_MAP = [
        'image/jpeg' => '.jpg',
        'image/png' => '.png',
        'image/webp' => '.webp',
    ];

    public function moveImageToUploads(array $fileInfo): ?string
    {
        if ($fileInfo['error'] === UPLOAD_ERR_NO_FILE)
        {
            return null;
        }

        $fileName = $fileInfo['name'];
        $fileType = $fileInfo['type'];
        $imageExt = self::ALLOWED_MIME_TYPES_MAP[$fileType] ?? null;

        if (!$imageExt)
        {
            throw new InvalidArgumentException("File '$fileName' is not an image");
        }

        $destFileName = uniqid('image', true) . $imageExt;
        return $this->moveFileToUploads($fileInfo, $destFileName);
    }

    public function getUploadUrlPath(string $fileName): string
    {
        return "/uploads/$fileName";
    }

    private function getUploadPath(string $fileName): string
    {
        $uploadPath = dirname(__DIR__, 2) . self::UPLOADS_PATH;
        if (!$uploadPath || !is_dir($uploadPath))
        {
            throw new RuntimeException('Invalid uploads path: ' . self::UPLOADS_PATH);
        }

        return $uploadPath . DIRECTORY_SEPARATOR . $fileName;
    }

    private function moveFileToUploads(array $fileInfo, string $destFileName): string
    {
        $fileName = $fileInfo['name'];
        $destPath = $this->getUploadPath($destFileName);
        $srcPath = $fileInfo['tmp_name'];

        if (!@move_uploaded_file($srcPath, $destPath))
        {
            throw new RuntimeException("Failed to uploads file $fileName");
        }

        return $destFileName;
    }
}
