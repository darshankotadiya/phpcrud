<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $image = $_POST['existing_image'];

    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        // Delete old image if exists
        if ($image) {
            unlink($image);
        }
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $sql = "UPDATE users SET name='$name', email='$email', image='$image' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT name, email, image FROM users WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<form method="POST" action="" enctype="multipart/form-data">
    Name: <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>
    Email: <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br>
    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="User Image" style="max-width: 100px;"><br>
    Existing Image: <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($row['image']); ?>">
    Image: <input type="file" name="image" accept="image/*"><br>
    <input type="submit" value="Update User">
</form>

<?php $conn->close(); ?>
