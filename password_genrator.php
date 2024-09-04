<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    require 'phpmailer/src/Exception.php';
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "open_elective";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    function generateRandomPassword($length = 4) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomPassword = '';
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomPassword;
    }

    $sql = "SELECT Email, Roll_no FROM open_ele";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $email = $row["Email"];
            $id = $row["Roll_no"];
            

            $pass = generateRandomPassword();
            $updateSql = "UPDATE open_ele SET Pass='$pass' WHERE Roll_no='$id'";
            if ($conn->query($updateSql) === TRUE) {
            } else {
                echo "Error updating password for ID: $id: " . $conn->error . "<br>";
            }
    
            $mail = new PHPMailer(true);
    
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'enterGmail@gmail.com'; 
                $mail->Password = 'Enter Password'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                
                $mail->setFrom('Enter Gmail@gmail.com', 'Mailer');
                $mail->addAddress($email); 
                
                $mail->isHTML(true);
                $mail->Subject = 'Course Registration';
                $mail->Body    = "Your ID and Password for the course registration is follow <br><br>ID: $id<br>Password: $pass";
                $mail->AltBody = "ID: $id\nPassword: $pass";
    
                $mail->send();
            } catch (Exception $e) {
            }
        }

    } else {
        echo "No records found";
    }
    $conn->close();    
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "open_elective";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql1 = "SELECT Roll_no, Email, Pass FROM open_ele"; 
$result = $conn->query($sql1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPEN ELECTIVE</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            padding: 0;
            border: 0;
            box-sizing: border-box;
            margin: 0;
        }
        body {
            font-family: monospace;
            background: linear-gradient(#8282dc,#b286de,#e8b98a);
            caret-color: transparent;
            min-height: 100vh;
            width: 100vw;
        }
        ::-webkit-scrollbar {
            width: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            padding: 3rem;
            flex-direction: column;
        }
        .row {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 80%;
            height: 100%;
            flex-direction: column;
            gap: 5rem;
            flex-wrap: wrap;
            background: rgba(255, 255, 255, 0.2); 
            background: transparent;
            border-radius: 1rem; 
            backdrop-filter: blur(2rem); 
            box-shadow: 0 4px 6px #7a7070;
            padding: 5rem;
        }
        .roww {
            display: flex;
            justify-content: space-around;
            align-items: center;
            font-size: 2rem;
            padding: 1rem;
        }
        i {
            border-radius: 50%;
            background: #fff;
            padding: 0.5rem;
            background: rgba(255, 255, 255, 0.2); 
            backdrop-filter: blur(2rem); 
            box-shadow: 0 1px 6px #7a7070;
        }
        table {
            font-size: 1.2rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="roww">
            <a href="http://localhost/OPEN_ELECTIVE/"><i class="fa-solid fa-right-to-bracket" style="rotate: 180deg;"></i></a>
        </div>
        <div class="row">
            <div class="col">
                <h2>Students Mail and Passwords</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ROLL NO</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row["Roll_no"]; ?></td>
                                <td style="text-align: left; padding-left: 0.4rem;"><?php echo $row["Email"]; ?></td>
                                <td><?php echo $row["Pass"]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>