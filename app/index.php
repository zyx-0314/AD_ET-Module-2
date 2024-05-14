<?php
    session_start();

    $name = "";

    if (isset($_SESSION["name"])) {
        $name = $_SESSION["name"];
    }

    $thisHoldsArray = array("Cow","Dog","Buff","Bull","Ant","Elephant",);

    $civilStatus = array("Single","Married","Widowed/Widower","Divorced");

    $GradesofStudent = array("A", "B", "C", "D", "E", "F");

    $GradesPerSubject = array(
        "English" => "90",
        "Filipino" => "80",
        "Math" => "89",
        "Science" => "93",
    );

    $fruits = array(
        "Apple"=> "https://www.shutterstock.com/image-photo/red-apple-isolated-on-white-600nw-1727544364.jpg",
        "Orange" => "https://media.gettyimages.com/id/185284489/photo/orange.jpg?s=612x612&w=gi&k=20&c=HZYbLyTgUgxD1WE-O-ltBo_Lui6pX6rQLHQJdYdyl_g="
    );

    $placeholder = '';

    function addTwoValues($a, $b) {
        return $a + $b;
    }

    function continuesAddValueStatic($a) {
        static $total = 0;
        $total += $a;
        return $total;
    }

    function continuesAddValue($a) {
        $total = 0;
        $total += $a;
        return $total;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing lang jud</title>
</head>

<body>
    <section>
        <h2>Addition function Sample: Local variable</h2>
        <p>
            <?php
                echo addTwoValues(1, 5);
            ?>
        </p>
    </section>
    <section>
        <h2>Addition function Sample: Static variable</h2>
        <p>
            <?php
                for ($i=1; $i < 20; $i+=$i) {
                    echo continuesAddValueStatic($i);
                    echo "<br>";
                }
            ?>
        </p>
    </section>
    <section>
        <h2>Addition function Sample: Local variable</h2>
        <p>
            <?php
                for ($i=1; $i < 20; $i+=$i) {
                    echo continuesAddValue($i);
                    echo "<br>";
                }
            ?>
        </p>
    </section>

    <section>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $key = htmlspecialchars($_POST["display"]);
                echo $key;
                $placeholder = $fruits[$key];
            }
            ?>
        <form method="post">
            <select name="display" id="display">
                <?php

                    foreach ($fruits as $key => $value) {
                        $toggle = ($placeholder == $key) ? "selected" : "";
                        echo '<option value="' . $key . '"' . $toggle . '>' . $key . '</option>';
                    }
                ?>
            </select>
            <button type="submit">Submit</button>
        </form>
        <div>
            <?php
                echo '<img src="' . $placeholder . '" alt="" width="100px" height="100px" style="border: 1px solid black">'
            ?>
        </div>
    </section>

    <?php
        for ($i=0; $i < 10; $i++) { 
            echo "<br>";
        }
    ?>
    <section>
        <h2>Enter your name: <?php echo $name?></h2>

        <form action="" method="post">
            <label for="">Name: </label>
            <input type="text" name="name" id="">
            <input type="hidden" name="key" value="inputName" >
            <button
                type="submit"
            >Submit</button>
        </form>

        <form action="" method="post">
            <div>
                <label for="">Value 1</label>
                <input type="number" name="number1" id="">
            </div>
            <div>
                <label for="">Value 2</label>
                <input type="number" name="number2" id="">
            </div>
            <input type="hidden" name="key" value="compute2value">
            <button type="submit">Submit</button>
        </form>

        <form action="" method="post">
            <label for="">How many sorry</label>
            <input type="number" name="number" id="">
            <input type="hidden" name="key" value="sorry">
            <button type="submit">Submit</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $key = htmlspecialchars($_POST["key"]);
                switch ($key) {
                case "inputName":
                    $nameHolder = htmlspecialchars($_POST["name"]);
                    $_SESSION["name"] = $nameHolder;
                    break;
                case "compute2value":
                    $a = htmlspecialchars($_POST["number1"]);
                    $b = htmlspecialchars($_POST["number2"]);
                    echo $a ." + ". $b ." = " . $a + $b;
                    break;
                case "sorry":
                    $howMany = htmlspecialchars($_POST["number"]);
                    for($i = 0; $i < $howMany; $i++)
                    {
                        echo "<p>" . ($i + 1) . " Sorry!</p>";
                    }
                    break;
                default:
                    echo "None of the choices";
                    break;
                }
            }
        ?>
    </section>

    <section>
        <div>
        <?php
            var_dump($thisHoldsArray);
        ?>
        </div>
    </section>

    <section>
        <select name="" id="">
            <?php
            for ($i=0; $i < count($civilStatus); $i++) {
                echo "<option value='" . $civilStatus[$i] . "'>" . $civilStatus[$i] . "</option>";
            }
            ?>
        </select>
    </section>

    <section>
        <select name="" id="">
            <?php
                foreach ($GradesofStudent as $key => $value) {
                    echo "<option>". $key ."". $value ."</option>";
                }
            ?>
        </select>
    </section>

    <section>
        <ul>
            <?php
                foreach ($GradesPerSubject as $key => $value) {
                    echo "<li>". $key .": ". $value ."</li>";
                }
            ?>
        </ul>
    </section>

    <section>
        <div>
            <?php
            foreach ($fruits as $key => $value) {
                echo '<img src="' . $value . '" alt="' . $key . '" srcset="" width="100px" height="100px">';
                echo'<p>' . $key . '</p>';
            }
            ?>
        </div>
    </section>
</body>

</html>