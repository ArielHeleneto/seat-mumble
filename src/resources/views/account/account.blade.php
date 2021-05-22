@extends('web::layouts.grids.12')

@section('title', 'Mumble')
@section('page_header', __('mumble::menu.mumble_management'))
@section('page_description', __('mumble::menu.account'))

@push('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/wt-mumble-hook.css') }}"/>
@endpush

@section('full')

    <div id="user-alert" class="callout callout-danger hidden">
        <h4>{{__('mumble::account.tip')}}</h4>
        <p>{{__('mumble::account.tip_dec')}}</p>
    </div>

    <div class="row margin-bottom">
        <div class="col-md-12">
            <div class="pull-right">
                <button type="button" class="btn btn-danger" id="reset-password">
                    <i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;
                    {{ __('mumble::account.reset_password') }}
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h3 class="mb-0">
                        <i class="fas fa-play-circle"></i>
                        {{ __('mumble::account.credentials') }}
                    </h3>
                </div>
                <div class="card-body p-0 m-0">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-condensed table-hover" id="credentials">
                                <tbody>
                                <tr>
                                    <td><b>{{ __('mumble::account.server_ip') }}</b></td>
                                    <td><input readonly id="server-ip" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('mumble::account.server_port') }}</b></td>
                                    <td><input readonly id="server-port" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('mumble::account.username') }}</b></td>
                                    <td><input readonly id="username" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('mumble::account.password') }}</b></td>
                                    <td><input id="password" type="password" onfocusin="this.type='text';"
                                               onfocusout="this.type='password';" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('mumble::account.certhash') }}</b></td>
                                    <td><input id="certhash" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('mumble::account.nick') }}</b></td>
                                    <td><input id="nick" style="width: 100%;"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row margin-bottom">
        <div class="col-md-12">
            <div class="pull-right">
                <button type="button" class="btn btn-primary" id="submit">
                    <i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;
                    {{ __('mumble::account.submit') }}
                </button>
            </div>
        </div>
    </div>

@endsection

@push('javascript')
    <script type="text/javascript">
        $.ajax({
            url: '{{ route('mumble.account.getCredential') }}',
            method: 'GET',
            success: function (data) {
                $('#server-ip').val(data.server_addr.split(':')[0] || '');
                $('#server-port').val(data.server_addr.split(':')[1] || '64738');
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#certhash').val(data.certhash || {{__('mumble::account.unset')}});
                $('#nickname').val(data.nickname || {{__('mumble::account.unset')}});
            }
        });

        $('button.btn-danger').on('click', function () {
            if (!window.confirm('{{ __('mumble::account.password_reset_confirm') }}')) return;
            $.ajax({
                url: '{{ route('mumble.account.reset') }}',
                method: 'POST',
                success: function (data) {
                    window.alert('{{ __('mumble::account.password_reset_complete')  }}');
                    location.reload()
                }
            });
        });

        $('button.btn-primary').on('click', function () {
            $.ajax({
                url: '{{ route('mumble.account.reset') }}',
                method: 'POST',
                success: function (data) {
                    window.alert('{{ __('mumble::account.password_reset_complete')  }}');
                    location.reload()
                }
            });
        });
    </script>
@endpush
