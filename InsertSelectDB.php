<?php //index.php
    class InsertSelectDB{

    //Connection variable  
        
        private $connection;

        //connection to MySQL works continue the program Attempt to connect to the Database
        public function connectToDBMS(){
            require_once ('mylogin.php');
            $this->connection = new mysqli($hn, $un, $pw, $db);
            return $this->connection;
        }


    //Attributes
    
    private $first_name;  

    private $last_name;  
    
    private $birthday_year;  
    
    private $email_address;  
    
    private $phone_number;

    //getters and setters

    public function getFirstName() 
    { 

    return $this->first_name; 

    } 

  

    public function getLastName() 

    { 

    return $this->last_name; 

    } 

  

    public function getBirthdayYear() 

    { 

    return $this->birthday_year; 

    } 

    public function getPhoneNumber() 

    { 

    return $this->phone_number; 

    } 

    public function getEmailAddress() 

    { 

    return $this->email_address ; 

    } 

    //Constructor and destructor
    function __construct($fname,$lname,$birthday_year,$email,$p_number){

        $this->first_name = $fname; 

        $this->last_name = $lname; 

        $this->birthday_year = $birthday_year; 

        $this->email_address = $email; 

        $this->phone_number = $p_number; 
    }

    

    function __destruct(){ 

        $this->connection->close();

    }     
        


        
        private function sqlQueries(){
            $select = "SELECT * FROM custprofile";
            return array($select);
        }


        
        private function connectToDB(){

            $check_connect_to_db = mysqli_select_db($this->connection, 'customers');
            return $check_connect_to_db;
        }

        private function createDB(){

            $sql_create_db = "CREATE DATABASE customers";    
            $create_db = $this->connection->query($sql_create_db);
            return $create_db;
        }
        
        private function connectToTable(){
            $sql_desc_table = "DESC custprofile";
            $check_table_exists = $this->connection->query($sql_desc_table);
            return $check_table_exists;
        }

        private function createTableNColumns(){

            $sql_create_table = "CREATE TABLE custprofile( 

                id INT(5) PRIMARY KEY AUTO_INCREMENT, 
                
                fname VARCHAR(55) NOT NULL, 
                
                lname VARCHAR(55) NOT NULL, 
                
                bday VARCHAR(55) NOT NULL, 
                
                email VARCHAR(30) NOT NULL, 
                
                pnumber VARCHAR(15) NOT NULL); ";
                $create_table = $this->connection->query($sql_create_table);
                return $create_table;        
                
            

        }

        private function addToTables(){
            $sql_insert_query="INSERT INTO custprofile (fname, lname, bday, email, pnumber) 
                            VALUES ('$this->first_name', '$this->last_name',  
                            '$this->birthday_year', '$this->email_address', '$this->phone_number') ";
            $insert_query = $this->connection->query($sql_insert_query);
            return $insert_query;
        }



        private function receivedFromTables(String $flag){
            if ($flag==="1"){
                $sql_select_query = "SELECT * FROM custprofile";  
                echo 'Find below the data retreived from the database<br>';
            }else{
                $sql_select_query = "SELECT * FROM custprofile ORDER BY ID DESC LIMIT 1";  
                echo 'Your data have been saved to the DB<br>';
                echo 'Find the data below<br>';
            }
              
            $select_query = $this->connection->query($sql_select_query);
            
            if ($select_query === FALSE) 
                die("Fatal Error - Query cannot be performed in the table" . $connection->error);

            else{
                //If the query works gets the number of rows in the result
                $number_of_rows = $select_query->num_rows;
                    
                //Use a loop to display each row
                for ($j = 0 ; $j < $number_of_rows ; ++$j){

                    $each_row = $select_query->fetch_array(MYSQLI_ASSOC);
                
                    echo '        ID : ' . htmlspecialchars($each_row['id']) . '<br>';
                    echo 'First Name : ' . htmlspecialchars($each_row['fname']) . '<br>';
                    echo ' Last Name : ' . htmlspecialchars($each_row['lname']) . '<br>';
                    echo ' Nick Name : ' . htmlspecialchars($each_row['bday']) . '<br>';
                    echo '     Email : ' . htmlspecialchars($each_row['email']) . '<br>';
                    echo '     Phone : ' . htmlspecialchars($each_row['pnumber']) . '<br><br>';
                }    
                        
            }               
                        
            $select_query->close();
            
            
        }

        

        public function select(){ 
            
            $this->connectToDBMS(); 
            
            
            
                $this->connectToDB(); 
            
                
            
                    $this->receivedFromTables("1"); 
                
        }  


        public function insert(){
            
                //If connection to the MySQL fails display an error message
                if ($this->connectToDBMS() === FALSE) 
                    die("Fatal Error - Not possible to connect to MySQL <br>" . mysqli_connect_error());
                else{
                    if($this->connectToDB() === FALSE){
                            //If connection to the Database fails create the database
                        if ($this->createDB() === FALSE){
                        
                            //If the Database creation fails display an error message  
                            if ($this->create_db() === FALSE)
                                die("Fatal Error - DB cannot be created" . $connection->error);    
                                //If the Database creation works connect to it
                            else{ 
                                
                                //If connection to the database created fails display an error message
                                if ($this->connectToDB() === FALSE)
                                    die("Fatal Error - Attempt to create DB but not possible to connect to it" . $connection->error);
                            }
                        }else{
                            if($this->connectToTable()===FALSE){
                                if($this->createTableNColumns()===FALSE){
                                    //If table creation fails display an error message
                                    die("Fatal Error - Table customers cannot be created" . $connection->error); 
                                }else{
                                    if($this->addToTables()===FALSE){
                                        die("Fatal Error - Data cannot be inserted in the table<br>" . $connection->error);
                                    }else{
                                        $this->receivedFromTables("0");
                                    }
                                }
                            }else{
                                if($this->addToTables()===FALSE){
                                    die("Fatal Error - Data cannot be inserted in the table<br>" . $connection->error);
                                }else{
                                    $this->receivedFromTables("0");
                                }
                            }
                        }
                    }else{
                        if($this->connectToTable()===FALSE){
                            if($this->createTableNColumns()===FALSE){
                                //If table creation fails display an error message
                                die("Fatal Error - Table customers cannot be created" . $connection->error); 
                            }else{
                                if($this->addToTables()===FALSE){
                                    die("Fatal Error - Data cannot be inserted in the table<br>" . $connection->error);
                                }else{
                                    $this->receivedFromTables("0");
                                }
                            }
                        }else{
                            if($this->addToTables()===FALSE){
                                die("Fatal Error - Data cannot be inserted in the table<br>" . $connection->error);
                            }else{
                                $this->receivedFromTables("0");
                            }
                        }
                    }
                }

            

        }


    }

    
?>
