<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Registration Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: var(--nav-color);
            min-height: 100vh;
            padding: 20px;
        }

        .certificate-container {
            background-color: var(--nav-color);
            border: 2px solid #393838;
            border-radius: 15px;
            padding: 30px;
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            margin-top: 100px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .certificate-header {
            text-align: center;
            border-bottom: 2px solid #393838;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .photo-preview {
            width: 150px;
            height: 200px;
            border: 2px solid #393838;
            position: absolute;
            right: 30px;
            top: 30px;
            background-color: var(--nav-color);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .photo-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .signature-preview {
            max-width: 200px;
            height: 60px;
            border: 2px solid #393838;
            margin-top: 10px;
            background-color: var(--nav-color);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-color);
        }

        .required::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }

        .section-header {
            background-color: var(--nav-color);
            padding: 10px;
            margin: 20px 0 15px;
            border-radius: 5px;
            color: var(--text-color);
            font-weight: bold;
            font-size:20px;
            grid-column: span 2;
        }

        .btn-success {
            background-color: var(--nav-color);
            border: 2px solid #393838;
            color: var(--text-color);
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: auto;
            margin-top: 15px;
            grid-column: span 2;
        }

        .btn-success:hover {
            background-color: var(--nav-color);
            border-color: #393838;
        }

        .petForm{
            display: flex;
            overflow: hidden;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            transition: 0.2s 0.7sease-in-out;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: var(--text-color);
            background-color: var(--nav-color);
            background-clip: padding-box;
            border: 2px solid #393838;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            background-color: var(--nav-color);
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .text, .textp, .form-check-label, .text-muted {
            color: var(--text-color);
        }

        .form-check {
            margin-top: 10px;
            margin-bottom: 10px;
            grid-column: span 2;
        }

        .form-select {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: var(--text-color);
            background-color: var(--nav-color);
            border: 2px solid #393838;
            border-radius: 0.25rem;
        }

        .form-check-input {
            margin-right: 0.5rem;
        }

        /* Two-column layout for form fields */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        @media (max-width: 768px) {
            .photo-preview {
                position: relative;
                right: auto;
                top: auto;
                margin: 0 auto 20px;
            }

            .form-grid {
                grid-template-columns: 1fr; /* Single column on smaller screens */
            }

            .section-header, .btn-success, .form-check {
                grid-column: span 1; /* Reset grid span for mobile */
            }
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate-header">
            <h2 class="text">PET REGISTRATION CERTIFICATE</h2>
            <p class="textp">City Agriculture Office - Veterinary Unit</p>
        </div>

        <div class="photo-preview" id="photoPreview">
            <span class="text-muted">Photo Preview</span>
        </div>

        <!-- <form id="petRegistrationForm" class="petForm" novalidate> -->
        <form id="petRegistrationForm" class="petForm">
             <!-- Spinner -->
        
                <div class="form-grid">
                    <div id="spinner" class="spinner" style="display:none;">
                    <div class="loader"></div>
                </div>
                <!-- Application Details -->
                <div class="section-header">Application Details</div>
                <div>
                    <label for="dateApplication" class="form-label required">Date of Application</label>
                    <input type="date" class="form-control" id="dateApplication" name="dateApplication" required>
                </div>
                <div>
                    <label for="userPhoto" class="form-label required">Photo of Owner</label>
                    <input type="file" class="form-control" id="userPhoto" name="userPhoto" accept="image/*" required>
                </div>

                <!-- Owner Information -->
                <div class="section-header">Owner Information</div>
                <div>
                    <label for="nameApplicant" class="form-label required">Pet Owner's Name</label>
                    <input type="text" class="form-control" id="nameApplicant" name="nameApplicant" required>
                </div>
                <div>
                    <label for="age" class="form-label required">Age</label>
                    <input type="number" class="form-control" id="age" min="18" name="age" required>
                </div>
                <div>
                    <label for="gender" class="form-label required">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <label for="birthday" class="form-label required">Birthday</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
                <div>
                    <label for="telephone" class="form-label required">Telephone/Mobile Number</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" pattern="[0-9]{10,}" required>
                </div>
                <div>
                    <label for="emailApplicant" class="form-label required">Email Address</label>
                    <input type="email" class="form-control" id="emailApplicant" name="emailApplicant" required>
                </div>
                <div>
                    <label for="homeAddress" class="form-label required">Home Address</label>
                    <input type="text" class="form-control" id="homeAddress" name="homeAddress" required>
                </div>

                <!-- Pet Information -->
                <div class="section-header">Pet Information</div>
                <div>
                    <label for="petName" class="form-label required">Pet Name</label>
                    <input type="text" class="form-control" id="petName" name="petName" required>
                </div>
                <div>
                    <label for="petAge" class="form-label required">Pet Age</label>
                    <input type="number" class="form-control" id="petAge" name="petAge" min="0" step="0.1" required>
                </div>
                <div>
                    <label for="petGender" class="form-label required">Pet Gender</label>
                    <select class="form-select" id="petGender" name="petGender" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div>
                    <label for="species" class="form-label required">Species</label>
                    <input type="text" class="form-control" id="species" name="species" required>
                </div>
                <div>
                    <label for="breed" class="form-label required">Breed</label>
                    <input type="text" class="form-control" id="breed" name="breed" required>
                </div>
                <div>
                    <label for="petWeight" class="form-label required">Weight (kg)</label>
                    <input type="number" class="form-control" id="petWeight" name="petWeight" step="0.1" required>
                </div>
                <div>
                    <label for="petColor" class="form-label required">Pet Color</label>
                    <input type="text" class="form-control" id="petColor" name="petColor" required>
                </div>
                <div>
                    <label for="distinguishingMarks" class="form-label">Distinguishing Marks</label>
                    <input type="text" class="form-control" id="distinguishingMarks" name="distinguishingMarks">
                </div>
                <div>
                    <label for="petBirthday" class="form-label required">Pet Birthday</label>
                    <input type="date" class="form-control" id="petBirthday" name="petBirthday" required>
                </div>

                <!-- Vaccination Information -->
                <div class="section-header">Vaccination Information</div>
                <div>
                    <label for="vaccinationDate" class="form-label required">Anti-Rabies Vaccination Date</label>
                    <input type="date" class="form-control" id="vaccinationDate" name="vaccinationDate" required>
                </div>
                <div>
                    <label for="vaccinationExpiry" class="form-label required">Vaccination Expiry Date</label>
                    <input type="date" class="form-control" id="vaccinationExpiry" name="vaccinationExpiry" required>
                </div>

                <!-- Veterinarian Information -->
                <div class="section-header">Veterinarian Information</div>
                <div>
                    <label for="vetClinic" class="form-label required">Veterinarian Clinic</label>
                    <input type="text" class="form-control" id="vetClinic" name="vetClinic" required>
                </div>
                <div>
                    <label for="vetName" class="form-label required">Veterinarian Name</label>
                    <input type="text" class="form-control" id="vetName" name="vetName" required>
                </div>
                <div>
                    <label for="vetAddress" class="form-label required">Veterinarian Clinic Address</label>
                    <input type="text" class="form-control" id="vetAddress" name="vetAddress" required>
                </div>
                <div>
                    <label for="vetContact" class="form-label required">Veterinarian Contact Info</label>
                    <input type="tel" class="form-control" id="vetContact" name="vetContact" pattern="[0-9]{10,}" required>
                </div>

                <!-- Declaration -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="declaration" name="declaration" required>
                    <label class="form-check-label" for="declaration">
                        I declare that I have personally accomplished this registration form and all details are true and correct.
                    </label>
                </div>

                <!-- Signature -->
                <div>
                    <label for="ownerSignature" class="form-label required">Pet Owner's Signature</label>
                    <input type="file" class="form-control" id="ownerSignature" name="ownerSignature" accept="image/*" required>
                    <div class="signature-preview" id="signaturePreview"></div>
                </div>
                <div>
                    <label for="dateSigned" class="form-label required">Date Signed</label>
                    <input type="date" class="form-control" id="dateSigned" name="dateSigned" required>
                </div>

                <button type="submit" id="BtnRegistrationForm" class="btn btn-success">Submit Registration</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('dateApplication').value = today;
            document.getElementById('dateSigned').value = today;
        });

        document.getElementById('userPhoto').addEventListener('change', function(e) {
            const preview = document.getElementById('photoPreview');
            preview.innerHTML = '';

            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                }
                reader.readAsDataURL(e.target.files[0]);
            } else {
                preview.innerHTML = '<span class="text-muted">Photo Preview</span>';
            }
        });

        document.getElementById('ownerSignature').addEventListener('change', function(e) {
            const preview = document.getElementById('signaturePreview');
            preview.innerHTML = '';

            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100%';
                    img.style.height = '100%';
                    preview.appendChild(img);
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // document.getElementById('petRegistrationForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     e.stopPropagation();

        //     if (this.checkValidity()) {
        //         // alert('Pet registration submitted successfully!');
        //         this.reset();
        //         document.getElementById('photoPreview').innerHTML = '<span class="text-muted">Photo Preview</span>';
        //         document.getElementById('signaturePreview').innerHTML = '';
        //         document.getElementById('dateApplication').value = new Date().toISOString().split('T')[0];
        //         document.getElementById('dateSigned').value = new Date().toISOString().split('T')[0];
        //     }

        //     this.classList.add('was-validated');
        // });
    </script>
</body>
</html>