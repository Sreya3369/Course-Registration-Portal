<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "open_elective";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT Branch,Course FROM open_ele WHERE Roll_no = '$id'";
    $result = $conn->query($sql); 
    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $branch = $row["Branch"];
                $course = $row["Course"];
            }
        }
    }  
    else {
        echo "error";
    }    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .row {
            padding: 1rem;
            width: 60%;
            height: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto; 
            background: rgba(255, 255, 255, 0.2); 
            border-radius: 1rem; 
            backdrop-filter: blur(2rem); 
            box-shadow: 0 4px 6px #7a7070;
        }

        .roww {
            padding: 1rem;
            width: 100%;
            height: 35%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
        }
        i{
            font-size: 2rem;
        }
        .rowe {
            max-width: fit-content;
            padding: 0.5rem;
            margin: auto;
            background: rgba(255, 255, 255, 0.2); 
            border-radius: 50%; 
            backdrop-filter: blur(2rem); 
            box-shadow: 0 4px 6px #7a7070;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
<body>
    <div class="container">
        <div class="row">
            <div class="display-6 text-center">You have <span class="text-success">successfully</span> enrolled</div>
            <form action="">
                <div class="roww">
                    <div class="col">
                        <div class="display-6">Roll Number</div>
                        <div class="display-6">Branch</div>
                        <div class="display-6">Course</div>
                    </div>
                    <div class="col">
                        <div class="display-6 text-muted">: <?php echo "".$id; ?></div>
                        <div class="display-6 text-muted">: <?php echo "".$branch; ?></div>
                        <div class="display-6 text-muted">: <?php echo "".strtoupper($course); ?></div>
                    </div>
                </div>
                <div class="rowe"><a href="http://localhost/OPEN_ELECTIVE/"><i class="fa-solid fa-right-to-bracket" style="rotate: 180deg;"></i></a></div>
            </form>        
        </div>
    </div>
</body>
</head>
</html>