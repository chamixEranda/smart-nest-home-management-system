<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="{{ asset('assets/admin/libs/jquery/dist/jquery.min.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/js/mobiscroll.jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.multifield.min.js') }}"></script>
<script src="{{asset('assets/admin/js/toastr.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
{!! Toastr::message() !!}
@if ($errors->any())
<script>
    @foreach($errors->all() as $error)
      toastr.error('{{$error}}', Error, {
        CloseButton: true,
        ProgressBar: true
      });
      @endforeach
</script>
@endif
<script>
    var ToastMixin = Swal.mixin({
        toast: true,
        icon: 'success',
        title: '',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });

    function form_alert(id, message) {
        Swal.fire({
            title: '{{ translate('messages.Are you sure?') }}',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#5D87FF',
            cancelButtonText: '{{ translate('messages.no') }}',
            confirmButtonText: '{{ translate('messages.Yes') }}',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#'+id).submit()
            }
        })
    }

    $('#registration_form').on('submit',function(e) {
        $('#Registerbtn').css('display', 'none');
        $('.buttonPreloader').css('display', 'block');
        var formData = new FormData($('#registration_form')[0]);
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '{{ route('login-create') }}',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'error') {
                    $.each(data.errors, function(key, val) {
                        ToastMixin.fire({
                            animation: true,
                            icon: 'warning',
                            title: val['message'],
                        });
                    });
                    $('.buttonPreloader').css('display', 'none');
                    $('#Registerbtn').css('display', 'block');
                }

                if (data.status == false) {
                    ToastMixin.fire({
                        animation: true,
                        icon: 'warning',
                        title: data.message,
                    });
                    $('.buttonPreloader').css('display', 'none');
                    $('#Registerbtn').css('display', 'block');
                }

                ToastMixin.fire({
                    animation: true,
                    icon: 'success',
                    title: data.message,
                });
                $('.buttonPreloader').css('display', 'none');
                $('#Registerbtn').css('display', 'block');
                location.href = '/';
            },
            error: function (err) {
                $('.buttonPreloader').css('display', 'none');
                $('#Registerbtn').css('display', 'block');
            }
        });
    });

    $('#user_login_form').on('submit',function(e) {
        $('#LoginformBtn').css('display', 'none');
        $('.buttonPreloader').css('display', 'block');
        var formData = new FormData($('#user_login_form')[0]);
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '{{ route('login-check') }}',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'error') {
                    $.each(data.errors, function(key, val) {
                        ToastMixin.fire({
                            animation: true,
                            icon: 'warning',
                            title: val['message'],
                        });
                    });
                    $('.buttonPreloader').css('display', 'none');
                    $('#LoginformBtn').css('display', 'block');
                }

                if (data.status == false) {
                    ToastMixin.fire({
                        animation: true,
                        icon: 'warning',
                        title: data.message,
                    });
                    $('.buttonPreloader').css('display', 'none');
                    $('#LoginformBtn').css('display', 'block');
                }

                if (data.status == true) {
                    ToastMixin.fire({
                        animation: true,
                        icon: 'success',
                        title: data.message,
                    });
                    $('.buttonPreloader').css('display', 'none');
                    $('#LoginformBtn').css('display', 'block');
                    location.href = '/';
                }
                
            },
            error: function (err) {
                $('.buttonPreloaderlogin').css('display', 'none');
                $('#LoginformBtn').css('display', 'block');
            }
        });
    });
</script>
@stack('scripts')