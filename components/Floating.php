<div class="floating-container">
    <div class="floating-button">+</div>
    <div class="element-container">
        <span class="float-element">
            <a href="index.php?components=profile&&role=<?=$_SESSION['Role']?>&&UserID=<?=$_SESSION['UserID']?>">
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

<!-- Modal HTML Structure -->
<div id="notification-modal" class="noti-modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="noti-title">NOTIFICATIONS</h2>
        <ul class="notification-list">
            <li>Loading notifications...</li>
        </ul>
    </div>
</div>

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

<script>
$(document).ready(function() {
    // Image Preview Handler
    $('#file-upload').change(function(event) {
        const file = event.target.files[0];
        if (!file) return;

        // Check if the file is an image
        if (!file.type.match('image.*')) {
            alertify.error('Please select an image file (JPEG, PNG, etc.)');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            $('.image-preview-container').html(''); // Clear previous preview

            // Create preview container
            const previewWrapper = $('<div class="preview-wrapper"></div>');
            const preview = $(`<img src="${e.target.result}" class="image-preview">`);
            
            // Add remove button
            const removeBtn = $('<div class="remove-preview-btn">×</div>').click(function() {
                $('.image-preview-container').html('');
                $('#file-upload').val('');
            });

            previewWrapper.append(preview).append(removeBtn);
            $('.image-preview-container').append(previewWrapper);
        };
        reader.readAsDataURL(file);
    });

   
});
</script>