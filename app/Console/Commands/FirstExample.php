<?php

namespace App\Console\Commands;

use App\Services\AssocDecoderWithoutHeader;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use React\EventLoop\Loop;
use React\Filesystem\Filesystem;
use React\Stream\ReadableResourceStream;
use React\Stream\WritableResourceStream;


class FirstExample extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:phones {--i=} {--o=} {--d=}';

    private const PATH_TO_INTERNAL_STORAGE = '/storage/app/';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $inputFile = $this->option('i');
        $outputFile = $this->option('o');
        $dbFile = $this->option('d');
        $loop = Loop::get();
        try {
            $filesystem = Filesystem::create($loop);
        } catch (\RuntimeException $e) {
            //todo logging format stuff
            Log::channel('stdout')->error($e->getMessage());
            return 255;
        }
        $db = [];
        try {
            $outputStream = new WritableResourceStream(
                \fopen($this->createAbsolutePathToStorage($outputFile), 'w'), $loop
            );
        } catch (\InvalidArgumentException|\RuntimeException $e) {
            //todo logging format stuff
            Log::channel('stdout')->error($e->getMessage());
            return 255;
        }
        $filesystem->file($this->createAbsolutePathToStorage($dbFile))->getContents()->then(
            function ($contents) use (&$db, $outputStream, $inputFile, $loop) {
                //due to ambiguous space separator couldn't find a way to parse it more easily
                $dbRaw = \explode(PHP_EOL, $contents);
                \array_walk($dbRaw, function ($dbRaw) use (&$db) {
                    $dbRow = \explode(' ', $dbRaw, 2);
                    if ($dbRow[0] !== '') {
                        $db[$dbRow[0]] = $dbRow[1];
                    }
                }, $db);
                // I couldn't find a way to read file line-by-line, so, I used clue/reactphp-csv here instead
                $inputStream = new AssocDecoderWithoutHeader(
                    new ReadableResourceStream(
                        \fopen($this->createAbsolutePathToStorage($inputFile), 'r'),
                        $loop
                    )
                );
                $outputStream->on('pipe', function () use (&$db, $inputStream, $outputStream) {
                    $inputStream->on('error', function () use ($outputStream) {
                        Log::channel('stdout')->error('Error occurred while processing input stream');
                        $outputStream->close();
                    });
                    $inputStream->on(
                        'data',
                        function (&$firstNumberAndCurrent) use (&$db, $inputStream, $outputStream) {
                            $number = \current($firstNumberAndCurrent);
                            $countryCode = (int)\floor((int)$number / 10 ** 7);
                            if (isset($db[$countryCode])) {
                                $firstNumberAndCurrent = $number . ' ' . $countryCode . ' ' . $db[$countryCode] . PHP_EOL;
                            } else {
                                $firstNumberAndCurrent = $number . ' error' . PHP_EOL;
                            }
                        }
                    );
                });
                $inputStream->pipe($outputStream);
            },
            function () use ($outputStream) {
                Log::channel('stdout')->error('Error occurred while processing db stream');
                $outputStream->close();
            }
        );
        $loop->run();
        return 0;
    }

    private function createAbsolutePathToStorage(string $file): string
    {
        return base_path() . self::PATH_TO_INTERNAL_STORAGE . $file;
    }
}
