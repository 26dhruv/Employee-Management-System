<?php
if (isset($_GET['state'])) {
    include "./Config.php";
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Retrieve cities based on state parameter
    $stateCode = $_GET["state"];
    $sql = "SELECT city_id, city FROM city_master WHERE state_id = '$stateCode'";
    $result = mysqli_query($conn, $sql);
    $cities = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $cities[] = $row;
    }
    mysqli_close($conn);
    // Return cities as JSON-encoded string
    echo json_encode($cities);
}
if (isset($_GET['city'])) {
    include "./Config.php";
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Retrieve cities based on state parameter
    $cityCode = $_GET["city"];
    $sql = "SELECT area_id, area FROM area_master WHERE city_id = '$cityCode'";
    $result = mysqli_query($conn, $sql);
    $areas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $areas[] = $row;
    }
    mysqli_close($conn);
    // Return cities as JSON-encoded string
    echo json_encode($areas);
}
if (isset($_GET['uni'])) {
    include "./Config.php";
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Retrieve cities based on state parameter
    $uniCode = $_GET["uni"];
    $sql = "SELECT clg_id, clg_name FROM college_master WHERE uni_id = '$uniCode'";
    $result = mysqli_query($conn, $sql);
    $unis = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $unis[] = $row;
    }
    mysqli_close($conn);
    // Return cities as JSON-encoded string
    echo json_encode($unis);
}
if (isset($_GET['dep'])) {
    include "./Config.php";
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Retrieve cities based on state parameter
    $depCode = $_GET["dep"];
    $sql = "SELECT desi_id, desi_name FROM designation_master WHERE dept_id = '$depCode'";
    $result = mysqli_query($conn, $sql);
    $desis = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $desis[] = $row;
    }
    mysqli_close($conn);
    // Return cities as JSON-encoded string
    echo json_encode($desis);
}
