<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title>Register Page</title>
    </head>
    <body>
        <!-- update employee -->
        <div class="container col-sm-4">
            <form id="updateEmployee" action="updateEmployees" method="post">
                <h4>Update Employee Details</h4>
                @if(Session::has('success'))
                    <div class="alert alert-sucess"><strong>{{Session::get('success')}}</strong></div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-sucess"><strong>{{Session::get('fail')}}</strong></div>
                @endif
                @csrf
                <fieldset>
                    Enter Employee id:<br>
                    <input type="text" class="form-control" name="employeeid" required  placeholder="enter employee id"><br>
                    First Name:<br>
                    <input  class="form-control form-control-md" type="text" name="fname" placeholder="Enter First Name"><br>                   
                    Last Name:<br>
                    <input class="form-control form-control-md" type="text" name="lname" placeholder="Enter Last Name"><br>                   
                    Mobile Number:<br>
                    <input class="form-control form-control-md" type="tel" name="mobile" placeholder="Enter Mobile Number"><br>                
                    Date Of Birth:<br>
                    <input class="form-control form-control-md" type="date" name="dateOfBirth"><br>                
                    Gender:<br>
                    <input type="radio" name="gender" value="Male">
                      <label for="male">Male</label><br>
                    <input type="radio" name="gender"value="Female">
                      <label for="female">Female</label><br>
                    <input type="radio" name="gender" value="Others">
                      <label for="others">Others</label><br>                  
                    Address:<br>
                    <textarea class="form-control form-control-md" name="address" placeholder="Enter Your address"></textarea><br>                  
                    Cities:<br>
                    <select class="form-control form-control-md" name="cities" id="cities">
                    <option  value="Hyderabad">Hyderabad</option>
                    <option  value="Bnaglore">Banglore</option>
                    <option  value="Chennai">Chennai</option>
                    <option  value="Mumbai">Mumbai</option>
                    <option  value="Noida">Noida</option>
                    </select><br>
                    Type of user:<br>
                    <select class="form-control form-control-md" name="typeOfUser" id="user">
                    <option  value="normal user">normal user</option>
                    <option  value="manager">manager</option>
                    <option  value="admin">admin</option>
                    </select><br>                    
                    Password:<br>
                    <input class="form-control col-sm-6" type="password" name="password" placeholder="Enter your password"><br>
                    <button class="btn btn-primary" type="submit">Update</button>
                </fieldset>
            </form>
        </div>
    </body>
    <style>
        body,html {
            margin: 0px;
            padding: 0px;
        }
        body
        {
            background-image: url("https://image.shutterstock.com/image-photo/sunshine-clouds-sky-during-morning-260nw-404950345.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        div {
            /* background-color: lightsteelblue; */
            background: transparent;
            padding: 20px;
        }
        h3
        {
            margin-right: 80px;
            padding: 35px;
            text-align: center;
        }
        a
        {
            color: black;
        }
        @media(min-width:320px) and (max-width:479)
        {
            .container
            {
                background-color: aqua;
            }
        }
        @media(min-width:768px) and (max-width:991px)
        {
            .container
            {
                background-color: brown;
            }
        }
        @media(min-width:992px) and (max-width:1024px)
        {
            .container
            {
                background-color: rgb(42, 99, 165);
            }
        }
    </style>
</html>