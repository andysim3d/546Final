<?PHP
session_start();
include("DB.php");

$userID=$_SESSION['UID'];

if(isset($_POST["Content"]))
{
 $QID=$_POST['QID'];
 $Content=$_POST['Content'];
 $res=AddAnswer($userID,$QID,$Content);

}
 header("Location: http://localhost/546Final/pages/edit_answer.php?var=".$QID);
?>
