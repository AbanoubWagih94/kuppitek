@if (session()->has('alert_message'))
    <script>
        swal({
            title: "{{session()->get('alert_message')['message']}}",
            text: "",
            icon: "{{session()->get('alert_message')['icon']}}",
            button: "close",
        });
    </script>
    {{ session()->forget('alert_message') }}
@endif