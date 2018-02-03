<?php
    include_once '../db/database.php';
    session_start();
    //  if ($_SESSION['logged_in'] == true) {
        # code...
    //  }
    $test_name = $_POST['test_name'];
    $test_id = $_POST['test_id'];
    $sql = "SELECT * FROM test_questions WHERE test_id = $test_id";
    $result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html>
<head>
    <?php  include '../include/meta_include.php' ?>
    <meta charset="utf-8">
    <title>Test Review</title>
    <?php  include '../include/css_include.php' ?>
    <link rel="stylesheet" href="../css/master.css">
    <?php  include '../include/staff_navbar_css.php' ?>
</head>
<body>
    <!--Navbar-->
    <?php  include '../include/staff_navbar_include.php' ?>

    <!--Test Review-->
    <div class="content-wrapper my-5">
        <div class="container my-3">
            <div class="card mb-5">
                <h5 class="card-header">Test Review</h5>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $test_name; ?></h5>
                    <?php
                        if (isset($_SESSION['message']) AND !empty($_SESSION['message'])){
                            echo "<div class='alert alert-warning' role='alert'>".$_SESSION['message']."</div><br>";
                        }
                        unset($_SESSION["message"]);

                        $i = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['correct_option'] == 1) {
                                $correct_option = "A";
                            }
                            elseif ($row['correct_option'] == 2) {
                                $correct_option = "B";
                            }
                            elseif ($row['correct_option'] == 3) {
                                $correct_option = "C";
                            }
                            elseif ($row['correct_option'] == 4) {
                                $correct_option = "D";
                            }
                            echo "<div class='card my-3'>
                                    <h5 class='card-header'>".($i+1).". ".$row['question']."</h5>
                                    <div class='card-body'>
                                        <div class='row'>
                                            <div class='mx-4 col-md-5'>
                                                <div class='row'>
                                                    <p>A. ".$row['option_1']."</p>
                                                </div>
                                                <div class='row'>
                                                    <p>B. ".$row['option_2']."</p>
                                                </div>
                                                <div class='row'>
                                                    <p>C. ".$row['option_3']."</p>
                                                </div>
                                                <div class='row'>
                                                    <p>D. ".$row['option_4']."</p>
                                                </div>
                                            </div>
                                            <div class='offset-2 col-md-4'>
                                                <div class='row'>
                                                    <p><i>Marks </i>: ".$row['marks']."</p>
                                                </div>
                                                <div class='row'>
                                                    <p><i>Correct Option </i>: ".$correct_option."</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                            $i++;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Exam-in 2018</small>
            </div>
        </div>
    </footer>
    <?php  include '../include/create_test_modal_include.php' ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <?php include '../include/js_include.php' ?>
    <?php include '../include/staff_master_js_include.php' ?>
</body>
</html>
