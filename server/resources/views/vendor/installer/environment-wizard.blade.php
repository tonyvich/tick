@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.wizard.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.wizard.title') !!}
@endsection

@section('container')
    <form data-ui-jp="parsley" id="form" method="post" action="{{ route('LaravelInstaller::environmentSaveWizard') }}">
        <!-- Prefiled Input -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="app_name" id="app_name" value="TickMaster"/>
        <input type="hidden" name="environment" value="production"/>
        <input type="hidden" name="app_debug" value="true"/>
        <input type="hidden" name="app_log_level" value="debug"/>
        <input type="hidden" name="broadcast_driver" value="log"/>
        <input type="hidden" name="cache_driver" id="cache_driver" value="file"/>
        <input type="hidden" name="session_driver" id="session_driver" value="file"/>
        <input type="hidden" name="queue_driver" id="queue_driver" value="sync"/>
        <input type="hidden" name="redis_hostname" id="redis_hostname" value="127.0.0.1"/>
        <input type="hidden" name="redis_password" id="redis_password" value="null"/>
        <input type="hidden" name="redis_port" id="redis_port" value="6379"/>
        <input type="hidden" name="pusher_app_id" id="pusher_app_id"/>
        <input type="hidden" name="pusher_app_key" id="pusher_app_key" value=""/>
        <input type="hidden" name="pusher_app_secret" id="pusher_app_secret" value=""/>
        
        <fieldset>
            <legend>App URL</legend>
            <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
                <input class="form-control" type="url" name="app_url" id="app_url" value="http://localhost" placeholder="{{ trans('installer_messages.environment.wizard.form.app_url_placeholder') }}" />
                @if ($errors->has('app_url'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('app_url') }}
                    </span>
                @endif
            </div>
        </fieldset>

        <fieldset>
            <legend>Database Config</legend>
            <!-- Database connection -->
            <div class="form-group {{ $errors->has('database_connection') ? ' has-error ' : '' }}">
                <label for="database_connection">
                    {{ trans('installer_messages.environment.wizard.form.db_connection_label') }}
                </label>
                <select name="database_connection" class="form-control" id="database_connection">
                    <option value="mysql" selected>{{ trans('installer_messages.environment.wizard.form.db_connection_label_mysql') }}</option>
                </select>
                @if ($errors->has('database_connection'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('database_connection') }}
                    </span>
                @endif
            </div>

            <!-- Database hostname -->
            <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
                <label for="database_hostname">
                    {{ trans('installer_messages.environment.wizard.form.db_host_label') }}
                </label>
                <input class="form-control" type="text" name="database_hostname" id="database_hostname" value="127.0.0.1" placeholder="{{ trans('installer_messages.environment.wizard.form.db_host_placeholder') }}" />
                @if ($errors->has('database_hostname'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('database_hostname') }}
                    </span>
                @endif
            </div>

            <!-- Database port -->
            <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
                <label for="database_port">
                    {{ trans('installer_messages.environment.wizard.form.db_port_label') }}
                </label>
                <input class="form-control" type="number" name="database_port" id="database_port" value="3306" placeholder="{{ trans('installer_messages.environment.wizard.form.db_port_placeholder') }}" />
                @if ($errors->has('database_port'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('database_port') }}
                    </span>
                @endif
            </div>

            <!-- Database password -->
            <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                <label for="database_name">
                    {{ trans('installer_messages.environment.wizard.form.db_name_label') }}
                </label>
                <input class="form-control" type="text" name="database_name" id="database_name" value="homestead" placeholder="{{ trans('installer_messages.environment.wizard.form.db_name_placeholder') }}" />
                @if ($errors->has('database_name'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('database_name') }}
                    </span>
                @endif
            </div>

            <!-- Database username -->
            <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
                <label for="database_username">
                    {{ trans('installer_messages.environment.wizard.form.db_username_label') }}
                </label>
                <input class="form-control" type="text" name="database_username" id="database_username" value="homestead" placeholder="{{ trans('installer_messages.environment.wizard.form.db_username_placeholder') }}" />
                @if ($errors->has('database_username'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('database_username') }}
                    </span>
                @endif
            </div>
            
            <!-- Database password -->
            <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
                <label for="database_password">
                    {{ trans('installer_messages.environment.wizard.form.db_password_label') }}
                </label>
                <input class="form-control" type="password" name="database_password" id="database_password" value="secret" placeholder="{{ trans('installer_messages.environment.wizard.form.db_password_placeholder') }}" />
                @if ($errors->has('database_password'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('database_password') }}
                    </span>
                @endif
            </div>
        </fieldset>        

        <fieldset>
            <legend>Mail configuration</legend>
            <!-- Mail driver --> 
            <div class="form-group {{ $errors->has('mail_driver') ? ' has-error ' : '' }}">
                <label for="mail_driver">
                    {{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_label') }}
                    <sup>
                        <a href="https://laravel.com/docs/5.4/mail" target="_blank" title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                            <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                            <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                        </a>
                    </sup>
                </label>
                <input class="form-control" type="text" name="mail_driver" id="mail_driver" value="smtp" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder') }}" />
                @if ($errors->has('mail_driver'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('mail_driver') }}
                    </span>
                @endif
            </div>
            
            <!-- Mail Host -->
            <div class="form-group {{ $errors->has('mail_host') ? ' has-error ' : '' }}">
                <label for="mail_host">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_label') }}</label>
                <input class="form-control" type="text" name="mail_host" id="mail_host" value="smtp.mailtrap.io" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder') }}" />
                @if ($errors->has('mail_host'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('mail_host') }}
                    </span>
                @endif
            </div>

            <!-- Mail Port -->
            <div class="form-group {{ $errors->has('mail_port') ? ' has-error ' : '' }}">
                <label for="mail_port">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_label') }}</label>
                <input class="form-control" type="number" name="mail_port" id="mail_port" value="2525" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder') }}" />
                @if ($errors->has('mail_port'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('mail_port') }}
                    </span>
                @endif
            </div>

            <!-- Mail username -->
            <div class="form-group {{ $errors->has('mail_username') ? ' has-error ' : '' }}">
                <label for="mail_username">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_label') }}</label>
                <input class="form-control" type="text" name="mail_username" id="mail_username" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder') }}" />
                @if ($errors->has('mail_username'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('mail_username') }}
                    </span>
                @endif
            </div>

            <!-- Mail password -->
            <div class="form-group {{ $errors->has('mail_password') ? ' has-error ' : '' }}">
                <label for="mail_password">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_label') }}</label>
                <input class="form-control" type="text" name="mail_password" id="mail_password" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder') }}" />
                @if ($errors->has('mail_password'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('mail_password') }}
                    </span>
                @endif
            </div>

            <!-- Mail encryption -->
            <div class="form-group {{ $errors->has('mail_encryption') ? ' has-error ' : '' }}">
                <label for="mail_encryption">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_label') }}</label>
                <input class="form-control" type="text" name="mail_encryption" id="mail_encryption" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder') }}" />
                @if ($errors->has('mail_encryption'))
                    <span class="error-block">
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ $errors->first('mail_encryption') }}
                    </span>
                @endif
            </div>
        </fieldset>    
                
                
            </div>
        </div>

        <!-- Submit button -->
        <button class="btn btn-fw info" type="submit">
            Configure
            <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
        </button>
    </form>
@endsection
