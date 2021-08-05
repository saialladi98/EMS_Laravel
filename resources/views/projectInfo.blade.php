<!-- Employee Project Information -->
<body>
    <div class="container1">
        <h3>Project Details</h3>
    </div>
    <br>
    <div class="container2">
        <table border="2" >
            <tr>
                <th>employee Id</th>
                <th>Project Id</th>
                <th>Manager Id</th>
                <th>project_name</th>
                <th>project_desc</th>
                <th>project_start_date</th>
                <th>project_end_date</th>
            </tr>
            @foreach($projects as $user)
                <tr>
                    <td>{{$user['employee_id']}}</td>
                    <td>{{$user['project_id']}}</td>
                    <td>{{$user['manager']}}</td>
                    <td>{{$user['project_name']}}</td>
                    <td>{{$user['project_desc']}}</td>
                    <td>{{$user['project_start_date']}}</td>
                    <td>{{$user['project_end_date']}}</td>
                </tr>
            @endforeach 
        </table>
    </div>
</body>
<style>
    body
    {
        background-image: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQCtk1qIUtpFAB5_nUR50U9SrNNW2Jam5rzYtmk22Wtq1__a22n1hOHG2waLPbEYK02xQE&usqp=CAU");
        background-repeat: no-repeat;
        background-size: cover;
        padding-left: 20px;
    }
    .container
    {
        padding:20px
    }
</style>
