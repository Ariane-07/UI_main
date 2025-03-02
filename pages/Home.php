
<section>
    <div class="home-container">
        <!-- Post Box and Post Feed -->
        <div class="post-area">
        <form id="frmPOST_CONTENT">
            <!-- Post Box -->
            <div class="post-box">
                <!-- Spinner -->
                <div id="spinner" class="spinner" style="display:none;">
                    <div class="loader"></div>
                </div>

                <!-- Hidden User ID -->
                <input type="hidden" name="UserID" value="<?= isset($_SESSION['UserID']) ? htmlspecialchars($_SESSION['UserID']) : ''; ?>">

                <!-- Textarea -->
                <textarea id="postInput" placeholder="What's happening?" rows="3" name="postInput"></textarea>

                <!-- Media Preview -->
                <div class="media-preview" id="mediaPreview"></div>

                <div class="media-inputs">
                    <!-- Image Upload -->
                    <label class="custom-file-label">
                        <i class="fas fa-image"></i> Photo
                        <input type="file" id="imageUpload" accept="image/*" class="custom-file-input" name="imageUpload[]" multiple hidden>
                    </label>

                    <!-- Video Upload -->
                    <label class="custom-file-label">
                        <i class="fas fa-video"></i> Video
                        <input type="file" id="videoUpload" accept="video/*" class="custom-file-input" name="videoUpload[]" multiple hidden>
                    </label>

                    <!-- Submit Button -->
                    <button type="submit" id="btnPOSTCONTENT">POST</button>
                </div>
            </div>
        </form>

            <!-- Post Feed -->
            <div id="postFeed" class="post-feed"></div>
        </div>

        <!-- Image Modal for Zoom -->
        <div class="image-modal" id="imageModal">
            <img id="modalImage" style="display: none; width: 100%; border-radius: 10px;">
            <video id="modalVideo" style="display: none; width: 100%;" controls></video>
        </div>

        <div class="share-modal" id="shareModal">
            <div class="share-modal-content">
                <span class="share-modal-close">&times;</span>
                <h3>Share Post</h3>
                <div class="share-options">
                    <button class="share-btn copy-link">
                        <i class="fas fa-link"></i> Copy Post Link
                    </button>
                    <button class="share-btn share-to-feed">
                        <i class="fas fa-share"></i> Share to Feed
                    </button>
                </div>
            </div>
        </div>

        <div class="delete-modal" id="deleteModal">
            <div class="delete-modal-content">
                <h3>Delete Post</h3>
                <p>Are you sure you want to delete this post?</p>
                <div class="delete-modal-actions">
                    <button id="confirmDelete" class="delete-btn">Delete</button>
                    <button onclick="closeDeleteModal()" class="cancel-btn">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Edited Modal -->
        <div class="edit-modal" id="editModal">
            <div class="edit-modal-content">
                <span class="edit-modal-close" onclick="closeEditModal()">&times;</span>
                <h3>Edit Post</h3>
                <textarea id="editPostText" rows="3" placeholder="What's on your mind?"></textarea>

                <div id="editMediaPreview"></div>

                <div style="display: flex; align-items: center; gap: 10px;">
                    <label for="editImageUpload" class="custom-file-label" title="Upload Photos">
                        <input type="file" id="editImageUpload" multiple accept="image/*" style="display: none;">
                        <i class="fas fa-image"></i>
                    </label>

                    <label for="editVideoUpload" class="custom-file-label" title="Upload Video">
                        <input type="file" id="editVideoUpload" accept="video/*" style="display: none;">
                        <i class="fas fa-video"></i>
                    </label>

                    <button onclick="savePostChanges()" class="save-btn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Global variables
let selectedFiles = [];
let currentEditPost = null;
let postIdCounter = 0;
let postToDelete = null;

// Initialize event listeners
document.addEventListener('DOMContentLoaded', () => {
    initializeMediaInputs();
    initializePostButton();
    initializeModals();
});

function initializeMediaInputs() {
    const imageUpload = document.getElementById('imageUpload');
    const videoUpload = document.getElementById('videoUpload');
    const mediaPreview = document.getElementById('mediaPreview');

    // Handle image selection
    imageUpload.addEventListener('change', (e) => {
        handleFileSelection(e.target.files, mediaPreview);
    });

    // Handle video selection
    videoUpload.addEventListener('change', (e) => {
        handleFileSelection(e.target.files, mediaPreview);
    });
}

function handleFileSelection(files, mediaPreview) {
    // Reset previous media
    mediaPreview.innerHTML = ''; 
    selectedFiles = []; 

    Array.from(files).forEach(file => {
        selectedFiles.push(file);
        const reader = new FileReader();
        reader.onload = (e) => {
            const mediaContainer = document.createElement('div');
            mediaContainer.classList.add('media-container');

            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.margin = '5px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '10px';
                mediaContainer.appendChild(img);
            } else if (file.type.startsWith('video/')) {
                const video = document.createElement('video');
                video.src = URL.createObjectURL(file);
                video.controls = true;
                video.style.width = '100px';
                video.style.height = '100px';
                video.style.margin = '5px';
                video.style.objectFit = 'cover';
                video.style.borderRadius = '10px';
                mediaContainer.appendChild(video);
            }

            const closeIcon = document.createElement('span');
            closeIcon.classList.add('close-icon');
            closeIcon.innerHTML = '✖';
            closeIcon.onclick = () => removeMedia(file, mediaContainer);
            mediaContainer.appendChild(closeIcon);

            mediaPreview.appendChild(mediaContainer);
        };
        reader.readAsDataURL(file);
    });
}


function removeMedia(file, mediaContainer) {
    selectedFiles = selectedFiles.filter(f => f !== file);
    mediaContainer.remove();

    // Reset file input fields
    const imageUpload = document.getElementById('imageUpload');
    const videoUpload = document.getElementById('videoUpload');

    if (file.type.startsWith('image/')) {
        imageUpload.value = ''; // Clear image input
    } else if (file.type.startsWith('video/')) {
        videoUpload.value = ''; // Clear video input
    }
}


function initializePostButton() {
    document.getElementById('postButton').addEventListener('click', () => {
        const postText = document.getElementById('postInput').value;

        if (!postText && selectedFiles.length === 0) {
            alert('Please write something or upload media');
            return;
        }

        createPost(postText, selectedFiles);
        clearPostInput();
    });
}

function createPost(postText, files) {
    postIdCounter++;
    const postFeed = document.getElementById('postFeed');
    const post = document.createElement('div');
    post.classList.add('post');
    post.setAttribute('id', `post-${postIdCounter}`);

    // Post header
    const postHeader = createPostHeader();
    post.appendChild(postHeader);

    // Post content
    const content = document.createElement('div');
    content.classList.add('post-content');
    content.textContent = postText;
    post.appendChild(content);

    // Media content
    const mediaContent = createMediaContent(files);
    post.appendChild(mediaContent);

    // Post actions
    const actions = createPostActions(postIdCounter);
    post.appendChild(actions);

    // Comments section
    const commentsSection = createCommentsSection(postIdCounter);
    post.appendChild(commentsSection);

    postFeed.insertBefore(post, postFeed.firstChild);
}

function createPostHeader() {
    const header = document.createElement('div');
    header.classList.add('post-header');

    const profilePic = document.createElement('img');
    profilePic.src = 'https://ui-avatars.com/api/?name=User&background=random';
    profilePic.classList.add('profile-pic');

    const userInfo = document.createElement('div');
    userInfo.innerHTML = `
        <strong>Username</strong>
        <span style="color: #666; font-size: 14px;"> • ${new Date().toLocaleString()}</span>
    `;

    header.appendChild(profilePic);
    header.appendChild(userInfo);
    return header;
}

function createMediaContent(files) {
    const mediaContent = document.createElement('div');
    mediaContent.classList.add('media-content');

    // Set grid columns based on number of media items
    const totalItems = files.length;
    if (totalItems === 1) {
        mediaContent.style.gridTemplateColumns = '1fr';
    } else if (totalItems === 2) {
        mediaContent.style.gridTemplateColumns = 'repeat(2, 1fr)';
    } else {
        mediaContent.style.gridTemplateColumns = 'repeat(auto-fit, minmax(200px, 1fr))';
    }

    files.forEach(file => {
        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.addEventListener('click', () => showMediaModal(img.src, 'image'));
            mediaContent.appendChild(img);
        } else if (file.type.startsWith('video/')) {
            const video = document.createElement('video');
            video.src = URL.createObjectURL(file);
            video.controls = true;
            video.addEventListener('click', (e) => {
                e.preventDefault();
                showMediaModal(video.src, 'video');
            });
            mediaContent.appendChild(video);
        }
    });

    return mediaContent;
}

function createPostActions(postId) {
    const actions = document.createElement('div');
    actions.classList.add('post-actions');

    // Left side actions (like, comment, share)
    const leftActions = document.createElement('div');
    leftActions.classList.add('post-actions-left');

    // Like button
    const likeBtn = document.createElement('button');
    likeBtn.classList.add('action-btn');
    likeBtn.innerHTML = '<i class="far fa-heart"></i> <span>0</span>';
    likeBtn.addEventListener('click', () => toggleLike(likeBtn));

    // Comment button
    const commentBtn = document.createElement('button');
    commentBtn.classList.add('action-btn');
    commentBtn.innerHTML = '<i class="far fa-comment"></i> Comment';
    commentBtn.addEventListener('click', () => toggleComments(postId));

    // Share button
    const shareBtn = document.createElement('button');
    shareBtn.classList.add('action-btn');
    shareBtn.innerHTML = '<i class="far fa-share-square"></i> Share';
    shareBtn.addEventListener('click', () => showShareModal(postId));

    leftActions.appendChild(likeBtn);
    leftActions.appendChild(commentBtn);
    leftActions.appendChild(shareBtn);

    // Right side actions (edit, delete)
    const rightActions = document.createElement('div');
    rightActions.classList.add('post-actions-right');

    // Edit icon
    const editIcon = document.createElement('span');
    editIcon.classList.add('edit-icon');
    editIcon.innerHTML = '<i class="fas fa-edit"></i>';
    editIcon.onclick = () => openEditModal(postId);

    // Delete icon
    const deleteIcon = document.createElement('span');
    deleteIcon.classList.add('delete-icon');
    deleteIcon.innerHTML = '<i class="fas fa-trash"></i>';
    deleteIcon.onclick = () => showDeleteModal(postId);

    rightActions.appendChild(editIcon);
    rightActions.appendChild(deleteIcon);

    actions.appendChild(leftActions);
    actions.appendChild(rightActions);
    return actions;
}

function createCommentsSection(postId) {
    const section = document.createElement('div');
    section.classList.add('comments-section');
    section.style.display = 'none';
    section.innerHTML = `
        <div class="comments-list"></div>
        <div class="comment-input">
            <img src="https://ui-avatars.com/api/?name=User&background=random" class="profile-pic" style="width: 32px; height: 32px;">
            <input type="text" placeholder="Write a comment..." onkeypress="handleCommentSubmit(event, ${postId})">
        </div>
    `;
    return section;
}

function toggleLike(button) {
    const icon = button.querySelector('i');
    const count = button.querySelector('span');

    if (icon.classList.contains('far')) {
        icon.classList.replace('far', 'fas');
        icon.classList.add('liked');
        count.textContent = parseInt(count.textContent) + 1;
    } else {
        icon.classList.replace('fas', 'far');
        icon.classList.remove('liked');
        count.textContent = parseInt(count.textContent) - 1;
    }
}

function toggleComments(postId) {
    const post = document.getElementById(`post-${postId}`);
    const commentsSection = post.querySelector('.comments-section');
    commentsSection.style.display = commentsSection.style.display === 'none' ? 'block' : 'none';
}

function handleCommentSubmit(event, postId) {
    if (event.key === 'Enter' && event.target.value.trim()) {
        const post = document.getElementById(`post-${postId}`);
        const commentsList = post.querySelector('.comments-list');
        const comment = document.createElement('div');
        comment.classList.add('comment');
        comment.innerHTML = `
            <img src="https://ui-avatars.com/api/?name=User&background=random" class="profile-pic" style="width: 32px; height: 32px;">
            <div>
                <strong>Username</strong>
                <p>${event.target.value}</p>
            </div>
        `;
        commentsList.appendChild(comment);
        event.target.value = '';
    }
}

function showShareModal(postId) {
    const shareModal = document.getElementById('shareModal');
    shareModal.style.display = 'block';

    const copyLinkBtn = shareModal.querySelector('.copy-link');
    copyLinkBtn.onclick = () => {
        const postUrl = `${window.location.pathname}#post-${postId}`;
        navigator.clipboard.writeText(postUrl);
        alert('Link copied! You can now share it with other users on the platform.');
    };

    const shareToFeedBtn = shareModal.querySelector('.share-to-feed');
    shareToFeedBtn.onclick = () => {
        shareToFeed(postId);
    };
}

function shareToFeed(postId) {
    const originalPost = document.getElementById(`post-${postId}`);
    const postText = originalPost.querySelector('.post-content').textContent;
    const mediaContent = originalPost.querySelector('.media-content').cloneNode(true);

    // Create a new post with shared content
    createPost(`Shared: ${postText}`, [], null, mediaContent);
    alert('Post shared to your feed!');

    // Close the share modal
    document.getElementById('shareModal').style.display = 'none';
}

function showMediaModal(src, type) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const modalVideo = document.getElementById('modalVideo');

    modal.style.display = 'block';

    if (type === 'image') {
        modalImg.style.display = 'block';
        modalVideo.style.display = 'none';
        modalImg.src = src;
    } else {
        modalImg.style.display = 'none';
        modalVideo.style.display = 'block';
        modalVideo.src = src;
    }

    // Close modal when clicking anywhere
    modal.onclick = function() {
        this.style.display = 'none';
        modalVideo.pause(); // Stop video playback when closing
    };
}

function initializeModals() {
    // Close modal when clicking outside
    window.onclick = (event) => {
        const modals = [
            document.getElementById('imageModal'),
            document.getElementById('shareModal'),
            document.getElementById('editModal'),
            document.getElementById('deleteModal')
        ];

        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    };

    // Close buttons
    document.querySelectorAll('.share-modal-close, .edit-modal-close').forEach(btn => {
        btn.onclick = () => {
            btn.closest('.share-modal, .edit-modal').style.display = 'none';
        };
    });
}

function clearPostInput() {
    document.getElementById('postInput').value = '';
    document.getElementById('imageUpload').value = '';
    document.getElementById('videoUpload').value = '';
    document.getElementById('mediaPreview').innerHTML = '';
    selectedFiles = []; // Reset selected files
}

function openEditModal(postId) {
    currentEditPost = postId;
    const post = document.getElementById(`post-${postId}`);
    const postContent = post.querySelector('.post-content');
    const mediaContent = post.querySelector('.media-content');

    document.getElementById('editPostText').value = postContent.textContent;

    // Clear previous media previews
    document.getElementById('editMediaPreview').innerHTML = '';
    document.getElementById('editImageUpload').value = '';
    document.getElementById('editVideoUpload').value = '';

    // Show existing media in preview
    if (mediaContent) {
        const images = mediaContent.querySelectorAll('img');
        const videos = mediaContent.querySelectorAll('video');

        images.forEach(img => {
            const imgClone = img.cloneNode(true);
            document.getElementById('editMediaPreview').appendChild(imgClone);
        });

        videos.forEach(video => {
            const videoClone = video.cloneNode(true);
            document.getElementById('editMediaPreview').appendChild(videoClone);
        });
    }

    document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
    currentEditPost = null;
}

function savePostChanges() {
    const postId = currentEditPost;
    const post = document.getElementById(`post-${postId}`);
    const postContent = post.querySelector('.post-content');
    const mediaContent = post.querySelector('.media-content');

    // Update text content
    postContent.textContent = document.getElementById('editPostText').value;

    // Update media content
    const newImages = document.getElementById('editImageUpload').files;
    const newVideo = document.getElementById('editVideoUpload').files[0];

    if (newImages.length > 0 || newVideo) {
        mediaContent.innerHTML = '';

        Array.from(newImages).forEach(file => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.addEventListener('click', () => showMediaModal(img.src, 'image'));
            mediaContent.appendChild(img);
        });

        if (newVideo) {
            const video = document.createElement('video');
            video.src = URL.createObjectURL(newVideo);
            video.controls = true;
            video.addEventListener('click', (e) => {
                e.preventDefault();
                showMediaModal(video.src, 'video');
            });
            mediaContent.appendChild(video);
        }
    }

    closeEditModal();
}

function showDeleteModal(postId) {
    postToDelete = postId;
    document.getElementById('deleteModal').style.display = 'block';

    // Set up confirm delete button
    document.getElementById('confirmDelete').onclick = () => {
        deletePost(postId);
        closeDeleteModal();
    };
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    postToDelete = null;
}

function deletePost(postId) {
    const post = document.getElementById(`post-${postId}`);
    post.remove();
}
</script>