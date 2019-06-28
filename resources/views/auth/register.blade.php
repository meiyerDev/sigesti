@include('layouts.header')

<div class="mt-5 pt-5 text-center">

    <h1>Sorry the page you are looking for could not be found</h1>
    <p class="lead">
        <a href="{{ url('login') }}">Ir al login</a>
    </p>

    {{-- <div class="card" style="width: 600px">
        <div class="card-header">Registro</div>

        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Nombre</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                    <label for="user" class="col-md-4 control-label">Usuario</label>

                    <div class="col-md-6">
                        <input id="user" type="text" class="form-control" name="user" value="{{ old('user') }}" required>

                        @if ($errors->has('user'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Contraseña</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirme contraseña</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-row form-group mt-4">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Registro
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
</div>


@include('layouts.footer')