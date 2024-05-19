<?php
require "config.php";

$response = ['status' => 'error', 'message' => '', 'patientData' => null];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['patientId'])) {
    $patientId = $_GET['patientId'];

    $sql = "SELECT * FROM patientfile WHERE pid = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $response['status'] = 'success';
        $response['patientData'] = $result->fetch_assoc();
    } else {
        $response['message'] = 'Patient not found';
    }

    $stmt->close();
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['patientId'])) {
    $patientId = $_POST['patientId'];
    $name = $_POST['name'];
    $age = $_POST['age'];

    $sql = "UPDATE patientfile SET name = ?, age = ? WHERE pid = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sii", $name, $age, $patientId);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Patient information updated successfully';
    } else {
        $response['message'] = 'Error updating patient information: ' . $stmt->error;
    }

    $stmt->close();
    echo json_encode($response);
    exit();
}

$link->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Doctor Page</h1>
    <form id="searchForm" method="GET">
        <label for="patientId">Enter Patient ID:</label>
        <input type="text" id="patientId" name="patientId" required>
        <button type="submit">Search</button>
    </form>
    <div id="patientInfo"></div>
    <div id="resultMessage"></div>
    <button id="displayInfoButton" style="display:none;">Display Patient Info</button>
    <button id="updateInfoButton" style="display:none;">Update Patient Info</button>

    <script>
        $(document).ready(function(){
            let patientData = null;

            $('#searchForm').submit(function(e){
                e.preventDefault();
                var patientId = $('#patientId').val();
                $.ajax({
                    url: '',
                    type: 'GET',
                    data: { patientId: patientId },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.status === 'success' && data.patientData) {
                            patientData = data.patientData;
                            $('#resultMessage').html('');
                            $('#displayInfoButton').show();
                            $('#updateInfoButton').hide();
                            $('#patientInfo').html('');
                        } else {
                            $('#patientInfo').html('');
                            $('#resultMessage').html('<p>' + data.message + '</p>');
                            $('#displayInfoButton').hide();
                            $('#updateInfoButton').hide();
                        }
                    }
                });
            });

            $('#displayInfoButton').click(function() {
                if (patientData) {
                    $('#patientInfo').html(
                        '<div>' +
                        '<h2>Patient Information</h2>' +
                        '<p><strong>Patient ID:</strong> ' + patientData.pid + '</p>' +
                        '<p><strong>Name:</strong> ' + patientData.name + '</p>' +
                        '<p><strong>Age:</strong> ' + patientData.age + '</p>' +
                        '</div>'
                    );
                    $('#updateInfoButton').show();
                }
            });

            $('#updateInfoButton').click(function() {
                if (patientData) {
                    $('#patientInfo').html(
                        '<form id="updateForm" method="POST">' +
                        '<label for="patientId">Patient ID:</label>' +
                        '<input type="text" id="patientId" name="patientId" value="' + patientData.pid + '" readonly><br>' +
                        '<label for="name">Name:</label>' +
                        '<input type="text" id="name" name="name" value="' + patientData.name + '"><br>' +
                        '<label for="age">Age:</label>' +
                        '<input type="text" id="age" name="age" value="' + patientData.age + '"><br>' +
                        '<button type="submit">Update</button>' +
                        '</form>'
                    );
                    $('#updateInfoButton').hide();
                }
            });

            $(document).on('submit', '#updateForm', function(e){
                e.preventDefault();
                $.ajax({
                    url: '',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('#resultMessage').html('<p>' + data.message + '</p>');
                        if (data.status === 'success') {
                            $('#patientInfo').html('');
                            $('#displayInfoButton').hide();
                            $('#updateInfoButton').hide();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
