// const saveChangesButton = document.querySelector(".save-changes");

// saveChangesButton.addEventListener("click", (event) => {
//   event.preventDefault();
//   const editForm = document.querySelector(".form-edit");
//   const formData = new FormData(editForm);

//   fetch("Controllers/edit_controller.php", {
//     method: "POST",
//     body: formData,
//   })
//     .then((response) => {
//       console.log(response);
//       if (!response.ok) {
//         throw new Error("Failed.");
//       }
//       return response.json();
//     })
//     .then((data) => {
//       console.log(data);
//     })
//     .catch((error) => {
//       console.log(error.message);
//     });
// });

// const saveChangesPassword = document.querySelector(".save-password");

// saveChangesPassword.addEventListener("click", (event) => {
//   event.preventDefault();
//   const passwordForm = document.querySelector(".form-password");
//   const formData = new FormData(passwordForm);
//   console.log(formData);
//   fetch("Controllers/edit_controller.php", {
//     method: "POST",
//     body: formData,
//   })
//     .then((response) => {
//       console.log(response);
//       if (!response.ok) {
//         throw new Error("Failed.");
//       }
//       return response.json();
//     })
//     .then((data) => {
//       console.log(data);
//     })
//     .catch((error) => {
//       console.log(error.message);
//     });
// });

/// Edit Profile
$(document).ready(function () {
  $(".save-changes").click(function () {
    $.ajax({
      type: "POST",
      url: "Controllers/edit_controller.php",
      data: {
        type: "update",
        usersId: $("#floatingInputId").val(),
        usersName: $("#floatingName").val(),
        usersEmail: $("#floatingInputEmail").val(),
        phoneNo: $("#phoneNo").val(),
      },
      success: function (data) {
        console.log(data);
        $("#floatingInputId").html(data.usersId);
        $("#floatingName").html(data.usersName);
        $("#floatingInputEmail").html(data.usersEmail);
        $("#phoneNo").html(data.phoneNo);
      },
      error: function (xhr, status, strErr) {
        alert("There was an error!");
      },
    });
  });

  /// Edit Password
  $(".save-password").click(function () {
    $.ajax({
      type: "POST",
      url: "Controllers/edit_controller.php",
      data: {
        type: "change",
        usersEmail: $("#usersEmail").val(),
        usersPwd: $("#floatingPassword").val(),
        usersPwdConfirm: $("#floatingPasswordConfirm").val(),
      },
      success: function (data) {
        console.log(data);
        $("#floatingPassword").html("");
        $("#floatingPasswordConfirm").html("");
      },
      error: function (xhr, status, strErr) {
        alert("There was an error!");
      },
    });
  });
});
