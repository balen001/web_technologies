<?php
session_start();

    if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    


    //database connection

    $connection = new mysqli('localhost', 'root', '', 'webtechnologies');
    
    if($connection->connect_error){
        die('Connection failed: '.$connection->connect_error);
    }
    else{


        


        //admin login statement
        $login = "SELECT * FROM admin where Username = '$username' AND Password = '$password'";
        $result = mysqli_query($connection, $login);


        //echo var_dump($result);

        if (mysqli_num_rows($result)) {


            echo "<p>Logged in suuccessfully</p>";

            $row = mysqli_fetch_assoc($result);

            
            $_SESSION["name"] = $row['Name'];
            $_SESSION["username"] = $row['Username'];
            $_SESSION["password"] = $row['Password'];


            //echo $_SESSION["name"];

            
            
            
            header("Location: ../admin/index.php");


          } else {
            echo "<p>Wrong Username/Password",mysqli_error($connection),"</p>";
            header( "refresh:2;url=./index.html" );
          }
          


          

        
        

       
    }


    mysqli_close($connection);
    

}

else{
    header( "url=./index.html" );
}

?>