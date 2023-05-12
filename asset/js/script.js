/// Edit Profile Info
$(document).ready(function () {
  // Upload Image
  // $("#uploadForm").submit(function (e) {
  //   e.preventDefault();
  //   var fileData = $("#uploadImage").prop("files")[0];
  //   var formData = new FormData();
  //   formData.append("image", fileData);
  //   $.ajax({
  //     url: "Controllers/edit_controller.php",
  //     type: "POST",
  //     data: JSON.stringify({ image: formData }),
  //     contentType: "application/json",
  //     success: function (data) {
  //       alert(data);
  //     },
  //   });
  // });

  // Edit Profile
  // $(".save-changes").click(function () {
  //   $.ajax({
  //     type: "POST",
  //     url: "Controllers/edit_controller.php",
  //     data: {
  //       type: "update",
  //       usersId: $("#floatingInputId").val(),
  //       usersName: $("#floatingName").val(),
  //       usersEmail: $("#floatingInputEmail").val(),
  //       phoneNo: $("#phoneNo").val(),
  //     },
  //     success: function (data) {
  //       console.log(data);
  //       $("#floatingInputId").html(data.usersId);
  //       $("#floatingName").html(data.usersName);
  //       $("#floatingInputEmail").html(data.usersEmail);
  //       $("#phoneNo").html(data.phoneNo);
  //     },
  //     error: function (xhr, status, strErr) {
  //       alert("There was an error!");
  //     },
  //   });
  // });
  $(".save-changes").click(function (e) {
    e.preventDefault();
    var formData = new FormData($("#uploadForm")[0]);
    formData.append("type", "update");

    $.ajax({
      type: "POST",
      url: "Controllers/edit_controller.php",
      data: formData,
      contentType: false,
      processData: false,
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
