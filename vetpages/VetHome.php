<section>
    <div class="home-container">
        <!-- Post Box and Post Feed -->
        <div class="post-area">
            <!-- Post Box -->
            <div class="post-box">
                <textarea id="postInput" placeholder="What's happening?" rows="3"></textarea>
                <div class="media-inputs">
                    <!-- Hidden file input for image -->
                    <input type="file" id="imageUpload" accept="image/*" class="custom-file-input" multiple>
                    <label for="imageUpload" class="custom-file-label">UPLOAD PHOTO</label>

                    <!-- Hidden file input for video -->
                    <input type="file" id="videoUpload" accept="video/*" class="custom-file-input">
                    <label for="videoUpload" class="custom-file-label">UPLOAD VIDEO</label>

                    <button id="postButton">POST</button>
                </div>

            </div>

            <!-- Post Feed -->
            <div id="postFeed" class="post-feed"></div>
        </div>

    <!-- Image Modal for Zoom -->
    <div class="image-modal" id="imageModal">
        <img id="editImagePreview" style="display: none; width: 100%; border-radius: 10px;">
        <video id="editVideoPreview" style="display: none; width: 100%;" controls></video>
    </div>

    <div class="edit-modal" id="editModal">
        <div class="edit-modal-content">
            <span class="edit-modal-close" onclick="closeEditModal()">&times;</span>
            <h3>Edit Post</h3>
            <textarea id="editPostText" rows="3" style="width: 100%;"></textarea>

            <label for="editImageUpload" class="home-custom-file-upload">
                <input type="file" id="editImageUpload" multiple accept="image/*" />
                <div id="editImagePreviewContainer" style="display: none;"></div>
                UPLOAD IMAGE
            </label>

            <label for="editVideoUpload" class="home-custom-file-upload">
                <input type="file" id="editVideoUpload" accept="video/*" />
                UPLOAD VIDEO
            </label>

            <button onclick="savePostChanges()" class="savebtn">SAVE</button>
        </div>
    </div>

</section>

<script>
    let currentEditPost = null; // Define it at the top to make it globally accessible
    let postIdCounter = 0;

    function createPost(postText, imageUploads, videoUpload) {
        postIdCounter++;
        const postFeed = document.getElementById('postFeed');

        const newPost = document.createElement('div');
        newPost.classList.add('post');
        newPost.setAttribute('id', `post-${postIdCounter}`);

        const postHeader = document.createElement('div');
        postHeader.classList.add('post-header');

        const profilePic = document.createElement('img');
        profilePic.src = 'https://via.placeholder.com/40';
        profilePic.classList.add('profile-pic');

        const userName = document.createElement('span');
        userName.textContent = 'Username';
        userName.style.fontWeight = 'bold';

        const dateTime = document.createElement('span');
        dateTime.textContent = new Date().toLocaleString();
        dateTime.style.marginLeft = '10px';
        dateTime.style.color = '#aaa';
        dateTime.style.fontSize = '12px';

        postHeader.appendChild(profilePic);
        postHeader.appendChild(userName);
        postHeader.appendChild(dateTime);
        newPost.appendChild(postHeader);

        // Post text
        const textElement = document.createElement('p');
        textElement.classList.add('post-text');
        textElement.textContent = postText;
        newPost.appendChild(textElement);

        // Post media
        const mediaElement = document.createElement('div');
        mediaElement.classList.add('post-media');

        if (imageUploads && imageUploads.length > 0) {
            Array.from(imageUploads).slice(0, 4).forEach((imageFile) => {
                const imgElement = document.createElement('img');
                imgElement.src = URL.createObjectURL(imageFile);
                imgElement.style.width = '200px';
                imgElement.style.height = '150px';
                imgElement.style.margin = '5px';
                mediaElement.appendChild(imgElement);
            });
        }

        if (videoUpload) {
            const videoElement = document.createElement('video');
            videoElement.src = URL.createObjectURL(videoUpload);
            videoElement.controls = true;
            mediaElement.appendChild(videoElement);
        }

        newPost.appendChild(mediaElement);

        // Add edit and delete icons
        const editIcon = document.createElement('span');
        editIcon.classList.add('edit-icon');
        editIcon.innerHTML = '✏️'; // Edit icon
        editIcon.onclick = () => openEditModal(newPost, textElement, mediaElement);

        const deleteIcon = document.createElement('span');
        deleteIcon.classList.add('delete-icon');
        deleteIcon.innerHTML = '🗑️'; // Delete icon
        deleteIcon.onclick = () => deletePost(newPost);

        newPost.appendChild(editIcon);
        newPost.appendChild(deleteIcon);
        postFeed.appendChild(newPost);
    }

    function openEditModal(postElement, textElement, mediaElement) {
        currentEditPost = postElement.id;

        document.getElementById('editPostText').value = textElement.textContent;

        // Clear previous media inputs
        document.getElementById('editImageUpload').value = '';
        document.getElementById('editVideoUpload').value = '';

        // Show existing media in modal if available
        const existingImages = mediaElement.querySelectorAll('img');
        const existingVideo = mediaElement.querySelector('video');

        const imagePreviewContainer = document.getElementById('editImagePreviewContainer');
        imagePreviewContainer.innerHTML = ''; // Clear previous previews

        existingImages.forEach((img) => {
            const imgPreview = document.createElement('img');
            imgPreview.src = img.src;
            imgPreview.style.width = '100px'; // Set preview size
            imgPreview.style.margin = '5px';
            imagePreviewContainer.appendChild(imgPreview);
        });

        if (existingVideo) {
            document.getElementById('editVideoPreview').src = existingVideo.src;
            document.getElementById('editVideoPreview').style.display = 'block';
        } else {
            document.getElementById('editVideoPreview').style.display = 'none';
        }

        // Show modal
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function savePostChanges() {
        const postText = document.getElementById('editPostText').value;
        const imageUploads = document.getElementById('editImageUpload').files; // Get multiple images
        const videoUpload = document.getElementById('editVideoUpload').files[0];

        const postElement = document.getElementById(currentEditPost);
        const textElement = postElement.querySelector('.post-text');
        const mediaElement = postElement.querySelector('.post-media');

        textElement.textContent = postText;

        mediaElement.innerHTML = ''; // Clear existing media

        // Update media if available
        Array.from(imageUploads).slice(0, 4).forEach((imageFile) => {
            const imgElement = document.createElement('img');
            imgElement.src = URL.createObjectURL(imageFile);
            imgElement.style.width = '300px';
            imgElement.style.borderRadius = '10px';
            mediaElement.appendChild(imgElement);
        });

        if (videoUpload) {
            const videoElement = document.createElement('video');
            videoElement.src = URL.createObjectURL(videoUpload);
            videoElement.controls = true;
            mediaElement.appendChild(videoElement);
        }

        closeEditModal(); // Close modal after saving
    }

    function deletePost(postElement) {
        postElement.remove();
    }

    document.getElementById('postButton').addEventListener('click', function() {
        const postText = document.getElementById('postInput').value;
        const imageUploads = document.getElementById('imageUpload').files; // Allow multiple image uploads
        const videoUpload = document.getElementById('videoUpload').files[0];

        if (!postText && imageUploads.length === 0 && !videoUpload) {
            alert('Please write something or upload media');
            return;
        }

        createPost(postText, imageUploads, videoUpload);

        // Clear input
        document.getElementById('postInput').value = '';
        document.getElementById('imageUpload').value = '';
        document.getElementById('videoUpload').value = '';
    });
</script>