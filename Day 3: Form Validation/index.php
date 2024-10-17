<?php
// Start session
session_start();

// Initialize variables
$userNameError = $emailError = $contactError = $websiteError = $genderError = $tcError = "";
$formData = array('userName' => '', 'email' => '', 'contact' => '', 'website' => '', 'gender' => '');

// Check if session has errors
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    
    // Retrieve form data if available
    $formData = $_SESSION['formData'] ?? $formData;

    // Clear session errors after displaying
    unset($_SESSION['errors']);
    unset($_SESSION['formData']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Validation</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <p class="msg">A Simple Registration Form ?</p>
    <span class="error">(*) indicates required field</span>

    <form method="post" class="container" action="./controller/formProcessing.php" novalidate>
        <table>
            <tr class="tag">
                <td><label for="userName">Enter your Username</label>
                    <span class="error">*</span>
                </td>
                <td><input type="text" name="userName" class="details" value="<?php echo htmlspecialchars($formData['userName']); ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><span class="error"><?php echo $errors['userNameError'] ?? ''; ?></span></td>
            </tr>

            <tr class="tag">
                <td><label for="email">Enter your Email Id</label>
                    <span class="error">*</span>
                </td>
                <td><input type="email" name="email" class="details" value="<?php echo htmlspecialchars($formData['email']); ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><span class="error"><?php echo $errors['emailError'] ?? ''; ?></span></td>
            </tr>

            <tr class="tag">
                <td><label for="contact">Enter your Phone Number</label>
                    <span class="error">*</span>
                </td>
                <td><input type="text" name="contact" class="details" value="<?php echo htmlspecialchars($formData['contact']); ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><span class="error"><?php echo $errors['contactError'] ?? ''; ?></span></td>
            </tr>

            <tr class="tag">
                <td><label for="website">Enter your Website</label></td>
                <td><input type="text" name="website" class="details" value="<?php echo htmlspecialchars($formData['website']); ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><span class="error"><?php echo $errors['websiteError'] ?? '' ?></span></td>
            </tr>

            <tr class="tag">
                <td><label for="gender">Enter your Gender</label>
                    <span class="error">*</span>
                </td>
                <td>
                    <input type="radio" name="gender" value="male" <?php echo ($formData['gender'] == 'male') ? 'checked' : ''; ?>> Male
                    <input type="radio" name="gender" value="female" <?php echo ($formData['gender'] == 'female') ? 'checked' : ''; ?>> Female
                    <input type="radio" name="gender" value="other" <?php echo ($formData['gender'] == 'other') ? 'checked' : ''; ?>> Other
                </td>
            </tr>
            <tr>
                <td></td>
                <td><span class="error"><?php echo $errors['genderError'] ?? ''; ?></span></td>
            </tr>

            <tr class="tag">
                <td><label for="tc">Agree to our Terms & Conditions</label>
                    <span class="error">*</span>
                </td>
                <td><input type="checkbox" name="tc" <?php echo isset($formData['tc']) ? 'checked' : ''; ?>></td>
            </tr>
            <tr>
                <td></td>
                <td><span class="error"><?php echo $errors['tcError'] ?? ''; ?></span></td>
            </tr>

            <tr class="tag">
                <td><input type="submit" name="submit" value="Submit" class="btn"></td>
                <td></td>
            </tr>
        </table>
    </form>

    <?php

    if ($_GET['success']) {
        echo "<div>
            <h3 style='color: green;'>{$_GET['success']}</h3>
        </div>";
    }

    ?>
</body>

</html>