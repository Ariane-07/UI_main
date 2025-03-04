$(document).ready(function () {
    // Fetch users dynamically
    $.ajax({
        url: "api/config/end-points/FetchAllusers.php",
        type: 'GET',
        dataType: 'json',
        success: function (data) {

            console.log(data);

            let chatList = $(".chat-list");
            chatList.empty(); // Clear existing list

            data.forEach(user => {
                chatList.append(`<li class="chat-user" data-username="${user.Username}">${user.Username}</li>`);
            });

            // Handle chat user selection
            $(".chat-user").click(function () {
                let username = $(this).data("username");
                $("#chat-with").text(username);
            });
        },
        error: function () {
            console.log("Error fetching users.");
        }
    });
});
