@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Регистрация</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Логин</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <!-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Повторите пароль</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sex" class="col-md-4 control-label">Пол</label>

                            <div class="col-md-6">
                                <select id="sex" class="form-control" name="sex">
                                    <option value="male">Мужчина</option>
                                    <option value="female">Женщина</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="age" class="col-md-4 control-label">Год рождения</label>

                            <div class="col-md-6">
                                <input type="number" min="1900" max="2017" name="age">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nickname" class="col-md-4 control-label">Псевдоним</label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="form-control" name="nickname" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contacts" class="col-md-4 control-label">Контакты</label>

                            <div class="col-md-6">
                                <input id="contacts" type="text" class="form-control" name="contacts" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Кто вы?</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control" name="role">
                                    <option value="seller">Продавец</option>
                                    <option value="buyer">Покупатель</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Готово
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
