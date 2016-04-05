<?php
//unit tests
function TestthrowDice()
{
	$actual = throwDice();
	if ($actual > 6)
	{
		echo "Test Failed.. Dice value should be less than 6";
	}
	else
	{
		echo "Test Passed.. Dice value is less than 6 i.e: ";
		echo $actual;
	}
}

function TestplayGame(player &$p) 
{
	$funcOutput = playGame($p);
	if ($funcOutput == 1 || $funcOutput == 5)
	{
		echo "Test Passed.. as Function should return 1 when game is continued at termination it should return 5 any other output is false";
	}
	else
	{
		echo "test failed... as Function should return 1 when game is continued at termination it should return 5 any other output is false";
	}
}
?>
