<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Money</title>
    <link rel="stylesheet" type="text/css" href="bank.css">

</head>
<body>

    <h1>Transfer Money</h1>
    <form method="POST" action="process_transfer.php">
        <label for="sender">Sender:</label>
        <select name="sender_id" id="sender">
            <?php
                include 'db_connection.php';
                $query = "SELECT id, name FROM customers";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='".$row['id']."'>".$row['name']."</option>";
                }
            ?>
        </select>
        <br>
        <label for="receiver">Receiver:</label>
        <select name="receiver_id" id="receiver">
            <?php
                mysqli_data_seek($result, 0); 
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='".$row['id']."'>".$row['name']."</option>";
                }
                mysqli_free_result($result); 
                mysqli_close($connection);
            ?>
        </select>
        <br>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" min="0" step="any" required>
        <br><br>
        <button type="submit">Transfer</button>
    </form>
</body>
</html>
