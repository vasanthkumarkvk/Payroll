<?php
include "header.php";


include "../users/db.php";

session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../users/login/index.php");
    exit();
}

$name = $_SESSION['name'];

$sql = "SELECT *FROM employees WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$name);

if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

    }
}else{
    echo "error";
}
?>

<div class="section mt-[10px]">
    <div class="heading text-center">
        <h1 class="text-[30px]">Reason Form -1</h1>
    </div>
    <div class="form_div w-full p-[50px]">
    <form action="check_reason.php" method="POST" class="flex items-center justify-center">
    <div class="elements flex justify-evenly w-full">
        <!-- Left Side -->
        <div class="leftside flex flex-col gap-[20px]">
            <!-- Employee ID -->
            <div class="inputs flex flex-col gap-2">
                <label for="employee_id" class="text-[22px]">Employee ID <span class="text-red-500">*</span></label>
                <input type="text" class="w-[400px] p-[5px] rounded-[4px]" readonly  name="employee_id" id="employee_id" value="<?php echo htmlspecialchars($row['user_id']); ?>">
            </div>

            <!-- Employee Name -->
            <div class="inputs flex flex-col gap-2">
                <label for="employee_name" class="text-[22px]">Employee Name <span class="text-red-500">*</span></label>
                <input type="text" class="w-[400px] p-[5px] rounded-[4px]" readonly  name="employee_name" id="employee_name" value="<?php echo htmlspecialchars($name); ?>">
            </div>

            <!-- Join Date -->
            <div class="inputs flex flex-col gap-2">
                <label for="join_date" class="text-[22px]">Join Date <span class="text-red-500">*</span></label>
                <input type="text" class="w-[400px] p-[5px] rounded-[4px]" readonly  name="join_date" id="join_date" value="<?php echo htmlspecialchars($row['join_date']); ?>">
            </div>

            <!-- Reason Dropdown -->
            <div class="inputs flex flex-col gap-2">
                <label for="reason_select" class="text-[22px]">Reason for Exit <span class="text-red-500">*</span></label>
                <select name="reason_select" id="reason_select" class="w-[400px] p-[10px] border-2 rounded-[4px]" required>
                    <option value="" disabled selected>Select a reason</option>
                    <option value="Better Career Opportunity">Better Career Opportunity</option>
                    <option value="Personal Reasons">Personal Reasons</option>
                    <option value="Relocation">Relocation</option>
                    <option value="Health Issues">Health Issues</option>
                    <option value="Retirement">Retirement</option>
                    <option value="Company Policy Disagreement">Company Policy Disagreement</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Additional Reason (Optional) -->
            <div class="inputs flex flex-col gap-2" id="additional_reason" style="display: none;">
                <textarea name="other_reason" id="additional_info" class="p-[10px] w-[400px] border-2 rounded-[4px]" cols="30" rows="5" placeholder="Enter The Reason (if applicable)"></textarea>
            </div>
        </div>

        <!-- Right Side -->
        <div class="rightside flex flex-col gap-[20px]">
            <!-- Role -->
            <div class="inputs flex flex-col gap-2">
                <label for="role" class="text-[22px]">Role <span class="text-red-500">*</span></label>
                <select name="role" id="role" class="w-[400px] p-[10px] border-2 rounded-[4px]" required>
                    <option value="" disabled selected>Select a role</option>
                    <option value="Manager">Manager</option>
                    <option value="Developer">Developer</option>
                    <option value="Tester">Tester</option>
                    <option value="Support Staff">Support Staff</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Additional Role (Optional) -->
            <div class="inputs flex flex-col gap-2" id="other_role_div" style="display: none;">
                <textarea name="other_role" id="other_role" class="p-[10px] w-[400px] border-2 rounded-[4px]" cols="30" rows="2" placeholder="Enter role"></textarea>
            </div>

            <!-- Relieving Date -->
            <div class="inputs flex flex-col gap-2">
                <label for="relieving_date" class="text-[22px]">Relieving Date <span class="text-red-500">*</span></label>
                <input type="text" class="w-[400px] p-[5px] rounded-[4px]" readonly  name="relieving_date" id="relieving_date" value="<?php echo date("d-m-Y"); ?>">
            </div>

            <!-- Additional Information (Optional) -->
            <div class="inputs flex flex-col gap-2">
                <label for="additional_info" class="text-[22px]">Additional Information (Optional)</label>
                <textarea name="additional_info" id="additional_info" class="p-[10px] w-[400px] border-2 rounded-[4px]" cols="30" rows="5" placeholder="Provide more details (if any)"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="inputs">
                <button type="submit" class="bg-blue-500 text-white px-[20px] py-[10px] rounded-[4px] hover:bg-blue-600">
                    Submit
                </button>
            </div>
        </div>
    </div>
</form>

    </div>
</div>

<script>
    // Show textarea if "Other" is selected
    document.getElementById('reason_select').addEventListener('change', function () {
        const additionalReason = document.getElementById('additional_reason');
        if (this.value === 'Other') {
            additionalReason.style.display = 'block';
        } else {
            additionalReason.style.display = 'none';
        }
    });
</script>

<script>
    // Show textarea if "Other" is selected for role
    document.getElementById('role').addEventListener('change', function () {
        const otherRoleDiv = document.getElementById('other_role_div');
        if (this.value === 'Other') {
            otherRoleDiv.style.display = 'block';
        } else {
            otherRoleDiv.style.display = 'none';
        }
    });
</script>
