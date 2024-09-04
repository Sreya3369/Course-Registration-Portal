<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>OPEN ELECTIVE REGISTRATION</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="home.js" defer></script>

    <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    body {
        width: 100vw;
        height: 100vh;
        font-family: monospace;
        background: linear-gradient(#8282dc,#b286de,#e8b98a);
        caret-color: transparent;
    }
    .container {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }
    .row {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 60%;
        margin: auto;
        height: 45%;
        background: rgba(255, 255, 255, 0.2); 
        border-radius: 1rem; 
        backdrop-filter: blur(2rem); 
        box-shadow: 0 4px 6px #7a7070;
    }
    input {
        padding: 1rem;
        outline: none;
        border: none;
        border-radius: 2rem;
        font-size: 1.5rem;
        width: 50%;
    }
    button {
        padding: 1rem;
        font-size: 1rem;
        border-radius: 50%;
        align-items: center;
        border: none;
    }
    i {
        font-size: 2rem;
    }
    .col {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        flex-direction: column;
        gap: 2rem;
        caret-color: #b286de;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="col">
                <input class="id" type="text" name="id" placeholder="Enter User ID">
                <input class="pass" type="password" name="pass" placeholder="Enter Password">
                <button class="go" type="submit"><i class="fa-solid fa-right-to-bracket"></i></button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['pass'])) {
        $id = $_POST["id"];
        $pass = $_POST["pass"];
        if ($id == null || $pass == null) echo '<script>alert("Fill Everything")</script>'; 
        else {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "open_elective";
            $conn = new mysqli($servername, $username, $password, $dbname);
            // echo "ID: " . $id . "<br>";
            // echo "Password: " . $pass . "<br>";
            if ($id == "admin" && $pass == 'admin@123') {
                header("Location: admin.php");
                exit();
            }
            $sql = "SELECT Roll_no, Pass, Status FROM open_ele WHERE Roll_no = '$id'";
            $result = $conn->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // echo "ID: " . $row["Roll_no"] . "<br>";
                        // echo "Password: " . $row["Pass"] . "<br>";
                        if ($id != $row["Roll_no"] || $pass != $row['Pass']) {
                            echo '<script>alert("Incorrect Pass & ID")</script>';
                        } 
                        else {
                            if ($row["Status"] == 0) {
                                header("Location: course.php?id=" . $id);
                                exit();
                            } else {
                                echo '<script>alert("you have already enrolled")</script>';
                                header("Location: result.php?id=" . $id);
                            }
                        }
                    }
                } else {
                    echo '<script>alert("user doesnt exists")</script>';
                }
            } else {
                echo '<script>alert("No such user")</script>'; 
            }
        
            $conn->close();
        }
    } 
}
?>
