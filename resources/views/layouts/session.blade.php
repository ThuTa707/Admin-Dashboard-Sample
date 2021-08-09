@if (session('success'))
    <div class="col-md-4 offset-md-4 mt-2">
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif


@if (session('fail'))
    <div class="col-md-4 offset-md-4 mt-2">
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <strong>{{ session('fail') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

@endif

{{-- Toast --}}
@if (session('toast'))

    <script>
        let toast = @json(session('toast'));

        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: toast.icon,
            title: toast.title,
        })
    </script>

@endif


{{-- Alert --}}
@if (session('alert'))

    <script>
        let alertText = @json(session('alert'))

        Swal.fire(
            alertText.title,
            alertText.text,
            alertText.icon
        )
    </script>

@endif
