<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>School Registration</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <div class="container mt-5">
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h2 class="mb-4">School Registration</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="contactForm" method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="mb-3">
              <label id="label">Mobile Or Email</label>
              <input type="text" id="mobile" name="mobileno" class="form-control" placeholder="Mobile Or Email" required autocomplete="off" />
              <div id="mobile-error" class="text-danger small mt-1"></div> <!-- Inline error message -->
          </div>


            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
      </div>
    </div>
 <div class="col-md-4"></div>
</div>
    <!-- Bootstrap Bundle JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
// const mobileInput = document.getElementById("mobile");
// const errorDiv = document.getElementById("mobile-error");

// mobileInput.addEventListener("keyup", function () {
//     const value = this.value.trim();
//     errorDiv.textContent = ''; // Clear previous error

//     if (value.length === 1) {
//         const firstChar = value.charAt(0);

//         if (
//             firstChar === '0' || 
//             firstChar === '+' || 
//             firstChar === '-' || 
//             /[^a-zA-Z0-9]/.test(firstChar)
//         ) {
//             errorDiv.textContent = 'First character should not be 0 or a special character.';
//             this.value = '';
//             return;
//         }

//         if (!isNaN(firstChar)) {
//             mobileInput.setAttribute("maxlength", "10");
//             mobileInput.setAttribute("minlength", "1");
//         } else {
//             mobileInput.removeAttribute("maxlength");
//         }
//     }
// });
</script>



</body>
</html>
