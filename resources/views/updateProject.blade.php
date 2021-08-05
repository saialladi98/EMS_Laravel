<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Update Project</title>
    </head>
    <body>
        <!--update project -->
        <div id="updateProjdetail">
            <form id="updateProject" action="updateProjectbyadmin"  method="post">
                @if(Session::has('success'))
                    <div class="alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                   <div class="alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="project_id" required placeholder="enter project id"><br><br>
                        <input type="text" class="form-control"  name="project_name"   placeholder="Enter project name"><br><br>
                        <textarea  class="form-control"  name="project_desc"  placeholder="Enter project desc"></textarea><br><br>
                        <input type="date" class="form-control"  name="start_date" placeholder="Enter start date"><br><br>
                        <input type="date" class="form-control"  name="end_date"  placeholder="Enter end date"><br><br>
                        <button type="submit" class="btn btn-warning">Submit</button>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </body>
    <style>
        #updateProjdetail {
            padding: 20px;
        }
    </style>
</html>