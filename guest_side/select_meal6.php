<?php
require_once("../connection.php");
require_once("fetch_packages.php");
session_name("user_session");
session_start();
if (!isset($_SESSION['user_id'])) {
  header("location: login.php");
}
$transact = $_GET['transact'];
$type = $_GET['type'];
$user_id = $_SESSION['user_id'];
if ($type == 'reception') {
  $table = 'reception_reservation_record';
}
if ($type == 'recollection') {
  $table = 'recollection_reservation_record';
}
if ($type == 'retreat') {
  $table = 'retreat_reservation_record';
}
if ($type == 'seminar') {
  $table = 'seminar_reservation_record';
}
if ($type == 'training') {
  $table = 'training_reservation_record';
}

$sql = "SELECT * FROM $table WHERE transaction_num = '$transact'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$date1 = $row['check_in'];
$datefrom = strtotime($date1);
$date2 = $row['check_out'];
$dateto = strtotime($date2);
$diff =  $dateto - $datefrom;
$days = floor($diff / (60 * 60 * 24));
//echo $days;
if ($days == 0) {
  $days = 1;
}
$totalCost = $row['price'] * $row['guest'] * $days;
if (isset($_POST['submit'])) {
  $image = $_FILES['pic']['name'];

  $sql = "UPDATE $table SET proof_of_payment ='$image', payment_method = 'Gcash', total = '$totalCost', timestamp = NOW() WHERE transaction_num = '$transact'";
  $conn->query($sql) or die($conn->error);


  header('Location: guest_dashboard.php?success=Submitted successfully');
}
if (isset($_POST['send'])) {
  $image = $_FILES['pic']['name'];

  $sql = "UPDATE $table SET proof_of_payment ='$image', payment_method = 'Pay-on-Site', total = '$totalCost', timestamp = NOW() WHERE transaction_num = '$transact'";
  $conn->query($sql) or die($conn->error);


  header('Location: guest_dashboard.php?success=Submitted successfully');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- FONT AWESOME CDN LINK -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
  <!-- BOOTSTRAP CDN LINK -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <!-- GOOGLE CDN LINK -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <!-- MAIN STYLE (GUEST-SIDE) -->
  <link rel="stylesheet" href="./css/guest-style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,500,1,0" />
  <link rel="stylesheet" href="./css/reservation-styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <title>Reservation</title>
</head>

<body>
  <div class="row justify-content-center">


    <div class="card col-md-6 mt-3 mb-5">
      <div class="card-body">
        <section>
          <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="d-flex flex-row align-items-center">
              <h4 class="text-uppercase mt-1"><?php echo $transact; ?></h4>

            </div>
            <form action="delete.php" method="post">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Cancel and Return to Website
              </button>

              <!-- Modal -->
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">

                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5 class="modal-title" id="staticBackdropLabel">Cancel Reservation?</h5>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="delete" class="btn btn-primary">Confirm</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <input type="hidden" name="id" value="<?php echo $row['transaction_num']; ?>">
          </form>
          <div class="row">
            <div class="col-md-5 col-lg-5 col-xl-5 mb-3 mb-md-0">
              <h5 class="mb-0 text-success"><?php echo '₱' . $row['total'] . '.00'; ?></h5>
              <h5 class="mb-3"><?php echo $row['package']; ?></h5>
              <div>

                <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row mt-1">
                    <h6><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h6>
                  </div>
                </div>
                <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row mt-1">
                    <h6><?php echo $row['contact_no']; ?></h6>
                  </div>
                </div>
                <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row mt-1">
                    <h6><?php echo $row['guest'] . ' person/s'; ?></h6>
                  </div>
                </div>
                <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row mt-1">
                    <h6><?php echo 'From ' . $row['check_in']; ?></h6>
                    <h6><?php echo 'To ' . $row['check_out']; ?></h6>
                  </div>
                </div>
                <hr />
                <h5 class="mb-3">Meals</h5>
                <h6><?php echo $row['breakfast']; ?></h6>
                <h6><?php echo $row['lunch']; ?></h6>
                <h6><?php echo $row['dinner']; ?></h6>
                <h6><?php echo $row['dessert']; ?></h6>
                <h6><?php echo $row['drinks']; ?></h6>
                <hr>
                <!-- Button trigger modal -->


                <!-- Modal -->
                <form method="post" enctype="multipart/form-data">
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">GCash Details</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="d-flex flex-column mb-3">
                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                              <input type="text" class="btn-check" name="options" autocomplete="off" />
                              <label class="btn btn-outline-primary btn-lg" for="option2">
                                <div class="d-flex justify-content-between">

                                  <span>Gcash Number</span>
                                  <span>09123456789</span>


                                </div>
                              </label>

                              <input type="radio" class="btn-check" name="options" autocomplete="off" checked />
                              <label class="btn btn-outline-primary btn-lg" for="option2">
                                <div class="d-flex justify-content-between">
                                  <span>Account Name</span>
                                  <span>Trinitas</span>
                                </div>
                              </label>
                            </div>
                          </div>
                          <div>
                            <label>Upload Screenshot of Payment: </label><br>
                            <img id="thumb" src="" width="200px" />
                            <input type="hidden" name="payment" value="Gcash">
                            <input class="form-control" type="file" name="pic" onchange="preview()">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>

                <div class="d-flex flex-column mb-3">
                  <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                    <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" data-bs-toggle="modal" data-bs-target="#exampleModal" />
                    <label class="btn btn-outline-primary btn-lg" for="option1">
                      <div class="d-flex justify-content-between">

                        <span>Gcash</span>
                        <span>09123456789</span>


                      </div>
                    </label>


                  </div>
                </div>
                <form method="post">
                  <input type="hidden" name="total">
                  <button class="btn-outline-primary btn-lg" type="submit" name="send">Pay on Site</button>
                </form>
              </div>
            </div>
            <div class=" col-lg-4 col-xl-5 offset-lg-1 offset-xl-2">
              <div class="p-3" style="background-color: #eee;">
                <span class="fw-bold">Reservation Recap</span>
                <div class="d-flex justify-content-between mt-2">
                  <span>Package Price</span> <span><?php echo '₱' . $row['price']; ?></span>
                </div>
                <?php
                $package = $row['package'];
                if ($package == 'Catering Package') { ?>
                  <div class="d-flex justify-content-between mt-2">
                    <span>Additional per head</span> <span>₱450</span>
                  </div>
                <?php  } ?>


                <div class="d-flex justify-content-between mt-2">
                  <span>Number of Days</span> <span><?php echo $days; ?></span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                  <span>Guest</span> <span><?php echo $row['guest']; ?></span>
                </div>
                <hr />


                <div class="d-flex justify-content-between mt-2">
                  <span>Total </span> <span class="text-success"><?php echo '₱' . $row['total'] . '.00'; ?></span>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- CASA MARIA RETREAT PACKAGES MODAL -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



  <script src="./js/package_modal.js"></script>
  <script src="./js/date-time-selector-modal.js"></script>
  <script>
    function incrementValue() {
      const inputElement = document.getElementById("guest_count");
      let value = parseInt(inputElement.value, 10);
      value = isNaN(value) ? 0 : value;
      inputElement.value = value + 1;
    }

    function decrementValue() {
      const inputElement = document.getElementById("guest_count");
      let value = parseInt(inputElement.value, 10);
      value = isNaN(value) ? 0 : value;
      if (value > 0) {
        inputElement.value = value - 1;
      }
    }
  </script>
  <script type="text/javascript">
    function preview() {
      thumb.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>

</body>