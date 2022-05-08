<?php
function deleteTableFromContactDB($name, $subject){
    $conn = getPDO();

    // PREPARED QUERY - Delete infos in contact table
    $querystring = "DELETE FROM contact WHERE name=:name and subject=:subject";
    $query = $conn->prepare( $querystring );
    $query->bindParam(':name',$name);
    $query->bindParam(':subject',$subject);
    $query->execute();

    closePDO($conn);
}

function printContactDB(){
    $conn = getPDO();

    // PREPARED QUERY - Print infos about contact table
    $querystring = "SELECT * FROM contact";
    $query = $conn->prepare( $querystring );
    $query->execute();

    echo "<table><tbody>";
    while ($row = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
        echo "<tr>";
            echo "<td> Name : " . $row[1] . "</td>";
            if(empty($row[2]))
                echo "<td> Phone : no phone advise </td>"; 
            else
                echo "<td> Phone : " . $row[2] . "</td>"; 
            echo "<td> Email : " . $row[3] . "</td>";
            echo "<td> Subject : " . $row[4] . "</td>";
            echo "<td> Question : " . $row[5] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";

    closePDO($conn);
}

function clearContactDB(){
    $conn = getPDO();

    // PREPARED QUERY - Clear all infos in contact table
    $querystring = "DELETE FROM contact";
    $query = $conn->prepare( $querystring );
    $query->execute();

    closePDO($conn);
}
?>