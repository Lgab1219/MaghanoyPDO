<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php 
        // Selecting all customers in the table
        echo "<h2> Selecting all customers in the table </h2>";
        $statement = $pdo -> prepare("SELECT * FROM customers");

        if($statement -> execute()) {
            echo "<pre>";
            print_r($statement -> fetchAll());
            echo "<pre>";
        }

        // Selecting customers with the customer id of 1
        echo "<h2> Seleting customers with the customer id of 1 </h2>";
        $statement = $pdo -> prepare("SELECT * FROM customers
        WHERE customers.customer_id= 1");

        if($statement -> execute()){
            echo "<pre>";
            print_r($statement -> fetch());
            echo "<pre>";
        }

        // Inserting a new user to the table
        $queryStatement = "INSERT INTO customers(customer_id, last_name, first_name, email, address)
        VALUES (?, ?, ?, ?, ?)";

        $queryStatement = $pdo -> prepare($queryStatement);

        $executeQuery= $queryStatement ->execute(
            [15, "Maghanoy", "Lance", "test@gmail.com", "My Location"]
        );

        if($executeQuery){
            echo "Query successful!\n";
        } else {
            echo "Query failed!\n";
        }


        // Deleting a user in the table
        $queryStatement = "DELETE FROM customers WHERE customer_id = 15";

        $queryStatement = $pdo -> prepare($queryStatement);

        $executeQuery = $queryStatement -> execute();

        if ($executeQuery){
            echo "Deletion successful!\n";
        } else {
            echo "Deletion failed!\n";
        }


        // Updating a user from the database
        $queryStatement = "UPDATE customers SET customers.last_name = ?, 
        customers.first_name = ? WHERE customers.customer_id = 2";

        $queryStatement = $pdo -> prepare($queryStatement);

        $executeQuery = $queryStatement -> execute(
            ["Lance", "Maghanoy"]
        );

        if ($executeQuery){
            echo "Update successful!";
        } else {
            echo  "Update failed!";
        }

        // Re-printing updated database
        $queryStatement = "SELECT * FROM customers";
        $queryStatement = $pdo -> prepare($queryStatement);
        $executeQuery= $queryStatement ->  execute();

    ?>

    <h2> Updated Database </h2>
    <table style="border-style: solid; border-width: 2px; margin-top: 10px; height: 50px;">
        <tr>
            <th>First Name</th>
            <th> Last Name</th>
        </tr>
        <?php foreach($queryStatement as $row) {?>
        <tr>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
        </tr>
    <?php }?>
    </table>

</body>
</html>