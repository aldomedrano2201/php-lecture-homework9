<?php
if (isset($_POST['submitSelect'])) {

    require_once('action.php');
    
    
   

}elseif (isset($_POST['submitInsert'])){

    echo '<h1> Register a new customer </h1>';
        
    echo '<form method="post" action="action.php">';
                
    echo '<p>First Name: </p>';
    echo '<input type="text" name="first_name" size="" />
        <br />';

    echo '<p>Last Name: </p>
        <input type="text" name="last_name" size="" />
        <br />';

    echo '<p>Birthday: </p>
        <input type="date" name="birthday" size="" />
        <br />

        <p>Email: </p>
        <input type="email" name="email_address" size="" />
        <br />

        <p>Phone: </p>
        <input type="phone" name="phone_number" size="" />
        <br /><br /><br />

        <input type="submit" name="submitInsert" value="Send" />

    </form>';  

}else{

    
    
            echo '<h1> What do you want to do? </h1>';
            
            echo '<form method="post" action="index.php">';
                        
            echo '<input type="submit" name="submitInsert" value="SAVE DATA TO DB" />';
            echo '<input type="submit" name="submitSelect" value="DISPLAY DATA FROM DB" />';
    
            echo '</form>'  ;



}



?>


