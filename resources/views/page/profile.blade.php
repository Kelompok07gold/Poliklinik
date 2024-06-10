@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Pengaturan Akun</div>
                        <div class="card-body">
                            @if (session('success'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: '{{ session('success') }}'
                                    });
                                </script>
                            @endif
                            <form action="{{ route('update.profile') }}" method="POST" onsubmit="return validateForm()">
                                @csrf
                                <div class="form-group">
                                    <label for="new_username">Username Baru</label>
                                    <input type="text" class="form-control" id="new_username" name="new_username"
                                        value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_email">Email Baru</label>
                                    <input type="email" class="form-control" id="new_email" name="new_email"
                                        value="{{ Auth::user()->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Password Baru</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                        name="new_password_confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Function to show Sweet Alert
        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message
            });
        }

        // Validate form submission
        function validateForm() {
            var password = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("new_password_confirmation").value;

            // Check if passwords match
            if (password !== confirmPassword) {
                showErrorAlert("Password dan konfirmasi password tidak cocok.");
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
@endsection
