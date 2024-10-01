@if (session()->has('Sucesso'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Sucesso!', "{{ session('Sucesso') }}", 'success');
        });
    </script>
@endif

@if ($errors->any())
    @php
        $message = '';
        foreach ($errors->all() as $error) {
            $message .= $error . '<br>';
        }
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Error!', "{!! $message !!}", 'error');
        });
    </script>
@endif
