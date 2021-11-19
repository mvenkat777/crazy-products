<?php
declare(strict_types=1);
namespace App\Service;


class ProductsUtil
{
	public static function printCombination($arr, $r , $expectedSum)
	{
		$data = array();
		return self::combinationUtil($arr, $data, 0, count($arr) - 1, 0, $r ,$expectedSum);
	}


	public static function combinationUtil($arr, $data, $start, $end, $index, $r ,$expectedSum):bool
	{
		if ($index == $r)
		{
			return (array_sum($data) == $expectedSum);
		}

		for ($i = $start;
		     $i <= $end &&
		     $end - $i + 1 >= $r - $index; $i++)
		{
			$data[$index] = $arr[$i];
			if(self::combinationUtil($arr, $data, $i + 1,
				$end, $index + 1, $r, $expectedSum))
			{
				return true;
			}
		}
		return false;
	}

}