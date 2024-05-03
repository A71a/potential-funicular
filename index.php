<!DOCTYPE html>
<html lang='tr'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='index.css'>
    <title>terminoloji</title>
</head>

<body>
    <center>
        <form id="search" method="POST">
            <input type="text" name="search" placeholder="Arama Yap..">
            <button name="ara" value="search">Ara</button>
        </form>
    </center>
    <?php
    $host = 'localhost';
    $user = 'root';
    $passwd = '';
    $db_name = 'terminoloji';
    $con = mysqli_connect($host, $user, $passwd, $db_name);
    $res = mysqli_query($con, 'select * from terminoloji');
    $name = '';
    $term = '';
    $türkçe = '';
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
    }
    if (isset($_GET['term'])) {
        $term = $_GET['term'];
    }
    if (isset($_GET['türkçe'])) {
        $türkçe = $_GET['türkçe'];
    }
    $sqls = '';
    if (isset($_GET['add'])) {
        $sqls = "insert into terminoloji value ('$name','$term','$türkçe')";
        mysqli_query($con, $sqls);
        header("location: index.php");
    }
    if (isset($_GET['dal'])) {
        $sqls = "delete from terminoloji where name='$name'";
        mysqli_query($con, $sqls);
        header("location: index.php");
    }
    ?>

    <div id='mother'>
        <form method='POST'>
            <aside>
                <div id='div'>
                    <img src='sh1.png' alt='logo' width="100">
                    <h3>Terminoloji</h3>
                    <label>name</label><br>
                    <input type='text' name='name' id='name'><br>
                    <label>term</label><br>
                    <input type='text' name='term' id='term'><br>
                    <label>türkçe</label><br>
                    <!-- <input type='text' name='term' id='term'><br>
                    <label>1</label><br>
                    <input type='text' name='term' id='term'><br>
                    <label>2</label><br> -->
                    <input type='text' name='türkçe' id='tr'><br>
                    <button name='add'>ekle</button>
                    <button name='dal'>sil</button>
                </div>
            </aside>
            <main>
                <table id='tbl'>
                    <tr>
                        <th>name</th>
                        <th>term</th>
                        <th>Türkçe</th>
                        <th>1</th>
                        <th>2</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['term'] . '</td>';
                        echo '<td>' . $row['türkçe'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </main>
        </form>
    </div>
    <center>
    <?php
        if (isset($_GET['ara'])) {
        ?>
            <?php
            $host = 'localhost';
            $user = 'root';
            $passwd = '';
            $db_name = 'terminoloji';
            $search = $_GET["search"];
            $con = mysqli_connect($host, $user, $passwd, $db_name);
            $sh = mysqli_query($con, "select * from terminoloji where name like '%$search%' or term like '%$search%' or türkçe like '%$search%' ");
            ?> <div id="sha">
            <table id='tbl'>
                <tr>
                    <th>name</th>
                    <th>term</th>
                    <th>Türkçe</th>
                    <th>1</th>
                    <th>2</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($sh)) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['term'] . '</td>';
                    echo '<td>' . $row['türkçe'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </table><br><br><br>
            <style>
                #mother {
                    display: none;
                }
            </style>
            <a href="#" style="color: white;" onclick="show()">Geri Dön</a>
        <?php
        }
        ?>
        </div>
    </center>
    <script>
        function show(){
            document.getElementById('mother').style.display="block";
            document.getElementById('sha').style.display="none";
        }
    </script>
    
</body>

</html>