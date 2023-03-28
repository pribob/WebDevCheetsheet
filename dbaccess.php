<?php


//include_once "../utils/dbaccess.php";
$serverName = "localhost";           // guide für DB https://youtu.be/gCo6JqGMi30?t=1801
$DBusername = "root"; //muss auf jeden Fall geändert werden für Release -> PoLP
$DBpassword = "";    //Passwort vergeben für Release
$DBname = "db";
$conn = mysqli_connect($serverName, $DBusername, $DBpassword, $DBname);        // das i nach sql wichtig
if (!$conn)     // wenn connection failed gibts error
{
    die("Connection failed: " . mysqli_connect_error());
}
function usernameTaken($conn, $username)            // taken 
{
    $sql = "SELECT * FROM users WHERE usersUid = ?;";   // ? = ein platzhalter sql injection schutz
    $stmt = mysqli_stmt_init($conn);     // schützen vor huans
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?page=register&error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s",  $username);   // parameter an das statment gebunden statt ? der username, bindfunction stellt sicher keine injection
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);    // holt result raus

    if ($row = mysqli_fetch_assoc($resultData))    // speichert zeile in row die gecheckt wurde davor,  stellt sicher das nur erstellt wird wenns keinen user gibt
    {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
function createUser($conn, $anrede, $firstname, $lastname, $email, $username, $pwd, $typ, $status, $aktivinaktiv)             // sicherheit
{
    $sql = "INSERT INTO users (usersAnrede, usersVorname, usersNachname, usersEmail, usersUid, usersPassword, usersTyp, usersStatus, oneAktiv_zeroInaktiv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);     
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?page=register&error=usernametaken");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssssssi", $anrede, $firstname, $lastname, $email, $username, $hashedPwd, $typ, $status, $aktivinaktiv);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php?page=login&error=none");
    exit();
}