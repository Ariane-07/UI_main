<!-- Floating Button Container -->
<div class="floating-container">
    <div class="floating-button">+</div>
    <div class="element-container">
        <span class="float-element">
            <a href="index.php?components=profile&&role=<?= $_SESSION['Role'] ?>&&UserID=<?= $_SESSION['UserID'] ?>">
                <i class='bx bxs-user'></i>
            </a>
        </span>
        <span class="float-element" id="bell-icon">
            <i class='bx bxs-bell noti'></i>
            <span class="notification-count totalExpiNotif">0</span> 
        </span>
        <span class="float-element" id="message-icon">
            <i class='bx bxs-message-dots'></i>
            <span class="notification-count totalUnseenMess">0</span> 
        </span>
    </div>
</div>

<!-- Notification Modal -->
<div id="notification-modal" class="noti-modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="noti-title">NOTIFICATIONS</h2>
        <ul class="notification-list">
            <li>Loading notifications...</li>
        </ul>
    </div>
</div>

<!-- Chat Form Modal -->
<form id="frmSentMessagge">
    <div id="chat-modal" class="chat-modal">
        <div class="chat-modal-content">
            <span class="chat-close">&times;</span>
            <div class="chat-sidebar">
                <h3>Chat List</h3>
                <div class="search-container">
                    <input type="text" id="search-bar" placeholder="Search names..." />
                    <i class='bx bx-search'></i>
                </div>
                <ul class="chat-list" style="max-height: 350px; overflow-y: auto; border: 1px solid #ccc; padding: 5px;">
                    <!-- Chat list will appear here -->
                </ul>
            </div>

            <div class="chat-box">
                <h3>Chat with <span id="chat-with"></span></h3>
                <input type="hidden" id="reciever_id" name="reciever_id" />

                <div class="chat-messages">
                    <!-- Messages will appear here -->
                </div>

                <div class="chat-input">
                    <label for="file-upload" class="custom-file-upload">
                        <i class='bx bx-upload'></i>
                    </label>
                    <input id="file-upload" type="file" name="file-upload" accept="image/*" />
                    <div class="image-preview-container"></div>
                    <input type="text" id="message-input" name="message-input" placeholder="Type A Message...">
                    <button type="submit" id="send-message" class="btn">SEND</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Image Modal for Zoom -->
<div class="image-modal" id="imageModal">
    <span class="modal-close">&times;</span>
    <img id="modalImage" style="display: none; max-width: 90%; max-height: 90%; border-radius: 10px;">
</div>

<!-- Styles -->
<style>
.image-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.8);
    text-align: center;
}

.image-modal .modal-close {
    position: absolute;
    top: 30px;
    right: 35px;
    color: white;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
}

.chat-image {
    max-width: 150px;
    margin: 5px;
    cursor: pointer;
}
</style>

<!-- Scripts -->
<script>
$(document).ready(function() {
    // Image Preview Handler
    $('#file-upload').change(function(event) {
        const file = event.target.files[0];
        if (!file) return;

        if (!file.type.match('image.*')) {
            alertify.error('Please select an image file (JPEG, PNG, etc.)');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            $('.image-preview-container').html('');

            const previewWrapper = $('<div class="preview-wrapper"></div>');
            const preview = $(`<img src="${e.target.result}" class="image-preview">`);
            const removeBtn = $('<div class="remove-preview-btn">×</div>').click(function() {
                $('.image-preview-container').html('');
                $('#file-upload').val('');
            });

            previewWrapper.append(preview).append(removeBtn);
            $('.image-preview-container').append(previewWrapper);
        };
        reader.readAsDataURL(file);
    });

    // Function to add a message to chat (image or text)
    function addMessageToChat(message, isImage = false) {
        const chatMessages = $('.chat-messages');
        const messageElement = $('<div class="message"></div>');

        if (isImage) {
            const img = $(`<img src="${message}" class="chat-image">`);
            img.click(function() {
                $('#modalImage').attr('src', message).show();
                $('#imageModal').fadeIn();
            });
            messageElement.append(img);
        } else {
            messageElement.text(message);
        }

        chatMessages.append(messageElement);
    }

    // Close modal when "X" is clicked
    $('.modal-close').click(function() {
        $('#imageModal').fadeOut();
    });

    // Close modal when clicking outside the image
    $('#imageModal').click(function(e) {
        if (e.target.id === 'imageModal') {
            $('#imageModal').fadeOut();
        }
    });
});
</script>
