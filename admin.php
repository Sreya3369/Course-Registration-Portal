<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "open_elective";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql1 = "SELECT * FROM fcc";
$result1 = $conn->query($sql1);

$sql2 = "SELECT * FROM os";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM fot";
$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM open_ele";
$result4 = $conn->query($sql4);
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
        #row {
            width: 80%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            padding: 0.2rem;       
            margin: auto;     
            background: #258;
            background: linear-gradient(#4b4bbe66,#4f4fba);
            border-radius: 1rem; 
            backdrop-filter: blur(2rem); 
            box-shadow: 0 4px 6px #7a7070;
        }
        #row button {
            padding: 0.2rem;
            background: transparent;
            color: #e7e763;
            outline: none;
            border: none;
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
                <form method="POST" action="password_genrator.php">
                <div id="row">
                    <h3>Generate Passwords</h3>
                    <button type="submit">Click Here</button>
                </div>
                </form>
            </div>
            <div class="col">
                <h2>All Students</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ROLL NO</th>
                            <th scope="col">BRANCH</th>
                            <th scope="col">COURSE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result4->fetch_assoc()) { 
                            if($row["Status"] == 0) continue ?>
                        <tr>
                            <td><?php echo $row["Roll_no"]; ?></td>
                            <td><?php echo $row["Branch"]; ?></td>
                            <td><?php echo $row["Course"]; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <h2>CSE <span style="font-size: 1.2rem; color:#e7e763">(FCC - 2max)</span></h2>
                <table class="table table-hover primary">
                    <thead>
                        <tr>
                            <th scope="col">ROLL NO</th>
                            <th scope="col">BRANCH</th>
                            <th scope="col">COURSE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result1->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["ROLL_NO"]; ?></td>
                            <td><?php echo $row["BRANCH"]; ?></td>
                            <td><?php echo $row["COURSE"]; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <h2>CSE <span style="font-size: 1.2rem; color:#e7e763">(OS - 3max)</span></h2>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ROLL NO</th>
                            <th scope="col">BRANCH</th>
                            <th scope="col">COURSE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result2->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["ROLL_NO"]; ?></td>
                            <td><?php echo $row["BRANCH"]; ?></td>
                            <td><?php echo $row["COURSE"]; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <h2>Mechanical <span style="font-size: 1.2rem; color:#e7e763">(3max)</span></h2>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ROLL NO</th>
                                <th>BRANCH</th>
                                <th>COURSE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result3->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row["ROLL_NO"]; ?></td>
                                <td><?php echo $row["BRANCH"]; ?></td>
                                <td><?php echo $row["COURSE"]; ?></td>
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