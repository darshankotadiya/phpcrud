<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $image = '';

    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $sql = "INSERT INTO users (name, email, image) VALUES ('$name', '$email', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<form method="POST" action="" enctype="multipart/form-data">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Image: <input type="file" name="image" accept="image/*"><br>
    <input type="submit" value="Create User">
</form>
