<?php declare(strict_types=1);

namespace App\Service;
use League\Csv\Reader;

class ProductsService
{
	public $filePath;
	public function __construct(string $filePath)
	{
		$this->filePath = $filePath;
	}

	public function process($expectedSum) : bool
	{
		$products = $this->readJSON();
		$productsPriceData = $this->extractProductsPrice($products);
		return ProductsUtil::printCombination($productsPriceData, 3, $expectedSum);
	}

	public function readJSON(): array
	{
		$string = file_get_contents($this->filePath);
		return json_decode($string, true);
	}

	public function extractProductsPrice($records) :array
	{
		return array_column($records, 'price');
	}


	public function readCSV(string $filePath): \Iterator
	{
		//load the CSV document from a file path
		$csv = Reader::createFromPath($filePath, 'r');
		$csv->setHeaderOffset(0);

		$header = $csv->getHeader(); //returns the CSV header record
		$records = $csv->getRecords(); //returns all the CSV records as an Iterator object

		//echo $csv->toString(); //returns the CSV document as a string
		return $records;
	}





}
