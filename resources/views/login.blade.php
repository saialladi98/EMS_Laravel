<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compati ble" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>login page</title>
    </head>
    <body>
        <div id="div1">
            <h1 id="id1"><i>Employee Management System</i></h1>
            <div id="div2" class="col-md-3">
                <h4 class="feature-title ">Login</h4>
                <!-- login form -->
                <form action="loginFunction" method="POST">
                    @if(Session::has('success'))
                        <div class="alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="userName" style="color: black;">User Id</label>
                        <input type="text" class="form-control col-sm-3" placeholder="UserId" name="userid" value="{{old('userid')}}">
                        <span class="text-danger">@error('userid'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="user_password" style="color: black;">Password</label>
                        <input type="password" class="form-control col-sm-3" placeholder="Password" name="password" value="{{old('password')}}">
                        <span class="text-danger">@error('user_password'){{$message}}@enderror</span>
                    </div> <br>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div> <br>
                    <a href="forgetPassword">Forgot Password??</a><br>
                    <a href="register">Register here.</a><br>
                </form>
            </div>
        </div>
    </body>
    <style>
        body,html
        {
            /* background-color: bisque; */
            margin: 0;
            padding: 0;
            background-image: url("https://openclipart.org/image/800px/327266");
            background-repeat: no-repeat;
            background-size: 100%;
        }
        #div1
        {
            padding: 30px;
            margin-left: 50px;
        }
        #div2
        {
            padding: 20px;
            margin-left: 50px;
        }
        #id1{
            text-align: center;
        }
        a{
            color: black;
        }
    </style>
</html>
