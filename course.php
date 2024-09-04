<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "open_elective";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$limits = [
    'FOT' => 3,
    'OS' => 3,
    'FCC' => 2,
];

$counts = [];
foreach ($limits as $table => $limit) {
    $sql = "SELECT COUNT(*) as count FROM $table";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $counts[$table] = $row["count"];
    } else {
        $counts[$table] = 0;
    }
}

$conn->close();
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['branch']) && isset($_POST['course'])) {
        $branch = $_POST["branch"];
        $course = $_POST["course"];

        if (empty($branch) || empty($course)) {
            echo '<script>alert("Fill Everything")</script>';
        } else {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "open_elective";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO $course (ROLL_NO, BRANCH, COURSE) VALUES ('$id', '$branch', '$course')";
            if ($conn->query($sql) === TRUE) {
                $sql_update = "UPDATE open_ele SET Status = 1, Branch = '$branch', Course = '$course' WHERE Roll_no = '$id'";
                if ($conn->query($sql_update) === TRUE) {
                    header("Location: result.php?id=" . $id);
                    exit();
                } else {
                    echo '<script>alert("Failed to update status")</script>';
                }
            } else {
                echo '<script>alert("Error: ' . $conn->error . '")</script>';
            }

            $conn->close();
        }
    } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>OPEN ELECTIVE REGISTRATION</title>
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
            height: 100%;
            width : 100%;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        form {
            width: 60%;
            height: 40%;
        }
        .row {
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            width: 100%;
            margin: auto;
            height: 100%;
            background: rgba(255, 255, 255, 0.2); 
            border-radius: 1rem; 
            backdrop-filter: blur(2rem); 
            box-shadow: 0 4px 6px #7a7070;
        }
        .col {
            display: flex;
            align-items: center;
            justify-content: center;
            /* width: 60%;
            height: 45%; */
            flex-direction: column;
            gap: 1rem;
            font-size: 2rem;
            padding: 2rem;
        }
        option{
            padding: 5rem;
            border-radius: 1rem;
            cursor: pointer;
        }
        select {
            padding: 1rem;
            font-size: 2rem;
            width: 5rem;
            text-align: center;
            cursor: pointer;
        }
        input {
            border: none;
            border-radius: 1rem;
            padding: 0.2rem;
            width: 80%;
            cursor: no-drop; 
        }
        .btns {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3rem;
        }
        button,a {
            outline: none;
            border: none;
            color: #0659f2;
            background: none;
        }
        i{
            font-size: 2rem;
        }
        .col select, input{
            width: 70%;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>">
            <div class="row">
                <div class="col">
                    <input type="text" style="text-align: center;" value="<?php echo $id ?>" disabled>
                    <select name="branch" class="sone form-select form-select-lg">
                        <option selected>Select Branch</option>
                        <option value="MECH">MECHANICAL</option>
                        <option value="CSE">CSE</option>
                    </select>
                    <select name="course" class="stwo form-select form-select-lg">
                        <option selected>Select Course</option>
                    </select>
                </div>
                <div class="btns">
                    <a href="http://localhost/OPEN_ELECTIVE/" style="text-decoration: none;"><i class="fa-solid fa-right-to-bracket" style="rotate: 180deg;"></i></a>
                    <button type="submit"><i class="fa-solid fa-right-to-bracket"></i></button>
                </div>
            </div>
        </form>
    </div>
    <script>
        <?php
            echo "const counts = " . json_encode($counts) . ";";
            echo "const limits = " . json_encode($limits) . ";";
        ?>
        
        const firstSelect = document.querySelector('.sone');
        const secondSelect = document.querySelector('.stwo');

        const options = {
            MECH: ['FOT'],
            CSE: ['OS', 'FCC']
        };

        firstSelect.addEventListener('change', function() {
            const selectedValue = firstSelect.value;
            secondSelect.innerHTML = '<option selected>Select Course</option>';
            if (options[selectedValue]) {
                options[selectedValue].forEach(item => {
                    if (counts[item] < limits[item]) {
                        const option = document.createElement('option');
                        option.value = item.toLowerCase();
                        option.textContent = item;
                        secondSelect.appendChild(option);
                    }
                });
            }
        });

        secondSelect.addEventListener('change', function() {
            const firstSelectedValue = firstSelect.value;
            const secondSelectedValue = secondSelect.value;
            console.log('First Select:', firstSelectedValue);
            console.log('Second Select:', secondSelectedValue);
        });
    </script>
</body>
</html>
