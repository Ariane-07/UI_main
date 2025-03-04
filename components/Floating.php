<div class="floating-container">
    <div class="floating-button">+</div>
    <div class="element-container">
        <span class="float-element">
            <a href="index.php?components=profile&&role=<?=$_SESSION['Role']?>">
                <i class='bx bxs-user'></i>
            </a>
        </span>
        <span class="float-element" id="bell-icon">
            <i class='bx bxs-bell noti'></i>
            <span class="notification-count">3</span> <!-- Example notification count -->
        </span>
        <span class="float-element" id="message-icon">
            <i class='bx bxs-message-dots'></i>
        </span>
    </div>
</div>

<!-- Modal HTML Structure -->
<div id="notification-modal" class="noti-modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="noti-title">NOTIFICATIONS</h2>
        <ul class="notification-list">
            <li>You have a new follower!</li>
            <li>Your post was liked by Jane.</li>
            <li>Reminder: Your appointment is tomorrow at 3 PM.</li><!-- This can be dynamically filled -->
        </ul>
    </div>
</div>

<!-- Modal HTML Structure for Chat Box -->
<div id="chat-modal" class="chat-modal">
    <div class="chat-modal-content">
        <span class="chat-close">&times;</span>
        <div class="chat-sidebar">
            <h3>Chat List</h3>
            <ul class="chat-list">
                <li class="chat-user" data-username="John">John</li>
                <li class="chat-user" data-username="Jane">Jane</li>
                <li class="chat-user" data-username="Doe">Doe</li>
                <!-- Add dynamically as needed -->
            </ul>
        </div>
        <div class="chat-box">
            <h3>Chat with <span id="chat-with">John</span></h3>
            <div class="chat-messages">
                <!-- Messages will appear here -->
            </div>
            <div class="chat-input">
                <label for="file-upload" class="custom-file-upload">
                    <i class='bx bx-upload'></i>
                </label>
                <input id="file-upload" type="file" />
                <input type="text" id="message-input" placeholder="Type A Message...">
                <button id="send-message" class="btn">SEND</button>
            </div>

        </div>
    </div>
</div>