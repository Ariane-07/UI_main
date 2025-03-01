<div class="burger-icon" onclick="toggleSidebar()">&#9776;</div>
<div class="sidebar">
    <h2>Register Pet</h2>
    <p>Haven't registered your pet? Register them now!</p>
    <form id="pet-form">
        <label for="petName">Pet Name</label>
        <input type="text" id="petName" placeholder="Enter Pet Name" required>

        <label for="birthDate">Birth Date</label>
        <input type="date" id="birthDate" required>

        <label for="breed">Breed</label>
        <input type="text" id="breed" placeholder="Enter Breed" required>

        <label for="gender">Gender</label>
        <select id="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label for="veterinarian">Veterinarian</label>
        <input type="text" id="veterinarian" placeholder="Enter Veterinarian" required>

        <label for="contact">Contact Details</label>
        <input type="tel" id="contact" placeholder="Enter Contact Details" required>

        <label for="clinic">Clinic Address</label>
        <input type="text" id="clinic" placeholder="Enter Clinic Address" required>

        <button type="submit" class="regbtn btn">REGISTER PET</button>
    </form>
</div>

<div class="main-content">
    <h1 class="pet-title heading">Pets Owned</h1>
    <div class="pet-list" id="pet-list">
    </div>
</div>

<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('show-sidebar');
    }
    document.getElementById('pet-form').addEventListener('submit', function(event) {
        event.preventDefault();

        // Gather the pet form values
        const petName = document.getElementById('petName').value;
        const birthDate = document.getElementById('birthDate').value;
        const breed = document.getElementById('breed').value;
        const gender = document.getElementById('gender').value;
        const veterinarian = document.getElementById('veterinarian').value;
        const contact = document.getElementById('contact').value;
        const clinic = document.getElementById('clinic').value;

        // Create a new pet record element
        const petRecord = document.createElement('div');
        petRecord.classList.add('pet-record');

        petRecord.innerHTML = `
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="pet-record-grid">
                <div class="pet-record-item">
                    <div class="pet-record-label">Name</div>
                    <div class="pet-record-value">${petName}</div>
                </div>
                <div class="pet-record-item">
                    <div class="pet-record-label">Birth Date</div>
                    <div class="pet-record-value">${birthDate}</div>
                </div>
                <div class="pet-record-item">
                    <div class="pet-record-label">Breed</div>
                    <div class="pet-record-value">${breed}</div>
                </div>
                <div class="pet-record-item pet-qr-code">
                    <img src="https://via.placeholder.com/60" alt="QR Code">
                    <div class="pet-qr-code-text">Print me</div>
                </div>
                <div class="pet-record-item">
                    <div class="pet-record-label">Gender</div>
                    <div class="pet-record-value">${gender}</div>
                </div>
                <div class="pet-record-item">
                    <div class="pet-record-label">Veterinarian</div>
                    <div class="pet-record-value">${veterinarian}</div>
                </div>
                <div class="pet-record-item">
                    <div class="pet-record-label">Contact Details</div>
                    <div class="pet-record-value">${contact}</div>
                </div>
                <div class="pet-record-item">
                    <div class="pet-record-label">Clinic Address</div>
                    <div class="pet-record-value">${clinic}</div>
                </div>
            </div>
        `;

        // Append the new pet record to the list
        document.getElementById('pet-list').appendChild(petRecord);

        // Reset the form after submission
        document.getElementById('pet-form').reset();
    });
</script>