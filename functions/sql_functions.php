<?php

/*
  create database organizer;
  use organizer;
                                      
   create table utilizator(id int auto_increment primary key, 
                           nume varchar(40) not null, 
                           prenume varchar(40) not null, 
                           email varchar(100) not null, 
                           parola text not null, 
                           poza_profil text default NULL
                           );
   
   create table Task(id int auto_increment primary key, 
                     titlu varchar(30) not null, 
                     data date not null, 
                     tip varchar(30) not null, 
                     descriere text not null, 
                     status boolean not null, 
                     id_utilizator int not null, 
                     foreign key (id_utilizator) references utilizator (id)
                     );
 */

function connectDB($host = 'localhost',
                   $user = 'root',
                   $pass = '',
                   $db = 'organizer')
{
    $conn = new mysqli($host, $user, $pass, $db);
    if($conn -> connect_error) die($conn -> connect_error);
    
    return $conn;
}

function clearData($input, $link)
{
    $input = trim($input);// functie ce elimina spatiile libere din <- si din -> unui string
    $input = htmlspecialchars($input); //nu permite adaugare taguri html in variabila
    $input = stripslashes($input);//nu permite adaugarea de url -> scoate / si \
    $input= $link->real_escape_string($input);// nu permite sql injection
    
    return $input;
}

function getUserByEmail($email)
{
    $link = connectDB();
    $email = clearData($email, $link);
    $query = "SELECT * FROM utilizator WHERE email = '$email'";
    
    $resultSet = $link -> query($query);
    if(!$resultSet) {
        print 'Query error';
        return $link -> error;
    }
    
    $resultArray = $resultSet -> fetch_array(MYSQLI_ASSOC);
    
    return $resultArray;
}

function registerUser($firstName, $lastName, $email, $password)
{
    $link = connectDB();
    $firstName = clearData($firstName, $link);
    $lastName = clearData($lastName, $link);
    $email = clearData($email, $link);
    $password = clearData($password, $link);
    
    $password = hash('ripemd160', $password);
    $user = getUserByEmail($email);
    if($user){
        return false;
    }
    $query = "INSERT INTO utilizator(nume, prenume, email, parola) VALUES('$lastName', '$firstName', '$email', '$password')";
    $result = $link -> query($query);
    if(!$result) {
        print 'Query error';
        return $link -> error;
    }
    
    return $result;
}

function connectUser($email, $password)
{
    $link = connectDB();
    $email = clearData($email, $link);
    $password = clearData($password, $link);
    $user = getUserByEmail($email);
    if($user){
        return hash('ripemd160', $password) == $user['parola'];
    }else return false;
}

function getTasks($id_user)
{
    $link = connectDB();
    $query = "SELECT id,titlu,data,tip,descriere,status from Task WHERE id_utilizator = '$id_user'";
    $resultSet = $link ->query($query);
    $resultArray = $resultSet -> fetch_all(MYSQLI_ASSOC);
    
    return $resultArray;
}

function addTask($title, $date, $type, $description, $status, $id_user)
{
    $link = connectDB();
    $title = clearData($title, $link);
    $date = clearData($date, $link);
    $type = clearData($type, $link);
    $description = clearData($description, $link);
    $status = clearData($status, $link);
    $id_user = clearData($id_user, $link);
    
    $query = "INSERT INTO task VALUES (NULL, '$title', '$date', '$type', '$description', '$status', '$id_user')";
    $result = $link ->query($query);
    
    if(!$result) return ($link->error);
    
    return $result;
}

function addPhoto($nameImage, $id_user){
    $link = connectDB();
    $nameImage = clearData($nameImage, $link);
    $id_user = clearData($id_user, $link);
    $query = "UPDATE utilizator SET poza_profil = '$nameImage' WHERE id = '$id_user'";
    $result = $link ->query($query);
    
    if(!$result) return ($link->error);
    
    return $result;
}

function endTask($idTask){
    $link = connectDB();
    $query = "UPDATE task SET status = 1 WHERE id = '$idTask'";
    $result = $link ->query($query);
    
    if(!$result) return ($link->error);
    
    return $result;
}
