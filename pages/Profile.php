
<div class="profile-container">
    <div class="profile-sidebar">
        <div class="profile-image">
            <img id="profile-pic" src="assets/imgs/User-Profile.png" alt="Profile Image">
            <label for="profile-pic-input" class="file-input-label">CHOOSE A PHOTO</label>
            <input type="file" id="profile-pic-input" class="file-input" accept="image/*" onchange="loadFile(event)">
        </div>
        <div class="profile-info">
            <p>Email</p>
            <input type="email" id="email" class="editable-input">
            <p>Role</p>
            <input type="text" id="role" class="editable-input" disabled>
        </div>
        <a href="logout.php" class="logout-link">LOG OUT</a>
    </div>

    <div class="profile-details">
        <div class="detail-group">
            <label class="detail-label">Name</label>
            <input type="text" id="name" class="editable-input">
        </div>
        <div class="detail-group">
            <label class="detail-label">Gender</label>
            <select id="gender" class="editable-input">
                <option value="Female" selected>Female</option>
                <option value="Male">Male</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="detail-group">
            <label class="detail-label">Birth Date</label>
            <input type="date" id="birthdate" class="editable-input">
        </div>
        <div class="detail-group">
            <label class="detail-label">Contact Number</label>
            <input type="tel" id="contact" class="editable-input">
        </div>
        <div class="detail-group">
            <label class="detail-label">Address</label>
            <div id="map" style="height: 300px; width: 100%;"></div>
            <textarea id="address" class="editable-input"></textarea>
        </div>
        <button class="btn" onclick="saveProfile()">SAVE</button>
    </div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
<script>
 let map, marker;

window.initMap = function() {
    console.log("initMap called"); // Debugging
    const initialLocation = {
        lat: -34.397,
        lng: 150.644
    };

    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: initialLocation,
    });

    marker = new google.maps.Marker({
        position: initialLocation,
        map: map,
    });

    map.addListener("click", (event) => {
        marker.setPosition(event.latLng);
        document.getElementById("address").value = `${event.latLng.lat()}, ${event.latLng.lng()}`;
    });
};

    window.onload = function() {
        const storedName = localStorage.getItem("name");
        const storedEmail = localStorage.getItem("email");
        const storedGender = localStorage.getItem("gender");
        const storedContact = localStorage.getItem("contact");
        const storedAddress = localStorage.getItem("address");
        const storedBirthdate = localStorage.getItem("birthdate");
        const storedProfilePic = localStorage.getItem("profilePic");

        if (storedBirthdate)
            document.getElementById("birthdate").value = storedBirthdate;
        if (storedName) document.getElementById("name").value = storedName;
        if (storedEmail) document.getElementById("email").value = storedEmail;
        if (storedGender) document.getElementById("gender").value = storedGender;
        if (storedContact) document.getElementById("contact").value = storedContact;
        if (storedAddress) document.getElementById("address").value = storedAddress;
        if (storedProfilePic) {
            document.getElementById("profile-pic").src = storedProfilePic;
        }
    };

    function saveProfile() {
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const gender = document.getElementById("gender").value;
        const contact = document.getElementById("contact").value;
        const address = document.getElementById("address").value;
        const birthdate = document.getElementById("birthdate").value;
        const profilePic = document.getElementById("profile-pic").src;

        localStorage.setItem("name", name);
        localStorage.setItem("email", email);
        localStorage.setItem("gender", gender);
        localStorage.setItem("contact", contact);
        localStorage.setItem("address", address);
        localStorage.setItem("birthdate", birthdate);
        localStorage.setItem("profilePic", profilePic);

        alert("Profile saved!");
    }

    const loadFile = function(event) {
        const profilePic = document.getElementById("profile-pic");
        const reader = new FileReader();

        reader.onload = function() {
            profilePic.src = reader.result;
            localStorage.setItem("profilePic", reader.result);
        };

        reader.readAsDataURL(event.target.files[0]);
    };
</script>