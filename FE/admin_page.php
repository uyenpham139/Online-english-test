<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <!-- Google Fonts and Custom CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Link to external style.css -->
  <link rel="stylesheet" href="FE/css/admin_style.css">
</head>
<body>

  <!-- Sidebar -->
  <nav>
    <h2>Admin Panel</h2>
    <a href="index.php?/admin" id="dashboard-link" class="active">Dashboard</a>
    <a href="#" id="users-link">Users</a>
    <a href="#" id="exams-link">Exams</a>
    <a href="FE/logout.php">Logout</a>
  </nav>

  <!-- Main Content -->
  <div class="content" id="main-content">
    <!-- Dashboard Content -->
    <h1>Welcome, Admin</h1>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card p-4">
          <h3 class="card-title">Total Users</h3>
          <h1 class="card-text">120</h1>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-4">
          <h3 class="card-title">Active Exams</h3>
          <h1 class="card-text">15</h1>
        </div>
      </div>
    </div>

    
    <!-- Beginner Ranking Table -->
    <div class="mt-5">
      <h3>Beginner Level Rankings</h3>
      <div class="table-responsive">
        <table class="table table-bordered ranking-table">
          <thead>
            <tr>
              <th scope="col">Rank</th>
              <th scope="col">Name</th>
              <th scope="col">Score</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>John Doe</td>
              <td>75</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Emily White</td>
              <td>70</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Intermediate Ranking Table -->
    <div class="mt-5">
      <h3>Intermediate Level Rankings</h3>
      <div class="table-responsive">
        <table class="table table-bordered ranking-table">
          <thead>
            <tr>
              <th scope="col">Rank</th>
              <th scope="col">Name</th>
              <th scope="col">Score</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Jane Smith</td>
              <td>85</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>David Brown</td>
              <td>80</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Advanced Ranking Table -->
    <div class="mt-5">
      <h3>Advanced Level Rankings</h3>
      <div class="table-responsive">
        <table class="table table-bordered ranking-table">
          <thead>
            <tr>
              <th scope="col">Rank</th>
              <th scope="col">Name</th>
              <th scope="col">Score</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Michael Johnson</td>
              <td>95</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Susan Lee</td>
              <td>90</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Link to external script.js -->
  <script src="FE/js/admin_script.js" defer></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
