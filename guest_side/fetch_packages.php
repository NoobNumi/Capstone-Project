<?php
function getPackageDetails($packageName) {
    $conn = new mysqli("localhost", "root", "", "trinitas");

    $packageName = $conn->real_escape_string($packageName);

    $query = "SELECT description, price FROM packages WHERE name = '$packageName'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}

function getAmenitiesByPackageId($packageId) {
    $conn = new mysqli("localhost", "root", "", "trinitas");

    $query = "SELECT amenities.amenity_name, amenities.amenity_icon 
            FROM package_amenities 
            INNER JOIN amenities ON package_amenities.amenity_id = amenities.amenity_id 
            WHERE package_amenities.package_id = $packageId";

    $result = $conn->query($query);

    $amenities = array();
    while ($row = $result->fetch_assoc()) {
        $amenities[] = $row;
    }

    $conn->close();

    return $amenities;
}
function getImagesByPackageId($packageId) {
    $conn = new mysqli("localhost", "root", "", "trinitas");

    $query = "SELECT package_images.image_path
            FROM package_images 
            INNER JOIN packages ON package_images.package_id = packages.package_id 
            WHERE package_images.package_id = $packageId";

    $result = $conn->query($query);

    $images = array();
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }

    $conn->close();

    return $images;
}
?>
