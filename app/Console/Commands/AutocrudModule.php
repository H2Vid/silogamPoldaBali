<?php
namespace App\Console\Commands;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AutocrudModule extends Command
{
    protected $signature = 'autocrud:module {module_name?}';
    protected $description = 'Scaffold new Blank Module';

    public 
        $proper_name, 
        $lowercase_name, 
        $lowercase_plural,
        $namespace, 
        $module_name, 
        $module_dir;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('module_name');
        if (empty($name)) {
            $name = $this->ask('Please insert module name');
        }

        $this->proper_name = ucwords($name);
        $this->module_name = str_replace(' ', '', $this->proper_name);
        $this->lowercase_name = strtolower(str_replace(' ', '_', $this->proper_name));
        $this->lowercase_plural = Str::plural($this->lowercase_name);
        $this->namespace = 'App\\Modules\\' . $this->module_name;

        //bikin module dir dulu kalau blm ada
        if (!is_dir(base_path('app/Modules'))) {
            mkdir(base_path('app/Modules', 0755, true));
        }
        $base_dir = base_path('app/Modules');
        $path = realpath($base_dir . '/' . $this->module_name);
        if ($path) {
            $this->error('Directory ' . $path . ' is exists. Please try using another module name');
        } else {
            $module_dir = $base_dir . '/' . $this->module_name;
            $this->module_dir = $module_dir;
            mkdir($module_dir, 0755);
            copy_directory(__DIR__ . '/../../Stubs/Module', $module_dir);
            $this->info('Scaffolding file copied successfully');

            $this->renameAllStubToPhp();

            $this->renameModules([
                'Facades/Example.php',
                'Http/Controllers/ExampleController.php',
                'Http/Generator/ExampleDatatableGenerator.php',
                'Http/Generator/ExampleFormGenerator.php',
                'Http/Services/ExampleCrudService.php',
                'Http/Services/ExampleCustomService.php',
                'Http/Services/ExampleDeleteService.php',
                'Migrations/2022_11_11_000000_example.php',
                'Migrations/2022_11_11_000000_example_translator.php',
                'Models/Example.php',
                'Models/ExampleTranslator.php',
                'Providers/ExampleServiceProvider.php',
                'Example.php',
            ]);

            $this->changeContents([
                'Configs/menu.php',
                'Configs/module.php',
                'Configs/permission.php',
                'Facades/' . $this->module_name . '.php',
                'Http/Controllers/' . $this->module_name . 'Controller.php',
                'Http/Generator/' . $this->module_name . 'DatatableGenerator.php',
                'Http/Generator/' . $this->module_name . 'FormGenerator.php',
                'Http/Services/' . $this->module_name . 'CrudService.php',
                'Http/Services/' . $this->module_name . 'DeleteService.php',                
                'Http/Services/' . $this->module_name . 'CustomService.php',
                'Migrations/2022_11_11_000000_' . $this->lowercase_name . '.php',
                'Migrations/2022_11_11_000000_' . $this->lowercase_name . '_translator.php',
                'Models/' . $this->module_name . '.php',
                'Models/' . $this->module_name . 'Translator.php',
                'Providers/' . $this->module_name . 'ServiceProvider.php',
                'Resources/views/' . $this->lowercase_name . '/crud.blade.php',
                'Resources/views/' . $this->lowercase_name . '/index.blade.php',
                'Routes/web.php',
                $this->module_name . '.php',
            ]);

            rename($this->module_dir . '/Migrations/2022_11_11_000000_' . $this->lowercase_name .'.php' , $this->module_dir . '/Migrations/'.date('Y_m_d_His_') . $this->lowercase_name .'.php');
            rename($this->module_dir . '/Migrations/2022_11_11_000000_' . $this->lowercase_name .'_translator.php' , $this->module_dir . '/Migrations/'.date('Y_m_d_His_') . $this->lowercase_name .'_translator.php');

            $this->info('New blank module has been created for you. Now you just need to register the service provider "Providers/' . $this->module_name . 'ServiceProvider::class" (in config/app.php), manage migration, manage the model and generator.');

        }

    }

    protected function renameAllStubToPhp()
    {
        $path = $this->module_dir;

        // manually rename "Blank" directory to its current module name in Resources/views
        rename(
            $path . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'example',
            $path . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $this->lowercase_name,
        );

        $di = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        //rename .stub -> .php
        foreach ($di as $fname => $fio) {
            $file_full_path = $fio->getPath() . DIRECTORY_SEPARATOR . $fio->getFilename();
            if (strpos($file_full_path, '.stub') !== false) {
                rename($file_full_path, str_replace('.stub', '.php', $file_full_path));
            }
        }
    }

    protected function renameModule($module_path)
    {
        $first_char = substr($module_path, 0, 1);
        if (!in_array($first_char, ['/', '\\', DIRECTORY_SEPARATOR])) {
            $module_path = DIRECTORY_SEPARATOR . $module_path;
        }

        $rename_path = str_replace('examples', $this->lowercase_plural, $module_path);
        $rename_path = str_replace('example', $this->lowercase_name, $module_path);
        $rename_path = str_replace('Example', $this->module_name, $rename_path);
        $rename_path = str_replace('.stub', '.php', $rename_path);

        rename($this->module_dir . $module_path, $this->module_dir . $rename_path);
    }

    protected function renameModules($list_of_path = [])
    {
        foreach ($list_of_path as $path) {
            $this->renameModule($path);
        }
    }

    protected function changeContents($list_of_path)
    {
        foreach ($list_of_path as $path) {
            $this->changeContent($path);
        }
    }

    protected function changeContent($path)
    {
        $first_char = substr($path, 0, 1);
        if (!in_array($first_char, ['/', '\\', DIRECTORY_SEPARATOR])) {
            $path = DIRECTORY_SEPARATOR . $path;
        }

        $content = file_get_contents($this->module_dir . $path);
        $content = str_replace('examples', $this->lowercase_plural, $content);
        $content = str_replace('example', $this->lowercase_name, $content);
        $content = str_replace('App\Modules\Example', $this->namespace, $content);
        $content = str_replace('Example Data', $this->proper_name, $content);
        $content = str_replace('Example', $this->module_name, $content);
        file_put_contents($this->module_dir . $path, $content);
    }

}
