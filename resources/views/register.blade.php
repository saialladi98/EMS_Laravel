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
        <style>
            body,html{
                margin: 0px;
                padding: 0px;
            }
            @media(min-width:320px) and (max-width:479)
            {
                .container{
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
    </head>
    <body>
        <h3>Normal User Registration Form</h3>
        <div class="container col-sm-6">
            <form action="registerMethod" method="post">
                @if(Session::has('success'))
                    <div class="alert-success">{{Session::get('success')}}</div>        
                @endif
                @if(Session::has('fail'))
                    <div class="alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf
                <fieldset>
                    First Name:<br>
                    <input class="form-control col-sm-6" type="text" required pattern="[a-zA-Z]{2,}"  name="fname" placeholder="First Name"><br>
                    Last Name:<br>
                    <input class="form-control col-sm-6" type="text" required pattern="[a-zA-Z]{2,}" name="lname" placeholder="Last Name"><br>
                    Mobile Number:<br>
                    <input class="form-control col-sm-4" type="tel" required pattern="^[6-9][0-9]{9}" name="mobile" placeholder="Mobile Number"><br>
                    Date Of Birth:<br>
                    <input class="form-control col-sm-4" type="date" required name="dateOfBirth"><br>
                    Gender:<br>
                    <input type="radio" required name="gender" value="Male">
                    <label for="male">Male</label><br>
                    <input type="radio" name="gender"value="Female">
                    <label for="female">Female</label><br>
                    <input type="radio" name="gender" value="Others">
                    <label for="others">Others</label><br>
                    Address:<br>
                    <textarea class="form-control col-sm-6" required name="address" placeholder="Address"></textarea><br>
                    City:<br>
                    <select class="form-control col-sm-3" required name="cities" id="cities">
                        <option value="Hyderabad">Hyderabad</option>
                        <option value="Bnaglore">Banglore</option>
                        <option value="Chennai">Chennai</option>
                        <option value="Mumbai">Mumbai</option>
                        <option value="Noida">Noida</option>
                    </select><br>
                    Type of user:<br>
                    <select class="form-control col-sm-3" required name="userType" id="userType">
                        <option value="normal user">Normal User</option>
                    </select><br>
                    Password:<br>
                    <input class="form-control col-sm-3" type="password" required name="password" placeholder="Password"><br>
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <button class="btn btn-primary" type="reset">Reset</button>
                </fieldset>
            </form>
            <br>
            <button class="btn btn-primary"><a href="login">Back to Login</a></button>
        </div>
        <style>
            body
            {
                background-image: url("https://openclipart.org/image/800px/327266");
                background-repeat: no-repeat;
                background-size: cover;
            }
            div{
                /* background-color: lightsteelblue; */
                /* background: transparent; */
                padding: 10px;
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
                text-decoration: none;
            }
        </style>
    </body>
</html>