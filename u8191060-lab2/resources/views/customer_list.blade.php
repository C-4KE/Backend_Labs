<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Customers</title>
</head>
<body>
    <div class="container mt-5">
        <form class="form-inline" id="filter-form" method="GET">
            <select class="select" id="filter-select" style="margin-bottom: 15px;" name="filter">
                <option value="none" form="filter-form">None</option>
                <option value="is_banned" form="filter-form">Banned</option>
                <option value="not_banned" form="filter-form">Not banned</option>
                <option value="email" form="filter-form">Email</option>
                <option value="phone" form="filter-form">Phone</option>
                <option value="name" form="filter-form">Name and surname</option>
            </select>
            <input id="hidden-input" type="text" name="filter_value" class="form-control ml-3 mb-3" placeholder="Filter..." autocomplete="off">
            <button class="btn btn-default mb-3" type="submit">Filter</button>
        </form>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">ID</th>
                    <th scope="col">Is banned</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <th scope="row"><a href="http://u8191060-lab2.local/customers/{{ $customer->id }}">{{ $customer->id }}</a></th>
                    @if ($customer->is_banned)
                        <td>Yes</td>
                    @else
                        <td>No</td>
                    @endif
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->surname }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>{{ $customer->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
        {!! $customers->appends(Request::except('page'))->render() !!}
        </div>
    </div>
</body>