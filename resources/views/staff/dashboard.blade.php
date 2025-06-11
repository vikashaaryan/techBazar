@extends("staff.stafflayout")

@section('title')
staff dashboard
    
@endsection
@section('content')
<div>
    <form action="{{route('Userlogout')}}" method="POST">
        @csrf
        <div class="flex justify-end m-3">
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                Logout
            </button>
        </div>
    </form>
</div>
    
@endsection

s