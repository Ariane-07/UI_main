$(document).ready(function () {
    // Fetch all users dynamically
    $.ajax({
        url: "api/config/end-points/FetchAllusers.php",
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // console.log(data);

            let chatList = $(".chat-list");
            chatList.empty(); // Clear existing list

            data.forEach(user => {
                chatList.append(`<li class="chat-user togglerViewMessages" data-username="${user.Username}" data-userid="${user.UserID}">${user.Username}</li>`);
            });
        },
        error: function () {
            console.log("Error fetching users.");
        }
    });

    // Handle chat user selection using event delegation
    $(document).on("click", ".chat-user", function () {
        let username = $(this).data("username");
        $("#chat-with").text(username);
    });

    // Handle togglerViewMessages click using event delegation
    $(document).on("click", ".togglerViewMessages", function (e) {
        e.preventDefault();
        var userid = $(this).data('userid');

        $("#reciever_id").val(userid);
        console.log("Chat opened with User ID:", userid);

        fetchChatMessages(userid); // Fetch messages when a chat is opened
    });

    function fetchChatMessages(receiver_id) {
        if (!receiver_id) return;
    
        var UserID = $("#UserID").val(); // Ensure this exists in HTML
        let chatBox = $(".chat-messages");
    
        $.ajax({
            url: "api/config/end-points/fetchUserChats.php", // Fixed URL
            type: "POST",
            data: { receiver_id: receiver_id },
            dataType: "json",
            success: function (response) {
    
                console.log(response.messages); // Check the full structure first
    
                chatBox.html(""); // Always clear previous messages
    
                if (response.status === "success" && response.messages.length > 0) {
                    $.each(response.messages, function (index, message) {
                        let isSender = (message.sender_id == UserID);
                        let chatClass = isSender ? 'sent' : 'received';
    
                        // Assign correct profile picture based on sender_id
                        let profilePic = isSender
                            ? (message.sender_profile ? `uploads/images/${message.sender_profile}` : "assets/imgs/User-Profile.png")
                            : (message.sender_profile ? `uploads/images/${message.sender_profile}` : "assets/imgs/User-Profile.png");
    
                        let messageHTML = `
                            <div class="chat-message ${chatClass}">
                                <img src="${profilePic}" alt="Profile" class="chat-profile">
                                <div class="message-content">
                                    <p>${message.message_text}</p>
                                    ${message.message_media ? `<img src="uploads/images/${message.message_media}" alt="Image" class="chat-image">` : ""}
                                </div>
                            </div>
                        `;
                        chatBox.append(messageHTML);
                    });
    
                    chatBox.scrollTop(chatBox[0].scrollHeight); // Auto-scroll to latest message
                } else {
                    chatBox.html(`<div class="no-messages">No messages found. Start the conversation!</div>`);
                }
            },
            error: function () {
                chatBox.html(`<div class="error-message">Error fetching messages.</div>`);
                console.log("Error fetching messages.");
            }
        });
    }
    
    
    
    

    // Auto-refresh chat every 2 seconds
    setInterval(function () {
        let receiver_id = $("#reciever_id").val();
        if (receiver_id) {
            fetchChatMessages(receiver_id);
        }
    }, 2000);
});
