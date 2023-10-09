<!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Laravel 8 Pagination Demo - codeanddeploy.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">Add Deposit</div>
                        <div class="card-body">
                            
                            @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ Session::get('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <form action="{{ route('deposit') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="user_id" required>
                                        <option value="">--select--</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <table class="table table-striped caption-top">
                        <caption>List of Transactions</caption>
                        <thead>
                        <tr>
                            <th scope="col" width="1%">#</th>
                            <th scope="col" width="15%">Name</th>
                            <th scope="col" width="10%">Account Type</th>
                            <th scope="col" >Trx Type</th>
                            <th scope="col" width="10%">Amount</th>
                            <th scope="col" width="10%">Fee</th>
                            <th scope="col" width="10%">Balance</th>
                            <th scope="col" width="10%">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction as $trx)
                                <tr>
                                    <th scope="row">{{ $trx->id }}</th>
                                    <th>{{ $trx->name }}</th>
                                    <th>{{ $trx->account_type }}</th>
                                    <td>{{ $trx->transaction_type }}</td>
                                    <td>{{ $trx->amount }}</td>
                                    <td>{{ $trx->fee }}</td>
                                    <td>{{ $trx->balance }}</td>
                                    <td>{{ $trx->date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex">
                {!! $transaction->links() !!}
            </div>
        </div>
    </body>
</html>
