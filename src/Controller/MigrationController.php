<?php
declare(strict_types=1);

namespace App\Controller;

define('STDIN',fopen("php://stdin","r"));


use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

class MigrationController extends AbstractController
{

    public static function migrate(): Response
    {
        $app = new Application($this->get('kernel'));
        $app->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'doctrine:migration:migrate'
        ]);

        $output = new BufferedOutput();
        $app->run($input, $output);

        $content = $output->fetch();

        return new Response($content);
    }
}