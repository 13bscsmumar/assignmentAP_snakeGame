<?php 
$roundAry = array(); //creates rounds array so that no of rounds for each game can be stored in it
class myboard { // board class for defining board characteristics
	public $sHead = [30,45,66,74,99]; // defines snake heads, any player falling on ith index of snake head will be taken to ith index of snake tail
	public $sTail = [7,22,19,34,2]; // defines snake tails
	public $lHead = [5,27,41,60,11]; // defines ladder heads
	public $lTail = [35,52,80,81,92]; // defines ladder tails, any player falling on ith index of ladder tail will be taken to ith index of ladder head
}
$brd = new myboard(); // creates a board for the game
class player { //player class for defining players characteristics
	public $name = -1; //players name
    public $pos = 0; //players position
    public $turn = 1; //to check if players turn or not
	public $win = 0; // to check if  player won or not

}
function throwDice() // throws dice and generates a random no. between 1 and 6
{
	return (rand(1,6));
}

function playGame(player &$p) //game function, all the rules are implemented in it. takes a player as an argument
{
	global $brd; 
	global $rounds;
	$rounds++;
	//$num =(rand(1,6));
	$num = throwDice(); //gets random no.
	//echo "number"; 
	//echo $num;
	if (($num + $p->pos) == 100) // check if player won
	{
		$p->pos = $num + $p->pos;
		echo "</br></br><b><u>";
		echo "player ";
		echo $p->name;
		echo "  won!!  ";
		echo "</br>GAME OVER!!</br></b></u>";
		$p->turn = 0;
		$p->win = 1;
		return 5;
	}
	if(($num + $p->pos > 100) || ($num == 6)) // check if player postion is greater than 100 also checks if dice value is 6 in either case another turn is given to the current player
	{
		$p->turn = 1;
		$p->win = 0;
		return 1;
	}
	if (($num + $p->pos < 100) || ($num != 6)) // check if player position is less than 100 also checks if dice is other than 6, both case result in the increament in postion and turn of other player
	{
		$p->win = 0;
		$p->pos = $num + $p->pos; // increamenting current position

		for($i = 0;$i < 5;$i++) // checking for ladders
		{
			if($p->pos ==  $brd->lTail[$i])
			{
				$p->pos = $brd->lHead[$i];
				$p->turn = 1; // again players turn if climbed ladder,position increamented
				break;
			}
			else
			{
				$p->turn = 0; 
			}
		}
		for($i = 0;$i < 5;$i++) // checking for snakes
		{
			if($p->pos == $brd->sHead[$i])
			{
				$p->pos = $brd->sTail[$i];
				$p->turn = 0; // players turn cancelled if stepped on snake,position decremented
				break;
			}
		}

		return 1;
	}

	
	
	
}
for ($xyz = 0; $xyz < 100; $xyz++){//runs application 100 times
$players = 4; // no of players
$rounds = 0;

 
$a = array();
for ($i = 0;$i<$players;$i++) // creating players
{
	$o = new player();
	$o->name = $i;
	$a[$i] = &$o;
	
	
}

$i = 0;
$index = -1;
while(1)
{
	for ($i=0;$i< $players;$i++) //playing game turn by turn
	{
		while (1) // while turn variable of a specific player is 1 he can thorw dice
		{
			$x = playGame($a[$i]);
			if ($a[$i]->win != 1)
			{
				echo "</br></br>";
				echo "player ";
				echo $a[$i]->name;
				echo "</br>";
				echo "postion: ";
				echo $a[$i]->pos;
			}
			if ($a[$i]->turn == 0 || $a[$i]->win == 1)
			{
				$index = $i;
				break;
			}
		
		}
		if ($x == 5 || $a[$index]->win == 1){ // if won break form all loops
		break;
	}
		if ($x == 5 || $a[$index]->win == 1)//if won break form all loops
		{
			break;
		}
		
	}
	
	if ($x == 5 || $a[$index]->win == 1)//if won break form all loops
		{
			break;
		}

	
}
//printing summary for analysis
$roundAry[$xyz] = $rounds;
echo "</br>Total Rounds for last game: ";
echo $rounds;
echo'</br>';
}
echo "</br><b>Summary</br>";
$min = min($roundAry);
$max = max($roundAry);
$sum = array_sum($roundAry);
$average = $sum / 100;
echo'</br>';
echo "No. of players: ";
echo $players;
echo'</br>';
echo "min: ";
echo $min;
echo'</br>';
echo "max: ";
echo $max;
echo'</br>';
echo $average;
echo'</br>';
echo "</br><b>Memory Report</br>";
echo "</br>";
$int = memory_get_peak_usage (false); //gets memory consumed
$int2 = memory_get_peak_usage (true); // gets memory allotted
$newint = $int/1024;
$newint2 = $int2/1024;
echo "Total Memory Allotted to this page: ";
echo $newint2;
echo " KBs";
echo "</br>";
echo "Out of that, the page consumes: ";
echo $newint;
echo " KBs";
echo "</br>";


?>
