<div class="card">
    <div class="card-header">
        <h3 class="card-title">Chats</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <ul class="list-group">
            @foreach($chat as $c)
                <li class="list-group-item">
                    <a href="{{route('user.chat.show',['id'=>$c->id])}}" class="user-link">
                        <i class="fas fa-circle"></i>
                        @foreach($c->users as $user)
                            @if($user->id !== auth()->user()->id)
                                {{ $user->name }}
                            @endif
                        @endforeach
                    </a>
                    @if($c->messages()->latest()->first() !== null)
                        <div class="last-message"> <b>{{$c->messages()->latest()->first()->sender->name}}:</b>
                            {{$c->messages()->latest()->first()->content}}</div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-body">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <a href="{{route('user.chat.create')}}" class="btn btn-block bg-gradient-info" style="width: 200px">Create New Chat</a>
            </div>
        </div>
    </div>
</div>
