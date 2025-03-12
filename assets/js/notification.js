$(document).ready(function () {
    const getNotificationCount = () => {
        $.ajax({
            url: "api/config/end-points/getNotificationCount.php",
            type: 'GET',
            dataType: 'json',
            success: function(response) {
              
                var totalNotif=response.total_soon_to_expi+response.totalexpi
                $(".notification-count").text(totalNotif);


                let notificationList = $(".notification-list");
                notificationList.empty(); // Clear old notifications

                if (response.total_notifications > 0) {
                    // Display soon-to-expire notifications with expiry date
                    if (response.soon_to_expire_pets.length > 0) {
                        response.soon_to_expire_pets.forEach(pet => {
                            notificationList.append(
                                `<li class="soon-expire">⚠️ ${pet.name}'s anti-rabies vaccine will expire on <b>${pet.expiry_date}</b>!</li>`
                            );
                        });
                    }

                    // Display expired notifications
                    if (response.expired_pets.length > 0) {
                        response.expired_pets.forEach(pet => {
                            notificationList.append(
                                `<li class="expired">❌ ${pet}'s anti-rabies vaccine has already expired!</li>`
                            );
                        });
                    }
                } else {
                    notificationList.append("<li>No new notifications.</li>");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching notification counts:", error);
            }
        });
    };

    // Refresh notifications every 3 seconds
    setInterval(() => {
        getNotificationCount();
    }, 3000);

    getNotificationCount();
});
