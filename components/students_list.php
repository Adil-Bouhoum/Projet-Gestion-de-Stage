<?php
// Include the Student model and database connection
include '../Models/students.php';
include '../Connection/config.php';

// Create a new database connection
$database = new Database();
$db = $database->getConnection();

// Create a new Student object
$student = new Student($db);

// Fetch all students
$result = $student->getAllStudents();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Student Information</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Phone Number</th>
                    <th>CIN</th>
                    <th>Department</th>
                    <th>Major</th>
                    <th>Year</th>
                    <th>Internship Status</th>
                    <th>Company Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Resume URL</th>
                    <th>Portfolio URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['date_of_birth']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td><?php echo $row['cin']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['major']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['internship_status']; ?></td>
                    <td><?php echo $row['company_name']; ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                    <td><?php echo $row['resume_url']; ?></td>
                    <td><?php echo $row['portfolio_url']; ?></td>
                    <td>
                        <!-- Edit button to trigger the modal -->
                        <button class="btn btn-success editBtn" 
                            data-id="<?php echo $row['id']; ?>" 
                            data-firstname="<?php echo $row['firstname']; ?>" 
                            data-lastname="<?php echo $row['lastname']; ?>" 
                            data-email="<?php echo $row['email']; ?>" 
                            data-date_of_birth="<?php echo $row['date_of_birth']; ?>" 
                            data-phone_number="<?php echo $row['phone_number']; ?>" 
                            data-cin="<?php echo $row['cin']; ?>" 
                            data-department="<?php echo $row['department']; ?>" 
                            data-year="<?php echo $row['year']; ?>">
                            Edit
                        </button>
                        <a href="../components/delete_student.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../components/edit_student.php" method="POST">
                        <input type="hidden" name="id" id="editId">

                        <div class="mb-3">
                            <label for="editFirstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editFirstname" name="firstname" required>
                        </div>

                        <div class="mb-3">
                            <label for="editLastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editLastname" name="lastname" required>
                        </div>

                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="editDateOfBirth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="editDateOfBirth" name="date_of_birth" required>
                        </div>

                        <div class="mb-3">
                            <label for="editPhoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="editPhoneNumber" name="phone_number">
                        </div>

                        <div class="mb-3">
                            <label for="editCin" class="form-label">CIN</label>
                            <input type="text" class="form-control" id="editCin" name="cin">
                        </div>

                        <div class="mb-3">
                            <label for="editDepartment" class="form-label">Department</label>
                            <input type="text" class="form-control" id="editDepartment" name="department">
                        </div>

                        <div class="mb-3">
                            <label for="editMajor" class="form-label">Major</label>
                            <input type="text" class="form-control" id="editMajor" name="major">
                        </div>

                        <div class="mb-3">
                            <label for="editYear" class="form-label">Year</label>
                            <input type="number" class="form-control" id="editYear" name="year">
                        </div>

                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for Modal -->
    <script>
        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function () {
                const modal = new bootstrap.Modal(document.getElementById('editModal'));
                document.getElementById('editId').value = this.dataset.id;
                document.getElementById('editFirstname').value = this.dataset.firstname;
                document.getElementById('editLastname').value = this.dataset.lastname;
                document.getElementById('editEmail').value = this.dataset.email;
                document.getElementById('editDateOfBirth').value = this.dataset.date_of_birth;
                document.getElementById('editPhoneNumber').value = this.dataset.phone_number;
                document.getElementById('editCin').value = this.dataset.cin;
                document.getElementById('editDepartment').value = this.dataset.department;
                document.getElementById('editYear').value = this.dataset.year;

                modal.show();
            });
        });
    </script>
</body>
</html>