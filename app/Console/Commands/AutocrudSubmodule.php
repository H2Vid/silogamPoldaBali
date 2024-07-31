<?php
namespace App\Console\Commands;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AutocrudSubmodule extends Command
{
    protected $signature = 'autocrud:submodule {old_module_name} {module_name?}';
    protected $description = 'Scaffold Blank Submodule';

    public 
        $old_namespace,
        $old_lowercase_name,

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
        $old_name = $this->argument('old_module_name');

        $name = $this->argument('module_name');
        if (empty($name)) {
            $name = $this->ask('Please insert submodule name');
        }

        $old_module_name = str_replace(' ', '', ucwords($old_name));
        $this->old_namespace = 'App\\Modules\\' . $old_module_name;
        $this->old_lowercase_name = strtolower(str_replace(' ', '_', $old_name));

        $this->proper_name = ucwords($name);
        $this->module_name = str_replace(' ', '', $this->proper_name);
        $this->lowercase_name = strtolower(str_replace(' ', '_', $this->proper_name));
        $this->lowercase_plural = Str::plural($this->lowercase_name);
        $this->namespace = 'App\\Modules\\' . $this->module_name;

        //bikin module dir dulu kalau blm ada
        if (!is_dir(base_path('app/Modules/' . $old_module_name))) {
            $this->error('Directory ' . base_path('app/Modules/' . $old_module_name) . ' is not exists. Please try using another module name that is already exists');
            return;
        }

        $module_dir = base_path('app/Modules/' . $old_module_name);
        $this->module_dir = $module_dir;
        copy_directory(__DIR__ . '/../../Stubs/Submodule', $module_dir);

        $this->info('Submodule scaffolding file copied successfully');

        $this->renameAllStubToPhp();

        $this->renameModules([
            'Http/Controllers/ExampleController.php',
            'Http/Generator/ExampleDatatableGenerator.php',
            'Http/Generator/ExampleFormGenerator.php',
            'Http/Services/ExampleCrudService.php',
            'Http/Services/ExampleDeleteService.php',
            'Migrations/2022_11_11_000000_example.php',
            'Migrations/2022_11_11_000000_example_translator.php',
            'Models/Example.php',
            'Models/ExampleTranslator.php',
        ]);

        $this->changeContents([
            'Http/Controllers/' . $this->module_name . 'Controller.php',
            'Http/Generator/' . $this->module_name . 'DatatableGenerator.php',
            'Http/Generator/' . $this->module_name . 'FormGenerator.php',
            'Http/Services/' . $this->module_name . 'CrudService.php',
            'Http/Services/' . $this->module_name . 'DeleteService.php',                
            'Migrations/2022_11_11_000000_' . $this->lowercase_name . '.php',
            'Migrations/2022_11_11_000000_' . $this->lowercase_name . '_translator.php',
            'Models/' . $this->module_name . '.php',
            'Models/' . $this->module_name . 'Translator.php',
        ]);

        rename($this->module_dir . '/Migrations/2022_11_11_000000_' . $this->lowercase_name .'.php' , $this->module_dir . '/Migrations/'.date('Y_m_d_His_') . $this->lowercase_name .'.php');
        rename($this->module_dir . '/Migrations/2022_11_11_000000_' . $this->lowercase_name .'_translator.php' , $this->module_dir . '/Migrations/'.date('Y_m_d_His_') . $this->lowercase_name .'_translator.php');

        $this->info('New blank submodule has been created for you. Now you just need to register routes, config, manage migration, manage the model and generator.');
    }

    protected function renameAllStubToPhp()
    {
        $path = $this->module_dir;

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
        $content = str_replace('[NAMESPACE]', $this->old_namespace, $content);
        $content = str_replace('[OLD_LOWER]', $this->old_lowercase_name, $content);
        $content = str_replace('examples', $this->lowercase_plural, $content);
        $content = str_replace('example', $this->lowercase_name, $content);
        $content = str_replace('Example Data', $this->proper_name, $content);
        $content = str_replace('Example', $this->module_name, $content);
        file_put_contents($this->module_dir . $path, $content);
    }

}
