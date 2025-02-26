<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        button.btn.btn-primary, button.btn.btn-secondary {
            margin-top: 26px;
        }
        button.btn.btn-secondary {
            margin-right: 10px;
        }
        .form-group {
            padding-top: 14px;
        }
        label {
            padding-bottom: 8px;
        }
        .button {
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }

        .main {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 700px;
}

.progress_bar {
    width: 70%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    margin: 46px;
}

.progress_bar span {
    background-color: #0d6efd;
    padding: 22px 36px;
    border-radius: 50%;
    color: white;
    font-size: 30px;
    z-index: 2;
}

.progress_line {
    position: absolute;
    top: 50%;
    width: 50%;
    height: 2px;
    background-color: #0d6efd;
    z-index: 1;
}

.progress_bar span:first-child {
    margin-left: 0;
}

.progress_bar span:last-child {
    margin-right: 0; 
}

.heading {
    text-align: center;
}

.btn {
    margin-top: 20px;
}
span.bg p {
    margin: 0px;
}



    </style>
</head>
<body>

<?php 
include "../db.php"; 

session_start();

$show_modal = false; 
$show_form = true; 

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

}

?>



<form id="employeeForm" method="POST" action="employee_document.php" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">

    <div class="container">
        <!-- Progress Bar -->
        <div class="row" style="padding-top:20px;">
            <div class="col-12">
                <div class="progress">
                    <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

        <div class="row" style="padding:20px;">
            <!-- Step 1: Employee Information -->
            <div class="col-md-12 form-step" id="step1">
                <h4>Step 1: Employee Document-1</h4>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="certificate">Degree Certificate: <span style="color:red;">Required *</span></label>
                        <input type="file" id="certificate" name="certificate" class="form-control" required>
                        
                    </div>
                </div>
                <div class="button" style="border-bottom: 2px solid #000;padding-bottom: 15px;">
                    <button type="button" class="btn btn-primary" onclick="nextStep(1)">Next</button>
                </div>
            </div>

            <!-- Step 2: Contact Information -->
            <div class="col-md-12 form-step" id="step2" style="display:none;">
                <h4>Step 2: Employee Document-2</h4>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exp_certificate" id="exp_label">Experience Certificate:<span style="color:green;"> Optional *</span></label>
                        <input type="file" id="exp_certificate" name="exp_certificate" class="form-control">

                    </div>
                </div>
                <div class="button" style="border-bottom: 2px solid #000;padding-bottom: 15px;">
                    <button type="button" class="btn btn-secondary" onclick="previousStep(2)">Previous</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                </div>
            </div>

            <!-- Step 3: Course Certificate -->
            <div class="col-md-12 form-step" id="step3" style="display:none;">
                <h4>Step 3: Course Certificate</h4>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="course_certificate">Course Certificate:<span style="color:green;"> Optional *</span> </label>
                        <input type="file" id="course_certificate" name="course_certificate" class="form-control">

                    </div>
                </div>
                <div class="button" style="border-bottom: 2px solid #000;padding-bottom: 15px;">
                    <button type="button" class="btn btn-secondary" onclick="previousStep(3)">Previous</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                </div>
            </div>

            <!-- Step 4: Confirm and Submit -->
            <div class="col-md-12 form-step" id="step4" style="display:none;">
                <h4>Step 4: Confirm and Submit</h4>
                <p>Please review your details before submitting the form.</p>
                <p style="color:red;">Importent Must Submit The Degree Certificate *</p>
                <div id="summary" class="text-start"></div>
                <div class="button">
                    <button type="button" class="btn btn-secondary" onclick="previousStep(4)">Previous</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
let currentStep = 1;

function nextStep(step) {
    document.getElementById('step' + step).style.display = 'none';
    document.getElementById('step' + (step + 1)).style.display = 'block';
    updateProgressBar(step + 1);
}

function previousStep(step) {
    document.getElementById('step' + step).style.display = 'none';
    document.getElementById('step' + (step - 1)).style.display = 'block';
    updateProgressBar(step - 1);
}

function updateProgressBar(step) {
    const progress = (step / 4) * 100; // Updated to 4 steps
    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = progress + '%';
    progressBar.setAttribute('aria-valuenow', progress);
}

// Additional functionality to show a summary of form data in Step 4
document.getElementById('employeeForm').addEventListener('submit', function (event) {
    const step4 = document.getElementById('step4');
    if (step4 && step4.style.display !== 'none') {
        event.preventDefault();
        const summary = document.getElementById('summary');
        summary.innerHTML = '';

        const formData = new FormData(this);
        for (const [key, value] of formData.entries()) {
            const label = document.querySelector(`label[for=${key}]`)?.textContent || key;
            summary.innerHTML += `<p><strong>${label}:</strong> ${value.name || value}</p>`;
        }

        summary.innerHTML += `<button type="button" class="btn btn-success" onclick="submitForm()">Confirm and Submit</button>`;
    }
});

function submitForm() {
    document.getElementById('employeeForm').submit();
}
</script>



</body>
</html>
