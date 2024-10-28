<?php
// Include the database connection file
include '../../connections.php';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Iterate through each student's attendance and recitation input
    foreach ($_POST['recitation'] as $studentID => $recitationScore) {
        // Get the corresponding attendance status
        $attendanceStatus = $_POST['attendance'][$studentID];

        // Prepare the SQL query to update both recitation and attendance
        $sql = "UPDATE `student` SET `Recitation` = ?, `Attendance` = ? WHERE `studentID` = ?";

        // Use prepared statements for security
        if ($stmt = mysqli_prepare($connection, $sql)) {
            // Bind the parameters: "dsi" (double, string, integer)
            mysqli_stmt_bind_param($stmt, "dsi", $recitationScore, $attendanceStatus, $studentID);

            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                echo "Updated student ID: " . $studentID . "<br>";
            } else {
                echo "Error updating student ID: " . $studentID . "<br>";
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing the statement.<br>";
        }
    }

    // Close the database connection
    mysqli_close($connection);

    // Redirect back to the attendance page after updating
    header("Location: attendance.php");
    exit();
}
?>
