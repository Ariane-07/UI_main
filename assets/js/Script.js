document.addEventListener("DOMContentLoaded", () => {
  const elements = {
    nav: document.querySelector("nav"),
    body: document.querySelector("body"),
    logo: document.getElementById("logo"),
    vetSignUp: document.getElementById("vet-signup"), 
    lguSignUp: document.getElementById("lgu-signup"),
    vetSignIn: document.getElementById("vet-signin"),
    lguSignIn: document.getElementById("lgu-signin"),
    modeToggle: document.querySelector(".dark-light"),
    signinbtn: document.querySelector("#sign-in-btn"),
    signupbtn: document.querySelector("#sign-up-btn"),
    sidebarOpen: document.querySelector(".sidebarOpen"),
    signinModal: document.getElementById("signin-modal"),
    forgotModal: document.getElementById("forgot-modal"),
    searchToggle: document.querySelector(".searchToggle"),
    sidebarClose: document.querySelector(".sidebarClose"),
    forgotPassword: document.getElementById("forgot-password"),
    closeBtns: document.getElementsByClassName("logreg-close"),
    logregcontainer: document.querySelector(".logreg-container"),
  };

  function setLogo() {
    if (elements.body.classList.contains("dark")) {
      elements.logo.src = "assets/imgs/LogoW.png"; 
    } else {
      elements.logo.src = "assets/imgs/Logo.png"; 
    }
  }
  // Check for dark mode
  let getMode = localStorage.getItem("mode");
  if (getMode && getMode === "dark-mode" && elements.body) {
    elements.body.classList.add("dark");
    setLogo();
  }

  // Mode toggle functionality
  if (elements.modeToggle) {
    elements.modeToggle.addEventListener("click", () => {
      elements.modeToggle.classList.toggle("active");
      elements.body?.classList.toggle("dark");

      if (!elements.body?.classList.contains("dark")) {
        localStorage.setItem("mode", "light-mode");
      } else {
        localStorage.setItem("mode", "dark-mode");
      }

      setLogo();
    });
  }

  // Sidebar open functionality
  if (elements.sidebarOpen && elements.nav) {
    elements.sidebarOpen.addEventListener("click", () => {
      elements.nav.classList.add("active");
    });
  }

  // Body click functionality
  if (elements.body && elements.nav) {
    elements.body.addEventListener("click", (e) => {
      let clickedElm = e.target;
      if (
        clickedElm instanceof Element &&
        !clickedElm.classList.contains("sidebarOpen") &&
        !clickedElm.classList.contains("menu")
      ) {
        elements.nav.classList.remove("active");
      }
    });
  }

  // Search toggle functionality
  if (elements.searchToggle) {
    elements.searchToggle.addEventListener("click", () => {
      elements.searchToggle.classList.toggle("active");
    });
  }

  // Sign up button functionality
  if (elements.signupbtn && elements.logregcontainer) {
    elements.signupbtn.addEventListener("click", () => {
      elements.logregcontainer.classList.add("sign-up-mode");
    });
  }

  // Sign in button functionality
  if (elements.signinbtn && elements.logregcontainer) {
    elements.signinbtn.addEventListener("click", () => {
      elements.logregcontainer.classList.remove("sign-up-mode");
    });
  }

  // Vet sign in functionality
  if (elements.vetSignIn && elements.signinModal) {
    elements.vetSignIn.addEventListener("click", function (event) {
      event.preventDefault();
      elements.signinModal.style.display = "block";
    });
  }

  // Vet sign up functionality
  if (elements.vetSignUp && elements.signinModal) {
    elements.vetSignUp.addEventListener("click", function (event) {
      event.preventDefault();
      elements.signinModal.style.display = "block";
    });
  }

  // LGU sign up functionality
  if (elements.lguSignUp && elements.signinModal) {
    elements.lguSignUp.addEventListener("click", function (event) {
      event.preventDefault();
      elements.signinModal.style.display = "block";
    });
  }

  // LGU sign in functionality
  if (elements.lguSignIn && elements.signinModal) {
    elements.lguSignIn.addEventListener("click", function (event) {
      event.preventDefault();
      elements.signinModal.style.display = "block";
    });
  }

  // Forgot password functionality
  if (elements.forgotPassword && elements.forgotModal) {
    elements.forgotPassword.addEventListener("click", function (event) {
      event.preventDefault();
      elements.forgotModal.style.display = "block";
    });
  }

  // Close buttons functionality
  if (elements.closeBtns && elements.signinModal && elements.forgotModal) {
    for (let closeBtn of elements.closeBtns) {
      closeBtn.addEventListener("click", function () {
        elements.signinModal.style.display = "none";
        elements.forgotModal.style.display = "none";
      });
    }
  }

  // Window click functionality
  if (elements.signinModal && elements.forgotModal) {
    window.addEventListener("click", function (event) {
      if (event.target == elements.signinModal) {
        elements.signinModal.style.display = "none";
      }
      if (event.target == elements.forgotModal) {
        elements.forgotModal.style.display = "none";
      }
    });
  }

  var modal = document.getElementById("notification-modal");

  var bellIcon = document.getElementById("bell-icon");

  var closeBtn = document.getElementsByClassName("close")[0];

  bellIcon.onclick = function () {
    modal.style.display = "block";
  };

  closeBtn.onclick = function () {
    modal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
});

document.getElementById("message-icon").onclick = function () {
  document.getElementById("chat-modal").style.display = "block";
};

document.querySelector(".chat-close").onclick = function () {
  document.getElementById("chat-modal").style.display = "none";
};

document.addEventListener("keydown", function (event) {
  if (event.key === "Escape") {
    document.getElementById("chat-modal").style.display = "none";
  }
});

// Chat user selection
const chatUsers = document.querySelectorAll(".chat-user");
chatUsers.forEach((user) => {
  user.addEventListener("click", function () {
    const username = this.getAttribute("data-username");
    document.getElementById("chat-with").innerText = username;
    // Load chat history with selected user
    loadChatHistory(username);
  });
});

function loadChatHistory(username) {
  const chatMessages = document.querySelector(".chat-messages");
  chatMessages.innerHTML = `<p>Chatting with ${username}...</p>`;
}

/* REGISTERED PETS JS */
function addNewRow() {
  const tbody = document.getElementById("petTableBody");
  const newRow = document.createElement("tr");
  newRow.className = "input-row";

  newRow.innerHTML = createInputRow();
  tbody.insertBefore(newRow, tbody.firstChild);
}

function createInputRow(data = {}) {
  return `
  <td><input type="text" placeholder="Enter name" value="${
    data.name || ""
  }"></td>
  <td><input type="text" placeholder="Enter pet type" value="${
    data.pet || ""
  }"></td>
  <td>
    <select>
      <option ${data.status === "Active" ? "selected" : ""}>Active</option>
      <option ${data.status === "Inactive" ? "selected" : ""}>Inactive</option>
      <option ${data.status === "Pending" ? "selected" : ""}>Pending</option>
    </select>
  </td>
  <td class="checkbox-wrapper">
    <input type="checkbox" ${data.vaccinated ? "checked" : ""}>
  </td>
  <td><input type="text" placeholder="Enter warranty" value="${
    data.warranty || ""
  }"></td>
  <td class="action-buttons">
    <button class="save-btn" onclick="saveRow(this)">SAVE</button>
    <button class="cancel-btn" onclick="cancelEdit(this)">CANCEL</button>
  </td>
`;
}

function createDisplayRow(data) {
  return `
  <td>${data.name}</td>
  <td>${data.pet}</td>
  <td><span class="status-badge status-${data.status.toLowerCase()}">${
    data.status
  }</span></td>
  <td class="checkbox-wrapper">
    <div class="vaccinated-dot ${
      data.vaccinated ? "vaccinated-yes" : "vaccinated-no"
    }"></div>
  </td>
  <td>${data.warranty}</td>
  <td class="action-buttons">
    <button class="edit-btn" onclick="editRow(this)">EDIT</button>
    <button class="delete-btn" onclick="deleteRow(this)">DELETE</button>
  </td>
`;
}

function saveRow(button) {
  const row = button.parentElement.parentElement;
  const inputs = row.getElementsByTagName("input");
  const select = row.getElementsByTagName("select")[0];

  const data = {
    name: inputs[0].value,
    pet: inputs[1].value,
    status: select.value,
    vaccinated: inputs[2].checked,
    warranty: inputs[3].value,
  };

  if (!data.name || !data.pet) {
    alert("Please fill in name and pet type");
    return;
  }

  row.innerHTML = createDisplayRow(data);
  row.className = "";
}

function editRow(button) {
  const row = button.parentElement.parentElement;
  const cells = row.getElementsByTagName("td");

  const data = {
    name: cells[0].textContent,
    pet: cells[1].textContent,
    status: cells[2].querySelector(".status-badge").textContent,
    vaccinated: cells[3]
      .querySelector(".vaccinated-dot")
      .classList.contains("vaccinated-yes"),
    warranty: cells[4].textContent,
  };

  row.className = "input-row";
  row.innerHTML = createInputRow(data);
}

function cancelEdit(button) {
  const row = button.parentElement.parentElement;
  if (row.getAttribute("data-is-new")) {
    deleteRow(button);
  } else {
    const cells = row.getElementsByTagName("td");
    const inputs = row.getElementsByTagName("input");
    const select = row.getElementsByTagName("select")[0];

    const data = {
      name: inputs[0].defaultValue,
      pet: inputs[1].defaultValue,
      status: select.options[select.selectedIndex].defaultSelected
        ? select.value
        : select.options[0].value,
      vaccinated: inputs[2].defaultChecked,
      warranty: inputs[3].defaultValue,
    };

    row.innerHTML = createDisplayRow(data);
    row.className = "";
  }
}

function deleteRow(button) {
  if (confirm("Are you sure you want to delete this entry?")) {
    const row = button.parentElement.parentElement;
    row.remove();
  }
}

// update info
const update = async (api) => {
  const profileForm = document.getElementById('profileForm')
  const formData = new FormData(profileForm)
  
  const uri = api + '/api/user/update'
  const headers = {
      'Authorization': 'Bearer ' + localStorage.getItem('authToken')
  }

  try {
      const response = await fetch(uri, {
          method: 'POST',
          headers,
          body: formData
      })
      const res = await response.json()

      if (!res.success)
        throw res.message
      
      localStorage.setItem("name", res.data.name)
      localStorage.setItem("email", res.data.email)
      localStorage.setItem("gender", res.data.gender)
      localStorage.setItem("contact", res.data.mobile)
      localStorage.setItem("address", res.data.address)
      localStorage.setItem("birthDate", res.data.birthdate)

      if (res.data.profileImage)
        localStorage.setItem("profilePic", res.data.profileImage)
      
      alert(res.message)

  } catch (e) {
      console.error('Error:', e)
      alert(e)
  }
}
