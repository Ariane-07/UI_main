$(document).ready(function () {
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

                    $("#postFeed").append(`
                        <div class="post">
                            <div class="post-header">
                                <img class="profile-pic" src="${ProfilePic}" alt="Profile Picture">
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
                                <div class="post-actions-right">
                                    <span class="edit-icon"><i class="fas fa-edit"></i></span>
                                    <span class="delete-icon"><i class="fas fa-trash"></i></span>
                                </div>
                            </div>
                            <div class="comments-section" id="comments-${post.post_id}" style="display: none;">
                                <div class="comments-list"></div>
                                <div class="comment-input">
                                    <img src="${ProfilePic}" class="profile-pic" style="width: 32px; height: 32px;">
                                    <input type="text" placeholder="Write a comment..." onkeypress="handleCommentSubmit(event, ${post.post_id})">
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
        $("#comments-" + postId).slideToggle();
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
