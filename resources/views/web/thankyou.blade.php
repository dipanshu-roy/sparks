<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPARK Olympiads Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #555;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card-box {
            width: 100%;
            max-width: 450px;
            border-radius: 20px;
            overflow: hidden;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-top {
            background-color: #3c78ff;
            padding: 40px 0;
            display: flex;
            justify-content: center;
        }

        .card-top .checkmark {
            width: 80px;
            height: 80px;
            background-color: #28a745;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .checkmark i {
            font-size: 36px;
            color: white;
        }

        .card-body {
            text-align: center;
            padding: 30px 20px;
        }

        .logo-text {
            font-size: 28px;
            font-weight: bold;
            color: #004aad;
            letter-spacing: 1px;
        }

        .logo-text span {
            color: #ff4b00;
        }

        .btn-primary {
            background-color: #0056d2;
            border: none;
            border-radius: 6px;
        }

        .btn-primary:hover {
            background-color: #0044a3;
        }
    </style>
    <div class="card-box text-center">
        <div class="card-top">
            <div class="checkmark">
                <i class="bi bi-check-lg"></i>
            </div>
        </div>
        <div class="card-body">
            <div class="logo-text">
                <img src="{{ asset('web/assets/img/logo.svg') }}" class="img-fluid" alt="logo" />
            </div>
            <p class="mt-3 mb-1"><strong>Thank you</strong> for registering your school.</p>
            <p>Your SPARK Olympiads account has been created successfully.</p>
            <small>An email has been sent to the SPARK Coordinator with next steps.</small>
            <div class="card-body text-start">
                <p>
                    <strong>School URL:</strong> <a href="{{ $schoolUrl }}" target="_blank">{{ $schoolUrl }}</a>
                    </br>
                    <strong>School ID:</strong> {{ $schoolId }}
                    </br>
                    <strong>Temporary Password:</strong> {{ $tempPassword }}
                </p>
            </div>
            <a href="{{ $schoolUrl }}" class="btn btn-primary px-4">Back To SPARK Website</a>
        </div>
    </div>
    <!-- Bootstrap icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    </body>

</html>
