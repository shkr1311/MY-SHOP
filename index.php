<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My shop</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container my-5">
    <h2>List of clients</h2>
    <a href="/create.php" class="btn btn-primary" role="button">New client</a>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "myshop";

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        }

        $sql = "SELECT * FROM registrations";
        $results = $connection->query($sql);

        if (!$results) {
          die("Invalid Query: " . $connection->error);
        }

        while ($row = $results->fetch_assoc()) {
          echo "
            <tr>
              <td>$row[id]</td>
              <td>$row[name]</td>
              <td>$row[email]</td>
              <td>$row[phone]</td>
              <td>$row[address]</td>
              <td>$row[created_At]</td>
              <td>
                <a href='/edit.php?ID=$row[ID]' class='btn btn-primary btn-sm'>Edit</a>
                <a href='/delete.php?ID=$row[ID]' class='btn btn-primary btn-sm'>Delete</a>
              </td>
            </tr>
          ";
        }
        ?>
      </tbody>
    </table>
  </div>
  
</body>
</html>
