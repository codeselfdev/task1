<?php declare(strict_types = 1);

namespace App\Command;


use App\Model\Client;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function fclose;
use function fgetcsv;
use function file_exists;
use function fopen;
use function is_readable;
use const PHP_EOL;



final class ProcessCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('identification-requests:process')
            ->addArgument('file', InputArgument::REQUIRED, 'Location of the CSV-file to read testcase from.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = $input->getArgument('file');


        $io = new SymfonyStyle($input, $output);
        if(!file_exists($filename) || !is_readable($filename)) {
            $io->error(sprintf('The provided filename "%s" is not readable!', $filename));

            return 1;
        }


        $handle = fopen($filename, 'rb');

        $client_array=array();
        $s = serialize($client_array);
        // store $s somewhere where page2.php can find it.
        file_put_contents('store', $s);
        while (($row = fgetcsv($handle)) !== false) {

            if ($io->isVerbose()) {
//                $name = (string)  c . PHP_EOL;
            }
            $client=new Client($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]);
            $io->write($client->verify());
            $io->newLine();
        }
        fclose($handle);



        return 0;
    }
}