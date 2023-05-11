<?php

$image_url = isset($_SESSION['fileUrl']) ? $_SESSION['fileUrl'] : '';
$img_tag = '<img id="uploadPreview" style="width: 260px; height: 260px;" src="' . $image_url . '" />';
?>
<h1>Account Settings</h1>
<div>
    <div class="edit-container d-flex justify-content-between">
        <form class="form-edit" method="post" action="Controllers/edit_controller.php" enctype="multipart/form-data">
            <div class="image-box d-flex flex-column p-2 ">
                <?php echo $img_tag; ?>
                <input class="mt-2" id="uploadImage" type="file" name="image" onchange="PreviewImage();" value="<?php echo isset($_SESSION['fileUrl']) ? $_SESSION['fileUrl'] : ''; ?>" />
                <script type="text/javascript">
                    function PreviewImage() {
                        var oFReader = new FileReader();
                        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
                        oFReader.onload = function(oFREvent) {
                            document.getElementById("uploadPreview").src = oFREvent.target.result;
                        };
                    };
                </script>
            </div>

            <div class="form-edit">
                <h2 class="h4 mb-3 fw-normal">Basic Information</h2>
                <input type="hidden" name="type" value="update">
                <div class="form-floating ">
                    <input type="text" class=" form-control edit-name-field" name='usersName' id="floatingName" value=" <?php echo isset($_SESSION['usersName']) ? $_SESSION['usersName'] : ''; ?>">
                    <label for=" floatingName">Full Name</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control edit-name-field" name='phoneNo' id="phoneNo" value=" <?php echo isset($_SESSION['phoneNo']) ? $_SESSION['phoneNo'] : ''; ?>">
                    <label for="phoneNo">Phone No.</label>
                </div>
                <div class="form-floating">
                    <input type="email" class="form-control edit-email-field" name='usersEmail' id="floatingInput" value=" <?php echo isset($_SESSION['usersEmail']) ? $_SESSION['usersEmail'] : ''; ?>">
                    <input type="hidden" class="form-control edit-email-field" name='usersId' id="floatingInput" value=" <?php echo isset($_SESSION['usersId']) ? $_SESSION['usersId'] : ''; ?>">
                    <label for=" floatingInput">Email address</label>
                </div>
                <button class="w-20 btn btn-sm btn-primary save-changes" type="submit" name="save-changes">Save Changes</button>
            </div>
        </form>
    </div>

    <div class="d-flex pass-container justify-content-end w-100">
        <form class="form-edit form-password ml-auto" method="post" action="Controllers/edit_controller.php">
            <h2 class="h4 mb-3 fw-normal">Security</h2>
            <input type="hidden" name="type" value="change">
            <input type="hidden" name='usersEmail' id="floatingInput" value=" <?php echo isset($_SESSION['usersEmail']) ? $_SESSION['usersEmail'] : ''; ?>">
            <div class="form-floating">
                <input type="password" class="form-control signup-pass-field" name='usersPwd' id="floatingPassword">
                <label for="floatingPassword">Current Password</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control signup-pass-field" name='usersPwdConfirm' id="floatingPasswordConfirm">
                <label for="floatingPasswordConfirm">New Password</label>
            </div>
            <button class="w-20 btn btn-sm btn-primary" type="submit" name="save-password">Save Password</button>
        </form>
    </div>
</div>