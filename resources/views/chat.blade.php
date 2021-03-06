@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <h3 class="panel-heading">Your friends</h3>

                &nbsp;&nbsp;
                <user-component :users="users" >
                </user-component>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <h3 class="panel-heading">
                       <chat-panel-heading-component ></chat-panel-heading-component>
                    </h3>
                    <div class="panel-body">
                        <div class="chat-panel">
                              <chat-message-component :messages="messages"></chat-message-component>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <chat-form-component
                            v-on:messagesent="addMessage"
                            :user="{{ Auth::user() }}"
                        ></chat-form-component>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
