<?php

namespace App\Command;

use App\Service\ProductsService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SumOfProductsCommand extends Command
{
    protected static $defaultName = 'products:sum';
    protected static $defaultDescription = 'Add a short description for your command';

    protected function configure(): void
    {
        $this
            ->addArgument('outputSum', InputArgument::REQUIRED, 'Integer which is a sum of products');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('outputSum');

	    $productsServiceObj = new ProductsService(__DIR__.'../../../data/products.json');
	    $result = $productsServiceObj->process($arg1);

		if($result) {
			$io->success('TRUE - Expected Sum combination found');
		}else {
			$io->error('FALSE - Expected Sum combination NOT found');
		}

        return Command::SUCCESS;
    }
}
