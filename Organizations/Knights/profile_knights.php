<?php
include '../../dbcon.php';
session_start();
$user_id = $_SESSION['user_id'];

try {
    if (isset($_POST['update_profile'])) {

        $update_name = $_POST['update_name'];
        $update_email = $_POST['update_email'];

        // Update name and email
        $updateQuery = "UPDATE users SET name = :name, email = :email WHERE id = :user_id";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([
            ':name' => $update_name,
            ':email' => $update_email,
            ':user_id' => $user_id
        ]);

        // Handle password update
        $old_pass = $_POST['old_pass'];
        $update_pass = md5($_POST['update_pass']);
        $new_pass = md5($_POST['new_pass']);
        $confirm_pass = md5($_POST['confirm_pass']);

        if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
            // Fetch the current password for comparison
            $stmt = $pdo->prepare("SELECT password FROM users WHERE id = :user_id");
            $stmt->execute([':user_id' => $user_id]);
            $current_pass = $stmt->fetchColumn();

            if ($update_pass != $current_pass) {
                $message[] = 'Old password not matched!';
            } elseif ($new_pass != $confirm_pass) {
                $message[] = 'Confirm password not matched!';
            } else {
                // Update the password
                $stmt = $pdo->prepare("UPDATE users SET password = :confirm_pass WHERE id = :user_id");
                $stmt->execute([
                    ':confirm_pass' => $confirm_pass,
                    ':user_id' => $user_id
                ]);
                $message[] = 'Password updated successfully!';
            }
        }

        // Handle image upload
        $update_image = $_FILES['update_image']['name'];
        $update_image_size = $_FILES['update_image']['size'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_folder = '../../uploaded_img/' . $update_image;

        if (!empty($update_image)) {
            if ($update_image_size > 9000000) {
                $message[] = 'Image is too large';
            } else {
                // Update image path in database
                $stmt = $pdo->prepare("UPDATE users SET image = :image WHERE id = :user_id");
                $stmt->execute([
                    ':image' => $update_image,
                    ':user_id' => $user_id
                ]);
                // Move uploaded file to destination folder
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
                $message[] = 'Image updated successfully!';
            }
        }
    }
} catch (PDOException $e) {
    // Handle any potential errors
    $message[] = "Error: " . $e->getMessage();
}

// Close the PDO connection
$pdo = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User's Profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../cssp/style.css">

</head>
<body>
   
<div class="update-profile">

   <?php
      try {
         $pdo = new PDO($dsn, $username, $password);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         // Prepare the SQL query
         $selectQuery = "SELECT * FROM users WHERE id = :user_id";
         $stmt = $pdo->prepare($selectQuery);

         // Bind the parameter
         $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

         // Execute the query
         $stmt->execute();

         // Fetch the result
         if ($stmt->rowCount() > 0) {
            $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
         }
      } catch (PDOException $e) {
         // Handle any potential errors
         echo "Error: " . $e->getMessage();
      }

      // Close the PDO connection
      $pdo = null;
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="../../images/default-avatar.png">';
         }else{
            echo '<img src="../../uploaded_img/'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <h3><u><?php echo $_SESSION['user_type'];?> Member</u></h3>
      <div class="flex">
         <div class="inputBox">
            <span>username :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
            <span>your email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>update your pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box"required>
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn">
      <a href="dashboard_knights.php" class="delete-btn">go back</a>
   </form>

</div>

</body>
</html>