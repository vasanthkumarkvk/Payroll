<?php
include '../database.php'; // Include your database connection

// Initialize the employee 
$employee_email = isset($_GET['email']) ? $_GET['email'] : null;


if ($employee_email) {
    // Prepare the SQL query to fetch employee data
    $sql = "SELECT employee_name, employee_user_id FROM run_payslip WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $employee_email); // Bind the employee email as string
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any data was returned
        if ($result->num_rows > 0) {
            // Fetch the employee name and user ID
            $row = $result->fetch_assoc();
            $employee_name = htmlspecialchars($row['employee_name']);
            $employee_user_id = htmlspecialchars($row['employee_user_id']);
        } else {
            echo "No employee found with the given email.";
            exit(); // Exit if employee not found
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the statement.";
        exit(); // Exit if there's an error
    }






    // Now, fetch the advance amount from the advance_salary table using the employee_user_id
    if ($employee_user_id) {
        $sql_advance = "SELECT * FROM advance_salary WHERE employee_user_id = ? ";
        $stmt_advance = $conn->prepare($sql_advance);

        if ($stmt_advance) {
            $stmt_advance->bind_param("s", $employee_user_id); // Bind the employee_user_id as string
            $stmt_advance->execute();
            $result_advance = $stmt_advance->get_result();

            // Check if any advance data was returned
            if ($result_advance->num_rows > 0) {
                // Fetch the advance amount
                $advance_row = $result_advance->fetch_assoc();
                $advance_amount = $advance_row['advance_amount'] ? $advance_row['advance_amount'] : 0;
                $emi_amount = $advance_row['emi_amount'] ? $advance_row['emi_amount'] : 0 ;
                $advance_date = $advance_row['advance_date'];
                $remaining_advance = $advance_amount; // Set remaining advance amount initially
            } else {

            }

            $stmt_advance->close();
        } else {
            echo "Error preparing the advance statement.";
            exit();
        }
    } else {
        echo "No employee user ID found.";
        exit();
    }




    // Loop through each month to deduct EMI and display the remaining advance
    $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    $remaining_advance_each_month = [];

    foreach ($months as $month) {
        // Deduct EMI for the month
        if ($remaining_advance > 0) {
            $remaining_advance -= $emi_amount; // Deduct EMI amount
            if ($remaining_advance < 0) {
                $remaining_advance = 0; // Avoid going negative
            }
            $remaining_advance_each_month[$month] = $remaining_advance; // Store remaining advance
        } else {
            // If no advance is left, store 0 for remaining advance
            $remaining_advance_each_month[$month] = 0;
        }
    }



    // Loop through each month to fetch the corresponding gross salary
    foreach ($months as $month) {
        $sql_gross_salary = "SELECT gross_salary FROM run_payslip WHERE employee_user_id = ? AND pay_month = ?";

        if ($stmt_gross_salary = $conn->prepare($sql_gross_salary)) {
            $stmt_gross_salary->bind_param("ss", $employee_user_id, $month);
            $stmt_gross_salary->execute();
            $result_gross_salary = $stmt_gross_salary->get_result();

            if ($result_gross_salary->num_rows > 0) {
                $row_gross_salary = $result_gross_salary->fetch_assoc();
                $gross_salaries[$month] = $row_gross_salary['gross_salary'];
            } else {
                $gross_salaries[$month] = "N/A"; // Default if no data is found for the month
            }

            $stmt_gross_salary->close();
        } else {
            echo "Error preparing the statement for gross salary.";
            exit();
        }
    }

} else {
    echo "No employee email provided.";
    exit(); // Exit if there's an error
}



// Extract the month and year from the advance_date
$advance_start_month = null;
$advance_start_year = null;
if ($advance_date) {
    $advance_date_obj = new DateTime($advance_date);
    $advance_start_month = $advance_date_obj->format('M');
    $advance_start_year = $advance_date_obj->format('Y');
}

?>

<?php include "header.php" ?>


<body class="with-welcome-text">
    <div class="container-scroller">

        <?php include "top_nav.php"; ?>


        <div class=" page-body-wrapper">
            <?php include "side_nav.php" ?>


            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">



                        <h2><span id="employeeName" style="color: red; font-weight: bold;"><?php echo $employee_name; ?>
                            </span><span style="font-size:20px;">Year-(<?php echo date("Y"); ?>)</span> </h2>




                        <?php


                        $current_year = date("Y");

                        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                        // Fetch data from the database for the given employee and month
                        $sql = "SELECT * FROM salary_details WHERE employee_id = ? AND year = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("si", $employee_user_id, $current_year); // "i" stands for integer
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $salary_details = [];
                        while ($row = $result->fetch_assoc()) {
                            $salary_details[$row['month']] = $row;
                        }
                        ?>





                        <!-- Employee Salary Details Table -->
                        <div class="table">
                            <?php $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']; ?>

                            <table id="salaryTable" class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Details</th>
            <?php foreach ($months as $month): ?>
                <th id="<?= strtolower($month) ?>"><?= $month ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center">Employee ID</td>
            <td colspan="12" id="employeeIdRow"><?php echo $employee_user_id; ?></td>
        </tr>
        <tr>
            <td class="text-center">Gross Salary</td>
            <?php foreach ($months as $month): ?>
                <td id="grossSalaryRow_<?= $month ?>">
                    <?php echo isset($gross_salaries[$month]) ? $gross_salaries[$month] : 'N/A'; ?>
                </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td class="text-center">Advance Amount</td>
            <?php
            $current_advance = intval($advance_amount);
            $emi_started = false;
            foreach ($months as $month): ?>
                <td id="advanceAmountRow_<?= $month ?>">
                    <?php
                    if ($emi_started && $emi_amount > 0) {
                        $current_advance -= intval($emi_amount);
                        if ($current_advance < 0) {
                            $current_advance = 0;
                        }
                        echo $current_advance;
                    } elseif ($advance_start_month == $month) {
                        echo $current_advance;
                        $emi_started = true;
                    } else {
                        echo '';
                    }
                    ?>
                </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td class="text-center">EMI Amount (Deduction)</td>
            <?php
            $emi_started = false;
            $current_advance = intval($advance_amount);
            $emi_amount = intval($emi_amount);

            foreach ($months as $month): ?>
                <td id="emiAmountRow_<?= $month ?>">
                    <?php
                    if ($emi_amount > 0) { // Only process if EMI amount is greater than 0
                        if ($emi_started) {
                            if ($current_advance > 0) {
                                if ($current_advance < $emi_amount) {
                                    echo $current_advance;
                                    $current_advance = 0;
                                } else {
                                    echo $emi_amount;
                                    $current_advance -= $emi_amount;
                                }
                            } else {
                                echo '';
                            }
                        } elseif ($advance_start_month == $month) {
                            echo $emi_amount;
                            $emi_started = true;
                            $current_advance -= $emi_amount;
                        } else {
                            echo '';
                        }
                    } else {
                        echo ''; // Ignore calculation if EMI is zero
                    }
                    ?>
                </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td class="text-center">Total Days</td>
            <?php foreach ($months as $month): ?>
                <td id="total_days_<?= $month ?>">
                    <?php
                    $total_days = isset($salary_details[$month]) ? $salary_details[$month]['total_days'] : 0;
                    echo $total_days;
                    ?>
                </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td class="text-center">Present Days</td>
            <?php foreach ($months as $month): ?>
                <td>
                    <input type="number" id="presentDays_<?= $month ?>" min="0" max="31"
                        maxlength="2" required
                        value="<?= isset($salary_details[$month]) ? $salary_details[$month]['present_days'] : '' ?>"
                        <?php if (isset($salary_details[$month]) && $salary_details[$month]['present_days'] != '') {
                            echo 'disabled';
                        } ?>>
                </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td class="text-center">Absent Days</td>
            <?php foreach ($months as $month): ?>
                <td>
                    <input type="number" id="absentDays_<?= $month ?>" min="0" max="31"
                        maxlength="2" disabled
                        value="<?= isset($salary_details[$month]) ? $salary_details[$month]['absent_days'] : '' ?>">
                </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td class="text-center">Net Salary</td>
            <?php foreach ($months as $month): ?>
                <td id="netSalary_<?= $month ?>">
                    <?php
                    $net_salary = isset($salary_details[$month]) ? $salary_details[$month]['net_salary'] : 0;
                    echo $net_salary;
                    ?>
                </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td class="text-center">Payment</td>
            <?php foreach ($months as $month): ?>
                <td>
                    <?php
                    $payment_status = isset($salary_details[$month]) ? $salary_details[$month]['payment_status'] : null;
                    $disabled = ($payment_status && $payment_status == 'paid') ? 'disabled' : '';
                    $button_text = ($disabled) ? 'Paid' : 'Unpaid';
                    $gross_salary = isset($salary_details[$month]) ? $salary_details[$month]['gross_salary'] : 0;
                    $button_class = ($payment_status && $payment_status == 'paid') ? 'paid-btn' : 'unpaid-btn';
                    ?>

                    <button type="button" class="paymentStatusBtn <?= $button_class ?>"
                        onclick="if(confirm('Are you sure you want to update the payment?')) handlePaymentUpdate('<?= $employee_user_id ?>', '<?= $month ?>', '<?= $gross_salary ?>')
                        location.reload();" id="paymentBtn_<?= $month ?>" <?= $disabled ?>>
                        <?= $button_text ?>
                    </button>
                </td>
            <?php endforeach; ?>
        </tr>
    </tbody>
</table>





                        </div>











                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        /* Style for 'Paid' buttons */
        .paid-btn {
            background-color: green;
            /* Green background */
            color: white;
            /* White text */
            padding: 5px;
            border: navajowhite;
            border-radius: 4px;
            width: 60px;
            font-weight: bold;
        }

        /* Style for 'Unpaid' buttons */
        .unpaid-btn {
            background-color: red;
            color: white;
            padding: 5px;
            border: navajowhite;
            border-radius: 4px;
        }
    </style>


    <script>

function handlePaymentUpdate(employeeId, month, grossSalary) {
    const advanceAmount = parseFloat(document.getElementById(`advanceAmountRow_${month}`)?.innerText || 0);
    const emiAmount = parseFloat(document.getElementById(`emiAmountRow_${month}`)?.innerText || 0);
    const totalDays = parseInt(document.getElementById(`total_days_${month}`)?.innerText || 0);
    const presentDays = parseInt(document.getElementById(`presentDays_${month}`)?.value || 0);
    const absentDays = parseInt(document.getElementById(`absentDays_${month}`)?.value || 0);
    const netSalary = parseFloat(document.getElementById(`netSalary_${month}`)?.innerText || 0);

    if (isNaN(grossSalary) || isNaN(advanceAmount) || isNaN(emiAmount) || isNaN(netSalary)) {
        alert("Invalid salary data. Please check the inputs.");
        return;
    }

    fetch('save_salary.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            employee_id: employeeId,
            month: month,
            gross_salary: grossSalary,
            advance_amount: advanceAmount.toFixed(2),
            emi_amount: emiAmount.toFixed(2),
            total_days: totalDays,
            present_days: presentDays,
            absent_days: absentDays,
            net_salary: netSalary.toFixed(2)
        })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                const button = document.getElementById(`paymentBtn_${month}`);
                button.innerText = 'Paid';
                button.style.backgroundColor = 'green';
                button.style.color = 'white';
                button.disabled = true; // Disable button after saving
            } else {
                alert('Error saving data: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Fetch Error:', error);
            alert('Error connecting to the server. Check the console for details.');
        });
}

    </script>















    <!-- display year -->
    <script>
        Yeament.getElementById("currentYearDisplay").textContent = new Date().getFullYear();
    </script>



    <!-- populate dorop down -->
    <script>
        let currentYear = new Date().getFullYear();
        // Function to populate the year dropdown dynamically
        function populateYearDropdown() {
            const yearSelect = document.getElementById("yearSelect");
            const startYear = 2019;  // Set the start year
            yearSelect.innerHTML = "";
            for (let year = currentYear; year >= startYear; year--) {
                const option = document.createElement("option");
                option.value = year;
                option.textContent = year;

                // Set current year as selected by default
                if (year === currentYear) {
                    option.selected = true;
                }

                yearSelect.appendChild(option);
            }
            updateYearDisplay();
            selectYear(currentYear);

        }
        function selectYear(year) {
            currentYear = parseInt(year); // Update the current year
            updateYearDisplay(); // Update the display

            fetch_salaries(currentYear); // Fetch data for the selected year
        }

        // Function to update the year display in the title and the table headers
        function updateYearDisplay() {
            document.getElementById("currentYearDisplay").textContent = currentYear;
        }
        populateYearDropdown();
    </script>

    <!-- total days calculation -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Your existing code here...

            // Function to determine if a year is a leap year
            function isLeapYear(year) {
                return (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
            }

            // Static days for each month in a non-leap year
            const staticDays = {
                Jan: 31,
                Feb: 28,  // Default to 28, will adjust for leap year
                Mar: 31,
                Apr: 30,
                May: 31,
                Jun: 30,
                Jul: 31,
                Aug: 31,
                Sep: 30,
                Oct: 31,
                Nov: 30,
                Dec: 31
            };

            // Get the current year (or specify a year for static calculation)
            var currentYear = new Date().getFullYear();  // You can replace this with a specific year, e.g. 2024

            // Adjust February for leap year
            if (isLeapYear(currentYear)) {
                staticDays.Feb = 29;  // Update February for leap year
            }

            // Display the total days in each month in the table
            document.getElementById('total_days_Jan').innerText = staticDays.Jan;
            document.getElementById('total_days_Feb').innerText = staticDays.Feb;
            document.getElementById('total_days_Mar').innerText = staticDays.Mar;
            document.getElementById('total_days_Apr').innerText = staticDays.Apr;
            document.getElementById('total_days_May').innerText = staticDays.May;
            document.getElementById('total_days_Jun').innerText = staticDays.Jun;
            document.getElementById('total_days_Jul').innerText = staticDays.Jul;
            document.getElementById('total_days_Aug').innerText = staticDays.Aug;
            document.getElementById('total_days_Sep').innerText = staticDays.Sep;
            document.getElementById('total_days_Oct').innerText = staticDays.Oct;
            document.getElementById('total_days_Nov').innerText = staticDays.Nov;
            document.getElementById('total_days_Dec').innerText = staticDays.Dec;
        });


        //  absent calculation dynamically correpond to present days 


    </script>

    <!-- net salary calculation -->
    <script>

        // absent calculation corres to present input
        document.querySelectorAll('input[id^="presentDays_"]').forEach(input => {
            input.addEventListener('input', function () {
                let month = this.id.split('_')[1];
                let presentDays = parseInt(this.value) || 0;

                // Get the total days for the month (based on staticDays calculation)
                let totalDays = parseInt(document.getElementById(`total_days_${month}`).innerText) || 0;

                // Check if entered present days exceed total days for the month
                if (presentDays > totalDays) {
                    alert(`You cannot enter more than ${totalDays} present days for ${month}.`);
                    this.value = ''; // Clear the input field if the value is too high
                    return;
                }

                // Calculate absent days by subtracting present days from total days
                let absentDays = totalDays - presentDays;

                // Update the absent days input field
                document.getElementById(`absentDays_${month}`).value = absentDays;


                // Update the net salary based on the changes
                updateNetSalary(month);
            });
        });


        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function () {
                let value = this.value;
                if (value.length > 2) {
                    this.value = value.slice(0, 2);
                }

                let month = this.id.split('_')[1];
                let presentDays = parseInt(document.getElementById(`presentDays_${month}`).value) || 0;
                let absentDays = parseInt(document.getElementById(`absentDays_${month}`).value) || 0;
                let totalDays = presentDays + absentDays;
                updateNetSalary(month);

                let maxDays = 31;
                if (month === 'Feb') {
                    let year = currentYear;
                    maxDays = (year % 4 === 0 && (year % 100 !== 0 || year % 400 === 0)) ? 29 : 28;
                } else if (['Apr', 'Jun', 'Sep', 'Nov'].includes(month)) {
                    maxDays = 30;
                }

                if (totalDays > maxDays) {
                    alert(`Total days (Present + Absent) for ${month} should not exceed ${maxDays}`);
                    this.value = '';
                }
            });
        });

        function updateNetSalary(month) {
            let presentDays = parseInt(document.getElementById(`presentDays_${month}`).value) || 0;
            let absentDays = parseInt(document.getElementById(`absentDays_${month}`).value) || 0;

            let grossSalary = parseFloat(document.getElementById(`grossSalaryRow_${month}`).innerText) || 0;
            let emiAmount = parseFloat(document.getElementById(`emiAmountRow_${month}`).innerText.replace(/[^0-9.-]+/g, "")) || 0;

            let totalDays = presentDays + absentDays;

            if (totalDays === 0) {
                totalDays = 1;
            }


            console.log('Gross Salary: ', grossSalary);
            console.log('Present Days: ', presentDays);
            console.log('Absent Days: ', absentDays);
            console.log('Total Days: ', totalDays);
            console.log('EMI Amount: ', emiAmount);

            let netSalary = grossSalary * (presentDays / totalDays);

            if (emiAmount > 0) {
                netSalary -= emiAmount;
            }

            netSalary = netSalary.toFixed(2);
            console.log('Net Salary After Proportion: ', netSalary);


            document.getElementById(`netSalary_${month}`).innerText = netSalary;
        }

        function fetchSalaryData(employeeId, year) {
            fetch(`/path/to/your/api/salary_data.php?employee_id=${employeeId}&year=${year}`)
                .then(response => response.json())
                .then(data => {
                    Object.keys(data).forEach(month => {
                        document.getElementById(`grossSalaryRow_${month}`).innerText = data[month].grossSalary;
                    });
                });
        }
    </script>








    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            const type = urlParams.get('type');
            const email = urlParams.get('email');
            const gross = parseInt(urlParams.get('gross'));
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const currentMonthIndex = new Date().getMonth(); // Get current month index (0-11)
            const currentYear = new Date().getFullYear(); // Get current year

            const months_int = Array.from({ length: 12 }, (_, i) => `${currentYear}-${String(i + 1).padStart(2, '0')}`);

            if (type === 'manual') {
                window.location.href = "previous.php" + "?email=" + email
                // const employeeIdCell = document.getElementById('employeeIdRow');


                for (const month_name of months) {
                    const employee_id = urlParams.get('user_id');
                    const presentDaysCell = document.getElementById(`presentDays_${month_name}`);
                    const absentDaysCell = document.getElementById(`absentDays_${month_name}`);
                    const deductionsCell = document.getElementById(`total_paid_days_${month_name}`);
                    const netSalaryCell = document.getElementById(`netSalary_${month_name}`);
                    const totalDaysCell = document.getElementById(`total_days_${month_name}`);
                    const grossSalaryCell = document.getElementById(`grossSalaryRow_${month_name}`);



                    presentDaysCell.textContent = '-';
                    absentDaysCell.textContent = '-';
                    deductionsCell.textContent = '-';
                    netSalaryCell.textContent = "-";
                    grossSalaryCell.textContent = '-'
                    totalDaysCell.textContent = '-';


                }

                // Fetch the salary.json file
                return fetch('../salary.json')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json(); // Parse the JSON data
                    })
                    .then(data => {

                        // Find the user data based on email
                        const userData = data.users.find(user => user.email === email);
                        if (userData) {
                            // Loop through the salary details and update the table for the correct month and year
                            userData.salary_details.forEach(detail => {
                                const monthName = months[detail.month - 1]; // Get the month name from the month index
                                const year = detail.year;
                                if (year <= currentYear) {
                                    // Find the corresponding table row for the correct month
                                    const grossSalaryCell = document.getElementById(`grossSalaryRow_${monthName}`);
                                    const netSalaryCell = document.getElementById(`netSalary_${monthName}`);
                                    const presentDaysCell = document.getElementById(`presentDays_${monthName}`);
                                    const absentDaysCell = document.getElementById(`absentDays_${monthName}`);
                                    const deductionsCell = document.getElementById(`total_paid_days_${monthName}`);
                                    const totalDaysCell = document.getElementById(`total_days_${monthName}`);

                                    // Update the table with the salary details for that month and year
                                    netSalaryCell.textContent = `₹ ${detail.salary}`;
                                    grossSalaryCell.textContent = `₹ ${detail.gross}`;
                                    presentDaysCell.textContent = '-'; // You can replace this with actual data if available
                                    absentDaysCell.textContent = '-'; // You can replace this with actual data if available
                                    deductionsCell.textContent = '-'; // You can replace this with actual data if available
                                    totalDaysCell.textContent = '-'; // You can replace this with actual data if available

                                }
                            });
                        } else {
                            console.error("User not found!");
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching salary.json:', error);
                    });
            }

            const employeeIdCell = document.getElementById('employeeIdRow');
            const employeeId = employeeIdCell ? employeeIdCell.getAttribute('data-employee-id') : null;

            document.getElementById("downloadButton").addEventListener("click", async function () {
                const salaryData = [];

                const employeeIdCell = document.getElementById('employeeIdRow');
                const employeeId = employeeIdCell ? employeeIdCell.textContent.trim() : null;

                for (let i = 0; i < months.length; i++) {
                    const month = months_int[i];

                    const postData = new URLSearchParams();
                    postData.append('email', email);
                    postData.append('gross_salary', gross);
                    postData.append('month', month);

                    const request = await fetch("salary_details.php", {
                        method: "POST",
                        body: postData,
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    });

                    if (request.ok) {
                        const data = await request.json();
                        salaryData.push({
                            month: months[i],
                            employee_id: data.employee_user_id || '-',
                            gross_salary: gross,
                            total_days: data.total_days || '-',
                            present_days: data.total_present || '-',
                            absent_days: data.total_absent || '-',
                            total_paid_days: data.total_paid_days || '-',
                            net_salary: data.salary
                                || '-'
                        });
                    }
                }

                const form = document.createElement("form");
                form.method = "POST";
                form.action = "download.php"; // Download PHP script

                const input = document.createElement("input");
                input.type = "hidden";
                input.name = "salary_data";
                input.value = JSON.stringify(salaryData); // Send as JSON string
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            });

            async function fetch_salaries(year) {
                // Load current month first
                const currentMonthData = await fetchSalaryForMonth(currentYear, currentMonthIndex);
                updateSalaryCells(currentMonthData, currentMonthIndex);

                // Then load remaining months
                for (let i = 0; i < months.length; i++) {
                    if (i !== currentMonthIndex) {
                        const monthData = await fetchSalaryForMonth(year, i);
                        updateSalaryCells(monthData, i);
                    }
                }
            }


            fetch_salaries(currentYear); // Start fetching for the current year
        });

    </script>


    <?php include "footer_view.php"; ?>