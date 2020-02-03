@extends("layout")

<?php /** @var \App\Model\User[] $users */ ?>

@section("content")
    <div class="row">
        <div class="col-12 row text-center">
            <div class="col-3"><a href="{{ route("users.list") }}">Wszystkie</a></div>
            <div class="col-3"><a href="{{ route("users.list", ["days" => 30]) }}">Ostatnie 30 dni</a></div>
            <div class="col-3"><a href="{{ route("users.list", ["days" => 7]) }}">Ostatnie 7 dni</a></div>
            <div class="col-3"><a href="{{ route("users.list", ["days" => 3]) }}">Ostatnie 3 dni</a></div>
        </div>
        <div class="col-12">
            <table class="table table-striped table-hover">
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Age</th>
                    <th>Languages</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->getFullName() }}</td>
                        <td>
                            {{ $user->getPeselObject()->getAge() }}
                            @if($user->getPeselObject()->getAge() < 18)
                                ({{ $user->getPeselObject()->getUpTo18String() }})
                            @endif
                        </td>
                        <td>{!! $user->languages->implode("name", "<br>") !!}</td>
                    </tr>
                @endforeach
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection