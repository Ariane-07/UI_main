
<section>
    <div class="home-container">
        <!-- Post Box and Post Feed -->
        <div class="post-area">
      
    <!-- Post Box -->
    <div class="post-box">
        <!-- Spinner -->
        <div id="spinner" class="spinner" style="display:none;">
            <div class="loader"></div>
        </div>

        <form id="frmPOST_CONTENT">
        <!-- Hidden User ID -->
        <input type="hidden" id="UserID" name="UserID" value="<?= $_SESSION['UserID']?>">
        <input type="hidden" id="username" name="username" value="<?= $_SESSION['username']?>">
        <input type="hidden" id="ProfilePic" name="ProfilePic" value="<?= isset($_SESSION['ProfilePic']) && $_SESSION['ProfilePic'] ? "uploads/images/" . $_SESSION['ProfilePic'] : "assets/imgs/User-Profile.png" ?>" alt="Profile Image">

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
            </form>
        </div>
    </div>

   


    
</form>

    <!-- "See More" Button -->
    <div class="see-more-container">
        <button id="seeMoreBtn" style="display:none;">See More</button>
    </div>



        <!-- Posts Feed -->
        <div id="postFeed" class="post-feed"></div>
        <!-- "See More" Button -->
        <div class="see-more-container">
            <button id="seeMoreBtn" style="display:none;">See More</button>
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


        <form id="frmDeletePost">
            <div class="delete-modal" id="deletePostModal">
                <div class="delete-modal-content">
                <input hidden type="text" id="deletepostid" name="deletepostid">
                    <h3>Delete Post</h3>
                    <p>Are you sure you want to delete this post?</p>
                    <div class="delete-modal-actions">
                        <button type="submit" id="confirmDeletePost" class="delete-btn">Delete</button>
                        <button type="button"  class="CloseDeletePostModal cancel-btn">Cancel</button>
                    </div>
                </div>
            </div>
        </form>


        <!-- Edited Modal -->
        <form id="frmEditPost">
        <div class="edit-modal" id="editPostModal">
            <div class="edit-modal-content">
           
                <span class="edit-modal-close ClosePostModal" >&times;</span>
                <h3>Edit Post</h3>
                
                    <input hidden type="text" id="editpostid" name="editpostid">
                    <textarea id="editPostText" name="editPostText" rows="3" placeholder="What's on your mind?"></textarea>

                    <div id="editMediaPreview"></div>

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <label for="editImageUpload" class="custom-file-label" title="Upload Photos">
                            <input type="file" id="editImageUpload" multiple accept="image/*" style="display: none;" name="images[]">
                            <i class="fas fa-image"></i>
                        </label>

                        <label for="editVideoUpload" class="custom-file-label" title="Upload Video">
                            <input type="file" id="editVideoUpload" accept="video/*" style="display: none;" name="videos[]">
                            <i class="fas fa-video"></i>
                        </label>
                        <button type="submit" id="btnUpdatePost" class="save-btn">Save Changes</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>



<script src="assets/js/home.js"></script>
<script src="assets/js/FetchPost.js"></script>
<script src="assets/js/modal.js"></script>
