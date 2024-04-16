<?php

$server = "localhost";
$user = "ufcbrn2ioh9hv";
$pw = "2*12+hr1%g)/";
$db = "dbgmgoblwbwygo";
$connect = mysqli_connect($server, $user, $pw, $db);

if (!$connect)
{
    print ("ERROR: Cannot connect to database $db or server $server using username $user (".mysqli_connect_erno() . ", " . mysqli_connect_error(). ")");
}

$userQuery = "SELECT name FROM users";

$result = mysqli_query($connect, $userQuery);

if (!$result)
{
    print ("Could not successfully run query ($userQuery) from $db: " . mysqli_error($connect) );
}

if (mysqli_num_rows($result) == 0 )
{
    print ("No records found with query $userQuery");
}
else
{
    print ("<h1>List of Users</h1>");
    print ("<table>");
    print ("<tr><th>Name</th></tr>");
    while ($row = mysqli_fetch_assoc($result))
    {
        print ("<tr><td>" . $row['name'] . "</td></tr>");
    }
    print ("<table>");
}

mysqli_close($connect);
?>
