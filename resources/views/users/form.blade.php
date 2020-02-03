@extends("layout")

@section("content")
    @if(isset($errors))
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="first_name_input">First name</label>
            <input type="text" class="form-control" id="first_name_input" name="first_name" value="{{ old("first_name") }}">
        </div>
        <div class="form-group">
            <label for="last_name_input">Last name</label>
            <input type="text" class="form-control" id="last_name_input" name="last_name" value="{{ old("last_name") }}">
        </div>
        <div class="form-group">
            <label for="email_input">Email address</label>
            <input type="email" class="form-control" id="email_input" name="email" value="{{ old("email") }}">
        </div>
        <div class="form-group">
            <label for="languages_select">Programming languages</label>
            <select class="form-control" id="languages_select" name="languages[]" multiple>
                @if(is_array(old("languages")))
                    @foreach(array_filter(old("languages"), function($val) { return is_string($val); }) as $language)
                        <option selected>{{ $language }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="pesel_input">Pesel</label>
            <input type="text" class="form-control" id="pesel_input" name="pesel" value="{{ old("pesel") }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section("body-scripts")
    <script type="application/javascript">
        $("#languages_select").select2({
            tags: true
        });
    </script>
@append