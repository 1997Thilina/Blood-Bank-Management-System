
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>User Management</h2>
  
  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home">Home</a></li>
    <li><a data-toggle="pill" href="#menu1">Menu 1</a></li>
    <li><a data-toggle="pill" href="#menu2">Menu 2</a></li>
    <li><a data-toggle="pill" href="#menu3">Me</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      {{-- <h3>Menu 3</h3> --}}
      
      <div class="container">
        <h3>Donor details</h3>
                                                                                              
        <div class="table-responsive">          
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Age</th>
              <th>City</th>
              <th>Country</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Anna</td>
              <td>Pitt</td>
              <td>35</td>
              <td>New York</td>
              <td>USA</td>
            </tr>
            <tr>
                <td>1</td>
                <td>Anna</td>
                <td>Pitt</td>
                <td>35</td>
                <td>New York</td>
                <td>USA</td>
              </tr>
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
