<?php
    include("../includes/connection.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/sb-admin.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Book</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add New Book
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" action="process_book_add.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Book Name</label>
                                        <?php
                                            if (isset($_SESSION['error']['bnm'])) {
                                                echo '<p class="error">' . $_SESSION['error']['bnm'] . '</p>';
                                            }
                                        ?>
                                        <input type="text" name="bnm" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Book Category</label>
                                        <select name="cat" class="form-control">
                                            <?php
                                                $cq = "SELECT * FROM category";
                                                $cres = mysqli_query($link, $cq);

                                                while ($crow = mysqli_fetch_assoc($cres)) {
                                                    echo '<option value="'.$crow['cat_id'].'">'.$crow['cat_nm'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Rest of the form fields -->

                                    <button type="submit"  class="btn btn-default">Add Book</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </form>

                                <?php
                                    unset($_SESSION['error']);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/sb-admin.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" defer></script> 


</body>
</html>

<?php
    include("includes/footer.php");
?>
