@if (session()->has('success'))
    <div class="toast-container position-fixed bottom-0 start-0 p-3">
        <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true" id="LiveToastSuccess">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                    Hello.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>

        <script>
            var toastLive = document.getElementById('LiveToastSuccess')
            var toast = new bootstrap.Toast(toastLive)

            toast.show()
        </script>
@endif
@if (session()->has('error'))
    <div class="toast-container position-fixed bottom-0 start-0 p-3">
        <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
            aria-atomic="true" id="LiveToastError">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                    Hello.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>

        <script>
            var toastLive = document.getElementById('LiveToastError')
            var toast = new bootstrap.Toast(toastLive)

            toast.show()
        </script>
@endif
@if ($errors->any())
    <div class="toast-container position-fixed bottom-0 start-0 p-3">
        <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
            aria-atomic="true" id="LiveToastError">
            <div class="d-flex">
                <div class="toast-body">
                    @foreach ($errors->all() as $error )
                    {{ $error }}<br>
                    @endforeach
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>

        <script>
            var toastLive = document.getElementById('LiveToastError')
            var toast = new bootstrap.Toast(toastLive)

            toast.show()
        </script>
@endif
