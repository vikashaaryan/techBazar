@extends('staff.stafflayout')

@section('title')
    Staff Dashboard
@endsection

@section('content')
    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="w-60 bg-white shadow-sm">
            @include('staff.sidebar')
        </div>
        <div class="bg-white ">
            <div>
                <form action="" method="">
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
