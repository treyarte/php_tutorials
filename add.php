<?php 
    $errors = ['email' => '', 'title' => '', 'ingredients' => ''];

    $email = $title = $ingredients = '';

    if(isset($_POST['submit'])){

        foreach(array_keys($_POST) as $keyName){
            
            if(empty($_POST[$keyName])){
                
                $errors[$keyName] = "$keyName is required </br>";

            } else if ($keyName === 'email') {
                    
                $email = $_POST[$keyName];
                    
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                       $errors['email'] = 'email must be a valid email address </br>';
                }
                } else if ($keyName === 'title'){
                    
                    $title = $_POST[$keyName];
                    
                    if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                        $errors['title'] = 'title must be letter and spaces </br>';
                    }
                } else if ($keyName === 'ingredients'){
                    
                    $ingredients = $_POST[$keyName];
                    
                    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                        $errors['ingredients'] = 'ingredients must be comma separated </br>';
                    }
                }
            }
            
        }
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add a Pizza</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your Email</label>
			<input type="email" name="email" value="<?php echo htmlspecialchars($email)?>" >
            <div class="red-text"><?php echo $errors['email'];?></div>
			<label>Pizza Title</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title)?>" >
            <div class="red-text"><?php echo $errors['title'];?></div>
			<label>Ingredients (comma separated)</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
            <div class="red-text"><?php echo $errors['ingredients'];?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>