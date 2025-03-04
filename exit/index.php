<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login/index.php");
    exit();
}
$name = $_SESSION['name'];
include "header.php";
?>
<style>
    #marketing {
        padding: 50px 0;
        font-family: 'Arial', sans-serif;
        background: linear-gradient(to right, #f9f9f9, #e3e3e3);
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .tabs {
        display: flex;
        background: white;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
    }

    .tab-links {
        display: flex;
        flex-direction: column;
        background: #2c3e50;
        padding: 10px;
        width: 15%;
        box-sizing: border-box;
    }

    .tab-link {
        background: #34495e;
        color: white;
        padding: 15px;
        text-align: left;
        font-size: 16px;
        cursor: pointer;
        margin-bottom: 5px;
        transition: all 0.3s ease;
        border-radius: 5px;
    }

    .tab-link:hover,
    .tab-link.active {
        background: rgb(26, 72, 188);
        color: white;
    }

    .tab-content {
        width: 85%;
        padding: 20px;
        box-sizing: border-box;
    }

    .tab-panel {
        display: none;
        width: 100%;
    }

    .tab-panel.active {
        display: block;
    }

    iframe {
        width: 100%;
        height: 500px;
        border: none;
    }


    .box_section {
        width: 100%;
        height: 500px;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    a.email-link {
        background-color: #007bff;
        color: white;
        padding: 20px;
        border-radius: 7px;
    }

    a.email-link:hover {

        background-color: white;
        color: #007bff;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        border: 2px solid #007bff;

    }

    .policy-heading {
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #007bff;
        text-transform: uppercase;
        /* border-bottom: 2px solid #333; */
        display: inline-block;
        width: 100%;
    }

    .policy_container {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .policy-content {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    h5 {
        font-size: 1.2em;
        font-weight: bold;
        margin-bottom: 10px;
    }

    h6 {
        font-size: 1.1em;
        font-weight: bold;
        color: #333;
        margin-top: 15px;
    }

    p {
        margin-bottom: 10px;
    }

    .policy-details {
        text-align: center;
        font-size: 1rem;
        color: #555;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .policy-details p {
        margin: 5px 0;
    }

    .acknowledgment {
    margin-top: 50px; /* Adds space before acknowledgment */
    padding-top: 20px;
    border-top: 2px solid #000; /* Optional separator */
    text-align: right;
    font-family: Arial, sans-serif;
    font-size: 16px;
    max-width: 1200px;
}

.blank {
    display: inline-block;
    width: 100px; /* Controls the blank space width */
    margin-left: 10px;
}
</style>



<section id="marketing">
    <div class="tabs">
        <div class="tab-links">
            <button class="tab-link active" onclick="openTab(event, 'tab1')">Attendance</button>
            <button class="tab-link" onclick="openTab(event, 'tab3')">Payroll</button>
            <button class="tab-link" onclick="openTab(event, 'tab4')">Email</button>
            <button class="tab-link" onclick="openTab(event, 'tab6')">Service Desk</button>
            <button class="tab-link" onclick="openTab(event, 'tab5')">Company Policy</button>
            <button class="tab-link" onclick="openTab(event, 'tab2')"> Exit Management</button>



        </div>
        <div class="tab-content">
            <div id="tab1" class="tab-panel active">
                <h3>Attendance</h3>
                <iframe src="https://attendance.vsmglobaltechnologies.com/" frameborder="0"></iframe>
            </div>

            <div id="tab2" class="tab-panel">
                <div class="box_section">
                    <a href="../exit/start_email.php?name=<?php echo htmlspecialchars($name); ?>" class="email-link"
                        id="exitLink">Exite Here</a>
                </div>
            </div>

            <div id="tab3" class="tab-panel">
                <h3>Payroll</h3>
                <iframe src="https://payroll.vsmglobaltechnologies.com/" frameborder="0"></iframe>
            </div>

            <div id="tab4" class="tab-panel">
                <div class="box_section">
                    <a href="https://webmail.hostinger.com/" target="_blank" class="email-link">Login To Mail Here</a>
                </div>
            </div>

            <div id="tab6" class="tab-panel">
                <div class="box_section">
                    <a href="https://vsmglobaltechnologies.com/service_desk/users/login/index.php" target="_blank"
                        class="email-link">Service Desk</a>
                </div>

            </div>




            <div id="tab5" class="tab-panel">
                <h3>Company Policy</h3>
                <div class="policy_container">
                    <h5 class="policy-heading">VSM Global Technologies Company Policies & Guidelines</h5>
                    <div class="policy-details">
                        <p><strong>Effective Date:</strong> 12-02-2025</p>
                        <p><strong>Company Name:</strong> VSM Global Technologies</p>
                        <p><strong>Applies To:</strong> All Employees</p>
                    </div>

                    <div class="policy-content">
                        <h6 id="policy1">1. Work Hours & Attendance</h6>
                        <p>
                            <li>Standard working hours: 9:30 AM – 6:00 PM, Monday to Saturday. </li>
                            <li>Employees must update their attendance daily using the designated attendance tool.</li>
                            <li>Punctuality is mandatory; any late arrivals should be communicated in advance.</li>
                            <li>Leaves must be applied through the attendance tool.If a leave request is not approved
                                due to business requirements, the leave will not be considered valid.</li>
                        </p>

                        <h6 id="policy2">2. Code of Conduct</h6>

                        <p>
                            <li>Maintain professionalism in all forms of communication.</li>
                            <li>Treat all team members with respect and maintain a discrimination-free and
                                harassmentfree work environment.</li>
                            <li>Confidential company information must not be shared externally or with unauthorized
                                personnel.</li>
                            <li>Ethical conduct, integrity, and transparency are mandatory in all professional dealings.
                            </li>
                            <li>Employees must ensure that the workplace remains clean and organized at all times.</li>
                        </p>

                        <h6 id="policy3">3. IT & Data Security Policies</h6>
                        <p>
                            <li>Personal email access is strictly prohibited on company laptops.</li>
                            <li>Software installation is not allowed without prior approval.</li>
                            <li>Data transfer of company-related files, codes, or documents via WhatsApp, email, or any
                                external platform is strictly prohibited.</li>
                            <li>Any violation of the above policies will result in disciplinary action</li>

                        </p>

                        <h6 id="policy4">4. Project Management & Deadlines</h6>
                        <p>
                            <li>All projects must be tracked using the designated Service Desk tool.</li>
                            <li>Weekly progress updates must be shared in team meetings.</li>
                            <li>Any potential delays must be communicated in advance to the respective project leads.
                            </li>
                        </p>

                        <h6 id="policy5">5. Cybersecurity & Data Protection</h6>
                        <p>
                            <li>Employees must use strong passwords for all work-related accounts</li>
                            <li>Unauthorized software installation is strictly prohibited.</li>
                            <li>Company data should not be shared externally under any circumstances.</li>
                            <li>Any cybersecurity concerns or breaches must be reported immediately.</li>
                        </p>

                        <h6 id="policy6">6. Leave Policy</h6>
                        <p>
                            <li>Employees who have completed a minimum of one year with the company are eligible for:
                            </li>
                        <ol>
                            <li>Annual Leave: 15 days per year.</li>
                            <li>Public Holidays: As per government regulations.</li>
                            <li>Leave requests must be submitted at least 3 days in advance (except in emergencies).
                            </li>
                            <li>If a leave request is not approved, it will not be considered valid.</li>
                        </ol>

                        </p>

                        <h6 id="policy7">7. Salary & Payment</h6>
                        <p>
                            <li>Salary disbursement will take place on the 5th of every month.</li>
                            <li>Performance-based bonuses will be considered on a case-by-case basis.</li>

                        </p>

                        <h6 id="policy8">8. Employee Benefits</h6>
                        <p>
                            <li>Opportunities for professional upskilling and career development.</li>
                            <li>Performance-based incentives to reward outstanding contributions.</li>

                        </p>

                        <h6 id="policy9">9. Communication & Meetings</h6>
                        <p>
                            <li>Daily stand-up meetings (15 minutes) are mandatory for team updates.</li>
                            <li>Weekly team meetings will be conducted to review progress and address any challenges.
                            </li>
                            <li>Official communication should take place via Slack, Microsoft Teams, or WhatsApp.</li>

                        </p>

                        <h6 id="policy10">10. Termination & Resignation</h6>
                        <p>
                            <li>Employees are required to serve a 2-month notice period before resignation.</li>
                            <li>Immediate termination may occur in cases of:</li>
                        <ol>
                            <li>Misconduct or security breaches.</li>
                            <li>Disrupting team harmony through negative influence.</li>
                            <li>Consistently poor performance despite feedback and support.</li>
                            <li>Upon exit, employees must return all company property in their possession.</li>
                        </ol>
                        </p>

                        <div class="acknowledgment">
                            <h3>Acknowledgment</h3>
                            <p>I, <span class="blank">__________</span>, have read and understood the company policies
                                and agree to comply.</p>

                            <p><strong>Signature:</strong> <span class="blank">____</span></p>
                            <p><strong>Date:</strong> <span class="blank">____</span></p>
                        </div>

                    </div>
                </div>
                <iframe src="" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</section>

<script>
    function openTab(event, tabId) {
        const panels = document.querySelectorAll('.tab-panel');
        panels.forEach(panel => panel.classList.remove('active'));
        const links = document.querySelectorAll('.tab-link');
        links.forEach(link => link.classList.remove('active'));
        document.getElementById(tabId).classList.add('active');
        event.currentTarget.classList.add('active');
    }
</script>


<!-- Modal for Confirmation -->
<div class="modal fade" id="exitModal" tabindex="-1" aria-labelledby="exitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exitModalLabel">Are you sure you want to exit?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Please confirm that you wish to exit. You will be redirected to the exit page.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <a href="#" id="confirmExit" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS (for modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Get the link and modal elements
    const exitLink = document.getElementById("exitLink");
    const confirmExit = document.getElementById("confirmExit");
    const exitModal = new bootstrap.Modal(document.getElementById("exitModal"));

    // When the "Exit Here" link is clicked, show the modal
    exitLink.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default link behavior
        exitModal.show(); // Show the modal
    });

    // When "Yes" is clicked, redirect to the exit page
    confirmExit.addEventListener("click", function () {
        const name = "<?php echo htmlspecialchars($name); ?>"; // Get the employee's name (assuming it's set in PHP)
        const exitUrl = "exit/start_email.php?name=" + encodeURIComponent(name); // Construct the URL
        window.location.href = exitUrl; // Redirect the user
    });
</script>