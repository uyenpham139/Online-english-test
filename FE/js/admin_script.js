// Cache DOM elements
const dashboardLink = document.getElementById('dashboard-link');
const usersLink = document.getElementById('users-link');
const examsLink = document.getElementById('exams-link');
const mainContent = document.getElementById('main-content');

// Function to update active link styling
const setActiveLink = (link) => {
  document.querySelectorAll('nav a').forEach(a => a.classList.remove('active'));
  link.classList.add('active');
};

// Event listeners for navigation
dashboardLink.addEventListener('click', () => {
  setActiveLink(dashboardLink);
  mainContent.innerHTML = `
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
    </div>`;
});

usersLink.addEventListener('click', () => {
setActiveLink(usersLink);
mainContent.innerHTML = `
<h2>Manage Users</h2>
<table class="table table-striped table-hover mt-3">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>John Doe</td>
      <td>johndoe@example.com</td>
      <td>Admin</td>
      <td>
        <button class="btn btn-primary btn-sm">Edit</button>
        <button class="btn btn-danger btn-sm">Delete</button>
      </td>
    </tr>
    <tr>
      <td>2</td>
      <td>Jane Smith</td>
      <td>janesmith@example.com</td>
      <td>User</td>
      <td>
        <button class="btn btn-primary btn-sm">Edit</button>
        <button class="btn btn-danger btn-sm">Delete</button>
      </td>
    </tr>
    <tr>
      <td>1</td>
      <td>Tom Riddle</td>
      <td>tom@example.com</td>
      <td>Staff</td>
      <td>
        <button class="btn btn-primary btn-sm">Edit</button>
        <button class="btn btn-danger btn-sm">Delete</button>
      </td>
    </tr>
  </tbody>
</table>`;

// Add custom styles to make table text white
const style = document.createElement('style');
style.innerHTML = `
  .table th, .table td {
    color: #fff !important; /* Ensures all text in table is white */
  }
`;
document.head.appendChild(style);
});


examsLink.addEventListener('click', () => {
setActiveLink(examsLink);
mainContent.innerHTML = `
  <h2>Exam Information</h2>
  <div class="table-responsive">
    <table class="table table-striped table-hover mt-3">
      <thead>
        <tr>
          <th>Exam ID</th>
          <th>Exam Name</th>
          <th>Date</th>
          <th>Taken By</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>101</td>
          <td>Math 101</td>
          <td>2024-01-15</td>
          <td>Cole Palmer</td>
          <td><span class="badge bg-success">Finish</span></td>
        </tr>
        <tr>
          <td>102</td>
          <td>Physics 101</td>
          <td>2024-02-20</td>
          <td>Jamie Thompson</td>
          <td><span class="badge bg-warning">Doing</span></td>
        </tr>
        <tr>
          <td>102</td>
          <td>Physics 101</td>
          <td>2024-02-20</td>
          <td>Jamie Martin</td>
          <td><span class="badge bg-warning">Doing</span></td>
        </tr>
      </tbody>
    </table>
  </div>`;
});