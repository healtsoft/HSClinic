function openPage(pageName, elmnt, color) {
    // Hide all elements with class="tabcontent" by default */
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Remove the background color of all tablinks/buttons
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
    }

    // Show the specific tab content
    document.getElementById(pageName).style.display = "block";

    // Add the specific color to the button used to open the tab content
    elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();


document.querySelector(".first").addEventListener("click", function() {
    Swal.fire({
      title: "Show Two Buttons Inside the Alert",
      showCancelButton: true,
      confirmButtonText: "Confirm",
      confirmButtonColor: "#00ff99",
      cancelButtonColor: "#ff0099"
    });
});

document.querySelector(".second").addEventListener("click", function() {
    Swal.fire({
      title: "Are you sure about deleting this file?",
      type: "info",
      showCancelButton: true,
      confirmButtonText: "Delete It",
      confirmButtonColor: "#ff0055",
      cancelButtonColor: "#999999",
      reverseButtons: true,
      focusConfirm: false,
      focusCancel: true
    });
});

document.querySelector(".third").addEventListener('click', function(){
    Swal.fire("Our First Alert", "With some body text and success icon!", "success");
});
