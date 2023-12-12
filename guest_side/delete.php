<?php 
function connection(){

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "trinitas";
    $conn = new mysqli($host, $username, $password, $database);

    if($conn->connect_error){
        echo $conn->connect_error;
    }else{
        return $conn;
    }
}
$conn = connection();
if(isset($_POST['delete'])){

    $id = $_POST['id'];
    
    $sql = "DELETE FROM reception_reservation_record WHERE transaction_num = '$id' ";
    $conn->query($sql) or die ($conn->error);

    $sql = "DELETE FROM recollection_reservation_record WHERE transaction_num = '$id' ";
    $conn->query($sql) or die ($conn->error);

    $sql = "DELETE FROM retreat_reservation_record WHERE transaction_num = '$id' ";
    $conn->query($sql) or die ($conn->error);

    $sql = "DELETE FROM seminar_reservation_record WHERE transaction_num = '$id' ";
    $conn->query($sql) or die ($conn->error);

    $sql = "DELETE FROM training_reservation_record WHERE transaction_num = '$id' ";
    $conn->query($sql) or die ($conn->error);

    header('Location: guest_dashboard.php');

}
	
 ?>