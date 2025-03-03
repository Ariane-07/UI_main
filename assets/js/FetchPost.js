$(document).ready(function () {

    var Session_UserID=$("#UserID").val();

    let offset = 0;
    const limit = 5;

    const getUserPost = (append = false) => {
        $.ajax({
            url: "api/config/end-points/FetchUserPost.php",
            type: 'GET',
            data: { offset: offset, limit: limit },
            dataType: 'json',
            success: function(response) {
                console.log(response);

                if (!Array.isArray(response) || response.length === 0) {
                    if (!append) $("#postFeed").html("<p>No posts available.</p>");
                    $("#seeMoreBtn").hide();
                    return;
                }

                if (!append) $("#postFeed").empty();

                response.forEach(post => {
                    let Username = post.Username || "Unknown User";
                    let ProfilePic = post.ProfilePic 
                        ? post.ProfilePic 
                        : "https://ui-avatars.com/api/?name=User&background=random";
                    let postDate = post.post_date 
                        ? new Date(post.post_date).toLocaleString("en-US", { hour12: true }) 
                        : "Unknown Date";
                    let postContent = post.post_content || "";

                    let mediaContent = "";
                    if (post.post_images) {
                        try {
                            let media = JSON.parse(post.post_images);
                            let images = media.images || [];
                            let videos = media.videos || [];

                            mediaContent += images.map(img => 
                                `<img src="uploads/images/${img}" alt="Post Image" style="max-width: 50%; height: auto; margin: 5px;">`
                            ).join("");

                            mediaContent += videos.map(video => 
                                `<video controls style="max-width: 100%; height: auto; margin: 5px;">
                                    <source src="uploads/videos/${video}" type="video/mp4">
                                    Your browser does not support the video tag.
                                 </video>`
                            ).join("");
                        } catch (error) {
                            console.error("Error parsing post_images JSON:", error);
                        }
                    }

                    let editDeleteButtons = "";
if (Session_UserID == post.post_user_id) {
    editDeleteButtons = `
        <div class="post-actions-right">
            <span class="edit-icon"><i class="fas fa-edit"></i></span>
            <span class="delete-icon"><i class="fas fa-trash"></i></span>
        </div>
    `;
}

                $("#postFeed").append(`
                    <div class="post">
                        <div class="post-header">
                            <img class="profile-pic" src="uploads/images/${ProfilePic}" alt="Profile Picture">
                            <div>
                                <strong class="Username">${Username}</strong>
                                <span style="color: #666; font-size: 14px;" class="post_date"> • ${postDate}</span>
                            </div>
                        </div>
                        <div class="post-content">${postContent}</div>
                        <div class="media-content">${mediaContent}</div>
                        <div class="post-actions">
                            <div class="post-actions-left">
                                <button type="button" class="action-btn"><i class="far fa-heart"></i> <span>0</span></button>
                                <button type="button" class="action-btn comment-btn" data-post-id="${post.post_id}">
                                    <i class="far fa-comment"></i> Comment
                                </button>
                                <button type="button" class="action-btn"><i class="far fa-share-square"></i> Share</button>
                            </div>
                            ${editDeleteButtons} <!-- Insert edit/delete buttons here if condition is met -->
                        </div>
                        <div class="comments-section" id="comments-${post.post_id}" style="display: none;">
                            <div class="comments-list"></div>
                            <div class="comment-input">
                                <img src="uploads/images/${ProfilePic}" class="profile-pic" style="width: 32px; height: 32px;">
                                <input type="text" placeholder="Write a comment..." data-postid='${post.post_id}'>
                            </div>
                        </div>
                    </div>
                `);

                });

                if (response.length < limit) {
                    $("#seeMoreBtn").hide();
                } else {
                    $("#seeMoreBtn").show();
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching posts:", error);
                if (!append) $("#postFeed").html("<p>Error loading posts. Please try again later.</p>");
            }
        });
    };









    
    $(document).on("click", ".comment-btn", function () {
        let postId = $(this).data("post-id");
        let commentsSection = $("#comments-" + postId);
        
        // Toggle comment section visibility
        commentsSection.toggle();
    
        // If the section is now visible, fetch comments
        if (commentsSection.is(":visible")) {
            getComments(postId);
        }
    });
    
    // Function to fetch comments for a post
    const getComments = (postId) => {
        $.ajax({
            url: "api/config/end-points/FetchComments.php", // Replace with your actual API endpoint
            type: "GET",
            data: { postId: postId },
            dataType: "json",
            success: function (response) {
                console.log(postId);
                let commentsList = $("#comments-" + postId).find(".comments-list");
                commentsList.empty(); // Clear existing comments
    
                if (!Array.isArray(response) || response.length === 0) {
                    commentsList.html("<p>No comments yet.</p>");
                    return;
                }
    
                response.forEach(comment => {
                    let username = comment.username || "Anonymous";
                    let profilePic = comment.profilePic || "https://ui-avatars.com/api/?name=User&background=random";
                    let commentText = comment.comment_text || "";
                    let commentDate = new Date(comment.comment_date).toLocaleString("en-US", { hour12: true });
    
                    let commentHTML = `
                        <div class="comment">
                            <img src="uploads/images/${profilePic}" class="profile-pic" style="width: 32px; height: 32px;">
                            <div>
                                <strong>${username}</strong> <span style="font-size: 12px; color: gray;">${commentDate}</span>
                                <p>${commentText}</p>
                            </div>
                        </div>
                    `;
                    commentsList.append(commentHTML);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error fetching comments:", error);
            }
        });
    };
    
    // Submit new comment when pressing Enter
    $(document).on("keypress", ".comment-input input", function (event) {
        if (event.key === "Enter" && $(this).val().trim() !== "") {
            let postId = $(this).data('postid');
            let commentText = $(this).val().trim();
            let commentsList = $(this).closest(".comments-section").find(".comments-list");
    
            // Simulated logged-in user details (replace with actual session values)
            let username = $("#username").val();// Replace with actual username from session
            let profilePic = "https://ui-avatars.com/api/?name=User&background=random"; // Replace with actual user profile pic
    
            // Add comment to UI
            let newComment = `
                <div class="comment">
                    <img src="${profilePic}" class="profile-pic" style="width: 32px; height: 32px;">
                    <div>
                        <strong>${username}</strong>
                        <p>${commentText}</p>
                    </div>
                </div>
            `;
            commentsList.append(newComment);
            $(this).val(""); // Clear input field
    
            // Send comment to server
            $.ajax({
                url: "api/config/end-points/AddComment.php", 
                type: "POST",
                data: { postId: postId, commentText: commentText },
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error("Error adding comment:", error);
                }
            });
        }
    });

    

    $("#seeMoreBtn").click(function () {
        offset += limit;
        getUserPost(true);
    });

    getUserPost();


    

    // setInterval(() => {
    //     getUserPost();
    // }, 1000);
});
