<?php 



    // if form is submitted display it
    if (isset($_POST['submitInsert'])) {
        
        
            //assign values from index form to variables
            $firstname= htmlspecialchars($_POST['first_name']);  
            $lastname= htmlspecialchars($_POST['last_name']);
            $birthday= htmlspecialchars($_POST['birthday']);
            $email= htmlspecialchars($_POST['email_address']);
            $phone= htmlspecialchars($_POST['phone_number']);

            
            // Instantiate a new object $teacher and set its properties  
            require_once('InsertSelectDB.php');
            $teacher = new InsertSelectDB($firstname, $lastname, $birthday, $email, $phone); 

            // Instantiate the method insert() with the object $teacher  

            $teacher->insert(); 

    }
    else{

             // Instantiate a new object $teacher and set its properties  
            require_once('InsertSelectDB.php');
            $teacher = new InsertSelectDB("n/a", "n/a", "n/a", "n/a", "n/a");  

            // Instantiate the method select() with the object $teacher  
            $teacher->select();
    }   

    
    echo"<a href=\"http://localhost/homework9/index.php\">GO BACK TO THE FORM</a>";




?>