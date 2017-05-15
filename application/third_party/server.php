<?php
date_default_timezone_set("Asia/Bangkok");
echo date_default_timezone_get();
$host = 'localhost'; //host
$port = '9000'; //port
$null = NULL; //null var

//Create TCP/IP sream socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
//reuseable port
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);

//bind socket to specified host
socket_bind($socket, 0, $port);

//listen to port
socket_listen($socket);

//create & add listning socket to the list
$clients = array($socket);

//start endless loop, so that our script doesn't stop
while (true) {
	//manage multipal connections
	$changed = $clients;
	//returns the socket resources in $changed array
	socket_select($changed, $null, $null, 0, 10);
	
	//check for new socket
	if (in_array($socket, $changed)) {
		$socket_new = socket_accept($socket); //accpet new socket
		$clients[] = $socket_new; //add socket to client array
		
		$header = socket_read($socket_new, 1024); //read data sent by the socket
		perform_handshaking($header, $socket_new, $host, $port); //perform websocket handshake
		
		socket_getpeername($socket_new, $ip); //get ip address of connected socket
		$response = mask(json_encode(array('type'=>'system', 'message'=>$ip.' connected'))); //prepare json data
		send_message($response); //notify all users about new connection
		
		//make room for new socket
		$found_socket = array_search($socket, $changed);
		unset($changed[$found_socket]);
	}
	
	//loop through all connected sockets
	foreach ($changed as $changed_socket) {	
		
		//check for any incomming data
		while(socket_recv($changed_socket, $buf, 1024, 0) >= 1)
		{
			$received_text = unmask($buf); //unmask data
			$tst_msg = json_decode($received_text); //json decode 
			$msg_type = $tst_msg->type;

			$response_text = '';
			// if($msg_type == 'system')
			// {
			// 	if($tst_msg->method == 'init_session')
			// 	{

					
			// 		// $session_id = insert_session($tst_msg->key,$ip);
			// 		$response_text =  mask(json_encode(array('type'=>'system', 'method'=>'init_session', 'session_id'=>$session_id)));
			// 		send_message($response_text); //
			// 		break 2; //exist this loop
			// 	}
			// }else{
				$user_message = $tst_msg->message; //message text
				$user_from = $tst_msg->from;
				$time = time();

				//prepare data to be sent to client
				insert_log($ip,$user_from,$user_message);
				$username = get_user_name($user_from);
				$response_text = mask(json_encode(array('type'=>'usermsg', 'from'=>$username, 'message'=>$user_message
					,'timestamp'=>$time)));
				send_message($response_text); //send data
				break 2; //exist this loop
			//}
		}
		
		$buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
		if ($buf === false) { // check disconnected client
			// remove client for $clients array
			$found_socket = array_search($changed_socket, $clients);
			socket_getpeername($changed_socket, $ip);

			unset($clients[$found_socket]);
			
			//notify all users about disconnected connection
			$response = mask(json_encode(array('type'=>'system', 'message'=>$ip.' disconnected')));
			send_message($response);
		}
	}
}
// close the listening socket
socket_close($socket);

function send_message($msg)
{
	global $clients;
	foreach($clients as $changed_socket)
	{
		@socket_write($changed_socket,$msg,strlen($msg));
	}
	return true;
}


//Unmask incoming framed message
function unmask($text) {
	$length = ord($text[1]) & 127;
	if($length == 126) {
		$masks = substr($text, 4, 4);
		$data = substr($text, 8);
	}
	elseif($length == 127) {
		$masks = substr($text, 10, 4);
		$data = substr($text, 14);
	}
	else {
		$masks = substr($text, 2, 4);
		$data = substr($text, 6);
	}
	$text = "";
	for ($i = 0; $i < strlen($data); ++$i) {
		$text .= $data[$i] ^ $masks[$i%4];
	}
	return $text;
}

//Encode message for transfer to client.
function mask($text)
{
	$b1 = 0x80 | (0x1 & 0x0f);
	$length = strlen($text);
	
	if($length <= 125)
		$header = pack('CC', $b1, $length);
	elseif($length > 125 && $length < 65536)
		$header = pack('CCn', $b1, 126, $length);
	elseif($length >= 65536)
		$header = pack('CCNN', $b1, 127, $length);
	return $header.$text;
}
function write_log(){

	$servername = "172.16.0.17";
	$username = "DW24";
	$password = "DW24";
	$dbname = "dw24";

	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";
}
// function insert_session($user_id,$ip)
// {

// 	$servername = "172.16.0.17";
// 	$username = "DW24";
// 	$password = "DW24";
// 	$dbname = "dw24";

// 	$conn = mysqli_connect($servername, $username, $password, $dbname);
// 	// Check connection
// 	if (!$conn) {
// 	    die("Connection failed: " . mysqli_connect_error());
// 	}
// 	$uniq = uniqid();
// 	$sql = "INSERT INTO dw24.message_session (session_id, user_id, ip,timestamp,is_active)
// 	VALUES ('$uniq', '$user_id', '$ip','".time()."','Y')";

// 	if (mysqli_query($conn, $sql)) {
// 	    echo "New record created successfully";
// 	    return $uniq;
// 	} else {
// 	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// 	    return false;
// 	}

// 	mysqli_close($conn);
// }
// function deactivate_session($session_id){
// 	$servername = "172.16.0.17";
// 	$username = "DW24";
// 	$password = "DW24";
// 	$dbname = "dw24";

// 		// Create connection
// 		$conn = new mysqli($servername, $username, $password, $dbname);
// 		// Check connection
// 		if ($conn->connect_error) {
// 		    die("Connection failed: " . $conn->connect_error);
// 		} 

// 		$sql = "UPDATE dw24.message_session SET is_active='N' WHERE session_id=$session_id";

// 		if ($conn->query($sql) === TRUE) {
// 		    echo "Record updated successfully";
// 		} else {
// 		    echo "Error updating record: " . $conn->error;
// 		}

// 		$conn->close();
// }
function get_user_name($user_id)
{
	$servername = "172.16.0.17";
	$username = "DW24";
	$password = "DW24";
	$dbname = "dw24";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM users WHERE id = $user_id";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	       return $row['username'];
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();
}
function insert_log($ip,$from,$message)
{

	$servername = "172.16.0.17";
	$username = "DW24";
	$password = "DW24";
	$dbname = "dw24";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$conn->set_charset("utf8mb4");
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	$uniq = uniqid();

	$sql = "INSERT INTO dw24.message_log(ip,from_id, message,timestamp)
	VALUES ( '$ip','$from', '".(string)$message."','".time()."')";

	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	    return $uniq;
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    return false;
	}

	mysqli_close($conn);
}
//handshake new client.
function perform_handshaking($receved_header,$client_conn, $host, $port)
{
	$headers = array();
	$lines = preg_split("/\r\n/", $receved_header);
	foreach($lines as $line)
	{
		$line = chop($line);
		if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
		{
			$headers[$matches[1]] = $matches[2];
		}
	}

	$secKey = $headers['Sec-WebSocket-Key'];
	$secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
	//hand shaking header
	$upgrade  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
	"Upgrade: websocket\r\n" .
	"Connection: Upgrade\r\n" .
	"WebSocket-Origin: $host\r\n" .
	"WebSocket-Location: ws://$host:$port/demo/shout.php\r\n".
	"Sec-WebSocket-Accept:$secAccept\r\n\r\n";
	socket_write($client_conn,$upgrade,strlen($upgrade));
}
