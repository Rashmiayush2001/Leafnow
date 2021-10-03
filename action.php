<?
$email=$_POST['email'];
$pws=$_POST['pws'];
$name=$_POST['name'];


if(!empty($email) || !empty($psw) || !empty($pswrepeat)){
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="login";

    //create connection
    $conn=new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else{
        $SELECT = "SELECT email from register Where email=? Limit 1";
        $INSERT = "INSERT Into login (email,pws,name) values(?,?,?) ";

        //prepare statement
        $stmt=$conn->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;

        if($num==0){
            $stmt->close();

            $stmt=$conn->prepare($INSERT);
            $stmt->bind_params($email, $pws, $name);
            $stmt->execute();
            echo "record inserted successfully"
        }
        else{
            echo "Someone already regitered using this email";
        }
        $stmt->close();
        $conn->close();
    }
} else{
    echo "All fields are required";
    die();
}
