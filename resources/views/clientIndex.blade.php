<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            USUARIOS
        </h2>
    </x-slot>
    
    Vista de cliente
    
@section('scripts')
    <script type="text/javascript" src="{{asset('js/users.js')}}"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" defer></script>
@endsection
</x-app-layout>
