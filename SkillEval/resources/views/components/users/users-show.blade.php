<section class="vh-100" style="background-color: #f4f5f7;">
    <div class="container py-5 h-100">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-6 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white"
                             style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            @if ($user->image !== null)
                                <img src="{{ asset('storage/' . $user->image) }}" alt="User image"
                                     class="img-fluid my-5" style='border-radius: 50%; width: 120px; height: 120px;'/>
                            @else
                                <img src="{{ asset('imgs/defaultuser.png') }}" alt="Avatar" class="img-fluid my-5"
                                     style="width: 120px;"/>
                            @endif
                            <h5>{{$user->name}}</h5>
                            @foreach($user->roles as $role)
                                <p>{{ ucfirst($role->name) }}</p>
                            @endforeach

                            <a style="color: #f4f5f7" href="{{route('users.edit', $user->id)}}"><i
                                    class="far fa-edit mb-5"></i></a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Dados</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-12 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted">{{$user->email}}</p>
                                    </div>
                                </div>
                                <h6>Detalhes</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Criado</h6>
                                        <p class="text-muted">{{ $user->created_at->format('d-m-Y H:i')}}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Atualizado</h6>
                                        <p class="text-muted">{{ $user->updated_at->format('d-m-Y H:i')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
