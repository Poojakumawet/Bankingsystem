<html>

<head>
 
    <title>View Customers</title>
    <link rel="stylesheet" type="text/css" href="bank.css">

</head>
<body>
    <h1>View Customers</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Current_balance</th>
            <th>Action</th>
        </tr>
        <?php

            include 'db_connection.php';
            $query = "SELECT id, name, email,current_balance FROM customers";
            $result = mysqli_query($connection, $query);

   
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['current_balance']."</td>";
                echo "<td><button onclick='sendToCustomer(".$row['id'].")'>Send</button></td>";
                echo "</tr>";
            }
            mysqli_close($connection);
        ?>
    </table>

    <script>
        function sendToCustomer(customerId) {

            window.location.href = "transfer_money.php?customer_id=" + customerId;
        }
    </script>
</body>
</html>

