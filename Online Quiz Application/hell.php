<html>
<head><title>Start</title>
	</head>
	<body bgcolor="blue" text="white">
<?php
session_start();
echo'<font face="verdana"><b>';
	if(!isset($_POST['submute']))
	{
				$server="localhost";
				$user="root";
				$password="";
				$database="quiz";
				$con=mysqli_connect($server,$user,$password,$database);
					if(!$con)
					echo 'Connection failed !';
					else
				echo'
				<center><h2>Quiz Page</h2><hr>';
				echo'<form name="form453" action="start.php" method="post">';
				for($i=0;$i<=10;$i++)
			{	
				if($i==1)
				{
					echo '<font face="verdana"><center><table>';
					$query="select number,question,option1,option2,option3,option4 from questions where number=$i";
					$result=mysqli_query($con,$query);
						if($result)
						{
							while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab 
							{
							echo'<tr><th><center>Q'.$row[0].'.</th><th colspan="2"><p align="left">'.$row[1].'</th></tr>';
							echo'<tr><th><center>A :</th><th><p align="left">'.$row[2].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="1"></th></tr>';
							echo'<tr><th><center>B :</th><th><p align="left">'.$row[3].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="2"></th></tr>';
							echo'<tr><th><center>C :</th><th><p align="left">'.$row[4].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="3"></th></tr>';
							echo'<tr><th><center>D :</th><th><p align="left">'.$row[5].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="4"></th></tr>';
							}
						echo '</table><br><br>';
						}
				
				}
				if($i==2)
				{
					echo '<font face="verdana"><center><table>';
					$query="select number,question,option1,option2,option3,option4 from questions where number=$i";
					$result=mysqli_query($con,$query);
						if($result)
						{
							while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab 
							{
							echo'<tr><th><center>Q'.$row[0].'.</th><th colspan="2"><p align="left">'.$row[1].'</th></tr>';
							echo'<tr><th><center>A :</th><th><p align="left">'.$row[2].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="1"></th></tr>';
							echo'<tr><th><center>B :</th><th><p align="left">'.$row[3].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="2"></th></tr>';
							echo'<tr><th><center>C :</th><th><p align="left">'.$row[4].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="3"></th></tr>';
							echo'<tr><th><center>D :</th><th><p align="left">'.$row[5].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="4"></th></tr>';
							}
						echo '</table><br><br>';
						}
				
				}
				if($i==3)
				{
					echo '<font face="verdana"><center><table>';
					$query="select number,question,option1,option2,option3,option4 from questions where number=$i";
					$result=mysqli_query($con,$query);
						if($result)
						{
							while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab 
							{
							echo'<tr><th><center>Q'.$row[0].'.</th><th colspan="2"><p align="left">'.$row[1].'</th></tr>';
							echo'<tr><th><center>A :</th><th><p align="left">'.$row[2].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="1"></th></tr>';
							echo'<tr><th><center>B :</th><th><p align="left">'.$row[3].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="2"></th></tr>';
							echo'<tr><th><center>C :</th><th><p align="left">'.$row[4].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="3"></th></tr>';
							echo'<tr><th><center>D :</th><th><p align="left">'.$row[5].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="4"></th></tr>';
							}
						echo '</table><br><br>';
						}
				
				}
				if($i==4)
				{
					echo '<font face="verdana"><center><table>';
					$query="select number,question,option1,option2,option3,option4 from questions where number=$i";
					$result=mysqli_query($con,$query);
						if($result)
						{
							while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab 
							{
							echo'<tr><th><center>Q'.$row[0].'.</th><th colspan="2"><p align="left">'.$row[1].'</th></tr>';
							echo'<tr><th><center>A :</th><th><p align="left">'.$row[2].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="1"></th></tr>';
							echo'<tr><th><center>B :</th><th><p align="left">'.$row[3].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="2"></th></tr>';
							echo'<tr><th><center>C :</th><th><p align="left">'.$row[4].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="3"></th></tr>';
							echo'<tr><th><center>D :</th><th><p align="left">'.$row[5].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="4"></th></tr>';
							}
						echo '</table><br><br>';
						}
				
				}
				if($i==5)
				{
					echo '<font face="verdana"><center><table>';
					$query="select number,question,option1,option2,option3,option4 from questions where number=$i";
					$result=mysqli_query($con,$query);
						if($result)
						{
							while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab 
							{
							echo'<tr><th><center>Q'.$row[0].'.</th><th colspan="2"><p align="left">'.$row[1].'</th></tr>';
							echo'<tr><th><center>A :</th><th><p align="left">'.$row[2].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="1"></th></tr>';
							echo'<tr><th><center>B :</th><th><p align="left">'.$row[3].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="2"></th></tr>';
							echo'<tr><th><center>C :</th><th><p align="left">'.$row[4].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="3"></th></tr>';
							echo'<tr><th><center>D :</th><th><p align="left">'.$row[5].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="4"></th></tr>';
							}
						echo '</table><br><br>';
						}
				
				}
				if($i==6)
				{
					echo '<font face="verdana"><center><table>';
					$query="select number,question,option1,option2,option3,option4 from questions where number=$i";
					$result=mysqli_query($con,$query);
						if($result)
						{
							while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab 
							{
							echo'<tr><th><center>Q'.$row[0].'.</th><th colspan="2"><p align="left">'.$row[1].'</th></tr>';
							echo'<tr><th><center>A :</th><th><p align="left">'.$row[2].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="1"></th></tr>';
							echo'<tr><th><center>B :</th><th><p align="left">'.$row[3].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="2"></th></tr>';
							echo'<tr><th><center>C :</th><th><p align="left">'.$row[4].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="3"></th></tr>';
							echo'<tr><th><center>D :</th><th><p align="left">'.$row[5].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="4"></th></tr>';
							}
						echo '</table><br><br>';
						}
				
				}
				if($i==7)
				{
					echo '<font face="verdana"><center><table>';
					$query="select number,question,option1,option2,option3,option4 from questions where number=$i";
					$result=mysqli_query($con,$query);
						if($result)
						{
							while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab 
							{
							echo'<tr><th><center>Q'.$row[0].'.</th><th colspan="2"><p align="left">'.$row[1].'</th></tr>';
							echo'<tr><th><center>A :</th><th><p align="left">'.$row[2].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="1"></th></tr>';
							echo'<tr><th><center>B :</th><th><p align="left">'.$row[3].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="2"></th></tr>';
							echo'<tr><th><center>C :</th><th><p align="left">'.$row[4].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="3"></th></tr>';
							echo'<tr><th><center>D :</th><th><p align="left">'.$row[5].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="4"></th></tr>';
							}
						echo '</table><br><br>';
						}
				
				}
				if($i==8)
				{
					echo '<font face="verdana"><center><table>';
					$query="select number,question,option1,option2,option3,option4 from questions where number=$i";
					$result=mysqli_query($con,$query);
						if($result)
						{
							while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab 
							{
							echo'<tr><th><center>Q'.$row[0].'.</th><th colspan="2"><p align="left">'.$row[1].'</th></tr>';
							echo'<tr><th><center>A :</th><th><p align="left">'.$row[2].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="1"></th></tr>';
							echo'<tr><th><center>B :</th><th><p align="left">'.$row[3].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="2"></th></tr>';
							echo'<tr><th><center>C :</th><th><p align="left">'.$row[4].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="3"></th></tr>';
							echo'<tr><th><center>D :</th><th><p align="left">'.$row[5].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="4"></th></tr>';
							}
						echo '</table><br><br>';
						}
				
				}
				if($i==9)
				{
					echo '<font face="verdana"><center><table>';
					$query="select number,question,option1,option2,option3,option4 from questions where number=$i";
					$result=mysqli_query($con,$query);
						if($result)
						{
							while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab 
							{
							echo'<tr><th><center>Q'.$row[0].'.</th><th colspan="2"><p align="left">'.$row[1].'</th></tr>';
							echo'<tr><th><center>A :</th><th><p align="left">'.$row[2].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="1"></th></tr>';
							echo'<tr><th><center>B :</th><th><p align="left">'.$row[3].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="2"></th></tr>';
							echo'<tr><th><center>C :</th><th><p align="left">'.$row[4].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="3"></th></tr>';
							echo'<tr><th><center>D :</th><th><p align="left">'.$row[5].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="4"></th></tr>';
							}
						echo '</table><br><br>';
						}
				
				}
				if($i==10)
				{
					echo '<font face="verdana"><center><table>';
					$query="select number,question,option1,option2,option3,option4 from questions where number=$i";
					$result=mysqli_query($con,$query);
						if($result)
						{
							while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab 
							{
							echo'<tr><th><center>Q'.$row[0].'.</th><th colspan="2"><p align="left">'.$row[1].'</th></tr>';
							echo'<tr><th><center>A :</th><th><p align="left">'.$row[2].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="1"></th></tr>';
							echo'<tr><th><center>B :</th><th><p align="left">'.$row[3].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="2"></th></tr>';
							echo'<tr><th><center>C :</th><th><p align="left">'.$row[4].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="3"></th></tr>';
							echo'<tr><th><center>D :</th><th><p align="left">'.$row[5].'</th><th><p align="right"><input type="radio" name="q'.$i.'" value="4"></th></tr>';
							}
						echo '</table><br><br>';
						}
				
				}
			}	
				echo '<input type="submit" name="submute" value="Submit Test">';
				
				echo'</form>';
				
	
	}
	
			else 
			{
			$marks=0;
			$server="localhost";
			$user="root";
			$password="";
			$database="quiz";
			$con=mysqli_connect($server,$user,$password,$database);
			if(!$con)
			echo 'Connection failed !';
			else
			$result1=mysqli_query($con,"select answer from questions");
				if($result1)
				{	$i=1;
					while ($row=mysqli_fetch_array($result1)) // jab tak usko data milte rahe //  jab tak usko row mein value milte rahega
					{
					$answerwa[$i]=$row[0];
					$i++;
					}
				}
				
				for($i=1;$i<=10;$i++)
				{$answerac[$i]=$_POST['q'.$i.''];}
				
				/*for($i=1;$i<=10;$i++)
				echo ' '.$answerac[$i].' '; 
				
				
				echo '<br>';
				for($i=1;$i<=10;$i++)
				echo ' '.$answerwa[$i].' ';*/
				
				for($i=1;$i<=10;$i++)
				if($answerac[$i]==$answerwa[$i]) $marks++; else $marks=$marks-.5;
				
				
				
				$userlogin=$_SESSION['animal'];
				$pass=$_SESSION['password'];
				$server="localhost";
				$user="root";
				$password="";
				$database="quiz";
				//echo ''.$userlogin.''.$pass.'';
				$con=mysqli_connect($server,$user,$password,$database);
				if(!$con)
				echo 'Connection failed !';
				$result3=mysqli_query($con,"select * from users where name='$userlogin' and password=$pass");
				//echo "select * from users where name='$userlogin' and password=$pass";
				$row=mysqli_fetch_array($result3);
				$roll=$row[2];
				
				//echo ''.$roll;

				$result1=mysqli_query($con,"insert into result values('$userlogin',$roll,$marks)");
				//echo "insert into result values('$userlogin',$roll,$marks)";
				$result2=mysqli_query($con,"update users set status=3 where name='$userlogin' and roll=$roll");
				//echo "update users set status=3 where name='$userlogin' and roll=$roll";
				//kill session after changing status to 3
				header('Location: Result.php');
			}	

	?>
</body>
</html>