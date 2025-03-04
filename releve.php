<?php
include "header.php";
include "db.php"; 

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $table_name = "exit_office";

    // Fetch data from the exit_office table
    $query = "SELECT * FROM $table_name WHERE user_id = '$user_id'";
    $result = mysqli_query($payroll_conn, $query);
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h4>Exit Office Details</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Last Working Day</th>
                            <th>HR Approval</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>{$row['user_id']}</td>
                                        <td>{$row['name']}</td>
                                        <td>{$row['designation']}</td>
                                        <td>{$row['department']}</td>
                                        <td>{$row['last_working_day']}</td>
                                        <td>{$row['hr_approvel']}</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='13' class='text-center'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include "footer.php"; ?>
