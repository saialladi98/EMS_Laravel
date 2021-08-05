<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Reset Password</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h3>Reset Password</h3>
                    <hr>
                    <!-- forget password form -->
                    <form action="resetPassword" method="POST">
                        @if(Session::has('success'))
                            <div class="alert alert-success"><strong>{{Session::get('success')}}</strong></div>
                        @endif
                        @if(Session::has('fail'))
                            <div class="alert alert-danger"><strong>{{Session::get('fail')}}</strong></div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="userName">User Id</label>
                            <input type="text" class="form-control" placeholder="UserId" name="userid" value="{{old('userid')}}">
                            <span  class="text-danger">@error('userid'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="user_password">New Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" value="{{old('password')}}">
                            <span class="text-danger">@error('password'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="user_password">Re-enter New Password</label>
                            <input type="password" class="form-control" placeholder="Re-enter Password" name="re_password" value="{{old('re_password')}}">
                            <span  class="text-danger">@error('re_password'){{$message}}@enderror</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                        <br>
                        <a href="login">Back to Login</a>
                    </form>
                </div>    
            </div>
        </div>
    </body>
    <style>
        label
        {
            color: black;
        }
        .container
        {
            scroll-behavior: auto;
            padding: 30px ;
            margin: 100px;
            margin-left: 250px;
            margin-right: 300px;
        }  
        body
        {
            background-image: url("https://openclipart.org/image/800px/327266");
            background-repeat: no-repeat;
            background-size: 100%;
        }
    </style>
</html>
