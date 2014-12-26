<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</head>
<body>

<?php
    if(isset($_POST['submit'])){
        
        $data_missing = array();

        if(empty($_POST['name'])){

            $data_missing[] = 'Name';

        } else {
            $name = trim($_POST['name']);
        }

        if(empty($_POST['email'])){
            $data_missing[] = 'Email';
        } else {
            $email = trim($_POST['email']);
        }

        if(empty($_POST['phone'])){
            $data_missing[] = 'Phone';
        } else {
            $phone = trim($_POST['phone']);
        }

        if(empty($_POST['birth_date'])){
            $data_missing[] = 'Birth Date';
        } else {
            $b_date = trim($_POST['birth_date']);
        }

        if(empty($data_missing)){

            require_once('./mysqli_connector.php');

            $query = "INSERT INTO students (name, email, phone, birth_date) VALUES(?,?,?,?)";

            $stmt = mysqli_prepare($dbc, $query);


            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $b_date);

            mysqli_stmt_execute($stmt);

            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if($affected_rows == 1){

                echo 'Student Entered';

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);

            } else {

                echo 'Error Occurred <br/>';
                echo mysqli_error();

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);
            }

        } else {

            echo 'You need to enter the following data <br/>';

            foreach($data_missing as $missing){

                echo "$missing <br/>";
            }
        }
    } 

?>

<form action = "http://subsides.hostei.com/studentadded.php" method = "post">
        <b>Add a New Student</b>
        <p>Name:
            <input type="text" name="name" size="30" value="" />
        </p>
        <p>Email:
            <input type="text" name="email" size="30" value="" />
        </p>
        <p>Phone:
            <input type="text" name="phone" size="30" value="" />
        </p>
        <p>Birth Date:
            <input type="text" name="birth_date" size="30" value="" />
        </p>

        <p>
            <input type ="submit" name = "submit" value="전송" />
        </p>

    </form>

<hr><a href="http://subsides.hostei.com/index.php">메인화면</a>
<a href="http://subsides.hostei.com/getStudentInfo.php">데이터조회</a>

</body>
</html>