<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student CRUD</title>
</head>
<body>

    <?php
        include 'config.php';
        // Handling the form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['add'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $sql = "INSERT INTO students (name, email) VALUES (?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$name, $email]);
            } elseif (isset($_POST['update'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $sql = "UPDATE students SET name = ?, email = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$name, $email, $id]);
            } elseif (isset($_POST['delete'])) {
                $id = $_POST['id'];
                $sql = "DELETE FROM students WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id]);
            }
        }

        // Fetching all students from the database
        $sql = "SELECT * FROM students";
        $stmt = $pdo->query($sql);
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2>Student Form</h2>
    <form action="student_crud.php" method = "post">
        <input type="hidden" name = "id" id = "student_id">
        Name: <input type="text" name = "name" id = "student_name"> <br> <br>
        Email: <input type="email" name = "email" id = "student_email"> <br> <br>
        <button type = "submit" name = "add">Add</button>
        <button type = "submit" name = "update">Update</button>
    </form>
    <hr>
    <h2>Student List</h2>
    <table border = "1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['id']) ?></td>
                    <td><?php echo htmlspecialchars($student['name']) ?></td>
                    <td><?php echo htmlspecialchars($student['email']) ?></td>
                    <td>
                    <button onclick="editStudent('<?php echo $student['id']; ?>', '<?php echo htmlspecialchars(addslashes($student['name'])); ?>', '<?php echo htmlspecialchars(addslashes($student['email'])); ?>')">Edit</button>
                        <form method="post" onsubmit="return confirm('Are you sure?');">
                            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function editStudent(id, name, email){
            document.getElementById('student_id').value = id;
            document.getElementById('student_name').value = name;
            document.getElementById('student_email').value = email;
            window.scrollTo(0, 0);
        }
    </script>
</body>
</html>