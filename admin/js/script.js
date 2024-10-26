const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");

allSideMenu.forEach((item) => {
  const li = item.parentElement;

  item.addEventListener("click", function () {
    allSideMenu.forEach((i) => {
      i.parentElement.classList.remove("active");
    });
    li.classList.add("active");
  });
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector("#content nav .fas.fa-bars");
const sidebar = document.getElementById("sidebar");

menuBar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});

// Dark Mode Toggle
const switchMode = document.getElementById("switch-mode");

// Check initial state of dark mode based on checkbox
document.addEventListener("DOMContentLoaded", function () {
  if (switchMode.checked) {
    document.body.classList.add("dark");
  } else {
    document.body.classList.remove("dark");
  }
});

switchMode.addEventListener("change", function () {
  console.log("Switch mode toggled:", this.checked);
  if (this.checked) {
    document.body.classList.add("dark");
  } else {
    document.body.classList.remove("dark");
  }
});

function approveMembership(userId, action, button) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "approve_membership.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      console.log("Response:", xhr.responseText.trim());
      if (xhr.responseText.trim() === "success") {
        var row = button.closest("tr");
        var statusCell = row.querySelector(".status");
        var approveButton = row.querySelector(".approve-btn");
        var rejectButton = row.querySelector(".reject-btn");

        if (action === "approve") {
          statusCell.className = "status approved pointer";
          statusCell.innerText = "Approved";
          alert("Membership has been approved successfully.");
        } else if (action === "reject") {
          statusCell.className = "status rejected pointer";
          statusCell.innerText = "Rejected";
          alert("Membership has been rejected.");
        }

        // Hide the buttons after update
        if (approveButton) approveButton.style.display = "none";
        if (rejectButton) rejectButton.style.display = "none";
      } else {
        alert("An error occurred. Please try again.");
      }
    }
  };

  xhr.send("user_id=" + userId + "&action=" + action);
}
