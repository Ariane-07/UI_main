$(document).ready(function() {
    // Open Modal


    $(document).on('click', '.DeletePostToggler', function() {
        var postid = $(this).data('postid');
        console.log(postid);
        $("#deletepostid").val(postid);
        $("#deletePostModal").fadeIn();
    });

    // Close Modal
    $(".CloseDeletePostModal").click(function() {
        $("#deletePostModal").fadeOut();
    });

    // Close Modal when clicking outside the modal content
    $("#deletePostModal").click(function(event) {
        if ($(event.target).is("#deletePostModal")) {
            $("#deletePostModal").fadeOut();
        }
    });


    
    $(document).on('click', '.EditPostToggler', function() {
        var postid = $(this).data('postid');
        var textcontent = $(this).data('textcontent');
        var mediacontent = $(this).data('mediacontent');
    
        console.log(mediacontent);
    
        $("#editpostid").val(postid);
        $("#editPostText").val(textcontent);
        $("#editPostModal").fadeIn();
    
        // Clear previous media previews
        $("#editMediaPreview").empty();
    
        // Check if there are images
        if (mediacontent.images && mediacontent.images.length > 0) {
            $.each(mediacontent.images, function(index, image) {
                $("#editMediaPreview").append(
                    `<img src="uploads/images/${image}" class="w-24 h-24 object-cover m-2 rounded-lg border">`
                );
            });
        }
        if (mediacontent?.videos?.length) {
            const videosHtml = mediacontent.videos.map(video => 
                `<video controls class="w-48 h-32 object-cover m-2 rounded-lg border">
                    <source src="uploads/videos/${video}" type="video/mp4">
                    Your browser does not support the video tag.
                 </video>`
            ).join("");
        
            $("#editMediaPreview").append(videosHtml);
        }
        
    
        // If needed, you can also handle video previews here
    });
    

    // Close Modal
    $(".ClosePostModal").click(function() {
        $("#editPostModal").fadeOut();
    });

    // Close Modal when clicking outside the modal content
    $("#editPostModal").click(function(event) {
        if ($(event.target).is("#editPostModal")) {
            $("#editPostModal").fadeOut();
        }
    });
});