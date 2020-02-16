@if(session()->has('flash_message'))
    <script>
        swal({
            title: "{{session('flash_message.title')}}",
            text: "{{session('flash_message.message')}}",
            icon: "{{session('flash_message.level')}}",
            buttons: false,
            timer: 1500
        });
    </script>
@endif

@if(session()->has('flash_message_overlay'))
    <script>
        swal({
            title: "{{session('flash_message_overlay.title')}}",
            text: "{{session('flash_message_overlay.message')}}",
            icon: "{{session('flash_message_overlay.level')}}",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Okay',
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false
        }, function () {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

    </script>

@endif
<script>
    $(document).ready(function () {
        // $('.deleteButton').click(function () {
           var form = document.querySelectorAll('form.deleteForm'),
               result;
            for (var i = 0; i < form.length; i++) {
                result = form[i];
                result.addEventListener('submit', function(e) {
                    var form1 = this;
                    e.preventDefault(); // <--- prevent form from submitting
                    swal({
                        title: "آیا مطمئن هستید؟",
                        text: "در صورت تایید آیتم مورد نظر حذف خواهد شد!",
                        icon: "warning",
                        buttons: [
                            'انصراف',
                            'تایید'
                        ],
                        dangerMode: true,
                    }).then(function(isConfirm)
                    {
                        if (isConfirm)
                        {
                            swal(
                                {
                                title: 'موفق',
                                text: 'آیتم مورد نظر حذف خواهد شد!',
                                icon: 'success',
                                buttons: false,
                                timer: 800
                                 }).then(function()
                            {
                                form1.submit(); // <--- submit form programmatically
                            });
                        } else
                        {
                            swal(" لغو شد", '', "error");
                        }

                     });
                 });
            }

        // });
    });

</script>
