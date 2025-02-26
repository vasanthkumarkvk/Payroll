<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>VSM Payroll Management </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/custome_style.css">

    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/img/vsmlogo-favicon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding: 0;
        }

        span.icon-menu{
            color: black;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 60px;

        }

        .section {
            background-color: #0044cc4a;
            padding: 25px;
            margin-bottom: 25px;
            border-radius: 4px;
        }

        h2,
        h3 {
            color: black;
            margin-bottom: 15px;

        }

        .back-btn {
            background: #1F3BB3;
            color: #ffffff;
            width: 50px;
            height: 50px;
            border-radius: 30px;
            margin: 20px;
            border: none;

        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
        }

        .section-header h3 {
            margin: 0;
            font-size: 20px;
        }

        .edit-btn {
            color: #007bff;
            cursor: pointer;
        }

        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        table th {
            color: black;
            background-color: #0044cc4a;
            width: 30%;
        }

        table td {
            color: black;
        }

        .action-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 20px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
            font-size: 16px;
            margin: 5px;
            min-width: 150px;
        }

        .btn.dismiss {
            background-color: #0f5fdc;
        }

        .btn.dismiss:hover {
            background-color: #e6b800;
            transform: scale(1.05);
        }

        .btn.delete {
            background-color: #0f5fdc;
        }

        .btn.delete:hover {
            background-color: #e60000;
            transform: scale(1.05);
        }

        .btn.stop-salary {
            background-color: #0f5fdc;
        }

        .btn.stop-salary:hover {
            background-color: #d95e00;
            transform: scale(1.05);
        }

        .btn.disable-login {
            background-color: #0f5fdc;
        }

        .btn.disable-login:hover {
            background-color: #007bb5;
            transform: scale(1.05);
        }

        .resend-email {
            color: #007bff;
            cursor: pointer;
            font-size: 14px;
            text-decoration: underline;
            margin-left: 20px;
        }

        button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            display: block;
        }

        /* Submit button style */
        button[type="submit"]:not([name="action"]) {
            background-color: #28a745;
            /* Green color */
            color: white;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:not([name="action"]):hover {
            background-color: #218838;
            /* Darker green on hover */
        }

        /* View button style */
        button[name="action"] {
            background-color: #007bff;
            /* Blue color */
            color: white;
            transition: background-color 0.3s ease;
        }

        button[name="action"]:hover {
            background-color: #0056b3;
            /* Darker blue on hover */

        }


        /* Media Queries for Mobile Responsiveness */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .section {
                padding: 20px;
            }

            .section-header h3 {
                font-size: 18px;
            }

            table th,
            table td {
                padding: 8px;
                font-size: 14px;
            }

            .btn {
                padding: 10px;
                font-size: 14px;
                min-width: 120px;
            }

            button {
                padding: 8px 16px;
                font-size: 14px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            h2,
            h3 {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            table th,
            table td {
                padding: 6px;
                font-size: 12px;
            }

            .btn {
                padding: 8px;
                font-size: 12px;
                min-width: 100px;
            }

            button {
                padding: 6px 12px;
                font-size: 12px;
            }

            .action-buttons {
                flex-direction: row;
            }
        }
    </style>

</head>

<body class="with-welcome-text">
    <div class="container-scroller">


    <?php  include "top_nav.php";  ?>

        <!-- end of header  -->
        <!-- sidebar  -->
        <!-- partial -->


        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
      <?php  include "side_nav.php";  ?>


            <?php
            // Include your database connection
            include "../database.php";

            // Check if employee_user_id is set in the URL
            if (isset($_GET['id'])) {
                $employee_user_id = $_GET['id'];

                // Fetch data for the specific employee
                $sql = "SELECT * FROM run_payslip WHERE employee_user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $employee_user_id);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $employee = $result->fetch_assoc();

                    // Check if employee data is retrieved
                    if (!$employee) {
                        echo "No employee found with the ID: " . htmlspecialchars($employee_user_id);
                    }
                } else {
                    echo "SQL execution error: " . htmlspecialchars($stmt->error);
                }

                $stmt->close(); // Close the prepared statement
            } else {
                header("Location: run_pay.php");
                exit();
            }

            $conn->close(); // Close the database connection
            ?>


            <div class="main-panel">
                <div class="content-wrapper">
                    <div style="margin-bottom: 10px; width: 60px;height: 60px;border-radius: 37px;">
                        <button id="backButton" class="back-btn">
                            <i class="fas fa-arrow-left"></i></button>
                    </div>
                    <!-- <div class="container"> -->


                    <!-- Basic Information Section -->
                    <div class="section">
    <div class="section-header">
        <h3>Basic Information</h3>
        <span onclick="openBasicInfoEditModal()" class="edit-btn">Edit</span>
    </div>
    <?php if (isset($employee) && !empty($employee)): ?>

        <table>
            <tr>
                <th>Employee ID:</th>
                <td><?php echo htmlspecialchars($employee['employee_user_id']); ?></td>
            </tr>

            <tr>
                <th>Name:</th>
                <td><?php echo htmlspecialchars($employee['employee_name']); ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo htmlspecialchars($employee['email']); ?></td>
            </tr>
            <tr>
                <th>Date of Hiring:</th>
                <td id="basicHiringDate"><?php echo htmlspecialchars($employee['hire_date']); ?></td>
            </tr>
            <tr>
                <th>Designation:</th>
                <td id="basicDesignation"><?php echo htmlspecialchars($employee['designation']); ?></td>
            </tr>

            <tr>
                <th>Department:</th>
                <td id="basicDepartment"><?php echo htmlspecialchars($employee['department']); ?></td>
            </tr>
            <tr>
                <th>Manager:</th>
                <td id="basicManager"><?php echo htmlspecialchars($employee['manager']); ?></td>
            </tr>
            <tr>
                <th>Location:</th>
                <td><?php echo htmlspecialchars($employee['location']); ?></td>
            </tr>
        </table>
</div>

<!-- Basic Info Edit Modal (Variant names for IDs and classes) -->
<div id="basicInfoEditModal" class="basic-info-modal" style="display:none;">
    <div class="basic-info-modal-content">
        <span class="basic-info-close-btn" onclick="closeBasicInfoEditModal()">&times;</span>
        <h4>Edit Basic Information</h4>
        <form id="basicInfoEditForm">
            <label for="basic_designation">Designation:</label>
            <input type="text" id="basic_designation" name="basic_designation" value="<?php echo htmlspecialchars($employee['designation']); ?>" required><br><br>

            <label for="basic_department">Department:</label>
            <input type="text" id="basic_department" name="basic_department" value="<?php echo htmlspecialchars($employee['department']); ?>" required><br><br>

            <label for="basic_manager">Manager:</label>
            <input type="text" id="basic_manager" name="basic_manager" value="<?php echo htmlspecialchars($employee['manager']); ?>" required><br><br>

            <label for="basic_hiring_date">Date of Hiring:</label>
            <input type="date" id="basic_hiring_date" name="basic_hiring_date" value="<?php echo htmlspecialchars($employee['hire_date']); ?>" required><br><br>

            <button type="submit" id="basicInfoSubmitUpdate">Update</button>
        </form>
    </div>
</div>

<!-- JavaScript for Modal and AJAX Update -->
<script>
    // Open the Basic Info Edit Modal
    function openBasicInfoEditModal() {
        document.getElementById('basicInfoEditModal').style.display = 'block';
    }

    // Close the Basic Info Edit Modal
    function closeBasicInfoEditModal() {
        document.getElementById('basicInfoEditModal').style.display = 'none';
    }

    // Handle form submission via AJAX
    document.getElementById('basicInfoEditForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get the new values from the form
        const designation = document.getElementById('basic_designation').value;
        const department = document.getElementById('basic_department').value;
        const manager = document.getElementById('basic_manager').value;
        const hireDate = document.getElementById('basic_hiring_date').value;

        // Use AJAX to update the values without reloading the page
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_basic_info.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // On success, update the displayed values and close the modal
                document.getElementById('basicDesignation').innerText = designation;
                document.getElementById('basicDepartment').innerText = department;
                document.getElementById('basicManager').innerText = manager;
                document.getElementById('basicHiringDate').innerText = hireDate;
                closeBasicInfoEditModal();
            } else {
                alert('Error updating basic information.');
            }
        };
        xhr.send(`designation=${designation}&department=${department}&manager=${manager}&hire_date=${hireDate}&employee_id=<?php echo $employee['employee_user_id']; ?>`);
    });
</script>

<!-- Styles for the Modal -->
<style>
    .basic-info-modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
        z-index: 9999;
    }

    .basic-info-modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        z-index: 99999;
    }

    .basic-info-close-btn {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        float: right;
    }

    .basic-info-close-btn:hover,
    .basic-info-close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    #basicInfoEditForm {
        display: flex;
        flex-direction: column;
    }

    #basicInfoEditForm input {
        margin-bottom: 10px;
        padding: 8px;
        font-size: 16px;
    }

    #basicInfoEditForm button {
        padding: 10px;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    #basicInfoEditForm button:hover {
        background-color: #45a049;
    }
</style>


                        <!-- Compensation and Payroll Details -->
                        <div class="section">
    <div class="section-header">
        <h3>Compensation & Perquisites</h3>
        <span onclick="openCompensationEditModal()" class="edit-btn">Edit</span>
    </div>
    <table>
        <tr>
            <th>Gross Salary:</th>
            <td id="annualSalary"><?php echo htmlspecialchars($employee['gross_salary']); ?></td>
        </tr>
        <tr>
            <th>Bonus:</th>
            <td id="bonus"><?php echo htmlspecialchars($employee['bonus']); ?></td>
        </tr>
        <tr>
            <th>Total Compensation:</th>
            <td id="totalCompensation"><?php echo htmlspecialchars($employee['total_compensation']); ?></td>
        </tr>
    </table>
</div>

<!-- Compensation Edit Modal (Variant names for IDs and classes) -->
<div id="compensationEditModal" class="compensation-modal" style="display:none;">
    <div class="compensation-modal-content">
        <span class="compensation-close-btn" onclick="closeCompensationEditModal()">&times;</span>
        <h4>Edit Compensation & Perquisites</h4>
        <form id="compensationEditForm">
            <label for="compensation_annual_salary">Annual Salary:</label>
            <input type="text" id="compensation_annual_salary" name="compensation_annual_salary" value="<?php echo htmlspecialchars($employee['gross_salary']); ?>" ><br><br>

            <label for="compensation_bonus">Bonus:</label>
            <input type="text" id="compensation_bonus" name="compensation_bonus" value="<?php echo htmlspecialchars($employee['bonus']); ?>" ><br><br>

            <label for="compensation_total_compensation">Total Compensation:</label>
            <input type="text" id="compensation_total_compensation" name="compensation_total_compensation" value="<?php echo htmlspecialchars($employee['total_compensation']); ?>" ><br><br>

            <button type="submit" id="compensationSubmitUpdate">Update</button>
        </form>
    </div>
</div>

<!-- JavaScript for Modal and AJAX Update -->
<script>
    // Open the Compensation Edit Modal
    function openCompensationEditModal() {
        document.getElementById('compensationEditModal').style.display = 'block';
    }

    // Close the Compensation Edit Modal
    function closeCompensationEditModal() {
        document.getElementById('compensationEditModal').style.display = 'none';
    }

    // Handle form submission via AJAX
    document.getElementById('compensationEditForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get the new values from the form
        const annualSalary = document.getElementById('compensation_annual_salary').value;
        const bonus = document.getElementById('compensation_bonus').value;
        const totalCompensation = document.getElementById('compensation_total_compensation').value;

        // Use AJAX to update the values without reloading the page
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_compensation.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // On success, update the displayed values and close the modal
                document.getElementById('annualSalary').innerText = annualSalary;
                document.getElementById('bonus').innerText = bonus;
                document.getElementById('totalCompensation').innerText = totalCompensation;
                closeCompensationEditModal();
            } else {
                alert('Error updating compensation details.');
            }
        };
        xhr.send(`annual_salary=${annualSalary}&bonus=${bonus}&total_compensation=${totalCompensation}&employee_id=<?php echo $employee['employee_user_id']; ?>`);
    });
</script>

<!-- Styles for the Modal -->
<style>
    .compensation-modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
        z-index: 999999;
    }

    .compensation-modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        z-index: 99999;
    }

    .compensation-close-btn {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        float: right;
    }

    .compensation-close-btn:hover,
    .compensation-close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    #compensationEditForm {
        display: flex;
        flex-direction: column;
    }

    #compensationEditForm input {
        margin-bottom: 10px;
        padding: 8px;
        font-size: 16px;
    }

    #compensationEditForm button {
        padding: 10px;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    #compensationEditForm button:hover {
        background-color: #45a049;
    }
</style>


                        <!-- Leave and Attendance Section -->
                        <!-- <div class="section">
                            <div class="section-header">
                                <h3>Leave and Attendance</h3>
                                <span class="edit-btn">Edit</span>
                            </div>
                            <table>
                                <tr>
                                    <th>Present Days:</th>
                                    <td>20</td>
                                </tr>
                                <tr>
                                    <th>Absent Days:</th>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <th>Holidays:</th>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <th>Leave Status:</th>
                                    <td>Approved</td>
                                </tr>
                            </table>
                        </div> -->

                        <!-- Employee Bank Details Section -->
                        <div class="section">
                            <div class="section-header">
                                <h3>Employee Bank Details</h3>
                                </div>
                            <table>
                             
                            
                                <tr>
                                    <th>Account Number:</th>
                                    <td><?php echo htmlspecialchars($employee['account_number']); ?></td>
                                </tr>
                                <tr>
                                    <th>IFSC Number:</th>
                                    <td><?php echo htmlspecialchars($employee['ifsc_number']); ?></td>
                                </tr>
                                <tr>
                                    <th>Bank Name:</th>
                                    <td><?php echo htmlspecialchars($employee['bank_name']); ?></td>
                                </tr>
                                <tr>
                                    <th>Account Holder Name:</th>
                                    <td><?php echo htmlspecialchars($employee['employee_name']); ?></td>
                                </tr>
                            </table>

                        </div>

                        <!-- Other Information Section -->
                        <div class="section">
                            <div class="section-header">
                                <h3>Other Information</h3>
                            </div>
                            <table>
                                <tr>
                                    <th>Date of Birth:</th>
                                    <td><?php echo htmlspecialchars($employee['dob']); ?></td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td><?php echo htmlspecialchars($employee['gender']); ?></td>
                                </tr>
                                <tr>
                                    <th>Phone Number:</th>
                                    <td><?php echo htmlspecialchars($employee['phone_number']); ?></td>
                                </tr>
                                <tr>
                                    <th>Qualification:</th>
                                    <td><?php echo htmlspecialchars($employee['qualifications']); ?></td>
                                    <!-- Make sure 'qualification' is available in the employee array -->
                                </tr>
                                <tr>
    <th>Document Submission:</th>
    <td>
        <!-- Degree Certificate -->
        <?php if (!empty($employee['degree_certificate'])): ?>
            <button class="view-btn" data-img="<?php echo '../../users/' . htmlspecialchars($employee['degree_certificate']); ?>">View Degree Certificate</button>
        <?php else: ?>
            <span>No degree_certificate Image Uploaded</span>
        <?php endif; ?>
        
        <!-- Experience Certificate -->
        <?php if (!empty($employee['experiance_certificate'])): ?>
            <button class="view-btn" data-img="<?php echo '../../users/' . htmlspecialchars($employee['experiance_certificate']); ?>">View Experience Certificate</button>
        <?php else: ?>
            <span>No experiance_certificate Image Uploaded</span>
        <?php endif; ?>
        
        <!-- Course Certificate -->
        <?php if (!empty($employee['course_certificate'])): ?>
            <button class="view-btn" data-img="<?php echo '../../users/' . htmlspecialchars($employee['course_certificate']); ?>">View Course Certificate</button>
        <?php else: ?>
            <span>No course_certificate Image Uploaded</span>
        <?php endif; ?>
    </td>
</tr>

<!-- Modal for Viewing Images -->
<div id="imageModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <div id="imageContainer">
            <p id="noImageMessage">No image uploaded</p>
            <img id="modalImage" src="" alt="" style="display:none; width:100%; max-width:500px;">
        </div>
    </div>
</div>

<!-- JavaScript to handle modal and image viewing -->
<script>
    // Get modal and elements
    const modal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const noImageMessage = document.getElementById("noImageMessage");
    const closeBtn = document.getElementsByClassName("close-btn")[0];

    // Event listener for the "View" buttons
    const viewButtons = document.querySelectorAll(".view-btn");
    viewButtons.forEach(btn => {
        btn.addEventListener("click", function() {
            const imageUrl = this.getAttribute("data-img");
            if (imageUrl) {
                modalImage.src = imageUrl;
                modalImage.style.display = "block";
                noImageMessage.style.display = "none";
            } else {
                modalImage.style.display = "none";
                noImageMessage.style.display = "block";
            }
            modal.style.display = "block"; // Show modal
        });
    });

    // Close modal when "X" is clicked
    closeBtn.onclick = function() {
        modal.style.display = "none";
    };

    // Close modal if clicked outside of the modal content
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
</script>

<!-- Styles for the Modal -->
<style>
    /* Modal Style */
  

    .close-btn {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        float: right;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    #imageContainer {
        text-align: center;
    }

    #noImageMessage {
        font-size: 18px;
        color: red;
    }
</style>

                            </table>
                        </div>

                        <!-- User Roles & Permissions -->
                      <!-- Employee Role Section -->
<div class="section">
    <div class="section-header">
        <h3>User Roles & Permissions</h3>
        <span onclick="openRoleEditModal()" class="edit-btn">Edit</span>
    </div>
    <table>
        <tr>
            <th>Employee Type:</th>
            <td id="employee_type"><?php echo htmlspecialchars($employee['employee_type']); ?></td>
        </tr>
    </table>
</div>

<!-- Role Edit Modal -->
<div id="roleEditModal" class="role-modal" style="display:none;">
    <div class="role-modal-content">
        <span class="role-close-btn" onclick="closeRoleEditModal()">&times;</span>
        <h4>Edit Employee Type</h4>
        <form id="roleEditForm">
            <label for="role_employee_type">Employee Type:</label>
            <input type="text" id="role_employee_type" name="employee_type" value="<?php echo htmlspecialchars($employee['employee_type']); ?>" required><br><br>
            <button type="submit" id="roleSubmitUpdate">Update</button>
        </form>
    </div>
</div>
<script>
    // Function to open the role edit modal
function openRoleEditModal() {
    document.getElementById('roleEditModal').style.display = 'block';
}

// Function to close the role edit modal
function closeRoleEditModal() {
    document.getElementById('roleEditModal').style.display = 'none';
}

// Handle the form submission via AJAX
document.getElementById('roleEditForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get the new employee type value from the input field
    const employeeType = document.getElementById('role_employee_type').value;

    // Use AJAX to send the updated data to the server
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_user_role.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // If successful, update the displayed employee type and close the modal
            document.getElementById('employee_type').innerText = employeeType;
            closeRoleEditModal();
        } else {
            alert('Error updating employee role.');
        }
    };

    // Send the employee type and employee_id via POST
    xhr.send(`employee_type=${employeeType}&employee_id=<?php echo $employee['employee_user_id']; ?>`);
});

</script>
<style>
    .role-modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1000; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scrolling if necessary */
    background-color: rgba(0, 0, 0, 0.4); /* Semi-transparent background */
}

/* Modal Content */
.role-modal-content {
    background-color: #fff;
    margin: 15% auto; /* Center the modal */
    padding: 20px;
    border: 1px solid #888;
    width: 60%; /* Adjust based on your preference */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
}

/* Close Button */
.role-close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.role-close-btn:hover,
.role-close-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Edit Button */
.edit-btn {
    cursor: pointer;
    color: #007bff;
    font-size: 14px;
    text-decoration: underline;
}

.edit-btn:hover {
    color: #0056b3;
}

</style>
                        <!-- Action Buttons -->
                      

                    </div>

                <?php else: ?>
                <?php endif; ?>

                <!-- </div> -->
            </div>
        </div>


    </div>
    <!-- partial -->
    </div>

    <script>
        document.getElementById('backButton').addEventListener('click', function () {
            // Get the URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const ref = urlParams.get('ref');

            // Redirect based on the ref parameter
            if (ref === 'people') {
                window.location.href = 'people.php';
            } else if (ref === 'run_pay') {
                window.location.href = 'run_pay.php';
            } else {
                window.history.back(); // fallback in case ref is missing
            }
        });
    </script>



    <!-- footer -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"> <a
                    href="https://www.vsmglobaltechnologies.com/" target="_blank">VSM Global
                    Technologies.com</a>
            </span>
            <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2024. All rights
                reserved.</span>
        </div>
    </footer>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/template.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="../assets/js/dashboard.js"></script>


</body>

</html>