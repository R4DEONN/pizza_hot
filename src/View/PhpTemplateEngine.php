<?php
declare(strict_types=1);

namespace App\View;

class PhpTemplateEngine
{
    private const TEMPLATES_DIR = __DIR__ . "/../../templates";

    public static function render(string $templateName, array $vars = []): string
    {
        $templatePath = self::TEMPLATES_DIR . "/" . $templateName;
        
        if (!ob_start())
        {
            throw new \RuntimeException("Failed to render '$templateName': ob_start() failed");
        }
        try
        {
            self::requireTemplate($templatePath, $vars);
            $contents = ob_get_contents();
        }
        finally
        {
            ob_end_clean();
        }

        return $contents;
    }

    private static function requireTemplate(string $phpTemplatePath, array $phpTemplateVariables): void
    {
        extract($phpTemplateVariables, EXTR_SKIP);
        require($phpTemplatePath);
    }
}