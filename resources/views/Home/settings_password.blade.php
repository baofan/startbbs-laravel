@extends('home.common.base')

@section('page_title')
	{{ $title . '- ' . $settings['site_name'] }}
@stop

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">
                        <h4>账号设置</h4>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li><a href="/settings/profile">基本信息</a></li>
                            <li><a href="/settings/avatar">修改头像</a></li>
                            <li class="active"><a href="javascript:void(0)">密码安全</a></li>
                        </ul>
                        <div class="setting">
                            <?php if (@$msg!='') echo '<div class="alert alert-danger">'.$msg.'</div>'; ?>
                            <form accept-charset="UTF-8" action="/settings/password" class="simple_form form-horizontal" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="user_current_password">当前密码</label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="user_current_password" name="password" value="" size="50" type="password" />
                                        <span class="help-block red"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="user_password">新密码</label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="user_password" name="newpassword" value="" size="50" type="password" />
                                        <span class="help-block red"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="user_password_confirmation">密码确认</label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="user_password_confirmation" name="newpassword2" value="" size="50" type="password" />
                                        <span class="help-block red"></span>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" name="commit" class="btn btn-primary">修改密码</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @include('home.common.sidebar_login')
                @include('home.common.sidebar_ad')
            </div>
        </div>
    </div>
@stop