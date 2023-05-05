const saveChangesButton = document.querySelector(".save-changes");

saveChangesButton.addEventListener("click", (event) => {
  event.preventDefault();
  const editForm = document.querySelector(".form-edit");
  const formData = new FormData(editForm);

  fetch("./controllers/edit_controller.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      console.log(response);
      if (!response.ok) {
        throw new Error("Failed.");
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
    })
    .catch((error) => {
      console.log(error.message);
    });
});

const saveChangesPassword = document.querySelector(".save-password");

saveChangesPassword.addEventListener("click", (event) => {
  event.preventDefault();
  const passwordForm = document.querySelector(".form-password");
  const formData = new FormData(passwordForm);
  console.log(formData);
  fetch("./controllers/edit_controller.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      console.log(response);
      if (!response.ok) {
        throw new Error("Failed.");
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
    })
    .catch((error) => {
      console.log(error.message);
    });
});
