import $ from "jquery";

$(document).ready(function () {
    let selectedUserId = null;

    $(".delete-user").click(function () {
        selectedUserId = $(this).data("id");
        $("#deleteModal").removeClass("hidden");
    });

    $("#cancelDelete").click(function () {
        $("#deleteModal").addClass("hidden");
    });

    $("#confirmDelete").click(function () {
        if (selectedUserId) {
            $.ajax({
                url: "/user/delete/" + selectedUserId,
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    if (response.success) {
                        showNotification("User deleted successfully!", "bg-green-600");
                        setTimeout(function () {
                            location.reload(); 
                        }, 1000);
                    } else {
                        showNotification("Error deleting user.", "bg-red-600");
                    }
                    $("#deleteModal").addClass("hidden");
                },
                error: function () {
                    showNotification("Something went wrong!", "bg-red-600");
                    $("#deleteModal").addClass("hidden");
                }
            });
        }
    });

    
    function showNotification(message, backgroundColor) {
        $("#notificationMessage").text(message); // Set the message
        $("#notification").removeClass("hidden").addClass(backgroundColor); // Show and set the background color

        
        setTimeout(function () {
            $("#notification").addClass("hidden").removeClass(backgroundColor);
        }, 3000);
    }
});
