@extends("layout")

<?php /** @var \App\Model\Language[] $languages */ ?>

@section("content")
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover">
                <tr>
                    <th>Language name</th>
                    <th>Users count</th>
                </tr>
                @foreach($languages as $language)
                    <tr>
                        <td>{{ $language->name }}</td>
                        <td>{{ $language->users_count }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection