<?php
session_start();
?>
<html>
<head> 
    <style>

        .mode{
            margin-top:100px;
            margin-left:200px;
            background-color:aqua;
            border-radius: 10px;
            border: 1px white solid;
            width: 900px;
            height: 900px;
            padding: 20px;
            color: black;
            font-weight: bolder;
        }

        .cdisp{
            border: none;
            margin:200px;
        }
        .bdisp{
            border: none;
            margin:200px;
        }
        img{
            margin-left:30px ;
            margin-top:30px;
        }
        .btn{
            margin-left:300px;
            padding:10px;
            background-color: lightblue;
            font-weight: bolder;
            color:black;
            text-align: center;
            border-radius: 10px;
            border: 1px solid;
        }
        .btn1{
            margin-left:100px;
            padding:10px;
            background-color: lightblue;
            font-weight: bolder;
            color:black;
            
            border-radius: 10px;
            border: 1px solid;
        }
        p{
            margin:50px;
            font-weight: bolder;
            font-size: 20;

        }
        center{
            font-size:20px;
            font-weight:bolder;
            color:aqua;
        }
    </style> 
</head>
<body style="background-color:#0c2326;">
<?php
 //echo"this is php";
   
$servername="localhost";
$username="root";
$password="";
$dbname="login";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn)
{
    die("connection failed: ".mysqli_connect_error());
}

$sql="SELECT recharge_amt from temprecharge";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
    $t=$row["recharge_amt"];
    
}
function convert($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
$upd="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $upd=convert($_POST["updater"]);
    //echo "the chosen value is ".$upd." ";
    if($upd=="1month")
    {   
        $t1=$t;
        //$sq="UPDATE temprecharge SET recharge_amt='$t1' where recharge_amt='$t'";
        //if(!mysqli_query($conn,$sq))
        //echo "Error updating record: " . mysqli_error($conn);
        $_SESSION["rec"]=$t1;
        //echo "<br>"."<br>"."<br>"."<br>"."<br>"."<center>"."the Recharge amount is now ".$t1."rs "."</center>"; 
        echo "<br>"."<br>"."<br>"."<br>"."<br>"."<center>"."the Recharge amount is now ".$_SESSION["rec"]."rs "."</center>";
    }
    else if($upd=="3months")
    {
        $t1=$t*3;
        $_SESSION["rec"]=$t1;
        //$sq="UPDATE temprecharge SET recharge_amt='$t1' where recharge_amt='$t'";
        //if(!mysqli_query($conn,$sq))
        //echo "Error updating record: " . mysqli_error($conn);
        //echo "the Recharge amount is now ".$t1."rs "; 
        echo "<br>"."<br>"."<br>"."<br>"."<br>"."<center>"."the Recharge amount is now ".$_SESSION["rec"]."rs "."</center>";
    }
    else if($upd=="6months")
    {
        $t1=$t*6;
        $_SESSION['rec']=$t1;
        //$sq="UPDATE temprecharge SET recharge_amt='$t1' where recharge_amt='$t'";
        //if(!mysqli_query($conn,$sq))
        //echo "Error updating record: " . mysqli_error($conn);
        //echo "the Recharge amount is now ".$t1."rs "; 
        echo "<br>"."<br>"."<br>"."<br>"."<br>"."<center>"."the Recharge amount is now ".$_SESSION["rec"]."rs "."</center>";
    }
    else if($upd=="1year")
    {
        $t1=$t*12;
        $_SESSION['rec']=$t1;
        //$sq="UPDATE temprecharge SET recharge_amt='$t1' where recharge_amt='$t'";
        //if(!mysqli_query($conn,$sq))
        //echo "Error updating record: " . mysqli_error($conn);
        echo "<br>"."<br>"."<br>"."<br>"."<br>"."<center>"."the Recharge amount is now ".$_SESSION["rec"]."rs "."</center>";
    }
}

mysqli_close($conn);
?>
    
        <div class="mode" id="mode1">
        <p id="recharge" class="disprecharge" ></p><br>
        Pay for <br><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="radio" onchange="dorecharge()" name="updater" value="1month" required> Only this Month<br><br>
        <input type="radio" onchange="dorecharge()" name="updater" value="3months"> Three months<br><br>
        <input type="radio" onchange="dorecharge()" name="updater" value="6months"> Six months<br><br>
        <input type="radio" onchange="dorecharge()" name="updater" value="1year"> 12 months<br><br>
        <button class="btn1" name="confirm">Confirm Payment</button>
        </form>
        <label style="font-size: large;"> Select payment type </label><br><br>
        <input type="radio" name="pay" value = "card">Credit Card / Debit Card &nbsp;&nbsp;
        <img src="visacard.jpg" width=100" height="50"><br><br>
        <input type="radio" name="pay" value= "bank">Net Banking &nbsp;&nbsp;
        <img style="margin-left:120px;" src="bank.jpg" height="50" width="100"><br><br>
        <br>
        <br>
        <input type="button" class="btn" name="save" style="margin-left:100px;" onclick="setpayment()" value ="next">
        
   
</div>
<script>
/*
var r=200;
    function dorecharge()
    {
        var z=document.getElementsByName('updater');
        var r1=0;
       for(var i=0; i<z.length;i++)
       {
           if(z[i].checked==true)
           {
                
               if(z[i].value=="1month")
               {
                    
                    document.getElementById("recharge").innerHTML="Your Recharge Amount is "+r;
               }
               else if(z[i].value=="3months")
               {
                 r1=r*3;
                 document.getElementById("recharge").innerHTML="Your Recharge Amount is  "+r1;
               }
               else if(z[i].value=="6months")
               {
                   r1=r*6;
                   document.getElementById("recharge").innerHTML="Your Recharge Amount is  "+r1;
               }
               else if(z[i].value=="1year")
               {
                   r1=r*12;
                   document.getElementById("recharge").innerHTML="Your Recharge Amount is"+r1;
               }
           }
       }
        
    }*/
   function setpayment()
   {
       var k=document.getElementsByName('pay');
       for(var i=0; i<k.length;i++)
       {
           if(k[i].checked==true)
           {
                document.getElementById("mode1").style.display="none";
               if(k[i].value=="card")
               { /*
                   var del2=document.getElementsByClassName("bdisp");
                while(del2.length)
                del2[0].parentNode.removeChild(del2[0]);
                var x= document.createElement("IFRAME");
                x.setAttribute("src","card.php");
                x.setAttribute("class","cdisp")
                x.setAttribute("width","1100");
                x.setAttribute("height","600");
                document.body.appendChild(x);
                */
                location.replace("card.php");
               }
               else if(k[i].value=="bank")
               {
                   location.replace("banklogin.php");
                   /*
                var del1=document.getElementsByClassName("cdisp");
                while(del1.length)
                del1[0].parentNode.removeChild(del1[0]);   
                var x= document.createElement("IFRAME");
                x.setAttribute("src","banklogin.php");
                x.setAttribute("class","bdisp")
                x.setAttribute("width","1100");
                x.setAttribute("height","600");
                document.body.appendChild(x);
                */
               }
           }
       }
   }
    
</script>
</body>    
</html>