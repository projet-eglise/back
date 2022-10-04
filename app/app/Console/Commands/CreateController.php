<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ddd-controller {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a DDD Controller with my structure file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rawName = $this->argument('name');
        $splitedName = explode('/', $rawName);

        // Verifies that a module has been provided
        $hasNamespace = count($splitedName) === 2;
        if (!$hasNamespace)
            return $this->stopCommandHere("No namespace has been provided (the name must have the form namespace/controller-name)");

        // Check empty namespace
        $namespace = $splitedName[0];
        if ($namespace === '')
            return $this->stopCommandHere("Invalid namespace");

        // Check empty name
        $name = end($splitedName);
        if ($name === '')
            return $this->stopCommandHere("Invalid namespace");

        // Checks if the controller exists in the Laravel files
        $appPath = "app/Http/Controllers/$namespace/{$name}Controller.php";
        if (file_exists($appPath))
            return $this->stopCommandHere("$appPath already exists!");

        // Checks if the controller exists in the domain files
        $srcPath = "src/Infrastructure/$namespace/Controllers/{$name}Controller.php";
        if (file_exists($srcPath))
            return $this->stopCommandHere($srcPath);


        // Checks if the route file exists or not
        $namespaceLowerCase = $this->fromCamelcaseToSnakecase($namespace);
        $routeFile = "routes/api/$namespaceLowerCase.php";
        if (!file_exists($routeFile))
            if (!$this->confirm("Are you sure you want to create the file '$routeFile'?"))
                return $this->stopCommandHere();

        $needCreateRouteFile = !file_exists($routeFile);

        try {
            // Create the controller in the domain
            $this->createDomainController($namespace, $name);

            // Create the controller in the Laravel part of the project
            $this->createLaravelController($namespace, $name);

            // Create the route file if necessary
            if ($needCreateRouteFile) $this->createRouteFile($namespace, $name);

            // Add the route in the namespace file
            else $this->appendRouteInFile($namespace, $name);
        } catch (\Throwable $th) {
            $this->deleteFileIfExists($srcPath, $namespace);
            $this->deleteFileIfExists($appPath, $namespace);
            if ($needCreateRouteFile) $this->deleteFileIfExists($routeFile, $namespace);

            $file = str_replace('/var/www/', '', $th->getFile());
            $this->error("Exception: {$th->getMessage()} in {$file}:{$th->getLine()}");
            return 0;
        }

        $this->info("The command was successful!");
        $this->warn("Don't forget to edit the route file $routeFile");
        $this->warn("and the controller $srcPath");

        return 0;
    }

    private function stopCommandHere(string $customMessage = null): int
    {
        $this->info($customMessage ?? "I can't perform this action...");
        $this->info("Come back later ^^");
        return 0;
    }

    private function fromCamelcaseToSnakecase(string $input): string
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    private function createDomainController($namespace, $controller)
    {
        if(!is_dir("src/Infrastructure/$namespace")) mkdir("src/Infrastructure/$namespace");
        if(!is_dir("src/Infrastructure/$namespace/Controllers")) mkdir("src/Infrastructure/$namespace/Controllers");
        touch("src/Infrastructure/$namespace/Controllers/{$controller}Controller.php");

        $content = file_get_contents("app/Console/Commands/CreateController/DomainController.php");
        $content = str_replace('MyNamespace', $namespace, $content);
        $content = str_replace('MyControllerName', $controller, $content);

        file_put_contents("src/Infrastructure/$namespace/Controllers/{$controller}Controller.php", $content);

        chown("src/Infrastructure/$namespace", "www");
        chown("src/Infrastructure/$namespace/Controllers", "www");
        chown("src/Infrastructure/$namespace/Controllers/{$controller}Controller.php", "www");
        chgrp("src/Infrastructure/$namespace", "www");
        chgrp("src/Infrastructure/$namespace/Controllers", "www");
        chgrp("src/Infrastructure/$namespace/Controllers/{$controller}Controller.php", "www");
    }

    private function createLaravelController($namespace, $controller)
    {
        if(!is_dir("app/Http/Controllers/$namespace")) mkdir("app/Http/Controllers/$namespace");
        touch("app/Http/Controllers/$namespace/{$controller}Controller.php");

        $content = file_get_contents("app/Console/Commands/CreateController/LaravelController.php");
        $content = str_replace('MyNamespace', $namespace, $content);
        $content = str_replace('MyControllerName', $controller, $content);

        file_put_contents("app/Http/Controllers/$namespace/{$controller}Controller.php", $content);

        chown("app/Http/Controllers/$namespace", "www");
        chown("app/Http/Controllers/$namespace/{$controller}Controller.php", "www");
        chgrp("app/Http/Controllers/$namespace", "www");
        chgrp("app/Http/Controllers/$namespace/{$controller}Controller.php", "www");
    }

    private function createRouteFile($namespace, $controller)
    {
        $namespaceLowerCase = $this->fromCamelcaseToSnakecase($namespace);
        touch("routes/api/$namespaceLowerCase.php");

        $content = file_get_contents("app/Console/Commands/CreateController/route.php");
        $content = str_replace('MyNamespace', $namespace, $content);
        $content = str_replace('MyControllerName', $controller, $content);

        file_put_contents("routes/api/$namespaceLowerCase.php", $content);

        chown("routes/api/$namespaceLowerCase.php", "www");
        chgrp("routes/api/$namespaceLowerCase.php", "www");
    }

    private function appendRouteInFile($namespace, $controller)
    {
        $namespaceLowerCase = $this->fromCamelcaseToSnakecase($namespace);
        $lines = file("routes/api/$namespaceLowerCase.php");
        $contentBelow = array_splice($lines, 3, count($lines), "use App\Http\Controllers\{$namespace}\{$controller}Controller;"); 
        
        $start = file_get_contents("app/Console/Commands/CreateController/imports.php");
        $start = str_replace('MyNamespace', $namespace, $start);
        $start = str_replace('MyControllerName', $controller, $start);

        file_put_contents("routes/api/$namespaceLowerCase.php", $start . "\n" . implode("", $contentBelow) . "\nRoute::get('to-change', {$controller}Controller::class);");
    }

    private function deleteFileIfExists(string $path, $namespace)
    {
        if (!file_exists($path)) return;

        unlink($path);

        $splitedPath = explode('/', $path);

        $removed = false;
        while (!$removed) {
            $removed = $namespace === end($splitedPath);
            
            array_pop($splitedPath);
            $directoryPath = implode('/', $splitedPath);

            if (count(scandir($directoryPath)) !== 2) return;

            rmdir($directoryPath);
        }

        return;
    }
}
