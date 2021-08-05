<body>
  <h3>Employee Information</h3>
  <section id="tableInfo">
    <i><b>
    <table border="2">
      <tr>
        <th>Employee Id</th>
        <th>First Name </th>
        <th>last Name</th>
        <th>Mobile Number</th>
        <th>Date Of Birth</th>
        <th>Address</th>
        <th>Gender</th>
        <th>City</th>
      </tr>
      @foreach($collection as $user)
        <tr>
          <td>{{ $user->employee_id }}</td>
          <td>{{ $user->first_name }}</td>
          <td>{{ $user->last_name }}</td>
          <td>{{$user->mobile_no }}</td>
          <td>{{$user->date_of_birth }}</td>
          <td>{{ $user->communication_address }}</td>
          <td>{{ $user->gender }}</td>
          <td>{{ $user->city }} </td>     
        </tr>
      @endforeach 
    </table>
    </b></i>
  </section>
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
