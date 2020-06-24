<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Support\ProcessUtils;
use Laravel\Dusk\Console\DuskCommand as BaseCommand;
use Symfony\Component\Process\Exception\ProcessSignaledException;
use Symfony\Component\Process\Exception\RuntimeException;
use Symfony\Component\Process\Process;

class DuskServeCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dusk:serve {--without-tty : Disable output to TTY}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application and run Dusk tests';

    /**
     * @var Process
     */
    protected $server;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Snippets copied from DuskCommand::handle()
        $this->purgeScreenshots();

        $this->purgeConsoleLogs();

        return $this->withDuskEnvironment(function () {
            // Start the Web Server AFTER Dusk handled the environment, but before running PHPUnit
            $serveProcess = $this->serve();

            // Run PHP Unit
            try {
                return $this->runPhpunit();
            } catch (\Exception $e) {
                throw $e;
            } finally {
                // Stop Web Server
                $serveProcess->stop();
            }
        });
    }

    /**
     * Snippet copied from DuskCommand::handle() to actually run PHP Unit
     *
     * @return int
     */
    protected function runPhpunit()
    {
        $options = array_slice($_SERVER['argv'], $this->option('without-tty') ? 3 : 2);

        $process = (new Process(array_merge(
            $this->binary(),
            $this->phpunitArguments($options)
        )))->setTimeout(null);

        try {
            $process->setTty(! $this->option('without-tty'));
        } catch (RuntimeException $e) {
            $this->output->writeln('Warning: '.$e->getMessage());
        }

        try {
            return $process->run(function ($type, $line) {
                $this->output->write($line);
            });
        } catch (ProcessSignaledException $e) {
            if (extension_loaded('pcntl') && $e->getSignal() !== SIGINT) {
                throw $e;
            }
        }
    }

    /**
     * Build a process to run php artisan serve
     *
     * @return Process
     */
    protected function serve()
    {
        $cwd = getcwd();
        chdir(public_path());

        $process = new Process([
            PHP_BINARY,
            '-S',
            '127.0.0.1:8000',
            '../server.php',
        ]);
        $process->setTimeout(null)->start();

        chdir($cwd);
        return $process;
    }
}
