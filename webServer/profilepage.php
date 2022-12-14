<?php
session_start();
if (!isset($_SESSION["username"]))
{
        echo "Log in to view this Page";
        header("refresh: 4, url=index.html");
        exit();
}
?>
<!DOCTYPE html>
<html>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</html>

<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "Default Profile Message";
}
/*
$request = array();
$request['type'] = "getProfile";
$response = $client->send_request($request);

//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);

echo "\n\n";

echo $argv[0]." END".PHP_EOL;
 */
/*
if ($response["returnCode"] == '0')
{
        echo "Grabbed profile".PHP_EOL;
}
else
{
        echo "Failed to grab profile".PHP_EOL;
}
echo($response);
 */
?>

<style>
table, th, td {

	border:1px solid black;
	border-collapse: collapse;
}
th, td{
	padding: 5px;
	text-align: left;
}
</style>
<html>
	<h1>Profile Page</h1>
	<table>
		<tr>
			<th>Username</th>
			<td>
				<?php echo($_SESSION["username"]);?>
				
			</td>
		</tr>
		<tr>
                        <th>Email</th>
                        <td>
				<?php echo($_SESSION["email"]);?>

                        </td>
                </tr>
		<tr>
                        <th>Wins</th>
                        <td>
				<?php echo($_SESSION["wins"]);?>

                        </td>
                </tr>
		<tr>
                        <th>Losses</th>
                        <td>
				<?php echo($_SESSION["losses"]);?>

                        </td>
                </tr>

	</table>

	<table>
                <tr>
                        <th>Fighter 1</th>
                        <td>
                                <?php echo($_SESSION["fighter1"]["name"]);?>

                        </td>
		</tr>
		<tr>
                        <th>Special Move</th>
                        <td>
                                <?php echo($_SESSION["move1"]);?>

                        </td>
                </tr>
                <tr>
                        <th>Fighter 2</th>
                        <td>
                                <?php echo($_SESSION["fighter2"]["name"]);?>

                        </td>
		</tr>
		<tr>
                        <th>Special Move</th>
                        <td>
                                <?php echo($_SESSION["move2"]);?>

                        </td>
                </tr>
                <tr>
                        <th>Fighter 3</th>
                        <td>
                                <?php echo($_SESSION["fighter3"]["name"]);?>

                        </td>
                </tr>
		<tr>
                        <th>Special Move</th>
                        <td>
                                <?php echo($_SESSION["move3"]);?>

                        </td>
                </tr>

        </table>

</html>
