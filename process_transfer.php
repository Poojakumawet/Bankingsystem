<html>
<head>
    <title>Transfer Details</title>
    <link rel="stylesheet" type="text/css" href="bank.css">

<body>
    <h1>Transfer Details</h1>
    <?php
        include 'db_connection.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sender_id = $_POST['sender_id'];
            $receiver_id = $_POST['receiver_id'];
            $amount = $_POST['amount'];
            if ($sender_id == $receiver_id) {
                echo "<p>Error: Sender and receiver cannot be the same.</p>";
            } else {
    
                $sender_query = "SELECT name AS sender_name, current_balance AS sender_balance FROM customers WHERE id=$sender_id";
                $sender_result = mysqli_query($connection, $sender_query);
                $sender = mysqli_fetch_assoc($sender_result);

                $receiver_query = "SELECT name AS receiver_name, current_balance AS receiver_balance FROM customers WHERE id=$receiver_id";
                $receiver_result = mysqli_query($connection, $receiver_query);
                $receiver = mysqli_fetch_assoc($receiver_result);
                if ($amount > $sender['sender_balance']) {
                    echo "<p>Error: Insufficient balance.</p>";
                } else {
                    $new_sender_balance = $sender['sender_balance'] - $amount;
                    $new_receiver_balance = $receiver['receiver_balance'] + $amount;

                    $update_sender_query = "UPDATE customers SET current_balance=$new_sender_balance WHERE id=$sender_id";
                    $update_receiver_query = "UPDATE customers SET current_balance=$new_receiver_balance WHERE id=$receiver_id";

                    if (mysqli_query($connection, $update_sender_query) && mysqli_query($connection, $update_receiver_query)) {
                        echo "<p>Money transferred successfully.</p>";
                        echo "<h2>Transfer Summary</h2>";
                        echo "<table>";
                        echo "<tr><th>Sender</th><td>{$sender['sender_name']}</td></tr>";
                        echo "<tr><th>Receiver</th><td>{$receiver['receiver_name']}</td></tr>";
                        echo "<tr><th>Amount</th><td>{$amount}</td></tr>";
                        echo "</table>";
                    } else {
                        echo "<p>Error: " . mysqli_error($connection) . "</p>";
                    }
                }
            }
        }
        mysqli_close($connection);
        
    

    ?>
</body>
</html>










