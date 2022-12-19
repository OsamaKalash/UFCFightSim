<!DOCTYPE html>
<?php

session_start();

if (!isset($_SESSION["username"]))
{
	echo "Log in to view this Page";
	header("refresh: 4, url=index.html");
	exit();
}

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
	$msg = "Banana";
}

$request = array();
$request['type'] = "getMessages";
$response = $client->send_request($request);

//echo "client received response: ".PHP_EOL;
echo "\n\n";

//echo $argv[0]." END".PHP_EOL;


// header("refresh: 25, url=forumpage.php");

?>
<html>
<body>
<style>
p {
    line-height: 1.5;
    font-family: Arial, Helvetica, sans-serif;
}
</style>
    <p>
        <?php
    foreach($response as $message)
    {
         print_r($message[3]."|".$message[2]);
         echo "<br>";
    }
        ?>
    </p>
    <form action="forumsubmit.php" id="submission" method="post">

        <label for="sendmessage">Send a Message To Chat Here</label>
        <input type="text" id="sendmessage" name="sendmessage" />
        <div>
            <input type="submit" value="Send Message" />
        </div>

    </form>

</body>
</html>
