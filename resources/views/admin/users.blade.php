@extends('admin.master')

@section('title')
    Nutzer
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
            {{session()->get('message') }}
            <button class="btn-close" type="button" data-coreui-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert mt-2 {{ Session::get('alert-class', 'alert-danger') }}">
                {{$error}}
            </div>
        @endforeach
    @endif

  

    <div class="card mb-2">
        <div class="card-header">Alle Nutzer ({{count($users)}})</div>
            <div class="card-body">
                <div class="row">
                    <table class="table border mb-0">
                
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Rolle</th>
                                <th>Offene Rechnungen</th>
                                <th>Offene Rechnungsbeträge</th>
                                <th>Offene Entnahmen</th>
                                <th></th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($users as $user)
                            
                            <tr class="align-middle">
                                <td>
                                    <div></div>
                                        {{$user->firstname}} {{$user->lastname}}
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        {{$user->email}}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                       @if($user->role == 0) Endanwender @else Admin @endif
                                    </div>
                                </td>
                               
                                @foreach($usersPayment as $userPayment)
                                @if($userPayment['id'] == $user->id)
                                <td>                               
                                    <div>
                                       {{$userPayment['open_bills']}}
                                    </div>
                                </td> 
                                <td>                               
                                    <div>
                                        {{number_format($userPayment['open_bills_amount'],2)}}&#8364;
                                    </div>
                                </td>
                                <td>                               
                                    <div>
                                    {{number_format($userPayment['purchases'],2)}}&#8364;
                                    </div>
                                </td>
                                <td> 
                                    @if(auth()->user()->id != $user->id)
                                    @if($user->role == 0)                            
                                    <form method="post" action="{{ route('userToAdmin', $user->id) }}">
                                        @csrf
                                        <button class="btn btn-primary py-0" type="submit">Zum Admin</button>
                                    </form>
                                    @else
                                    <form method="post" action="{{ route('userToUser', $user->id) }}">
                                        @csrf
                                        <button class="btn btn-primary py-0" type="submit">Zum User</button>
                                    </form>
                                    @endif
                                </td>
                                @endif
                                @endif
                                @endforeach
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-3">
                {{$users->links()}}
            </div>
        </div>
    </div>

@endsection