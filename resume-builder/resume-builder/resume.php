<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Resume Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/main.css">

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/dist/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/qrious.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
</head>

<body>
    <style>
        body {
            background-image: url('assets/images/bg-form.webp');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .navbar {
            background-color: var(--clr-dark);
            border-bottom: 2px black solid;
        }

        img:hover {
            transform: scale(1.4);
        }

        .suggestions {
            border: 1px solid #ccc;
            border-top: none;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            width: 300px;
            z-index: 1000;
            background: #fff;
        }

        .suggestion-item {
            padding: 8px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #e0e0e0;
        }
    </style>

    <nav class="navbar bg-white">
        <div class="container">
            <div class="navbar-content">
                <div class="brand-and-toggler">
                    <a href="index.html" class="navbar-brand">
                        <img src="assets/images/curriculum-vitae.png" alt="" class="navbar-brand-icon">
                        <span class="navbar-brand-text" style="color: white;">Resume <span>Builder</span>
                    </a>
                    <h4 style="color: white; margin-left: 700px;">Welcome, <?php echo $_SESSION['username']; ?>!</h4>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </nav>


    <section id="about-sc" class="">
        <div class="container" style="background-color: whitesmoke;">
            <div class="about-cnt">
                <form action="" class="cv-form" id="cv-form">
                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>About section</h3>
                        </div>
                        <div class="cv-form-row cv-form-row-about">
                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="" class="form-label">First Name</label>
                                    <input name="firstname" type="text" class="form-control firstname" id="firstname" onkeyup="showSuggestions(this)" placeholder="Enter your Name">
                                    <div id="firstname-suggestions" class="suggestions"></div>
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Middle Name <span class="opt-text">(optional)</span></label>
                                    <input name="middlename" type="text" class="form-control middlename" id="middlename" onkeyup="showSuggestions(this)" onkeyup="generateCV()" placeholder="Optional Middle Name">
                                    <div id="middlename-suggestions" class="suggestions"></div>
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Last Name</label>
                                    <input name="lastname" type="text" class="form-control lastname" id="lastname" onkeyup="showSuggestions(this)" onkeyup="generateCV()" placeholder="e.g. Doe">
                                    <div id="lastname-suggestions" class="suggestions"></div>
                                    <span class="form-text"></span>
                                </div>
                            </div>

                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="" class="form-label">Your Image</label>
                                    <input name="image" type="file" class="form-control image" id="" accept="image/*" onchange="previewImage()">
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Designation</label>
                                    <input name="designation" type="text" class="form-control designation" id="designation" onkeyup="showSuggestions(this)" onkeyup="generateCV()" placeholder="e.g. Sr.Accountants">
                                    <div id="designation-suggestions" class="suggestions"></div>
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Address</label>
                                    <input name="address" type="text" class="form-control address" id="address" onkeyup="showSuggestions(this)" onkeyup="generateCV()" placeholder="e.g. Lake Street-23">
                                    <div id="address-suggestions" class="suggestions"></div>
                                    <span class="form-text"></span>
                                </div>
                            </div>

                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="" class="form-label">Email</label>
                                    <input name="email" type="text" class="form-control email" id="email" onkeyup="generateCV()" placeholder="e.g. johndoe@gmail.com">

                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Phone No:</label>
                                    <input name="phoneno" type="text" class="form-control phoneno" id="" onkeyup="generateCV()" placeholder="">

                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Summary</label>
                                    <input name="summary" type="text" class="form-control summary" id="summary" onkeyup="showSuggestions(this)" onkeyup="generateCV()" placeholder="e.g. Doe">
                                    <div id="summary-suggestions" class="suggestions"></div>
                                    <span class="form-text"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>achievements</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-a">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-achievement">
                                        <div class="cols-2">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Title</label>
                                                <input name="achieve_title" type="text" class="form-control achieve_title" id="achieve_title" onkeyup="showSuggestions(this)" onkeyup="generateCV()" placeholder="">
                                                <div id="achieve_title-suggestions" class="suggestions"></div>
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="achieve_description" type="text" class="form-control achieve_description" id="achieve_description" onkeyup="showSuggestions(this)" onkeyup="generateCV()" placeholder="">
                                                <div id="achieve_description-suggestions" class="suggestions"></div>
                                                <span class="form-text"></span>
                                            </div>
                                        </div>
                                        <button data-repeater-delete type="button" class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">+</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>experience</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-b">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-experience">
                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Title</label>
                                                <input name="exp_title" type="text" class="form-control exp_title" id="exp_title" onkeyup="showSuggestions(this)" onkeyup="generateCV()">
                                                <div id="exp_title-suggestions" class="suggestions"></div>
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Company / Organization</label>
                                                <input name="exp_organization" type="text" class="form-control exp_organization" id="exp_organization" onkeyup="showSuggestions(this)" onkeyup="generateCV()">
                                                <div id="exp_organization-suggestions" class="suggestions"></div>
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Location</label>
                                                <input name="exp_location" type="text" class="form-control exp_location" id="exp_location" onkeyup="showSuggestions(this)" onkeyup="generateCV()">
                                                <div id="exp_location-suggestions" class="suggestions"></div>
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Start Date</label>
                                                <input name="exp_start_date" type="date" class="form-control exp_start_date" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">End Date</label>
                                                <input name="exp_end_date" type="date" class="form-control exp_end_date" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="exp_description" type="text" class="form-control exp_description" class="form-control exp_description" onkeyup="showSuggestions(this)" onkeyup="generateCV()">
                                                <div id="exp_description-suggestions" class="suggestions"></div>
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <button data-repeater-delete type="button" class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">+</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>education</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-c">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-experience">
                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">School / College</label>
                                                <input name="edu_school" type="text" class="form-control edu_school" id="edu_school" onkeyup="showSuggestions(this)" onkeyup="generateCV()">
                                                <div id="edu_school-suggestions" class="suggestions"></div>
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Degree</label>
                                                <input name="edu_degree" type="text" class="form-control edu_degree" id="edu_degree" onkeyup="showSuggestions(this)" onkeyup="generateCV()">
                                                <div id="edu_degree-suggestions" class="suggestions"></div>
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">City</label>
                                                <input name="edu_city" type="text" class="form-control edu_city" id="edu_city" onkeyup="showSuggestions(this)" onkeyup="generateCV()">
                                                <div id="edu_city-suggestions" class="suggestions"></div>
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Start Date</label>
                                                <input name="edu_start_date" type="date" class="form-control edu_start_date" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">End Date</label>
                                                <input name="edu_graduation_date" type="date" class="form-control edu_graduation_date" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="edu_description" type="text" class="form-control edu_description" id="edu_description" onkeyup="showSuggestions(this)" onkeyup="generateCV()">
                                                <div class="suggestions" id="edu_description-suggestions"></div>
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <button data-repeater-delete type="button" class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">+</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>projects</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-d">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-experience">
                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Project Name</label>
                                                <input name="proj_title" type="text" class="form-control proj_title" id="proj_title" onkeyup="showSuggestions(this)" onkeyup="generateCV()">
                                                <div class="suggestions" id="proj_title-suggestions"></div>
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Project link</label>
                                                <input name="proj_link" type="text" class="form-control proj_link" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="proj_description" type="text" class="form-control proj_description" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>
                                        <button data-repeater-delete type="button" class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">+</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>skills</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-e">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-skills">
                                        <div class="form-elem">
                                            <label for="" class="form-label">Skill</label>
                                            <input name="skill" type="text" class="form-control skill" id="skill" onkeydown="showSuggestions(this)" onkeyup="generateCV()">
                                            <div id="skill-suggestions" class="suggestions"></div>
                                            <span class="form-text"></span>
                                            <input name="skill" type="text" class="form-control skill" id="skill" onkeydown="showSuggestions(this)" onkeyup="generateCV()">
                                            <div id="skill-suggestions" class="suggestions"></div>
                                            <span class="form-text"></span>
                                            <input name="skill" type="text" class="form-control skill" id="skill" onkeydown="showSuggestions(this)" onkeyup="generateCV()">
                                            <div id="skill-suggestions" class="suggestions"></div>
                                            <span class="form-text"></span>
                                            <input name="skill" type="text" class="form-control skill" id="skill" onkeydown="showSuggestions(this)" onkeyup="generateCV()">
                                            <div id="skill-suggestions" class="suggestions"></div>
                                            <span class="form-text"></span>
                                            <input name="skill" type="text" class="form-control skill" id="skill" onkeydown="showSuggestions(this)" onkeyup="generateCV()">
                                            <div id="skill-suggestions" class="suggestions"></div>
                                            <span class="form-text"></span>

                                        </div>

                                        <button data-repeater-delete type="button" class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">+</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section id="preview-sc" class="print_area" >
        <div class="container">
            <div class="preview-cnt">
                <div class="preview-cnt-l text-white" style="background-color:cadetblue;">
                    <div class="preview-blk">
                        <div class="preview-image">
                            <img src="" alt="" id="image_dsp">
                        </div>
                        <div class="preview-item preview-item-name">
                            <span class="preview-item-val fw-6" id="fullname_dsp"></span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-item-val text-uppercase fw-6 ls-1" id="designation_dsp"></span>
                        </div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3 style="color:crimson;">About</h3>
                        </div>
                        <div class="preview-blk-list">
                            <div class="preview-item">
                                <span class="preview-item-val" id="phoneno_dsp"></span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-item-val" id="email_dsp"></span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-item-val" id="address_dsp"></span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-item-val" id="summary_dsp"></span>
                            </div>
                        </div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3 style="color:crimson;">skills</h3>
                        </div>
                        <div class="skills-items preview-blk-list" id="skills_dsp">
                        </div>
                    </div>
                </div>

                <div class="preview-cnt-r bg-white">
                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>Achievements</h3>
                        </div>
                        <div class="achievements-items preview-blk-list" id="achievements_dsp"></div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>educations</h3>
                        </div>
                        <div class="educations-items preview-blk-list" id="educations_dsp"></div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>experiences</h3>
                        </div>
                        <div class="experiences-items preview-blk-list" id="experiences_dsp"></div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>projects</h3>
                        </div>
                        <div class="projects-items preview-blk-list" id="projects_dsp"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="print-btn-sc">
        <div class="container">
            <button type="button" class="print-btn btn btn-primary" onclick="printCV()">Print CV</button>
        </div>

        <br>
        <div class="container">
            <button type="button" class="print-btn btn btn-primary " style="text-decoration: none;"><a href="https://www.pcloud.com/" target="_blank">
                    <div style="color: white;">
                        Upload the file
                    </div>
                </a></button>
        </div>
        <br>
        <div class="container">
            <main>
                <form action="/" id="qr-generation-form">
                    <input type="text" name="qr-code-content" id="qr-content" value="" placeholder="Enter QR content" style="height: 50px;" autocomplete="off" />
                    <button class="print-btn btn btn-primary" type="submit">Generate QR code</button>
                    <!-- <button class="print-btn btn btn-primary" id="download-btn">Download QR Code</button> -->
                </form>

            </main>

        </div>

    </section>

    <div style="width: 150px;height: 150px;margin-left: 170px;margin-bottom: 50px;" id="qr-code"></div>




    <script>
        let qrContentInput = document.getElementById("qr-content");
        let qrGenerationForm =
            document.getElementById("qr-generation-form");
        let qrCode;

        function generateQrCode(qrContent) {
            return new QRCode("qr-code", {
                text: qrContent,
                width: 256,
                height: 256,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H,
            });
        }

        // Event listener for form submit event
        qrGenerationForm.addEventListener("submit", function(event) {
            // Prevent form submission
            event.preventDefault();
            let qrContent = qrContentInput.value;
            if (qrCode == null) {

                // Generate code initially
                qrCode = generateQrCode(qrContent);
            } else {

                // If code already generated then make 
                // again using same object
                qrCode.makeCode(qrContent);
            }
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>


    <script>
        const suggestionsData = {
            firstname: ["Rajath", "Sambhram", "Samyak", "Shreyas"],
            middlename: ["S", "R"],
            lastname: ["Kumar", "Gouda", "Jain", "Ganiga", "Devadiga"],
            designation: ["Sr. Accountant", "Software Engineer", "Product Manager", "Data Scientist", "Software Engineer", "Data Scientist", "Product Manager", "UI/UX Designer", "Network Engineer", "DevOps Engineer", "Machine Learning Engineer", "Database Administrator", "Cybersecurity Analyst", "Full Stack Developer"],
            summary: ["Experienced professional with a strong background in ", "Results-driven project manager with expertise in agile methodologies and stakeholder management",
                "Creative graphic designer with a keen eye for detail and a passion for visual storytelling",
                "Seasoned IT professional specializing in network security and infrastructure management",
                "Customer-centric sales manager recognized for building strong client relationships and driving revenue",
                "Experienced software engineer proficient in full-stack development and cloud computing",
                "Detail-oriented accountant with a strong background in financial analysis and reporting",
                "Strategic HR leader known for implementing talent acquisition and retention strategies",
                "Versatile administrative assistant skilled in office management and executive support",
                "Digital marketing specialist with a focus on SEO, SEM, and social media advertising",
                "Licensed nurse with expertise in emergency care and patient advocacy",
                "Seasoned professional with extensive experience in financial management and strategic planning",
                "Dynamic leader known for fostering a positive work culture and driving team performance",
                "Expertise in digital marketing strategies, with a focus on ROI and campaign optimization",
                "Proven track record in sales, consistently exceeding targets and driving revenue growth",
                "Detail-oriented professional with a background in quality assurance and process improvement",
                "Skilled in UX/UI design, with a passion for creating intuitive and engaging user interfaces",
                "Experienced in healthcare administration, with a strong background in patient care and compliance",
                "Effective communicator with proficiency in multiple languages and cross-cultural sensitivity",
                "Entrepreneurial mindset with a history of launching successful startups and scaling businesses",
                "Passionate educator committed to student success and fostering a love for learning"
            ],
            achieve_title: ["Best Employee Award", "Top Performer of the Year", "Achieved 30% increase in sales revenue within first quarter",
                "Reduced operational costs by 15% through process optimization",
                "Received 'Employee of the Year' award for outstanding performance",
                "Successfully launched a new product line, resulting in 25% market share growth",
                "Implemented a customer loyalty program that increased repeat business by 20%",
                "Led a team that won a prestigious industry award for innovation",
                "Improved customer satisfaction ratings from 85% to 95% within six months",
                "Negotiated and secured a key partnership with a Fortune 500 company",
                "Streamlined inventory management system, reducing stockouts by 40%",
                "Developed and implemented a scalable CRM system that improved client retention by 30%",
                "Received recognition for outstanding leadership in a cross-functional project", "Achieved ISO certification for quality management system implementation", "Successfully led a team in achieving a milestone project ahead of schedule", "Recognized for exceptional client service and relationship management", "Received commendation for consistently exceeding sales targets", "Awarded for innovation in developing a new product feature", "Received accolades for excellence in process improvement initiatives", "Recognized as 'Most Valuable Player' in a company-wide initiative", "Achieved a record-breaking performance in customer acquisition", "Received industry-specific award for best practices in sustainability"
            ],
            achieve_description: ["Awarded for exceptional performance", "Achieved 30% increase in sales revenue within first quarter", "Reduced operational costs by 15% through process optimization", "Received 'Employee of the Year' award for outstanding performance", "Successfully launched a new product line, resulting in 25% market share growth", "Implemented a customer loyalty program that increased repeat business by 20%", "Led a team that won a prestigious industry award for innovation", "Improved customer satisfaction ratings from 85% to 95% within six months", "Negotiated and secured a key partnership with a Fortune 500 company", "Streamlined inventory management system, reducing stockouts by 40%", "Developed and implemented a scalable CRM system that improved client retention by 30%", "Recognized for exceptional client service and relationship management", "Awarded for innovation in developing a new product feature", "Received accolades for excellence in customer service and support", "Successfully completed a major project under budget and ahead of schedule", "Led cross-functional teams in achieving key project milestones", "Recognized for outstanding performance in team leadership", "Received industry award for best practices in sustainability", "Developed and executed a successful marketing campaign that exceeded targets", "Implemented process improvements that enhanced operational efficiency", "Received commendation for exceptional problem-solving skills", "Recognized for significant contributions to organizational growth and success"],
            exp_title: ["Software Developer", "Team Lead", "Software Engineer", "Project Manager", "Senior Developer", "UX/UI Designer", "Marketing Manager", "Investment Analyst", "Clinical Researcher", "Curriculum Developer", "Legal Counsel", "Environmental Engineer", "Manager", "Intern", "Data Scientist", "Financial Analyst", "Operations Manager", "Graphic Designer", "Customer Success Manager", "Network Administrator", "Quality Assurance Engineer", "Product Owner", "Business Analyst", "Human Resources Manager"],
            exp_organization: ["Tech Corp", "Innovate Inc", "Tata Consultancy Services", "Infosys", "Wipro", "HCL Technologies", "Tech Mahindra", "Reliance Industries", "Indian Oil Corporation", "Adani Group", "Bharti Airtel", "ICICI Bank", "Larsen & Toubro", "Mahindra & Mahindra", "Tata Motors", "State Bank of India", "Axis Bank", "Google", "Microsoft", "Apple", "Amazon", "Facebook", "IBM", "Samsung", "Sony", "Intel", "Oracle", "Uber", "Airbnb", "Tesla", "HP (Hewlett-Packard)", "Dell"],
            exp_location: ["Bangalore", "Tumkur", "Mysore", "Belgaum", "Dharwad", "Tiptur", "Hassan", "Shimoga", "Gulbarga", "Mandya", "Bidar", "Bijapur", "Bagalkot", "Chitradurga", "Hubli", "Mangalore", "Udupi", "Raichur", "Bellary", "Kolar", "Chikmagalur", "Davanagere", "Gadag", "Haveri", "Karwar", "Kumta", "Sirsi", "Sagar", "Chikkaballapur", "Ramanagara", "Ramnagar", "Madikeri", "Kushalnagar", "Hospet", "Hiriyur", "Kundapur", "Manipal", "Surathkal", "Siddapur", "Sindhanur", "Arsikere", "Channarayapatna", "Holalkere", "Hospet", "Jagalur", "Jewargi", "Kanakapura", "Karkala", "Kolar", "Lingasugur", "Malavalli", "Mudhol", "Nanjangud", "Pavagada", "Robertsonpet", "Rona", "Sakleshpur", "Sandur", "Shikaripur", "Srinivaspur", "Tekkalakote", "Terdal", "Ujire", "Virajpet", "Yadgir"],
            exp_description: ["Developed multiple web applications", "Developed mobile applications for iOS and Android platforms", "Implemented DevOps practices to automate deployment processes", "Led a rebranding initiative, including website redesign and marketing collateral", "Designed and executed social media campaigns to increase brand awareness", "Conducted usability testing and gathered user feedback for product improvements", "Managed a large-scale IT project from conception to completion", "Performed data analysis and generated actionable insights for business strategy", "Implemented continuous integration and continuous deployment pipelines", "Led training sessions for team members on new technologies and tools", "Resolved critical production issues and implemented preventive measures", "Developed a new scalable backend system for handling customer transactions", "Designed and implemented a machine learning algorithm for predictive analytics", "Led a cross-functional team to launch a new product in the market", "Optimized database performance resulting in 30% reduction in query response time", "Implemented agile methodologies to improve team efficiency and product delivery", "Conducted market research and analysis for strategic business planning", "Created a responsive web application for enhanced user experience", "Deployed cloud infrastructure for scalable and cost-effective solutions", "Performed security audits and implemented measures to enhance data protection", "Managed vendor relationships and negotiated contracts for cost savings"],
            edu_degree: ["CSE", "Computer Science Engineering", "Electronics and Communication Engineering", "Mechanical Engineering", "Civil Engineering", "Electrical and Electronics Engineering", "Information Science Engineering", "Aeronautical Engineering", "Automobile Engineering", "Biotechnology Engineering", "Chemical Engineering", "Construction Technology and Management", "Environmental Engineering", "Industrial Engineering and Management", "Instrumentation Technology", "Manufacturing Science and Engineering", "Marine Engineering", "Telecommunication Engineering", "Textile Engineering", "Mining Engineering", "Nanotechnology", "Nano Science and Technology", "Nuclear Engineering", "Automobile Engineering"],
            edu_school: ["SDM Institute of Technology", "RV College of Engineering (RVCE)", "PES University", "BMS College of Engineering", "MS Ramaiah Institute of Technology (MSRIT)", "Bangalore Institute of Technology (BIT)", "Dayananda Sagar College of Engineering (DSCE)", "Siddaganga Institute of Technology (SIT)", "National Institute of Engineering (NIE)", "BMS Institute of Technology and Management (BMSIT&M)", "RNS Institute of Technology (RNSIT)", "SJB Institute of Technology (SJBIT)", "JSS Science and Technology University", "Vidyavardhaka College of Engineering (VVCE)", "Nitte Meenakshi Institute of Technology (NMIT)", "Sapthagiri College of Engineering", "Sir M. Visvesvaraya Institute of Technology (Sir MVIT)", "New Horizon College of Engineering (NHCE)", "Reva University", "Gogte Institute of Technology (GIT)", "KLE Technological University (formerly B.V. Bhoomaraddi College of Engineering and Technology)", "PES Institute of Technology and Management (PESIT)", "Shri Dharmasthala Manjunatheshwara College of Engineering and Technology (SDMCET)", "KLS Gogte Institute of Technology (KLSGIT)", "Malnad College of Engineering (MCE)", "Kalpataru Institute of Technology (KIT)"],
            edu_city: ["Bangalore", "Tumkur", "Mysore", "Belgaum", "Dharwad", "Tiptur", "Hassan", "Shimoga", "Gulbarga", "Mandya", "Bidar", "Bijapur", "Bagalkot", "Chitradurga", "Hubli", "Mangalore", "Udupi", "Raichur", "Bellary", "Kolar", "Chikmagalur", "Davanagere", "Gadag", "Haveri", "Karwar", "Kumta", "Sirsi", "Sagar", "Chikkaballapur", "Ramanagara", "Ramnagar", "Madikeri", "Kushalnagar", "Hospet", "Hiriyur", "Kundapur", "Manipal", "Surathkal", "Siddapur", "Sindhanur", "Arsikere", "Channarayapatna", "Holalkere", "Hospet", "Jagalur", "Jewargi", "Kanakapura", "Karkala", "Kolar", "Lingasugur", "Malavalli", "Mudhol", "Nanjangud", "Pavagada", "Robertsonpet", "Rona", "Sakleshpur", "Sandur", "Shikaripur", "Srinivaspur", "Tekkalakote", "Terdal", "Ujire", "Virajpet", "Yadgir"],
            edu_description: ["Completed coursework in ", "Completed coursework in Data Structures and Algorithms, focusing on efficiency and optimization", "Studied Software Engineering principles, including design patterns and software architecture", "Specialized in Artificial Intelligence and Machine Learning, with projects in natural language processing and computer vision", "Learned Web Development technologies, including frontend frameworks like React and backend frameworks like Node.js", "Explored Database Management systems, focusing on relational databases and SQL queries", "Mastered Operating Systems concepts, including memory management and process synchronization", "Gained expertise in Cybersecurity practices and ethical hacking techniques", "Studied Computer Networks and Internet protocols, including TCP/IP and routing algorithms", "Focused on Mobile Application Development for Android and iOS platforms", "Explored Cloud Computing technologies, including deployment and scaling strategies", "Completed coursework in Mathematics and Computer Science", "Studied Business Administration with a focus on Finance", "Specialized in Mechanical Engineering with hands-on experience in design", "Learned Environmental Science and Sustainability practices", "Focused on Digital Marketing strategies and analytics", "Explored Artificial Intelligence and Machine Learning algorithms", "Mastered Software Development methodologies and Agile practices", "Gained expertise in Data Analysis and Visualization techniques", "Studied Biomedical Engineering with a research focus on prosthetics", "Specialized in Civil Engineering with a passion for infrastructure projects", "Graduated with honors in Computer Science.", "Completed coursework focusing on Data Science and Machine Learning.", "Received specialized training in Web Development.", "Studied abroad for a semester in Business Administration.", "Participated in research projects on Artificial Intelligence."],
            proj_title: ["Machine Learning for Predictive Maintenance", "Natural Language Processing Chatbot", "Blockchain-Based Voting System", "Cybersecurity Threat Detection System", "Deep Reinforcement Learning for Game AI", "Big Data Analytics Platform", "Cloud-Based Healthcare Management System", "Virtual Reality Training Simulation", "Internet of Things (IoT) Home Automation", "AI-Powered Fraud Detection", "Augmented Reality Navigation App", "Robotics Process Automation", "Biometric Authentication System", "Cryptocurrency Exchange Platform", "Data Privacy Management Tool", "Social Media Sentiment Analysis", "E-commerce Recommendation Engine", "Quantum Computing Algorithms", "Gesture Recognition Interface", "Smart City Traffic Management", "Federated Learning Framework", "Artificial Neural Network for Image Recognition", "Digital Twins for Industry 4.0", "Predictive Healthcare Analytics", "Edge Computing Framework", "Data-driven Sports Analytics", "Personalized Learning Platform", "Voice-controlled Home Assistant", "Cyber-Physical Systems Security", "Bioinformatics Data Analysis", "Online Movie Ticket Booking System", "Library Management System", "Student Information System", "Online Shopping Portal", "Hospital Management System", "Inventory Management System", "Social Network Analysis Tool", "Flight Reservation System", "Event Management System", "Online Banking System", "Online Resume Buider"],
            skill: ['JavaScript', 'Python', 'Java', 'C++', 'HTML', 'CSS', 'SQL', 'Node.js', 'React', 'Angular', 'Vue', 'Django', 'Flask', 'Machine Learning', 'Data Analysis', 'Project Management', 'C', "Project Management", "Team Leadership", "Problem Solving", "Communication", "Time Management", "Analytical Thinking", "Adaptability", "Customer Service", "Critical Thinking", "Attention to Detail", "Negotiation", "Conflict Resolution", "Data Analysis", "Research", "Creative Thinking", "Presentation Skills", "Technical Skills", "Financial Analysis", "Market Research"]
        };

        // var $j = jQuery.noConflict();
        // $j(document).ready(function() {
        //     $j("selector").action();
        // });


        function showSuggestions(input) {
            const field = input.name;
            const query = input.value.toLowerCase();
            const suggestionsContainer = document.getElementById(`${field}-suggestions`);
            suggestionsContainer.innerHTML = '';

            if (query.length > 0 && suggestionsData[field]) {
                const suggestions = suggestionsData[field].filter(item => item.toLowerCase().startsWith(query));
                suggestions.forEach(suggestion => {
                    const suggestionItem = document.createElement('div');
                    suggestionItem.textContent = suggestion;
                    suggestionItem.classList.add('suggestion-item');
                    suggestionItem.addEventListener('click', () => {
                        input.value = suggestion;
                        suggestionsContainer.innerHTML = '';
                    });
                    suggestionsContainer.appendChild(suggestionItem);
                });
            }
        }

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.form-control') && !event.target.closest('.suggestions')) {
                document.querySelectorAll('.suggestions').forEach(s => s.innerHTML = '');
            }
        });


        /////////////////
        // Use event delegation for suggestions
        document.addEventListener('keyup', function(event) {
            if (event.target.matches('.form-control')) {
                showSuggestions(event.target);
            }
        });


        $(document).ready(function() {
            $('.repeater').repeater();
        });

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js" integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>


    <script src="assets/js/script.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>